<?php
namespace Cafedu\Theme\Block;

use Magento\Framework\View\Element\Template;
use Cafedu\Theme\Model\ResourceModel\PhoneCodes\CollectionFactory as PhoneCodeFactory;
class Payment extends Template
{
    protected $phoneCodeFactory;

    /**
     * Payment constructor.
     * @param Template\Context $context
     * @param PhoneCodeFactory $phoneCodeFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        PhoneCodeFactory $phoneCodeFactory,
        array $data = []
    ) {
        $this->phoneCodeFactory = $phoneCodeFactory;
        parent::__construct($context, $data);
    }

  public function getLogoUrl($logo)
  {
    return $this->_storeManager->getStore()->getBaseUrl( \Magento\Framework\UrlInterface::URL_TYPE_MEDIA ) . 'cafedu/' . $logo;
  }

  public function getHPPLogo()
  {
    return $this->getLogoUrl( $this->_scopeConfig->getValue('payment/realexpayments_hpp_section/realexpayments_hpp/realexpayments_hpp_basic/hpp_logo', \Magento\Store\Model\ScopeInterface::SCOPE_STORE) );
  }

  public function getBraintreeLogo()
  {
    return $this->getLogoUrl( $this->_scopeConfig->getValue('payment/braintree_section/braintree/braintree_required/braintree_logo', \Magento\Store\Model\ScopeInterface::SCOPE_STORE) );
  }

  public function getApplePayLogo()
  {
    return $this->getLogoUrl( $this->_scopeConfig->getValue('payment/braintree_section/braintree/braintree_applepay/applepay_logo', \Magento\Store\Model\ScopeInterface::SCOPE_STORE) );
  }

  public function getPhoneCodes()
  {
    return $this->phoneCodeFactory->create()->toOptionArray(true);
  }
  
  public function getPhoneCountryCodes()
  {
      $storeCode = $this->_storeManager->getStore()->getCode();
      $codePieces = explode("_",$storeCode);
      $countryCode = $codePieces[1];
      return $this->phoneCodeFactory->create()->toOptionArray(true, $countryCode);
  }

  public function prepareCountryCodeHtml($countryCode = '') {
    $codeArray = $this->getPhoneCodes();

    $html = '<div class="field cafedu_phone_preffix_field required">';
    $html .= '<label class="label" for="cafedu_phone_preffix"><span>' . __('Country Code') . '</span></label>';
    $html .= '<div class="control">';
    $html .= '<select id="cafedu_phone_preffix" name="cafedu_phone_preffix" title="' . __('Country Code') . '" class="input-text required-entry" aria-required="true">';
    foreach ($codeArray as $code) {
      if( $code['value'] == $countryCode ):
        $html .= '<option value="'.$code['value'].'" selected="selected">'.$code['label'].'</option>';
      else:
        $html .= '<option value="'.$code['value'].'">'.$code['label'].'</option>';
      endif;
    }
    $html .= '</select>';
    $html .= '</div></div>';

    return $html;
  }
}
