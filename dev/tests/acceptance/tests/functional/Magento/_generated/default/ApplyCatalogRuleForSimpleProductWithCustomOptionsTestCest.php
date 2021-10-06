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
 * @Title("MC-14769: Admin should be able to apply the catalog price rule for simple product with 3 custom options")
 * @Description("Admin should be able to apply the catalog price rule for simple product with 3 custom options<h3>Test files</h3>vendor\magento\module-catalog-rule\Test\Mftf\Test\ApplyCatalogRuleForSimpleProductWithCustomOptionsTest.xml<br>")
 * @TestCaseId("MC-14769")
 * @group CatalogRule
 * @group mtf_migrated
 */
class ApplyCatalogRuleForSimpleProductWithCustomOptionsTestCest
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
		$I->comment("Login as Admin");
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$createProduct1Fields['price'] = "56.78";
		$I->createEntity("createProduct1", "hook", "_defaultProduct", ["createCategory"], $createProduct1Fields); // stepKey: createProduct1
		$createProduct2Fields['price'] = "56.78";
		$I->createEntity("createProduct2", "hook", "_defaultProduct", ["createCategory"], $createProduct2Fields); // stepKey: createProduct2
		$createProduct3Fields['price'] = "56.78";
		$I->createEntity("createProduct3", "hook", "_defaultProduct", ["createCategory"], $createProduct3Fields); // stepKey: createProduct3
		$I->comment("Update all products to have custom options");
		$I->updateEntity("createProduct1", "hook", "productWithCustomOptions",[]); // stepKey: updateProductWithOptions1
		$I->updateEntity("createProduct2", "hook", "productWithCustomOptions",[]); // stepKey: updateProductWithOptions2
		$I->updateEntity("createProduct3", "hook", "productWithCustomOptions",[]); // stepKey: updateProductWithOptions3
		$runCronIndex = $I->magentoCron("index", 90); // stepKey: runCronIndex
		$I->comment($runCronIndex);
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Delete products and category");
		$I->deleteEntity("createProduct1", "hook"); // stepKey: deleteProduct1
		$I->deleteEntity("createProduct2", "hook"); // stepKey: deleteProduct2
		$I->deleteEntity("createProduct3", "hook"); // stepKey: deleteProduct3
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->comment("Delete the catalog price rule");
		$I->comment("Entering Action Group [goToPriceRulePage] AdminOpenCatalogPriceRulePageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog_rule/promo_catalog/"); // stepKey: openCatalogRulePageGoToPriceRulePage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadGoToPriceRulePage
		$I->comment("Exiting Action Group [goToPriceRulePage] AdminOpenCatalogPriceRulePageActionGroup");
		$I->comment("Entering Action Group [deletePriceRule] deleteEntitySecondaryGrid");
		$I->comment("search for the name");
		$I->click("[title='Reset Filter']"); // stepKey: resetFiltersDeletePriceRule
		$I->fillField(".col-name .admin__control-text", "CatalogPriceRule" . msq("_defaultCatalogRule")); // stepKey: fillIdentifierDeletePriceRule
		$I->click(".admin__filter-actions [title='Search']"); // stepKey: searchForNameDeletePriceRule
		$I->click("tr[data-role='row']"); // stepKey: clickResultDeletePriceRule
		$I->waitForPageLoad(30); // stepKey: waitForTaxRateLoadDeletePriceRule
		$I->comment("delete the rule");
		$I->click("#delete"); // stepKey: clickDeleteDeletePriceRule
		$I->waitForPageLoad(30); // stepKey: clickDeleteDeletePriceRuleWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: clickOkDeletePriceRule
		$I->waitForPageLoad(60); // stepKey: clickOkDeletePriceRuleWaitForPageLoad
		$I->see("deleted", ".message-success"); // stepKey: seeSuccessDeletePriceRule
		$I->comment("Exiting Action Group [deletePriceRule] deleteEntitySecondaryGrid");
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
	 * @Features({"CatalogRule"})
	 * @Stories({"Apply catalog price rule"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function ApplyCatalogRuleForSimpleProductWithCustomOptionsTest(AcceptanceTester $I)
	{
		$I->comment("1. Begin creating a new catalog price rule");
		$I->comment("Entering Action Group [newCatalogPriceRuleByUIWithConditionIsCategory] NewCatalogPriceRuleByUIWithConditionIsCategoryActionGroup");
		$I->comment("Go to the admin Catalog rule grid and add a new one");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog_rule/promo_catalog/"); // stepKey: goToPriceRulePageNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: waitForPriceRulePageNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("#add"); // stepKey: addNewRuleNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: addNewRuleNewCatalogPriceRuleByUIWithConditionIsCategoryWaitForPageLoad
		$I->comment("Fill the form according the attributes of the entity");
		$I->fillField("[name='name']", "CatalogPriceRule" . msq("_defaultCatalogRule")); // stepKey: fillNameNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->fillField("[name='description']", "Catalog Price Rule Description"); // stepKey: fillDescriptionNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("input[name='is_active']+label"); // stepKey: selectActiveNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->selectOption("[name='website_ids']", "1"); // stepKey: selectSiteNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("[name='from_date'] + button"); // stepKey: clickFromCalenderNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(15); // stepKey: clickFromCalenderNewCatalogPriceRuleByUIWithConditionIsCategoryWaitForPageLoad
		$I->click("#ui-datepicker-div [data-handler='today']"); // stepKey: clickFromTodayNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("[name='to_date'] + button"); // stepKey: clickToCalenderNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(15); // stepKey: clickToCalenderNewCatalogPriceRuleByUIWithConditionIsCategoryWaitForPageLoad
		$I->click("#ui-datepicker-div [data-handler='today']"); // stepKey: clickToTodayNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("[data-index='actions']"); // stepKey: openActionDropdownNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->fillField("[name='discount_amount']", "10"); // stepKey: fillDiscountValueNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->selectOption("[name='simple_action']", "by_percent"); // stepKey: discountTypeNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->selectOption("[name='stop_rules_processing']", "Yes"); // stepKey: discardSubsequentRulesNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("[data-index='block_promo_catalog_edit_tab_conditions']"); // stepKey: openConditionsTabNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: waitForConditionTabOpenedNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click(".rule-param.rule-param-new-child"); // stepKey: addNewConditionNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: addNewConditionNewCatalogPriceRuleByUIWithConditionIsCategoryWaitForPageLoad
		$I->selectOption("select#conditions__1__new_child", "Magento\CatalogRule\Model\Rule\Condition\Product|category_ids"); // stepKey: selectTypeConditionNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: selectTypeConditionNewCatalogPriceRuleByUIWithConditionIsCategoryWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForConditionChosedNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("//li[1]//a[@class='label'][text() = '...']"); // stepKey: clickEllipsisNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->fillField("input#conditions__1--1__value", $I->retrieveEntityField('createCategory', 'id', 'test')); // stepKey: fillCategoryIdNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("#conditions__1__children li:nth-of-type(1) a.rule-param-apply"); // stepKey: clickApplyNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: clickApplyNewCatalogPriceRuleByUIWithConditionIsCategoryWaitForPageLoad
		$I->comment("Scroll to top and either save or save and apply after the action group");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: waitForAppliedNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->comment("Exiting Action Group [newCatalogPriceRuleByUIWithConditionIsCategory] NewCatalogPriceRuleByUIWithConditionIsCategoryActionGroup");
		$I->comment("Select not logged in customer group");
		$I->comment("Entering Action Group [selectNotLoggedInCustomerGroup] SelectNotLoggedInCustomerGroupActionGroup");
		$I->comment("This actionGroup was created to be merged from B2B because B2B has a very different form control here");
		$I->selectOption("select[name='customer_group_ids']", "NOT LOGGED IN"); // stepKey: selectCustomerGroupSelectNotLoggedInCustomerGroup
		$I->comment("Exiting Action Group [selectNotLoggedInCustomerGroup] SelectNotLoggedInCustomerGroupActionGroup");
		$I->comment("Save and apply the new catalog price rule");
		$I->comment("Entering Action Group [saveAndApplyCatalogPriceRule] SaveAndApplyCatalogPriceRuleActionGroup");
		$I->waitForElementVisible("#save_and_apply", 30); // stepKey: waitForSaveAndApplyButtonSaveAndApplyCatalogPriceRule
		$I->waitForPageLoad(30); // stepKey: waitForSaveAndApplyButtonSaveAndApplyCatalogPriceRuleWaitForPageLoad
		$I->click("#save_and_apply"); // stepKey: saveAndApplySaveAndApplyCatalogPriceRule
		$I->waitForPageLoad(30); // stepKey: saveAndApplySaveAndApplyCatalogPriceRuleWaitForPageLoad
		$I->see("You saved the rule.", ".message-success"); // stepKey: assertSuccessSaveAndApplyCatalogPriceRule
		$I->comment("Exiting Action Group [saveAndApplyCatalogPriceRule] SaveAndApplyCatalogPriceRuleActionGroup");
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Navigate to category on store front");
		$I->amOnPage("/" . $I->retrieveEntityField('createCategory', 'name', 'test') . ".html"); // stepKey: goToCategoryPage
		$I->comment("Check product 1 price on store front category page");
		$I->see("$51.10", "//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('createProduct1', 'name', 'test') . "')]]//div[@class='product-item-info']"); // stepKey: storefrontProduct1Price
		$I->comment("Check product 1 regular price on store front category page");
		$I->see("$56.78", "//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('createProduct1', 'name', 'test') . "')]]//div[@class='product-item-info']"); // stepKey: storefrontProduct1RegularPrice
		$I->comment("Check product 2 price on store front category page");
		$I->see("$51.10", "//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('createProduct2', 'name', 'test') . "')]]//div[@class='product-item-info']"); // stepKey: storefrontProduct2Price
		$I->comment("Check product 2 regular price on store front category page");
		$I->see("$56.78", "//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('createProduct2', 'name', 'test') . "')]]//div[@class='product-item-info']"); // stepKey: storefrontProduct2RegularPrice
		$I->comment("Check product 3 price on store front category page");
		$I->see("$51.10", "//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('createProduct3', 'name', 'test') . "')]]//div[@class='product-item-info']"); // stepKey: storefrontProduct3Price
		$I->comment("Check product 3 regular price on store front category page");
		$I->see("$56.78", "//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('createProduct3', 'name', 'test') . "')]]//div[@class='product-item-info']"); // stepKey: storefrontProduct3RegularPrice
		$I->comment("Navigate to product 1 on store front");
		$I->amOnPage("/" . $I->retrieveEntityField('createProduct1', 'name', 'test') . ".html"); // stepKey: goToProductPage1
		$I->comment("Assert regular and special price after selecting ProductOptionValueDropdown1");
		$I->comment("Entering Action Group [storefrontSelectCustomOptionAndAssertPrices1] StorefrontSelectCustomOptionDropDownAndAssertPricesActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductPageLoadStorefrontSelectCustomOptionAndAssertPrices1
		$I->selectOption("//*[@id='product-options-wrapper']//select[contains(@class, 'product-custom-option admin__control-select')]", "OptionValueDropDown1 +$0.01"); // stepKey: selectCustomOptionStorefrontSelectCustomOptionAndAssertPrices1
		$I->see("$56.79", "div.price-box.price-final_price"); // stepKey: productPriceAmountStorefrontSelectCustomOptionAndAssertPrices1
		$I->see("$51.11", "div.price-box.price-final_price [data-price-type='finalPrice'] .price"); // stepKey: productFinalPriceAmountStorefrontSelectCustomOptionAndAssertPrices1
		$I->comment("Exiting Action Group [storefrontSelectCustomOptionAndAssertPrices1] StorefrontSelectCustomOptionDropDownAndAssertPricesActionGroup");
		$I->comment("Add product 1 to cart");
		$I->comment("Entering Action Group [cartAddSimpleProduct1ToCart] StorefrontAddProductToCartWithQtyActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductPageLoadCartAddSimpleProduct1ToCart
		$I->fillField("input.input-text.qty", "1"); // stepKey: fillProduct1QuantityCartAddSimpleProduct1ToCart
		$I->waitForPageLoad(30); // stepKey: fillProduct1QuantityCartAddSimpleProduct1ToCartWaitForPageLoad
		$I->click("#product-addtocart-button"); // stepKey: clickOnAddToCartButtonCartAddSimpleProduct1ToCart
		$I->waitForPageLoad(60); // stepKey: clickOnAddToCartButtonCartAddSimpleProduct1ToCartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductToAddInCartCartAddSimpleProduct1ToCart
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageCartAddSimpleProduct1ToCart
		$I->seeElement("div.message-success"); // stepKey: seeSuccessSaveMessageCartAddSimpleProduct1ToCart
		$I->waitForPageLoad(30); // stepKey: seeSuccessSaveMessageCartAddSimpleProduct1ToCartWaitForPageLoad
		$I->comment("Exiting Action Group [cartAddSimpleProduct1ToCart] StorefrontAddProductToCartWithQtyActionGroup");
		$I->comment("Navigate to product 2 on store front");
		$I->amOnPage("/" . $I->retrieveEntityField('createProduct1', 'name', 'test') . ".html"); // stepKey: goToProductPage2
		$I->comment("Assert regular and special price after selecting ProductOptionValueDropdown3");
		$I->comment("Entering Action Group [storefrontSelectCustomOptionAndAssertPrices2] StorefrontSelectCustomOptionDropDownAndAssertPricesActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductPageLoadStorefrontSelectCustomOptionAndAssertPrices2
		$I->selectOption("//*[@id='product-options-wrapper']//select[contains(@class, 'product-custom-option admin__control-select')]", "OptionValueDropDown3 +$5.11"); // stepKey: selectCustomOptionStorefrontSelectCustomOptionAndAssertPrices2
		$I->see("$62.46", "div.price-box.price-final_price"); // stepKey: productPriceAmountStorefrontSelectCustomOptionAndAssertPrices2
		$I->see("$56.21", "div.price-box.price-final_price [data-price-type='finalPrice'] .price"); // stepKey: productFinalPriceAmountStorefrontSelectCustomOptionAndAssertPrices2
		$I->comment("Exiting Action Group [storefrontSelectCustomOptionAndAssertPrices2] StorefrontSelectCustomOptionDropDownAndAssertPricesActionGroup");
		$I->comment("Add product 2 to cart");
		$I->comment("Entering Action Group [cartAddSimpleProduct2ToCart] StorefrontAddProductToCartWithQtyActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductPageLoadCartAddSimpleProduct2ToCart
		$I->fillField("input.input-text.qty", "1"); // stepKey: fillProduct1QuantityCartAddSimpleProduct2ToCart
		$I->waitForPageLoad(30); // stepKey: fillProduct1QuantityCartAddSimpleProduct2ToCartWaitForPageLoad
		$I->click("#product-addtocart-button"); // stepKey: clickOnAddToCartButtonCartAddSimpleProduct2ToCart
		$I->waitForPageLoad(60); // stepKey: clickOnAddToCartButtonCartAddSimpleProduct2ToCartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductToAddInCartCartAddSimpleProduct2ToCart
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageCartAddSimpleProduct2ToCart
		$I->seeElement("div.message-success"); // stepKey: seeSuccessSaveMessageCartAddSimpleProduct2ToCart
		$I->waitForPageLoad(30); // stepKey: seeSuccessSaveMessageCartAddSimpleProduct2ToCartWaitForPageLoad
		$I->comment("Exiting Action Group [cartAddSimpleProduct2ToCart] StorefrontAddProductToCartWithQtyActionGroup");
		$I->comment("Navigate to product 3 on store front");
		$I->amOnPage("/" . $I->retrieveEntityField('createProduct3', 'name', 'test') . ".html"); // stepKey: goToProductPage3
		$I->comment("Add product 3 to cart with no custom option");
		$I->comment("Entering Action Group [cartAddSimpleProduct3ToCart] StorefrontAddProductToCartWithQtyActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductPageLoadCartAddSimpleProduct3ToCart
		$I->fillField("input.input-text.qty", "1"); // stepKey: fillProduct1QuantityCartAddSimpleProduct3ToCart
		$I->waitForPageLoad(30); // stepKey: fillProduct1QuantityCartAddSimpleProduct3ToCartWaitForPageLoad
		$I->click("#product-addtocart-button"); // stepKey: clickOnAddToCartButtonCartAddSimpleProduct3ToCart
		$I->waitForPageLoad(60); // stepKey: clickOnAddToCartButtonCartAddSimpleProduct3ToCartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductToAddInCartCartAddSimpleProduct3ToCart
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageCartAddSimpleProduct3ToCart
		$I->seeElement("div.message-success"); // stepKey: seeSuccessSaveMessageCartAddSimpleProduct3ToCart
		$I->waitForPageLoad(30); // stepKey: seeSuccessSaveMessageCartAddSimpleProduct3ToCartWaitForPageLoad
		$I->comment("Exiting Action Group [cartAddSimpleProduct3ToCart] StorefrontAddProductToCartWithQtyActionGroup");
		$I->comment("Assert sub total on mini shopping cart");
		$I->comment("Entering Action Group [assertSubTotalOnStorefrontMiniCart] AssertSubTotalOnStorefrontMiniCartActionGroup");
		$I->waitForElementVisible("a.showcart", 30); // stepKey: waitForShowCartButtonVisibleAssertSubTotalOnStorefrontMiniCart
		$I->waitForPageLoad(60); // stepKey: waitForShowCartButtonVisibleAssertSubTotalOnStorefrontMiniCartWaitForPageLoad
		$I->click("a.showcart"); // stepKey: clickOnMiniCartAssertSubTotalOnStorefrontMiniCart
		$I->waitForPageLoad(60); // stepKey: clickOnMiniCartAssertSubTotalOnStorefrontMiniCartWaitForPageLoad
		$grabTextFromMiniCartSubtotalFieldAssertSubTotalOnStorefrontMiniCart = $I->grabTextFrom(".block-minicart .amount span.price"); // stepKey: grabTextFromMiniCartSubtotalFieldAssertSubTotalOnStorefrontMiniCart
		$I->assertEquals("$158.42", $grabTextFromMiniCartSubtotalFieldAssertSubTotalOnStorefrontMiniCart, "Mini shopping cart should contain subtotal $158.42"); // stepKey: assertSubtotalFieldFromMiniShoppingCart1AssertSubTotalOnStorefrontMiniCart
		$I->comment("Exiting Action Group [assertSubTotalOnStorefrontMiniCart] AssertSubTotalOnStorefrontMiniCartActionGroup");
		$I->comment("Navigate to checkout shipping page");
		$I->amOnPage("/checkout/#shipping"); // stepKey: navigateToShippingPage
		$I->waitForPageLoad(30); // stepKey: waitFoCheckoutShippingPageLoad
		$I->comment("Fill Shipping information");
		$I->comment("Entering Action Group [fillOrderShippingInfo] GuestCheckoutFillingShippingSectionActionGroup");
		$I->fillField("input[id*=customer-email]", msq("Simple_US_Customer") . "John.Doe@example.com"); // stepKey: enterEmailFillOrderShippingInfo
		$I->fillField("input[name=firstname]", "John"); // stepKey: enterFirstNameFillOrderShippingInfo
		$I->fillField("input[name=lastname]", "Doe"); // stepKey: enterLastNameFillOrderShippingInfo
		$I->fillField("input[name='street[0]']", "7700 West Parmer Lane"); // stepKey: enterStreetFillOrderShippingInfo
		$I->fillField("input[name=city]", "Austin"); // stepKey: enterCityFillOrderShippingInfo
		$I->selectOption("select[name=region_id]", "Texas"); // stepKey: selectRegionFillOrderShippingInfo
		$I->fillField("input[name=postcode]", "78729"); // stepKey: enterPostcodeFillOrderShippingInfo
		$I->fillField("input[name=telephone]", "512-345-6789"); // stepKey: enterTelephoneFillOrderShippingInfo
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskFillOrderShippingInfo
		$I->waitForElement("//div[@id='checkout-shipping-method-load']//td[contains(., '')]/..//input/following-sibling::label", 30); // stepKey: waitForShippingMethodFillOrderShippingInfo
		$I->click("//div[@id='checkout-shipping-method-load']//td[contains(., '')]/..//input/following-sibling::label"); // stepKey: selectShippingMethodFillOrderShippingInfo
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButtonFillOrderShippingInfo
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonFillOrderShippingInfoWaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNextFillOrderShippingInfo
		$I->waitForPageLoad(30); // stepKey: clickNextFillOrderShippingInfoWaitForPageLoad
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoadedFillOrderShippingInfo
		$I->seeInCurrentUrl("/checkout/#payment"); // stepKey: assertCheckoutPaymentUrlFillOrderShippingInfo
		$I->comment("Exiting Action Group [fillOrderShippingInfo] GuestCheckoutFillingShippingSectionActionGroup");
		$I->comment("Verify order summary on payment page");
		$I->comment("Entering Action Group [verifyCheckoutPaymentOrderSummaryActionGroup] VerifyCheckoutPaymentOrderSummaryActionGroup");
		$I->see("$158.42", "//tr[@class='totals sub']//span[@class='price']"); // stepKey: seeCorrectSubtotalVerifyCheckoutPaymentOrderSummaryActionGroup
		$I->see("$15.00", "//tr[@class='totals shipping excl']//span[@class='price']"); // stepKey: seeCorrectShippingVerifyCheckoutPaymentOrderSummaryActionGroup
		$I->see("$173.42", "//tr[@class='grand totals']//span[@class='price']"); // stepKey: seeCorrectOrderTotalVerifyCheckoutPaymentOrderSummaryActionGroup
		$I->comment("Exiting Action Group [verifyCheckoutPaymentOrderSummaryActionGroup] VerifyCheckoutPaymentOrderSummaryActionGroup");
	}
}
