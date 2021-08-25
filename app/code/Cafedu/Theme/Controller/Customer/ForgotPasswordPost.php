<?php

namespace Cafedu\Theme\Controller\Customer;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Model\Session;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\SecurityViolationException;

class ForgotPasswordPost extends \Magento\Framework\App\Action\Action
{
    protected $customerAccountManagement;
    protected $escaper;
    protected $session;

    public function __construct(
        Context $context,
        Session $customerSession,
        AccountManagementInterface $customerAccountManagement,
        Escaper $escaper
    ) {
        $this->session = $customerSession;
        $this->customerAccountManagement = $customerAccountManagement;
        $this->escaper = $escaper;
        parent::__construct($context);
    }

    public function execute()
    {
        $_responseSender = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $email = (string)$this->getRequest()->getParam('email');
        if ($email) {
            if (!\Zend_Validate::is($email, \Magento\Framework\Validator\EmailAddress::class)) {
                $this->session->setForgottenEmail($email);
                $response = array(
                    'error' => true,
                    'message' => __('Please correct the email address.')
                );
                return $_responseSender->setData($response);
            }

            try {
                $this->customerAccountManagement->initiatePasswordReset($email, AccountManagement::EMAIL_RESET);
            } catch (NoSuchEntityException $exception) {
                $response = array(
                    'error' => true,
                    'message' => __('There is no account associated with this email address. If you created an account before 08/04/2019, you will need to create a new one.')
                );
                return $_responseSender->setData($response);
            } catch (SecurityViolationException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                $response = array(
                    'error' => true,
                    'message' => $exception->getMessage()
                );
                return $_responseSender->setData($response);
            } catch (\Exception $exception) {
                $response = array(
                    'error' => true,
                    'message' => __('We\'re unable to send the password reset email.')
                );
                return $_responseSender->setData($response);
            }
            $response = array(
                'error' => false,
                'message' => $this->getSuccessMessage($email)
            );
            return $_responseSender->setData($response);
        } else {
            $response = array(
                'error' => true,
                'message' => __('Please enter your email.')
            );
            return $_responseSender->setData($response);
        }
    }

    protected function getSuccessMessage($email)
    {
        return __(
            'If there is an account associated with %1 you will receive an email with a link to reset your password.',
            $this->escaper->escapeHtml($email)
        );
    }
}
