<?php
declare(strict_types=1);
namespace Cafedu\Theme\Observer;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CurrencyFormat implements ObserverInterface
{
    const FORMAT_CONFIG_PATH = 'cdc_currency/format/';
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * CurrencyFormat constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @see \Magento\Framework\Locale\Currency
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $code = $observer->getData('base_code');
        if ($code && $format = $this->getFormat($code)) {
            $observer->getData('currency_options')->setData('format', $format);
        }
    }

    /**
     * @param $code
     * @return mixed
     */
    private function getFormat($code)
    {
        return $this->scopeConfig->getValue(self::FORMAT_CONFIG_PATH . $code);
    }
}
