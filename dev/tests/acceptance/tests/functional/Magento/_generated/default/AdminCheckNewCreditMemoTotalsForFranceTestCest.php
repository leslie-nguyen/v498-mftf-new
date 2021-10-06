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
 * @Title("[NO TESTCASEID]: Credit memo entity for France locale")
 * @Description("Create Credit Memo with cash on delivery payment and assert 0 shipping refund for France locale<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\AdminCheckNewCreditMemoTotalsForFranceTest.xml<br>")
 * @group sales
 */
class AdminCheckNewCreditMemoTotalsForFranceTestCest
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
		$deployStaticContentWithFrenchLocale = $I->magentoCLI("setup:static-content:deploy fr_FR", 60); // stepKey: deployStaticContentWithFrenchLocale
		$I->comment($deployStaticContentWithFrenchLocale);
		$I->comment("Entering Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->comment("Entering Action Group [setAdminInterfaceLocaleToFrance] SetAdminAccountActionGroup");
		$I->comment("Navigate to admin System Account Page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_account/index/"); // stepKey: openAdminSystemAccountPageSetAdminInterfaceLocaleToFrance
		$I->waitForElementVisible("#interface_locale", 30); // stepKey: waitForInterfaceLocaleSetAdminInterfaceLocaleToFrance
		$I->comment("Change Admin locale to Français (France) / French (France)");
		$I->selectOption("#interface_locale", "fr_FR"); // stepKey: setInterfaceLocateSetAdminInterfaceLocaleToFrance
		$I->fillField("#current_password", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordSetAdminInterfaceLocaleToFrance
		$I->click("#save"); // stepKey: clickSaveSetAdminInterfaceLocaleToFrance
		$I->waitForPageLoad(30); // stepKey: clickSaveSetAdminInterfaceLocaleToFranceWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitSuccessMessageSetAdminInterfaceLocaleToFrance
		$I->see("You saved the account.", "#messages div.message-success"); // stepKey: seeSuccessMessageSetAdminInterfaceLocaleToFrance
		$I->comment("Exiting Action Group [setAdminInterfaceLocaleToFrance] SetAdminAccountActionGroup");
		$I->comment("Create Data");
		$I->createEntity("createCustomer", "hook", "Simple_US_Customer", [], []); // stepKey: createCustomer
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createProduct", "hook", "defaultSimpleProduct", ["createCategory"], []); // stepKey: createProduct
		$I->comment("Enable payment method one of \"Check/Money Order\", \"Cash On Delivery Payment\" and  shipping method one of \"Flat Rate\"");
		$enableCheckMoneyOrder = $I->magentoCLI("config:set payment/checkmo/active 1", 60); // stepKey: enableCheckMoneyOrder
		$I->comment($enableCheckMoneyOrder);
		$enableBankTransfer = $I->magentoCLI("config:set payment/cashondelivery/active 1", 60); // stepKey: enableBankTransfer
		$I->comment($enableBankTransfer);
		$I->createEntity("enableFlatRate", "hook", "FlatRateShippingMethodConfig", [], []); // stepKey: enableFlatRate
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$disableBankTransfer = $I->magentoCLI("config:set payment/cashondelivery/active 0", 60); // stepKey: disableBankTransfer
		$I->comment($disableBankTransfer);
		$I->comment("Delete data");
		$I->deleteEntity("createCustomer", "hook"); // stepKey: deleteCustomer
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("createProduct", "hook"); // stepKey: deleteProduct
		$I->comment("Entering Action Group [setAdminInterfaceLocaleToDefaultValue] SetAdminAccountActionGroup");
		$I->comment("Navigate to admin System Account Page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_account/index/"); // stepKey: openAdminSystemAccountPageSetAdminInterfaceLocaleToDefaultValue
		$I->waitForElementVisible("#interface_locale", 30); // stepKey: waitForInterfaceLocaleSetAdminInterfaceLocaleToDefaultValue
		$I->comment("Change Admin locale to Français (France) / French (France)");
		$I->selectOption("#interface_locale", "en_US"); // stepKey: setInterfaceLocateSetAdminInterfaceLocaleToDefaultValue
		$I->fillField("#current_password", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordSetAdminInterfaceLocaleToDefaultValue
		$I->click("#save"); // stepKey: clickSaveSetAdminInterfaceLocaleToDefaultValue
		$I->waitForPageLoad(30); // stepKey: clickSaveSetAdminInterfaceLocaleToDefaultValueWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitSuccessMessageSetAdminInterfaceLocaleToDefaultValue
		$I->see("You saved the account.", "#messages div.message-success"); // stepKey: seeSuccessMessageSetAdminInterfaceLocaleToDefaultValue
		$I->comment("Exiting Action Group [setAdminInterfaceLocaleToDefaultValue] SetAdminAccountActionGroup");
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
	 * @Stories({"Credit memo entity for France locale"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Features({"Sales"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCheckNewCreditMemoTotalsForFranceTest(AcceptanceTester $I)
	{
		$I->comment("Create Order");
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
		$I->fillField("#sales_order_create_customer_grid_filter_email", $I->retrieveEntityField('createCustomer', 'email', 'test')); // stepKey: filterEmailNavigateToNewOrderPage
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
		$I->fillField("#sales_order_create_search_grid_filter_sku", $I->retrieveEntityField('createProduct', 'sku', 'test')); // stepKey: fillSkuFilterAddSecondProduct
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
		$I->fillField("#order-billing_address_firstname", $I->retrieveEntityField('createCustomer', 'firstname', 'test')); // stepKey: fillFirstNameFillCustomerInfo
		$I->waitForPageLoad(30); // stepKey: fillFirstNameFillCustomerInfoWaitForPageLoad
		$I->fillField("#order-billing_address_lastname", $I->retrieveEntityField('createCustomer', 'lastname', 'test')); // stepKey: fillLastNameFillCustomerInfo
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
		$I->conditionalClick("#order-billing_method_summary>a", "#order-billing_method_summary>a", true); // stepKey: openMoneyOption
		$I->waitForElementVisible("#order-billing_method", 30); // stepKey: waitForPaymentOptions
		$I->checkOption("#p_method_cashondelivery"); // stepKey: checkCashOnDelivery
		$I->waitForPageLoad(30); // stepKey: checkCashOnDeliveryWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForDisappear
		$I->click("#submit_order_top_button"); // stepKey: submitOrder
		$I->waitForPageLoad(60); // stepKey: submitOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSubmitOrderPage
		$I->see("You created the order."); // stepKey: seeSuccessMessageForOrder
		$I->comment("Create Invoice");
		$I->comment("Entering Action Group [startInvoice] StartCreateInvoiceFromOrderPageActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoiceActionStartInvoice
		$I->waitForPageLoad(30); // stepKey: clickInvoiceActionStartInvoiceWaitForPageLoad
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_invoice/new/order_id/"); // stepKey: seeNewInvoiceUrlStartInvoice
		$I->see("New Invoice", ".page-header h1.page-title"); // stepKey: seeNewInvoicePageTitleStartInvoice
		$I->comment("Exiting Action Group [startInvoice] StartCreateInvoiceFromOrderPageActionGroup");
		$I->comment("Entering Action Group [clickSubmitInvoice] AdminInvoiceClickSubmitActionGroup");
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: clickSubmitInvoiceClickSubmitInvoice
		$I->waitForPageLoad(60); // stepKey: clickSubmitInvoiceClickSubmitInvoiceWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForInvoiceToBeCreatedClickSubmitInvoice
		$I->comment("Exiting Action Group [clickSubmitInvoice] AdminInvoiceClickSubmitActionGroup");
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForMessageAppears
		$I->see("The invoice has been created.", "#messages div.message-success"); // stepKey: seeInvoiceCreateSuccess
		$I->comment("Go to Sales > Orders > find out placed order and open");
		$grabOrderId = $I->grabTextFrom("|Order # (\d+)|"); // stepKey: grabOrderId
		$I->assertNotEmpty($grabOrderId); // stepKey: assertOrderIdIsNotEmpty
		$I->comment("Entering Action Group [openOrder] OpenOrderByIdActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: navigateToOrderGridPageOpenOrder
		$I->waitForPageLoad(30); // stepKey: waitForOrdersPageOpenOrder
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersOpenOrder
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersOpenOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClearFiltersOpenOrder
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openOrderGridFiltersOpenOrder
		$I->waitForPageLoad(30); // stepKey: openOrderGridFiltersOpenOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickFiltersOpenOrder
		$I->fillField(".admin__data-grid-filters input[name='increment_id']", $grabOrderId); // stepKey: fillOrderIdFilterOpenOrder
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickOrderApplyFiltersOpenOrder
		$I->waitForPageLoad(30); // stepKey: clickOrderApplyFiltersOpenOrderWaitForPageLoad
		$I->click("tr.data-row:nth-of-type(1)"); // stepKey: openOrderViewPageOpenOrder
		$I->waitForPageLoad(60); // stepKey: openOrderViewPageOpenOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForOrderViewPageOpenedOpenOrder
		$I->waitForPageLoad(30); // stepKey: waitForApplyFiltersOpenOrder
		$I->comment("Exiting Action Group [openOrder] OpenOrderByIdActionGroup");
		$I->comment("Click 'Credit Memo' button and fill data from dataset: refund");
		$I->comment("Entering Action Group [fillCreditMemoRefund] AdminOpenAndFillCreditMemoRefundActionGroup");
		$I->comment("Click 'Credit Memo' button");
		$I->click("#order_creditmemo"); // stepKey: clickCreateCreditMemoFillCreditMemoRefund
		$I->waitForPageLoad(30); // stepKey: clickCreateCreditMemoFillCreditMemoRefundWaitForPageLoad
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_creditmemo/new/order_id/"); // stepKey: seeNewCreditMemoPageFillCreditMemoRefund
		$I->see("New Memo", ".page-header h1.page-title"); // stepKey: seeNewMemoInPageTitleFillCreditMemoRefund
		$I->comment("Fill data from dataset: refund");
		$I->scrollTo("#creditmemo_item_container span.title"); // stepKey: scrollToItemsToRefundFillCreditMemoRefund
		$I->fillField(".order-creditmemo-tables tbody:nth-of-type(1) .col-refund .qty-input", "1"); // stepKey: fillQtyToRefundFillCreditMemoRefund
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForActivateButtonFillCreditMemoRefund
		$I->conditionalClick(".order-creditmemo-tables tfoot button[data-ui-id='order-items-update-button']", ".order-creditmemo-tables tfoot button[data-ui-id='order-items-update-button'].disabled", false); // stepKey: clickUpdateButtonFillCreditMemoRefund
		$I->waitForPageLoad(30); // stepKey: clickUpdateButtonFillCreditMemoRefundWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForUpdateFillCreditMemoRefund
		$I->fillField(".order-subtotal-table tbody input[name='creditmemo[shipping_amount]']", "0"); // stepKey: fillShippingFillCreditMemoRefund
		$I->fillField(".order-subtotal-table tbody input[name='creditmemo[adjustment_positive]']", "5,31"); // stepKey: fillAdjustmentRefundFillCreditMemoRefund
		$I->fillField(".order-subtotal-table tbody input[name='creditmemo[adjustment_negative]']", "10,31"); // stepKey: fillAdjustmentFeeFillCreditMemoRefund
		$I->waitForElementVisible(".update-totals-button", 30); // stepKey: waitForUpdateTotalsButtonFillCreditMemoRefund
		$I->waitForPageLoad(30); // stepKey: waitForUpdateTotalsButtonFillCreditMemoRefundWaitForPageLoad
		$I->click(".update-totals-button"); // stepKey: clickUpdateTotalsFillCreditMemoRefund
		$I->waitForPageLoad(30); // stepKey: clickUpdateTotalsFillCreditMemoRefundWaitForPageLoad
		$I->checkOption(".order-totals-actions #send_email"); // stepKey: checkSendEmailCopyFillCreditMemoRefund
		$I->comment("Exiting Action Group [fillCreditMemoRefund] AdminOpenAndFillCreditMemoRefundActionGroup");
		$I->comment("Entering Action Group [assertCreditMemoRefundTotals] AssertAdminCreditMemoNewPageTotalsActionGroup");
		$I->seeInField(".order-subtotal-table tbody input[name='creditmemo[shipping_amount]']", "0,00"); // stepKey: seeRefundShippingAssertCreditMemoRefundTotals
		$I->seeInField(".order-subtotal-table tbody input[name='creditmemo[adjustment_positive]']", "5,31"); // stepKey: seeAdjustmentRefundAssertCreditMemoRefundTotals
		$I->seeInField(".order-subtotal-table tbody input[name='creditmemo[adjustment_negative]']", "10,31"); // stepKey: seeAdjustmentFeeAssertCreditMemoRefundTotals
		$I->see("555,00", ".order-subtotal-table tfoot tr.col-0>td span.price"); // stepKey: seeGrandTotalAssertCreditMemoRefundTotals
		$I->comment("Exiting Action Group [assertCreditMemoRefundTotals] AssertAdminCreditMemoNewPageTotalsActionGroup");
		$I->comment("On order's page click 'Refund offline' button");
		$I->click(".order-totals-actions button[data-ui-id='order-items-submit-button']"); // stepKey: clickRefundOffline
		$I->waitForPageLoad(60); // stepKey: clickRefundOfflineWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForResultPage
		$I->comment("Perform all assertions: assert refund success create message");
		$I->see("You created the credit memo.", "//*[@data-ui-id='messages-message-success']"); // stepKey: assertRefundSuccessCreateMessage
		$I->waitForPageLoad(120); // stepKey: assertRefundSuccessCreateMessageWaitForPageLoad
		$I->comment("Assert refund in Credit Memo Tab");
		$I->click("#sales_order_view_tabs_order_creditmemos"); // stepKey: clickCreditMemoTab
		$I->waitForPageLoad(30); // stepKey: waitForTabLoad
		$grabMemoId = $I->grabTextFrom("//*[@id='sales_order_view_tabs_order_creditmemos_content']//tbody/tr/td[2]/div"); // stepKey: grabMemoId
		$I->assertNotEmpty($grabMemoId); // stepKey: assertMemoIdIsNotEmpty
		$I->click("//*[@id='sales_order_view_tabs_order_creditmemos_content']//tbody/tr/td[2]/div"); // stepKey: clickView
		$I->waitForPageLoad(30); // stepKey: waitForCreditMemo
		$I->scrollTo("//td[contains(text(), 'Subtotal')]/following-sibling::td//span[@class='price']"); // stepKey: scrollToTotal
		$I->comment("Entering Action Group [assertCreditMemoViewPageTotals] AssertAdminCreditMemoViewPageTotalsActionGroup");
		$I->see("560,00", "//td[contains(text(), 'Subtotal')]/following-sibling::td//span[@class='price']"); // stepKey: seeSubtotalAssertCreditMemoViewPageTotals
		$I->see("5,31", "//td[contains(text(), 'Adjustment Refund')]/following-sibling::td//span[@class='price']"); // stepKey: seeAdjustmentRefundAssertCreditMemoViewPageTotals
		$I->see("10,31", "//td[contains(text(), 'Adjustment Fee')]/following-sibling::td//span[@class='price']"); // stepKey: seeAdjustmentFeeAssertCreditMemoViewPageTotals
		$I->see("555,00", ".order-subtotal-table tfoot tr.col-0>td span.price"); // stepKey: seeGrandTotalAssertCreditMemoViewPageTotals
		$I->comment("Exiting Action Group [assertCreditMemoViewPageTotals] AssertAdminCreditMemoViewPageTotalsActionGroup");
		$I->comment("Login to storefront as previously created customer");
		$I->comment("Entering Action Group [loginAsCustomer] LoginToStorefrontActionGroup");
		$I->amOnPage("/customer/account/login/"); // stepKey: amOnSignInPageLoginAsCustomer
		$I->waitForPageLoad(30); // stepKey: waitPageFullyLoadedLoginAsCustomer
		$I->waitForElementVisible("#email", 30); // stepKey: waitFormAppearsLoginAsCustomer
		$I->fillField("#email", $I->retrieveEntityField('createCustomer', 'email', 'test')); // stepKey: fillEmailLoginAsCustomer
		$I->fillField("#pass", $I->retrieveEntityField('createCustomer', 'password', 'test')); // stepKey: fillPasswordLoginAsCustomer
		$I->click("#send2"); // stepKey: clickSignInAccountButtonLoginAsCustomer
		$I->waitForPageLoad(30); // stepKey: clickSignInAccountButtonLoginAsCustomerWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerLoggedInLoginAsCustomer
		$I->comment("Exiting Action Group [loginAsCustomer] LoginToStorefrontActionGroup");
		$I->comment("Assert refunded Grand Total on frontend");
		$I->amOnPage("/customer/account/"); // stepKey: onAccountPage
		$I->waitForPageLoad(30); // stepKey: waitForPage
		$I->scrollTo("//div[@class='block-title order']"); // stepKey: scrollToResent
		$I->click("//td[text()='{$grabOrderId}']/following-sibling::td[@data-th='Actions']/a[@class='action view']"); // stepKey: clickOnOrder
		$I->waitForPageLoad(30); // stepKey: waitForViewOrder
		$I->click("//a[text()='Refunds']"); // stepKey: clickRefund
		$I->waitForPageLoad(30); // stepKey: waitRefundsLoad
		$I->scrollTo("td[data-th='Grand Total'] > strong > span.price"); // stepKey: scrollToGrandTotal
		$I->see("555.00", "td[data-th='Grand Total'] > strong > span.price"); // stepKey: seeGrandTotal
	}
}
