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
 * @Title("MC-3082: Customers can filter products using visual swatches")
 * @Description("Customers can filter products using visual swatches<h3>Test files</h3>vendor\magento\module-swatches\Test\Mftf\Test\StorefrontFilterByVisualSwatchTest.xml<br>")
 * @TestCaseId("MC-3082")
 * @group Swatches
 */
class StorefrontFilterByVisualSwatchTestCest
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
		$I->createEntity("createCategory", "hook", "ApiCategory", [], []); // stepKey: createCategory
		$I->createEntity("createSimpleProduct", "hook", "ApiSimpleProduct", ["createCategory"], []); // stepKey: createSimpleProduct
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteSimpleProduct
		$I->comment("Entering Action Group [adminLogout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAdminLogout
		$I->comment("Exiting Action Group [adminLogout] AdminLogoutActionGroup");
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
	 * @Features({"Swatches"})
	 * @Stories({"View swatches in product listing"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontFilterByVisualSwatchTest(AcceptanceTester $I)
	{
		$I->comment("Begin creating a new product attribute");
		$I->comment("Entering Action Group [goToNewProductAttributePage] AdminNavigateToNewProductAttributePageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product_attribute/new/"); // stepKey: goToNewProductAttributePageGoToNewProductAttributePage
		$I->waitForPageLoad(30); // stepKey: waitForAttributePageLoadGoToNewProductAttributePage
		$I->comment("Exiting Action Group [goToNewProductAttributePage] AdminNavigateToNewProductAttributePageActionGroup");
		$I->fillField("#attribute_label", "attribute" . msq("ProductAttributeFrontendLabel")); // stepKey: fillDefaultLabel
		$I->comment("Select visual swatch");
		$I->selectOption("#frontend_input", "swatch_visual"); // stepKey: selectInputType
		$I->comment("Set swatch #1 using the color picker");
		$I->click("#add_new_swatch_visual_option_button"); // stepKey: clickAddSwatch1
		$I->waitForPageLoad(30); // stepKey: clickAddSwatch1WaitForPageLoad
		$I->comment("Entering Action Group [clickSwatch1] OpenSwatchMenuByIndexActionGroup");
		$I->comment("I had to use executeJS to perform the click to get around the use of CSS ::before and ::after");
		$clickSwatch1ClickSwatch1 = $I->executeJS("jQuery('#swatch_window_option_option_0').click()"); // stepKey: clickSwatch1ClickSwatch1
		$I->comment("Exiting Action Group [clickSwatch1] OpenSwatchMenuByIndexActionGroup");
		$I->click("#swatch-visual-options-panel table tbody tr:nth-of-type(1) .swatch_row_name.colorpicker_handler"); // stepKey: clickChooseColor1
		$I->comment("Entering Action Group [fillHex1] SetColorPickerByHexActionGroup");
		$I->comment("This 6x backspace stuff is some magic that is necessary to interact with this field correctly");
		$I->pressKey("//div[@class='colorpicker'][1]/div[@class='colorpicker_hex']/input", \Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,'e74c3c'); // stepKey: fillHex1FillHex1
		$I->click("//div[@class='colorpicker'][1]/div[@class='colorpicker_submit']"); // stepKey: submitColor1FillHex1
		$I->comment("Exiting Action Group [fillHex1] SetColorPickerByHexActionGroup");
		$I->fillField("optionvisual[value][option_0][0]", "red"); // stepKey: fillAdmin1
		$I->comment("Set swatch #2 using the color picker");
		$I->click("#add_new_swatch_visual_option_button"); // stepKey: clickAddSwatch2
		$I->waitForPageLoad(30); // stepKey: clickAddSwatch2WaitForPageLoad
		$I->comment("Entering Action Group [clickSwatch2] OpenSwatchMenuByIndexActionGroup");
		$I->comment("I had to use executeJS to perform the click to get around the use of CSS ::before and ::after");
		$clickSwatch1ClickSwatch2 = $I->executeJS("jQuery('#swatch_window_option_option_1').click()"); // stepKey: clickSwatch1ClickSwatch2
		$I->comment("Exiting Action Group [clickSwatch2] OpenSwatchMenuByIndexActionGroup");
		$I->click("#swatch-visual-options-panel table tbody tr:nth-of-type(2) .swatch_row_name.colorpicker_handler"); // stepKey: clickChooseColor2
		$I->comment("Entering Action Group [fillHex2] SetColorPickerByHexActionGroup");
		$I->comment("This 6x backspace stuff is some magic that is necessary to interact with this field correctly");
		$I->pressKey("//div[@class='colorpicker'][2]/div[@class='colorpicker_hex']/input", \Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,\Facebook\WebDriver\WebDriverKeys::BACKSPACE,'3498db'); // stepKey: fillHex1FillHex2
		$I->click("//div[@class='colorpicker'][2]/div[@class='colorpicker_submit']"); // stepKey: submitColor1FillHex2
		$I->comment("Exiting Action Group [fillHex2] SetColorPickerByHexActionGroup");
		$I->fillField("optionvisual[value][option_1][0]", "blue"); // stepKey: fillAdmin2
		$I->comment("Set scope to global");
		$I->click("#advanced_fieldset-wrapper"); // stepKey: expandAdvancedProperties
		$I->selectOption("#is_global", "1"); // stepKey: selectGlobalScope
		$I->comment("Set Use In Layered Navigation");
		$I->scrollToTopOfPage(); // stepKey: scrollToTop1
		$I->click("#product_attribute_tabs_front"); // stepKey: goToStorefrontProperties
		$I->selectOption("#is_filterable", "1"); // stepKey: selectUseInLayeredNavigation
		$I->comment("Save the new attribute");
		$I->click("#save_and_edit_button"); // stepKey: clickSaveAndEdit1
		$I->waitForPageLoad(30); // stepKey: clickSaveAndEdit1WaitForPageLoad
		$I->waitForElementVisible(".message.message-success.success", 30); // stepKey: waitForSuccess
		$I->comment("Create a configurable product to verify the storefront with");
		$I->comment("Entering Action Group [amOnProductGridPage] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageAmOnProductGridPage
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadAmOnProductGridPage
		$I->comment("Exiting Action Group [amOnProductGridPage] AdminOpenProductIndexPageActionGroup");
		$I->comment("Entering Action Group [goToCreateConfigurableProduct] GoToCreateProductPageActionGroup");
		$I->click(".action-toggle.primary.add"); // stepKey: clickAddProductToggleGoToCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: clickAddProductToggleGoToCreateConfigurableProductWaitForPageLoad
		$I->waitForElementVisible(".item[data-ui-id='products-list-add-new-product-button-item-configurable']", 30); // stepKey: waitForAddProductDropdownGoToCreateConfigurableProduct
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-configurable']"); // stepKey: clickAddProductTypeGoToCreateConfigurableProduct
		$I->waitForPageLoad(30); // stepKey: waitForCreateProductPageLoadGoToCreateConfigurableProduct
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/configurable/"); // stepKey: seeNewProductUrlGoToCreateConfigurableProduct
		$I->see("New Product", ".page-header h1.page-title"); // stepKey: seeNewProductTitleGoToCreateConfigurableProduct
		$I->comment("Exiting Action Group [goToCreateConfigurableProduct] GoToCreateProductPageActionGroup");
		$I->comment("Entering Action Group [fillProductForm] FillMainProductFormActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfPageFillProductForm
		$I->fillField(".admin__field[data-index=name] input", "configurable" . msq("BaseConfigurableProduct")); // stepKey: fillProductNameFillProductForm
		$I->fillField(".admin__field[data-index=sku] input", "configurable" . msq("BaseConfigurableProduct")); // stepKey: fillProductSkuFillProductForm
		$I->fillField(".admin__field[data-index=price] input", "123.00"); // stepKey: fillProductPriceFillProductForm
		$I->fillField(".admin__field[data-index=qty] input", "100"); // stepKey: fillProductQtyFillProductForm
		$I->selectOption("select[name='product[quantity_and_stock_status][is_in_stock]']", "1"); // stepKey: selectStockStatusFillProductForm
		$I->waitForPageLoad(30); // stepKey: selectStockStatusFillProductFormWaitForPageLoad
		$I->selectOption("select[name='product[product_has_weight]']", "This item has weight"); // stepKey: selectWeightFillProductForm
		$I->fillField(".admin__field[data-index=weight] input", "2"); // stepKey: fillProductWeightFillProductForm
		$I->comment("Exiting Action Group [fillProductForm] FillMainProductFormActionGroup");
		$I->searchAndMultiSelectOption("div[data-index='category_ids']", [$I->retrieveEntityField('createCategory', 'name', 'test')]); // stepKey: fillCategory
		$I->waitForPageLoad(30); // stepKey: fillCategoryWaitForPageLoad
		$I->comment("Create configurations based off the visual watch we created earlier");
		$I->comment("Entering Action Group [createConfigurations] CreateConfigurationsForAttributeActionGroup");
		$I->click("button[data-index='create_configurable_products_button']"); // stepKey: clickCreateConfigurationsCreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickCreateConfigurationsCreateConfigurationsWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: clickFiltersCreateConfigurations
		$I->fillField(".admin__control-text[name='attribute_code']", "attribute" . msq("ProductAttributeFrontendLabel")); // stepKey: fillFilterAttributeCodeFieldCreateConfigurations
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersButtonCreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersButtonCreateConfigurationsWaitForPageLoad
		$I->click("tr[data-repeat-index='0'] .admin__control-checkbox"); // stepKey: clickOnFirstCheckboxCreateConfigurations
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton1CreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton1CreateConfigurationsWaitForPageLoad
		$I->click(".action-select-all"); // stepKey: clickOnSelectAllCreateConfigurations
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton2CreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton2CreateConfigurationsWaitForPageLoad
		$I->click(".admin__field-label[for='apply-single-inventory-radio']"); // stepKey: clickOnApplySingleQuantityToEachSkuCreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickOnApplySingleQuantityToEachSkuCreateConfigurationsWaitForPageLoad
		$I->fillField("#apply-single-inventory-input", "99"); // stepKey: enterAttributeQuantityCreateConfigurations
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton3CreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton3CreateConfigurationsWaitForPageLoad
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton4CreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton4CreateConfigurationsWaitForPageLoad
		$I->click("#save-button"); // stepKey: clickOnSaveButton2CreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickOnSaveButton2CreateConfigurationsWaitForPageLoad
		$I->click("button[data-index='confirm_button']"); // stepKey: clickOnConfirmInPopupCreateConfigurations
		$I->waitForPageLoad(30); // stepKey: clickOnConfirmInPopupCreateConfigurationsWaitForPageLoad
		$I->comment("Exiting Action Group [createConfigurations] CreateConfigurationsForAttributeActionGroup");
		$I->comment("Run re-index task");
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Go to the category page");
		$I->amOnPage($I->retrieveEntityField('createCategory', 'name', 'test') . ".html"); // stepKey: amOnCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPage
		$I->comment("Verify swatches are present in the layered navigation");
		$I->see("attribute" . msq("ProductAttributeFrontendLabel"), "#layered-filter-block"); // stepKey: seeAttributeInLayeredNav
		$I->click("//div[@class='filter-options-title'][text() = 'attribute" . msq("ProductAttributeFrontendLabel") . "']"); // stepKey: expandAttribute
		$I->waitForPageLoad(30); // stepKey: expandAttributeWaitForPageLoad
		$grabSwatch1 = $I->grabAttributeFrom("div.attribute" . msq("ProductAttributeFrontendLabel") . " a:nth-of-type(1) div", "style"); // stepKey: grabSwatch1
		$I->waitForPageLoad(30); // stepKey: grabSwatch1WaitForPageLoad
		$grabSwatch2 = $I->grabAttributeFrom("div.attribute" . msq("ProductAttributeFrontendLabel") . " a:nth-of-type(2) div", "style"); // stepKey: grabSwatch2
		$I->waitForPageLoad(30); // stepKey: grabSwatch2WaitForPageLoad
		$I->assertStringContainsString("rgb(231, 77, 60)", $grabSwatch1); // stepKey: assertSwatch1
		$I->assertStringContainsString("rgb(52, 152, 219)", $grabSwatch2); // stepKey: assertSwatch2
		$I->comment("Click a swatch and expect to see the configurable product, not see the simple product");
		$I->click("div.attribute" . msq("ProductAttributeFrontendLabel") . " a:nth-of-type(1) div"); // stepKey: filterBySwatch1
		$I->waitForPageLoad(30); // stepKey: filterBySwatch1WaitForPageLoad
		$I->see("configurable" . msq("BaseConfigurableProduct"), ".product-item-info"); // stepKey: seeConfigurableProduct
		$I->dontSee($I->retrieveEntityField('createSimpleProduct', 'name', 'test'), ".product-item-info"); // stepKey: dontSeeSimpleProduct
	}
}
