<?php
namespace Magento\AcceptanceTest\_default\Backend;

use Magento\FunctionalTestingFramework\AcceptanceTester;
use \Codeception\Util\Locator;
use Yandex\Allure\Adapter\Annotation\Features;
use Yandex\Allure\Adapter\Annotation\Stories;
use Yandex\Allure\Adapter\Annotation\Title;
use Yandex\Allure\Adapter\Annotation\Description;
use Yandex\Allure\Adapter\Annotation\Parameter;
use Yandex\Allure\Adapter\Annotation\Severity;
use Yandex\Allure\Adapter\Model\SeverityLevel;
use Yandex\Allure\Adapter\Annotation\TestCaseId;

/**
 * @Title("MC-6353: Product in the shopping cart could be reached by admin during order creation with multi website config")
 * @Description("Product in the shopping cart could be reached by admin during order creation with multi website config<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\AdminProductInTheShoppingCartCouldBeReachedByAdminDuringOrderCreationWithMultiWebsiteConfigTest.xml<br>")
 * @TestCaseId("MC-6353")
 * @group sales
 */
class AdminProductInTheShoppingCartCouldBeReachedByAdminDuringOrderCreationWithMultiWebsiteConfigTestCest
{
    /**
     * @var \Magento\FunctionalTestingFramework\Helper\HelperContainer
     */
    private $helperContainer;

    /**
     * Special method which automatically creates the respective objects.
     */
    public function _inject(\Magento\FunctionalTestingFramework\Helper\HelperContainer $helperContainer)
    {
        $this->helperContainer = $helperContainer;
        $this->helperContainer->create("\Magento\Rule\Test\Mftf\Helper\RuleHelper");
    }
	/**
	 * @Stories({"Admin create order"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Features({"Sales"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminProductInTheShoppingCartCouldBeReachedByAdminDuringOrderCreationWithMultiWebsiteConfigTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-20129");
	}
}
