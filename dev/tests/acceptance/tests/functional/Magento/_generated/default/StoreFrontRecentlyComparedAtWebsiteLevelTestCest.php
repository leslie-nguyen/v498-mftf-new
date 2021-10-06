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
 * @Title("MC-33099: Recently Compared Product at website level")
 * @Description("Recently Compared Products widget appears on a page immediately after adding product to compare<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\StoreFrontRecentlyComparedAtWebsiteLevelTest.xml<br>")
 * @TestCaseId("MC-33099")
 * @group catalog
 * @group widget
 */
class StoreFrontRecentlyComparedAtWebsiteLevelTestCest
{
	/**
	 * @Features({"Catalog"})
	 * @Stories({"Recently Compared Product"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StoreFrontRecentlyComparedAtWebsiteLevelTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-34091");
	}
}
