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
 * @Title("MAGETWO-94176: Create and delete backups")
 * @Description("An admin user can create a backup of each type and delete each backup.<h3>Test files</h3>vendor\magento\module-backup\Test\Mftf\Test\AdminCreateAndDeleteBackupsTest.xml<br>")
 * @TestCaseId("MAGETWO-94176")
 * @group backup
 */
class AdminCreateAndDeleteBackupsTestCest
{
	/**
	 * @Features({"Backup"})
	 * @Stories({"Create and delete backups"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateAndDeleteBackupsTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-5807");
	}
}
