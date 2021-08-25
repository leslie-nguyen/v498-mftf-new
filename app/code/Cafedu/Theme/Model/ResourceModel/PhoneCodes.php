<?php
namespace Cafedu\Theme\Model\ResourceModel;

class PhoneCodes extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cafedu_country_phone_code', 'phone_code_id');
    }
}
