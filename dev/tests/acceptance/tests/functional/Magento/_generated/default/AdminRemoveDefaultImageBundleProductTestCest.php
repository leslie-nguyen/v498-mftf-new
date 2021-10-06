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
 * @Title("MC-200: Admin should be able to remove default images from a Bundle Product")
 * @Description("Admin should be able to remove default images from a Bundle Product<h3>Test files</h3>vendor\magento\module-bundle\Test\Mftf\Test\AdminRemoveDefaultImageBundleProductTest.xml<br>")
 * @TestCaseId("MC-200")
 * @group Bundle
 */
class AdminRemoveDefaultImageBundleProductTestCest
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
		$I->createEntity("simpleProduct2", "hook", "SimpleProduct2", [], []); // stepKey: simpleProduct2
		$runCronIndex = $I->magentoCron("index", 90); // stepKey: runCronIndex
		$I->comment($runCronIndex);
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Delete the bundled product we created in the test body");
		$I->comment("Entering Action Group [deleteBundleProduct] DeleteProductBySkuActionGroup");
		$I->comment("TODO use other action group for filtering grid when MQE-539 is implemented");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: visitAdminProductPageDeleteBundleProduct
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersDeleteBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersDeleteBundleProductWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersDeleteBundleProduct
		$I->fillField("input.admin__control-text[name='sku']", "bundleproduct" . msq("BundleProduct")); // stepKey: fillProductSkuFilterDeleteBundleProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersDeleteBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersDeleteBundleProductWaitForPageLoad
		$I->see("bundleproduct" . msq("BundleProduct"), "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[normalize-space(.)='SKU']/preceding-sibling::th) +1 ]"); // stepKey: seeProductSkuInGridDeleteBundleProduct
		$I->click("div[data-role='grid-wrapper'] th.data-grid-multicheck-cell button.action-multicheck-toggle"); // stepKey: openMulticheckDropdownDeleteBundleProduct
		$I->click("//div[@data-role='grid-wrapper']//th[contains(@class, data-grid-multicheck-cell)]//li//span[text() = 'Select All']"); // stepKey: selectAllProductInFilteredGridDeleteBundleProduct
		$I->click("div.admin__data-grid-header-row.row div.action-select-wrap button.action-select"); // stepKey: clickActionDropdownDeleteBundleProduct
		$I->click("//div[contains(@class,'admin__data-grid-header-row') and contains(@class, 'row')]//div[contains(@class, 'action-select-wrap')]//ul/li/span[text() = 'Delete']"); // stepKey: clickDeleteActionDeleteBundleProduct
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitForConfirmModalDeleteBundleProduct
		$I->waitForPageLoad(60); // stepKey: waitForConfirmModalDeleteBundleProductWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmProductDeleteDeleteBundleProduct
		$I->waitForPageLoad(60); // stepKey: confirmProductDeleteDeleteBundleProductWaitForPageLoad
		$I->see("record(s) have been deleted.", "#messages div.message-success"); // stepKey: seeSuccessMessageDeleteBundleProduct
		$I->comment("Exiting Action Group [deleteBundleProduct] DeleteProductBySkuActionGroup");
		$I->comment("Entering Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAmOnLogoutPage
		$I->comment("Exiting Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$I->deleteEntity("simpleProduct1", "hook"); // stepKey: deleteSimpleProduct1
		$I->deleteEntity("simpleProduct2", "hook"); // stepKey: deleteSimpleProduct2
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
	 * @Features({"Bundle"})
	 * @Stories({"Add/remove images and videos for all product types and category"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminRemoveDefaultImageBundleProductTest(AcceptanceTester $I)
	{
		$I->comment("Create a bundle product");
		$I->comment("Entering Action Group [visitAdminProductPageBundle] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageVisitAdminProductPageBundle
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadVisitAdminProductPageBundle
		$I->comment("Exiting Action Group [visitAdminProductPageBundle] AdminOpenProductIndexPageActionGroup");
		$I->comment("Entering Action Group [goToCreateBundleProduct] GoToCreateProductPageActionGroup");
		$I->click(".action-toggle.primary.add"); // stepKey: clickAddProductToggleGoToCreateBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickAddProductToggleGoToCreateBundleProductWaitForPageLoad
		$I->waitForElementVisible(".item[data-ui-id='products-list-add-new-product-button-item-bundle']", 30); // stepKey: waitForAddProductDropdownGoToCreateBundleProduct
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-bundle']"); // stepKey: clickAddProductTypeGoToCreateBundleProduct
		$I->waitForPageLoad(30); // stepKey: waitForCreateProductPageLoadGoToCreateBundleProduct
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/bundle/"); // stepKey: seeNewProductUrlGoToCreateBundleProduct
		$I->see("New Product", ".page-header h1.page-title"); // stepKey: seeNewProductTitleGoToCreateBundleProduct
		$I->comment("Exiting Action Group [goToCreateBundleProduct] GoToCreateProductPageActionGroup");
		$I->comment("Entering Action Group [fillBundleProductNameAndSku] FillProductNameAndSkuInProductFormActionGroup");
		$I->fillField(".admin__field[data-index=name] input", "BundleProduct" . msq("BundleProduct")); // stepKey: fillProductNameFillBundleProductNameAndSku
		$I->fillField(".admin__field[data-index=sku] input", "bundleproduct" . msq("BundleProduct")); // stepKey: fillProductSkuFillBundleProductNameAndSku
		$I->comment("Exiting Action Group [fillBundleProductNameAndSku] FillProductNameAndSkuInProductFormActionGroup");
		$I->comment("Add two bundle items");
		$I->conditionalClick("//span[text()='Bundle Items']", "//span[text()='Bundle Items']", false); // stepKey: conditionallyOpenSectionBundleItems
		$I->comment("scrollTo before click to fix flaky failure");
		$I->scrollTo("button[data-index='add_button']"); // stepKey: scrollToAddOption
		$I->click("button[data-index='add_button']"); // stepKey: clickAddOption3
		$I->waitForElementVisible("[name='bundle_options[bundle_options][0][title]']", 30); // stepKey: waitForBundleOptions
		$I->fillField("[name='bundle_options[bundle_options][0][title]']", "BundleOption"); // stepKey: fillOptionTitle
		$I->selectOption("[name='bundle_options[bundle_options][0][type]']", "checkbox"); // stepKey: selectInputType
		$I->waitForElementVisible("[data-index='modal_set']", 30); // stepKey: waitForAddProductsToBundle
		$I->waitForPageLoad(30); // stepKey: waitForAddProductsToBundleWaitForPageLoad
		$I->click("[data-index='modal_set']"); // stepKey: clickAddProductsToOption
		$I->waitForPageLoad(30); // stepKey: clickAddProductsToOptionWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAfterBundleProducts
		$I->comment("Entering Action Group [filterBundleProductOptions] FilterProductGridBySkuActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersFilterBundleProductOptions
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersFilterBundleProductOptionsWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersFilterBundleProductOptions
		$I->fillField("input.admin__control-text[name='sku']", $I->retrieveEntityField('simpleProduct1', 'sku', 'test')); // stepKey: fillProductSkuFilterFilterBundleProductOptions
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersFilterBundleProductOptions
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersFilterBundleProductOptionsWaitForPageLoad
		$I->waitForElementNotVisible(".admin__data-grid-loading-mask[data-component*='product_listing']", 30); // stepKey: waitForFilteredGridLoadFilterBundleProductOptions
		$I->comment("Exiting Action Group [filterBundleProductOptions] FilterProductGridBySkuActionGroup");
		$I->checkOption("//tr[1]//input[@data-action='select-row']"); // stepKey: selectFirstGridRow
		$I->comment("Entering Action Group [filterBundleProductOptions2] FilterProductGridBySkuActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersFilterBundleProductOptions2
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersFilterBundleProductOptions2WaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersFilterBundleProductOptions2
		$I->fillField("input.admin__control-text[name='sku']", $I->retrieveEntityField('simpleProduct2', 'sku', 'test')); // stepKey: fillProductSkuFilterFilterBundleProductOptions2
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersFilterBundleProductOptions2
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersFilterBundleProductOptions2WaitForPageLoad
		$I->waitForElementNotVisible(".admin__data-grid-loading-mask[data-component*='product_listing']", 30); // stepKey: waitForFilteredGridLoadFilterBundleProductOptions2
		$I->comment("Exiting Action Group [filterBundleProductOptions2] FilterProductGridBySkuActionGroup");
		$I->checkOption("//tr[1]//input[@data-action='select-row']"); // stepKey: selectFirstGridRow2
		$I->click(".product_form_product_form_bundle-items_modal button.action-primary"); // stepKey: clickAddSelectedBundleProducts
		$I->waitForPageLoad(30); // stepKey: clickAddSelectedBundleProductsWaitForPageLoad
		$I->fillField("[name='bundle_options[bundle_options][0][bundle_selections][0][selection_qty]']", "10"); // stepKey: fillProductDefaultQty1
		$I->fillField("[name='bundle_options[bundle_options][0][bundle_selections][1][selection_qty]']", "10"); // stepKey: fillProductDefaultQty2
		$I->comment("Add image to product");
		$I->comment("Entering Action Group [addImageForProduct] AddProductImageActionGroup");
		$I->conditionalClick("div[data-index=gallery] .admin__collapsible-title", "div.image div.fileinput-button", false); // stepKey: openProductImagesSectionAddImageForProduct
		$I->waitForPageLoad(30); // stepKey: waitForPageRefreshAddImageForProduct
		$I->waitForElementVisible("div.image div.fileinput-button", 30); // stepKey: seeImageSectionIsReadyAddImageForProduct
		$I->attachFile("#fileupload", "magento-logo.png"); // stepKey: uploadFileAddImageForProduct
		$I->waitForElementNotVisible(".uploader .file-row", 30); // stepKey: waitForUploadAddImageForProduct
		$I->waitForElementVisible("//*[@id='media_gallery_content']//img[contains(@src, 'magento-logo')]", 30); // stepKey: waitForThumbnailAddImageForProduct
		$I->comment("Exiting Action Group [addImageForProduct] AddProductImageActionGroup");
		$I->comment("Save product");
		$I->comment("Entering Action Group [saveProduct] SaveProductFormActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollTopPageProductSaveProduct
		$I->waitForElementVisible("#save-button", 30); // stepKey: waitForSaveProductButtonSaveProduct
		$I->waitForPageLoad(30); // stepKey: waitForSaveProductButtonSaveProductWaitForPageLoad
		$I->click("#save-button"); // stepKey: clickSaveProductSaveProduct
		$I->waitForPageLoad(30); // stepKey: clickSaveProductSaveProductWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitProductSaveSuccessMessageSaveProduct
		$I->see("You saved the product.", "#messages div.message-success"); // stepKey: seeSaveConfirmationSaveProduct
		$I->comment("Exiting Action Group [saveProduct] SaveProductFormActionGroup");
		$I->comment("Remove image from product");
		$I->comment("Entering Action Group [removeProductImage] RemoveProductImageActionGroup");
		$I->conditionalClick("div[data-index=gallery] .admin__collapsible-title", "div.image div.fileinput-button", false); // stepKey: openProductImagesSectionRemoveProductImage
		$I->waitForPageLoad(30); // stepKey: waitForPageRefreshRemoveProductImage
		$I->click(".action-remove"); // stepKey: clickRemoveImageRemoveProductImage
		$I->comment("Exiting Action Group [removeProductImage] RemoveProductImageActionGroup");
		$I->comment("Entering Action Group [saveProductFormAfterRemove] SaveProductFormActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollTopPageProductSaveProductFormAfterRemove
		$I->waitForElementVisible("#save-button", 30); // stepKey: waitForSaveProductButtonSaveProductFormAfterRemove
		$I->waitForPageLoad(30); // stepKey: waitForSaveProductButtonSaveProductFormAfterRemoveWaitForPageLoad
		$I->click("#save-button"); // stepKey: clickSaveProductSaveProductFormAfterRemove
		$I->waitForPageLoad(30); // stepKey: clickSaveProductSaveProductFormAfterRemoveWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitProductSaveSuccessMessageSaveProductFormAfterRemove
		$I->see("You saved the product.", "#messages div.message-success"); // stepKey: seeSaveConfirmationSaveProductFormAfterRemove
		$I->comment("Exiting Action Group [saveProductFormAfterRemove] SaveProductFormActionGroup");
		$I->comment("Assert product image not in admin product form");
		$I->comment("Entering Action Group [assertProductImageNotInAdminProductPage] AssertProductImageNotInAdminProductPageActionGroup");
		$I->conditionalClick("div[data-index=gallery] .admin__collapsible-title", "div.image div.fileinput-button", false); // stepKey: openProductImagesSectionAssertProductImageNotInAdminProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAssertProductImageNotInAdminProductPage
		$I->dontSeeElement("//*[@id='media_gallery_content']//img[contains(@src, 'magento-logo')]"); // stepKey: seeImageAssertProductImageNotInAdminProductPage
		$I->comment("Exiting Action Group [assertProductImageNotInAdminProductPage] AssertProductImageNotInAdminProductPageActionGroup");
		$I->comment("Assert product in storefront product page");
		$I->comment("Entering Action Group [AssertProductInStorefrontProductPageAfterRemove] AssertProductNameAndSkuInStorefrontProductPageActionGroup");
		$I->comment("Go to storefront product page, assert product name and sku");
		$I->amOnPage("bundleproduct" . msq("BundleProduct") . ".html"); // stepKey: navigateToProductPageAssertProductInStorefrontProductPageAfterRemove
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2AssertProductInStorefrontProductPageAfterRemove
		$I->seeInTitle("BundleProduct" . msq("BundleProduct")); // stepKey: assertProductNameTitleAssertProductInStorefrontProductPageAfterRemove
		$I->see("BundleProduct" . msq("BundleProduct"), ".base"); // stepKey: assertProductNameAssertProductInStorefrontProductPageAfterRemove
		$I->see("bundleproduct" . msq("BundleProduct"), ".product.attribute.sku>.value"); // stepKey: assertProductSkuAssertProductInStorefrontProductPageAfterRemove
		$I->comment("Exiting Action Group [AssertProductInStorefrontProductPageAfterRemove] AssertProductNameAndSkuInStorefrontProductPageActionGroup");
		$I->comment("Assert product image not in storefront product page");
		$I->comment("Entering Action Group [assertProductImageNotInStorefrontProductPage] AssertProductImageNotInStorefrontProductPageActionGroup");
		$I->seeInCurrentUrl("/bundleproduct" . msq("BundleProduct") . ".html"); // stepKey: checkUrlAssertProductImageNotInStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAssertProductImageNotInStorefrontProductPage
		$I->dontSeeElement("//*[@class='product media']//img[contains(@src, 'magento-logo')]"); // stepKey: seeImageAssertProductImageNotInStorefrontProductPage
		$I->comment("Exiting Action Group [assertProductImageNotInStorefrontProductPage] AssertProductImageNotInStorefrontProductPageActionGroup");
	}
}
