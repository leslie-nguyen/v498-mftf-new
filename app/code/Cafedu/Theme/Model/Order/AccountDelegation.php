<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Cafedu\Theme\Model\Order;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Delegation\Storage;

/**
 * @inheritDoc
 */
class AccountDelegation
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @param Storage $storage
     */
    public function __construct(
        Storage $storage
    ) {
        $this->storage = $storage;
    }

    /**
     * @inheritDoc
     */
    public function createRedirectForNew(
        CustomerInterface $customer,
        array $mixedData = null
    ) {
        return $this->storage->storeNewOperation($customer, $mixedData);
    }
}
