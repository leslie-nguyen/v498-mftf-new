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
 * @Title("MC-230: Customer should be able to see basic bundle product details")
 * @Description("Customer should be able to see basic bundle product details<h3>Test files</h3>vendor\magento\module-bundle\Test\Mftf\Test\StorefrontBundleProductDetailsTest.xml<br>")
 * @TestCaseId("MC-230")
 * @group Bundle
 */
class StorefrontBundleProductDetailsTestCest
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
		$I->comment("Creating Data");
		$I->createEntity("createPreReqCategory", "hook", "_defaultCategory", [], []); // stepKey: createPreReqCategory
		$I->createEntity("simpleProduct1", "hook", "SimpleProduct2", [], []); // stepKey: simpleProduct1
		$I->createEntity("simpleProduct2", "hook", "SimpleProduct2", [], []); // stepKey: simpleProduct2
		$runCronIndex = $I->magentoCron("index", 90); // stepKey: runCronIndex
		$I->comment($runCronIndex);
		$I->comment("Admin Login");
		$I->comment("Entering Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginToAdminPanel
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginToAdminPanel
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginToAdminPanel
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginToAdminPanel
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginToAdminPanelWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginToAdminPanel
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginToAdminPanel
		$I->comment("Exiting Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->comment("Entering Action Group [disableWYSIWYG] DisabledWYSIWYGActionGroup");
		$disableWYSIWYGDisableWYSIWYG = $I->magentoCLI("config:set cms/wysiwyg/enabled disabled", 60); // stepKey: disableWYSIWYGDisableWYSIWYG
		$I->comment($disableWYSIWYGDisableWYSIWYG);
		$I->comment("Exiting Action Group [disableWYSIWYG] DisabledWYSIWYGActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createPreReqCategory", "hook"); // stepKey: deletePreReqCategory
		$I->deleteEntity("simpleProduct1", "hook"); // stepKey: deleteSimpleProduct1
		$I->deleteEntity("simpleProduct2", "hook"); // stepKey: deleteSimpleProduct2
		$I->comment("Entering Action Group [navigateToProductIndexPage] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageNavigateToProductIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadNavigateToProductIndexPage
		$I->comment("Exiting Action Group [navigateToProductIndexPage] AdminOpenProductIndexPageActionGroup");
		$I->comment("Entering Action Group [deleteAllProducts] DeleteProductsIfTheyExistActionGroup");
		$I->conditionalClick("div[data-role='grid-wrapper'] th.data-grid-multicheck-cell button.action-multicheck-toggle", "table.data-grid tr.data-row:first-of-type", true); // stepKey: openMulticheckDropdownDeleteAllProducts
		$I->conditionalClick("//div[@data-role='grid-wrapper']//th[contains(@class, data-grid-multicheck-cell)]//li//span[text() = 'Select All']", "table.data-grid tr.data-row:first-of-type", true); // stepKey: selectAllProductInFilteredGridDeleteAllProducts
		$I->click("div.admin__data-grid-header-row.row div.action-select-wrap button.action-select"); // stepKey: clickActionDropdownDeleteAllProducts
		$I->click("//div[contains(@class,'admin__data-grid-header-row') and contains(@class, 'row')]//div[contains(@class, 'action-select-wrap')]//ul/li/span[text() = 'Delete']"); // stepKey: clickDeleteActionDeleteAllProducts
		$I->waitForElementVisible(".modal-popup.confirm button.action-accept", 30); // stepKey: waitForModalPopUpDeleteAllProducts
		$I->waitForPageLoad(60); // stepKey: waitForModalPopUpDeleteAllProductsWaitForPageLoad
		$I->click(".modal-popup.confirm button.action-accept"); // stepKey: confirmProductDeleteDeleteAllProducts
		$I->waitForPageLoad(60); // stepKey: confirmProductDeleteDeleteAllProductsWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForGridLoadDeleteAllProducts
		$I->comment("Exiting Action Group [deleteAllProducts] DeleteProductsIfTheyExistActionGroup");
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
	 * @Features({"Bundle"})
	 * @Stories({"Bundle product details page"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontBundleProductDetailsTest(AcceptanceTester $I)
	{
		$I->comment("go to bundle product creation page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/bundle/"); // stepKey: goToBundleProductCreationPage
		$I->waitForPageLoad(30); // stepKey: waitForBundleProductCreatePageToLoad
		$I->comment("Add description");
		$I->click("div[data-index='content']"); // stepKey: openDescriptionDropDown
		$I->waitForPageLoad(30); // stepKey: openDescriptionDropDownWaitForPageLoad
		$I->scrollTo("div[data-index='content']"); // stepKey: scrollToError
		$I->waitForPageLoad(30); // stepKey: scrollToErrorWaitForPageLoad
		$I->fillField("#product_form_description", "This is the long description"); // stepKey: fillLongDescription
		$I->fillField("#product_form_short_description", "This is the short description"); // stepKey: fillShortDescription
		$I->comment("Add options");
		$I->conditionalClick("//span[text()='Bundle Items']", "//span[text()='Bundle Items']", false); // stepKey: conditionallyOpenSectionBundleItems
		$I->click("button[data-index='add_button']"); // stepKey: clickAddOption
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
		$I->comment("Create a basic bundle product");
		$I->comment("Entering Action Group [createBundledProductForTwoSimpleProducts] CreateBasicBundleProductActionGroup");
		$I->comment("PreReq: Go to bundle product creation page");
		$I->comment("Product name and SKU");
		$I->fillField("//*[@name='product[name]']", "BundleProduct" . msq("BundleProduct")); // stepKey: fillProductNameCreateBundledProductForTwoSimpleProducts
		$I->fillField("//*[@name='product[sku]']", "bundleproduct" . msq("BundleProduct")); // stepKey: fillProductSkuCreateBundledProductForTwoSimpleProducts
		$I->comment("Trigger SEO drop down");
		$I->scrollTo("//div[@data-index='search-engine-optimization']"); // stepKey: scrollToSeoDropDownCreateBundledProductForTwoSimpleProducts
		$I->conditionalClick("//div[@data-index='search-engine-optimization']", "//input[@name='product[url_key]']", false); // stepKey: openDropDownIfClosedCreateBundledProductForTwoSimpleProducts
		$I->waitForPageLoad(30); // stepKey: openDropDownIfClosedCreateBundledProductForTwoSimpleProductsWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForDropDownSEOCreateBundledProductForTwoSimpleProducts
		$I->comment("Fill URL input");
		$I->fillField("//input[@name='product[url_key]']", "bundleproduct" . msq("BundleProduct")); // stepKey: fillsInSeoLinkExtensionCreateBundledProductForTwoSimpleProducts
		$I->waitForPageLoad(30); // stepKey: fillsInSeoLinkExtensionCreateBundledProductForTwoSimpleProductsWaitForPageLoad
		$I->comment("Exiting Action Group [createBundledProductForTwoSimpleProducts] CreateBasicBundleProductActionGroup");
		$I->comment("save the product");
		$I->comment("Entering Action Group [clickSaveButtonAgain] AdminProductFormSaveActionGroup");
		$I->click("#save-button"); // stepKey: saveProductClickSaveButtonAgain
		$I->waitForPageLoad(30); // stepKey: saveProductClickSaveButtonAgainWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavingClickSaveButtonAgain
		$I->comment("Exiting Action Group [clickSaveButtonAgain] AdminProductFormSaveActionGroup");
		$I->see("You saved the product."); // stepKey: messageYouSavedTheProductIsShownAgain
		$I->comment("Checking details");
		$I->amOnPage("bundleproduct" . msq("BundleProduct") . ".html"); // stepKey: goToProductPage
		$I->waitForPageLoad(30); // stepKey: waitForProductPageToLoad
		$I->see("This is the short description", "div.product.attribute.overview"); // stepKey: seeShortDescription
		$I->waitForPageLoad(30); // stepKey: seeShortDescriptionWaitForPageLoad
		$I->see("This is the long description", "#description>div>div"); // stepKey: seeLongDescription
		$I->waitForPageLoad(30); // stepKey: seeLongDescriptionWaitForPageLoad
		$I->click("//*[@id='bundle-slide']/span"); // stepKey: clickOnCustomizationOption
		$I->waitForPageLoad(30); // stepKey: clickOnCustomizationOptionWaitForPageLoad
		$I->see("10 x " . $I->retrieveEntityField('simpleProduct1', 'name', 'test'), "//div[@class='nested options-list']/div[1]/label[@class='label']"); // stepKey: seeOption1
		$I->see("10 x " . $I->retrieveEntityField('simpleProduct2', 'name', 'test'), "//div[@class='nested options-list']/div[2]/label[@class='label']"); // stepKey: seeOption2
	}
}
