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
 * @Title("MAGETWO-72096: Admin should be able to create an invoice")
 * @Description("Admin should be able to create an invoice<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\AdminCreateInvoiceTest.xml<br>")
 * @TestCaseId("MAGETWO-72096")
 * @group sales
 */
class AdminCreateInvoiceTestCest
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
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createProduct", "hook", "_defaultProduct", ["createCategory"], []); // stepKey: createProduct
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [adminLogout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAdminLogout
		$I->comment("Exiting Action Group [adminLogout] AdminLogoutActionGroup");
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteProduct1
		$I->deleteEntity("createProduct", "hook"); // stepKey: deleteCategory1
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
	 * @Features({"Sales"})
	 * @Stories({"Create an Invoice via the Admin"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateInvoiceTest(AcceptanceTester $I)
	{
		$I->comment("todo: Create an order via the api instead of driving the browser");
		$I->amOnPage("/" . $I->retrieveEntityField('createCategory', 'name', 'test') . ".html"); // stepKey: onCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1
		$I->moveMouseOver(".product-item-info"); // stepKey: hoverProduct
		$I->click("button.action.tocart.primary"); // stepKey: addToCart
		$I->waitForElementVisible("div.message-success", 30); // stepKey: waitForProductAdded
		$I->comment("Entering Action Group [clickCart] StorefrontClickOnMiniCartActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollToTheTopOfThePageClickCart
		$I->waitForElementVisible("a.showcart", 30); // stepKey: waitForElementToBeVisibleClickCart
		$I->waitForPageLoad(60); // stepKey: waitForElementToBeVisibleClickCartWaitForPageLoad
		$I->click("a.showcart"); // stepKey: clickOnMiniCartClickCart
		$I->waitForPageLoad(60); // stepKey: clickOnMiniCartClickCartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoadClickCart
		$I->comment("Exiting Action Group [clickCart] StorefrontClickOnMiniCartActionGroup");
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckout
		$I->waitForPageLoad(30); // stepKey: goToCheckoutWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2
		$I->fillField("#customer-email", msq("CustomerEntityOne") . "test@email.com"); // stepKey: enterEmail
		$I->fillField("input[name=firstname]", "John"); // stepKey: enterFirstName
		$I->fillField("input[name=lastname]", "Doe"); // stepKey: enterLastName
		$I->fillField("input[name='street[0]']", "7700 W Parmer Ln"); // stepKey: enterStreet
		$I->fillField("input[name=city]", "Austin"); // stepKey: enterCity
		$I->selectOption("select[name=region_id]", "Texas"); // stepKey: selectRegion
		$I->fillField("input[name=postcode]", "78729"); // stepKey: enterPostcode
		$I->fillField("input[name=telephone]", "1234568910"); // stepKey: enterTelephone
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask
		$I->click("//*[@id='checkout-shipping-method-load']//input[@class='radio']"); // stepKey: selectFirstShippingMethod
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask2
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButton
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonWaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext
		$I->waitForPageLoad(30); // stepKey: clickNextWaitForPageLoad
		$I->comment("Checkout select Check/Money Order payment");
		$I->comment("Entering Action Group [selectCheckMoneyPayment] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSelectCheckMoneyPayment
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSelectCheckMoneyPayment
		$I->conditionalClick("//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", "//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", true); // stepKey: selectCheckmoPaymentMethodSelectCheckMoneyPayment
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskAfterPaymentMethodSelectionSelectCheckMoneyPayment
		$I->comment("Exiting Action Group [selectCheckMoneyPayment] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->waitForElement(".payment-method._active button.action.primary.checkout", 30); // stepKey: waitForPlaceOrderButton
		$I->waitForPageLoad(30); // stepKey: waitForPlaceOrderButtonWaitForPageLoad
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrder
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrderWaitForPageLoad
		$grabOrderNumber = $I->grabTextFrom("div.checkout-success > p:nth-child(1) > span"); // stepKey: grabOrderNumber
		$I->comment("end todo");
		$I->comment("Entering Action Group [loginAsAdmin1] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin1
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin1
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin1
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin1
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdmin1WaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin1
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin1
		$I->comment("Exiting Action Group [loginAsAdmin1] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: onOrdersPage
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask3
		$I->comment("Entering Action Group [clearGridFilter] ClearFiltersAdminDataGridActionGroup");
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersClearGridFilter
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersClearGridFilterWaitForPageLoad
		$I->comment("Exiting Action Group [clearGridFilter] ClearFiltersAdminDataGridActionGroup");
		$I->fillField("#fulltext", $grabOrderNumber); // stepKey: searchOrderNum
		$I->click(".//*[@id='container']/div/div[2]/div[1]/div[2]/button"); // stepKey: submitSearch
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask4
		$I->comment("Entering Action Group [clickOrderRow] AdminOrderGridClickFirstRowActionGroup");
		$I->click("tr.data-row:nth-of-type(1)"); // stepKey: clickFirstOrderRowClickOrderRow
		$I->waitForPageLoad(30); // stepKey: waitForOrderPageLoadClickOrderRow
		$I->comment("Exiting Action Group [clickOrderRow] AdminOrderGridClickFirstRowActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoice
		$I->waitForPageLoad(30); // stepKey: clickInvoiceWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForNewInvoicePageToLoad
		$I->comment("Entering Action Group [clickSubmitInvoice] AdminInvoiceClickSubmitActionGroup");
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: clickSubmitInvoiceClickSubmitInvoice
		$I->waitForPageLoad(60); // stepKey: clickSubmitInvoiceClickSubmitInvoiceWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForInvoiceToBeCreatedClickSubmitInvoice
		$I->comment("Exiting Action Group [clickSubmitInvoice] AdminInvoiceClickSubmitActionGroup");
		$I->see("The invoice has been created.", "div.message-success:last-of-type"); // stepKey: seeSuccessMessage
		$I->click("#sales_order_view_tabs_order_invoices"); // stepKey: clickInvoices
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask5
		$I->see($grabOrderNumber, "#sales_order_view_tabs_order_invoices_content"); // stepKey: seeInvoice1
		$I->see("John Doe", "#sales_order_view_tabs_order_invoices_content"); // stepKey: seeInvoice2
		$I->click("#sales_order_view_tabs_order_info"); // stepKey: clickInformation
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForOrderInformationTabLoadingMask
		$I->see("Processing", ".order-information table.order-information-table #order_status"); // stepKey: seeOrderStatus
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/invoice/"); // stepKey: goToInvoices
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask6
		$I->comment("Entering Action Group [resetGridInitial] ResetProductGridToDefaultViewActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersResetGridInitial
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersResetGridInitialWaitForPageLoad
		$I->click(".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: openViewBookmarksTabResetGridInitial
		$I->click("//div[contains(@class, 'admin__data-grid-action-bookmarks')]/ul/li/div/a[text() = 'Default View']"); // stepKey: resetToDefaultGridViewResetGridInitial
		$I->waitForPageLoad(30); // stepKey: resetToDefaultGridViewResetGridInitialWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductGridLoadResetGridInitial
		$I->see("Default View", ".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: seeDefaultViewSelectedResetGridInitial
		$I->comment("Exiting Action Group [resetGridInitial] ResetProductGridToDefaultViewActionGroup");
		$I->click("#container > div > div.admin__data-grid-header > div:nth-child(1) > div.data-grid-filters-actions-wrap > div > button"); // stepKey: clickFilters
		$I->fillField("input[name='order_increment_id']", $grabOrderNumber); // stepKey: searchOrderNum2
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFilters
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersWaitForPageLoad
		$I->click("tr.data-row:nth-of-type(1)"); // stepKey: clickInvoice2
		$I->see("Processing", "#order_status"); // stepKey: seeOrderStatus2
	}
}
