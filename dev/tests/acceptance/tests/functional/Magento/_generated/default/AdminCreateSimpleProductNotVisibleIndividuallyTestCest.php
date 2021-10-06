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
 * @Title(": Create Simple Product that Not Visible Individually")
 * @Description("Create Simple Product that Not Visible Individually<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminCreateSimpleProductNotVisibleIndividuallyTest.xml<br>")
 * @TestCaseId("")
 * @group mtf_migrated
 */
class AdminCreateSimpleProductNotVisibleIndividuallyTestCest
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
		$I->createEntity("createPreReqCategory", "hook", "_defaultCategory", [], []); // stepKey: createPreReqCategory
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->amOnPage("admin/admin/auth/logout/"); // stepKey: amOnLogoutPage
		$I->deleteEntity("createPreReqCategory", "hook"); // stepKey: deletePreReqCategory
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
	 * @Stories({"Create a Simple Product via Admin"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateSimpleProductNotVisibleIndividuallyTest(AcceptanceTester $I)
	{
		$I->comment("Create Simple Product Not Visible Individually");
		$I->comment("Entering Action Group [fillProductFieldsInAdmin] FillAdminSimpleProductFormActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: navigateToProductIndexFillProductFieldsInAdmin
		$I->click(".action-toggle.primary.add"); // stepKey: clickAddProductDropdownFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: clickAddProductDropdownFillProductFieldsInAdminWaitForPageLoad
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-simple']"); // stepKey: clickAddSimpleProductFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: clickAddSimpleProductFillProductFieldsInAdminWaitForPageLoad
		$I->fillField(".admin__field[data-index=name] input", "TestSimpleProduct" . msq("simpleProductNotVisibleIndividually")); // stepKey: fillNameFillProductFieldsInAdmin
		$I->fillField(".admin__field[data-index=sku] input", "test_simple_product_sku" . msq("simpleProductNotVisibleIndividually")); // stepKey: fillSKUFillProductFieldsInAdmin
		$I->fillField(".admin__field[data-index=price] input", "325.00"); // stepKey: fillPriceFillProductFieldsInAdmin
		$I->fillField(".admin__field[data-index=qty] input", "123"); // stepKey: fillQuantityFillProductFieldsInAdmin
		$I->selectOption("//select[@name='product[visibility]']", "Not Visible Individually"); // stepKey: fillVisibilityFillProductFieldsInAdmin
		$I->searchAndMultiSelectOption("div[data-index='category_ids']", [$I->retrieveEntityField('createPreReqCategory', 'name', 'test')]); // stepKey: searchAndSelectCategoryFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: searchAndSelectCategoryFillProductFieldsInAdminWaitForPageLoad
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: openSeoSectionFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: openSeoSectionFillProductFieldsInAdminWaitForPageLoad
		$I->fillField("input[name='product[url_key]']", "test-simple-product" . msq("simpleProductNotVisibleIndividually")); // stepKey: fillUrlKeyFillProductFieldsInAdmin
		$I->click("#save-button"); // stepKey: saveProductFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: saveProductFillProductFieldsInAdminWaitForPageLoad
		$I->seeElement(".message.message-success.success"); // stepKey: assertSaveMessageSuccessFillProductFieldsInAdmin
		$I->seeInField(".admin__field[data-index=name] input", "TestSimpleProduct" . msq("simpleProductNotVisibleIndividually")); // stepKey: assertFieldNameFillProductFieldsInAdmin
		$I->seeInField(".admin__field[data-index=sku] input", "test_simple_product_sku" . msq("simpleProductNotVisibleIndividually")); // stepKey: assertFieldSkuFillProductFieldsInAdmin
		$I->seeInField(".admin__field[data-index=price] input", "325.00"); // stepKey: assertFieldPriceFillProductFieldsInAdmin
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: openSeoSectionAssertFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: openSeoSectionAssertFillProductFieldsInAdminWaitForPageLoad
		$I->seeInField("input[name='product[url_key]']", "test-simple-product" . msq("simpleProductNotVisibleIndividually")); // stepKey: assertFieldUrlKeyFillProductFieldsInAdmin
		$I->comment("Exiting Action Group [fillProductFieldsInAdmin] FillAdminSimpleProductFormActionGroup");
		$I->comment("Search and verify AssertUrlRewriteNotInGrid");
		$I->comment("Entering Action Group [searchUrlRewriteForNotVisibleProductInGrid] AdminSearchDeletedUrlRewriteActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/url_rewrite/index/"); // stepKey: openUrlRewriteEditPageSearchUrlRewriteForNotVisibleProductInGrid
		$I->waitForPageLoad(30); // stepKey: waitForUrlRewriteEditPageToLoadSearchUrlRewriteForNotVisibleProductInGrid
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersSearchUrlRewriteForNotVisibleProductInGrid
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersSearchUrlRewriteForNotVisibleProductInGridWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoadSearchUrlRewriteForNotVisibleProductInGrid
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openUrlRewriteGridFiltersSearchUrlRewriteForNotVisibleProductInGrid
		$I->waitForPageLoad(30); // stepKey: openUrlRewriteGridFiltersSearchUrlRewriteForNotVisibleProductInGridWaitForPageLoad
		$I->fillField(".admin__data-grid-filters input[name='request_path']", "test-simple-product" . msq("simpleProductNotVisibleIndividually") . ".html"); // stepKey: fillRedirectPathFilterSearchUrlRewriteForNotVisibleProductInGrid
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickOrderApplyFiltersSearchUrlRewriteForNotVisibleProductInGrid
		$I->waitForPageLoad(30); // stepKey: clickOrderApplyFiltersSearchUrlRewriteForNotVisibleProductInGridWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoad1SearchUrlRewriteForNotVisibleProductInGrid
		$I->see("We couldn't find any records.", ".data-grid-tr-no-data td"); // stepKey: seeEmptyRecordMessageSearchUrlRewriteForNotVisibleProductInGrid
		$I->comment("Exiting Action Group [searchUrlRewriteForNotVisibleProductInGrid] AdminSearchDeletedUrlRewriteActionGroup");
		$I->comment("Verify AssertPageByUrlRewriteIsNotFound");
		$I->comment("Entering Action Group [amOnPage] AssertPageByUrlRewriteIsNotFoundActionGroup");
		$I->amOnPage("test-simple-product" . msq("simpleProductNotVisibleIndividually") . ".html"); // stepKey: amOnPageAmOnPage
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadAmOnPage
		$I->see("Whoops, our bad..."); // stepKey: seeWhoopsAmOnPage
		$I->comment("Exiting Action Group [amOnPage] AssertPageByUrlRewriteIsNotFoundActionGroup");
	}
}
