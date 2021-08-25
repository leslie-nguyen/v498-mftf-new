<?php
  namespace Cafedu\Theme\Block\Account;

  use Magento\Framework\View\Element\Template;

  class Forgotpassword extends \Magento\Framework\View\Element\Template
  {
    protected $_jsLayout;
    protected $customerUrl;

    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout']) ? $data['jsLayout'] : [];
    }

    protected function getPostUrl()
    {
      return $this->getUrl('cafedu_theme/customer/forgotpasswordpost');
    }

    public function getJsLayout()
    {
      return \Zend_Json::encode($this->jsLayout);
    }

    public function getForgotPasswordConfig()
    {
      return [
        'actionUrl' => $this->escapeUrl($this->getPostUrl()),
      ];
    }
  }
