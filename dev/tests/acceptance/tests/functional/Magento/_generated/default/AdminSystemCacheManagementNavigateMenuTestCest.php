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
 * @Title("MC-14120: Admin system cache management navigate menu test")
 * @Description("Admin should be able to navigate to System > Cache Management<h3>Test files</h3>vendor\magento\module-backend\Test\Mftf\Test\AdminSystemCacheManagementNavigateMenuTest.xml<br>")
 * @TestCaseId("MC-14120")
 * @group menu
 * @group mtf_migrated
 */
class AdminSystemCacheManagementNavigateMenuTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [LoginAsAdmin] AdminLoginActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [logout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageLogout
		$I->comment("Exiting Action Group [logout] AdminLogoutActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _failed(AcceptanceTester $I)
	{
		$I->saveScreenshot(); // stepKey: saveScreenshot
	}

	/**
	 * @Features({"Backend"})
	 * @Stories({"Menu Navigation"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminSystemCacheManagementNavigateMenuTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [navigateToSystemCacheManagementPage] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToSystemCacheManagementPage
		$I->click("li[data-ui-id='menu-magento-backend-system']"); // stepKey: clickOnMenuItemNavigateToSystemCacheManagementPage
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToSystemCacheManagementPageWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-backend-system-cache']"); // stepKey: clickOnSubmenuItemNavigateToSystemCacheManagementPage
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToSystemCacheManagementPageWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToSystemCacheManagementPage] AdminNavigateMenuActionGroup");
		$I->comment("Entering Action Group [seePageTitle] AdminAssertPageTitleActionGroup");
		$I->see("Cache Management", ".page-title-wrapper h1"); // stepKey: assertPageTitleSeePageTitle
		$I->comment("Exiting Action Group [seePageTitle] AdminAssertPageTitleActionGroup");
	}
}
