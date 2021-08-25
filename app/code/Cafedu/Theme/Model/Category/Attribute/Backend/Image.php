<?php
namespace Cafedu\Theme\Model\Category\Attribute\Backend;

use Magento\Framework\App\Filesystem\DirectoryList;

class Image extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Catalog\Model\ImageUploader
     */
    protected $uploader;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var string
     */
    private $additionalData = '_cafedu_image_data_';

    /**
     * LargeImage constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Catalog\Model\ImageUploader $uploader
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Catalog\Model\ImageUploader $uploader
    ) {
        $this->filesystem = $filesystem;
        $this->logger = $logger;
        $this->request = $request;
        $this->uploader = $uploader;
    }

    /**
     * Gets image name from $value array.
     * Will return empty string in a case when $value is not an array
     *
     * @param array $value Attribute value
     * @return string
     */
    private function getUploadedImageName($value)
    {
        if (is_array($value) && isset($value[0]['name'])) {
            return $value[0]['name'];
        }

        return '';
    }

    /**
     * @param \Magento\Framework\DataObject $object
     * @return \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
     */
    public function beforeSave($object)
    {
        $attributeName = $this->getAttribute()->getName();
        $value = $object->getData($attributeName);

        if ($this->fileResidesOutsideCategoryDir($value)) {
            $value[0]['name'] = $value[0]['url'];
        }

        if ($imageName = $this->getUploadedImageName($value)) {
            $object->setData($this->additionalData . $attributeName, $value);
            $this->moveFileFromTmp($object);
            $object->setData($attributeName, $imageName);
        } elseif (is_string($value)) {
            $readDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $imagePath = $this->uploader->getBasePath() . DIRECTORY_SEPARATOR . $value;
            if ($readDirectory->isFile($imagePath) && !$this->isCategoryController()) {
                $object->setData($attributeName, $value);
            } else {
                $object->setData($attributeName, null);
            }
        } else {
            $object->setData($attributeName, null);
        }

        return parent::beforeSave($object);
    }

    /**
     * @param $object
     */
    private function moveFileFromTmp($object)
    {
        $value = $object->getData($this->additionalData . $this->getAttribute()->getName());

        if ($this->isTmpFileAvailable($value) && $imageName = $this->getUploadedImageName($value)) {
            try {
                $this->uploader->moveFileFromTmp($imageName);
            } catch (\Exception $e) {
                $this->logger->critical($e);
            }
        }
    }

    /**
     * @return bool
     */
    private function isCategoryController()
    {
        return $this->request->getFullActionName() === 'catalog_category_save';
    }

    /**
     * Check if temporary file is available for new image upload.
     *
     * @param array $value
     * @return bool
     */
    private function isTmpFileAvailable($value)
    {
        return is_array($value) && isset($value[0]['tmp_name']);
    }

    /**
     * Check for file path resides outside of category media dir. The URL will be a path including pub/media if true
     *
     * @param array|null $value
     * @return bool
     */
    private function fileResidesOutsideCategoryDir($value)
    {
        if (!is_array($value) || !isset($value[0]['url'])) {
            return false;
        }

        $fileUrl = ltrim($value[0]['url'], '/');
        $baseMediaDir = $this->filesystem->getUri(DirectoryList::MEDIA);

        $usingPathRelativeToBase = strpos($fileUrl, $baseMediaDir) === 0;

        return $usingPathRelativeToBase;
    }
}