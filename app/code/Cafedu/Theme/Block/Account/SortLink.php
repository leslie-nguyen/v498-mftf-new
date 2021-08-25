<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Cafedu\Theme\Block\Account;

/**
 * Class for sortable links.
 */
class SortLink extends \Cafedu\Theme\Block\View\Element\Html\Link\Current implements \Magento\Customer\Block\Account\SortLinkInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }
}
