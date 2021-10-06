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
 * @Title("https://app.hiptest.com/projects/131313/test-plan/folders/1051731/scenarios/3579351: Admin User is logged into Admin Panel and User signs in and out from Stock")
 * @TestCaseId("https://app.hiptest.com/projects/131313/test-plan/folders/1051731/scenarios/3579351")
 * @Description("Admin User is logged into Admin Panel and User signs in and out from Stock<h3>Test files</h3>vendor\magento\module-adobe-stock-image-admin-ui\Test\Mftf\Test\AdminAdobeStockSignInSignOutTest.xml<br>")
 * @group adobe_stock_integration_login_logout
 */
class AdminAdobeStockSignInSignOutTestCest
{
	/**
	 * @Features({"AdobeStockImageAdminUi"})
	 * @Stories({"[Story #21] Adobe Sign-in", "[Story #36] User signs out from Stock"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAdobeStockSignInSignOutTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nhttps://github.com/magento/adobe-stock-integration/issues/1170");
	}
}
