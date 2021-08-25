<?php
namespace Cafedu\Theme\Model;

use Magento\Framework\App\ObjectManager;

class Subscriber extends \Magento\Newsletter\Model\Subscriber
{
    /**
     * Subscribes by email, country and gender
     *
     * @param string $email
     * @throws \Exception
     * @return int
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function subscribe($email, $country = null, $gender = null)
    {
        $this->loadByEmail($email);

        if (!$this->getId()) {
            $this->setSubscriberConfirmCode($this->randomSequence());
        }

        $this->setSubscriberCountry($country);
        $this->setSubscriberGender($gender);

        $isConfirmNeed = $this->_scopeConfig->getValue(
            self::XML_PATH_CONFIRMATION_FLAG,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        ) == 1 ? true : false;
        $isOwnSubscribes = false;

        $isSubscribeOwnEmail = $this->_customerSession->isLoggedIn()
            && $this->_customerSession->getCustomerDataObject()->getEmail() == $email;

        if (!$this->getId() || $this->getStatus() == self::STATUS_UNSUBSCRIBED
            || $this->getStatus() == self::STATUS_NOT_ACTIVE
        ) {
            if ($isConfirmNeed === true) {
                // if user subscribes own login email - confirmation is not needed
                $isOwnSubscribes = $isSubscribeOwnEmail;
                if ($isOwnSubscribes == true) {
                    $this->setStatus(self::STATUS_SUBSCRIBED);
                } else {
                    $this->setStatus(self::STATUS_NOT_ACTIVE);
                }
            } else {
                $this->setStatus(self::STATUS_SUBSCRIBED);
            }
            $this->setSubscriberEmail($email);
        }

        if ($isSubscribeOwnEmail) {
            try {
                $customer = $this->customerRepository->getById($this->_customerSession->getCustomerId());
                $this->setStoreId($customer->getStoreId());
                $this->setCustomerId($customer->getId());
            } catch (NoSuchEntityException $e) {
                $this->setStoreId($this->_storeManager->getStore()->getId());
                $this->setCustomerId(0);
            }
        } else {
            $this->setStoreId($this->_storeManager->getStore()->getId());
            $this->setCustomerId(0);
        }

        $this->setStatusChanged(true);

        try {
            $this->save();
            if ($isConfirmNeed === true
                && $isOwnSubscribes === false
            ) {
                $this->sendConfirmationRequestEmail();
            } else {
                $this->sendConfirmationSuccessEmail();
            }
            return $this->getStatus();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Saving customer subscription status
     *
     * @param int $customerId
     * @param bool $subscribe indicates whether the customer should be subscribed or unsubscribed
     * @return  $this
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _updateCustomerSubscription($customerId, $subscribe)
    {
        $country = '';
        $gender = "N";

        try {
            $customerData = $this->customerRepository->getById($customerId);
            //prepare gender before subscriber
            if($customerData->getGender() == 1) {
                $gender = "M";
            } else if($customerData->getGender() == 2) {
                $gender = "F";
            } else {
                $gender = "N";
            } 

            //prepare country before subscribe
            $billing = $customerData->getDefaultBilling();
            if( $billing > 0 ) {
                $address = ObjectManager::getInstance()->create(\Magento\Customer\Model\Address::class)->load($billing);
                $defaultBilling = $address->getData();
                if ($defaultBilling && isset($defaultBilling['country_id'])) {
                    $country = $defaultBilling['country_id'];
                }
            }
        } catch (NoSuchEntityException $e) {
            return $this;
        }

        $this->loadByCustomerId($customerId);
        if (!$subscribe && !$this->getId()) {
            return $this;
        }

        if (!$this->getId()) {
            $this->setSubscriberConfirmCode($this->randomSequence());
        }

        $sendInformationEmail = false;
        $status = self::STATUS_SUBSCRIBED;
        if ($subscribe) {
            if ('account_confirmation_required'== $this->customerAccountManagement->getConfirmationStatus($customerId)
            ) {
                $status = self::STATUS_UNCONFIRMED;
            }
        } else {
            $status = self::STATUS_UNSUBSCRIBED;
        }
        /**
         * If subscription status has been changed then send email to the customer
         */
        if ($status != self::STATUS_UNCONFIRMED && $status != $this->getStatus()) {
            $sendInformationEmail = true;
        }

        if ($status != $this->getStatus()) {
            $this->setStatusChanged(true);
        }

        $this->setStatus($status);

        if (!$this->getId()) {
            $storeId = $customerData->getStoreId();
            if ($customerData->getStoreId() == 0) {
                $storeId = $this->_storeManager->getWebsite($customerData->getWebsiteId())->getDefaultStore()->getId();
            }

            $this->setStoreId($storeId)
                ->setCustomerId($customerData->getId())
                ->setEmail($customerData->getEmail());

            //add gender
            $this->setStoreId($storeId)
                ->setCustomerId($customerData->getId())
                ->setSubscriberGender($gender);

            //add country
            $this->setStoreId($storeId)
                ->setCustomerId($customerData->getId())
                ->setSubscriberCountry($country);
        } else {
            $this->setStoreId($customerData->getStoreId())
                ->setEmail($customerData->getEmail());

            //add gender
            $this->setStoreId($customerData->getStoreId())
                ->setSubscriberGender($gender);

            //add country
            $this->setStoreId($customerData->getStoreId())
                ->setSubscriberCountry($country);
        }

        $this->save();
        $sendSubscription = $sendInformationEmail;
        if ($sendSubscription === null xor $sendSubscription) {
            try {
                if ($this->isStatusChanged() && $status == self::STATUS_UNSUBSCRIBED) {
                    $this->sendUnsubscriptionEmail();
                } elseif ($this->isStatusChanged() && $status == self::STATUS_SUBSCRIBED) {
                    $this->sendConfirmationSuccessEmail();
                }
            } catch (MailException $e) {
                // If we are not able to send a new account email, this should be ignored
                $this->_logger->critical($e);
            }
        }
        return $this;
    }
}