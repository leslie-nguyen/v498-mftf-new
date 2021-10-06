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
 * @Title("MC-10816: Update Simple Product with Regular Price (In Stock), Disabled Product")
 * @Description("Test log in to Update Simple Product and Update Simple Product with Regular Price (In Stock), Disabled Product<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminUpdateSimpleProductWithRegularPriceInStockDisabledProductTest.xml<br>")
 * @TestCaseId("MC-10816")
 * @group catalog
 * @group mtf_migrated
 */
class AdminUpdateSimpleProductWithRegularPriceInStockDisabledProductTestCest
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
		$I->createEntity("initialCategoryEntity", "hook", "SimpleSubCategory", [], []); // stepKey: initialCategoryEntity
		$I->createEntity("initialSimpleProduct", "hook", "defaultSimpleProduct", ["initialCategoryEntity"], []); // stepKey: initialSimpleProduct
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("initialCategoryEntity", "hook"); // stepKey: deleteSimpleSubCategory
		$I->comment("Entering Action Group [deleteCreatedProduct] DeleteProductBySkuActionGroup");
		$I->comment("TODO use other action group for filtering grid when MQE-539 is implemented");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: visitAdminProductPageDeleteCreatedProduct
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersDeleteCreatedProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersDeleteCreatedProductWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersDeleteCreatedProduct
		$I->fillField("input.admin__control-text[name='sku']", "test_simple_product_sku" . msq("simpleProductDisabled")); // stepKey: fillProductSkuFilterDeleteCreatedProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersDeleteCreatedProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersDeleteCreatedProductWaitForPageLoad
		$I->see("test_simple_product_sku" . msq("simpleProductDisabled"), "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[normalize-space(.)='SKU']/preceding-sibling::th) +1 ]"); // stepKey: seeProductSkuInGridDeleteCreatedProduct
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
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminUpdateSimpleProductWithRegularPriceInStockDisabledProductTest(AcceptanceTester $I)
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
		$I->comment("Update simple product with regular price(in stock)");
		$I->fillField(".admin__field[data-index=name] input", "TestSimpleProduct" . msq("simpleProductDisabled")); // stepKey: fillSimpleProductName
		$I->fillField(".admin__field[data-index=sku] input", "test_simple_product_sku" . msq("simpleProductDisabled")); // stepKey: fillSimpleProductSku
		$I->fillField(".admin__field[data-index=price] input", "74.00"); // stepKey: fillSimpleProductPrice
		$I->fillField(".admin__field[data-index=qty] input", "87"); // stepKey: fillSimpleProductQuantity
		$I->selectOption("[data-index='product-details'] select[name='product[quantity_and_stock_status][is_in_stock]']", "In Stock"); // stepKey: selectStockStatusInStock
		$I->fillField(".admin__field[data-index=weight] input", "333"); // stepKey: fillSimpleProductWeight
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: clickAdminProductSEOSection
		$I->waitForPageLoad(30); // stepKey: clickAdminProductSEOSectionWaitForPageLoad
		$I->fillField("input[name='product[url_key]']", "test-simple-product" . msq("simpleProductDisabled")); // stepKey: fillUrlKey
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfAdminProductFormSection
		$I->click("input[name='product[status]']+label"); // stepKey: clickEnableProductLabelToDisableProduct
		$I->comment("Entering Action Group [clickSaveButton] AdminProductFormSaveButtonClickActionGroup");
		$I->click("#save-button"); // stepKey: clickSaveButtonClickSaveButton
		$I->waitForPageLoad(30); // stepKey: clickSaveButtonClickSaveButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavedClickSaveButton
		$I->comment("Exiting Action Group [clickSaveButton] AdminProductFormSaveButtonClickActionGroup");
		$I->comment("Verify customer see success message");
		$I->see("You saved the product.", "#messages"); // stepKey: seeAssertSimpleProductSaveSuccessMessage
		$I->comment("Search updated simple product(from above step) in the grid");
		$I->comment("Entering Action Group [openProductCatalogPageToSearchUpdatedSimpleProduct] AdminProductCatalogPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/"); // stepKey: openProductCatalogPageOpenProductCatalogPageToSearchUpdatedSimpleProduct
		$I->waitForPageLoad(30); // stepKey: waitForProductCatalogPageLoadOpenProductCatalogPageToSearchUpdatedSimpleProduct
		$I->comment("Exiting Action Group [openProductCatalogPageToSearchUpdatedSimpleProduct] AdminProductCatalogPageOpenActionGroup");
		$I->conditionalClick(".admin__data-grid-header .admin__data-grid-filters-current._show .action-clear", ".admin__data-grid-header .admin__data-grid-filters-current._show .action-clear", true); // stepKey: clickClearAll
		$I->waitForPageLoad(30); // stepKey: clickClearAllWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: clickFiltersButton
		$I->fillField("input.admin__control-text[name='name']", "TestSimpleProduct" . msq("simpleProductDisabled")); // stepKey: fillSimpleProductNameInNameFilter
		$I->fillField("input.admin__control-text[name='sku']", "test_simple_product_sku" . msq("simpleProductDisabled")); // stepKey: fillProductSku
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersButton
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersButtonWaitForPageLoad
		$I->click(".data-row:nth-of-type(1)"); // stepKey: clickFirstRowToVerifyUpdatedSimpleProductVisibleInGrid
		$I->waitForPageLoad(30); // stepKey: clickFirstRowToVerifyUpdatedSimpleProductVisibleInGridWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitUntilSimpleProductPageIsOpened
		$I->comment("Verify customer see updated simple product in the product form page");
		$I->seeInField(".admin__field[data-index=name] input", "TestSimpleProduct" . msq("simpleProductDisabled")); // stepKey: seeSimpleProductName
		$I->seeInField(".admin__field[data-index=sku] input", "test_simple_product_sku" . msq("simpleProductDisabled")); // stepKey: seeSimpleProductSku
		$I->seeInField(".admin__field[data-index=price] input", "74.00"); // stepKey: seeSimpleProductPrice
		$I->seeInField(".admin__field[data-index=qty] input", "87"); // stepKey: seeSimpleProductQuantity
		$I->seeInField("select[name='product[quantity_and_stock_status][is_in_stock]']", "In Stock"); // stepKey: seeSimpleProductStockStatus
		$I->waitForPageLoad(30); // stepKey: seeSimpleProductStockStatusWaitForPageLoad
		$I->seeInField(".admin__field[data-index=weight] input", "333"); // stepKey: seeSimpleProductWeight
		$I->scrollTo("div[data-index='search-engine-optimization']", 0, -80); // stepKey: scrollToAdminProductSEOSectionHeader
		$I->waitForPageLoad(30); // stepKey: scrollToAdminProductSEOSectionHeaderWaitForPageLoad
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: clickAdminProductSEOSectionHeader
		$I->waitForPageLoad(30); // stepKey: clickAdminProductSEOSectionHeaderWaitForPageLoad
		$I->seeInField("input[name='product[url_key]']", "test-simple-product" . msq("simpleProductDisabled")); // stepKey: seeSimpleProductUrlKey
		$I->comment("Verify customer don't see updated simple product link on magento storefront page");
		$I->amOnPage("/test-simple-product" . msq("simpleProductDisabled") . ".html"); // stepKey: goToMagentoStorefrontPage
		$I->waitForPageLoad(30); // stepKey: waitForStoreFrontProductPageLoad
		$I->fillField("#search", "test_simple_product_sku" . msq("simpleProductDisabled")); // stepKey: fillSimpleProductSkuInSearchTextBox
		$I->waitForPageLoad(30); // stepKey: waitForSearchTextBox
		$I->click("button[class='action search']"); // stepKey: clickSearchTextBoxButton
		$I->waitForPageLoad(30); // stepKey: clickSearchTextBoxButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSearch
		$I->dontSee("TestSimpleProduct" . msq("simpleProductDisabled"), "a[class='product-item-link']"); // stepKey: dontSeeProductNameOnStorefrontPage
		$I->waitForPageLoad(30); // stepKey: dontSeeProductNameOnStorefrontPageWaitForPageLoad
	}
}
