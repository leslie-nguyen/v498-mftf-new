<?php
namespace Cafedu\Theme\Model\ResourceModel\PhoneCodes;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cafedu\Theme\Model\PhoneCodes', 'Cafedu\Theme\Model\ResourceModel\PhoneCodes');
    }

    /**
     * @param bool $withEmpty
     * @param null $countryCode
     * @return array
     */
    public function toOptionArray($withEmpty = false, $countryCode = null)
    {
        if ($countryCode) {
            $this->addFieldToFilter('country_code', $countryCode);
        }
        $result = $this::_toOptionArray('phone_code', 'label');
        if ($withEmpty) {
            array_unshift($result, ['value' => '', 'label' => __('Choose code')]);
        }
        return $result;
    }
}
