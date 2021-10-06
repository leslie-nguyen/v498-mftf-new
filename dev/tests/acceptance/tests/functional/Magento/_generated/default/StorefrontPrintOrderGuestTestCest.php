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
 * @Title("MC-16225: Print Order from Guest on Frontend")
 * @Description("Print Order from Guest on Frontend<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\StorefrontPrintOrderGuestTest.xml<br>")
 * @TestCaseId("MC-16225")
 * @group sales
 * @group mtf_migrated
 */
class StorefrontPrintOrderGuestTestCest
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
		$addDownloadableDomain = $I->magentoCLI("downloadable:domains:add", 60, "example.com static.magento.com"); // stepKey: addDownloadableDomain
		$I->comment($addDownloadableDomain);
		$I->comment("Entering Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->createEntity("createCategory", "hook", "ApiCategory", [], []); // stepKey: createCategory
		$I->comment("Create downloadable Product");
		$downloadableProductFields['price'] = "280";
		$I->createEntity("downloadableProduct", "hook", "DownloadableProductWithTwoLink100", ["createCategory"], $downloadableProductFields); // stepKey: downloadableProduct
		$I->createEntity("addDownloadableLink1", "hook", "downloadableLink1", ["downloadableProduct"], []); // stepKey: addDownloadableLink1
		$I->createEntity("addDownloadableLink2", "hook", "downloadableLink2", ["downloadableProduct"], []); // stepKey: addDownloadableLink2
		$I->comment("Check Links can be purchased separately for Downloadable Product");
		$I->comment("Entering Action Group [goToDownloadableProduct] NavigateToCreatedProductEditPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToAdminProductIndexPageGoToDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageToLoadGoToDownloadableProduct
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersGoToDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersGoToDownloadableProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClearFiltersGoToDownloadableProduct
		$I->dontSeeElement(".admin__data-grid-header button[data-action='grid-filter-reset']"); // stepKey: dontSeeClearFiltersGoToDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: dontSeeClearFiltersGoToDownloadableProductWaitForPageLoad
		$I->click(".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: openViewBookmarksTabGoToDownloadableProduct
		$I->click("//div[contains(@class, 'admin__data-grid-action-bookmarks')]/ul/li/div/a[text() = 'Default View']"); // stepKey: resetToDefaultGridViewGoToDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: resetToDefaultGridViewGoToDownloadableProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForResetToDefaultViewGoToDownloadableProduct
		$I->see("Default View", ".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: seeDefaultViewSelectedGoToDownloadableProduct
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersGoToDownloadableProduct
		$I->fillField("input.admin__control-text[name='sku']", $I->retrieveEntityField('downloadableProduct', 'sku', 'hook')); // stepKey: fillProductSkuFilterGoToDownloadableProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersGoToDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersGoToDownloadableProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForFilterOnGridGoToDownloadableProduct
		$I->click("//td/div[text()='" . $I->retrieveEntityField('downloadableProduct', 'name', 'hook') . "']"); // stepKey: clickProductGoToDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: waitForProductEditPageLoadGoToDownloadableProduct
		$I->waitForElementVisible("//*[@name='product[sku]']", 30); // stepKey: waitForProductSKUFieldGoToDownloadableProduct
		$I->seeInField("//*[@name='product[sku]']", $I->retrieveEntityField('downloadableProduct', 'sku', 'hook')); // stepKey: seeProductSKUGoToDownloadableProduct
		$I->comment("Exiting Action Group [goToDownloadableProduct] NavigateToCreatedProductEditPageActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->scrollTo("div[data-index='downloadable']"); // stepKey: scrollToDownloadableInformation
		$I->waitForPageLoad(30); // stepKey: scrollToDownloadableInformationWaitForPageLoad
		$I->checkOption("input[name='product[links_purchased_separately]']"); // stepKey: checkOption
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxLoad
		$grabLink = $I->grabValueFrom("input[name='downloadable[link][0][title]']"); // stepKey: grabLink
		$I->comment("Entering Action Group [clickSave] AdminProductFormSaveButtonClickActionGroup");
		$I->click("#save-button"); // stepKey: clickSaveButtonClickSave
		$I->waitForPageLoad(30); // stepKey: clickSaveButtonClickSaveWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavedClickSave
		$I->comment("Exiting Action Group [clickSave] AdminProductFormSaveButtonClickActionGroup");
		$I->comment("Create configurable Product");
		$I->createEntity("createConfigProduct", "hook", "ApiConfigurableProduct", ["createCategory"], []); // stepKey: createConfigProduct
		$I->createEntity("createConfigProductAttribute", "hook", "productAttributeWithTwoOptions", [], []); // stepKey: createConfigProductAttribute
		$I->createEntity("createConfigProductAttributeOption1", "hook", "productAttributeOption1", ["createConfigProductAttribute"], []); // stepKey: createConfigProductAttributeOption1
		$I->createEntity("createConfigProductAttributeOption2", "hook", "productAttributeOption2", ["createConfigProductAttribute"], []); // stepKey: createConfigProductAttributeOption2
		$I->createEntity("createConfigProductAttributeOption3", "hook", "productAttributeOption3", ["createConfigProductAttribute"], []); // stepKey: createConfigProductAttributeOption3
		$I->createEntity("createConfigAddToAttributeSet", "hook", "AddToDefaultSet", ["createConfigProductAttribute"], []); // stepKey: createConfigAddToAttributeSet
		$I->getEntity("getConfigAttributeOption1", "hook", "ProductAttributeOptionGetter", ["createConfigProductAttribute"], null, 1); // stepKey: getConfigAttributeOption1
		$I->getEntity("getConfigAttributeOption2", "hook", "ProductAttributeOptionGetter", ["createConfigProductAttribute"], null, 2); // stepKey: getConfigAttributeOption2
		$I->getEntity("getConfigAttributeOption3", "hook", "ProductAttributeOptionGetter", ["createConfigProductAttribute"], null, 3); // stepKey: getConfigAttributeOption3
		$createConfigChildProduct1Fields['price'] = "40";
		$I->createEntity("createConfigChildProduct1", "hook", "ApiSimpleOne", ["createConfigProductAttribute", "getConfigAttributeOption1"], $createConfigChildProduct1Fields); // stepKey: createConfigChildProduct1
		$createConfigChildProduct2Fields['price'] = "40";
		$I->createEntity("createConfigChildProduct2", "hook", "ApiSimpleTwo", ["createConfigProductAttribute", "getConfigAttributeOption2"], $createConfigChildProduct2Fields); // stepKey: createConfigChildProduct2
		$createConfigChildProduct3Fields['price'] = "40";
		$I->createEntity("createConfigChildProduct3", "hook", "ApiSimpleTwo", ["createConfigProductAttribute", "getConfigAttributeOption3"], $createConfigChildProduct3Fields); // stepKey: createConfigChildProduct3
		$I->createEntity("createConfigProductOption", "hook", "ConfigurableProductThreeOptions", ["createConfigProduct", "createConfigProductAttribute", "getConfigAttributeOption1", "getConfigAttributeOption2", "getConfigAttributeOption3"], []); // stepKey: createConfigProductOption
		$I->createEntity("createConfigProductAddChild1", "hook", "ConfigurableProductAddChild", ["createConfigProduct", "createConfigChildProduct1"], []); // stepKey: createConfigProductAddChild1
		$I->createEntity("createConfigProductAddChild2", "hook", "ConfigurableProductAddChild", ["createConfigProduct", "createConfigChildProduct2"], []); // stepKey: createConfigProductAddChild2
		$I->createEntity("createConfigProductAddChild3", "hook", "ConfigurableProductAddChild", ["createConfigProduct", "createConfigChildProduct3"], []); // stepKey: createConfigProductAddChild3
		$I->comment("Grab attribute name for Configurable Product");
		$I->comment("Entering Action Group [goToConfigurableProduct] NavigateToCreatedProductEditPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToAdminProductIndexPageGoToConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageToLoadGoToConfigurableProduct
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersGoToConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersGoToConfigurableProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClearFiltersGoToConfigurableProduct
		$I->dontSeeElement(".admin__data-grid-header button[data-action='grid-filter-reset']"); // stepKey: dontSeeClearFiltersGoToConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: dontSeeClearFiltersGoToConfigurableProductWaitForPageLoad
		$I->click(".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: openViewBookmarksTabGoToConfigurableProduct
		$I->click("//div[contains(@class, 'admin__data-grid-action-bookmarks')]/ul/li/div/a[text() = 'Default View']"); // stepKey: resetToDefaultGridViewGoToConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: resetToDefaultGridViewGoToConfigurableProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForResetToDefaultViewGoToConfigurableProduct
		$I->see("Default View", ".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: seeDefaultViewSelectedGoToConfigurableProduct
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersGoToConfigurableProduct
		$I->fillField("input.admin__control-text[name='sku']", $I->retrieveEntityField('createConfigProduct', 'sku', 'hook')); // stepKey: fillProductSkuFilterGoToConfigurableProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersGoToConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersGoToConfigurableProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForFilterOnGridGoToConfigurableProduct
		$I->click("//td/div[text()='" . $I->retrieveEntityField('createConfigProduct', 'name', 'hook') . "']"); // stepKey: clickProductGoToConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: waitForProductEditPageLoadGoToConfigurableProduct
		$I->waitForElementVisible("//*[@name='product[sku]']", 30); // stepKey: waitForProductSKUFieldGoToConfigurableProduct
		$I->seeInField("//*[@name='product[sku]']", $I->retrieveEntityField('createConfigProduct', 'sku', 'hook')); // stepKey: seeProductSKUGoToConfigurableProduct
		$I->comment("Exiting Action Group [goToConfigurableProduct] NavigateToCreatedProductEditPageActionGroup");
		$grabAttribute = $I->grabTextFrom("//fieldset[@class='admin__fieldset']/div[contains(@class, 'admin__field _disabled')]//span"); // stepKey: grabAttribute
		$I->assertNotEmpty($grabAttribute); // stepKey: assertNotEmpty
		$I->comment("Create bundle Product");
		$I->createEntity("createSubCategory", "hook", "SimpleSubCategory", [], []); // stepKey: createSubCategory
		$simpleProduct1Fields['price'] = "100.00";
		$I->createEntity("simpleProduct1", "hook", "SimpleProduct2", [], $simpleProduct1Fields); // stepKey: simpleProduct1
		$simpleProduct2Fields['price'] = "560.00";
		$I->createEntity("simpleProduct2", "hook", "SimpleProduct2", [], $simpleProduct2Fields); // stepKey: simpleProduct2
		$I->createEntity("createBundleProduct", "hook", "BundleProductPriceViewRange", ["createSubCategory"], []); // stepKey: createBundleProduct
		$createBundleOption1_1Fields['required'] = "True";
		$I->createEntity("createBundleOption1_1", "hook", "DropDownBundleOption", ["createBundleProduct"], $createBundleOption1_1Fields); // stepKey: createBundleOption1_1
		$I->createEntity("linkOptionToProduct", "hook", "ApiBundleLink", ["createBundleProduct", "createBundleOption1_1", "simpleProduct1"], []); // stepKey: linkOptionToProduct
		$I->createEntity("linkOptionToProduct2", "hook", "ApiBundleLink", ["createBundleProduct", "createBundleOption1_1", "simpleProduct2"], []); // stepKey: linkOptionToProduct2
		$I->comment("Grab bundle option name for Bundle Product");
		$I->comment("Entering Action Group [goToBundleProduct] NavigateToCreatedProductEditPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToAdminProductIndexPageGoToBundleProduct
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageToLoadGoToBundleProduct
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersGoToBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersGoToBundleProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClearFiltersGoToBundleProduct
		$I->dontSeeElement(".admin__data-grid-header button[data-action='grid-filter-reset']"); // stepKey: dontSeeClearFiltersGoToBundleProduct
		$I->waitForPageLoad(30); // stepKey: dontSeeClearFiltersGoToBundleProductWaitForPageLoad
		$I->click(".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: openViewBookmarksTabGoToBundleProduct
		$I->click("//div[contains(@class, 'admin__data-grid-action-bookmarks')]/ul/li/div/a[text() = 'Default View']"); // stepKey: resetToDefaultGridViewGoToBundleProduct
		$I->waitForPageLoad(30); // stepKey: resetToDefaultGridViewGoToBundleProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForResetToDefaultViewGoToBundleProduct
		$I->see("Default View", ".admin__data-grid-action-bookmarks button.admin__action-dropdown"); // stepKey: seeDefaultViewSelectedGoToBundleProduct
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersGoToBundleProduct
		$I->fillField("input.admin__control-text[name='sku']", $I->retrieveEntityField('createBundleProduct', 'sku', 'hook')); // stepKey: fillProductSkuFilterGoToBundleProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersGoToBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersGoToBundleProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForFilterOnGridGoToBundleProduct
		$I->click("//td/div[text()='" . $I->retrieveEntityField('createBundleProduct', 'name', 'hook') . "']"); // stepKey: clickProductGoToBundleProduct
		$I->waitForPageLoad(30); // stepKey: waitForProductEditPageLoadGoToBundleProduct
		$I->waitForElementVisible("//*[@name='product[sku]']", 30); // stepKey: waitForProductSKUFieldGoToBundleProduct
		$I->seeInField("//*[@name='product[sku]']", $I->retrieveEntityField('createBundleProduct', 'sku', 'hook')); // stepKey: seeProductSKUGoToBundleProduct
		$I->comment("Exiting Action Group [goToBundleProduct] NavigateToCreatedProductEditPageActionGroup");
		$grabBundleOption = $I->grabTextFrom("//div[@data-index='bundle-items']//div[contains(@class, 'admin__collapsible-title')]/span"); // stepKey: grabBundleOption
		$I->assertNotEmpty($grabBundleOption); // stepKey: assertBundleOptionNotEmpty
		$I->comment("Create sales rule");
		$I->createEntity("createCartPriceRule", "hook", "ActiveSalesRuleCoupon50", [], []); // stepKey: createCartPriceRule
		$I->createEntity("createCouponForCartPriceRule", "hook", "SimpleSalesRuleCoupon", ["createCartPriceRule"], []); // stepKey: createCouponForCartPriceRule
		$I->comment("Create Customer Account");
		$I->createEntity("createCustomer", "hook", "Simple_US_Customer", [], []); // stepKey: createCustomer
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Place order with options according to dataset");
		$I->comment("Entering Action Group [newOrder] NavigateToNewOrderPageExistingCustomerActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: navigateToOrderIndexPageNewOrder
		$I->waitForPageLoad(30); // stepKey: waitForIndexPageLoadNewOrder
		$I->see("Orders", ".page-header h1.page-title"); // stepKey: seeIndexPageTitleNewOrder
		$I->click(".page-actions-buttons button#add"); // stepKey: clickCreateNewOrderNewOrder
		$I->waitForPageLoad(30); // stepKey: clickCreateNewOrderNewOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerGridLoadNewOrder
		$I->comment("Clear grid filters");
		$I->conditionalClick("#sales_order_create_customer_grid [data-action='grid-filter-reset']", "#sales_order_create_customer_grid [data-action='grid-filter-reset']", true); // stepKey: clearExistingCustomerFiltersNewOrder
		$I->waitForPageLoad(30); // stepKey: clearExistingCustomerFiltersNewOrderWaitForPageLoad
		$I->fillField("#sales_order_create_customer_grid_filter_email", $I->retrieveEntityField('createCustomer', 'email', 'hook')); // stepKey: filterEmailNewOrder
		$I->click(".action-secondary[title='Search']"); // stepKey: applyFilterNewOrder
		$I->waitForPageLoad(30); // stepKey: waitForFilteredCustomerGridLoadNewOrder
		$I->click("tr:nth-of-type(1)[data-role='row']"); // stepKey: clickOnCustomerNewOrder
		$I->waitForPageLoad(30); // stepKey: waitForCreateOrderPageLoadNewOrder
		$I->comment("Select store view if appears");
		$I->conditionalClick("//div[contains(@class, 'tree-store-scope')]//label[contains(text(), 'Default Store View')]/preceding-sibling::input", "//div[contains(@class, 'tree-store-scope')]//label[contains(text(), 'Default Store View')]/preceding-sibling::input", true); // stepKey: selectStoreViewIfAppearsNewOrder
		$I->waitForPageLoad(30); // stepKey: selectStoreViewIfAppearsNewOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCreateOrderPageLoadAfterStoreSelectNewOrder
		$I->see("Create New Order", ".page-header h1.page-title"); // stepKey: seeNewOrderPageTitleNewOrder
		$I->comment("Exiting Action Group [newOrder] NavigateToNewOrderPageExistingCustomerActionGroup");
		$I->comment("Entering Action Group [filterConfigProduct] AdminFilterProductInCreateOrderActionGroup");
		$I->click("//section[@id='order-items']/div/div/button/span[text() = 'Add Products']"); // stepKey: clickAddProductsFilterConfigProduct
		$I->waitForPageLoad(30); // stepKey: clickAddProductsFilterConfigProductWaitForPageLoad
		$I->fillField("#sales_order_create_search_grid_filter_sku", $I->retrieveEntityField('createConfigProduct', 'sku', 'hook')); // stepKey: fillSkuFilterFilterConfigProduct
		$I->click("#sales_order_create_search_grid [data-action='grid-filter-apply']"); // stepKey: clickSearchConfigurableFilterConfigProduct
		$I->waitForPageLoad(30); // stepKey: clickSearchConfigurableFilterConfigProductWaitForPageLoad
		$I->scrollTo("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]", 0, -100); // stepKey: scrollToCheckColumnFilterConfigProduct
		$I->checkOption("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]"); // stepKey: selectProductFilterConfigProduct
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingFilterConfigProduct
		$I->comment("Exiting Action Group [filterConfigProduct] AdminFilterProductInCreateOrderActionGroup");
		$I->comment("Entering Action Group [addConfProduct] AdminAddToOrderConfigurableProductActionGroup");
		$I->scrollTo("._show #catalog_product_composite_configure_fields_configurable"); // stepKey: scrollAddConfProduct
		$I->click("._show #catalog_product_composite_configure_fields_configurable"); // stepKey: focusOnSideDialogAddConfProduct
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxAddConfProduct
		$I->click("//label[text()='{$grabAttribute}']/following-sibling::div/select"); // stepKey: clickSelectorAddConfProduct
		$I->selectOption("//label[text()='{$grabAttribute}']/following-sibling::div/select", $I->retrieveEntityField('getConfigAttributeOption1', 'label', 'hook')); // stepKey: selectionOptionAddConfProduct
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxLoadAddConfProduct
		$I->fillField("#product_composite_configure_input_qty", "3"); // stepKey: fillQtyAddConfProduct
		$I->click(".modal-header .page-actions button[data-role='action']"); // stepKey: clickOkConfigurablePopoverAddConfProduct
		$I->waitForPageLoad(30); // stepKey: clickOkConfigurablePopoverAddConfProductWaitForPageLoad
		$I->scrollTo("#order-search .admin__page-section-title .actions button.action-add", 0, -100); // stepKey: scrollToAddSelectedButtonAddConfProduct
		$I->waitForPageLoad(30); // stepKey: scrollToAddSelectedButtonAddConfProductWaitForPageLoad
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: clickAddSelectedProductsAddConfProduct
		$I->waitForPageLoad(30); // stepKey: clickAddSelectedProductsAddConfProductWaitForPageLoad
		$I->comment("Exiting Action Group [addConfProduct] AdminAddToOrderConfigurableProductActionGroup");
		$I->comment("Entering Action Group [filterBundleProduct] AdminFilterProductInCreateOrderActionGroup");
		$I->click("//section[@id='order-items']/div/div/button/span[text() = 'Add Products']"); // stepKey: clickAddProductsFilterBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickAddProductsFilterBundleProductWaitForPageLoad
		$I->fillField("#sales_order_create_search_grid_filter_sku", $I->retrieveEntityField('createBundleProduct', 'sku', 'hook')); // stepKey: fillSkuFilterFilterBundleProduct
		$I->click("#sales_order_create_search_grid [data-action='grid-filter-apply']"); // stepKey: clickSearchConfigurableFilterBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickSearchConfigurableFilterBundleProductWaitForPageLoad
		$I->scrollTo("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]", 0, -100); // stepKey: scrollToCheckColumnFilterBundleProduct
		$I->checkOption("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]"); // stepKey: selectProductFilterBundleProduct
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingFilterBundleProduct
		$I->comment("Exiting Action Group [filterBundleProduct] AdminFilterProductInCreateOrderActionGroup");
		$I->comment("Entering Action Group [addBundleProduct] AdminAddToOrderBundleProductActionGroup");
		$I->scrollTo("._show #catalog_product_composite_configure_fields_bundle"); // stepKey: scrollAddBundleProduct
		$I->click("._show #catalog_product_composite_configure_fields_bundle"); // stepKey: focusOnSideDialogAddBundleProduct
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxAddBundleProduct
		$I->click("//label/span[text()='{$grabBundleOption}']/../following-sibling::div/select"); // stepKey: clickSelectorAddBundleProduct
		$I->selectOption("//label/span[text()='{$grabBundleOption}']/../following-sibling::div/select", $I->retrieveEntityField('simpleProduct1', 'name', 'hook')); // stepKey: selectionOptionAddBundleProduct
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxLoadAddBundleProduct
		$I->fillField("#product_composite_configure_input_qty", "2"); // stepKey: fillQtyAddBundleProduct
		$I->click(".modal-header .page-actions button[data-role='action']"); // stepKey: clickOkConfigurablePopoverAddBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickOkConfigurablePopoverAddBundleProductWaitForPageLoad
		$I->scrollTo("#order-search .admin__page-section-title .actions button.action-add", 0, -100); // stepKey: scrollToAddSelectedButtonAddBundleProduct
		$I->waitForPageLoad(30); // stepKey: scrollToAddSelectedButtonAddBundleProductWaitForPageLoad
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: clickAddSelectedProductsAddBundleProduct
		$I->waitForPageLoad(30); // stepKey: clickAddSelectedProductsAddBundleProductWaitForPageLoad
		$I->comment("Exiting Action Group [addBundleProduct] AdminAddToOrderBundleProductActionGroup");
		$I->comment("Entering Action Group [filterDownloadableProduct] AdminFilterProductInCreateOrderActionGroup");
		$I->click("//section[@id='order-items']/div/div/button/span[text() = 'Add Products']"); // stepKey: clickAddProductsFilterDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: clickAddProductsFilterDownloadableProductWaitForPageLoad
		$I->fillField("#sales_order_create_search_grid_filter_sku", $I->retrieveEntityField('downloadableProduct', 'sku', 'hook')); // stepKey: fillSkuFilterFilterDownloadableProduct
		$I->click("#sales_order_create_search_grid [data-action='grid-filter-apply']"); // stepKey: clickSearchConfigurableFilterDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: clickSearchConfigurableFilterDownloadableProductWaitForPageLoad
		$I->scrollTo("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]", 0, -100); // stepKey: scrollToCheckColumnFilterDownloadableProduct
		$I->checkOption("#sales_order_create_search_grid_table > tbody tr:nth-of-type(1) td.col-select [type=checkbox]"); // stepKey: selectProductFilterDownloadableProduct
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingFilterDownloadableProduct
		$I->comment("Exiting Action Group [filterDownloadableProduct] AdminFilterProductInCreateOrderActionGroup");
		$I->comment("Entering Action Group [addDownloadableProduct] AdminAddToOrderDownloadableProductActionGroup");
		$I->scrollTo("._show #catalog_product_composite_configure_fields_downloadable"); // stepKey: scrollAddDownloadableProduct
		$I->click("._show #catalog_product_composite_configure_fields_downloadable"); // stepKey: focusOnSideDialogAddDownloadableProduct
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxAddDownloadableProduct
		$I->checkOption("//label[contains(text(),'{$grabLink}')]/preceding-sibling::input"); // stepKey: checkLinkAddDownloadableProduct
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxLoadAddDownloadableProduct
		$I->fillField("#product_composite_configure_input_qty", "1"); // stepKey: fillQtyAddDownloadableProduct
		$I->click(".modal-header .page-actions button[data-role='action']"); // stepKey: clickOkConfigurablePopoverAddDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: clickOkConfigurablePopoverAddDownloadableProductWaitForPageLoad
		$I->scrollTo("#order-search .admin__page-section-title .actions button.action-add", 0, -100); // stepKey: scrollToAddSelectedButtonAddDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: scrollToAddSelectedButtonAddDownloadableProductWaitForPageLoad
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: clickAddSelectedProductsAddDownloadableProduct
		$I->waitForPageLoad(30); // stepKey: clickAddSelectedProductsAddDownloadableProductWaitForPageLoad
		$I->comment("Exiting Action Group [addDownloadableProduct] AdminAddToOrderDownloadableProductActionGroup");
		$I->comment("add Coupon");
		$I->comment("Entering Action Group [addCoupon] AdminAddToOrderCouponCodeActionGroup");
		$I->fillField("//input[@name='coupon_code']", $I->retrieveEntityField('createCouponForCartPriceRule', 'code', 'hook')); // stepKey: fillCouponCodeAddCoupon
		$I->click("//input[@name='coupon_code']/following-sibling::button"); // stepKey: clickApplyAddCoupon
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddCoupon
		$I->comment("Exiting Action Group [addCoupon] AdminAddToOrderCouponCodeActionGroup");
		$I->comment("Entering Action Group [fillOrder] FillOrderCustomerInformationActionGroup");
		$I->fillField("#order-billing_address_firstname", $I->retrieveEntityField('createCustomer', 'firstname', 'hook')); // stepKey: fillFirstNameFillOrder
		$I->waitForPageLoad(30); // stepKey: fillFirstNameFillOrderWaitForPageLoad
		$I->fillField("#order-billing_address_lastname", $I->retrieveEntityField('createCustomer', 'lastname', 'hook')); // stepKey: fillLastNameFillOrder
		$I->waitForPageLoad(30); // stepKey: fillLastNameFillOrderWaitForPageLoad
		$I->fillField("#order-billing_address_street0", "7700 West Parmer Lane"); // stepKey: fillStreetLine1FillOrder
		$I->waitForPageLoad(30); // stepKey: fillStreetLine1FillOrderWaitForPageLoad
		$I->fillField("#order-billing_address_city", "Austin"); // stepKey: fillCityFillOrder
		$I->waitForPageLoad(30); // stepKey: fillCityFillOrderWaitForPageLoad
		$I->selectOption("#order-billing_address_country_id", "US"); // stepKey: fillCountryFillOrder
		$I->waitForPageLoad(30); // stepKey: fillCountryFillOrderWaitForPageLoad
		$I->selectOption("#order-billing_address_region_id", "Texas"); // stepKey: fillStateFillOrder
		$I->waitForPageLoad(30); // stepKey: fillStateFillOrderWaitForPageLoad
		$I->fillField("#order-billing_address_postcode", "78729"); // stepKey: fillPostalCodeFillOrder
		$I->waitForPageLoad(30); // stepKey: fillPostalCodeFillOrderWaitForPageLoad
		$I->fillField("#order-billing_address_telephone", "512-345-6789"); // stepKey: fillPhoneFillOrder
		$I->waitForPageLoad(30); // stepKey: fillPhoneFillOrderWaitForPageLoad
		$I->comment("Exiting Action Group [fillOrder] FillOrderCustomerInformationActionGroup");
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
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$removeDownloadableDomain = $I->magentoCLI("downloadable:domains:remove", 60, "example.com static.magento.com"); // stepKey: removeDownloadableDomain
		$I->comment($removeDownloadableDomain);
		$I->deleteEntity("downloadableProduct", "hook"); // stepKey: deleteProduct
		$I->deleteEntity("createConfigChildProduct1", "hook"); // stepKey: deleteConfigChildProduct1
		$I->deleteEntity("createConfigChildProduct2", "hook"); // stepKey: deleteConfigChildProduct2
		$I->deleteEntity("createConfigChildProduct3", "hook"); // stepKey: deleteConfigChildProduct3
		$I->deleteEntity("createConfigProduct", "hook"); // stepKey: deleteConfigProduct
		$I->deleteEntity("createConfigProductAttribute", "hook"); // stepKey: deleteConfigProductAttribute
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("simpleProduct1", "hook"); // stepKey: deleteProduct1
		$I->deleteEntity("simpleProduct2", "hook"); // stepKey: deleteProduct2
		$I->deleteEntity("createBundleProduct", "hook"); // stepKey: deleteBundleProduct
		$I->deleteEntity("createSubCategory", "hook"); // stepKey: deleteCategory1
		$I->deleteEntity("createCartPriceRule", "hook"); // stepKey: deleteCartPriceRule
		$I->deleteEntity("createCustomer", "hook"); // stepKey: deleteCustomer
		$I->comment("Entering Action Group [logout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageLogout
		$I->comment("Exiting Action Group [logout] AdminLogoutActionGroup");
		$I->comment("Reindex invalidated indices after product attribute has been created/deleted");
		$reindexInvalidatedIndices = $I->magentoCron("index", 90); // stepKey: reindexInvalidatedIndices
		$I->comment($reindexInvalidatedIndices);
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
	 * @Stories({"Print Order"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Features({"Sales"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontPrintOrderGuestTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [submitOrder] AdminSubmitOrderActionGroup");
		$I->click("#submit_order_top_button"); // stepKey: submitOrderSubmitOrder
		$I->waitForPageLoad(60); // stepKey: submitOrderSubmitOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSubmitOrder
		$I->see("You created the order."); // stepKey: seeSuccessMessageForOrderSubmitOrder
		$I->comment("Exiting Action Group [submitOrder] AdminSubmitOrderActionGroup");
		$getOrderId = $I->grabTextFrom("|Order # (\d+)|"); // stepKey: getOrderId
		$I->assertNotEmpty($getOrderId); // stepKey: assertOrderIdIsNotEmpty
		$I->comment("Find the Order on frontend > Navigate to: Orders and Returns");
		$I->amOnPage("sales/guest/form/"); // stepKey: amOnOrdersAndReturns
		$I->waitForPageLoad(30); // stepKey: waiForStorefrontPage
		$I->comment("Fill the form with correspondent Order data");
		$I->comment("Entering Action Group [fillOrder] StorefrontFillOrdersAndReturnsFormActionGroup");
		$I->fillField("#oar-order-id", $getOrderId); // stepKey: inputOrderIdFillOrder
		$I->fillField("#oar-billing-lastname", $I->retrieveEntityField('createCustomer', 'lastname', 'test')); // stepKey: inputBillingLastNameFillOrder
		$I->selectOption("#quick-search-type-id", "email"); // stepKey: selectFindOrderByEmailFillOrder
		$I->fillField("#oar_email", $I->retrieveEntityField('createCustomer', 'email', 'test')); // stepKey: inputEmailFillOrder
		$I->comment("Exiting Action Group [fillOrder] StorefrontFillOrdersAndReturnsFormActionGroup");
		$I->comment("Click on the \"Continue\" button");
		$I->click("//*/span[contains(text(), 'Continue')]"); // stepKey: clickContinue
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->comment("Click on the \"Print Order\" button");
		$I->click(".order-actions-toolbar .actions .print"); // stepKey: printOrder
		$I->waitForPageLoad(30); // stepKey: printOrderWaitForPageLoad
		$I->switchToWindow(); // stepKey: switchToWindow
		$I->switchToNextTab(); // stepKey: switchToTab
		$I->seeInCurrentUrl("sales/guest/print/order_id/"); // stepKey: seePrintPage
		$I->comment("AssertSalesPrintOrderProducts");
		$I->see($I->retrieveEntityField('createBundleProduct', 'name', 'test'), "//*[contains(@class, 'product-item-name')]"); // stepKey: seeBundleProduct
		$I->see($I->retrieveEntityField('downloadableProduct', 'name', 'test'), "//*[contains(@class, 'product-item-name')]"); // stepKey: seeDownloadableProduct
		$I->see($I->retrieveEntityField('createConfigProduct', 'name', 'test'), "//*[contains(@class, 'product-item-name')]"); // stepKey: seeConfigurableProduct
		$I->comment("AssertSalesPrintOrderBillingAddress");
		$I->scrollTo(".block-order-details-view"); // stepKey: scrollToFooter
		$I->comment("Entering Action Group [assertSalesPrintOrderBillingAddress] AssertSalesPrintOrderBillingAddress");
		$I->see("John", ".box-order-billing-address > .box-content > address"); // stepKey: seeFirstnameAssertSalesPrintOrderBillingAddress
		$I->see("Doe", ".box-order-billing-address > .box-content > address"); // stepKey: seeLastnameAssertSalesPrintOrderBillingAddress
		$I->see("Magento", ".box-order-billing-address > .box-content > address"); // stepKey: seeCompanyAssertSalesPrintOrderBillingAddress
		$I->see("7700 West Parmer Lane", ".box-order-billing-address > .box-content > address"); // stepKey: seeStreetAssertSalesPrintOrderBillingAddress
		$I->see("Austin", ".box-order-billing-address > .box-content > address"); // stepKey: seeCityAssertSalesPrintOrderBillingAddress
		$I->see("Texas", ".box-order-billing-address > .box-content > address"); // stepKey: seeStateAssertSalesPrintOrderBillingAddress
		$I->see("78729", ".box-order-billing-address > .box-content > address"); // stepKey: seePostcodeAssertSalesPrintOrderBillingAddress
		$I->see("United States", ".box-order-billing-address > .box-content > address"); // stepKey: seeCountryAssertSalesPrintOrderBillingAddress
		$I->see("512-345-6789", ".box-order-billing-address > .box-content > address"); // stepKey: seeTelephoneAssertSalesPrintOrderBillingAddress
		$I->comment("Exiting Action Group [assertSalesPrintOrderBillingAddress] AssertSalesPrintOrderBillingAddress");
		$I->comment("AssertSalesPrintOrderGrandTotal");
		$I->see("$357.43", "tr.grand_total span.price"); // stepKey: assertSalesPrintOrderGrandTotal
		$I->comment("AssertSalesPrintOrderPaymentMethod");
		$I->see("Check / Money order", ".box-order-billing-method dt.title"); // stepKey: assertSalesPrintOrderPaymentMethod
		$I->comment("AssertSalesRuleOnPrintOrder");
		$I->see("-$270.00", "tr.discount span.price"); // stepKey: assertSalesRuleOnPrintOrder
		$I->comment("AssertShippingMethodOnPrintOrder");
		$I->see("Flat Rate - Fixed", ".box-order-shipping-method div.box-content"); // stepKey: assertShippingMethodOnPrintOrder
		$I->switchToPreviousTab(); // stepKey: switchToPreviousTab
	}
}
