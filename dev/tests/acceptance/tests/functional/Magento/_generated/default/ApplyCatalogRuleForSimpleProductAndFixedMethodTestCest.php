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
 * @Title("MC-14771: Admin should be able to apply the catalog price rule for simple product with custom options")
 * @Description("Admin should be able to apply the catalog price rule for simple product with custom options<h3>Test files</h3>vendor\magento\module-catalog-rule\Test\Mftf\Test\ApplyCatalogRuleForSimpleProductAndFixedMethodTest.xml<br>")
 * @TestCaseId("MC-14771")
 * @group CatalogRule
 * @group mtf_migrated
 */
class ApplyCatalogRuleForSimpleProductAndFixedMethodTestCest
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
		$I->comment("Create category");
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->comment("Create Simple Product");
		$createProduct1Fields['price'] = "56.78";
		$I->createEntity("createProduct1", "hook", "_defaultProduct", ["createCategory"], $createProduct1Fields); // stepKey: createProduct1
		$I->comment("Update all products to have custom options");
		$I->updateEntity("createProduct1", "hook", "productWithFixedOptions",[]); // stepKey: updateProductWithOptions1
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
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->comment("Delete the catalog price rule");
		$I->comment("Entering Action Group [goToPriceRulePage] AdminOpenCatalogPriceRulePageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog_rule/promo_catalog/"); // stepKey: openCatalogRulePageGoToPriceRulePage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadGoToPriceRulePage
		$I->comment("Exiting Action Group [goToPriceRulePage] AdminOpenCatalogPriceRulePageActionGroup");
		$I->comment("Entering Action Group [deletePriceRule] deleteEntitySecondaryGrid");
		$I->comment("search for the name");
		$I->click("[title='Reset Filter']"); // stepKey: resetFiltersDeletePriceRule
		$I->fillField(".col-name .admin__control-text", "CatalogPriceRule" . msq("CatalogRuleByFixed")); // stepKey: fillIdentifierDeletePriceRule
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
	public function ApplyCatalogRuleForSimpleProductAndFixedMethodTest(AcceptanceTester $I)
	{
		$I->comment("1. Begin creating a new catalog price rule");
		$I->comment("Entering Action Group [newCatalogPriceRuleByUIWithConditionIsCategory] NewCatalogPriceRuleByUIWithConditionIsCategoryActionGroup");
		$I->comment("Go to the admin Catalog rule grid and add a new one");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog_rule/promo_catalog/"); // stepKey: goToPriceRulePageNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: waitForPriceRulePageNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->click("#add"); // stepKey: addNewRuleNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->waitForPageLoad(30); // stepKey: addNewRuleNewCatalogPriceRuleByUIWithConditionIsCategoryWaitForPageLoad
		$I->comment("Fill the form according the attributes of the entity");
		$I->fillField("[name='name']", "CatalogPriceRule" . msq("CatalogRuleByFixed")); // stepKey: fillNameNewCatalogPriceRuleByUIWithConditionIsCategory
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
		$I->fillField("[name='discount_amount']", "12.3"); // stepKey: fillDiscountValueNewCatalogPriceRuleByUIWithConditionIsCategory
		$I->selectOption("[name='simple_action']", "by_fixed"); // stepKey: discountTypeNewCatalogPriceRuleByUIWithConditionIsCategory
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
		$I->comment("Check product 1 name on store front category page");
		$I->comment("Entering Action Group [storefrontProduct1Name] AssertProductDetailsOnStorefrontActionGroup");
		$I->see($I->retrieveEntityField('createProduct1', 'name', 'test'), "//main//li[1]//div[@class='product-item-info']"); // stepKey: seeProductInfoStorefrontProduct1Name
		$I->comment("Exiting Action Group [storefrontProduct1Name] AssertProductDetailsOnStorefrontActionGroup");
		$I->comment("Check product 1 price on store front category page");
		$I->comment("Entering Action Group [storefrontProduct1Price] AssertProductDetailsOnStorefrontActionGroup");
		$I->see("$44.48", "//main//li[1]//div[@class='product-item-info']"); // stepKey: seeProductInfoStorefrontProduct1Price
		$I->comment("Exiting Action Group [storefrontProduct1Price] AssertProductDetailsOnStorefrontActionGroup");
		$I->comment("Check product 1 regular price on store front category page");
		$I->comment("Entering Action Group [storefrontProduct1RegularPrice] AssertProductDetailsOnStorefrontActionGroup");
		$I->see("$56.78", "//main//li[1]//div[@class='product-item-info']"); // stepKey: seeProductInfoStorefrontProduct1RegularPrice
		$I->comment("Exiting Action Group [storefrontProduct1RegularPrice] AssertProductDetailsOnStorefrontActionGroup");
		$I->comment("Navigate to product 1 on store front");
		$I->amOnPage("/" . $I->retrieveEntityField('createProduct1', 'name', 'test') . ".html"); // stepKey: goToProductPage1
		$I->comment("Assert regular and special price after selecting ProductOptionValueDropdown1");
		$I->comment("Entering Action Group [storefrontSelectCustomOptionAndAssertPrices1] StorefrontSelectCustomOptionRadioAndAssertPricesActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductPageLoadStorefrontSelectCustomOptionAndAssertPrices1
		$I->click("//label[contains(.,'OptionRadioButtons')]/../div[@class='control']//span[@data-price-amount='99.99']"); // stepKey: clickRadioButtonsProductOptionStorefrontSelectCustomOptionAndAssertPrices1
		$I->see("$156.77", "div.price-box.price-final_price"); // stepKey: productPriceAmountStorefrontSelectCustomOptionAndAssertPrices1
		$I->see("$144.47", "div.price-box.price-final_price [data-price-type='finalPrice'] .price"); // stepKey: productFinalPriceAmountStorefrontSelectCustomOptionAndAssertPrices1
		$I->comment("Exiting Action Group [storefrontSelectCustomOptionAndAssertPrices1] StorefrontSelectCustomOptionRadioAndAssertPricesActionGroup");
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
		$I->comment("Assert sub total on mini shopping cart");
		$I->comment("Entering Action Group [assertSubTotalOnStorefrontMiniCart] AssertSubTotalOnStorefrontMiniCartActionGroup");
		$I->waitForElementVisible("a.showcart", 30); // stepKey: waitForShowCartButtonVisibleAssertSubTotalOnStorefrontMiniCart
		$I->waitForPageLoad(60); // stepKey: waitForShowCartButtonVisibleAssertSubTotalOnStorefrontMiniCartWaitForPageLoad
		$I->click("a.showcart"); // stepKey: clickOnMiniCartAssertSubTotalOnStorefrontMiniCart
		$I->waitForPageLoad(60); // stepKey: clickOnMiniCartAssertSubTotalOnStorefrontMiniCartWaitForPageLoad
		$grabTextFromMiniCartSubtotalFieldAssertSubTotalOnStorefrontMiniCart = $I->grabTextFrom(".block-minicart .amount span.price"); // stepKey: grabTextFromMiniCartSubtotalFieldAssertSubTotalOnStorefrontMiniCart
		$I->assertEquals("$144.47", $grabTextFromMiniCartSubtotalFieldAssertSubTotalOnStorefrontMiniCart, "Mini shopping cart should contain subtotal $144.47"); // stepKey: assertSubtotalFieldFromMiniShoppingCart1AssertSubTotalOnStorefrontMiniCart
		$I->comment("Exiting Action Group [assertSubTotalOnStorefrontMiniCart] AssertSubTotalOnStorefrontMiniCartActionGroup");
	}
}
