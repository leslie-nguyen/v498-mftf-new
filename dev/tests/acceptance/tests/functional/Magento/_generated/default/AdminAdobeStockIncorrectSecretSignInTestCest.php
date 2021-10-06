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
 * @Title("https://app.hiptest.com/projects/131313/test-plan/folders/1051731/scenarios/3579351: Admin User attempts to sign in to Adobe Stock with incorrect Secret Key configured")
 * @TestCaseId("https://app.hiptest.com/projects/131313/test-plan/folders/1051731/scenarios/3579351")
 * @Description("Admin User attempts to sign in to Adobe Stock with incorrect Secret Key configured<h3>Test files</h3>vendor\magento\module-adobe-stock-image-admin-ui\Test\Mftf\Test\AdminAdobeStockIncorrectSecretSignInTest.xml<br>")
 * @group adobe_stock_integration_login_logout
 */
class AdminAdobeStockIncorrectSecretSignInTestCest
{
	/**
	 * @Features({"AdobeStockImageAdminUi"})
	 * @Stories({"[Story #21] Adobe Sign-in (incorrect credentials)"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAdobeStockIncorrectSecretSignInTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nhttps://github.com/magento/adobe-stock-integration/issues/1170");
	}
}
