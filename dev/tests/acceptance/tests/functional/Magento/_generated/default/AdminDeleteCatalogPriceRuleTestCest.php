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
 * @Title("MC-160: Admin should be able to delete catalog price rule")
 * @Description("Admin should be able to delete catalog price rule<h3>Test files</h3>vendor\magento\module-catalog-rule\Test\Mftf\Test\AdminDeleteCatalogPriceRuleTest.xml<br>")
 * @TestCaseId("MC-160")
 * @group CatalogRule
 */
class AdminDeleteCatalogPriceRuleTestCest
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
		$I->createEntity("createCategory", "hook", "ApiCategory", [], []); // stepKey: createCategory
		$I->createEntity("createSimpleProduct", "hook", "ApiSimpleProduct", ["createCategory"], []); // stepKey: createSimpleProduct
		$runCronIndex = $I->magentoCron("index", 90); // stepKey: runCronIndex
		$I->comment($runCronIndex);
		$I->comment("Login to Admin page");
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->comment("Create a configurable product");
		$I->comment("Entering Action Group [createConfigurableProduct] CreateConfigurableProductActionGroup");
		$I->comment("fill in basic configurable product values");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: amOnProductGridPageCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: wait1CreateConfigurableProduct
		$I->click(".action-toggle.primary.add"); // stepKey: clickOnAddProductToggleCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnAddProductToggleCreateConfigurableProductWaitForPageLoad
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-configurable']"); // stepKey: clickOnAddConfigurableProductCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnAddConfigurableProductCreateConfigurableProductWaitForPageLoad
		$I->fillField(".admin__field[data-index=name] input", "testProductName" . msq("_defaultProduct")); // stepKey: fillNameCreateConfigurableProduct
		$I->fillField(".admin__field[data-index=sku] input", "testSku" . msq("_defaultProduct")); // stepKey: fillSKUCreateConfigurableProduct
		$I->fillField(".admin__field[data-index=price] input", "123.00"); // stepKey: fillPriceCreateConfigurableProduct
		$I->fillField(".admin__field[data-index=qty] input", "100"); // stepKey: fillQuantityCreateConfigurableProduct
		$I->searchAndMultiSelectOption("div[data-index='category_ids']", [$I->retrieveEntityField('createCategory', 'name', 'hook')]); // stepKey: fillCategoryCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: fillCategoryCreateConfigurableProductWaitForPageLoad
		$I->selectOption("//select[@name='product[visibility]']", "4"); // stepKey: fillVisibilityCreateConfigurableProduct
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: openSeoSectionCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: openSeoSectionCreateConfigurableProductWaitForPageLoad
		$I->fillField("input[name='product[url_key]']", "testurlkey" . msq("_defaultProduct")); // stepKey: fillUrlKeyCreateConfigurableProduct
		$I->comment("create configurations for colors the product is available in");
		$I->click("button[data-index='create_configurable_products_button']"); // stepKey: clickOnCreateConfigurationsCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnCreateConfigurationsCreateConfigurableProductWaitForPageLoad
		$I->click(".select-attributes-actions button[title='Create New Attribute']"); // stepKey: clickOnNewAttributeCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNewAttributeCreateConfigurableProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForIFrameCreateConfigurableProduct
		$I->switchToIFrame("create_new_attribute_container"); // stepKey: switchToNewAttributeIFrameCreateConfigurableProduct
		$I->fillField("input[name='frontend_label[0]']", "Color" . msq("colorProductAttribute")); // stepKey: fillDefaultLabelCreateConfigurableProduct
		$I->click("#save"); // stepKey: clickOnNewAttributePanelCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: waitForSaveAttributeCreateConfigurableProduct
		$I->switchToIFrame(); // stepKey: switchOutOfIFrameCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: waitForFiltersCreateConfigurableProduct
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: clickOnFiltersCreateConfigurableProduct
		$I->fillField(".admin__control-text[name='attribute_code']", "Color" . msq("colorProductAttribute")); // stepKey: fillFilterAttributeCodeFieldCreateConfigurableProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersButtonCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersButtonCreateConfigurableProductWaitForPageLoad
		$I->click("tr[data-repeat-index='0'] .admin__control-checkbox"); // stepKey: clickOnFirstCheckboxCreateConfigurableProduct
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton1CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton1CreateConfigurableProductWaitForPageLoad
		$I->waitForElementVisible(".action-create-new", 30); // stepKey: waitCreateNewValueAppearsCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: waitCreateNewValueAppearsCreateConfigurableProductWaitForPageLoad
		$I->click(".action-create-new"); // stepKey: clickOnCreateNewValue1CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnCreateNewValue1CreateConfigurableProductWaitForPageLoad
		$I->fillField("li[data-attribute-option-title=''] .admin__field-create-new .admin__control-text", "White" . msq("colorProductAttribute1")); // stepKey: fillFieldForNewAttribute1CreateConfigurableProduct
		$I->click("li[data-attribute-option-title=''] .action-save"); // stepKey: clickOnSaveNewAttribute1CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnSaveNewAttribute1CreateConfigurableProductWaitForPageLoad
		$I->click(".action-create-new"); // stepKey: clickOnCreateNewValue2CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnCreateNewValue2CreateConfigurableProductWaitForPageLoad
		$I->fillField("li[data-attribute-option-title=''] .admin__field-create-new .admin__control-text", "Red" . msq("colorProductAttribute2")); // stepKey: fillFieldForNewAttribute2CreateConfigurableProduct
		$I->click("li[data-attribute-option-title=''] .action-save"); // stepKey: clickOnSaveNewAttribute2CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnSaveNewAttribute2CreateConfigurableProductWaitForPageLoad
		$I->click(".action-create-new"); // stepKey: clickOnCreateNewValue3CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnCreateNewValue3CreateConfigurableProductWaitForPageLoad
		$I->fillField("li[data-attribute-option-title=''] .admin__field-create-new .admin__control-text", "Blue" . msq("colorProductAttribute3")); // stepKey: fillFieldForNewAttribute3CreateConfigurableProduct
		$I->click("li[data-attribute-option-title=''] .action-save"); // stepKey: clickOnSaveNewAttribute3CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnSaveNewAttribute3CreateConfigurableProductWaitForPageLoad
		$I->click(".action-select-all"); // stepKey: clickOnSelectAllCreateConfigurableProduct
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton2CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton2CreateConfigurableProductWaitForPageLoad
		$I->click(".admin__field-label[for='apply-unique-prices-radio']"); // stepKey: clickOnApplyUniquePricesByAttributeToEachSkuCreateConfigurableProduct
		$I->selectOption("#select-each-price", "Color" . msq("colorProductAttribute")); // stepKey: selectAttributesCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: selectAttributesCreateConfigurableProductWaitForPageLoad
		$I->fillField("#apply-single-price-input-0", "1.00"); // stepKey: fillAttributePrice1CreateConfigurableProduct
		$I->fillField("#apply-single-price-input-1", "2.00"); // stepKey: fillAttributePrice2CreateConfigurableProduct
		$I->fillField("#apply-single-price-input-2", "3.00"); // stepKey: fillAttributePrice3CreateConfigurableProduct
		$I->click(".admin__field-label[for='apply-single-inventory-radio']"); // stepKey: clickOnApplySingleQuantityToEachSkuCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnApplySingleQuantityToEachSkuCreateConfigurableProductWaitForPageLoad
		$I->fillField("#apply-single-inventory-input", "1"); // stepKey: enterAttributeQuantityCreateConfigurableProduct
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton3CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton3CreateConfigurableProductWaitForPageLoad
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton4CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton4CreateConfigurableProductWaitForPageLoad
		$I->click("#save-button"); // stepKey: clickOnSaveButton2CreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnSaveButton2CreateConfigurableProductWaitForPageLoad
		$I->click("button[data-index='confirm_button']"); // stepKey: clickOnConfirmInPopupCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickOnConfirmInPopupCreateConfigurableProductWaitForPageLoad
		$I->seeElement(".message.message-success.success"); // stepKey: seeSaveProductMessageCreateConfigurableProduct
		$I->seeInTitle("testProductName" . msq("_defaultProduct")); // stepKey: seeProductNameInTitleCreateConfigurableProduct
		$I->comment("Exiting Action Group [createConfigurableProduct] CreateConfigurableProductActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteSimpleProduct
		$I->comment("Entering Action Group [deleteConfigurableProduct] DeleteProductBySkuActionGroup");
		$I->comment("TODO use other action group for filtering grid when MQE-539 is implemented");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: visitAdminProductPageDeleteConfigurableProduct
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersDeleteConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersDeleteConfigurableProductWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersDeleteConfigurableProduct
		$I->fillField("input.admin__control-text[name='sku']", "testSku" . msq("_defaultProduct")); // stepKey: fillProductSkuFilterDeleteConfigurableProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersDeleteConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersDeleteConfigurableProductWaitForPageLoad
		$I->see("testSku" . msq("_defaultProduct"), "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[normalize-space(.)='SKU']/preceding-sibling::th) +1 ]"); // stepKey: seeProductSkuInGridDeleteConfigurableProduct
		$I->click("div[data-role='grid-wrapper'] th.data-grid-multicheck-cell button.action-multicheck-toggle"); // stepKey: openMulticheckDropdownDeleteConfigurableProduct
		$I->click("//div[@data-role='grid-wrapper']//th[contains(@class, data-grid-multicheck-cell)]//li//span[text() = 'Select All']"); // stepKey: selectAllProductInFilteredGridDeleteConfigurableProduct
		$I->click("div.admin__data-grid-header-row.row div.action-select-wrap button.action-select"); // stepKey: clickActionDropdownDeleteConfigurableProduct
		$I->click("//div[contains(@class,'admin__data-grid-header-row') and contains(@class, 'row')]//div[contains(@class, 'action-select-wrap')]//ul/li/span[text() = 'Delete']"); // stepKey: clickDeleteActionDeleteConfigurableProduct
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitForConfirmModalDeleteConfigurableProduct
		$I->waitForPageLoad(60); // stepKey: waitForConfirmModalDeleteConfigurableProductWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmProductDeleteDeleteConfigurableProduct
		$I->waitForPageLoad(60); // stepKey: confirmProductDeleteDeleteConfigurableProductWaitForPageLoad
		$I->see("record(s) have been deleted.", "#messages div.message-success"); // stepKey: seeSuccessMessageDeleteConfigurableProduct
		$I->comment("Exiting Action Group [deleteConfigurableProduct] DeleteProductBySkuActionGroup");
		$I->comment("Entering Action Group [clearProductsGridFilters] ClearFiltersAdminDataGridActionGroup");
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersClearProductsGridFilters
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersClearProductsGridFiltersWaitForPageLoad
		$I->comment("Exiting Action Group [clearProductsGridFilters] ClearFiltersAdminDataGridActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog_rule/promo_catalog/"); // stepKey: goToCatalogRuleGridPage
		$I->waitForPageLoad(30); // stepKey: waitForCatalogRuleGridPageLoaded
		$I->comment("Entering Action Group [clearCatalogRuleGridFilters] ClearFiltersAdminDataGridActionGroup");
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersClearCatalogRuleGridFilters
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersClearCatalogRuleGridFiltersWaitForPageLoad
		$I->comment("Exiting Action Group [clearCatalogRuleGridFilters] ClearFiltersAdminDataGridActionGroup");
		$I->comment("Entering Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAmOnLogoutPage
		$I->comment("Exiting Action Group [amOnLogoutPage] AdminLogoutActionGroup");
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
	 * @Stories({"Delete Catalog Price Rule"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminDeleteCatalogPriceRuleTest(AcceptanceTester $I)
	{
		$I->comment("Create a catalog price rule");
		$I->comment("Entering Action Group [createNewPriceRule] NewCatalogPriceRuleByUIActionGroup");
		$I->comment("Go to the admin Catalog rule grid and add a new one");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog_rule/promo_catalog/"); // stepKey: goToPriceRulePageCreateNewPriceRule
		$I->waitForPageLoad(30); // stepKey: waitForPriceRulePageCreateNewPriceRule
		$I->click("#add"); // stepKey: addNewRuleCreateNewPriceRule
		$I->waitForPageLoad(30); // stepKey: addNewRuleCreateNewPriceRuleWaitForPageLoad
		$I->comment("Fill the form according the attributes of the entity");
		$I->fillField("[name='name']", "CatalogPriceRule" . msq("_defaultCatalogRule")); // stepKey: fillNameCreateNewPriceRule
		$I->fillField("[name='description']", "Catalog Price Rule Description"); // stepKey: fillDescriptionCreateNewPriceRule
		$I->click("input[name='is_active']+label"); // stepKey: selectActiveCreateNewPriceRule
		$I->selectOption("[name='website_ids']", "1"); // stepKey: selectSiteCreateNewPriceRule
		$I->click("[name='from_date'] + button"); // stepKey: clickFromCalenderCreateNewPriceRule
		$I->waitForPageLoad(15); // stepKey: clickFromCalenderCreateNewPriceRuleWaitForPageLoad
		$I->click("#ui-datepicker-div [data-handler='today']"); // stepKey: clickFromTodayCreateNewPriceRule
		$I->click("[name='to_date'] + button"); // stepKey: clickToCalenderCreateNewPriceRule
		$I->waitForPageLoad(15); // stepKey: clickToCalenderCreateNewPriceRuleWaitForPageLoad
		$I->click("#ui-datepicker-div [data-handler='today']"); // stepKey: clickToTodayCreateNewPriceRule
		$I->click("[data-index='actions']"); // stepKey: openActionDropdownCreateNewPriceRule
		$I->fillField("[name='discount_amount']", "10"); // stepKey: fillDiscountValueCreateNewPriceRule
		$I->selectOption("[name='simple_action']", "by_percent"); // stepKey: discountTypeCreateNewPriceRule
		$I->selectOption("[name='stop_rules_processing']", "Yes"); // stepKey: discardSubsequentRulesCreateNewPriceRule
		$I->comment("Scroll to top and either save or save and apply after the action group");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopCreateNewPriceRule
		$I->waitForPageLoad(30); // stepKey: waitForAppliedCreateNewPriceRule
		$I->comment("Exiting Action Group [createNewPriceRule] NewCatalogPriceRuleByUIActionGroup");
		$I->comment("Entering Action Group [selectNotLoggedInCustomerGroup] SelectNotLoggedInCustomerGroupActionGroup");
		$I->comment("This actionGroup was created to be merged from B2B because B2B has a very different form control here");
		$I->selectOption("select[name='customer_group_ids']", "NOT LOGGED IN"); // stepKey: selectCustomerGroupSelectNotLoggedInCustomerGroup
		$I->comment("Exiting Action Group [selectNotLoggedInCustomerGroup] SelectNotLoggedInCustomerGroupActionGroup");
		$I->click("#save_and_apply"); // stepKey: saveAndApply
		$I->waitForPageLoad(30); // stepKey: saveAndApplyWaitForPageLoad
		$I->see("You saved the rule.", ".message-success"); // stepKey: assertSuccess
		$I->comment("Verify that category page shows the discount");
		$I->amOnPage($I->retrieveEntityField('createCategory', 'name', 'test') . ".html"); // stepKey: goToCategoryPage1
		$I->see($I->retrieveEntityField('createSimpleProduct', 'name', 'test'), "//main//li//a[contains(text(), 'Api Simple Product" . msq("ApiSimpleProduct") . "')]"); // stepKey: seeSimpleProduct1
		$I->see("$110.70", "//main//li[.//a[contains(text(), 'Api Simple Product" . msq("ApiSimpleProduct") . "')]]//span[@class='price']"); // stepKey: seeSimpleProductDiscount1
		$I->see("testProductName" . msq("_defaultProduct"), "//main//li//a[contains(text(), 'testProductName" . msq("_defaultProduct") . "')]"); // stepKey: seeConfigurableProduct1
		$I->see("$0.90", "//main//li[.//a[contains(text(), 'testProductName" . msq("_defaultProduct") . "')]]//span[@class='price']"); // stepKey: seeConfigurableProductDiscount1
		$I->comment("Verify that the simple product page shows the discount");
		$I->amOnPage($I->retrieveEntityField('createSimpleProduct', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: goToSimpleProductPage1
		$I->see($I->retrieveEntityField('createSimpleProduct', 'name', 'test'), ".base"); // stepKey: seeCorrectName1
		$I->comment("Entering Action Group [seeCorrectSku1] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see($I->retrieveEntityField('createSimpleProduct', 'sku', 'test'), ".product.attribute.sku>.value"); // stepKey: seeProductSkuSeeCorrectSku1
		$I->comment("Exiting Action Group [seeCorrectSku1] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("$110.70", "div.price-box.price-final_price"); // stepKey: seeCorrectPrice1
		$I->comment("Verify that the configurable product page the catalog price rule discount");
		$I->amOnPage("testurlkey" . msq("_defaultProduct") . ".html"); // stepKey: goToConfigurableProductPage1
		$I->see("testProductName" . msq("_defaultProduct"), ".base"); // stepKey: seeCorrectName2
		$I->comment("Entering Action Group [seeCorrectSku2] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("testSku" . msq("_defaultProduct"), ".product.attribute.sku>.value"); // stepKey: seeProductSkuSeeCorrectSku2
		$I->comment("Exiting Action Group [seeCorrectSku2] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("$0.90", "div.price-box.price-final_price"); // stepKey: seeCorrectPrice2
		$I->comment("Delete the rule");
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
		$I->comment("Apply and flush the cache");
		$I->click("#apply_rules"); // stepKey: clickApplyRules
		$I->waitForPageLoad(30); // stepKey: clickApplyRulesWaitForPageLoad
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Verify that category page shows the original prices");
		$I->amOnPage($I->retrieveEntityField('createCategory', 'name', 'test') . ".html"); // stepKey: goToCategoryPage2
		$I->see($I->retrieveEntityField('createSimpleProduct', 'name', 'test'), "//main//li//a[contains(text(), 'Api Simple Product" . msq("ApiSimpleProduct") . "')]"); // stepKey: seeSimpleProduct2
		$I->see("$123.00", "//main//li[.//a[contains(text(), 'Api Simple Product" . msq("ApiSimpleProduct") . "')]]//span[@class='price']"); // stepKey: seeSimpleProductDiscount2
		$I->see("testProductName" . msq("_defaultProduct"), "//main//li//a[contains(text(), 'testProductName" . msq("_defaultProduct") . "')]"); // stepKey: seeConfigurableProduct2
		$I->see("$1.00", "//main//li[.//a[contains(text(), 'testProductName" . msq("_defaultProduct") . "')]]//span[@class='price']"); // stepKey: seeConfigurableProductDiscount2
		$I->comment("Verify that the simple product page shows the original price");
		$I->amOnPage($I->retrieveEntityField('createSimpleProduct', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: goToSimpleProductPage2
		$I->see($I->retrieveEntityField('createSimpleProduct', 'name', 'test'), ".base"); // stepKey: seeCorrectName3
		$I->comment("Entering Action Group [seeCorrectSku3] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see($I->retrieveEntityField('createSimpleProduct', 'sku', 'test'), ".product.attribute.sku>.value"); // stepKey: seeProductSkuSeeCorrectSku3
		$I->comment("Exiting Action Group [seeCorrectSku3] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("$123.00", "div.price-box.price-final_price"); // stepKey: seeCorrectPrice3
		$I->comment("Verify that the configurable product page shows the original price");
		$I->amOnPage("testurlkey" . msq("_defaultProduct") . ".html"); // stepKey: goToConfigurableProductPage2
		$I->see("testProductName" . msq("_defaultProduct"), ".base"); // stepKey: seeCorrectName4
		$I->comment("Entering Action Group [seeCorrectSku4] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("testSku" . msq("_defaultProduct"), ".product.attribute.sku>.value"); // stepKey: seeProductSkuSeeCorrectSku4
		$I->comment("Exiting Action Group [seeCorrectSku4] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("$1.00", "div.price-box.price-final_price"); // stepKey: seeCorrectPrice4
	}
}
