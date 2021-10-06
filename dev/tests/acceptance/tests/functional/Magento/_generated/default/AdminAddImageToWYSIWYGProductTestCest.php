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
 * @Title("MAGETWO-84375: Admin should be able to add image to WYSIWYG Editor on Product Page")
 * @Description("Admin should be able to add image to WYSIWYG Editor on Product Page<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminAddImageToWYSIWYGProductTest.xml<br>")
 * @TestCaseId("MAGETWO-84375")
 */
class AdminAddImageToWYSIWYGProductTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [login] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLogin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLogin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLogin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLogin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLogin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLogin
		$I->comment("Exiting Action Group [login] AdminLoginActionGroup");
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
	 * @Stories({"MAGETWO-42041-Default WYSIWYG toolbar configuration with Magento Media Gallery"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAddImageToWYSIWYGProductTest(AcceptanceTester $I)
	{
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/simple/"); // stepKey: navigateToNewProduct
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadProductCreatePage
		$I->comment("Entering Action Group [fillBasicProductInfo] FillMainProductFormActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfPageFillBasicProductInfo
		$I->fillField(".admin__field[data-index=name] input", "testProductName" . msq("_defaultProduct")); // stepKey: fillProductNameFillBasicProductInfo
		$I->fillField(".admin__field[data-index=sku] input", "testSku" . msq("_defaultProduct")); // stepKey: fillProductSkuFillBasicProductInfo
		$I->fillField(".admin__field[data-index=price] input", "123.00"); // stepKey: fillProductPriceFillBasicProductInfo
		$I->fillField(".admin__field[data-index=qty] input", "100"); // stepKey: fillProductQtyFillBasicProductInfo
		$I->selectOption("select[name='product[quantity_and_stock_status][is_in_stock]']", "1"); // stepKey: selectStockStatusFillBasicProductInfo
		$I->waitForPageLoad(30); // stepKey: selectStockStatusFillBasicProductInfoWaitForPageLoad
		$I->selectOption("select[name='product[product_has_weight]']", "This item has weight"); // stepKey: selectWeightFillBasicProductInfo
		$I->fillField(".admin__field[data-index=weight] input", "1"); // stepKey: fillProductWeightFillBasicProductInfo
		$I->comment("Exiting Action Group [fillBasicProductInfo] FillMainProductFormActionGroup");
		$I->click("//strong[contains(@class, 'admin__collapsible-title')]/span[text()='Content']"); // stepKey: clickContentTab
		$I->scrollTo("#toggleproduct_form_description", 0, -150); // stepKey: scrollToDescription
		$I->waitForElementVisible("div#editorproduct_form_description .mce-branding", 30); // stepKey: waitForDescription
		$I->click("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-image']"); // stepKey: clickInsertImageIcon1
		$I->waitForPageLoad(30); // stepKey: clickInsertImageIcon1WaitForPageLoad
		$I->click(".mce-i-browse"); // stepKey: clickBrowse1
		$I->waitForPageLoad(30); // stepKey: clickBrowse1WaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForBrowseModal
		$I->see("Cancel", ".page-actions #cancel"); // stepKey: seeCancelBtn1
		$I->see("Create Folder", "#new_folder"); // stepKey: seeCreateFolderBtn1
		$I->waitForPageLoad(30); // stepKey: seeCreateFolderBtn1WaitForPageLoad
		$I->dontSeeElement("#insert_files"); // stepKey: dontSeeAddSelectedBtn1
		$I->waitForPageLoad(30); // stepKey: dontSeeAddSelectedBtn1WaitForPageLoad
		$I->click("#new_folder"); // stepKey: createFolder1
		$I->waitForPageLoad(30); // stepKey: createFolder1WaitForPageLoad
		$I->waitForElement("input[data-role='promptField']", 30); // stepKey: waitForPopUp1
		$I->fillField("input[data-role='promptField']", "Test" . msq("ImageFolder")); // stepKey: fillFolderName1
		$I->click(".action-primary.action-accept"); // stepKey: acceptFolderName11
		$I->waitForPageLoad(30); // stepKey: acceptFolderName11WaitForPageLoad
		$I->conditionalClick("#root > .jstree-icon", "//li[@id='root' and contains(@class,'jstree-closed')]", true); // stepKey: clickStorageRootArrowIfClosed
		$I->conditionalClick("#d3lzaXd5Zw-- > .jstree-icon", "//li[@id='d3lzaXd5Zw--' and contains(@class,'jstree-closed')]", true); // stepKey: clickWysiwygArrowIfClosed
		$I->waitForText("Test" . msq("ImageFolder"), 30); // stepKey: waitForNewFolder1
		$I->click("Test" . msq("ImageFolder")); // stepKey: clickOnCreatedFolder1
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading4
		$I->attachFile(".fileupload", "magento2.jpg"); // stepKey: uploadImage1
		$I->waitForPageLoad(30); // stepKey: uploadImage1WaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForFileUpload1
		$I->waitForElementVisible("//small[text()='magento2.jpg']", 30); // stepKey: waitForUploadImage1
		$I->seeElement("//small[text()='magento2.jpg']/parent::*[@class='filecnt selected']"); // stepKey: seeImageSelected1
		$I->see("Delete Selected", "#delete_files"); // stepKey: seeDeleteBtn1
		$I->waitForPageLoad(30); // stepKey: seeDeleteBtn1WaitForPageLoad
		$I->click("#delete_files"); // stepKey: clickDeleteSelected1
		$I->waitForPageLoad(30); // stepKey: clickDeleteSelected1WaitForPageLoad
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitForConfirmDelete1
		$I->waitForPageLoad(60); // stepKey: waitForConfirmDelete1WaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmDelete1
		$I->waitForPageLoad(60); // stepKey: confirmDelete1WaitForPageLoad
		$I->waitForElementNotVisible("//small[text()='magento2.jpg']", 30); // stepKey: waitForImageDeleted1
		$I->dontSeeElement("//small[text()='magento2.jpg']"); // stepKey: dontSeeImage1
		$I->dontSeeElement("#insert_files"); // stepKey: dontSeeAddSelectedBtn2
		$I->waitForPageLoad(30); // stepKey: dontSeeAddSelectedBtn2WaitForPageLoad
		$I->attachFile(".fileupload", "magento2.jpg"); // stepKey: uploadImage2
		$I->waitForPageLoad(30); // stepKey: uploadImage2WaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForFileUpload2
		$I->waitForElementVisible("//small[text()='magento2.jpg']", 30); // stepKey: waitForUploadImage2
		$I->click("#insert_files"); // stepKey: clickInsertBtn1
		$I->waitForPageLoad(30); // stepKey: clickInsertBtn1WaitForPageLoad
		$I->waitForElementVisible(".mce-textbox.mce-abs-layout-item.mce-last", 30); // stepKey: waitForImageDescriptionButton1
		$I->fillField(".mce-textbox.mce-abs-layout-item.mce-last", "Image content. Yeah."); // stepKey: fillImageDescription1
		$I->fillField(".mce-textbox.mce-abs-layout-item.mce-first", "1000"); // stepKey: fillImageHeight1
		$I->click("//button//span[text()='Ok']"); // stepKey: clickOkBtn1
		$I->scrollTo("#toggleproduct_form_short_description", 0, -150); // stepKey: scrollToTinyMCE4
		$I->click("//div[@id='editorproduct_form_short_description']//i[@class='mce-ico mce-i-image']"); // stepKey: clickInsertImageIcon2
		$I->waitForPageLoad(30); // stepKey: clickInsertImageIcon2WaitForPageLoad
		$I->click(".mce-i-browse"); // stepKey: clickBrowse2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading13
		$I->waitForElementVisible(".page-actions #cancel", 30); // stepKey: waitForCancelButton2
		$I->see("Cancel", "#cancel"); // stepKey: seeCancelBtn2
		$I->waitForElementVisible("#new_folder", 30); // stepKey: waitForCreateFolderBtn2
		$I->waitForPageLoad(30); // stepKey: waitForCreateFolderBtn2WaitForPageLoad
		$I->see("Create Folder", "#new_folder"); // stepKey: seeCreateFolderBtn2
		$I->see("Storage Root", "div[data-role='tree']"); // stepKey: seeFolderContainer
		$I->click("Storage Root"); // stepKey: clickOnRootFolder
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading15
		$I->dontSeeElement("#insert_files"); // stepKey: dontSeeAddSelectedBtn3
		$I->attachFile(".fileupload", "magento3.jpg"); // stepKey: uploadImage3
		$I->waitForPageLoad(30); // stepKey: uploadImage3WaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForFileUpload3
		$I->waitForElementVisible("//small[text()='magento3.jpg']", 30); // stepKey: waitForUploadImage3
		$I->waitForElement("#delete_files", 30); // stepKey: waitForDeletebtn
		$I->waitForPageLoad(30); // stepKey: waitForDeletebtnWaitForPageLoad
		$I->see("Delete Selected", "#delete_files"); // stepKey: seeDeleteBtn2
		$I->waitForPageLoad(30); // stepKey: seeDeleteBtn2WaitForPageLoad
		$I->click("#delete_files"); // stepKey: clickDeleteSelected2
		$I->waitForPageLoad(30); // stepKey: clickDeleteSelected2WaitForPageLoad
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitForConfirm3
		$I->waitForPageLoad(60); // stepKey: waitForConfirm3WaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmDelete2
		$I->waitForPageLoad(60); // stepKey: confirmDelete2WaitForPageLoad
		$I->dontSeeElement("#insert_files"); // stepKey: dontSeeAddSelectedBtn4
		$I->waitForPageLoad(30); // stepKey: dontSeeAddSelectedBtn4WaitForPageLoad
		$I->attachFile(".fileupload", "magento3.jpg"); // stepKey: uploadImage4
		$I->waitForPageLoad(30); // stepKey: uploadImage4WaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForFileUpload4
		$I->waitForElementVisible("//small[text()='magento3.jpg']", 30); // stepKey: waitForUploadImage4
		$I->click("#insert_files"); // stepKey: clickInsertBtn
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading11
		$I->waitForElementVisible("//span[text()='Ok']", 30); // stepKey: waitForOkBtn2
		$I->waitForPageLoad(30); // stepKey: waitForOkBtn2WaitForPageLoad
		$I->fillField(".mce-textbox.mce-abs-layout-item.mce-last", "Image content. Yeah."); // stepKey: fillImageDescription2
		$I->fillField(".mce-textbox.mce-abs-layout-item.mce-first", "1000"); // stepKey: fillImageHeight2
		$I->click("//span[text()='Ok']"); // stepKey: clickOkBtn2
		$I->waitForPageLoad(30); // stepKey: clickOkBtn2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad6
		$I->comment("Entering Action Group [saveProduct] AdminProductFormSaveActionGroup");
		$I->click("#save-button"); // stepKey: saveProductSaveProduct
		$I->waitForPageLoad(30); // stepKey: saveProductSaveProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavingSaveProduct
		$I->comment("Exiting Action Group [saveProduct] AdminProductFormSaveActionGroup");
		$I->amOnPage("testProductName" . msq("_defaultProduct") . ".html"); // stepKey: navigateToProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad7
		$I->seeElement(".product.attribute.description>div>p>img"); // stepKey: assertMediaDescription
		$I->seeElementInDOM("//img[contains(@src,'magento3')]"); // stepKey: assertMediaSource3
		$I->seeElementInDOM("//img[contains(@src,'magento2')]"); // stepKey: assertMediaSource1
	}
}
