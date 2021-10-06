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
 * @Title("MC-11146: Product Categories Indexer in Update on Schedule mode")
 * @Description("The test verifies that in Update on Schedule mode if displaying of category products on Storefront changes due to product properties change,             the changes are NOT applied immediately, but applied only after cron runs (twice).<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminProductCategoryIndexerInUpdateOnScheduleModeTest.xml<br>")
 * @TestCaseId("MC-11146")
 * @group catalog
 * @group indexer
 */
class AdminProductCategoryIndexerInUpdateOnScheduleModeTestCest
{
	/**
	 * @Stories({"Product Categories Indexer"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminProductCategoryIndexerInUpdateOnScheduleModeTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-20392");
	}
}
