<?php

namespace Cafedu\Theme\Controller\Customer;

use Magento\Customer\Model\Account\Redirect as AccountRedirect;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Helper\Address;
use Magento\Framework\UrlFactory;
use Magento\Newsletter\Model\SubscriberFactory;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Customer\Model\Url as CustomerUrl;
use Magento\Customer\Model\Registration;
use Magento\Framework\Escaper;
use Magento\Customer\Model\CustomerExtractor;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Data\Form\FormKey\Validator;
use Cafedu\Theme\Model\Order\AccountDelegation;
use Magento\Sales\Model\Order\OrderCustomerExtractor;
use Magento\Framework\Controller\ResultFactory;
use Magento\Checkout\Model\Session as CheckoutSession;

class CreatePost extends \Magento\Customer\Controller\AbstractAccount
{
    protected $accountManagement;
    protected $subscriberFactory;
    protected $registration;
    protected $customerDataFactory;
    protected $customerUrl;
    protected $escaper;
    protected $customerExtractor;
    protected $urlModel;
    protected $dataObjectHelper;
    protected $session;
    private $accountRedirect;
    private $cookieMetadataFactory;
    private $cookieMetadataManager;
    private $formKeyValidator;

    /**
     * @var OrderCustomerExtractor
     */
    private $orderCustomerExtractor;
    /**
     * @var AccountDelegation
     */
    private $delegateService;

    /**
     * @var Session
     */
    private $checkoutSession;

    public function __construct(
        Context $context,
        Session $customerSession,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        AccountManagementInterface $accountManagement,
        Address $addressHelper,
        UrlFactory $urlFactory,
        SubscriberFactory $subscriberFactory,
        CustomerInterfaceFactory $customerDataFactory,
        CustomerUrl $customerUrl,
        Registration $registration,
        Escaper $escaper,
        CustomerExtractor $customerExtractor,
        DataObjectHelper $dataObjectHelper,
        AccountRedirect $accountRedirect,
        OrderCustomerExtractor $orderCustomerExtractor,
        AccountDelegation $delegateService,
        CheckoutSession $checkoutSession,
        Validator $formKeyValidator = null
    ) {
        $this->session = $customerSession;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->accountManagement = $accountManagement;
        $this->subscriberFactory = $subscriberFactory;
        $this->customerDataFactory = $customerDataFactory;
        $this->customerUrl = $customerUrl;
        $this->registration = $registration;
        $this->escaper = $escaper;
        $this->customerExtractor = $customerExtractor;
        $this->urlModel = $urlFactory->create();
        $this->dataObjectHelper = $dataObjectHelper;
        $this->accountRedirect = $accountRedirect;
        $this->orderCustomerExtractor = $orderCustomerExtractor;
        $this->delegateService = $delegateService;
        $this->checkoutSession = $checkoutSession;
        $this->formKeyValidator = $formKeyValidator ?: ObjectManager::getInstance()->get(Validator::class);
        parent::__construct($context);
    }

    private function getCookieManager()
    {
        if (!$this->cookieMetadataManager) {
            $this->cookieMetadataManager = ObjectManager::getInstance()->get(
                \Magento\Framework\Stdlib\Cookie\PhpCookieManager::class
            );
        }
        return $this->cookieMetadataManager;
    }

    private function getCookieMetadataFactory()
    {
        if (!$this->cookieMetadataFactory) {
            $this->cookieMetadataFactory = ObjectManager::getInstance()->get(
                \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory::class
            );
        }
        return $this->cookieMetadataFactory;
    }

    public function execute()
    {
        $_responseSender = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $orderId = null;
        if ($this->getRequest()->getParam('current_page') && $this->getRequest()->getParam('current_page') == "success") {
            try {
                $orderId = $this->checkoutSession->getLastOrderId();
                $this->delegateNew((int) $orderId);
            } catch (\Exception $e) {
                $response = array(
                    'error' => true,
                    'message' => __('Something went wrong while stored order data to customer!')
                );
                return $_responseSender->setData($response);
            }
        }

        if ($this->session->isLoggedIn()) {
            $response = array(
                'error' => true,
                'message' => __('Sorry! You are already logged in.',
                    $this->urlModel->getUrl('customer/account', ['_secure' => true]))
            );
            return $_responseSender->setData($response);
        }

        if (!$this->registration->isAllowed()) {
            $response = array(
                'error' => true,
                'message' => __('Sorry! Customer registration is disabled by Administrator.')
            );
            return $_responseSender->setData($response);
        }

        if (!$this->getRequest()->isPost()) {
            $response = array(
                'error' => true,
                'message' => __('Sorry! Unable to validate your data. Please, refresh and try again.')
            );
            return $_responseSender->setData($response);
        }

        try {
            $this->session->regenerateId();
            $customer = $this->customerExtractor->extract('customer_account_create', $this->_request);
            $password = $this->getRequest()->getParam('password');
            $confirmation = $this->getRequest()->getParam('password_confirmation');
            $redirectUrl = $this->session->getBeforeAuthUrl();

            if ($password != $confirmation) {
                $response = array(
                    'error' => true,
                    'message' => __('Please make sure your passwords match.')
                );
                return $_responseSender->setData($response);
            }

            $customer = $this->accountManagement->createAccount($customer, $password, $redirectUrl);

            if ($this->getRequest()->getParam('is_subscribed', false)) {
                $this->subscriberFactory->create()->subscribeCustomerById($customer->getId());
            }

            $this->_eventManager->dispatch(
                'cafedu_customer_register_success',
                ['order_id' => $orderId, 'customer' => $customer]
            );

            $this->_eventManager->dispatch(
                'customer_register_success',
                ['account_controller' => $this, 'customer' => $customer]
            );

            $confirmationStatus = $this->accountManagement->getConfirmationStatus($customer->getId());
            if ($confirmationStatus === AccountManagementInterface::ACCOUNT_CONFIRMATION_REQUIRED) {
                $email = $this->customerUrl->getEmailConfirmationUrl($customer->getEmail());
                $response = array(
                    'error' => false,
                    'message' => __('You must confirm your account. Please check your email for the confirmation link.')
                );
                return $_responseSender->setData($response);
            } else {
                $this->session->setCustomerDataAsLoggedIn($customer);
                if ($this->getCookieManager()->getCookie('mage-cache-sessid')) {
                    $metadata = $this->getCookieMetadataFactory()->createCookieMetadata();
                    $metadata->setPath('/');
                    $this->getCookieManager()->deleteCookie('mage-cache-sessid', $metadata);
                }
                $response = array(
                    'error' => false,
                    'message' => __('Thank you for registering with Café du Cycliste - %1 Store.', $this->storeManager->getStore()->getFrontendName())
                );
                return $_responseSender->setData($response);
            }
        } catch (StateException $e) {
            $message = __(
                'There is already an account with this email address.'
            );
            $response = array(
                'error' => true,
                'message' => $message
            );
            return $_responseSender->setData($response);
        } catch (InputException $e) {
            $response = array(
                'error' => true,
                'message' => $e->getMessage()
            );
            return $_responseSender->setData($response);
        } catch (LocalizedException $e) {
            $response = array(
                'error' => true,
                'message' => $e->getMessage()
            );
            return $_responseSender->setData($response);
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('We can\'t save the customer.'));
            $response = array(
                'error' => true,
                'message' => __('We can\'t save the customer.')
            );
            return $_responseSender->setData($response);
        }
    }

    private function delegateNew(int $orderId)
    {
        return $this->delegateService->createRedirectForNew(
            $this->orderCustomerExtractor->extract($orderId),
            ['__sales_assign_order_id' => $orderId]
        );
    }
}
