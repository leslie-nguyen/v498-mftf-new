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
 * @Title("MC-32333: Admin Reports Review by Products")
 * @Description("Review By Products Grid Filters<h3>Test files</h3>vendor\magento\module-review\Test\Mftf\Test\AdminReviewsByProductsReportTest.xml<br>")
 * @TestCaseId("MC-32333")
 */
class AdminReviewsByProductsReportTestCest
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
		$I->comment("Login");
		$I->comment("Entering Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->comment("Create product and Category");
		$I->createEntity("category", "hook", "SimpleSubCategory", [], []); // stepKey: category
		$I->createEntity("createProduct1", "hook", "SimpleProduct", ["category"], []); // stepKey: createProduct1
		$I->createEntity("createProduct2", "hook", "SimpleProduct", ["category"], []); // stepKey: createProduct2
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Delete reviews");
		$I->comment("Entering Action Group [openAllReviewsPage] AdminOpenReviewsPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/review/product/index/"); // stepKey: openReviewsPageActionGroupOpenAllReviewsPage
		$I->waitForPageLoad(30); // stepKey: waitForReviewsPageLoadOpenAllReviewsPage
		$I->comment("Exiting Action Group [openAllReviewsPage] AdminOpenReviewsPageActionGroup");
		$I->comment("Entering Action Group [deleteCustomerReview] AdminDeleteReviewsByUserNicknameActionGroup");
		$I->fillField("#reviewGrid_filter_nickname", "user" . msq("simpleProductReview")); // stepKey: fillNicknameDeleteCustomerReview
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersDeleteCustomerReview
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersDeleteCustomerReviewWaitForPageLoad
		$I->selectOption("#reviewGrid_massaction-mass-select", "selectAll"); // stepKey: selectAllDeleteCustomerReview
		$I->selectOption("#reviewGrid_massaction-select", "delete"); // stepKey: clickDeleteActionDropdownDeleteCustomerReview
		$I->click(".admin__grid-massaction-form .action-default.scalable"); // stepKey: clickSubmitDeleteCustomerReview
		$I->waitForElementVisible(".modal-popup.confirm button.action-accept", 30); // stepKey: waitForModalPopUpDeleteCustomerReview
		$I->click(".modal-popup.confirm button.action-accept"); // stepKey: confirmProductDeleteDeleteCustomerReview
		$I->see("record(s) have been deleted.", "#messages div.message-success"); // stepKey: seeSuccessMessageDeleteCustomerReview
		$I->comment("Exiting Action Group [deleteCustomerReview] AdminDeleteReviewsByUserNicknameActionGroup");
		$I->comment("delete Category and Products");
		$I->deleteEntity("createProduct1", "hook"); // stepKey: deleteProduct1
		$I->deleteEntity("createProduct2", "hook"); // stepKey: deleteProduct2
		$I->deleteEntity("category", "hook"); // stepKey: deleteCategory
		$I->comment("Logout");
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
	 * @Stories({"Review By Products"})
	 * @Severity(level = SeverityLevel::MINOR)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminReviewsByProductsReportTest(AcceptanceTester $I)
	{
		$I->comment("Navigate to Marketing > User Content> All Review");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/review/product/index/"); // stepKey: openReviewsPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadCreatedReviewOne
		$I->comment("Entering Action Group [addFirstReview] AdminAddProductReviewActionGroup");
		$I->comment("Click on Add New Review");
		$I->click("#add"); // stepKey: clickOnNewReviewAddFirstReview
		$I->waitForPageLoad(30); // stepKey: clickOnNewReviewAddFirstReviewWaitForPageLoad
		$I->waitForElementVisible("//td[contains(@class,'col-sku')][contains(text(),'" . $I->retrieveEntityField('createProduct1', 'sku', 'test') . "')]", 30); // stepKey: waitForVisibleReviewButtonAddFirstReview
		$I->comment("Select Product by SKU and Create Review");
		$I->click("//td[contains(@class,'col-sku')][contains(text(),'" . $I->retrieveEntityField('createProduct1', 'sku', 'test') . "')]"); // stepKey: addNewReviewBySKUAddFirstReview
		$I->waitForElementVisible("#select_stores", 30); // stepKey: waitForVisibleReviewDetailsAddFirstReview
		$I->selectOption("#select_stores", "Default Store View"); // stepKey: visibilityFieldAddFirstReview
		$I->fillField("#nickname", "user" . msq("simpleProductReview")); // stepKey: fillNicknameFieldAddFirstReview
		$I->fillField("#title", "Review title"); // stepKey: fillSummaryFieldAddFirstReview
		$I->fillField("#detail", "Simple product review"); // stepKey: fillReviewFieldAddFirstReview
		$I->click("#save_button"); // stepKey: clickSubmitReviewAddFirstReview
		$I->waitForElementVisible("div.message-success", 30); // stepKey: waitForSuccessMessageAddFirstReview
		$I->see("You saved the review.", "div.message-success"); // stepKey: seeSuccessMessageAddFirstReview
		$I->comment("Exiting Action Group [addFirstReview] AdminAddProductReviewActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadCreatedReviewTwo
		$I->comment("Entering Action Group [addSecondReview] AdminAddProductReviewActionGroup");
		$I->comment("Click on Add New Review");
		$I->click("#add"); // stepKey: clickOnNewReviewAddSecondReview
		$I->waitForPageLoad(30); // stepKey: clickOnNewReviewAddSecondReviewWaitForPageLoad
		$I->waitForElementVisible("//td[contains(@class,'col-sku')][contains(text(),'" . $I->retrieveEntityField('createProduct2', 'sku', 'test') . "')]", 30); // stepKey: waitForVisibleReviewButtonAddSecondReview
		$I->comment("Select Product by SKU and Create Review");
		$I->click("//td[contains(@class,'col-sku')][contains(text(),'" . $I->retrieveEntityField('createProduct2', 'sku', 'test') . "')]"); // stepKey: addNewReviewBySKUAddSecondReview
		$I->waitForElementVisible("#select_stores", 30); // stepKey: waitForVisibleReviewDetailsAddSecondReview
		$I->selectOption("#select_stores", "Default Store View"); // stepKey: visibilityFieldAddSecondReview
		$I->fillField("#nickname", "user" . msq("simpleProductReview")); // stepKey: fillNicknameFieldAddSecondReview
		$I->fillField("#title", "Review title"); // stepKey: fillSummaryFieldAddSecondReview
		$I->fillField("#detail", "Simple product review"); // stepKey: fillReviewFieldAddSecondReview
		$I->click("#save_button"); // stepKey: clickSubmitReviewAddSecondReview
		$I->waitForElementVisible("div.message-success", 30); // stepKey: waitForSuccessMessageAddSecondReview
		$I->see("You saved the review.", "div.message-success"); // stepKey: seeSuccessMessageAddSecondReview
		$I->comment("Exiting Action Group [addSecondReview] AdminAddProductReviewActionGroup");
		$I->comment("Navigate to Reports > Reviews >By Products");
		$I->comment("Entering Action Group [navigateToReportsByProductsPage] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToReportsByProductsPage
		$I->click("li[data-ui-id='menu-magento-reports-report']"); // stepKey: clickOnMenuItemNavigateToReportsByProductsPage
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToReportsByProductsPageWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-review-report-review-product']"); // stepKey: clickOnSubmenuItemNavigateToReportsByProductsPage
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToReportsByProductsPageWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToReportsByProductsPage] AdminNavigateMenuActionGroup");
		$I->comment("Sort Review Column");
		$grabReviewQuantity = $I->grabTextFrom("//tbody//td[@data-column='review_cnt']"); // stepKey: grabReviewQuantity
		$I->comment("Entering Action Group [navigateToReportsReview] AdminFilterProductReviewActionGroup");
		$I->comment("Sort Review Column in Grid");
		$I->waitForPageLoad(30); // stepKey: waitForGridToAppearNavigateToReportsReview
		$I->fillField("#gridProducts_filter_review_cnt", "$grabReviewQuantity"); // stepKey: searchReviewNavigateToReportsReview
		$I->click("//*[@id='gridProducts']//button[contains(@title, 'Search')]"); // stepKey: startSearchNavigateToReportsReview
		$I->waitForPageLoad(30); // stepKey: waitForResultsNavigateToReportsReview
		$I->see("$grabReviewQuantity", "//tbody//td[@data-column='review_cnt']"); // stepKey: assertReviewColumnNavigateToReportsReview
		$I->comment("Exiting Action Group [navigateToReportsReview] AdminFilterProductReviewActionGroup");
	}
}
