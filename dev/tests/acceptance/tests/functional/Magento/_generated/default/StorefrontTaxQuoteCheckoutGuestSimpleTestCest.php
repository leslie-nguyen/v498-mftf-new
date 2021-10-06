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
 * @Title("MC-258: Tax for Simple Product Quote should be recalculated according to inputted data on Checkout flow for Guest Customer")
 * @Description("Tax for Simple Product Quote should be recalculated according to inputted data on Checkout flow for Guest Customer<h3>Test files</h3>vendor\magento\module-tax\Test\Mftf\Test\StorefrontTaxQuoteCheckoutTest\StorefrontTaxQuoteCheckoutGuestSimpleTest.xml<br>")
 * @TestCaseId("MC-258")
 * @group Tax
 */
class StorefrontTaxQuoteCheckoutGuestSimpleTestCest
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
		$I->createEntity("simpleProduct1", "hook", "SimpleProduct2", [], []); // stepKey: simpleProduct1
		$I->comment("Fill in rules to display tax in the cart");
		$I->comment("Entering Action Group [fillDefaultTaxForms] EditTaxConfigurationByUIActionGroup");
		$I->comment("navigate to the tax configuration page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_config/edit/section/tax/"); // stepKey: goToAdminTaxPageFillDefaultTaxForms
		$I->waitForPageLoad(30); // stepKey: waitForTaxConfigLoadFillDefaultTaxForms
		$I->comment("change the default state to California");
		$I->scrollTo("#tax_defaults-head", 0, -80); // stepKey: scrollToTaxDefaultsFillDefaultTaxForms
		$I->comment("conditionalClick twice to fix some flaky behavior");
		$I->conditionalClick("#tax_defaults-head", "#tax_defaults", false); // stepKey: clickCalculationSettingsFillDefaultTaxForms
		$I->waitForPageLoad(30); // stepKey: clickCalculationSettingsFillDefaultTaxFormsWaitForPageLoad
		$I->conditionalClick("#tax_defaults-head", "#tax_defaults", false); // stepKey: clickCalculationSettingsAgainFillDefaultTaxForms
		$I->waitForPageLoad(30); // stepKey: clickCalculationSettingsAgainFillDefaultTaxFormsWaitForPageLoad
		$I->uncheckOption("#row_tax_defaults_region input[type='checkbox']"); // stepKey: clickDefaultStateFillDefaultTaxForms
		$I->selectOption("#row_tax_defaults_region select", "California"); // stepKey: selectDefaultStateFillDefaultTaxForms
		$I->fillField("#tax_defaults_postcode", "*"); // stepKey: fillDefaultPostCodeFillDefaultTaxForms
		$I->comment("change the options for shopping cart display to show tax");
		$I->scrollTo("#tax_cart_display-head", 0, -80); // stepKey: scrollToTaxShoppingCartDisplayFillDefaultTaxForms
		$I->comment("conditionalClick twice to fix some flaky behavior");
		$I->conditionalClick("#tax_cart_display-head", "#tax_cart_display", false); // stepKey: clickShoppingCartDisplaySettingsFillDefaultTaxForms
		$I->waitForPageLoad(30); // stepKey: clickShoppingCartDisplaySettingsFillDefaultTaxFormsWaitForPageLoad
		$I->conditionalClick("#tax_cart_display-head", "#tax_cart_display", false); // stepKey: clickShoppingCartDisplaySettingsAgainFillDefaultTaxForms
		$I->waitForPageLoad(30); // stepKey: clickShoppingCartDisplaySettingsAgainFillDefaultTaxFormsWaitForPageLoad
		$I->uncheckOption("#row_tax_cart_display_grandtotal input[type='checkbox']"); // stepKey: clickTaxTotalCartFillDefaultTaxForms
		$I->selectOption("#row_tax_cart_display_grandtotal select", "Yes"); // stepKey: selectTaxTotalCartFillDefaultTaxForms
		$I->uncheckOption("#row_tax_cart_display_full_summary input[type='checkbox']"); // stepKey: clickDisplayTaxSummaryCartFillDefaultTaxForms
		$I->selectOption("#row_tax_cart_display_full_summary select", "Yes"); // stepKey: selectDisplayTaxSummaryCartFillDefaultTaxForms
		$I->uncheckOption("#row_tax_cart_display_zero_tax input[type='checkbox']"); // stepKey: clickDisplayZeroTaxCartFillDefaultTaxForms
		$I->selectOption("#row_tax_cart_display_zero_tax select", "Yes"); // stepKey: selectDisplayZeroTaxCartFillDefaultTaxForms
		$I->comment("change the options for orders, invoices, credit memos display to show tax");
		$I->scrollTo("#tax_sales_display-head", 0, -80); // stepKey: scrollToTaxSalesDisplayFillDefaultTaxForms
		$I->comment("conditionalClick twice to fix some flaky behavior");
		$I->conditionalClick("#tax_sales_display-head", "#tax_sales_display", false); // stepKey: clickOrdersInvoicesCreditSalesFillDefaultTaxForms
		$I->waitForPageLoad(30); // stepKey: clickOrdersInvoicesCreditSalesFillDefaultTaxFormsWaitForPageLoad
		$I->conditionalClick("#tax_sales_display-head", "#tax_sales_display", false); // stepKey: clickOrdersInvoicesCreditSalesAgainFillDefaultTaxForms
		$I->waitForPageLoad(30); // stepKey: clickOrdersInvoicesCreditSalesAgainFillDefaultTaxFormsWaitForPageLoad
		$I->uncheckOption("#row_tax_sales_display_grandtotal input[type='checkbox']"); // stepKey: clickTaxTotalSalesFillDefaultTaxForms
		$I->selectOption("#row_tax_sales_display_grandtotal select", "Yes"); // stepKey: selectTaxTotalSalesFillDefaultTaxForms
		$I->uncheckOption("#row_tax_sales_display_full_summary input[type='checkbox']"); // stepKey: clickDisplayTaxSummarySalesFillDefaultTaxForms
		$I->selectOption("#row_tax_sales_display_full_summary select", "Yes"); // stepKey: selectDisplayTaxSummarySalesFillDefaultTaxForms
		$I->uncheckOption("#row_tax_sales_display_zero_tax input[type='checkbox']"); // stepKey: clickDisplayZeroTaxSalesFillDefaultTaxForms
		$I->selectOption("#row_tax_sales_display_zero_tax select", "Yes"); // stepKey: selectDisplayZeroTaxSalesFillDefaultTaxForms
		$I->comment("Save the settings");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopFillDefaultTaxForms
		$I->click(".page-actions-inner #save"); // stepKey: saveTaxOptionsFillDefaultTaxForms
		$I->waitForPageLoad(30); // stepKey: saveTaxOptionsFillDefaultTaxFormsWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxSavedFillDefaultTaxForms
		$I->see("You saved the configuration.", ".message-success"); // stepKey: seeSuccessFillDefaultTaxForms
		$I->comment("Exiting Action Group [fillDefaultTaxForms] EditTaxConfigurationByUIActionGroup");
		$I->comment("Go to tax rule page");
		$I->comment("Entering Action Group [goToTaxRulePage] AdminTaxRuleGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageGoToTaxRulePage
		$I->waitForPageLoad(30); // stepKey: waitForTaxRulePageGoToTaxRulePage
		$I->comment("Exiting Action Group [goToTaxRulePage] AdminTaxRuleGridOpenPageActionGroup");
		$I->click("#add"); // stepKey: addNewTaxRate
		$I->waitForPageLoad(30); // stepKey: addNewTaxRateWaitForPageLoad
		$I->fillField("#anchor-content #code", "SampleRule"); // stepKey: fillRuleName
		$I->comment("Add NY and CA tax rules");
		$I->comment("Entering Action Group [addNYTaxRate] AddNewTaxRateNoZipActionGroup");
		$I->comment("Go to the tax rate page");
		$I->click("//*[text()='Add New Tax Rate']"); // stepKey: addNewTaxRateAddNYTaxRate
		$I->waitForPageLoad(30); // stepKey: addNewTaxRateAddNYTaxRateWaitForPageLoad
		$I->comment("Fill out a new tax rate");
		$I->fillField("aside #code", "New York-8.375"); // stepKey: fillTaxIdentifierAddNYTaxRate
		$I->fillField("#tax_postcode", "*"); // stepKey: fillZipCodeAddNYTaxRate
		$I->selectOption("#tax_region_id", "New York"); // stepKey: selectStateAddNYTaxRate
		$I->selectOption("#tax_country_id", "United States"); // stepKey: selectCountryAddNYTaxRate
		$I->fillField("#rate", "8.375"); // stepKey: fillRateAddNYTaxRate
		$I->comment("Save the tax rate");
		$I->click(".action-save"); // stepKey: saveTaxRateAddNYTaxRate
		$I->waitForPageLoad(30); // stepKey: saveTaxRateAddNYTaxRateWaitForPageLoad
		$I->comment("Exiting Action Group [addNYTaxRate] AddNewTaxRateNoZipActionGroup");
		$I->comment("Entering Action Group [addCATaxRate] AddNewTaxRateNoZipActionGroup");
		$I->comment("Go to the tax rate page");
		$I->click("//*[text()='Add New Tax Rate']"); // stepKey: addNewTaxRateAddCATaxRate
		$I->waitForPageLoad(30); // stepKey: addNewTaxRateAddCATaxRateWaitForPageLoad
		$I->comment("Fill out a new tax rate");
		$I->fillField("aside #code", "California-8.25"); // stepKey: fillTaxIdentifierAddCATaxRate
		$I->fillField("#tax_postcode", "*"); // stepKey: fillZipCodeAddCATaxRate
		$I->selectOption("#tax_region_id", "California"); // stepKey: selectStateAddCATaxRate
		$I->selectOption("#tax_country_id", "United States"); // stepKey: selectCountryAddCATaxRate
		$I->fillField("#rate", "8.25"); // stepKey: fillRateAddCATaxRate
		$I->comment("Save the tax rate");
		$I->click(".action-save"); // stepKey: saveTaxRateAddCATaxRate
		$I->waitForPageLoad(30); // stepKey: saveTaxRateAddCATaxRateWaitForPageLoad
		$I->comment("Exiting Action Group [addCATaxRate] AddNewTaxRateNoZipActionGroup");
		$I->click("#save"); // stepKey: clickSave
		$I->waitForPageLoad(90); // stepKey: clickSaveWaitForPageLoad
		$runCronIndexer = $I->magentoCLI("cron:run --group=index", 60); // stepKey: runCronIndexer
		$I->comment($runCronIndexer);
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Go to the tax rule page and delete the row we created");
		$I->comment("Entering Action Group [goToTaxRulesPage] AdminTaxRuleGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageGoToTaxRulesPage
		$I->waitForPageLoad(30); // stepKey: waitForTaxRulePageGoToTaxRulesPage
		$I->comment("Exiting Action Group [goToTaxRulesPage] AdminTaxRuleGridOpenPageActionGroup");
		$I->comment("Entering Action Group [deleteRule] deleteEntitySecondaryGrid");
		$I->comment("search for the name");
		$I->click("[title='Reset Filter']"); // stepKey: resetFiltersDeleteRule
		$I->fillField(".col-code .admin__control-text", "SampleRule"); // stepKey: fillIdentifierDeleteRule
		$I->click(".admin__filter-actions [title='Search']"); // stepKey: searchForNameDeleteRule
		$I->click("tr[data-role='row']"); // stepKey: clickResultDeleteRule
		$I->waitForPageLoad(30); // stepKey: waitForTaxRateLoadDeleteRule
		$I->comment("delete the rule");
		$I->click("#delete"); // stepKey: clickDeleteDeleteRule
		$I->waitForPageLoad(30); // stepKey: clickDeleteDeleteRuleWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: clickOkDeleteRule
		$I->waitForPageLoad(60); // stepKey: clickOkDeleteRuleWaitForPageLoad
		$I->see("deleted", ".message-success"); // stepKey: seeSuccessDeleteRule
		$I->comment("Exiting Action Group [deleteRule] deleteEntitySecondaryGrid");
		$I->comment("Go to the tax rate page");
		$I->comment("Entering Action Group [goToTaxRatesPage] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRatesPage
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRatesPage
		$I->comment("Exiting Action Group [goToTaxRatesPage] AdminTaxRateGridOpenPageActionGroup");
		$I->comment("Delete the two tax rates that were created");
		$I->comment("Entering Action Group [deleteNYRate] deleteEntitySecondaryGrid");
		$I->comment("search for the name");
		$I->click("[title='Reset Filter']"); // stepKey: resetFiltersDeleteNYRate
		$I->fillField(".col-code .admin__control-text", "New York-8.375"); // stepKey: fillIdentifierDeleteNYRate
		$I->click(".admin__filter-actions [title='Search']"); // stepKey: searchForNameDeleteNYRate
		$I->click("tr[data-role='row']"); // stepKey: clickResultDeleteNYRate
		$I->waitForPageLoad(30); // stepKey: waitForTaxRateLoadDeleteNYRate
		$I->comment("delete the rule");
		$I->click("#delete"); // stepKey: clickDeleteDeleteNYRate
		$I->waitForPageLoad(30); // stepKey: clickDeleteDeleteNYRateWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: clickOkDeleteNYRate
		$I->waitForPageLoad(60); // stepKey: clickOkDeleteNYRateWaitForPageLoad
		$I->see("deleted", ".message-success"); // stepKey: seeSuccessDeleteNYRate
		$I->comment("Exiting Action Group [deleteNYRate] deleteEntitySecondaryGrid");
		$I->comment("Entering Action Group [deleteCARate] deleteEntitySecondaryGrid");
		$I->comment("search for the name");
		$I->click("[title='Reset Filter']"); // stepKey: resetFiltersDeleteCARate
		$I->fillField(".col-code .admin__control-text", "California-8.25"); // stepKey: fillIdentifierDeleteCARate
		$I->click(".admin__filter-actions [title='Search']"); // stepKey: searchForNameDeleteCARate
		$I->click("tr[data-role='row']"); // stepKey: clickResultDeleteCARate
		$I->waitForPageLoad(30); // stepKey: waitForTaxRateLoadDeleteCARate
		$I->comment("delete the rule");
		$I->click("#delete"); // stepKey: clickDeleteDeleteCARate
		$I->waitForPageLoad(30); // stepKey: clickDeleteDeleteCARateWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: clickOkDeleteCARate
		$I->waitForPageLoad(60); // stepKey: clickOkDeleteCARateWaitForPageLoad
		$I->see("deleted", ".message-success"); // stepKey: seeSuccessDeleteCARate
		$I->comment("Exiting Action Group [deleteCARate] deleteEntitySecondaryGrid");
		$I->comment("Ensure tax won't be shown in the cart");
		$I->comment("Entering Action Group [changeToDefaultTaxConfiguration] ChangeToDefaultTaxConfigurationUIActionGroup");
		$I->comment("navigate to the tax configuration page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_config/edit/section/tax/"); // stepKey: goToAdminTaxPageChangeToDefaultTaxConfiguration
		$I->waitForPageLoad(30); // stepKey: waitForTaxConfigLoadChangeToDefaultTaxConfiguration
		$I->comment("change the default state to none");
		$I->comment("conditionalClick twice to fix some flaky behavior");
		$I->conditionalClick("#tax_defaults-head", "#row_tax_defaults_region input[type='checkbox']", false); // stepKey: clickCalculationSettingsChangeToDefaultTaxConfiguration
		$I->conditionalClick("#tax_defaults-head", "#row_tax_defaults_region input[type='checkbox']", false); // stepKey: clickCalculationSettingsAgainChangeToDefaultTaxConfiguration
		$I->checkOption("#row_tax_defaults_region input[type='checkbox']"); // stepKey: clickDefaultStateChangeToDefaultTaxConfiguration
		$I->selectOption("#row_tax_defaults_region select", "California"); // stepKey: selectDefaultStateChangeToDefaultTaxConfiguration
		$I->fillField("#tax_defaults_postcode", ""); // stepKey: fillDefaultPostCodeChangeToDefaultTaxConfiguration
		$I->comment("change the options for shopping cart display to not show tax");
		$I->comment("conditionalClick twice to fix some flaky behavior");
		$I->conditionalClick("#tax_cart_display-head", "#row_tax_cart_display_grandtotal input[type='checkbox']", false); // stepKey: clickShoppingCartDisplaySettingsChangeToDefaultTaxConfiguration
		$I->conditionalClick("#tax_cart_display-head", "#row_tax_cart_display_grandtotal input[type='checkbox']", false); // stepKey: clickShoppingCartDisplaySettingsAgainChangeToDefaultTaxConfiguration
		$I->checkOption("#row_tax_cart_display_grandtotal input[type='checkbox']"); // stepKey: clickTaxTotalCartChangeToDefaultTaxConfiguration
		$I->selectOption("#row_tax_cart_display_grandtotal select", "Yes"); // stepKey: selectTaxTotalCartChangeToDefaultTaxConfiguration
		$I->checkOption("#row_tax_cart_display_full_summary input[type='checkbox']"); // stepKey: clickDisplayTaxSummaryCartChangeToDefaultTaxConfiguration
		$I->selectOption("#row_tax_cart_display_full_summary select", "Yes"); // stepKey: selectDisplayTaxSummaryCartChangeToDefaultTaxConfiguration
		$I->checkOption("#row_tax_cart_display_zero_tax input[type='checkbox']"); // stepKey: clickDisplayZeroTaxCartChangeToDefaultTaxConfiguration
		$I->selectOption("#row_tax_cart_display_zero_tax select", "Yes"); // stepKey: selectDisplayZeroTaxCartChangeToDefaultTaxConfiguration
		$I->comment("change the options for orders, invoices, credit memos display to not show tax");
		$I->comment("conditionalClick twice to fix some flaky behavior");
		$I->conditionalClick("#tax_sales_display-head", "#row_tax_sales_display_grandtotal input[type='checkbox']", false); // stepKey: clickOrdersInvoicesCreditSalesChangeToDefaultTaxConfiguration
		$I->conditionalClick("#tax_sales_display-head", "#row_tax_sales_display_grandtotal input[type='checkbox']", false); // stepKey: clickOrdersInvoicesCreditSalesAgainChangeToDefaultTaxConfiguration
		$I->checkOption("#row_tax_sales_display_grandtotal input[type='checkbox']"); // stepKey: clickTaxTotalSalesChangeToDefaultTaxConfiguration
		$I->selectOption("#row_tax_sales_display_grandtotal select", "Yes"); // stepKey: selectTaxTotalSalesChangeToDefaultTaxConfiguration
		$I->checkOption("#row_tax_sales_display_full_summary input[type='checkbox']"); // stepKey: clickDisplayTaxSummarySalesChangeToDefaultTaxConfiguration
		$I->selectOption("#row_tax_sales_display_full_summary select", "Yes"); // stepKey: selectDisplayTaxSummarySalesChangeToDefaultTaxConfiguration
		$I->checkOption("#row_tax_sales_display_zero_tax input[type='checkbox']"); // stepKey: clickDisplayZeroTaxSalesChangeToDefaultTaxConfiguration
		$I->selectOption("#row_tax_sales_display_zero_tax select", "Yes"); // stepKey: selectDisplayZeroTaxSalesChangeToDefaultTaxConfiguration
		$I->comment("Save the settings");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopChangeToDefaultTaxConfiguration
		$I->click(".page-actions-inner #save"); // stepKey: saveTaxOptionsChangeToDefaultTaxConfiguration
		$I->waitForPageLoad(30); // stepKey: saveTaxOptionsChangeToDefaultTaxConfigurationWaitForPageLoad
		$I->see("You saved the configuration.", ".message-success"); // stepKey: seeSuccessChangeToDefaultTaxConfiguration
		$I->comment("Exiting Action Group [changeToDefaultTaxConfiguration] ChangeToDefaultTaxConfigurationUIActionGroup");
		$I->comment("Entering Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAmOnLogoutPage
		$I->comment("Exiting Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$I->deleteEntity("simpleProduct1", "hook"); // stepKey: deleteSimpleProduct1
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
	 * @Features({"Tax"})
	 * @Stories({"Tax Calculation in One Page Checkout"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontTaxQuoteCheckoutGuestSimpleTest(AcceptanceTester $I)
	{
		$I->comment("Go to the created product page and add it to the cart");
		$I->amOnPage($I->retrieveEntityField('simpleProduct1', 'sku', 'test') . ".html"); // stepKey: goToSimpleProductPage
		$I->waitForPageLoad(30); // stepKey: waitForSimpleProductPage
		$I->click("#product-addtocart-button"); // stepKey: addSimpleProductToCart
		$I->waitForPageLoad(60); // stepKey: addSimpleProductToCartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductAdded
		$I->see("You added", ".message-success"); // stepKey: seeSuccess
		$I->comment("Fill in address for CA");
		$I->amOnPage("/checkout"); // stepKey: goToCheckout
		$I->waitForPageLoad(30); // stepKey: waitForShippingSection
		$I->fillField("input[id*=customer-email]", msq("Simple_US_Customer_CA") . "John.Doe@example.com"); // stepKey: enterEmail
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitEmailLoad
		$I->comment("Entering Action Group [changeAddress] LoggedInCheckoutFillNewBillingAddressActionGroup");
		$I->fillField(" input[name=firstname]", "John"); // stepKey: fillFirstNameChangeAddress
		$I->fillField(" input[name=lastname]", "Doe"); // stepKey: fillLastNameChangeAddress
		$I->fillField(" input[name=company]", "Magento"); // stepKey: fillCompanyChangeAddress
		$I->fillField(" input[name=telephone]", "512-345-6789"); // stepKey: fillPhoneNumberChangeAddress
		$I->fillField(" input[name='street[0]']", "7700 West Parmer Lane"); // stepKey: fillStreetAddress1ChangeAddress
		$I->fillField(" input[name='street[1]']", "113"); // stepKey: fillStreetAddress2ChangeAddress
		$I->fillField(" input[name=city]", "Los Angeles"); // stepKey: fillCityNameChangeAddress
		$I->selectOption(" select[name=region_id]", "California"); // stepKey: selectStateChangeAddress
		$I->fillField(" input[name=postcode]", "90001"); // stepKey: fillZipChangeAddress
		$I->selectOption(" select[name=country_id]", "US"); // stepKey: selectCountyChangeAddress
		$I->waitForPageLoad(30); // stepKey: waitForFormUpdate2ChangeAddress
		$I->comment("Exiting Action Group [changeAddress] LoggedInCheckoutFillNewBillingAddressActionGroup");
		$I->comment("Entering Action Group [clickNext] StorefrontCheckoutClickNextOnShippingStepActionGroup");
		$I->waitForElementVisible("button.button.action.continue.primary", 30); // stepKey: waitForNextButtonClickNext
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonClickNextWaitForPageLoad
		$I->scrollTo("button.button.action.continue.primary"); // stepKey: scrollToNextButtonClickNext
		$I->waitForPageLoad(30); // stepKey: scrollToNextButtonClickNextWaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNextClickNext
		$I->waitForPageLoad(30); // stepKey: clickNextClickNextWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskToDisappearClickNext
		$I->comment("Exiting Action Group [clickNext] StorefrontCheckoutClickNextOnShippingStepActionGroup");
		$I->comment("Checkout select Check/Money Order payment");
		$I->comment("Entering Action Group [selectCheckMoneyPayment] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSelectCheckMoneyPayment
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSelectCheckMoneyPayment
		$I->conditionalClick("//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", "//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", true); // stepKey: selectCheckmoPaymentMethodSelectCheckMoneyPayment
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskAfterPaymentMethodSelectionSelectCheckMoneyPayment
		$I->comment("Exiting Action Group [selectCheckMoneyPayment] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->see("California", ".billing-address-details"); // stepKey: seeAddress
		$I->see("California", "//div[@class='ship-to']//div[@class='shipping-information-content']"); // stepKey: seeShipTo
		$I->comment("Assert that taxes are applied correctly for CA");
		$I->waitForElementVisible("[data-th='Tax'] span", 30); // stepKey: waitForOverviewVisible
		$I->waitForPageLoad(30); // stepKey: waitForOverviewVisibleWaitForPageLoad
		$I->see("$10.15", "[data-th='Tax'] span"); // stepKey: seeTax2
		$I->waitForPageLoad(30); // stepKey: seeTax2WaitForPageLoad
		$I->click("[data-th='Tax'] span"); // stepKey: expandTax2
		$I->waitForPageLoad(30); // stepKey: expandTax2WaitForPageLoad
		$I->see("(8.25%)", ".totals-tax-details .mark"); // stepKey: seeTaxPercent2
		$I->see("$138.15", "//tr[@class='grand totals incl']//span[@class='price']"); // stepKey: seeTotalIncl2
		$I->see("$128.00", "//tr[@class='grand totals excl']//span[@class='price']"); // stepKey: seeTotalExcl2
		$I->comment("Go back to the shipping page and change the address");
		$I->click("//li[contains(@class,'opc-progress-bar-item')]//*[text()='Shipping']"); // stepKey: goBackToShipping
		$I->waitForPageLoad(30); // stepKey: goBackToShippingWaitForPageLoad
		$I->comment("Entering Action Group [changeAddress2] LoggedInCheckoutFillNewBillingAddressActionGroup");
		$I->fillField(" input[name=firstname]", "John"); // stepKey: fillFirstNameChangeAddress2
		$I->fillField(" input[name=lastname]", "Doe"); // stepKey: fillLastNameChangeAddress2
		$I->fillField(" input[name=company]", "368"); // stepKey: fillCompanyChangeAddress2
		$I->fillField(" input[name=telephone]", "512-345-6789"); // stepKey: fillPhoneNumberChangeAddress2
		$I->fillField(" input[name='street[0]']", "368 Broadway St."); // stepKey: fillStreetAddress1ChangeAddress2
		$I->fillField(" input[name='street[1]']", "113"); // stepKey: fillStreetAddress2ChangeAddress2
		$I->fillField(" input[name=city]", "New York"); // stepKey: fillCityNameChangeAddress2
		$I->selectOption(" select[name=region_id]", "New York"); // stepKey: selectStateChangeAddress2
		$I->fillField(" input[name=postcode]", "10001"); // stepKey: fillZipChangeAddress2
		$I->selectOption(" select[name=country_id]", "US"); // stepKey: selectCountyChangeAddress2
		$I->waitForPageLoad(30); // stepKey: waitForFormUpdate2ChangeAddress2
		$I->comment("Exiting Action Group [changeAddress2] LoggedInCheckoutFillNewBillingAddressActionGroup");
		$I->comment("Entering Action Group [clickNext2] StorefrontCheckoutClickNextOnShippingStepActionGroup");
		$I->waitForElementVisible("button.button.action.continue.primary", 30); // stepKey: waitForNextButtonClickNext2
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonClickNext2WaitForPageLoad
		$I->scrollTo("button.button.action.continue.primary"); // stepKey: scrollToNextButtonClickNext2
		$I->waitForPageLoad(30); // stepKey: scrollToNextButtonClickNext2WaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNextClickNext2
		$I->waitForPageLoad(30); // stepKey: clickNextClickNext2WaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskToDisappearClickNext2
		$I->comment("Exiting Action Group [clickNext2] StorefrontCheckoutClickNextOnShippingStepActionGroup");
		$I->comment("Checkout select Check/Money Order payment");
		$I->comment("Entering Action Group [selectCheckMoneyPayment2] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSelectCheckMoneyPayment2
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSelectCheckMoneyPayment2
		$I->conditionalClick("//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", "//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", true); // stepKey: selectCheckmoPaymentMethodSelectCheckMoneyPayment2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskAfterPaymentMethodSelectionSelectCheckMoneyPayment2
		$I->comment("Exiting Action Group [selectCheckMoneyPayment2] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->see("New York", "//div[@class='ship-to']//div[@class='shipping-information-content']"); // stepKey: seeShipTo2
		$I->comment("Assert that taxes are applied correctly for NY");
		$I->waitForElementVisible("[data-th='Tax'] span", 30); // stepKey: waitForOverviewVisible2
		$I->waitForPageLoad(30); // stepKey: waitForOverviewVisible2WaitForPageLoad
		$I->see("$10.30", "[data-th='Tax'] span"); // stepKey: seeTax
		$I->waitForPageLoad(30); // stepKey: seeTaxWaitForPageLoad
		$I->click("[data-th='Tax'] span"); // stepKey: expandTax
		$I->waitForPageLoad(30); // stepKey: expandTaxWaitForPageLoad
		$I->see("(8.375%)", ".totals-tax-details .mark"); // stepKey: seeTaxPercent
		$I->see("$138.30", "//tr[@class='grand totals incl']//span[@class='price']"); // stepKey: seeTotalIncl
		$I->see("$128.00", "//tr[@class='grand totals excl']//span[@class='price']"); // stepKey: seeTotalExcl
	}
}
