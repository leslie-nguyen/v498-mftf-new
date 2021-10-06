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
 * @Title("MC-10818: Update Simple Product with Regular Price (In Stock) Enabled Flat")
 * @Description("Test log in to Update Simple Product and Update Simple Product with Regular Price (In Stock) Enabled Flat<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminUpdateSimpleProductWithRegularPriceInStockEnabledFlatTest.xml<br>")
 * @TestCaseId("MC-10818")
 * @group catalog
 * @group mtf_migrated
 */
class AdminUpdateSimpleProductWithRegularPriceInStockEnabledFlatTestCest
{
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
		$setFlatCatalogProduct = $I->magentoCLI("config:set catalog/frontend/flat_catalog_product 1", 60); // stepKey: setFlatCatalogProduct
		$I->comment($setFlatCatalogProduct);
		$I->createEntity("initialCategoryEntity", "hook", "SimpleSubCategory", [], []); // stepKey: initialCategoryEntity
		$I->createEntity("initialSimpleProduct", "hook", "defaultSimpleProduct", ["initialCategoryEntity"], []); // stepKey: initialSimpleProduct
		$I->createEntity("categoryEntity", "hook", "SimpleSubCategory", [], []); // stepKey: categoryEntity
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("initialCategoryEntity", "hook"); // stepKey: deleteSimpleSubCategory
		$I->deleteEntity("categoryEntity", "hook"); // stepKey: deleteSimpleSubCategory2
		$I->comment("Entering Action Group [deleteCreatedProduct] DeleteProductBySkuActionGroup");
		$I->comment("TODO use other action group for filtering grid when MQE-539 is implemented");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: visitAdminProductPageDeleteCreatedProduct
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersDeleteCreatedProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersDeleteCreatedProductWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersDeleteCreatedProduct
		$I->fillField("input.admin__control-text[name='sku']", "test_simple_product_sku" . msq("simpleProductEnabledFlat")); // stepKey: fillProductSkuFilterDeleteCreatedProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersDeleteCreatedProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersDeleteCreatedProductWaitForPageLoad
		$I->see("test_simple_product_sku" . msq("simpleProductEnabledFlat"), "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[normalize-space(.)='SKU']/preceding-sibling::th) +1 ]"); // stepKey: seeProductSkuInGridDeleteCreatedProduct
		$I->click("div[data-role='grid-wrapper'] th.data-grid-multicheck-cell button.action-multicheck-toggle"); // stepKey: openMulticheckDropdownDeleteCreatedProduct
		$I->click("//div[@data-role='grid-wrapper']//th[contains(@class, data-grid-multicheck-cell)]//li//span[text() = 'Select All']"); // stepKey: selectAllProductInFilteredGridDeleteCreatedProduct
		$I->click("div.admin__data-grid-header-row.row div.action-select-wrap button.action-select"); // stepKey: clickActionDropdownDeleteCreatedProduct
		$I->click("//div[contains(@class,'admin__data-grid-header-row') and contains(@class, 'row')]//div[contains(@class, 'action-select-wrap')]//ul/li/span[text() = 'Delete']"); // stepKey: clickDeleteActionDeleteCreatedProduct
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitForConfirmModalDeleteCreatedProduct
		$I->waitForPageLoad(60); // stepKey: waitForConfirmModalDeleteCreatedProductWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmProductDeleteDeleteCreatedProduct
		$I->waitForPageLoad(60); // stepKey: confirmProductDeleteDeleteCreatedProductWaitForPageLoad
		$I->see("record(s) have been deleted.", "#messages div.message-success"); // stepKey: seeSuccessMessageDeleteCreatedProduct
		$I->comment("Exiting Action Group [deleteCreatedProduct] DeleteProductBySkuActionGroup");
		$I->comment("Entering Action Group [logout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageLogout
		$I->comment("Exiting Action Group [logout] AdminLogoutActionGroup");
		$unsetFlatCatalogProduct = $I->magentoCLI("config:set catalog/frontend/flat_catalog_product 0", 60); // stepKey: unsetFlatCatalogProduct
		$I->comment($unsetFlatCatalogProduct);
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
	 * @Stories({"Update Simple Product"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminUpdateSimpleProductWithRegularPriceInStockEnabledFlatTest(AcceptanceTester $I)
	{
		$I->comment("Search default simple product in the grid page");
		$I->comment("Entering Action Group [openProductCatalogPage] AdminProductCatalogPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/"); // stepKey: openProductCatalogPageOpenProductCatalogPage
		$I->waitForPageLoad(30); // stepKey: waitForProductCatalogPageLoadOpenProductCatalogPage
		$I->comment("Exiting Action Group [openProductCatalogPage] AdminProductCatalogPageOpenActionGroup");
		$I->comment("Entering Action Group [filterProductGrid] FilterProductGridBySku2ActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersFilterProductGrid
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersFilterProductGridWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersFilterProductGrid
		$I->fillField("input.admin__control-text[name='sku']", $I->retrieveEntityField('initialSimpleProduct', 'sku', 'test')); // stepKey: fillProductSkuFilterFilterProductGrid
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersFilterProductGrid
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersFilterProductGridWaitForPageLoad
		$I->waitForElementNotVisible(".admin__data-grid-loading-mask[data-component*='product_listing']", 30); // stepKey: waitForFilteredGridLoadFilterProductGrid
		$I->comment("Exiting Action Group [filterProductGrid] FilterProductGridBySku2ActionGroup");
		$I->click(".data-row:nth-of-type(1)"); // stepKey: clickFirstRowToOpenDefaultSimpleProduct
		$I->waitForPageLoad(30); // stepKey: clickFirstRowToOpenDefaultSimpleProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitUntilProductIsOpened
		$I->comment("Update simple product with regular price");
		$I->fillField(".admin__field[data-index=name] input", "TestSimpleProduct" . msq("simpleProductEnabledFlat")); // stepKey: fillSimpleProductName
		$I->fillField(".admin__field[data-index=sku] input", "test_simple_product_sku" . msq("simpleProductEnabledFlat")); // stepKey: fillSimpleProductSku
		$I->fillField(".admin__field[data-index=price] input", "1.99"); // stepKey: fillSimpleProductPrice
		$I->selectOption("//*[@name='product[tax_class_id]']", "Taxable Goods"); // stepKey: selectProductTaxClass
		$I->fillField(".admin__field[data-index=qty] input", "1000"); // stepKey: fillSimpleProductQuantity
		$I->comment("Entering Action Group [clickAdvancedInventoryLink] AdminClickOnAdvancedInventoryLinkActionGroup");
		$I->click("button[data-index='advanced_inventory_button'].action-additional"); // stepKey: clickOnAdvancedInventoryLinkClickAdvancedInventoryLink
		$I->waitForPageLoad(30); // stepKey: clickOnAdvancedInventoryLinkClickAdvancedInventoryLinkWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAdvancedInventoryPageToLoadClickAdvancedInventoryLink
		$I->comment("Exiting Action Group [clickAdvancedInventoryLink] AdminClickOnAdvancedInventoryLinkActionGroup");
		$I->conditionalClick("//input[@name='product[stock_data][use_config_manage_stock]']", "//input[@name='product[stock_data][use_config_manage_stock]']", true); // stepKey: checkUseConfigSettingsCheckBox
		$I->selectOption("//*[@name='product[stock_data][manage_stock]']", "No"); // stepKey: selectManageStock
		$I->waitForPageLoad(30); // stepKey: selectManageStockWaitForPageLoad
		$I->comment("Entering Action Group [clickDoneButtonOnAdvancedInventorySection] AdminSubmitAdvancedInventoryFormActionGroup");
		$I->click("//aside[contains(@class,'product_form_product_form_advanced_inventory_modal')]//button[contains(@data-role,'action')]"); // stepKey: clickOnDoneButtonClickDoneButtonOnAdvancedInventorySection
		$I->waitForPageLoad(5); // stepKey: clickOnDoneButtonClickDoneButtonOnAdvancedInventorySectionWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductPageToLoadClickDoneButtonOnAdvancedInventorySection
		$I->comment("Exiting Action Group [clickDoneButtonOnAdvancedInventorySection] AdminSubmitAdvancedInventoryFormActionGroup");
		$I->selectOption("[data-index='product-details'] select[name='product[quantity_and_stock_status][is_in_stock]']", "1"); // stepKey: selectStockStatusInStock
		$I->fillField(".admin__field[data-index=weight] input", "1"); // stepKey: fillSimpleProductWeight
		$I->selectOption("select[name='product[product_has_weight]']", "This item has weight"); // stepKey: selectProductWeight
		$I->click("div[data-index='category_ids']"); // stepKey: clickCategoriesDropDown
		$I->waitForPageLoad(30); // stepKey: clickCategoriesDropDownWaitForPageLoad
		$I->fillField("//*[@data-index='category_ids']//input[contains(@class, 'multiselect-search')]", $I->retrieveEntityField('initialCategoryEntity', 'name', 'test')); // stepKey: fillSearchForInitialCategory
		$I->waitForPageLoad(30); // stepKey: fillSearchForInitialCategoryWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCategory1
		$I->click("//*[@data-index='category_ids']//label[contains(., '" . $I->retrieveEntityField('initialCategoryEntity', 'name', 'test') . "')]"); // stepKey: unselectInitialCategory
		$I->waitForPageLoad(30); // stepKey: unselectInitialCategoryWaitForPageLoad
		$I->fillField("//*[@data-index='category_ids']//input[contains(@class, 'multiselect-search')]", $I->retrieveEntityField('categoryEntity', 'name', 'test')); // stepKey: fillSearchCategory
		$I->waitForPageLoad(30); // stepKey: fillSearchCategoryWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCategory2
		$I->click("//*[@data-index='category_ids']//label[contains(., '" . $I->retrieveEntityField('categoryEntity', 'name', 'test') . "')]"); // stepKey: clickOnCategory
		$I->waitForPageLoad(30); // stepKey: clickOnCategoryWaitForPageLoad
		$I->comment("Entering Action Group [clickOnDoneAdvancedCategorySelect] AdminSubmitCategoriesPopupActionGroup");
		$I->click("//*[@data-index='category_ids']//button[@data-action='close-advanced-select']"); // stepKey: clickOnDoneButtonClickOnDoneAdvancedCategorySelect
		$I->waitForPageLoad(30); // stepKey: clickOnDoneButtonClickOnDoneAdvancedCategorySelectWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCategoryApplyClickOnDoneAdvancedCategorySelect
		$I->comment("Exiting Action Group [clickOnDoneAdvancedCategorySelect] AdminSubmitCategoriesPopupActionGroup");
		$I->selectOption("//select[@name='product[visibility]']", "Catalog, Search"); // stepKey: selectVisibility
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: clickAdminProductSEOSection
		$I->waitForPageLoad(30); // stepKey: clickAdminProductSEOSectionWaitForPageLoad
		$I->fillField("input[name='product[url_key]']", "test-simple-product" . msq("simpleProductEnabledFlat")); // stepKey: fillUrlKey
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfAdminProductFormSection
		$I->comment("Entering Action Group [clickSaveButton] AdminProductFormSaveButtonClickActionGroup");
		$I->click("#save-button"); // stepKey: clickSaveButtonClickSaveButton
		$I->waitForPageLoad(30); // stepKey: clickSaveButtonClickSaveButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavedClickSaveButton
		$I->comment("Exiting Action Group [clickSaveButton] AdminProductFormSaveButtonClickActionGroup");
		$I->comment("Verify customer see success message");
		$I->see("You saved the product.", "#messages"); // stepKey: seeAssertSimpleProductSaveSuccessMessage
		$I->comment("Search updated simple product(from above step) in the grid page");
		$I->comment("Entering Action Group [openProductCatalogPageToSearchUpdatedSimpleProduct] AdminProductCatalogPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/"); // stepKey: openProductCatalogPageOpenProductCatalogPageToSearchUpdatedSimpleProduct
		$I->waitForPageLoad(30); // stepKey: waitForProductCatalogPageLoadOpenProductCatalogPageToSearchUpdatedSimpleProduct
		$I->comment("Exiting Action Group [openProductCatalogPageToSearchUpdatedSimpleProduct] AdminProductCatalogPageOpenActionGroup");
		$I->conditionalClick(".admin__data-grid-header .admin__data-grid-filters-current._show .action-clear", ".admin__data-grid-header .admin__data-grid-filters-current._show .action-clear", true); // stepKey: clickClearAll
		$I->waitForPageLoad(30); // stepKey: clickClearAllWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: clickFiltersButton
		$I->fillField("input.admin__control-text[name='name']", "TestSimpleProduct" . msq("simpleProductEnabledFlat")); // stepKey: fillSimpleProductNameInNameFilter
		$I->fillField("input.admin__control-text[name='sku']", "test_simple_product_sku" . msq("simpleProductEnabledFlat")); // stepKey: fillProductSku
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersButton
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersButtonWaitForPageLoad
		$I->click(".data-row:nth-of-type(1)"); // stepKey: clickFirstRowToVerifyUpdatedSimpleProductVisibleInGrid
		$I->waitForPageLoad(30); // stepKey: clickFirstRowToVerifyUpdatedSimpleProductVisibleInGridWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitUntilSimpleProductPageIsOpened
		$I->comment("Verify customer see updated simple product in the product form page");
		$I->seeInField(".admin__field[data-index=name] input", "TestSimpleProduct" . msq("simpleProductEnabledFlat")); // stepKey: seeSimpleProductName
		$I->seeInField(".admin__field[data-index=sku] input", "test_simple_product_sku" . msq("simpleProductEnabledFlat")); // stepKey: seeSimpleProductSku
		$I->seeInField(".admin__field[data-index=price] input", "1.99"); // stepKey: seeSimpleProductPrice
		$I->seeInField("//*[@name='product[tax_class_id]']", "Taxable Goods"); // stepKey: seeProductTaxClass
		$I->seeInField(".admin__field[data-index=qty] input", "1000"); // stepKey: seeSimpleProductQuantity
		$I->comment("Entering Action Group [clickTheAdvancedInventoryLink] AdminClickOnAdvancedInventoryLinkActionGroup");
		$I->click("button[data-index='advanced_inventory_button'].action-additional"); // stepKey: clickOnAdvancedInventoryLinkClickTheAdvancedInventoryLink
		$I->waitForPageLoad(30); // stepKey: clickOnAdvancedInventoryLinkClickTheAdvancedInventoryLinkWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAdvancedInventoryPageToLoadClickTheAdvancedInventoryLink
		$I->comment("Exiting Action Group [clickTheAdvancedInventoryLink] AdminClickOnAdvancedInventoryLinkActionGroup");
		$I->see("No", "//*[@name='product[stock_data][manage_stock]']"); // stepKey: seeManageStock
		$I->waitForPageLoad(30); // stepKey: seeManageStockWaitForPageLoad
		$I->click(".product_form_product_form_advanced_inventory_modal button.action-close"); // stepKey: clickDoneButtonOnAdvancedInventory
		$I->waitForPageLoad(30); // stepKey: clickDoneButtonOnAdvancedInventoryWaitForPageLoad
		$I->seeInField("select[name='product[quantity_and_stock_status][is_in_stock]']", "1"); // stepKey: seeSimpleProductStockStatus
		$I->waitForPageLoad(30); // stepKey: seeSimpleProductStockStatusWaitForPageLoad
		$I->seeInField(".admin__field[data-index=weight] input", "1"); // stepKey: seeSimpleProductWeight
		$I->seeInField("select[name='product[product_has_weight]']", "This item has weight"); // stepKey: seeSimpleProductWeightSelect
		$I->click("div[data-index='category_ids']"); // stepKey: clickCategoriesDropDownToVerify
		$I->waitForPageLoad(30); // stepKey: clickCategoriesDropDownToVerifyWaitForPageLoad
		$I->see($I->retrieveEntityField('categoryEntity', 'name', 'test'), "//*[@data-index='container_category_ids']//*[contains(@class, '_selected')]"); // stepKey: seeSelectedCategories
		$I->seeInField("//select[@name='product[visibility]']", "Catalog, Search"); // stepKey: seeVisibility
		$I->scrollTo("div[data-index='search-engine-optimization']", 0, -80); // stepKey: scrollToAdminProductSEOSection1
		$I->waitForPageLoad(30); // stepKey: scrollToAdminProductSEOSection1WaitForPageLoad
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: clickAdminProductSEOSection1
		$I->waitForPageLoad(30); // stepKey: clickAdminProductSEOSection1WaitForPageLoad
		$I->seeInField("input[name='product[url_key]']", "test-simple-product" . msq("simpleProductEnabledFlat")); // stepKey: seeUrlKey
		$I->comment("Verify customer see updated simple product link on category page");
		$I->amOnPage("/" . $I->retrieveEntityField('categoryEntity', 'name', 'test') . ".html"); // stepKey: openCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageLoad
		$I->see("TestSimpleProduct" . msq("simpleProductEnabledFlat"), "a.product-item-link"); // stepKey: seeSimpleProductNameOnCategoryPage
		$I->waitForPageLoad(30); // stepKey: seeSimpleProductNameOnCategoryPageWaitForPageLoad
		$I->comment("Verify customer see updated simple product (from the above step) on the storefront page");
		$I->amOnPage("/test-simple-product" . msq("simpleProductEnabledFlat") . ".html"); // stepKey: goToProductPage
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductPageLoad
		$I->see("TestSimpleProduct" . msq("simpleProductEnabledFlat"), ".base"); // stepKey: seeSimpleProductNameOnStoreFrontPage
		$I->see("1.99", "div.price-box.price-final_price"); // stepKey: seeSimpleProductPriceOnStoreFrontPage
		$I->comment("Entering Action Group [seeSimpleProductSkuOnStoreFrontPage] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("test_simple_product_sku" . msq("simpleProductEnabledFlat"), ".product.attribute.sku>.value"); // stepKey: seeProductSkuSeeSimpleProductSkuOnStoreFrontPage
		$I->comment("Exiting Action Group [seeSimpleProductSkuOnStoreFrontPage] StorefrontAssertProductSkuOnProductPageActionGroup");
		$productStockAvailableStatus = $I->grabTextFrom(".stock[title=Availability]>span"); // stepKey: productStockAvailableStatus
		$I->assertEquals("IN STOCK", $productStockAvailableStatus); // stepKey: assertStockAvailableOnProductPage
		$productPriceAmount = $I->grabTextFrom("div.price-box.price-final_price"); // stepKey: productPriceAmount
		$I->assertEquals("$1.99", $productPriceAmount); // stepKey: assertOldPriceTextOnProductPage
		$I->comment("Verify customer see updated simple product link on magento storefront page and is searchable by sku");
		$I->amOnPage("/test-simple-product" . msq("simpleProductEnabledFlat") . ".html"); // stepKey: goToMagentoStorefrontPage
		$I->waitForPageLoad(30); // stepKey: waitForStoreFrontProductPageLoad
		$I->fillField("#search", "test_simple_product_sku" . msq("simpleProductEnabledFlat")); // stepKey: fillSimpleProductSkuInSearchTextBox
		$I->waitForPageLoad(30); // stepKey: waitForSearchTextBox
		$I->click("button[class='action search']"); // stepKey: clickSearchTextBoxButton
		$I->waitForPageLoad(30); // stepKey: clickSearchTextBoxButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSearch
		$I->see("TestSimpleProduct" . msq("simpleProductEnabledFlat"), "a[class='product-item-link']"); // stepKey: seeSimpleProductNameOnMagentoStorefrontPage
		$I->waitForPageLoad(30); // stepKey: seeSimpleProductNameOnMagentoStorefrontPageWaitForPageLoad
	}
}
