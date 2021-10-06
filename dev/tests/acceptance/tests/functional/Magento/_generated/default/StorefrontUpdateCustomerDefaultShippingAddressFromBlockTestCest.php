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
 * @Title("MAGETWO-97501: Add default customer address via the Storefront611")
 * @Description("Storefront user should be able to create a new default address via the storefront<h3>Test files</h3>vendor\magento\module-customer\Test\Mftf\Test\StorefrontUpdateCustomerAddressTest\StorefrontUpdateCustomerDefaultShippingAddressFromBlockTest.xml<br>")
 * @TestCaseId("MAGETWO-97501")
 * @group customer
 * @group update
 */
class StorefrontUpdateCustomerDefaultShippingAddressFromBlockTestCest
{
	/**
	 * @Features({"Customer"})
	 * @Stories({"Implement handling of large number of addresses on storefront Address book"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontUpdateCustomerDefaultShippingAddressFromBlockTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMAGETWO-97504");
	}
}
