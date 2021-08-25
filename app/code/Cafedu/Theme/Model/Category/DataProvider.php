<?php

namespace Cafedu\Theme\Model\Category;

use Magento\Framework\App\ObjectManager;

class DataProvider extends \Magento\Catalog\Model\Category\DataProvider
{
    /**
     * @param array $categoryData
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function addUseConfigSettings($categoryData)
    {
        $_object = ObjectManager::getInstance()->get(\Magento\Catalog\Model\Category\FileInfo::class);
        $data = parent::addUseConfigSettings($categoryData);
        $category = $this->getCurrentCategory();

        if (isset($data['in_homepage'])) {
            unset($data['in_homepage']);
            $data['in_homepage'] = $category->getData('in_homepage');
        }

        if (isset($data['is_collections'])) {
            unset($data['is_collections']);
            $data['is_collections'] = $category->getData('is_collections');
        }

        if (isset($data['banner'])) {
            unset($data['banner']);

            $fileName = $this->getImageName($category->getData('banner'));
            $stat = $_object->getStat($fileName);
            $mime = $_object->getMimeType($fileName);

            $data['banner'][0]['name'] = $fileName;
            $data['banner'][0]['url'] = $this->getImageUrl($fileName);
            $data['banner'][0]['size'] = isset($stat) ? $stat['size'] : 0;
            $data['banner'][0]['type'] = $mime;
        }

        if (isset($data['mobile_banner'])) {
            unset($data['mobile_banner']);

            $fileName = $this->getImageName($category->getData('mobile_banner'));
            $stat = $_object->getStat($fileName);
            $mime = $_object->getMimeType($fileName);

            $data['mobile_banner'][0]['name'] = $fileName;
            $data['mobile_banner'][0]['url'] = $this->getImageUrl($fileName);
            $data['mobile_banner'][0]['size'] = isset($stat) ? $stat['size'] : 0;
            $data['mobile_banner'][0]['type'] = $mime;
        }

        if (isset($data['image_2'])) {
            unset($data['image_2']);

            $fileName = $this->getImageName($category->getData('image_2'));
            $stat = $_object->getStat($fileName);
            $mime = $_object->getMimeType($fileName);

            $data['image_2'][0]['name'] = $fileName;
            $data['image_2'][0]['url'] = $this->getImageUrl($fileName);
            $data['image_2'][0]['size'] = isset($stat) ? $stat['size'] : 0;
            $data['image_2'][0]['type'] = $mime;
        }

        if (isset($data['large_image'])) {
            unset($data['large_image']);

            $fileName = $this->getImageName($category->getData('large_image'));
            $stat = $_object->getStat($fileName);
            $mime = $_object->getMimeType($fileName);

            $data['large_image'][0]['name'] = $fileName;
            $data['large_image'][0]['url'] = $this->getImageUrl($fileName);
            $data['large_image'][0]['size'] = isset($stat) ? $stat['size'] : 0;
            $data['large_image'][0]['type'] = $mime;
        }

        if (isset($data['look_page_type'])) {
            unset($data['look_page_type']);
            $data['look_page_type'] = $category->getData('look_page_type');
        }

        if (isset($data['look_video_banner'])) {
            unset($data['look_video_banner']);
            $data['look_video_banner'] = $category->getData('look_video_banner');
        }

        if (isset($data['look_image_front'])) {
            unset($data['look_image_front']);

            $fileName = $this->getImageName($category->getData('look_image_front'));
            $stat = $_object->getStat($fileName);
            $mime = $_object->getMimeType($fileName);

            $data['look_image_front'][0]['name'] = $fileName;
            $data['look_image_front'][0]['url'] = $this->getImageUrl($fileName);
            $data['look_image_front'][0]['size'] = isset($stat) ? $stat['size'] : 0;
            $data['look_image_front'][0]['type'] = $mime;
        }

        if (isset($data['look_image_back'])) {
            unset($data['look_image_back']);

            $fileName = $this->getImageName($category->getData('look_image_back'));
            $stat = $_object->getStat($fileName);
            $mime = $_object->getMimeType($fileName);

            $data['look_image_back'][0]['name'] = $fileName;
            $data['look_image_back'][0]['url'] = $this->getImageUrl($fileName);
            $data['look_image_back'][0]['size'] = isset($stat) ? $stat['size'] : 0;
            $data['look_image_back'][0]['type'] = $mime;
        }
        return $data;
    }

    protected function getFieldsMap()
    {
        $fields = parent::getFieldsMap();
        $fields['cafedu_theme_settings'][] = 'in_homepage'; // NEW FIELD
        $fields['cafedu_theme_settings'][] = 'is_collections'; // NEW FIELD
        $fields['cafedu_theme_settings'][] = 'banner'; // NEW FIELD
        $fields['cafedu_theme_settings'][] = 'mobile_banner'; // NEW FIELD
        $fields['cafedu_theme_settings'][] = 'image_2'; // NEW FIELD
        $fields['cafedu_theme_settings'][] = 'large_image'; // NEW FIELD
        $fields['bss_look'][] = 'look_page_type'; // NEW FIELD
        $fields['bss_look'][] = 'look_video_banner'; // NEW FIELD
        $fields['bss_look'][] = 'look_image_front'; // NEW FIELD
        $fields['bss_look'][] = 'look_image_back'; // NEW FIELD
        $fields['content'][] = 'listing_title';
        $fields['content'][] = 'banner_background';

        return $fields;
    }

    private function getImageName($fileName = '')
    {
        if (is_array($fileName)) {
            return $fileName[0]['name'];
        }

        return $fileName;
    }

    /**
     * Returns image url
     *
     * @param string $image
     * @return bool|string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getImageUrl($image = '')
    {
        $_storeManager = ObjectManager::getInstance()->get(\Magento\Store\Model\StoreManagerInterface::class);
        $url = false;
        if ($image) {
            if (is_string($image)) {
                $store = $_storeManager->getStore();

                $isRelativeUrl = substr($image, 0, 1) === '/';

                $mediaBaseUrl = $store->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                );

                if ($isRelativeUrl) {
                    $url = $image;
                } else {
                    $url = $mediaBaseUrl
                        . ltrim(\Magento\Catalog\Model\Category\FileInfo::ENTITY_MEDIA_PATH, '/')
                        . '/'
                        . $image;
                }
            } else {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }
        return $url;
    }
}
