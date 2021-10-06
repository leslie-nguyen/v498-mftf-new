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
 * @Title("MC-6029: UI validation for Payment methods when creating an order from admin")
 * @Description("Admin should not be able to submit orders without selecting a payment method when there is more than one<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\AdminSubmitsOrderPaymentMethodValidationTest.xml<br>")
 * @TestCaseId("MC-6029")
 * @group sales
 */
class AdminSubmitsOrderPaymentMethodValidationTestCest
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
		$allowSpecificValue = $I->magentoCLI("config:set payment/cashondelivery/active 1", 60); // stepKey: allowSpecificValue
		$I->comment($allowSpecificValue);
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createSimpleProduct", "hook", "_defaultProduct", ["createCategory"], []); // stepKey: createSimpleProduct
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
		$allowSpecificValue = $I->magentoCLI("config:set payment/cashondelivery/active 0", 60); // stepKey: allowSpecificValue
		$I->comment($allowSpecificValue);
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteProduct
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->comment("Entering Action Group [adminLogout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAdminLogout
		$I->comment("Exiting Action Group [adminLogout] AdminLogoutActionGroup");
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
	 * @Stories({"MC-5537: No UI validation for Payment methods when creating an order from admin"})
	 * @Severity(level = SeverityLevel::MINOR)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminSubmitsOrderPaymentMethodValidationTest(AcceptanceTester $I)
	{
		$I->comment("Create order via Admin");
		$I->comment("Admin creates order");
		$I->comment("Entering Action Group [navigateToOrderIndexPage] AdminOrdersPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: openOrdersGridPageNavigateToOrderIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForLoadingPageNavigateToOrderIndexPage
		$I->comment("Exiting Action Group [navigateToOrderIndexPage] AdminOrdersPageOpenActionGroup");
		$I->see("Orders", ".page-header h1.page-title"); // stepKey: seeIndexPageTitle
		$I->click(".page-actions-buttons button#add"); // stepKey: clickCreateNewOrder
		$I->waitForPageLoad(30); // stepKey: clickCreateNewOrderWaitForPageLoad
		$I->click("#order-customer-selector .actions button.primary"); // stepKey: clickCreateCustomer
		$I->waitForPageLoad(30); // stepKey: clickCreateCustomerWaitForPageLoad
		$I->see("Create New Order", ".page-header h1.page-title"); // stepKey: seeNewOrderPageTitle
		$I->comment("Entering Action Group [addSimpleProductToOrder] AddSimpleProductToOrderActionGroup");
		$I->click("//section[@id='order-items']/div/div/button/span[text() = 'Add Products']"); // stepKey: clickAddProductsAddSimpleProductToOrder
		$I->waitForPageLoad(30); // stepKey: clickAddProductsAddSimpleProductToOrderWaitForPageLoad
		$I->fillField("#sales_order_create_search_grid_filter_sku", "testSku" . msq("_defaultProduct")); // stepKey: fillSkuFilterAddSimpleProductToOrder
		$I->click("#sales_order_create_search_grid [data-action='grid-filter-apply']"); // stepKey: clickSearchAddSimpleProductToOrder
		$I->waitForPageLoad(30); // stepKey: clickSearchAddSimpleProductToOrderWaitForPageLoad
		$I->scrollTo("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]", 0, -100); // stepKey: scrollToCheckColumnAddSimpleProductToOrder
		$I->checkOption("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]"); // stepKey: selectProductAddSimpleProductToOrder
		$I->fillField("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-qty [name='qty']", "1"); // stepKey: fillProductQtyAddSimpleProductToOrder
		$I->scrollTo("#order-search .admin__page-section-title .actions button.action-add", 0, -100); // stepKey: scrollToAddSelectedButtonAddSimpleProductToOrder
		$I->waitForPageLoad(30); // stepKey: scrollToAddSelectedButtonAddSimpleProductToOrderWaitForPageLoad
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: clickAddSelectedProductsAddSimpleProductToOrder
		$I->waitForPageLoad(30); // stepKey: clickAddSelectedProductsAddSimpleProductToOrderWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForOptionsToLoadAddSimpleProductToOrder
		$I->comment("Exiting Action Group [addSimpleProductToOrder] AddSimpleProductToOrderActionGroup");
		$I->comment("Entering Action Group [checkRequiredFieldsNewOrder] CheckRequiredFieldsNewOrderFormActionGroup");
		$I->seeElement(".admin__field.required[data-ui-id='billing-address-fieldset-element-form-field-group-id']"); // stepKey: seeCustomerGroupRequiredCheckRequiredFieldsNewOrder
		$I->seeElement(".admin__field[data-ui-id='billing-address-fieldset-element-form-field-email']"); // stepKey: seeEmailRequiredCheckRequiredFieldsNewOrder
		$I->clearField("#email"); // stepKey: clearEmailFieldCheckRequiredFieldsNewOrder
		$I->clearField("#order-billing_address_firstname"); // stepKey: clearFirstNameFieldCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: clearFirstNameFieldCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->clearField("#order-billing_address_lastname"); // stepKey: clearLastNameFieldCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: clearLastNameFieldCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->clearField("#order-billing_address_street0"); // stepKey: clearStreetFieldCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: clearStreetFieldCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->clearField("#order-billing_address_city"); // stepKey: clearCityFieldCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: clearCityFieldCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->selectOption("#order-billing_address_country_id", "United States"); // stepKey: selectUSCountryCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: selectUSCountryCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->selectOption("#order-billing_address_region_id", "Please select"); // stepKey: selectNoStateCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: selectNoStateCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->clearField("#order-billing_address_postcode"); // stepKey: clearPostalCodeFieldCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: clearPostalCodeFieldCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->clearField("#order-billing_address_telephone"); // stepKey: clearPhoneFieldCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: clearPhoneFieldCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->seeElement("#order-shipping_method a.action-default"); // stepKey: seeShippingMethodNotSelectedCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: seeShippingMethodNotSelectedCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->click("#submit_order_top_button"); // stepKey: trySubmitOrderCheckRequiredFieldsNewOrder
		$I->waitForPageLoad(30); // stepKey: trySubmitOrderCheckRequiredFieldsNewOrderWaitForPageLoad
		$I->see("This is a required field.", "#order-billing_address_firstname-error"); // stepKey: seeFirstNameRequiredCheckRequiredFieldsNewOrder
		$I->see("This is a required field.", "#order-billing_address_lastname-error"); // stepKey: seeLastNameRequiredCheckRequiredFieldsNewOrder
		$I->see("This is a required field.", "#order-billing_address_street0-error"); // stepKey: seeStreetRequiredCheckRequiredFieldsNewOrder
		$I->see("This is a required field.", "#order-billing_address_city-error"); // stepKey: seeCityRequiredCheckRequiredFieldsNewOrder
		$I->see("This is a required field.", "#order-billing_address_region_id-error"); // stepKey: seeStateRequiredCheckRequiredFieldsNewOrder
		$I->see("This is a required field.", "#order-billing_address_postcode-error"); // stepKey: seePostalCodeRequiredCheckRequiredFieldsNewOrder
		$I->see("This is a required field.", "#order-billing_address_telephone-error"); // stepKey: seePhoneRequiredCheckRequiredFieldsNewOrder
		$I->see("This is a required field.", "#order[has_shipping]-error"); // stepKey: seeShippingMethodRequiredCheckRequiredFieldsNewOrder
		$I->comment("Exiting Action Group [checkRequiredFieldsNewOrder] CheckRequiredFieldsNewOrderFormActionGroup");
		$I->see("Please select one of the options.", "#payment[method]-error"); // stepKey: seePaymentMethodRequired
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfOrderFormPage
		$I->selectOption("#group_id", "General"); // stepKey: selectCustomerGroup
		$I->fillField("#email", msq("Simple_US_Customer") . "John.Doe@example.com"); // stepKey: fillCustomerEmail
		$I->comment("Entering Action Group [fillCustomerAddress] FillOrderCustomerInformationActionGroup");
		$I->fillField("#order-billing_address_firstname", "John"); // stepKey: fillFirstNameFillCustomerAddress
		$I->waitForPageLoad(30); // stepKey: fillFirstNameFillCustomerAddressWaitForPageLoad
		$I->fillField("#order-billing_address_lastname", "Doe"); // stepKey: fillLastNameFillCustomerAddress
		$I->waitForPageLoad(30); // stepKey: fillLastNameFillCustomerAddressWaitForPageLoad
		$I->fillField("#order-billing_address_street0", "7700 West Parmer Lane"); // stepKey: fillStreetLine1FillCustomerAddress
		$I->waitForPageLoad(30); // stepKey: fillStreetLine1FillCustomerAddressWaitForPageLoad
		$I->fillField("#order-billing_address_city", "Austin"); // stepKey: fillCityFillCustomerAddress
		$I->waitForPageLoad(30); // stepKey: fillCityFillCustomerAddressWaitForPageLoad
		$I->selectOption("#order-billing_address_country_id", "US"); // stepKey: fillCountryFillCustomerAddress
		$I->waitForPageLoad(30); // stepKey: fillCountryFillCustomerAddressWaitForPageLoad
		$I->selectOption("#order-billing_address_region_id", "Texas"); // stepKey: fillStateFillCustomerAddress
		$I->waitForPageLoad(30); // stepKey: fillStateFillCustomerAddressWaitForPageLoad
		$I->fillField("#order-billing_address_postcode", "78729"); // stepKey: fillPostalCodeFillCustomerAddress
		$I->waitForPageLoad(30); // stepKey: fillPostalCodeFillCustomerAddressWaitForPageLoad
		$I->fillField("#order-billing_address_telephone", "512-345-6789"); // stepKey: fillPhoneFillCustomerAddress
		$I->waitForPageLoad(30); // stepKey: fillPhoneFillCustomerAddressWaitForPageLoad
		$I->comment("Exiting Action Group [fillCustomerAddress] FillOrderCustomerInformationActionGroup");
		$I->comment("Entering Action Group [selectFlatRateShipping] OrderSelectFlatRateShippingActionGroup");
		$I->click("#order-methods span.title"); // stepKey: unfocusSelectFlatRateShipping
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForJavascriptToFinishSelectFlatRateShipping
		$I->click("#order-shipping_method a.action-default"); // stepKey: clickShippingMethodsSelectFlatRateShipping
		$I->waitForPageLoad(30); // stepKey: clickShippingMethodsSelectFlatRateShippingWaitForPageLoad
		$I->waitForElementVisible("#s_method_flatrate_flatrate", 30); // stepKey: waitForShippingOptionsSelectFlatRateShipping
		$I->waitForPageLoad(30); // stepKey: waitForShippingOptionsSelectFlatRateShippingWaitForPageLoad
		$I->selectOption("#s_method_flatrate_flatrate", "flatrate_flatrate"); // stepKey: checkFlatRateSelectFlatRateShipping
		$I->waitForPageLoad(30); // stepKey: checkFlatRateSelectFlatRateShippingWaitForPageLoad
		$I->comment("Exiting Action Group [selectFlatRateShipping] OrderSelectFlatRateShippingActionGroup");
		$I->see("$123.00", "//tr[contains(@class,'row-totals')]/td[contains(text(), 'Subtotal')]/following-sibling::td/span[contains(@class, 'price')]"); // stepKey: seeOrderSubTotal
		$I->see("$5.00", "//tr[contains(@class,'row-totals')]/td[contains(text(), 'Shipping')]/following-sibling::td/span[contains(@class, 'price')]"); // stepKey: seeOrderShipping
		$I->comment("Check if order can be submitted without the required fields");
		$I->comment("Fill customer group and customer email");
		$I->comment("Fill customer address information");
		$I->comment("Select payment and shipping");
		$I->waitForElementVisible("#p_method_checkmo", 30); // stepKey: waitForPaymentOptions
		$I->waitForPageLoad(30); // stepKey: waitForPaymentOptionsWaitForPageLoad
		$I->selectOption("#p_method_checkmo", "checkmo"); // stepKey: checkPaymentOption
		$I->waitForPageLoad(30); // stepKey: checkPaymentOptionWaitForPageLoad
		$I->comment("Verify totals on Order page");
		$I->scrollTo("//tr[contains(@class,'row-totals')]/td/strong[contains(text(), 'Grand Total')]/parent::td/following-sibling::td//span[contains(@class, 'price')]"); // stepKey: scrollToOrderGrandTotal
		$I->see("$128.00", "//tr[contains(@class,'row-totals')]/td/strong[contains(text(), 'Grand Total')]/parent::td/following-sibling::td//span[contains(@class, 'price')]"); // stepKey: seeCorrectGrandTotal
		$I->click("#submit_order_top_button"); // stepKey: clickSubmitOrder
		$I->waitForPageLoad(30); // stepKey: clickSubmitOrderWaitForPageLoad
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/view/order_id/"); // stepKey: seeViewOrderPage
		$I->see("You created the order.", "div.message-success:last-of-type"); // stepKey: seeSuccessMessage
		$I->comment("Submit Order and verify information");
	}
}
