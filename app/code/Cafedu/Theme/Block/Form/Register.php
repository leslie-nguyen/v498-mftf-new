<?php
namespace Cafedu\Theme\Block\Form;

use Magento\Customer\Model\AccountManagement;

class Register extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Block\Widget\Name
     */
    protected $_widgetName;

    /**
     * @var \Magento\Customer\Block\Widget\Gender
     */
    protected $_widgetGender;

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $_moduleManager;

    /**
     * Register constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Block\Widget\Name $widgetName
     * @param \Magento\Customer\Block\Widget\Gender $widgetGender
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Block\Widget\Name $widgetName,
        \Magento\Customer\Block\Widget\Gender $widgetGender,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_widgetName = $widgetName;
        $this->_widgetGender = $widgetGender;
        $this->_moduleManager = $moduleManager;
        parent::__construct(
          $context,
          $data
        );
    }

    /**
     * @return bool
     */
    public function isNewsletterEnabled()
    {
        return $this->_moduleManager->isOutputEnabled('Magento_Newsletter');
    }

    /**
     * @return bool
     */
    public function isPrefixEnabled()
    {
        return $this->_widgetName->showPrefix();
    }

    /**
     * @return bool
     */
    public function isGenderEnabled()
    {
        return $this->_widgetGender->isEnabled();
    }

    /**
     * @return array
     */
    public function getPrefixOptions()
    {
        $options = $this->_scopeConfig->getValue(
            'customer/address/prefix_options',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return explode(';', $options);
    }

    /**
     * @return string
     */
    public function getPrivacyUrl()
    {
        return $this->getUrl('privacy-policy');
    }

    /**
     * @return string
     */
    public function getTermsofuseUrl()
    {
        return $this->getUrl('terms-conditions');
    }

    /**
     * @return string
     */
    public function getPostUrl()
    {
        return $this->getUrl('cafedu_theme/customer/createpost');
    }

    /**
     * @return mixed
     */
    public function getMinimumPasswordLength()
    {
        return $this->_scopeConfig->getValue(AccountManagement::XML_PATH_MINIMUM_PASSWORD_LENGTH);
    }

    /**
     * @return mixed
     */
    public function getRequiredCharacterClassesNumber()
    {
        return $this->_scopeConfig->getValue(AccountManagement::XML_PATH_REQUIRED_CHARACTER_CLASSES_NUMBER);
    }

    /**
     * @return \Magento\Framework\Phrase|string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getDeclaration()
    {
        $currentStore = $this->_storeManager->getStore()->getCode();
        if($currentStore == 'jp_ja'){
            return __('アカウントを作成することにより、利用規約<a href="%1">に</a>同意した<a href="%1">こと</a>になります。', $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }elseif($currentStore == 'de_de'){
            return __('Indem du bei ein Konto einrichten, stimmst du unseren <a href="%1">Allgemeinen Geschäftsbedingungen</a> zu und bestätigst, unsere <a href="%1">Datenschutzbestimmungen</a> gelesen zu haben.', $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }elseif($currentStore == 'fr_fr'){
            return __("En créant un compte vous acceptez nos <a href='%1'>Conditions d'Utilisation</a> et <a href='%2'>Politique de Confidentialité</a>.", $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }elseif($currentStore == 'fr_uk'){
            return __("En créant un compte vous acceptez nos <a href='%1'>Conditions d'Utilisation</a> et <a href='%2'>Politique de Confidentialité</a>.", $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }elseif($currentStore == 'fr_us'){
            return __("En créant un compte vous acceptez nos <a href='%1'>Conditions d'Utilisation</a> et <a href='%2'>Politique de Confidentialité</a>.", $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }elseif($currentStore == 'fr_ca'){
            return __("En créant un compte vous acceptez nos <a href='%1'>Conditions d'Utilisation</a> et <a href='%2'>Politique de Confidentialité</a>.", $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }elseif($currentStore == 'fr_au'){
            return __("En créant un compte vous acceptez nos <a href='%1'>Conditions d'Utilisation</a> et <a href='%2'>Politique de Confidentialité</a>.", $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }elseif($currentStore == 'fr_row'){
            return __("En créant un compte vous acceptez nos <a href='%1'>Conditions d'Utilisation</a> et <a href='%2'>Politique de Confidentialité</a>.", $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }elseif($currentStore == 'fr_roe'){
            return __("En créant un compte vous acceptez nos <a href='%1'>Conditions d'Utilisation</a> et <a href='%2'>Politique de Confidentialité</a>.", $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }else{
            return __('By creating an account, you agree to our <a href="%1">Terms of Use</a> and <a href="%2">Privacy Policy</a>.', $this->getTermsofuseUrl(), $this->getPrivacyUrl());
        }
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getNewsletterheading()
    {
        return __("Subscribe to our newsletter, L'Edition.");
    }
}
