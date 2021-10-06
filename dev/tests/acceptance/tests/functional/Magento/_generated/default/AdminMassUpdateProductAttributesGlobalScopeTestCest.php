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
 * @Title("MC-56: Admin should be able to mass update product attributes in global scope")
 * @Description("Admin should be able to mass update product attributes in global scope<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminMassUpdateProductAttributesGlobalScopeTest.xml<br>")
 * @TestCaseId("MC-56")
 * @group catalog
 * @group product_attributes
 */
class AdminMassUpdateProductAttributesGlobalScopeTestCest
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
		$I->comment("Entering Action Group [deleteAllProducts] DeleteAllProductsUsingProductGridActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: openAdminGridProductsPageDeleteAllProducts
		$I->waitForPageLoad(60); // stepKey: waitForPageFullyLoadDeleteAllProducts
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clearGridFiltersDeleteAllProducts
		$I->waitForPageLoad(30); // stepKey: clearGridFiltersDeleteAllProductsWaitForPageLoad
		$I->conditionalClick("div[data-role='grid-wrapper'] th.data-grid-multicheck-cell button.action-multicheck-toggle", ".data-grid-tr-no-data td", false); // stepKey: openMulticheckDropdownDeleteAllProducts
		$I->conditionalClick("//div[@data-role='grid-wrapper']//th[contains(@class, data-grid-multicheck-cell)]//li//span[text() = 'Select All']", ".data-grid-tr-no-data td", false); // stepKey: selectAllProductsInGridDeleteAllProducts
		$I->click("div.admin__data-grid-header-row.row div.action-select-wrap button.action-select"); // stepKey: clickActionDropdownDeleteAllProducts
		$I->click("//div[contains(@class,'admin__data-grid-header-row') and contains(@class, 'row')]//div[contains(@class, 'action-select-wrap')]//ul/li/span[text() = 'Delete']"); // stepKey: clickDeleteActionDeleteAllProducts
		$I->waitForElementVisible("aside.confirm .modal-content", 30); // stepKey: waitForConfirmModalDeleteAllProducts
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmDeleteDeleteAllProducts
		$I->waitForPageLoad(60); // stepKey: confirmDeleteDeleteAllProductsWaitForPageLoad
		$I->waitForElementVisible(".data-grid-tr-no-data td", 30); // stepKey: waitGridIsEmptyDeleteAllProducts
		$I->comment("Exiting Action Group [deleteAllProducts] DeleteAllProductsUsingProductGridActionGroup");
		$I->comment("Entering Action Group [createStoreView] AdminCreateStoreViewActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_store/newStore"); // stepKey: navigateToNewStoreViewCreateStoreView
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1CreateStoreView
		$I->comment("Creating Store View");
		$I->comment("Create Store View");
		$I->selectOption("#store_group_id", "Main Website Store"); // stepKey: selectStoreCreateStoreView
		$I->fillField("#store_name", "store" . msq("customStore")); // stepKey: enterStoreViewNameCreateStoreView
		$I->fillField("#store_code", "store" . msq("customStore")); // stepKey: enterStoreViewCodeCreateStoreView
		$I->selectOption("#store_is_active", "Enabled"); // stepKey: setStatusCreateStoreView
		$I->click("#save"); // stepKey: clickSaveStoreViewCreateStoreView
		$I->waitForPageLoad(60); // stepKey: clickSaveStoreViewCreateStoreViewWaitForPageLoad
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitForModalCreateStoreView
		$I->waitForPageLoad(60); // stepKey: waitForModalCreateStoreViewWaitForPageLoad
		$I->see("Warning message", "aside.confirm .modal-title"); // stepKey: seeWarningAboutTakingALongTimeToCompleteCreateStoreView
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmModalCreateStoreView
		$I->waitForPageLoad(60); // stepKey: confirmModalCreateStoreViewWaitForPageLoad
		$I->waitForText("You saved the store view.", 30, "#messages div.message-success"); // stepKey: seeSavedMessageCreateStoreView
		$I->comment("Exiting Action Group [createStoreView] AdminCreateStoreViewActionGroup");
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createProductOne", "hook", "ApiSimpleProduct", ["createCategory"], []); // stepKey: createProductOne
		$I->createEntity("createProductTwo", "hook", "ApiSimpleProduct", ["createCategory"], []); // stepKey: createProductTwo
		$reindexInvalidatedIndices = $I->magentoCron("index", 90); // stepKey: reindexInvalidatedIndices
		$I->comment($reindexInvalidatedIndices);
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createProductOne", "hook"); // stepKey: deleteProductOne
		$I->deleteEntity("createProductTwo", "hook"); // stepKey: deleteProductTwo
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->comment("Entering Action Group [AdminDeleteStoreViewActionGroup] AdminDeleteStoreViewActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_store/"); // stepKey: navigateToStoresIndexAdminDeleteStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: waitStoreIndexPageLoadAdminDeleteStoreViewActionGroup
		$I->click("button[title='Reset Filter']"); // stepKey: resetSearchFilterAdminDeleteStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: resetSearchFilterAdminDeleteStoreViewActionGroupWaitForPageLoad
		$I->fillField("#storeGrid_filter_store_title", "store" . msq("customStore")); // stepKey: fillStoreViewFilterFieldAdminDeleteStoreViewActionGroup
		$I->waitForPageLoad(90); // stepKey: fillStoreViewFilterFieldAdminDeleteStoreViewActionGroupWaitForPageLoad
		$I->click(".admin__data-grid-header button[title=Search]"); // stepKey: clickSearchAdminDeleteStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: clickSearchAdminDeleteStoreViewActionGroupWaitForPageLoad
		$I->click(".col-store_title>a"); // stepKey: clickStoreViewInGridAdminDeleteStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: waitForStoreViewPageAdminDeleteStoreViewActionGroup
		$I->click("#delete"); // stepKey: clickDeleteStoreViewAdminDeleteStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: clickDeleteStoreViewAdminDeleteStoreViewActionGroupWaitForPageLoad
		$I->selectOption("select#store_create_backup", "No"); // stepKey: dontCreateDbBackupAdminDeleteStoreViewActionGroup
		$I->click("#delete"); // stepKey: clickDeleteStoreViewAgainAdminDeleteStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: clickDeleteStoreViewAgainAdminDeleteStoreViewActionGroupWaitForPageLoad
		$I->waitForElementVisible("aside.confirm .modal-title", 30); // stepKey: waitingForWarningModalAdminDeleteStoreViewActionGroup
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmStoreDeleteAdminDeleteStoreViewActionGroup
		$I->waitForPageLoad(60); // stepKey: confirmStoreDeleteAdminDeleteStoreViewActionGroupWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSuccessMessageAdminDeleteStoreViewActionGroup
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitSuccessMessageAppearsAdminDeleteStoreViewActionGroup
		$I->see("You deleted the store view.", "#messages div.message-success"); // stepKey: seeDeleteMessageAdminDeleteStoreViewActionGroup
		$I->comment("Exiting Action Group [AdminDeleteStoreViewActionGroup] AdminDeleteStoreViewActionGroup");
		$I->click("button[title='Reset Filter']"); // stepKey: resetSearchFilter
		$I->waitForPageLoad(30); // stepKey: resetSearchFilterWaitForPageLoad
		$I->comment("Entering Action Group [clearProductFilter] ClearProductsFilterActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: navigateToProductIndexClearProductFilter
		$I->waitForPageLoad(30); // stepKey: waitForProductsPageToLoadClearProductFilter
		$I->conditionalClick("//div[@class='admin__data-grid-header']//button[@class='action-tertiary action-clear']", "//div[@class='admin__data-grid-header']//button[@class='action-tertiary action-clear']", true); // stepKey: cleanFiltersIfTheySetClearProductFilter
		$I->waitForPageLoad(10); // stepKey: cleanFiltersIfTheySetClearProductFilterWaitForPageLoad
		$I->comment("Exiting Action Group [clearProductFilter] ClearProductsFilterActionGroup");
		$I->comment("Entering Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAmOnLogoutPage
		$I->comment("Exiting Action Group [amOnLogoutPage] AdminLogoutActionGroup");
		$reindexInvalidatedIndicesAfterDelete = $I->magentoCron("index", 90); // stepKey: reindexInvalidatedIndicesAfterDelete
		$I->comment($reindexInvalidatedIndicesAfterDelete);
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
	 * @Features({"Catalog"})
	 * @Stories({"Mass update product attributes"})
	 * @Severity(level = SeverityLevel::MINOR)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminMassUpdateProductAttributesGlobalScopeTest(AcceptanceTester $I)
	{
		$I->comment("Search and select products");
		$I->comment("Entering Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageNavigateToProductIndex
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadNavigateToProductIndex
		$I->comment("Exiting Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->comment("Entering Action Group [searchByKeyword] SearchProductGridByKeyword2ActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersInitialSearchByKeyword
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersInitialSearchByKeywordWaitForPageLoad
		$I->fillField("input#fulltext", "api-simple-product"); // stepKey: fillKeywordSearchFieldSearchByKeyword
		$I->click(".data-grid-search-control-wrap button.action-submit"); // stepKey: clickKeywordSearchSearchByKeyword
		$I->waitForPageLoad(30); // stepKey: clickKeywordSearchSearchByKeywordWaitForPageLoad
		$I->comment("Exiting Action Group [searchByKeyword] SearchProductGridByKeyword2ActionGroup");
		$I->comment("Entering Action Group [sortProductsByIdDescending] SortProductsByIdDescendingActionGroup");
		$I->conditionalClick(".//*[@class='sticky-header']/following-sibling::*//th[@class='data-grid-th _sortable _draggable _ascend']/span[text()='ID']", ".//*[@class='sticky-header']/following-sibling::*//th[@class='data-grid-th _sortable _draggable _descend']/span[text()='ID']", false); // stepKey: sortByIdSortProductsByIdDescending
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSortProductsByIdDescending
		$I->comment("Exiting Action Group [sortProductsByIdDescending] SortProductsByIdDescendingActionGroup");
		$I->click("//*[@id='container']//tr[1]/td[1]//input"); // stepKey: clickCheckbox1
		$I->click("//*[@id='container']//tr[2]/td[1]//input"); // stepKey: clickCheckbox2
		$I->comment("Mass update attributes");
		$I->click("div.admin__data-grid-header-row.row div.action-select-wrap button.action-select"); // stepKey: clickDropdown
		$I->click("//div[contains(@class,'admin__data-grid-header-row') and contains(@class, 'row')]//div[contains(@class, 'action-select-wrap')]//ul/li/span[text() = 'Update attributes']"); // stepKey: clickOption
		$I->waitForPageLoad(30); // stepKey: waitForBulkUpdatePage
		$I->seeInCurrentUrl("catalog/product_action_attribute/edit/"); // stepKey: seeInUrl
		$I->comment("Switch store view");
		$I->comment("Entering Action Group [AdminSwitchStoreViewActionGroup] AdminSwitchStoreViewActionGroup");
		$I->click("#store-change-button"); // stepKey: clickStoreViewSwitchDropdownAdminSwitchStoreViewActionGroup
		$I->waitForElementVisible("//*[contains(@class,'store-switcher-store-view')]/*[contains(text(), 'Default Store View')]", 30); // stepKey: waitForStoreViewsAreVisibleAdminSwitchStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: waitForStoreViewsAreVisibleAdminSwitchStoreViewActionGroupWaitForPageLoad
		$I->click("//*[contains(@class,'store-switcher-store-view')]/*[contains(text(), 'store" . msq("customStore") . "')]"); // stepKey: clickStoreViewByNameAdminSwitchStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: clickStoreViewByNameAdminSwitchStoreViewActionGroupWaitForPageLoad
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitingForInformationModalAdminSwitchStoreViewActionGroup
		$I->waitForPageLoad(60); // stepKey: waitingForInformationModalAdminSwitchStoreViewActionGroupWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmStoreSwitchAdminSwitchStoreViewActionGroup
		$I->waitForPageLoad(60); // stepKey: confirmStoreSwitchAdminSwitchStoreViewActionGroupWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForStoreViewSwitchedAdminSwitchStoreViewActionGroup
		$I->scrollToTopOfPage(); // stepKey: scrollToStoreSwitcherAdminSwitchStoreViewActionGroup
		$I->see("store" . msq("customStore"), ".store-switcher"); // stepKey: seeNewStoreViewNameAdminSwitchStoreViewActionGroup
		$I->comment("Exiting Action Group [AdminSwitchStoreViewActionGroup] AdminSwitchStoreViewActionGroup");
		$I->comment("Update attribute");
		$I->checkOption("#toggle_price"); // stepKey: toggleToChangePrice
		$I->fillField("#price", $I->retrieveEntityField('createProductOne', 'price', 'test') . "0"); // stepKey: fillAttributeNameField
		$I->click("button[title=Save]"); // stepKey: save
		$I->waitForPageLoad(30); // stepKey: saveWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 60); // stepKey: waitForSuccessMessage
		$I->see("Message is added to queue", "#messages div.message-success"); // stepKey: seeAttributeUpdateSuccessMsg
		$I->comment("Start message queue for product attribute consumer");
		$I->comment("Entering Action Group [startMessageQueue] CliConsumerStartActionGroup");
		$startMessageQueueStartMessageQueue = $I->magentoCLI("queue:consumers:start product_action_attribute.update --max-messages=100", 60); // stepKey: startMessageQueueStartMessageQueue
		$I->comment($startMessageQueueStartMessageQueue);
		$I->comment("Exiting Action Group [startMessageQueue] CliConsumerStartActionGroup");
		$I->comment("Assert on storefront default view");
		$I->comment("Entering Action Group [GoToStoreViewAdvancedCatalogSearchActionGroupDefault] GoToStoreViewAdvancedCatalogSearchActionGroup");
		$I->amOnPage("/catalogsearch/advanced/"); // stepKey: GoToStoreViewAdvancedCatalogSearchActionGroupGoToStoreViewAdvancedCatalogSearchActionGroupDefault
		$I->waitForPageLoad(90); // stepKey: waitForPageLoadGoToStoreViewAdvancedCatalogSearchActionGroupDefault
		$I->comment("Exiting Action Group [GoToStoreViewAdvancedCatalogSearchActionGroupDefault] GoToStoreViewAdvancedCatalogSearchActionGroup");
		$I->comment("Entering Action Group [searchByNameDefault] StorefrontAdvancedCatalogSearchByProductNameAndPriceActionGroup");
		$I->fillField("#name", "\"" . $I->retrieveEntityField('createProductOne', 'name', 'test') . "\""); // stepKey: fillNameSearchByNameDefault
		$I->fillField("#price", $I->retrieveEntityField('createProductOne', 'price', 'test') . "0"); // stepKey: fillPriceFromSearchByNameDefault
		$I->fillField("#price_to", $I->retrieveEntityField('createProductOne', 'price', 'test') . "0"); // stepKey: fillPriceToSearchByNameDefault
		$I->click("//*[@id='form-validate']//button[@type='submit']"); // stepKey: clickSubmitSearchByNameDefault
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSearchByNameDefault
		$I->comment("Exiting Action Group [searchByNameDefault] StorefrontAdvancedCatalogSearchByProductNameAndPriceActionGroup");
		$I->comment("Entering Action Group [StorefrontCheckAdvancedSearchResultDefault] StorefrontCheckAdvancedSearchResultActionGroup");
		$I->seeInCurrentUrl("/catalogsearch/advanced/result"); // stepKey: checkUrlStorefrontCheckAdvancedSearchResultDefault
		$I->seeInTitle("Advanced Search Results"); // stepKey: assertAdvancedSearchTitleStorefrontCheckAdvancedSearchResultDefault
		$I->see("Catalog Advanced Search", ".page-title span"); // stepKey: assertAdvancedSearchNameStorefrontCheckAdvancedSearchResultDefault
		$I->comment("Exiting Action Group [StorefrontCheckAdvancedSearchResultDefault] StorefrontCheckAdvancedSearchResultActionGroup");
		$I->waitForElementVisible(".search.found>strong", 30); // stepKey: waitForSearchResultInDefaultView
		$I->see("1 item", ".search.found>strong"); // stepKey: seeInDefault
		$I->comment("Assert on storefront custom view");
		$I->comment("Entering Action Group [GoToStoreViewAdvancedCatalogSearchActionGroupCustom] GoToStoreViewAdvancedCatalogSearchActionGroup");
		$I->amOnPage("/catalogsearch/advanced/"); // stepKey: GoToStoreViewAdvancedCatalogSearchActionGroupGoToStoreViewAdvancedCatalogSearchActionGroupCustom
		$I->waitForPageLoad(90); // stepKey: waitForPageLoadGoToStoreViewAdvancedCatalogSearchActionGroupCustom
		$I->comment("Exiting Action Group [GoToStoreViewAdvancedCatalogSearchActionGroupCustom] GoToStoreViewAdvancedCatalogSearchActionGroup");
		$I->comment("Entering Action Group [StorefrontSwitchStoreViewActionGroup] StorefrontSwitchStoreViewActionGroup");
		$I->click("#switcher-language-trigger"); // stepKey: clickStoreViewSwitcherStorefrontSwitchStoreViewActionGroup
		$I->waitForElementVisible(".active ul.switcher-dropdown", 30); // stepKey: waitForStoreViewDropdownStorefrontSwitchStoreViewActionGroup
		$I->click("li.view-store" . msq("customStore") . ">a"); // stepKey: clickSelectStoreViewStorefrontSwitchStoreViewActionGroup
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadStorefrontSwitchStoreViewActionGroup
		$I->comment("Exiting Action Group [StorefrontSwitchStoreViewActionGroup] StorefrontSwitchStoreViewActionGroup");
		$I->comment("Entering Action Group [searchByNameCustom] StorefrontAdvancedCatalogSearchByProductNameAndPriceActionGroup");
		$I->fillField("#name", "\"" . $I->retrieveEntityField('createProductOne', 'name', 'test') . "\""); // stepKey: fillNameSearchByNameCustom
		$I->fillField("#price", $I->retrieveEntityField('createProductOne', 'price', 'test') . "0"); // stepKey: fillPriceFromSearchByNameCustom
		$I->fillField("#price_to", $I->retrieveEntityField('createProductOne', 'price', 'test') . "0"); // stepKey: fillPriceToSearchByNameCustom
		$I->click("//*[@id='form-validate']//button[@type='submit']"); // stepKey: clickSubmitSearchByNameCustom
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSearchByNameCustom
		$I->comment("Exiting Action Group [searchByNameCustom] StorefrontAdvancedCatalogSearchByProductNameAndPriceActionGroup");
		$I->comment("Entering Action Group [StorefrontCheckAdvancedSearchResultCustom] StorefrontCheckAdvancedSearchResultActionGroup");
		$I->seeInCurrentUrl("/catalogsearch/advanced/result"); // stepKey: checkUrlStorefrontCheckAdvancedSearchResultCustom
		$I->seeInTitle("Advanced Search Results"); // stepKey: assertAdvancedSearchTitleStorefrontCheckAdvancedSearchResultCustom
		$I->see("Catalog Advanced Search", ".page-title span"); // stepKey: assertAdvancedSearchNameStorefrontCheckAdvancedSearchResultCustom
		$I->comment("Exiting Action Group [StorefrontCheckAdvancedSearchResultCustom] StorefrontCheckAdvancedSearchResultActionGroup");
		$I->waitForElementVisible(".search.found>strong", 30); // stepKey: waitForSearchResultInCustomView
		$I->see("1 item", ".search.found>strong"); // stepKey: seeInCustom
	}
}
