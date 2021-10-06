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
 * @Title("MC-13749: Check Price for Configurable Product when One Child is Disabled, Others are Enabled")
 * @Description("Login as admin and check the configurable product price when one child product is disabled<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminCheckConfigurableProductPriceWithDisabledChildProductTest.xml<br>")
 * @TestCaseId("MC-13749")
 * @group mtf_migrated
 */
class AdminCheckConfigurableProductPriceWithDisabledChildProductTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Login as Admin");
		$I->comment("Entering Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginToAdminPanel
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginToAdminPanel
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginToAdminPanel
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginToAdminPanel
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginToAdminPanelWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginToAdminPanel
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginToAdminPanel
		$I->comment("Exiting Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->comment("Create Default Category");
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->comment("Create an attribute with three options to be used in the first child product");
		$I->createEntity("createConfigProductAttribute", "hook", "productAttributeWithTwoOptions", [], []); // stepKey: createConfigProductAttribute
		$I->createEntity("createConfigProductAttributeOption1", "hook", "productAttributeOption1", ["createConfigProductAttribute"], []); // stepKey: createConfigProductAttributeOption1
		$I->createEntity("createConfigProductAttributeOption2", "hook", "productAttributeOption2", ["createConfigProductAttribute"], []); // stepKey: createConfigProductAttributeOption2
		$I->createEntity("createConfigProductAttributeOption3", "hook", "productAttributeOption3", ["createConfigProductAttribute"], []); // stepKey: createConfigProductAttributeOption3
		$I->comment("Add the attribute just created to default attribute set");
		$I->createEntity("createConfigAddToAttributeSet", "hook", "AddToDefaultSet", ["createConfigProductAttribute"], []); // stepKey: createConfigAddToAttributeSet
		$I->comment("Get the first option of the attribute created");
		$I->getEntity("getConfigAttributeOption1", "hook", "ProductAttributeOptionGetter", ["createConfigProductAttribute"], null, 1); // stepKey: getConfigAttributeOption1
		$I->comment("Get the second option of the attribute created");
		$I->getEntity("getConfigAttributeOption2", "hook", "ProductAttributeOptionGetter", ["createConfigProductAttribute"], null, 2); // stepKey: getConfigAttributeOption2
		$I->comment("Get the third option of the attribute created");
		$I->getEntity("getConfigAttributeOption3", "hook", "ProductAttributeOptionGetter", ["createConfigProductAttribute"], null, 3); // stepKey: getConfigAttributeOption3
		$I->comment("Create Configurable product");
		$I->createEntity("createConfigProduct", "hook", "BaseConfigurableProduct", ["createCategory"], []); // stepKey: createConfigProduct
		$I->comment("Create a simple product and give it the attribute with the first option");
		$createConfigChildProduct1Fields['price'] = "10.00";
		$I->createEntity("createConfigChildProduct1", "hook", "ApiSimpleOne", ["createConfigProductAttribute", "getConfigAttributeOption1"], $createConfigChildProduct1Fields); // stepKey: createConfigChildProduct1
		$I->comment("Create a simple product and give it the attribute with the second option");
		$createConfigChildProduct2Fields['price'] = "20.00";
		$I->createEntity("createConfigChildProduct2", "hook", "ApiSimpleTwo", ["createConfigProductAttribute", "getConfigAttributeOption2"], $createConfigChildProduct2Fields); // stepKey: createConfigChildProduct2
		$I->comment("Create a simple product and give it the attribute with the Third option");
		$createConfigChildProduct3Fields['price'] = "30.00";
		$I->createEntity("createConfigChildProduct3", "hook", "ApiSimpleTwo", ["createConfigProductAttribute", "getConfigAttributeOption3"], $createConfigChildProduct3Fields); // stepKey: createConfigChildProduct3
		$I->comment("Create the configurable product");
		$I->createEntity("createConfigProductOption", "hook", "ConfigurableProductThreeOptions", ["createConfigProduct", "createConfigProductAttribute", "getConfigAttributeOption1", "getConfigAttributeOption2", "getConfigAttributeOption3"], []); // stepKey: createConfigProductOption
		$I->comment("Add the first simple product to the configurable product");
		$I->createEntity("createConfigProductAddChild1", "hook", "ConfigurableProductAddChild", ["createConfigProduct", "createConfigChildProduct1"], []); // stepKey: createConfigProductAddChild1
		$I->comment("Add the second simple product to the configurable product");
		$I->createEntity("createConfigProductAddChild2", "hook", "ConfigurableProductAddChild", ["createConfigProduct", "createConfigChildProduct2"], []); // stepKey: createConfigProductAddChild2
		$I->comment("Add the third simple product to the configurable product");
		$I->createEntity("createConfigProductAddChild3", "hook", "ConfigurableProductAddChild", ["createConfigProduct", "createConfigChildProduct3"], []); // stepKey: createConfigProductAddChild3
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Delete Created Data");
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("createConfigProduct", "hook"); // stepKey: deleteConfigProduct
		$I->deleteEntity("createConfigChildProduct1", "hook"); // stepKey: deleteConfigChildProduct1
		$I->deleteEntity("createConfigChildProduct2", "hook"); // stepKey: deleteConfigChildProduct2
		$I->deleteEntity("createConfigChildProduct3", "hook"); // stepKey: deleteConfigChildProduct3
		$I->deleteEntity("createConfigProductAttribute", "hook"); // stepKey: deleteAttribute
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
	 * @Stories({"Configurable Product"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCheckConfigurableProductPriceWithDisabledChildProductTest(AcceptanceTester $I)
	{
		$I->comment("Open Product in Store Front Page");
		$I->amOnPage($I->retrieveEntityField('createConfigProduct', 'sku', 'test') . ".html"); // stepKey: openProductInStoreFront
		$I->waitForPageLoad(30); // stepKey: waitForProductToLoad
		$I->comment("Verify category,Configurable product and initial price");
		$I->seeElement("//nav//a[span[contains(., '" . $I->retrieveEntityField('createCategory', 'name', 'test') . "')]]"); // stepKey: seeCategoryInFrontPage
		$I->waitForPageLoad(30); // stepKey: seeCategoryInFrontPageWaitForPageLoad
		$I->see($I->retrieveEntityField('createConfigProduct', 'name', 'test'), ".base"); // stepKey: seeProductNameInStoreFront
		$I->see($I->retrieveEntityField('createConfigChildProduct1', 'price', 'test'), "div.price-box.price-final_price"); // stepKey: seeInitialPriceInStoreFront
		$I->comment("Entering Action Group [seeProductSkuInStoreFront] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see($I->retrieveEntityField('createConfigProduct', 'sku', 'test'), ".product.attribute.sku>.value"); // stepKey: seeProductSkuSeeProductSkuInStoreFront
		$I->comment("Exiting Action Group [seeProductSkuInStoreFront] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("In Stock", ".stock[title=Availability]>span"); // stepKey: seeProductStatusInStoreFront
		$I->comment("Verify First Child Product attribute option is displayed");
		$I->see($I->retrieveEntityField('getConfigAttributeOption1', 'label', 'test'), "//*[@id='product-options-wrapper']//div[@class='fieldset']//label[contains(.,'" . $I->retrieveEntityField('createConfigProductAttribute', 'default_value', 'test') . "')]/../div[@class='control']//select"); // stepKey: seeOption1
		$I->comment("Select product Attribute option1, option2 and option3 and verify changes in the price");
		$I->selectOption("//*[@id='product-options-wrapper']//div[@class='fieldset']//label[contains(.,'" . $I->retrieveEntityField('createConfigProductAttribute', 'default_value', 'test') . "')]/../div[@class='control']//select", $I->retrieveEntityField('getConfigAttributeOption1', 'label', 'test')); // stepKey: selectOption1
		$I->see($I->retrieveEntityField('createConfigChildProduct1', 'price', 'test'), "div.price-box.price-final_price"); // stepKey: seeChildProduct1PriceInStoreFront
		$I->selectOption("//*[@id='product-options-wrapper']//div[@class='fieldset']//label[contains(.,'" . $I->retrieveEntityField('createConfigProductAttribute', 'default_value', 'test') . "')]/../div[@class='control']//select", $I->retrieveEntityField('getConfigAttributeOption2', 'label', 'test')); // stepKey: selectOption2
		$I->see($I->retrieveEntityField('createConfigChildProduct2', 'price', 'test'), "div.price-box.price-final_price"); // stepKey: seeChildProduct2PriceInStoreFront
		$I->selectOption("//*[@id='product-options-wrapper']//div[@class='fieldset']//label[contains(.,'" . $I->retrieveEntityField('createConfigProductAttribute', 'default_value', 'test') . "')]/../div[@class='control']//select", $I->retrieveEntityField('getConfigAttributeOption3', 'label', 'test')); // stepKey: selectOption3
		$I->see($I->retrieveEntityField('createConfigChildProduct3', 'price', 'test'), "div.price-box.price-final_price"); // stepKey: seeChildProduct3PriceInStoreFront
		$I->comment("Open Product Index Page and Filter First Child product");
		$I->comment("Entering Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageNavigateToProductIndex
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadNavigateToProductIndex
		$I->comment("Exiting Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->comment("Entering Action Group [filterProduct] FilterProductGridBySkuActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersFilterProduct
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersFilterProductWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openProductFiltersFilterProduct
		$I->fillField("input.admin__control-text[name='sku']", "api-simple-product" . msq("ApiSimpleOne")); // stepKey: fillProductSkuFilterFilterProduct
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickApplyFiltersFilterProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersFilterProductWaitForPageLoad
		$I->waitForElementNotVisible(".admin__data-grid-loading-mask[data-component*='product_listing']", 30); // stepKey: waitForFilteredGridLoadFilterProduct
		$I->comment("Exiting Action Group [filterProduct] FilterProductGridBySkuActionGroup");
		$I->click(".data-row:nth-of-type(1)"); // stepKey: selectFirstRow
		$I->waitForPageLoad(30); // stepKey: selectFirstRowWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductPageToLoad
		$I->comment("Disable the product");
		$I->click("input[name='product[status]']+label"); // stepKey: disableProduct
		$I->comment("Entering Action Group [clickOnSaveButton] AdminProductFormSaveActionGroup");
		$I->click("#save-button"); // stepKey: saveProductClickOnSaveButton
		$I->waitForPageLoad(30); // stepKey: saveProductClickOnSaveButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavingClickOnSaveButton
		$I->comment("Exiting Action Group [clickOnSaveButton] AdminProductFormSaveActionGroup");
		$I->see("You saved the product.", ".message-success"); // stepKey: messageYouSavedTheProductIsShown
		$I->comment("Open Product Store Front Page");
		$I->amOnPage($I->retrieveEntityField('createConfigProduct', 'sku', 'test') . ".html"); // stepKey: openProductInStoreFront1
		$I->waitForPageLoad(30); // stepKey: waitForProductToLoad1
		$I->comment("Verify category,configurable product and updated price");
		$I->seeElement("//nav//a[span[contains(., '" . $I->retrieveEntityField('createCategory', 'name', 'test') . "')]]"); // stepKey: seeCategoryInFrontPage1
		$I->waitForPageLoad(30); // stepKey: seeCategoryInFrontPage1WaitForPageLoad
		$I->see($I->retrieveEntityField('createConfigProduct', 'name', 'test'), ".base"); // stepKey: seeProductNameInStoreFront1
		$I->see($I->retrieveEntityField('createConfigChildProduct2', 'price', 'test'), "div.price-box.price-final_price"); // stepKey: seeUpdatedProductPriceInStoreFront
		$I->comment("Entering Action Group [seeProductSkuInStoreFront1] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see($I->retrieveEntityField('createConfigProduct', 'sku', 'test'), ".product.attribute.sku>.value"); // stepKey: seeProductSkuSeeProductSkuInStoreFront1
		$I->comment("Exiting Action Group [seeProductSkuInStoreFront1] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("In Stock", ".stock[title=Availability]>span"); // stepKey: seeProductStatusInStoreFront1
		$I->comment("Verify product Attribute Option1 is not displayed");
		$I->dontSee($I->retrieveEntityField('getConfigAttributeOption1', 'label', 'test'), "//*[@id='product-options-wrapper']//div[@class='fieldset']//label[contains(.,'" . $I->retrieveEntityField('createConfigProductAttribute', 'default_value', 'test') . "')]/../div[@class='control']//select"); // stepKey: dontSeeOption1
		$I->comment("Select product Attribute option2 and option3 and verify changes in the price");
		$I->selectOption("//*[@id='product-options-wrapper']//div[@class='fieldset']//label[contains(.,'" . $I->retrieveEntityField('createConfigProductAttribute', 'default_value', 'test') . "')]/../div[@class='control']//select", $I->retrieveEntityField('getConfigAttributeOption2', 'label', 'test')); // stepKey: selectTheOption2
		$I->see($I->retrieveEntityField('createConfigChildProduct2', 'price', 'test'), "div.price-box.price-final_price"); // stepKey: seeSecondChildProductPriceInStoreFront
		$I->selectOption("//*[@id='product-options-wrapper']//div[@class='fieldset']//label[contains(.,'" . $I->retrieveEntityField('createConfigProductAttribute', 'default_value', 'test') . "')]/../div[@class='control']//select", $I->retrieveEntityField('getConfigAttributeOption3', 'label', 'test')); // stepKey: selectTheOption3
		$I->see($I->retrieveEntityField('createConfigChildProduct3', 'price', 'test'), "div.price-box.price-final_price"); // stepKey: seeThirdProductPriceInStoreFront
	}
}
