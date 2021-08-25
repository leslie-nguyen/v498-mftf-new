<?php
namespace Cafedu\Theme\Block;

use Magento\Framework\Url\EncoderInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Store\Model\Store;

class Switcher extends \Magento\Framework\View\Element\Template {

    protected $encoder;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        EncoderInterface $encoder,
        array $data = []
    ) {
        $this->encoder = $encoder; 
        parent::__construct($context, $data);
    }

    public function getPosition() {
        return $this->getSection();
    }

    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    } 

    public function getWebsiteId(){
        return $this->_storeManager->getStore()->getWebsiteId();
    }

    public function getCurrencySymbol()
    {
        return $this->_currency->getCurrencySymbol();
    }

    public function getWebsites() 
    {
        $_websites = $this->_storeManager->getWebsites();
        $_websiteData = array();

        $SCRIPT_NAME = str_replace( "index.php", "", $_SERVER['SCRIPT_NAME'] );
        $REQUEST_URI = str_replace( $SCRIPT_NAME, "", $_SERVER['REQUEST_URI'] );

        foreach( $_websites as $website ){
            $_storeData = array();
            $wedsite_id = $website->getId();
            $wedsite_code = $website->getCode();
            $webiste_name = $website->getName();
            $website_logo = 'images/' . $wedsite_code . '.svg';
            $website_default_store = $website->getDefaultGroup()->getDefaultStoreId();
            foreach( $website->getStores() as $store ){
                $_storeObj = $this->_storeManager->getStore( $store );
                $store_id = $_storeObj->getId();
                $store_name = $_storeObj->getName();
                $currency = $_storeObj->getDefaultCurrencyCode();
                $store_url = $this->getTargetStoreRedirectUrl($_storeObj);
                if( $website_default_store == $store_id ) {
                    $webiste_url = $store_url;
                }
                array_push( $_storeData, array(
                    'store_id' => $store_id, 
                    'store_name' => $store_name,
                    'store_url' => $store_url
                ));
            }

            if($currency == 'USD'):
               $currency = 'US Dollars';
               $currency_symbol = '$';
            elseif($currency == 'CAD'):
               $currency = 'CAD Dollars';
               $currency_symbol = 'CA$';
            elseif($currency == 'GBP'):
               $currency = 'GB Pound';
               $currency_symbol = '£';
            elseif($currency == 'EUR'):
               $currency = 'Euro';
               $currency_symbol = '€';
            elseif($currency == 'AUD'):
               $currency = 'AUS Dollars';
               $currency_symbol = 'A$';
            elseif($currency == 'JPY'):
               $currency = 'Japanese Yen';
               $currency_symbol = '￥';
            endif;

            $_websiteData[$wedsite_code] = array(
                'code' => 'switcher_storename_' . $website->getCode(),
                'wedsite_id' => $wedsite_id, 
                'webiste_name' => $webiste_name,
                'website_logo' => $website_logo, 
                'currency' => $currency,
                'currency_symbol' => $currency_symbol,
                'webiste_url' => $this->getTargetStoreRedirectUrl($website->getDefaultStore()),
                'stores' => $_storeData
            );
        }

        return $_websiteData;
    }

    /**
     * Returns target store redirect url.
     *
     * @param Store $store
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getTargetStoreRedirectUrl(Store $store): string
    {
        return $this->getUrl(
            'stores/store/redirect',
            [
                '___store' => $store->getCode(),
                '___from_store' => $this->_storeManager->getStore()->getCode(),
                ActionInterface::PARAM_NAME_URL_ENCODED => $this->encoder->encode(
                    $store->getCurrentUrl(false)
                ),
            ]
        );
    }

}