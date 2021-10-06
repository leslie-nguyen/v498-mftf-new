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
 * @Title("MC-61: customer should see the configurable product in the category list")
 * @Description("customer should see the configurable product in the category list<h3>Test files</h3>vendor\magento\module-configurable-product\Test\Mftf\Test\StorefrontConfigurableProductViewTest\StorefrontConfigurableProductListViewTest.xml<br>")
 * @TestCaseId("MC-61")
 * @group ConfigurableProduct
 */
class StorefrontConfigurableProductListViewTestCest
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
		$I->comment("Entering Action Group [loginAsAdmin1] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin1
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin1
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin1
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin1
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdmin1WaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin1
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin1
		$I->comment("Exiting Action Group [loginAsAdmin1] AdminLoginActionGroup");
		$I->comment("Create a configurable product via the UI");
		$I->comment("Entering Action Group [createProduct] CreateConfigurableProductActionGroup");
		$I->comment("fill in basic configurable product values");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: amOnProductGridPageCreateProduct
		$I->waitForPageLoad(30); // stepKey: wait1CreateProduct
		$I->click(".action-toggle.primary.add"); // stepKey: clickOnAddProductToggleCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnAddProductToggleCreateProductWaitForPageLoad
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-configurable']"); // stepKey: clickOnAddConfigurableProductCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnAddConfigurableProductCreateProductWaitForPageLoad
		$I->fillField(".admin__field[data-index=name] input", "testProductName" . msq("_defaultProduct")); // stepKey: fillNameCreateProduct
		$I->fillField(".admin__field[data-index=sku] input", "testSku" . msq("_defaultProduct")); // stepKey: fillSKUCreateProduct
		$I->fillField(".admin__field[data-index=price] input", "123.00"); // stepKey: fillPriceCreateProduct
		$I->fillField(".admin__field[data-index=qty] input", "100"); // stepKey: fillQuantityCreateProduct
		$I->searchAndMultiSelectOption("div[data-index='category_ids']", [$I->retrieveEntityField('createCategory', 'name', 'hook')]); // stepKey: fillCategoryCreateProduct
		$I->waitForPageLoad(30); // stepKey: fillCategoryCreateProductWaitForPageLoad
		$I->selectOption("//select[@name='product[visibility]']", "4"); // stepKey: fillVisibilityCreateProduct
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: openSeoSectionCreateProduct
		$I->waitForPageLoad(30); // stepKey: openSeoSectionCreateProductWaitForPageLoad
		$I->fillField("input[name='product[url_key]']", "testurlkey" . msq("_defaultProduct")); // stepKey: fillUrlKeyCreateProduct
		$I->comment("create configurations for colors the product is available in");
		$I->click("button[data-index='create_configurable_products_button']"); // stepKey: clickOnCreateConfigurationsCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnCreateConfigurationsCreateProductWaitForPageLoad
		$I->click(".select-attributes-actions button[title='Create New Attribute']"); // stepKey: clickOnNewAttributeCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNewAttributeCreateProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForIFrameCreateProduct
		$I->switchToIFrame("create_new_attribute_container"); // stepKey: switchToNewAttributeIFrameCreateProduct
		$I->fillField("input[name='frontend_label[0]']", "Color" . msq("colorProductAttribute")); // stepKey: fillDefaultLabelCreateProduct
		$I->click("#save"); // stepKey: clickOnNewAttributePanelCreateProduct
		$I->waitForPageLoad(30); // stepKey: waitForSaveAttributeCreateProduct
		$I->switchToIFrame(); // stepKey: switchOutOfIFrameCreateProduct
		$I->waitForPageLoad(30); // stepKey: waitForFiltersCreateProduct
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: clickOnFiltersCreateProduct
		$I->fillField(".admin__control-text[name='attribute_code']", "Color" . msq("colorProductAttribute")); // stepKey: fillFilterAttributeCodeFieldCreateProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersButtonCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersButtonCreateProductWaitForPageLoad
		$I->click("tr[data-repeat-index='0'] .admin__control-checkbox"); // stepKey: clickOnFirstCheckboxCreateProduct
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton1CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton1CreateProductWaitForPageLoad
		$I->waitForElementVisible(".action-create-new", 30); // stepKey: waitCreateNewValueAppearsCreateProduct
		$I->waitForPageLoad(30); // stepKey: waitCreateNewValueAppearsCreateProductWaitForPageLoad
		$I->click(".action-create-new"); // stepKey: clickOnCreateNewValue1CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnCreateNewValue1CreateProductWaitForPageLoad
		$I->fillField("li[data-attribute-option-title=''] .admin__field-create-new .admin__control-text", "White" . msq("colorProductAttribute1")); // stepKey: fillFieldForNewAttribute1CreateProduct
		$I->click("li[data-attribute-option-title=''] .action-save"); // stepKey: clickOnSaveNewAttribute1CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnSaveNewAttribute1CreateProductWaitForPageLoad
		$I->click(".action-create-new"); // stepKey: clickOnCreateNewValue2CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnCreateNewValue2CreateProductWaitForPageLoad
		$I->fillField("li[data-attribute-option-title=''] .admin__field-create-new .admin__control-text", "Red" . msq("colorProductAttribute2")); // stepKey: fillFieldForNewAttribute2CreateProduct
		$I->click("li[data-attribute-option-title=''] .action-save"); // stepKey: clickOnSaveNewAttribute2CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnSaveNewAttribute2CreateProductWaitForPageLoad
		$I->click(".action-create-new"); // stepKey: clickOnCreateNewValue3CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnCreateNewValue3CreateProductWaitForPageLoad
		$I->fillField("li[data-attribute-option-title=''] .admin__field-create-new .admin__control-text", "Blue" . msq("colorProductAttribute3")); // stepKey: fillFieldForNewAttribute3CreateProduct
		$I->click("li[data-attribute-option-title=''] .action-save"); // stepKey: clickOnSaveNewAttribute3CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnSaveNewAttribute3CreateProductWaitForPageLoad
		$I->click(".action-select-all"); // stepKey: clickOnSelectAllCreateProduct
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton2CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton2CreateProductWaitForPageLoad
		$I->click(".admin__field-label[for='apply-unique-prices-radio']"); // stepKey: clickOnApplyUniquePricesByAttributeToEachSkuCreateProduct
		$I->selectOption("#select-each-price", "Color" . msq("colorProductAttribute")); // stepKey: selectAttributesCreateProduct
		$I->waitForPageLoad(30); // stepKey: selectAttributesCreateProductWaitForPageLoad
		$I->fillField("#apply-single-price-input-0", "1.00"); // stepKey: fillAttributePrice1CreateProduct
		$I->fillField("#apply-single-price-input-1", "2.00"); // stepKey: fillAttributePrice2CreateProduct
		$I->fillField("#apply-single-price-input-2", "3.00"); // stepKey: fillAttributePrice3CreateProduct
		$I->click(".admin__field-label[for='apply-single-inventory-radio']"); // stepKey: clickOnApplySingleQuantityToEachSkuCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnApplySingleQuantityToEachSkuCreateProductWaitForPageLoad
		$I->fillField("#apply-single-inventory-input", "1"); // stepKey: enterAttributeQuantityCreateProduct
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton3CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton3CreateProductWaitForPageLoad
		$I->click(".steps-wizard-navigation .action-next-step"); // stepKey: clickOnNextButton4CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnNextButton4CreateProductWaitForPageLoad
		$I->click("#save-button"); // stepKey: clickOnSaveButton2CreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnSaveButton2CreateProductWaitForPageLoad
		$I->click("button[data-index='confirm_button']"); // stepKey: clickOnConfirmInPopupCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickOnConfirmInPopupCreateProductWaitForPageLoad
		$I->seeElement(".message.message-success.success"); // stepKey: seeSaveProductMessageCreateProduct
		$I->seeInTitle("testProductName" . msq("_defaultProduct")); // stepKey: seeProductNameInTitleCreateProduct
		$I->comment("Exiting Action Group [createProduct] CreateConfigurableProductActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
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
	 * @Features({"ConfigurableProduct"})
	 * @Stories({"View configurable product in a category in storefront"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontConfigurableProductListViewTest(AcceptanceTester $I)
	{
		$I->comment("Verify storefront category list view");
		$I->amOnPage("/" . $I->retrieveEntityField('createCategory', 'name', 'test') . ".html"); // stepKey: amOnCategoryPage1
		$I->waitForPageLoad(30); // stepKey: wait1
		$I->click("#mode-list"); // stepKey: clickListView
		$I->waitForPageLoad(30); // stepKey: wait2
		$I->seeElement("img.product-image-photo"); // stepKey: seePhoto
		$I->see("testProductName" . msq("_defaultProduct"), "a.product-item-link"); // stepKey: seeName
		$I->waitForPageLoad(30); // stepKey: seeNameWaitForPageLoad
		$I->seeElement("a.product-item-link[href$='testurlkey" . msq("_defaultProduct") . ".html']"); // stepKey: seeNameLink
		$I->see("1.00", ".price-final_price"); // stepKey: seePrice
	}
}
