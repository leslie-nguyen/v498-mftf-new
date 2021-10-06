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
 * @Title("MC-6060: Update category, make inactive")
 * @Description("Login as admin and update category and  make it Inactive<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminUpdateCategoryAndMakeInactiveTest.xml<br>")
 * @TestCaseId("MC-6060")
 * @group Catalog
 * @group mtf_migrated
 */
class AdminUpdateCategoryAndMakeInactiveTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginToAdminPanel
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginToAdminPanel
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginToAdminPanel
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginToAdminPanel
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginToAdminPanelWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginToAdminPanel
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginToAdminPanel
		$I->comment("Exiting Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->createEntity("createDefaultCategory", "hook", "_defaultCategory", [], []); // stepKey: createDefaultCategory
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createDefaultCategory", "hook"); // stepKey: deleteCreatedCategory
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
	 * @Stories({"Update categories"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminUpdateCategoryAndMakeInactiveTest(AcceptanceTester $I)
	{
		$I->comment("Open category page");
		$I->comment("Entering Action Group [openAdminCategoryIndexPage] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageOpenAdminCategoryIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadOpenAdminCategoryIndexPage
		$I->comment("Exiting Action Group [openAdminCategoryIndexPage] AdminOpenCategoryPageActionGroup");
		$I->comment("Update category and make category inactive");
		$I->comment("Entering Action Group [clickOnExpandTree] AdminExpandCategoryTreeActionGroup");
		$I->click(".tree-actions a:last-child"); // stepKey: clickOnExpandTreeClickOnExpandTree
		$I->waitForPageLoad(30); // stepKey: waitForCategoryToLoadClickOnExpandTree
		$I->comment("Exiting Action Group [clickOnExpandTree] AdminExpandCategoryTreeActionGroup");
		$I->click("//a/span[contains(text(), 'simpleCategory" . msq("_defaultCategory") . "')]"); // stepKey: selectCreatedCategory
		$I->waitForPageLoad(30); // stepKey: selectCreatedCategoryWaitForPageLoad
		$I->click("input[name='is_active']+label"); // stepKey: disableCategory
		$I->comment("Entering Action Group [clickSaveButton] AdminSaveCategoryActionGroup");
		$I->click(".page-actions-inner #save"); // stepKey: saveCategoryWithProductsClickSaveButton
		$I->waitForPageLoad(30); // stepKey: saveCategoryWithProductsClickSaveButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCategorySavedClickSaveButton
		$I->comment("Exiting Action Group [clickSaveButton] AdminSaveCategoryActionGroup");
		$I->comment("Entering Action Group [assertSuccessMessage] AssertAdminCategorySaveSuccessMessageActionGroup");
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForElementAssertSuccessMessage
		$I->see("You saved the category.", "#messages div.message-success"); // stepKey: seeSuccessMessageAssertSuccessMessage
		$I->comment("Exiting Action Group [assertSuccessMessage] AssertAdminCategorySaveSuccessMessageActionGroup");
		$I->see("simpleCategory" . msq("_defaultCategory"), "h1.page-title"); // stepKey: seePageTitle
		$I->dontSeeCheckboxIsChecked("input[name='is_active']"); // stepKey: dontCategoryIsChecked
		$I->comment("Verify Inactive Category is store front page");
		$I->amOnPage("/simpleCategory" . msq("_defaultCategory") . ".html"); // stepKey: amOnCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitForPageToBeLoaded
		$I->dontSeeElement("//nav//a[span[contains(., 'simpleCategory" . msq("_defaultCategory") . "')]]"); // stepKey: dontSeeCategoryOnStoreNavigationBar
		$I->waitForPageLoad(30); // stepKey: dontSeeCategoryOnStoreNavigationBarWaitForPageLoad
		$I->waitForPageLoad(15); // stepKey: wait
		$I->comment("Verify Inactive Category in category page");
		$I->comment("Entering Action Group [openAdminCategoryIndexPage1] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageOpenAdminCategoryIndexPage1
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadOpenAdminCategoryIndexPage1
		$I->comment("Exiting Action Group [openAdminCategoryIndexPage1] AdminOpenCategoryPageActionGroup");
		$I->comment("Entering Action Group [clickOnExpandTree1] AdminExpandCategoryTreeActionGroup");
		$I->click(".tree-actions a:last-child"); // stepKey: clickOnExpandTreeClickOnExpandTree1
		$I->waitForPageLoad(30); // stepKey: waitForCategoryToLoadClickOnExpandTree1
		$I->comment("Exiting Action Group [clickOnExpandTree1] AdminExpandCategoryTreeActionGroup");
		$I->seeElement("//li[contains(@class, 'x-tree-node')]//div[contains(.,'simpleCategory" . msq("_defaultCategory") . "') and contains(@class, 'no-active-category')]"); // stepKey: assertCategoryInTree
		$I->click("//a/span[contains(text(), 'simpleCategory" . msq("_defaultCategory") . "')]"); // stepKey: selectCreatedCategory1
		$I->waitForPageLoad(30); // stepKey: selectCreatedCategory1WaitForPageLoad
		$I->see("simpleCategory" . msq("_defaultCategory"), "h1.page-title"); // stepKey: seeCategoryPageTitle1
		$I->dontSeeCheckboxIsChecked("input[name='is_active']"); // stepKey: assertCategoryIsInactive
	}
}
