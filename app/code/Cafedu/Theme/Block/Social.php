<?php
namespace Cafedu\Theme\Block;

class Social extends \Magento\Framework\View\Element\Template
{ 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) { 
        parent::__construct($context, $data);
    }

    public function getSocialLinks()
    {
        $_Links = array(
            'facebook' => array(
                'name' => 'Facebook',
                'link' => $this->_scopeConfig->getValue('social/links/facebook', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
            ),
            'twitter' => array(
                'name' => 'Twitter',
                'link' => $this->_scopeConfig->getValue('social/links/twitter', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
            ),
            'pinterest' => array(
                'name' => 'Pinterest',
                'link' => $this->_scopeConfig->getValue('social/links/pinterest', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
            ),
            'instagram' => array(
                'name' => 'Instagram',
                'link' => $this->_scopeConfig->getValue('social/links/instagram', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
            ),
            'strava' => array(
                'name' => 'Strava',
                'link' => $this->_scopeConfig->getValue('social/links/strava', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
            )
        );

        return $_Links;
    }
}
