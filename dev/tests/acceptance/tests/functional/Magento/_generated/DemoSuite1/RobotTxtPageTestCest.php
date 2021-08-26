<?php
namespace Magento\AcceptanceTest\_DemoSuite1\Backend;

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
 * @Description("Check display Robot.txt page<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\RobotTxtPageTest.xml<br>")
 * @TestCaseId("QUICK-ROBOTTXT01")
 * @group QuickGoThrough
 */
class RobotTxtPageTestCest
{
	/**
	 * @Features({"Theme"})
	 * @Stories({"Check display Robot.txt page"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function RobotTxtPageTest(AcceptanceTester $I)
	{
		$I->comment("Access Robot.txt page");
		$I->maximizeWindow(); // stepKey: maximizeWindow
		$I->amOnUrl("https://tmp.cafeducycliste.com//en_row/robots.txt"); // stepKey: amOnRobotTxtPage
		$I->comment("Verify not displayed as 404 not found and content text included \"User-agent:\"");
		$I->dontSeeElementInDOM(".std"); // stepKey: verifyPageIsNot404
		$I->see("User-agent:", "pre"); // stepKey: waitForTextUserAgentInPageContent
		$I->makeScreenshot("RobotTxtScreenshot"); // stepKey: screenshotRobotTxt
	}
}
