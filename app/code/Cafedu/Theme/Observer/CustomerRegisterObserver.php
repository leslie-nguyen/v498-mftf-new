<?php
namespace Cafedu\Theme\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Sales\Model\OrderFactory;

class CustomerRegisterObserver implements ObserverInterface
{
    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var AddressRepositoryInterface
     */
    protected $addressRepository;

    /**
     * CustomerRegisterObserver constructor.
     * @param AddressRepositoryInterface $addressRepository
     * @param OrderFactory $orderFactory
     */
    public function __construct(
        AddressRepositoryInterface $addressRepository,
        OrderFactory $orderFactory
    ) {
        $this->orderFactory = $orderFactory;
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $orderFactory = $this->orderFactory->create();
        $customer = $observer->getEvent()->getData('customer');

        try {
            $billingAddressId = $customer->getDefaultBilling();
            $shippingAddressId = $customer->getDefaultShipping();
            if ($observer->getEvent()->getData('order_id')) {
                $order = $orderFactory->load($observer->getEvent()->getData('order_id'));
                $orderBillingAddress = $order->getBillingAddress();
                $orderShippingAddress = $order->getShippingAddress();

                $billingAddress = $this->addressRepository->getById($billingAddressId);
                $billingAddress->setCustomAttribute('cafedu_phone_preffix', $orderBillingAddress->getCafeduPhonePreffix());
                $this->addressRepository->save($billingAddress);

                $shippingAddress = $this->addressRepository->getById($shippingAddressId);
                $shippingAddress->setCustomAttribute('cafedu_phone_preffix', $orderShippingAddress->getCafeduPhonePreffix());
                $this->addressRepository->save($shippingAddress);
            }
        } catch (\Exception $e) {}
    }
}