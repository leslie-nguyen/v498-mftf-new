<?php
namespace Cafedu\Theme\Model\Category\Attribute\Backend;
use Magento\Framework\App\Filesystem\DirectoryList;

class Banner extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
	protected $_uploaderFactory;
	protected $_filesystem;
	protected $_fileUploaderFactory;
	protected $_logger;
	private $imageUploader;
    /**
     * @var string
     */
    private $additionalData = '_cafedu_banner_data_';
 
	public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Filesystem $filesystem,
    	\Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
	) {
        $this->_filesystem                = $filesystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_logger                      = $logger;
	}

    /**
     * @return array
     */
    public function toArray()
    {
        return [0];
    }

    /**
     * @return array
     */
    final public function getAllOptions()
    {
        $arr = $this->toArray();
        $ret = [];
 
        foreach ($arr as $key => $value) {
            $ret[] = [
                'value' => $key,
                'label' => $value
            ];
        }
 
        return $ret;
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
     * Avoiding saving potential upload data to DB
     * Will set empty image attribute value if image was not uploaded
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     * @since 101.0.8
     */
    public function beforeSave($object)
    {
        $attributeName = $this->getAttribute()->getName();
        $value = $object->getData($attributeName);

        if ($this->fileResidesOutsideCategoryDir($value)) {
            // use relative path for image attribute so we know it's outside of category dir when we fetch it
            $value[0]['name'] = $value[0]['url'];
        }

        if ($imageName = $this->getUploadedImageName($value)) {
            $object->setData($this->additionalData . $attributeName, $value);
            $object->setData($attributeName, $imageName);
        } elseif (!is_string($value)) {
            $object->setData($attributeName, null);
        } else {
            $object->setData($attributeName, null);
        }

        return parent::beforeSave($object);
    }

    /**
     * @return \Magento\Catalog\Model\ImageUploader
     *
     * @deprecated 101.0.0
     */
    private function getImageUploader()
    {
        if ($this->imageUploader === null) {
            $this->imageUploader = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Cafedu\Theme\CategoryBannerUpload::class);
        }

        return $this->imageUploader;
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
        $baseMediaDir = $this->_filesystem->getUri(DirectoryList::MEDIA);

        $usingPathRelativeToBase = strpos($fileUrl, $baseMediaDir) === 0;

        return $usingPathRelativeToBase;
    }

    /**
     * Save uploaded file and set its name to category
     *
     * @param \Magento\Framework\DataObject $object
     * @return \Magento\Catalog\Model\Category\Attribute\Backend\Image
     */
    public function afterSave($object)
    {
        $value = $object->getData($this->additionalData . $this->getAttribute()->getName());

        if ($this->isTmpFileAvailable($value) && $imageName = $this->getUploadedImageName($value)) {
            try {
                $this->getImageUploader()->moveFileFromTmp($imageName);
            } catch (\Exception $e) {
                $this->_logger->critical($e);
            }
        }

        return $this;
    }
}