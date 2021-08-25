<?php
namespace Cafedu\Theme\Plugin;

use Magento\Framework\Message\ManagerInterface;

class MessageCookie
{
    /**
     * @param ManagerInterface $subject
     * @param bool $clear
     * @param string|null $group
     * @return array
     */
    public function beforeGetMessages(ManagerInterface $subject, $clear = false, $group = null)
    {
        $clear = true;
        return [$clear, $group];
    }
}
