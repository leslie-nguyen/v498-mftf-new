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
 * @Title("MC-216: Admin should be able to delete a bundle product")
 * @Description("Admin should be able to delete a bundle product<h3>Test files</h3>vendor\magento\module-bundle\Test\Mftf\Test\AdminDeleteABundleProductTest.xml<br>")
 * @TestCaseId("MC-216")
 * @group Bundle
 */
class AdminDeleteABundleProductTestCest
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
	 * @Stories({"Admin list bundle products"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminDeleteABundleProductTest(AcceptanceTester $I)
	{
		$I->comment("Create bundle product");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/bundle/"); // stepKey: goToBundleProductCreationPage
		$I->waitForPageLoad(30); // stepKey: waitForBundleProductCreationPage
		$I->conditionalClick("//span[text()='Bundle Items']", "//span[text()='Bundle Items']", false); // stepKey: conditionallyOpenSectionBundleItems
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
		$I->comment("Fill out ancillary data on bundle product");
		$I->comment("Entering Action Group [createBundledProductForTwoSimpleProducts] AncillaryPrepBundleProductActionGroup");
		$I->comment("PreReq: go to bundle product creation page");
		$I->fillField("//*[@name='product[name]']", "BundleProduct" . msq("BundleProduct")); // stepKey: fillProductNameCreateBundledProductForTwoSimpleProducts
		$I->fillField("//*[@name='product[sku]']", "bundleproduct" . msq("BundleProduct")); // stepKey: fillProductSkuCreateBundledProductForTwoSimpleProducts
		$I->comment("Trigger SEO drop down");
		$I->scrollTo("//div[@data-index='search-engine-optimization']"); // stepKey: moveToSEOSectionCreateBundledProductForTwoSimpleProducts
		$I->conditionalClick("//div[@data-index='search-engine-optimization']", "//input[@name='product[url_key]']", false); // stepKey: openDropDownIfClosedCreateBundledProductForTwoSimpleProducts
		$I->waitForPageLoad(30); // stepKey: openDropDownIfClosedCreateBundledProductForTwoSimpleProductsWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: WaitForDropDownSEOCreateBundledProductForTwoSimpleProducts
		$I->comment("Fill URL input");
		$I->fillField("//input[@name='product[url_key]']", "bundleproduct" . msq("BundleProduct")); // stepKey: FillsinSEOlinkExtensionCreateBundledProductForTwoSimpleProducts
		$I->waitForPageLoad(30); // stepKey: FillsinSEOlinkExtensionCreateBundledProductForTwoSimpleProductsWaitForPageLoad
		$I->comment("Exiting Action Group [createBundledProductForTwoSimpleProducts] AncillaryPrepBundleProductActionGroup");
		$I->comment("Save the product");
		$I->comment("Entering Action Group [clickSaveButton] AdminProductFormSaveActionGroup");
		$I->click("#save-button"); // stepKey: saveProductClickSaveButton
		$I->waitForPageLoad(30); // stepKey: saveProductClickSaveButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavingClickSaveButton
		$I->comment("Exiting Action Group [clickSaveButton] AdminProductFormSaveActionGroup");
		$I->seeElement(".message-success"); // stepKey: messageYouSavedTheProductIsShown
		$I->comment("Go to catalog deletion page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/"); // stepKey: goToCatalogPage
		$I->waitForPageLoad(30); // stepKey: Loading
		$I->comment("Apply Name Filter");
		$I->comment("Entering Action Group [filterBundleProductOptionsDownToName] FilterProductGridByNameActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersFilterBundleProductOptionsDownToName
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersFilterBundleProductOptionsDownToNameWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersFilterBundleProductOptionsDownToName
		$I->fillField("input.admin__control-text[name='name']", "BundleProduct" . msq("BundleProduct")); // stepKey: fillProductNameFilterFilterBundleProductOptionsDownToName
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersFilterBundleProductOptionsDownToName
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersFilterBundleProductOptionsDownToNameWaitForPageLoad
		$I->waitForElementNotVisible(".admin__data-grid-loading-mask[data-component*='product_listing']", 30); // stepKey: waitForFilteredGridLoadFilterBundleProductOptionsDownToName
		$I->comment("Exiting Action Group [filterBundleProductOptionsDownToName] FilterProductGridByNameActionGroup");
		$I->click("//div[@data-role='grid-wrapper']//label[@data-bind='attr: {for: ko.uid}']"); // stepKey: SelectAllOnly1
		$I->waitForPageLoad(30); // stepKey: SelectAllOnly1WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: loading2
		$I->comment("Delete");
		$I->click("//div[@class='action-select-wrap']/button"); // stepKey: ClickOnActionsChangingView
		$I->waitForPageLoad(30); // stepKey: ClickOnActionsChangingViewWaitForPageLoad
		$I->click("//div[@class='action-menu-items']//li[1]"); // stepKey: ClickDelete
		$I->waitForPageLoad(30); // stepKey: ClickDeleteWaitForPageLoad
		$I->click("//button[@class='action-primary action-accept']"); // stepKey: ConfirmDelete
		$I->waitForPageLoad(30); // stepKey: loading3
		$I->comment("Locating delete message");
		$I->seeElement(".message-success"); // stepKey: deleteMessage
		$I->comment("Testing deletion of product");
		$I->amOnPage("bundleproduct" . msq("BundleProduct") . ".html"); // stepKey: GoToProductPageAgain
		$I->waitForPageLoad(30); // stepKey: WaitForProductPageToLoadToShowElement
		$I->dontSeeElement("//*[@id='maincontent']//span[@itemprop='name']"); // stepKey: LookingForNameOfProductTwo
	}
}
