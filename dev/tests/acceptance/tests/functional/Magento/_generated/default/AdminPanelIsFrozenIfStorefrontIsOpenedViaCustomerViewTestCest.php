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
 * @Title("https://github.com/magento/magento2/pull/24845: Place an order and click print")
 * @Description("Admin panel is not frozen if Storefront is opened via Customer View<h3>Test files</h3>vendor\magento\module-customer\Test\Mftf\Test\AdminPanelIsFrozenIfStorefrontIsOpenedViaCustomerViewTest.xml<br>")
 * @TestCaseId("https://github.com/magento/magento2/pull/24845")
 * @group customer
 */
class AdminPanelIsFrozenIfStorefrontIsOpenedViaCustomerViewTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->createEntity("simpleCustomer", "hook", "Simple_US_Customer", [], []); // stepKey: simpleCustomer
		$I->createEntity("createSimpleCategory", "hook", "SimpleSubCategory", [], []); // stepKey: createSimpleCategory
		$I->createEntity("createSimpleProduct", "hook", "SimpleProduct", ["createSimpleCategory"], []); // stepKey: createSimpleProduct
		$I->comment("Entering Action Group [login] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLogin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLogin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLogin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLogin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLogin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLogin
		$I->comment("Exiting Action Group [login] AdminLoginActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createSimpleCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteSimpleProduct
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
	 * @Features({"Customer"})
	 * @Stories({"Customer Order"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminPanelIsFrozenIfStorefrontIsOpenedViaCustomerViewTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [navigateToNewOrderPage] NavigateToNewOrderPageExistingCustomerActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: navigateToOrderIndexPageNavigateToNewOrderPage
		$I->waitForPageLoad(30); // stepKey: waitForIndexPageLoadNavigateToNewOrderPage
		$I->see("Orders", ".page-header h1.page-title"); // stepKey: seeIndexPageTitleNavigateToNewOrderPage
		$I->click(".page-actions-buttons button#add"); // stepKey: clickCreateNewOrderNavigateToNewOrderPage
		$I->waitForPageLoad(30); // stepKey: clickCreateNewOrderNavigateToNewOrderPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerGridLoadNavigateToNewOrderPage
		$I->comment("Clear grid filters");
		$I->conditionalClick("#sales_order_create_customer_grid [data-action='grid-filter-reset']", "#sales_order_create_customer_grid [data-action='grid-filter-reset']", true); // stepKey: clearExistingCustomerFiltersNavigateToNewOrderPage
		$I->waitForPageLoad(30); // stepKey: clearExistingCustomerFiltersNavigateToNewOrderPageWaitForPageLoad
		$I->fillField("#sales_order_create_customer_grid_filter_email", $I->retrieveEntityField('simpleCustomer', 'email', 'test')); // stepKey: filterEmailNavigateToNewOrderPage
		$I->click(".action-secondary[title='Search']"); // stepKey: applyFilterNavigateToNewOrderPage
		$I->waitForPageLoad(30); // stepKey: waitForFilteredCustomerGridLoadNavigateToNewOrderPage
		$I->click("tr:nth-of-type(1)[data-role='row']"); // stepKey: clickOnCustomerNavigateToNewOrderPage
		$I->waitForPageLoad(30); // stepKey: waitForCreateOrderPageLoadNavigateToNewOrderPage
		$I->comment("Select store view if appears");
		$I->conditionalClick("//div[contains(@class, 'tree-store-scope')]//label[contains(text(), 'Default Store View')]/preceding-sibling::input", "//div[contains(@class, 'tree-store-scope')]//label[contains(text(), 'Default Store View')]/preceding-sibling::input", true); // stepKey: selectStoreViewIfAppearsNavigateToNewOrderPage
		$I->waitForPageLoad(30); // stepKey: selectStoreViewIfAppearsNavigateToNewOrderPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCreateOrderPageLoadAfterStoreSelectNavigateToNewOrderPage
		$I->see("Create New Order", ".page-header h1.page-title"); // stepKey: seeNewOrderPageTitleNavigateToNewOrderPage
		$I->comment("Exiting Action Group [navigateToNewOrderPage] NavigateToNewOrderPageExistingCustomerActionGroup");
		$I->comment("Entering Action Group [addSecondProduct] AddSimpleProductToOrderActionGroup");
		$I->click("//section[@id='order-items']/div/div/button/span[text() = 'Add Products']"); // stepKey: clickAddProductsAddSecondProduct
		$I->waitForPageLoad(30); // stepKey: clickAddProductsAddSecondProductWaitForPageLoad
		$I->fillField("#sales_order_create_search_grid_filter_sku", $I->retrieveEntityField('createSimpleProduct', 'sku', 'test')); // stepKey: fillSkuFilterAddSecondProduct
		$I->click("#sales_order_create_search_grid [data-action='grid-filter-apply']"); // stepKey: clickSearchAddSecondProduct
		$I->waitForPageLoad(30); // stepKey: clickSearchAddSecondProductWaitForPageLoad
		$I->scrollTo("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]", 0, -100); // stepKey: scrollToCheckColumnAddSecondProduct
		$I->checkOption("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]"); // stepKey: selectProductAddSecondProduct
		$I->fillField("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-qty [name='qty']", "1"); // stepKey: fillProductQtyAddSecondProduct
		$I->scrollTo("#order-search .admin__page-section-title .actions button.action-add", 0, -100); // stepKey: scrollToAddSelectedButtonAddSecondProduct
		$I->waitForPageLoad(30); // stepKey: scrollToAddSelectedButtonAddSecondProductWaitForPageLoad
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: clickAddSelectedProductsAddSecondProduct
		$I->waitForPageLoad(30); // stepKey: clickAddSelectedProductsAddSecondProductWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForOptionsToLoadAddSecondProduct
		$I->comment("Exiting Action Group [addSecondProduct] AddSimpleProductToOrderActionGroup");
		$I->comment("Entering Action Group [fillCustomerInfo] FillOrderCustomerInformationActionGroup");
		$I->fillField("#order-billing_address_firstname", $I->retrieveEntityField('simpleCustomer', 'firstname', 'test')); // stepKey: fillFirstNameFillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillFirstNameFillCustomerInfoWaitForPageLoad
		$I->fillField("#order-billing_address_lastname", $I->retrieveEntityField('simpleCustomer', 'lastname', 'test')); // stepKey: fillLastNameFillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillLastNameFillCustomerInfoWaitForPageLoad
		$I->fillField("#order-billing_address_street0", "7700 West Parmer Lane"); // stepKey: fillStreetLine1FillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillStreetLine1FillCustomerInfoWaitForPageLoad
		$I->fillField("#order-billing_address_city", "Austin"); // stepKey: fillCityFillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillCityFillCustomerInfoWaitForPageLoad
		$I->selectOption("#order-billing_address_country_id", "US"); // stepKey: fillCountryFillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillCountryFillCustomerInfoWaitForPageLoad
		$I->selectOption("#order-billing_address_region_id", "Texas"); // stepKey: fillStateFillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillStateFillCustomerInfoWaitForPageLoad
		$I->fillField("#order-billing_address_postcode", "78729"); // stepKey: fillPostalCodeFillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillPostalCodeFillCustomerInfoWaitForPageLoad
		$I->fillField("#order-billing_address_telephone", "512-345-6789"); // stepKey: fillPhoneFillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillPhoneFillCustomerInfoWaitForPageLoad
		$I->comment("Exiting Action Group [fillCustomerInfo] FillOrderCustomerInformationActionGroup");
		$I->comment("Entering Action Group [selectFlatRate] OrderSelectFlatRateShippingActionGroup");
		$I->click("#order-methods span.title"); // stepKey: unfocusSelectFlatRate
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForJavascriptToFinishSelectFlatRate
		$I->click("#order-shipping_method a.action-default"); // stepKey: clickShippingMethodsSelectFlatRate
		$I->waitForPageLoad(30); // stepKey: clickShippingMethodsSelectFlatRateWaitForPageLoad
		$I->waitForElementVisible("#s_method_flatrate_flatrate", 30); // stepKey: waitForShippingOptionsSelectFlatRate
		$I->waitForPageLoad(30); // stepKey: waitForShippingOptionsSelectFlatRateWaitForPageLoad
		$I->selectOption("#s_method_flatrate_flatrate", "flatrate_flatrate"); // stepKey: checkFlatRateSelectFlatRate
		$I->waitForPageLoad(30); // stepKey: checkFlatRateSelectFlatRateWaitForPageLoad
		$I->comment("Exiting Action Group [selectFlatRate] OrderSelectFlatRateShippingActionGroup");
		$I->comment("Entering Action Group [submitOrder] AdminSubmitOrderActionGroup");
		$I->click("#submit_order_top_button"); // stepKey: submitOrderSubmitOrder
		$I->waitForPageLoad(60); // stepKey: submitOrderSubmitOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSubmitOrder
		$I->see("You created the order."); // stepKey: seeSuccessMessageForOrderSubmitOrder
		$I->comment("Exiting Action Group [submitOrder] AdminSubmitOrderActionGroup");
		$getOrderId = $I->grabTextFrom("|Order # (\d+)|"); // stepKey: getOrderId
		$I->comment("Entering Action Group [startCreateInvoice] StartCreateInvoiceFromOrderPageActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoiceActionStartCreateInvoice
		$I->waitForPageLoad(30); // stepKey: clickInvoiceActionStartCreateInvoiceWaitForPageLoad
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_invoice/new/order_id/"); // stepKey: seeNewInvoiceUrlStartCreateInvoice
		$I->see("New Invoice", ".page-header h1.page-title"); // stepKey: seeNewInvoicePageTitleStartCreateInvoice
		$I->comment("Exiting Action Group [startCreateInvoice] StartCreateInvoiceFromOrderPageActionGroup");
		$I->comment("Entering Action Group [submitInvoice] SubmitInvoiceActionGroup");
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: clickSubmitInvoiceSubmitInvoice
		$I->waitForPageLoad(60); // stepKey: clickSubmitInvoiceSubmitInvoiceWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForMessageAppearsSubmitInvoice
		$I->see("The invoice has been created.", "#messages div.message-success"); // stepKey: seeInvoiceCreateSuccessSubmitInvoice
		$grabOrderIdSubmitInvoice = $I->grabFromCurrentUrl("~/order_id/(\d+)/~"); // stepKey: grabOrderIdSubmitInvoice
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/view/order_id/"); // stepKey: seeViewOrderPageInvoiceSubmitInvoice
		$I->comment("Exiting Action Group [submitInvoice] SubmitInvoiceActionGroup");
		$I->comment("Entering Action Group [goToShipment] GoToShipmentIntoOrderActionGroup");
		$I->click("#order_ship"); // stepKey: clickShipActionGoToShipment
		$I->waitForPageLoad(30); // stepKey: clickShipActionGoToShipmentWaitForPageLoad
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/order_shipment/new/order_id/"); // stepKey: seeOrderShipmentUrlGoToShipment
		$I->see("New Shipment", ".page-header h1.page-title"); // stepKey: seePageNameNewInvoicePageGoToShipment
		$I->comment("Exiting Action Group [goToShipment] GoToShipmentIntoOrderActionGroup");
		$I->comment("Entering Action Group [submitShipment] SubmitShipmentIntoOrderActionGroup");
		$I->click("button.action-default.save.submit-button"); // stepKey: clickSubmitShipmentSubmitShipment
		$I->waitForPageLoad(60); // stepKey: clickSubmitShipmentSubmitShipmentWaitForPageLoad
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/view/order_id/"); // stepKey: seeViewOrderPageShippingSubmitShipment
		$I->see("The shipment has been created.", "div.message-success:last-of-type"); // stepKey: seeShipmentCreateSuccessSubmitShipment
		$I->comment("Exiting Action Group [submitShipment] SubmitShipmentIntoOrderActionGroup");
		$I->comment("Create Credit Memo");
		$I->comment("Entering Action Group [startToCreateCreditMemo] StartToCreateCreditMemoActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/view/order_id/{$getOrderId}"); // stepKey: navigateToOrderPageStartToCreateCreditMemo
		$I->click("#order_creditmemo"); // stepKey: clickCreditMemoStartToCreateCreditMemo
		$I->waitForPageLoad(30); // stepKey: clickCreditMemoStartToCreateCreditMemoWaitForPageLoad
		$I->waitForElementVisible(".page-header h1.page-title", 30); // stepKey: waitForPageTitleStartToCreateCreditMemo
		$I->see("New Memo", ".page-header h1.page-title"); // stepKey: seeNewMemoPageTitleStartToCreateCreditMemo
		$I->comment("Exiting Action Group [startToCreateCreditMemo] StartToCreateCreditMemoActionGroup");
		$I->comment("Entering Action Group [submitCreditMemo] SubmitCreditMemoActionGroup");
		$grabOrderIdSubmitCreditMemo = $I->grabFromCurrentUrl("~/order_id/(\d+)/~"); // stepKey: grabOrderIdSubmitCreditMemo
		$I->waitForElementVisible(".order-totals-actions button[data-ui-id='order-items-submit-button']:not(.disabled)", 30); // stepKey: waitButtonEnabledSubmitCreditMemo
		$I->waitForPageLoad(60); // stepKey: waitButtonEnabledSubmitCreditMemoWaitForPageLoad
		$I->click(".order-totals-actions button[data-ui-id='order-items-submit-button']:not(.disabled)"); // stepKey: clickSubmitCreditMemoSubmitCreditMemo
		$I->waitForPageLoad(60); // stepKey: clickSubmitCreditMemoSubmitCreditMemoWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForMessageAppearsSubmitCreditMemo
		$I->see("You created the credit memo.", "#messages div.message-success"); // stepKey: seeCreditMemoCreateSuccessSubmitCreditMemo
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/view/order_id/$grabOrderIdSubmitCreditMemo"); // stepKey: seeViewOrderPageCreditMemoSubmitCreditMemo
		$I->comment("Exiting Action Group [submitCreditMemo] SubmitCreditMemoActionGroup");
		$I->comment("Entering Action Group [logInCustomer] LoginToStorefrontActionGroup");
		$I->amOnPage("/customer/account/login/"); // stepKey: amOnSignInPageLogInCustomer
		$I->waitForPageLoad(30); // stepKey: waitPageFullyLoadedLogInCustomer
		$I->waitForElementVisible("#email", 30); // stepKey: waitFormAppearsLogInCustomer
		$I->fillField("#email", $I->retrieveEntityField('simpleCustomer', 'email', 'test')); // stepKey: fillEmailLogInCustomer
		$I->fillField("#pass", $I->retrieveEntityField('simpleCustomer', 'password', 'test')); // stepKey: fillPasswordLogInCustomer
		$I->click("#send2"); // stepKey: clickSignInAccountButtonLogInCustomer
		$I->waitForPageLoad(30); // stepKey: clickSignInAccountButtonLogInCustomerWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerLoggedInLogInCustomer
		$I->comment("Exiting Action Group [logInCustomer] LoginToStorefrontActionGroup");
		$I->comment("Entering Action Group [goToMyOrdersPage] StorefrontCustomerGoToSidebarMenu");
		$I->click("//div[@id='block-collapsible-nav']//a[text()='My Orders']"); // stepKey: goToAddressBookGoToMyOrdersPage
		$I->waitForPageLoad(60); // stepKey: goToAddressBookGoToMyOrdersPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadGoToMyOrdersPage
		$I->comment("Exiting Action Group [goToMyOrdersPage] StorefrontCustomerGoToSidebarMenu");
		$I->click("//td[contains(concat(' ',normalize-space(@class),' '),' col actions ')]/a[contains(concat(' ',normalize-space(@class),' '),' action view ')]"); // stepKey: clickViewOrder
		$I->click("a.action.print"); // stepKey: clickPrintOrderLink
		$I->waitForPageLoad(30); // stepKey: clickPrintOrderLinkWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitPageReload
		$I->switchToWindow(); // stepKey: switchToWindow
		$I->switchToPreviousTab(); // stepKey: switchToPreviousTab
		$I->comment("Entering Action Group [goToAddressBook] StorefrontCustomerGoToSidebarMenu");
		$I->click("//div[@id='block-collapsible-nav']//a[text()='Address Book']"); // stepKey: goToAddressBookGoToAddressBook
		$I->waitForPageLoad(60); // stepKey: goToAddressBookGoToAddressBookWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadGoToAddressBook
		$I->comment("Exiting Action Group [goToAddressBook] StorefrontCustomerGoToSidebarMenu");
		$I->see("7700 West Parmer Lane Austin, Texas, 78729", "//*[@class='box box-address-shipping']//address"); // stepKey: checkShippingAddress
	}
}
