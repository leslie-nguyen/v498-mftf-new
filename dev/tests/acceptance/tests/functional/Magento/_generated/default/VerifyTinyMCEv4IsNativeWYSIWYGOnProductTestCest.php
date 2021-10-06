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
 * @group Catalog
 * @Title("MAGETWO-81819: Admin should see TinyMCEv4.6 is the native WYSIWYG on Product Page")
 * @Description("Admin should see TinyMCEv4.6 is the native WYSIWYG on Product Page<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\VerifyTinyMCEv4IsNativeWYSIWYGOnProductTest.xml<br>")
 * @TestCaseId("MAGETWO-81819")
 */
class VerifyTinyMCEv4IsNativeWYSIWYGOnProductTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [loginGetFromGeneralFile] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginGetFromGeneralFile
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginGetFromGeneralFile
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginGetFromGeneralFile
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginGetFromGeneralFile
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginGetFromGeneralFileWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginGetFromGeneralFile
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginGetFromGeneralFile
		$I->comment("Exiting Action Group [loginGetFromGeneralFile] AdminLoginActionGroup");
		$I->comment("Entering Action Group [enableWYSIWYG] EnabledWYSIWYGActionGroup");
		$enableWYSIWYGEnableWYSIWYG = $I->magentoCLI("config:set cms/wysiwyg/enabled enabled", 60); // stepKey: enableWYSIWYGEnableWYSIWYG
		$I->comment($enableWYSIWYGEnableWYSIWYG);
		$I->comment("Exiting Action Group [enableWYSIWYG] EnabledWYSIWYGActionGroup");
		$I->comment("Entering Action Group [switchToTinyMCE4] SwitchToVersion4ActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_config/edit/section/cms/"); // stepKey: navigateToWYSIWYGConfigPage1SwitchToTinyMCE4
		$I->waitForPageLoad(30); // stepKey: waitForConfigPageToLoadSwitchToTinyMCE4
		$I->conditionalClick("#cms_wysiwyg-head", "#cms_wysiwyg-head:not(.open)", true); // stepKey: expandWYSIWYGOptionsSwitchToTinyMCE4
		$I->waitForElementVisible("#cms_wysiwyg_editor_inherit", 30); // stepKey: waitForCheckboxSwitchToTinyMCE4
		$I->waitForPageLoad(60); // stepKey: waitForCheckboxSwitchToTinyMCE4WaitForPageLoad
		$I->uncheckOption("#cms_wysiwyg_editor_inherit"); // stepKey: uncheckUseSystemValueSwitchToTinyMCE4
		$I->waitForPageLoad(60); // stepKey: uncheckUseSystemValueSwitchToTinyMCE4WaitForPageLoad
		$I->waitForElementVisible("#cms_wysiwyg_editor", 30); // stepKey: waitForSwitcherDropdownSwitchToTinyMCE4
		$I->selectOption("#cms_wysiwyg_editor", "TinyMCE 4"); // stepKey: switchToVersion4SwitchToTinyMCE4
		$I->click("#cms_wysiwyg-head"); // stepKey: collapseWYSIWYGOptionsSwitchToTinyMCE4
		$I->waitForPageLoad(60); // stepKey: collapseWYSIWYGOptionsSwitchToTinyMCE4WaitForPageLoad
		$I->click("#save"); // stepKey: clickSaveConfigSwitchToTinyMCE4
		$I->waitForPageLoad(30); // stepKey: clickSaveConfigSwitchToTinyMCE4WaitForPageLoad
		$I->comment("Exiting Action Group [switchToTinyMCE4] SwitchToVersion4ActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [disableWYSIWYG] DisabledWYSIWYGActionGroup");
		$disableWYSIWYGDisableWYSIWYG = $I->magentoCLI("config:set cms/wysiwyg/enabled disabled", 60); // stepKey: disableWYSIWYGDisableWYSIWYG
		$I->comment($disableWYSIWYGDisableWYSIWYG);
		$I->comment("Exiting Action Group [disableWYSIWYG] DisabledWYSIWYGActionGroup");
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
	 * @Features({"Catalog"})
	 * @Stories({"MAGETWO-72114-TinyMCE v4.6 as a native WYSIWYG editor"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function VerifyTinyMCEv4IsNativeWYSIWYGOnProductTest(AcceptanceTester $I)
	{
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/simple/"); // stepKey: navigateToNewProduct
		$I->waitForPageLoad(30); // stepKey: wait1
		$I->fillField(".admin__field[data-index=name] input", "testProductName" . msq("_defaultProduct")); // stepKey: fillName
		$I->fillField(".admin__field[data-index=price] input", "123.00"); // stepKey: fillPrice
		$I->fillField(".admin__field[data-index=sku] input", "testSku" . msq("_defaultProduct")); // stepKey: fillSKU
		$I->fillField(".admin__field[data-index=qty] input", "100"); // stepKey: fillQuantity
		$I->scrollTo(".admin__field[data-index=qty] input"); // stepKey: scrollToQty
		$I->click("//strong[contains(@class, 'admin__collapsible-title')]/span[text()='Content']"); // stepKey: clickContentTab
		$I->waitForElementVisible("div#editorproduct_form_description .mce-branding", 30); // stepKey: waitForDescription
		$I->seeElement("div#editorproduct_form_description .mce-branding"); // stepKey: TinyMCE4Description
		$I->click("#editorproduct_form_description .mce-edit-area"); // stepKey: focusProductDescriptionWysiwyg
		$executeJSFillContent1 = $I->executeJS("tinyMCE.get('product_form_description').setContent('Hello World!');"); // stepKey: executeJSFillContent1
		$I->waitForElementVisible("//div[@id='editorproduct_form_short_description']//*[contains(@class,'mce-branding')]", 30); // stepKey: waitForShortDescription
		$I->seeElement("//div[@id='editorproduct_form_short_description']//*[contains(@class,'mce-branding')]"); // stepKey: TinyMCE4ShortDescription
		$I->click("#editorproduct_form_short_description .mce-edit-area"); // stepKey: focusProductShortDescriptionWysiwyg
		$executeJSFillContent2 = $I->executeJS("tinyMCE.get('product_form_short_description').setContent('Hello World! Short Content');"); // stepKey: executeJSFillContent2
		$I->scrollTo("#toggleproduct_form_description", 0, -150); // stepKey: scrollToDesShowHideBtn1
		$I->click("#toggleproduct_form_description"); // stepKey: clickShowHideBtn1
		$I->waitForElementVisible("#buttonsproduct_form_description > .scalable.action-add-image.plugin", 30); // stepKey: waitForInsertImage1
		$I->see("Insert Image...", "#buttonsproduct_form_description > .scalable.action-add-image.plugin"); // stepKey: seeInsertImage1
		$I->dontSee(".action-add-widget"); // stepKey: insertWidget1
		$I->dontSee(".scalable.add-variable.plugin"); // stepKey: insertVariable1
		$I->scrollTo("#toggleproduct_form_short_description", 0, -150); // stepKey: scrollToDesShowHideBtn2
		$I->click("#toggleproduct_form_short_description"); // stepKey: clickShowHideBtn2
		$I->waitForElementVisible("#buttonsproduct_form_short_description > .scalable.action-add-image.plugin", 30); // stepKey: waitForInsertImage2
		$I->see("Insert Image...", "#buttonsproduct_form_short_description > .scalable.action-add-image.plugin"); // stepKey: seeInsertImage2
		$I->dontSee(".action-add-widget"); // stepKey: insertWidget2
		$I->dontSee(".scalable.add-variable.plugin"); // stepKey: insertVariable2
		$I->comment("Entering Action Group [saveProduct] AdminProductFormSaveActionGroup");
		$I->click("#save-button"); // stepKey: saveProductSaveProduct
		$I->waitForPageLoad(30); // stepKey: saveProductSaveProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavingSaveProduct
		$I->comment("Exiting Action Group [saveProduct] AdminProductFormSaveActionGroup");
		$I->comment("Go to storefront product page, assert product content");
		$I->amOnPage("testProductName" . msq("_defaultProduct") . ".html"); // stepKey: navigateToProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2
		$I->scrollTo(".stock.available"); // stepKey: scrollToStock
		$I->see("Hello World!", "#description .value"); // stepKey: assertProductDescription
		$I->see("Hello World! Short Content", "//div[@class='product attribute overview']//div[@class='value']"); // stepKey: assertProductShortDescription
	}
}
