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
 * @Title("MAGETWO-92229: You should have a dynamic length validation hint when using text option has max char limit")
 * @Description("You should have a dynamic length validation hint when using text option has max char limit<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\ConfigurableOptionTextInputLengthValidationHintTest.xml<br>")
 * @TestCaseId("MAGETWO-92229")
 * @group product
 */
class ConfigurableOptionTextinputLengthValidationHintTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
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
	 * @Stories({"Customizable text option input-length validation hint changes dynamically"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function ConfigurableOptionTextinputLengthValidationHintTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [loginAsAdmin1] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin1
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin1
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin1
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin1
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdmin1WaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin1
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin1
		$I->comment("Exiting Action Group [loginAsAdmin1] AdminLoginActionGroup");
		$I->comment("Entering Action Group [fillProductFieldsInAdmin] AdminCreateSimpleProductWithTextOptionCharLimitActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: navigateToProductIndexFillProductFieldsInAdmin
		$I->click(".action-toggle.primary.add"); // stepKey: clickAddProductDropdownFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: clickAddProductDropdownFillProductFieldsInAdminWaitForPageLoad
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-simple']"); // stepKey: clickAddSimpleProductFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: clickAddSimpleProductFillProductFieldsInAdminWaitForPageLoad
		$I->fillField(".admin__field[data-index=name] input", "testProductName" . msq("_defaultProduct")); // stepKey: fillNameFillProductFieldsInAdmin
		$I->fillField(".admin__field[data-index=sku] input", "testSku" . msq("_defaultProduct")); // stepKey: fillSKUFillProductFieldsInAdmin
		$I->fillField(".admin__field[data-index=price] input", "123.00"); // stepKey: fillPriceFillProductFieldsInAdmin
		$I->fillField(".admin__field[data-index=qty] input", "100"); // stepKey: fillQuantityFillProductFieldsInAdmin
		$I->searchAndMultiSelectOption("div[data-index='category_ids']", [$I->retrieveEntityField('createPreReqCategory', 'name', 'test')]); // stepKey: searchAndSelectCategoryFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: searchAndSelectCategoryFillProductFieldsInAdminWaitForPageLoad
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: openSeoSectionFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: openSeoSectionFillProductFieldsInAdminWaitForPageLoad
		$I->fillField("input[name='product[url_key]']", "testurlkey" . msq("_defaultProduct")); // stepKey: fillUrlKeyFillProductFieldsInAdmin
		$I->click("//strong[contains(@class, 'admin__collapsible-title')]/span[text()='Customizable Options']"); // stepKey: openCustomOptionsSectionFillProductFieldsInAdmin
		$I->click("button[data-index='button_add']"); // stepKey: clickAddOptionFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: clickAddOptionFillProductFieldsInAdminWaitForPageLoad
		$I->fillField("input[name='product[options][0][title]']", "option1"); // stepKey: fillOptionTitleFillProductFieldsInAdmin
		$I->click(".admin__dynamic-rows[data-index='options'] .action-select"); // stepKey: openTypeDropDownFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: openTypeDropDownFillProductFieldsInAdminWaitForPageLoad
		$I->click(".admin__dynamic-rows[data-index='options'] .action-menu._active li li"); // stepKey: selectTypeTextFieldFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: selectTypeTextFieldFillProductFieldsInAdminWaitForPageLoad
		$I->fillField("input[name='product[options][0][max_characters]']", "20"); // stepKey: fillMaxCharsFillProductFieldsInAdmin
		$I->click("#save-button"); // stepKey: saveProductFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: saveProductFillProductFieldsInAdminWaitForPageLoad
		$I->seeElement(".message.message-success.success"); // stepKey: assertSaveMessageSuccessFillProductFieldsInAdmin
		$I->seeInField(".admin__field[data-index=name] input", "testProductName" . msq("_defaultProduct")); // stepKey: assertFieldNameFillProductFieldsInAdmin
		$I->seeInField(".admin__field[data-index=sku] input", "testSku" . msq("_defaultProduct")); // stepKey: assertFieldSkuFillProductFieldsInAdmin
		$I->seeInField(".admin__field[data-index=price] input", "123.00"); // stepKey: assertFieldPriceFillProductFieldsInAdmin
		$I->click("div[data-index='search-engine-optimization']"); // stepKey: openSeoSectionAssertFillProductFieldsInAdmin
		$I->waitForPageLoad(30); // stepKey: openSeoSectionAssertFillProductFieldsInAdminWaitForPageLoad
		$I->seeInField("input[name='product[url_key]']", "testurlkey" . msq("_defaultProduct")); // stepKey: assertFieldUrlKeyFillProductFieldsInAdmin
		$I->comment("Exiting Action Group [fillProductFieldsInAdmin] AdminCreateSimpleProductWithTextOptionCharLimitActionGroup");
		$I->comment("Entering Action Group [assertProductInStorefront1] AssertProductInStorefrontCategoryPage");
		$I->comment("Go to storefront category page, assert product visibility");
		$I->amOnPage("/" . $I->retrieveEntityField('createPreReqCategory', 'name', 'test') . ".html"); // stepKey: navigateToCategoryPageAssertProductInStorefront1
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1AssertProductInStorefront1
		$I->see("testProductName" . msq("_defaultProduct")); // stepKey: assertProductPresentAssertProductInStorefront1
		$I->see("123.00"); // stepKey: assertProductPricePresentAssertProductInStorefront1
		$I->comment("Exiting Action Group [assertProductInStorefront1] AssertProductInStorefrontCategoryPage");
		$I->comment("Entering Action Group [assertProductInStorefront2] AssertProductInStorefrontProductPageActionGroup");
		$I->comment("Go to storefront product page, assert product name, sku and price");
		$I->amOnPage("testurlkey" . msq("_defaultProduct") . ".html"); // stepKey: navigateToProductPageAssertProductInStorefront2
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2AssertProductInStorefront2
		$I->seeInTitle("testProductName" . msq("_defaultProduct")); // stepKey: assertProductNameTitleAssertProductInStorefront2
		$I->see("testProductName" . msq("_defaultProduct"), ".base"); // stepKey: assertProductNameAssertProductInStorefront2
		$I->see("123.00", "div.price-box.price-final_price"); // stepKey: assertProductPriceAssertProductInStorefront2
		$I->see("testSku" . msq("_defaultProduct"), ".product.attribute.sku>.value"); // stepKey: assertProductSkuAssertProductInStorefront2
		$I->comment("Exiting Action Group [assertProductInStorefront2] AssertProductInStorefrontProductPageActionGroup");
		$I->comment("Entering Action Group [testDynamicValidationHint1] TestDynamicValidationHintActionGroup");
		$I->fillField(".input-text.product-custom-option", "abcde"); // stepKey: textInput1TestDynamicValidationHint1
		$I->see("(15 remaining)", ".character-counter"); // stepKey: assertHint1TestDynamicValidationHint1
		$I->fillField(".input-text.product-custom-option", "abcdefghjklansdmnbv"); // stepKey: textInput2TestDynamicValidationHint1
		$I->see("(1 remaining)", ".character-counter"); // stepKey: assertHint2TestDynamicValidationHint1
		$I->fillField(".input-text.product-custom-option", "abcdefghjklansdmnbvd"); // stepKey: textInput3TestDynamicValidationHint1
		$I->see("(0 remaining)", ".character-counter"); // stepKey: assertHint3TestDynamicValidationHint1
		$I->fillField(".input-text.product-custom-option", "abcdefghjklansdmnbvds"); // stepKey: textInput4TestDynamicValidationHint1
		$I->see("(1 too many)", ".character-counter"); // stepKey: assertHint4TestDynamicValidationHint1
		$I->fillField(".input-text.product-custom-option", "abcdefghjklansdmnbvdsasdfghjmn"); // stepKey: textInput5TestDynamicValidationHint1
		$I->see("(10 too many)", ".character-counter"); // stepKey: assertHint5TestDynamicValidationHint1
		$I->comment("Exiting Action Group [testDynamicValidationHint1] TestDynamicValidationHintActionGroup");
	}
}
