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
 * @Title("[NO TESTCASEID]: Admin marketing pending reviews navigate menu")
 * @Description("Admin able see navigate head menu Marketing is active, when open page Marketing > Pending Reviews<h3>Test files</h3>vendor\magento\module-review\Test\Mftf\Test\AdminMarketingPendingReviewsNavigateMenuActiveTest.xml<br>")
 * @group menu
 */
class AdminMarketingPendingReviewsNavigateMenuActiveTestCest
{
    /**
     * @var \Magento\FunctionalTestingFramework\Helper\HelperContainer
     */
    private $helperContainer;

    /**
     * Special method which automatically creates the respective objects.
     */
    public function _inject(\Magento\FunctionalTestingFramework\Helper\HelperContainer $helperContainer)
    {
        $this->helperContainer = $helperContainer;
        $this->helperContainer->create("\Magento\Rule\Test\Mftf\Helper\RuleHelper");
    }
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
	 * @Features({"Review"})
	 * @Stories({"Menu Navigation"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminMarketingPendingReviewsNavigateMenuActiveTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [navigateToReportsViewsPage] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToReportsViewsPage
		$I->click("li[data-ui-id='menu-magento-backend-marketing']"); // stepKey: clickOnMenuItemNavigateToReportsViewsPage
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToReportsViewsPageWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-review-catalog-reviews-ratings-pending']"); // stepKey: clickOnSubmenuItemNavigateToReportsViewsPage
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToReportsViewsPageWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToReportsViewsPage] AdminNavigateMenuActionGroup");
		$I->comment("Entering Action Group [seePageTitle] AdminAssertPageTitleActionGroup");
		$I->see("Pending Reviews", ".page-title-wrapper h1"); // stepKey: assertPageTitleSeePageTitle
		$I->comment("Exiting Action Group [seePageTitle] AdminAssertPageTitleActionGroup");
		$I->comment("Entering Action Group [assertClass] AdminAssertClassElementRelativeIdActionGroup");
		$grabClassAssertClass = $I->grabAttributeFrom("#menu-magento-backend-marketing", "class"); // stepKey: grabClassAssertClass
		$I->assertStringContainsString("_active", $grabClassAssertClass); // stepKey: assertClassAssertClass
		$I->comment("Exiting Action Group [assertClass] AdminAssertClassElementRelativeIdActionGroup");
	}
}
