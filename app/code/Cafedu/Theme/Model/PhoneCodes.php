<?php
namespace Cafedu\Theme\Model;

class PhoneCodes extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cafedu\Theme\Model\ResourceModel\PhoneCodes');
    }

}
