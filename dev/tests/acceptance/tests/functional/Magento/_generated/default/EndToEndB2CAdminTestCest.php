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
 * @group e2e
 * @Title("MAGETWO-87014: Pass End to End B2C Admin scenario")
 * @Description("Admin creates products, creates and manages categories, creates promotions, creates an order, processes an order, processes a return, uses admin grids<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\EndToEndB2CAdminTest.xml<br>vendor\magento\module-sales\Test\Mftf\Test\EndToEndB2CAdminTest.xml<br>vendor\magento\module-configurable-product\Test\Mftf\Test\EndToEndB2CAdminTest.xml<br>vendor\magento\module-downloadable\Test\Mftf\Test\EndToEndB2CAdminTest.xml<br>vendor\magento\module-grouped-product\Test\Mftf\Test\EndToEndB2CAdminTest.xml<br>vendor\magento\module-bundle\Test\Mftf\Test\EndToEndB2CAdminTest.xml<br>vendor\magento\module-shipping\Test\Mftf\Test\EndToEndB2CAdminTest.xml<br>")
 * @TestCaseId("MAGETWO-87014")
 */
class EndToEndB2CAdminTestCest
{
	/**
	 * @Features({"Catalog"})
	 * @Stories({"B2C admin - MAGETWO-75412"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function EndToEndB2CAdminTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMQE-891");
	}
}
