<?php
  namespace Cafedu\Theme\Controller\Adminhtml\Product;

  use Magento\Backend\App\Action;
  use Magento\Framework\App\Filesystem\DirectoryList;
  use Magento\Framework\Exception\LocalizedException;
  use Magento\Framework\Filesystem;
  use Magento\MediaStorage\Model\File\UploaderFactory;

  class Uploader extends \Magento\Backend\App\Action
  {
      protected $fileSystem;
      protected $uploaderFactory;
      protected $allowedImageExtensions = ['jpg', 'jpeg', 'png'];
      protected $imageField = 'panel_image';

      public function __construct(
          Action\Context $context,
          Filesystem $fileSystem,
          UploaderFactory $uploaderFactory
      ) {
          $this->fileSystem = $fileSystem;
          $this->uploaderFactory = $uploaderFactory;
          parent::__construct($context);
      }

      public function execute() {
        if (isset($_FILES[$this->imageField]) && $_FILES[$this->imageField]['name']!='') {
          $ext = pathinfo($_FILES[$this->imageField]['name'], PATHINFO_EXTENSION);
          if( in_array($ext, $this->allowedImageExtensions) ) {
            $destinationPath = $this->getDestinationPath();
            try {
                $uploader = $this->uploaderFactory->create(['fileId' => $this->imageField])
                    ->setAllowCreateFolders(true)
                    ->setAllowedExtensions($this->allowedImageExtensions);
                $response = $uploader->save($destinationPath);
                if (!$response) {
                  echo __('File cannot be saved. Please, consult your dev team.');
                } else {
                  echo $response['file'];
                }
            } catch (\Exception $e) {
                $this->messageManager->addError( __($e->getMessage()) );
            }
          } else {
            echo 'error';
          }
        }
      }

      public function getDestinationPath() {
        return $this->fileSystem->getDirectoryWrite(DirectoryList::MEDIA)->getAbsolutePath('cafedu/style-with/');
      }
  }
