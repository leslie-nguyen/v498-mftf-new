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
 * @Title("MC-5796: MAGETWO-95934: Can't upload Watermark Image")
 * @Description("Watermark images should be able to be uploaded in the admin<h3>Test files</h3>vendor\magento\module-theme\Test\Mftf\Test\AdminWatermarkUploadTest.xml<br>")
 * @TestCaseId("MC-5796")
 * @group Watermark
 */
class AdminWatermarkUploadTestCest
{
	/**
	 * @Features({"Theme"})
	 * @Stories({"Watermark"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminWatermarkUploadTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-18496");
	}
}
