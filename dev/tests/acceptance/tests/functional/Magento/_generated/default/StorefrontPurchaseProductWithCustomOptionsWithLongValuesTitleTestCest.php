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
 * @group Catalog
 * @Title("MC-3043: Admin should be able to see the full title of the selected custom option value in the order")
 * @Description("Admin should be able to see the full title of the selected custom option value in the order<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\StorefrontPurchaseProductWithCustomOptionsWithLongValuesTitleTest.xml<br>")
 * @TestCaseId("MC-3043")
 */
class StorefrontPurchaseProductWithCustomOptionsWithLongValuesTitleTestCest
{
	/**
	 * @Features({"Catalog"})
	 * @Stories({"Custom options"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontPurchaseProductWithCustomOptionsWithLongValuesTitleTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMQE-1128");
	}
}
