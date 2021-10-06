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
 * @Title("MC-15433: Create order status with duplicating label")
 * @Description("Create an order status and get success message<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\AdminCreateOrderStatusDuplicatingLabelTest.xml<br>")
 * @TestCaseId("MC-15433")
 * @group sales
 * @group mtf_migrated
 */
class AdminCreateOrderStatusDuplicatingLabelTestCest
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
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
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
	 * @Stories({"Create order status"})
	 * @Severity(level = SeverityLevel::MINOR)
	 * @Features({"Sales"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateOrderStatusDuplicatingLabelTest(AcceptanceTester $I)
	{
		$I->comment("Go to new order status page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_status"); // stepKey: goToOrderStatusPage
		$I->click("#add"); // stepKey: clickCreateNewStatus
		$I->waitForPageLoad(30); // stepKey: clickCreateNewStatusWaitForPageLoad
		$I->comment("Fill the form and validate message");
		$I->comment("Entering Action Group [fillFormAndClickSave] AdminOrderStatusFormFillAndSave");
		$I->fillField("#edit_form [name=status]", "order_status" . msq("duplicatingLabelOrderStatus")); // stepKey: fillStatusCodeFillFormAndClickSave
		$I->fillField("#edit_form [name=label]", "Suspected Fraud"); // stepKey: fillStatusLabelFillFormAndClickSave
		$I->click("#save"); // stepKey: clickSaveStatusFillFormAndClickSave
		$I->waitForPageLoad(30); // stepKey: clickSaveStatusFillFormAndClickSaveWaitForPageLoad
		$I->comment("Exiting Action Group [fillFormAndClickSave] AdminOrderStatusFormFillAndSave");
		$I->comment("Entering Action Group [seeFormSaveSuccess] AssertOrderStatusFormSaveSuccess");
		$I->see("You saved the order status.", "#messages div.message-success"); // stepKey: seeSuccessSeeFormSaveSuccess
		$I->comment("Exiting Action Group [seeFormSaveSuccess] AssertOrderStatusFormSaveSuccess");
		$I->comment("Verify the order status grid page shows the order status we just created");
		$I->comment("Entering Action Group [searchCreatedOrderStatus] AssertOrderStatusExistsInGrid");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFiltersSearchCreatedOrderStatus
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersSearchCreatedOrderStatusWaitForPageLoad
		$I->fillField("[data-role=filter-form] [name=status]", "order_status" . msq("duplicatingLabelOrderStatus")); // stepKey: fillStatusFilterSearchCreatedOrderStatus
		$I->click(".admin__filter-actions [title='Search']"); // stepKey: clickSearchSearchCreatedOrderStatus
		$I->see("order_status" . msq("duplicatingLabelOrderStatus"), "[data-role=row] [data-column=status]"); // stepKey: seeStatusCodeInGridSearchCreatedOrderStatus
		$I->see("Suspected Fraud", "[data-role=row] [data-column=label]"); // stepKey: seeStatusLabelInGridSearchCreatedOrderStatus
		$I->comment("Exiting Action Group [searchCreatedOrderStatus] AssertOrderStatusExistsInGrid");
	}
}
