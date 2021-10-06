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
 * @Title("MC-3415: Admin should be able to set/edit Related Products information when editing a virtual product")
 * @Description("Admin should be able to set/edit Related Products information when editing a virtual product<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminVirtualSetEditRelatedProductsTest.xml<br>")
 * @TestCaseId("MC-3415")
 * @group Catalog
 */
class AdminVirtualSetEditRelatedProductsTestCest
{
	/**
	 * @Features({"Catalog"})
	 * @Stories({"Create/edit virtual product"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminVirtualSetEditRelatedProductsTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-194");
	}
}
