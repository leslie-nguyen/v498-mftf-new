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
 * @group Cms
 * @Title("MAGETWO-95725: Verify that admin is able to upload image to a CMS Page with TinyMCE3 enabled")
 * @Description("Verify that admin is able to upload image to CMS Page with TinyMCE3 enabled<h3 class='y-label y-label_status_broken'>Deprecated Notice(s):</h3><ul><li>TinyMCE3 is no longer supported</li></ul><h3>Test files</h3>vendor\magento\module-cms\Test\Mftf\Test\AdminAddImageToCMSPageTinyMCE3Test.xml<br>")
 * @TestCaseId("MAGETWO-95725")
 */
class AdminAddImageToCMSPageTinyMCE3TestCest
{
	/**
	 * @Features({"Cms"})
	 * @Stories({"Admin should be able to upload images with TinyMCE3 WYSIWYG"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAddImageToCMSPageTinyMCE3Test(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nTinyMCE3 is no longer supported");
	}
}
