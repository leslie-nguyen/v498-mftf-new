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
 * @Title("[NO TESTCASEID]: Adobe Stock Previewed Licensed Image Save")
 * @Description("User saves previously licensed image with saved preview into Magento Media Gallery<h3>Test files</h3>vendor\magento\module-adobe-stock-image-admin-ui\Test\Mftf\Test\AdminAdobeStockSaveLicenseWithSavedPreviewTest.xml<br>")
 * @group adobe_stock_integration_login_logout
 */
class AdminAdobeStockSaveLicenseWithSavedPreviewTestCest
{
	/**
	 * @Features({"AdobeStockImageAdminUi"})
	 * @Stories({"User saves licensed image for previously saved preview"})
	 * @Severity(level = SeverityLevel::MINOR)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAdobeStockSaveLicenseWithSavedPreviewTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nhttps://github.com/magento/adobe-stock-integration/issues/1170");
	}
}
