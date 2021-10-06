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
 * @Title("https://studio.cucumber.io/projects/131313/test-plan/folders/1051731/scenarios/4406205: License Adobe Stock Images message should not popup when user is not logged in and tries to License and Save an already Licensed image copy")
 * @TestCaseId("https://studio.cucumber.io/projects/131313/test-plan/folders/1051731/scenarios/4406205")
 * @Description("Admin User saved licensed image then logout and try license image again<h3>Test files</h3>vendor\magento\module-adobe-stock-image-admin-ui\Test\Mftf\Test\AdminAdobeStockTryLicenseAlreadyLicensedImageTest.xml<br>")
 * @group adobe_stock_integration_login_logout
 */
class AdminAdobeStockTryLicenseAlreadyLicensedImageTestCest
{
	/**
	 * @Features({"AdobeStockImageAdminUi"})
	 * @Stories({"Admin User saved licensed image then logout and try license image again"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAdobeStockTryLicenseAlreadyLicensedImageTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nhttps://github.com/magento/adobe-stock-integration/issues/1170");
	}
}
