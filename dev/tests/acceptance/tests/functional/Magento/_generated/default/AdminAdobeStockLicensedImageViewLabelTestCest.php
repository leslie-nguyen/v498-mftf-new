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
 * @Title("https://app.hiptest.com/projects/131313/test-plan/folders/1051731/scenarios/3579363: User views licensed label for licensed images in Adobe Stock Panel")
 * @Description("User views licensed label for licensed images in Adobe Stock Panel<h3>Test files</h3>vendor\magento\module-adobe-stock-image-admin-ui\Test\Mftf\Test\AdminAdobeStockLicensedImageViewLabelTest.xml<br>")
 * @TestCaseId("https://app.hiptest.com/projects/131313/test-plan/folders/1051731/scenarios/3579363")
 * @group adobe_stock_integration_login_logout
 */
class AdminAdobeStockLicensedImageViewLabelTestCest
{
	/**
	 * @Features({"AdobeStockImageAdminUi"})
	 * @Stories({"[Story #22] User views licensed images in the grid"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAdobeStockLicensedImageViewLabelTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nhttps://github.com/magento/adobe-stock-integration/issues/1170");
	}
}
