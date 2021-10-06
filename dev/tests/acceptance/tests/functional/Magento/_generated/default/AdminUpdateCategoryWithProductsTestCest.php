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
 * @Title("MC-6059: Update category, sort products by default sorting")
 * @Description("Login as admin, update category and sort products<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminUpdateCategoryWithProductsTest.xml<br>")
 * @TestCaseId("MC-6059")
 * @group Catalog
 * @group mtf_migrated
 */
class AdminUpdateCategoryWithProductsTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginToAdminPanel
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginToAdminPanel
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginToAdminPanel
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginToAdminPanel
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginToAdminPanelWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginToAdminPanel
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginToAdminPanel
		$I->comment("Exiting Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->createEntity("simpleProduct", "hook", "defaultSimpleProduct", [], []); // stepKey: simpleProduct
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("simpleProduct", "hook"); // stepKey: deleteSimpleProduct
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
	 * @Stories({"Update categories"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminUpdateCategoryWithProductsTest(AcceptanceTester $I)
	{
		$I->comment("Open Category Page");
		$I->comment("Entering Action Group [openAdminCategoryIndexPage] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageOpenAdminCategoryIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadOpenAdminCategoryIndexPage
		$I->comment("Exiting Action Group [openAdminCategoryIndexPage] AdminOpenCategoryPageActionGroup");
		$I->comment("Entering Action Group [clickOnExpandTree] AdminExpandCategoryTreeActionGroup");
		$I->click(".tree-actions a:last-child"); // stepKey: clickOnExpandTreeClickOnExpandTree
		$I->waitForPageLoad(30); // stepKey: waitForCategoryToLoadClickOnExpandTree
		$I->comment("Exiting Action Group [clickOnExpandTree] AdminExpandCategoryTreeActionGroup");
		$I->click("//a/span[contains(text(), 'simpleCategory" . msq("_defaultCategory") . "')]"); // stepKey: selectCreatedCategory
		$I->waitForPageLoad(30); // stepKey: selectCreatedCategoryWaitForPageLoad
		$I->checkOption("input[name='is_active']"); // stepKey: enableCategory
		$I->comment("Update Product Display Setting");
		$I->scrollTo("//strong[@class='admin__collapsible-title']//span[text()='Display Settings']", 0, -80); // stepKey: scrollToDisplaySetting
		$I->click("//strong[@class='admin__collapsible-title']//span[text()='Display Settings']"); // stepKey: selectDisplaySetting
		$I->scrollToTopOfPage(); // stepKey: scfrollToTop
		$I->click("input[name='use_config[available_sort_by]']"); // stepKey: enableTheAvailableProductList
		$I->selectOption("select[name='available_sort_by']", ['Product Name',  'Price']); // stepKey: selectPrice
		$I->scrollTo("input[name='use_config[default_sort_by]']", 0, -80); // stepKey: scrollToDefaultProductList
		$I->click("input[name='use_config[default_sort_by]']"); // stepKey: enableTheDefaultProductList
		$I->selectOption("select[name='default_sort_by']", "name"); // stepKey: selectProductName
		$I->comment("Add Products in Category");
		$I->scrollTo("div[data-index='assign_products']", 0, -80); // stepKey: scrollToProductInCategory
		$I->waitForPageLoad(30); // stepKey: scrollToProductInCategoryWaitForPageLoad
		$I->click("div[data-index='assign_products']"); // stepKey: clickOnProductInCategory
		$I->waitForPageLoad(30); // stepKey: clickOnProductInCategoryWaitForPageLoad
		$I->scrollToTopOfPage(); // stepKey: scrollOnTopOfPage
		$I->click("//span[contains(text(), 'Reset Filter')]"); // stepKey: clickOnResetFilter
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoad
		$I->fillField("#catalog_category_products_filter_name", $I->retrieveEntityField('simpleProduct', 'name', 'test')); // stepKey: selectProduct1
		$I->click("//button[@data-action='grid-filter-apply']"); // stepKey: clickSearchButton
		$I->waitForPageLoad(30); // stepKey: clickSearchButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitFroPageToLoad1
		$I->scrollTo("#catalog_category_products_table tbody tr"); // stepKey: scrollToTableRow
		$I->click("#catalog_category_products_table tbody tr"); // stepKey: selectProduct1FromTableRow
		$I->comment("Entering Action Group [clickSaveButton] AdminSaveCategoryActionGroup");
		$I->click(".page-actions-inner #save"); // stepKey: saveCategoryWithProductsClickSaveButton
		$I->waitForPageLoad(30); // stepKey: saveCategoryWithProductsClickSaveButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCategorySavedClickSaveButton
		$I->comment("Exiting Action Group [clickSaveButton] AdminSaveCategoryActionGroup");
		$I->comment("Entering Action Group [assertSuccessMessage] AssertAdminCategorySaveSuccessMessageActionGroup");
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForElementAssertSuccessMessage
		$I->see("You saved the category.", "#messages div.message-success"); // stepKey: seeSuccessMessageAssertSuccessMessage
		$I->comment("Exiting Action Group [assertSuccessMessage] AssertAdminCategorySaveSuccessMessageActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForPageTitleToBeSaved
		$I->comment("Verify Category Title");
		$I->see("simpleCategory" . msq("_defaultCategory"), "h1.page-title"); // stepKey: seePageTitle
		$I->comment("Perform reindex and flush cache");
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Verify Category in store front page");
		$I->amOnPage("/simpleCategory" . msq("_defaultCategory") . ".html"); // stepKey: seeDefaultProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageToBeLoaded
		$I->seeElement("//nav//a[span[contains(., 'simpleCategory" . msq("_defaultCategory") . "')]]"); // stepKey: seeCategoryOnNavigation
		$I->waitForPageLoad(30); // stepKey: seeCategoryOnNavigationWaitForPageLoad
		$I->click("//nav//a[span[contains(., 'simpleCategory" . msq("_defaultCategory") . "')]]"); // stepKey: selectCategory
		$I->waitForPageLoad(30); // stepKey: selectCategoryWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductToLoad
		$I->comment("Verify Product in Category");
		$I->seeElement("a.product-item-link"); // stepKey: seeProductsInCategory
		$I->waitForPageLoad(30); // stepKey: seeProductsInCategoryWaitForPageLoad
		$I->click("a.product-item-link"); // stepKey: openSearchedProduct
		$I->waitForPageLoad(30); // stepKey: openSearchedProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductToLoad1
		$I->comment("Verify product name and price on Store Front");
		$I->see("Testp" . msq("defaultSimpleProduct"), ".base"); // stepKey: assertProductName
		$I->see("560.00", "div.price-box.price-final_price"); // stepKey: assertProductPrice
	}
}
