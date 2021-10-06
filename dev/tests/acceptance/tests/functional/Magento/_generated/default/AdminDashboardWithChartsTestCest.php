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
 * @Title("MAGETWO-98934: Admin should see Google chart on Magento dashboard")
 * @Description("Google chart on Magento dashboard page is displaying properly<h3>Test files</h3>vendor\magento\module-backend\Test\Mftf\Test\AdminDashboardWithChartsTest.xml<br>")
 * @TestCaseId("MAGETWO-98934")
 * @group backend
 */
class AdminDashboardWithChartsTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$setEnableCharts = $I->magentoCLI("config:set admin/dashboard/enable_charts 1", 60); // stepKey: setEnableCharts
		$I->comment($setEnableCharts);
		$createProductFields['price'] = "150";
		$I->createEntity("createProduct", "hook", "SimpleProduct2", [], $createProductFields); // stepKey: createProduct
		$createCustomerFields['firstname'] = "John1";
		$createCustomerFields['lastname'] = "Doe1";
		$I->createEntity("createCustomer", "hook", "Simple_US_Customer", [], $createCustomerFields); // stepKey: createCustomer
		$runCronIndex = $I->magentoCron("index", 90); // stepKey: runCronIndex
		$I->comment($runCronIndex);
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Reset admin order filter");
		$I->comment("Reset admin order filter");
		$I->comment("Entering Action Group [clearOrderFilters] AdminOrdersGridClearFiltersActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: goToGridOrdersPageClearOrderFilters
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoadClearOrderFilters
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header .admin__data-grid-filters-current._show", true); // stepKey: clickOnButtonToRemoveFiltersIfPresentClearOrderFilters
		$I->comment("Exiting Action Group [clearOrderFilters] AdminOrdersGridClearFiltersActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingOrderGrid
		$setDisableChartsAsDefault = $I->magentoCLI("config:set admin/dashboard/enable_charts 0", 60); // stepKey: setDisableChartsAsDefault
		$I->comment($setDisableChartsAsDefault);
		$I->deleteEntity("createProduct", "hook"); // stepKey: deleteProduct
		$I->deleteEntity("createCustomer", "hook"); // stepKey: deleteCustomer
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
	 * @Stories({"Google Charts on Magento dashboard"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminDashboardWithChartsTest(AcceptanceTester $I)
	{
		$I->comment("Login as admin");
		$I->comment("Login as admin");
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->comment("Grab quantity value");
		$I->comment("Grab quantity value from dashboard");
		$grabStartQuantity = $I->grabTextFrom("//*[@class='dashboard-totals-label' and contains(text(), 'Quantity')]/../*[@class='dashboard-totals-value']"); // stepKey: grabStartQuantity
		$I->comment("Login as customer");
		$I->comment("Login as customer");
		$I->comment("Entering Action Group [customerLogin] LoginToStorefrontActionGroup");
		$I->amOnPage("/customer/account/login/"); // stepKey: amOnSignInPageCustomerLogin
		$I->waitForPageLoad(30); // stepKey: waitPageFullyLoadedCustomerLogin
		$I->waitForElementVisible("#email", 30); // stepKey: waitFormAppearsCustomerLogin
		$I->fillField("#email", $I->retrieveEntityField('createCustomer', 'email', 'test')); // stepKey: fillEmailCustomerLogin
		$I->fillField("#pass", $I->retrieveEntityField('createCustomer', 'password', 'test')); // stepKey: fillPasswordCustomerLogin
		$I->click("#send2"); // stepKey: clickSignInAccountButtonCustomerLogin
		$I->waitForPageLoad(30); // stepKey: clickSignInAccountButtonCustomerLoginWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerLoggedInCustomerLogin
		$I->comment("Exiting Action Group [customerLogin] LoginToStorefrontActionGroup");
		$I->comment("Add Product to Shopping Cart");
		$I->comment("Add product to the shopping cart");
		$I->amOnPage("/" . $I->retrieveEntityField('createProduct', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: navigateToSimpleProductPage
		$I->waitForPageLoad(30); // stepKey: waitForProductPageLoad
		$I->comment("Entering Action Group [addToCartFromStorefrontProductPage] AddToCartFromStorefrontProductPageActionGroup");
		$I->click("#product-addtocart-button"); // stepKey: addToCartAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(60); // stepKey: addToCartAddToCartFromStorefrontProductPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAddToCartAddToCartFromStorefrontProductPage
		$I->waitForElementNotVisible("//button/span[text()='Adding...']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddingAddToCartFromStorefrontProductPage
		$I->waitForElementNotVisible("//button/span[text()='Added']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddedAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddToCartFromStorefrontProductPage
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageAddToCartFromStorefrontProductPage
		$I->see("You added " . $I->retrieveEntityField('createProduct', 'name', 'test') . " to your shopping cart.", "div.message-success.success.message"); // stepKey: seeAddToCartSuccessMessageAddToCartFromStorefrontProductPage
		$I->comment("Exiting Action Group [addToCartFromStorefrontProductPage] AddToCartFromStorefrontProductPageActionGroup");
		$I->comment("Go to Checkout");
		$I->comment("Go to checkout");
		$I->comment("Entering Action Group [goToCheckoutFromMinicart] GoToCheckoutFromMinicartActionGroup");
		$I->waitForElementNotVisible(".counter.qty.empty", 30); // stepKey: waitUpdateQuantityGoToCheckoutFromMinicart
		$I->wait(5); // stepKey: waitMinicartRenderingGoToCheckoutFromMinicart
		$I->click("a.showcart"); // stepKey: clickCartGoToCheckoutFromMinicart
		$I->waitForPageLoad(60); // stepKey: clickCartGoToCheckoutFromMinicartWaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutGoToCheckoutFromMinicart
		$I->waitForPageLoad(30); // stepKey: goToCheckoutGoToCheckoutFromMinicartWaitForPageLoad
		$I->comment("Exiting Action Group [goToCheckoutFromMinicart] GoToCheckoutFromMinicartActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingCheckoutPageWithShippingMethod
		$I->click("//*[@id='checkout-shipping-method-load']//input[@class='radio']"); // stepKey: selectFirstShippingMethod
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask1
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButton
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonWaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext
		$I->waitForPageLoad(30); // stepKey: clickNextWaitForPageLoad
		$I->comment("Checkout select Check/Money Order payment");
		$I->comment("Select Check/Money payment");
		$I->comment("Entering Action Group [selectCheckMoneyPayment] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSelectCheckMoneyPayment
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSelectCheckMoneyPayment
		$I->conditionalClick("//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", "//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", true); // stepKey: selectCheckmoPaymentMethodSelectCheckMoneyPayment
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskAfterPaymentMethodSelectionSelectCheckMoneyPayment
		$I->comment("Exiting Action Group [selectCheckMoneyPayment] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->comment("Place Order");
		$I->comment("Place order");
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrder
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrderWaitForPageLoad
		$I->see("Thank you for your purchase!", ".page-title"); // stepKey: seeSuccessTitle
		$I->see("Your order number is: ", ".checkout-success > p:nth-child(1)"); // stepKey: seeOrderNumber
		$grabOrderNumber = $I->grabTextFrom(".order-number>strong"); // stepKey: grabOrderNumber
		$I->comment("Search for Order in the order grid");
		$I->comment("Search for Order in the order grid");
		$I->comment("Entering Action Group [filterOrderGridById] FilterOrderGridByIdActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: navigateToOrderGridPageFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: waitForOrdersPageFilterOrderGridById
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersFilterOrderGridByIdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClearFiltersFilterOrderGridById
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openOrderGridFiltersFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: openOrderGridFiltersFilterOrderGridByIdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickFiltersFilterOrderGridById
		$I->fillField(".admin__data-grid-filters input[name='increment_id']", "$grabOrderNumber"); // stepKey: fillOrderIdFilterFilterOrderGridById
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickOrderApplyFiltersFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: clickOrderApplyFiltersFilterOrderGridByIdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForApplyFiltersFilterOrderGridById
		$I->comment("Exiting Action Group [filterOrderGridById] FilterOrderGridByIdActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForSearchingOrder
		$I->comment("Create invoice");
		$I->comment("Create invoice");
		$I->comment("Entering Action Group [clickOrderRow] AdminOrderGridClickFirstRowActionGroup");
		$I->click("tr.data-row:nth-of-type(1)"); // stepKey: clickFirstOrderRowClickOrderRow
		$I->waitForPageLoad(30); // stepKey: waitForOrderPageLoadClickOrderRow
		$I->comment("Exiting Action Group [clickOrderRow] AdminOrderGridClickFirstRowActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoiceButton
		$I->waitForPageLoad(30); // stepKey: clickInvoiceButtonWaitForPageLoad
		$I->see("New Invoice", ".page-header h1.page-title"); // stepKey: seeNewInvoiceInPageTitle
		$I->waitForPageLoad(30); // stepKey: waitForInvoicePageToLoad
		$I->see("$150.00", "//table[contains(@class,'order-subtotal-table')]/tbody/tr/td[contains(text(), 'Subtotal')]/following-sibling::td/span/span[contains(@class, 'price')]"); // stepKey: seeCorrectGrandTotal
		$I->comment("Entering Action Group [clickSubmitInvoice] AdminInvoiceClickSubmitActionGroup");
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: clickSubmitInvoiceClickSubmitInvoice
		$I->waitForPageLoad(60); // stepKey: clickSubmitInvoiceClickSubmitInvoiceWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForInvoiceToBeCreatedClickSubmitInvoice
		$I->comment("Exiting Action Group [clickSubmitInvoice] AdminInvoiceClickSubmitActionGroup");
		$I->see("The invoice has been created.", "div.message-success:last-of-type"); // stepKey: seeSuccessInvoiceMessage
		$I->comment("Create Shipment for the order");
		$I->comment("Create Shipment for the order");
		$I->comment("Entering Action Group [onOrdersPage2] AdminOrdersPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: openOrdersGridPageOnOrdersPage2
		$I->waitForPageLoad(30); // stepKey: waitForLoadingPageOnOrdersPage2
		$I->comment("Exiting Action Group [onOrdersPage2] AdminOrdersPageOpenActionGroup");
		$I->comment("Entering Action Group [openOrderPageForShip] AdminOrderGridClickFirstRowActionGroup");
		$I->click("tr.data-row:nth-of-type(1)"); // stepKey: clickFirstOrderRowOpenOrderPageForShip
		$I->waitForPageLoad(30); // stepKey: waitForOrderPageLoadOpenOrderPageForShip
		$I->comment("Exiting Action Group [openOrderPageForShip] AdminOrderGridClickFirstRowActionGroup");
		$I->click("#order_ship"); // stepKey: clickShipAction
		$I->waitForPageLoad(30); // stepKey: clickShipActionWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShipmentPagePage
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/order_shipment/new/order_id/"); // stepKey: seeOrderShipmentUrl
		$I->comment("Submit Shipment");
		$I->comment("Submit Shipment");
		$I->click("button.action-default.save.submit-button"); // stepKey: clickSubmitShipment
		$I->waitForPageLoad(60); // stepKey: clickSubmitShipmentWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShipmentSubmit
		$I->see("The shipment has been created.", "div.message-success:last-of-type"); // stepKey: seeShipmentCreateSuccess
		$I->comment("Go to dashboard page");
		$I->comment("Go to dashboard page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/dotdigitalgroup_email/dashboard"); // stepKey: amOnDashboardPage
		$I->waitForPageLoad(30); // stepKey: waitForDashboardPageLoad4
		$I->comment("Grab quantity value");
		$I->comment("Grab quantity value from dashboard at the end");
		$grabEndQuantity = $I->grabTextFrom("//*[@class='dashboard-totals-label' and contains(text(), 'Quantity')]/../*[@class='dashboard-totals-value']"); // stepKey: grabEndQuantity
		$I->comment("Assert that page is not broken");
		$I->comment("Assert that dashboard page is not broken");
		$I->seeElement("#diagram_tab_orders_content"); // stepKey: seeOrderContentTab
		$I->seeElement("#diagram_tab_content"); // stepKey: seeDiagramContent
		$I->click("#diagram_tab_amounts"); // stepKey: clickDashboardAmount
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForDashboardAmountLoading
		$I->seeElement("#diagram_tab_amounts_content"); // stepKey: seeDiagramAmountContent
		$I->seeElement("#diagram_tab_amounts_content"); // stepKey: seeAmountTotals
		$I->dontSeeJsError(); // stepKey: dontSeeJsError
		$I->assertGreaterThan($grabStartQuantity, $grabEndQuantity); // stepKey: checkQuantityWasChanged
	}
}
