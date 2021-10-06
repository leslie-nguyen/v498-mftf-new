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
 * @Title("MC-106: Admin should be able to add default images for a Grouped Product")
 * @Description("Admin should be able to add default images for a Grouped Product<h3>Test files</h3>vendor\magento\module-grouped-product\Test\Mftf\Test\AdminAddDefaultImageGroupedProductTest.xml<br>")
 * @TestCaseId("MC-106")
 * @group GroupedProduct
 */
class AdminAddDefaultImageGroupedProductTestCest
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
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createProductOne", "hook", "ApiSimpleProduct", ["createCategory"], []); // stepKey: createProductOne
		$I->createEntity("createProductTwo", "hook", "ApiSimpleProduct", ["createCategory"], []); // stepKey: createProductTwo
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [deleteGroupedProduct] DeleteProductBySkuActionGroup");
		$I->comment("TODO use other action group for filtering grid when MQE-539 is implemented");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: visitAdminProductPageDeleteGroupedProduct
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersDeleteGroupedProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersDeleteGroupedProductWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersDeleteGroupedProduct
		$I->fillField("input.admin__control-text[name='sku']", "groupedproduct" . msq("GroupedProduct")); // stepKey: fillProductSkuFilterDeleteGroupedProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersDeleteGroupedProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersDeleteGroupedProductWaitForPageLoad
		$I->see("groupedproduct" . msq("GroupedProduct"), "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[normalize-space(.)='SKU']/preceding-sibling::th) +1 ]"); // stepKey: seeProductSkuInGridDeleteGroupedProduct
		$I->click("div[data-role='grid-wrapper'] th.data-grid-multicheck-cell button.action-multicheck-toggle"); // stepKey: openMulticheckDropdownDeleteGroupedProduct
		$I->click("//div[@data-role='grid-wrapper']//th[contains(@class, data-grid-multicheck-cell)]//li//span[text() = 'Select All']"); // stepKey: selectAllProductInFilteredGridDeleteGroupedProduct
		$I->click("div.admin__data-grid-header-row.row div.action-select-wrap button.action-select"); // stepKey: clickActionDropdownDeleteGroupedProduct
		$I->click("//div[contains(@class,'admin__data-grid-header-row') and contains(@class, 'row')]//div[contains(@class, 'action-select-wrap')]//ul/li/span[text() = 'Delete']"); // stepKey: clickDeleteActionDeleteGroupedProduct
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitForConfirmModalDeleteGroupedProduct
		$I->waitForPageLoad(60); // stepKey: waitForConfirmModalDeleteGroupedProductWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmProductDeleteDeleteGroupedProduct
		$I->waitForPageLoad(60); // stepKey: confirmProductDeleteDeleteGroupedProductWaitForPageLoad
		$I->see("record(s) have been deleted.", "#messages div.message-success"); // stepKey: seeSuccessMessageDeleteGroupedProduct
		$I->comment("Exiting Action Group [deleteGroupedProduct] DeleteProductBySkuActionGroup");
		$I->comment("Entering Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAmOnLogoutPage
		$I->comment("Exiting Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$I->deleteEntity("createProductOne", "hook"); // stepKey: deleteProductOne
		$I->deleteEntity("createProductTwo", "hook"); // stepKey: deleteProductTwo
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
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
	 * @Features({"GroupedProduct"})
	 * @Stories({"Add/remove images and videos for all product types and category"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAddDefaultImageGroupedProductTest(AcceptanceTester $I)
	{
		$I->comment("Create product");
		$I->comment("Entering Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageNavigateToProductIndex
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadNavigateToProductIndex
		$I->comment("Exiting Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->comment("Entering Action Group [resetProductGridColumnsInitial] ResetProductGridToDefaultViewActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersResetProductGridColumnsInitial
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersResetProductGridColumnsInitialWaitForPageLoad
		$I->click(".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: openViewBookmarksTabResetProductGridColumnsInitial
		$I->click("//div[contains(@class, 'admin__data-grid-action-bookmarks')]/ul/li/div/a[text() = 'Default View']"); // stepKey: resetToDefaultGridViewResetProductGridColumnsInitial
		$I->waitForPageLoad(30); // stepKey: resetToDefaultGridViewResetProductGridColumnsInitialWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductGridLoadResetProductGridColumnsInitial
		$I->see("Default View", ".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: seeDefaultViewSelectedResetProductGridColumnsInitial
		$I->comment("Exiting Action Group [resetProductGridColumnsInitial] ResetProductGridToDefaultViewActionGroup");
		$I->comment("Entering Action Group [goToCreateProduct] GoToCreateProductPageActionGroup");
		$I->click(".action-toggle.primary.add"); // stepKey: clickAddProductToggleGoToCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickAddProductToggleGoToCreateProductWaitForPageLoad
		$I->waitForElementVisible(".item[data-ui-id='products-list-add-new-product-button-item-grouped']", 30); // stepKey: waitForAddProductDropdownGoToCreateProduct
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-grouped']"); // stepKey: clickAddProductTypeGoToCreateProduct
		$I->waitForPageLoad(30); // stepKey: waitForCreateProductPageLoadGoToCreateProduct
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/grouped/"); // stepKey: seeNewProductUrlGoToCreateProduct
		$I->see("New Product", ".page-header h1.page-title"); // stepKey: seeNewProductTitleGoToCreateProduct
		$I->comment("Exiting Action Group [goToCreateProduct] GoToCreateProductPageActionGroup");
		$I->comment("Entering Action Group [fillProductForm] FillGroupedProductFormActionGroup");
		$I->fillField(".admin__field[data-index=name] input", "GroupedProduct" . msq("GroupedProduct")); // stepKey: fillProductSkuFillProductForm
		$I->fillField(".admin__field[data-index=sku] input", "groupedproduct" . msq("GroupedProduct")); // stepKey: fillProductNameFillProductForm
		$I->comment("Exiting Action Group [fillProductForm] FillGroupedProductFormActionGroup");
		$I->scrollTo("div[data-index=grouped] .admin__collapsible-title", 0, -100); // stepKey: scrollToGroupedSection
		$I->conditionalClick("div[data-index=grouped] .admin__collapsible-title", "button[data-index='grouped_products_button']", false); // stepKey: openGroupedProductsSection
		$I->waitForPageLoad(30); // stepKey: openGroupedProductsSectionWaitForPageLoad
		$I->click("body"); // stepKey: clickBodyToCorrectFocusGrouped
		$I->click("button[data-index='grouped_products_button']"); // stepKey: clickAddProductsToGroup
		$I->waitForPageLoad(30); // stepKey: clickAddProductsToGroupWaitForPageLoad
		$I->waitForElementVisible(".product_form_product_form_grouped_grouped_products_modal [data-action='grid-filter-expand']", 30); // stepKey: waitForGroupedProductModal
		$I->waitForPageLoad(30); // stepKey: waitForGroupedProductModalWaitForPageLoad
		$I->comment("Entering Action Group [filterGroupedProducts] FilterProductGridBySku2ActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersFilterGroupedProducts
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersFilterGroupedProductsWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersFilterGroupedProducts
		$I->fillField("input.admin__control-text[name='sku']", "api-simple-product"); // stepKey: fillProductSkuFilterFilterGroupedProducts
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersFilterGroupedProducts
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersFilterGroupedProductsWaitForPageLoad
		$I->waitForElementNotVisible(".admin__data-grid-loading-mask[data-component*='product_listing']", 30); // stepKey: waitForFilteredGridLoadFilterGroupedProducts
		$I->comment("Exiting Action Group [filterGroupedProducts] FilterProductGridBySku2ActionGroup");
		$I->checkOption("tr[data-repeat-index='0'] .admin__control-checkbox"); // stepKey: checkFilterResult1
		$I->checkOption("tr[data-repeat-index='1'] .admin__control-checkbox"); // stepKey: checkFilterResult2
		$I->click(".product_form_product_form_grouped_grouped_products_modal button.action-primary"); // stepKey: clickAddSelectedGroupProducts
		$I->waitForPageLoad(30); // stepKey: clickAddSelectedGroupProductsWaitForPageLoad
		$I->comment("Add image to product");
		$I->comment("Entering Action Group [addImageForProduct] AddProductImageActionGroup");
		$I->conditionalClick("div[data-index=gallery] .admin__collapsible-title", "div.image div.fileinput-button", false); // stepKey: openProductImagesSectionAddImageForProduct
		$I->waitForPageLoad(30); // stepKey: waitForPageRefreshAddImageForProduct
		$I->waitForElementVisible("div.image div.fileinput-button", 30); // stepKey: seeImageSectionIsReadyAddImageForProduct
		$I->attachFile("#fileupload", "magento-logo.png"); // stepKey: uploadFileAddImageForProduct
		$I->waitForElementNotVisible(".uploader .file-row", 30); // stepKey: waitForUploadAddImageForProduct
		$I->waitForElementVisible("//*[@id='media_gallery_content']//img[contains(@src, 'magento-logo')]", 30); // stepKey: waitForThumbnailAddImageForProduct
		$I->comment("Exiting Action Group [addImageForProduct] AddProductImageActionGroup");
		$I->comment("Entering Action Group [saveProduct] SaveProductFormActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollTopPageProductSaveProduct
		$I->waitForElementVisible("#save-button", 30); // stepKey: waitForSaveProductButtonSaveProduct
		$I->waitForPageLoad(30); // stepKey: waitForSaveProductButtonSaveProductWaitForPageLoad
		$I->click("#save-button"); // stepKey: clickSaveProductSaveProduct
		$I->waitForPageLoad(30); // stepKey: clickSaveProductSaveProductWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitProductSaveSuccessMessageSaveProduct
		$I->see("You saved the product.", "#messages div.message-success"); // stepKey: seeSaveConfirmationSaveProduct
		$I->comment("Exiting Action Group [saveProduct] SaveProductFormActionGroup");
		$I->comment("Assert product image in admin product form");
		$I->comment("Entering Action Group [assertProductImageAdminProductPage] AssertProductImageAdminProductPageActionGroup");
		$I->conditionalClick("div[data-index=gallery] .admin__collapsible-title", "div.image div.fileinput-button", false); // stepKey: openProductImagesSectionAssertProductImageAdminProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAssertProductImageAdminProductPage
		$I->seeElement("//*[@id='media_gallery_content']//img[contains(@src, 'magento-logo')]"); // stepKey: seeImageAssertProductImageAdminProductPage
		$I->comment("Exiting Action Group [assertProductImageAdminProductPage] AssertProductImageAdminProductPageActionGroup");
		$I->comment("Assert product in storefront product page");
		$I->comment("Entering Action Group [AssertProductInStorefrontProductPage] AssertProductNameAndSkuInStorefrontProductPageActionGroup");
		$I->comment("Go to storefront product page, assert product name and sku");
		$I->amOnPage("groupedproduct" . msq("GroupedProduct") . ".html"); // stepKey: navigateToProductPageAssertProductInStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2AssertProductInStorefrontProductPage
		$I->seeInTitle("GroupedProduct" . msq("GroupedProduct")); // stepKey: assertProductNameTitleAssertProductInStorefrontProductPage
		$I->see("GroupedProduct" . msq("GroupedProduct"), ".base"); // stepKey: assertProductNameAssertProductInStorefrontProductPage
		$I->see("groupedproduct" . msq("GroupedProduct"), ".product.attribute.sku>.value"); // stepKey: assertProductSkuAssertProductInStorefrontProductPage
		$I->comment("Exiting Action Group [AssertProductInStorefrontProductPage] AssertProductNameAndSkuInStorefrontProductPageActionGroup");
		$I->comment("Assert product image in storefront product page");
		$I->comment("Entering Action Group [assertProductImageStorefrontProductPage] AssertProductImageStorefrontProductPageActionGroup");
		$I->seeInCurrentUrl("/groupedproduct" . msq("GroupedProduct") . ".html"); // stepKey: checkUrlAssertProductImageStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAssertProductImageStorefrontProductPage
		$I->seeElement("//*[@class='product media']//img[contains(@src, 'magento-logo')]"); // stepKey: seeImageAssertProductImageStorefrontProductPage
		$I->comment("Exiting Action Group [assertProductImageStorefrontProductPage] AssertProductImageStorefrontProductPageActionGroup");
	}
}
