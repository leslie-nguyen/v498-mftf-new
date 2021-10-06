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
 * @group Cms
 * @Title("MAGETWO-84184: Admin should see TinyMCEv4.6 is the native WYSIWYG on Block")
 * @Description("Admin should see TinyMCEv4.6 is the native WYSIWYG on Block<h3>Test files</h3>vendor\magento\module-cms\Test\Mftf\Test\VerifyTinyMCEv4IsNativeWYSIWYGOnBlockTest.xml<br>")
 * @TestCaseId("MAGETWO-84184")
 */
class VerifyTinyMCEv4IsNativeWYSIWYGOnBlockTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->createEntity("createPreReqCMSPage", "hook", "_defaultCmsPage", [], []); // stepKey: createPreReqCMSPage
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
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/cms/page"); // stepKey: amOnEditPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->conditionalClick("//div[@class='admin__data-grid-header']//button[contains(text(), 'Clear all')]", "//div[@class='admin__data-grid-header']//span[contains(text(), 'Active filters:')]", true); // stepKey: clickToResetFilter
		$I->waitForPageLoad(30); // stepKey: waitForGridReload
		$I->deleteEntity("createPreReqCMSPage", "hook"); // stepKey: deletePreReqCMSPage
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
	 * @Features({"Cms"})
	 * @Stories({"MAGETWO-42046-Apply new WYSIWYG on CMS Page and Block"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function VerifyTinyMCEv4IsNativeWYSIWYGOnBlockTest(AcceptanceTester $I)
	{
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/cms/block/new"); // stepKey: amOnNewBlockPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1
		$I->fillField("input[name=title]", "Default Block" . msq("_defaultBlock")); // stepKey: fillFieldTitle
		$I->fillField("input[name=identifier]", "block" . msq("_defaultBlock")); // stepKey: fillFieldIdentifier
		$I->selectOption("select[name=store_id]", "All Store View"); // stepKey: selectAllStoreView
		$I->waitForElementVisible(".mce-branding", 30); // stepKey: waitForTinyMCE
		$I->comment("Entering Action Group [verifyTinyMCE4] VerifyTinyMCEActionGroup");
		$I->seeElement(".mce-txt"); // stepKey: assertInfo2VerifyTinyMCE4
		$I->seeElement(".mce-i-bold"); // stepKey: assertInfo3VerifyTinyMCE4
		$I->seeElement(".mce-i-italic"); // stepKey: assertInfo4VerifyTinyMCE4
		$I->seeElement(".mce-i-underline"); // stepKey: assertInfo5VerifyTinyMCE4
		$I->seeElement(".mce-i-alignleft"); // stepKey: assertInfo6VerifyTinyMCE4
		$I->seeElement(".mce-i-aligncenter"); // stepKey: assertInfo7VerifyTinyMCE4
		$I->seeElement(".mce-i-alignright"); // stepKey: assertInfo8VerifyTinyMCE4
		$I->seeElement(".mce-i-numlist"); // stepKey: assertInfo9VerifyTinyMCE4
		$I->seeElement(".mce-i-bullist"); // stepKey: assertInfo10VerifyTinyMCE4
		$I->seeElement(".mce-i-link"); // stepKey: assertInfo11VerifyTinyMCE4
		$I->seeElement(".mce-i-image"); // stepKey: assertInf12VerifyTinyMCE4
		$I->seeElement(".mce-i-table"); // stepKey: assertInfo13VerifyTinyMCE4
		$I->seeElement(".mce-i-charmap"); // stepKey: assertInfo14VerifyTinyMCE4
		$I->comment("Exiting Action Group [verifyTinyMCE4] VerifyTinyMCEActionGroup");
		$I->comment("Entering Action Group [verifyMagentoEntities] VerifyMagentoEntityActionGroup");
		$I->seeElement("div[aria-label='Insert Widget']"); // stepKey: assertInfo15VerifyMagentoEntities
		$I->seeElement("div[aria-label='Insert Variable']"); // stepKey: assertInfo16VerifyMagentoEntities
		$I->comment("Exiting Action Group [verifyMagentoEntities] VerifyMagentoEntityActionGroup");
		$executeJSFillContent = $I->executeJS("tinyMCE.get('cms_block_form_content').setContent('Hello Block Page!');"); // stepKey: executeJSFillContent
		$I->click("#togglecms_block_form_content"); // stepKey: clickShowHideBtn1
		$I->waitForElementVisible(".action-add-widget", 30); // stepKey: waitForInsertWidget
		$I->see("Insert Image...", ".scalable.action-add-image.plugin"); // stepKey: assertInf17
		$I->see("Insert Widget...", ".action-add-widget"); // stepKey: assertInfo18
		$I->see("Insert Variable...", ".scalable.add-variable.plugin"); // stepKey: assertInfo19
		$I->click("//button[@data-ui-id='save-button-dropdown']"); // stepKey: expandSplitButton
		$I->waitForPageLoad(10); // stepKey: expandSplitButtonWaitForPageLoad
		$I->click("#save_and_close"); // stepKey: clickSaveBlock
		$I->waitForPageLoad(10); // stepKey: clickSaveBlockWaitForPageLoad
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/cms/page"); // stepKey: amOnEditPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2
		$I->conditionalClick("//div[@class='admin__data-grid-header']//button[contains(text(), 'Clear all')]", "//div[@class='admin__data-grid-header']//span[contains(text(), 'Active filters:')]", true); // stepKey: clickToResetFilter
		$I->waitForPageLoad(30); // stepKey: waitForGridReload
		$I->click("//button[text()='Filters']"); // stepKey: clickFiltersBtn
		$I->fillField("//div[@class='admin__form-field-control']/input[@name='identifier']", $I->retrieveEntityField('createPreReqCMSPage', 'identifier', 'test')); // stepKey: fillOutURLKey
		$I->click("//span[text()='Apply Filters']"); // stepKey: clickApplyBtn
		$I->waitForPageLoad(60); // stepKey: clickApplyBtnWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading3
		$I->comment("Entering Action Group [sortByIdDescending] SortByIdDescendingActionGroup");
		$I->conditionalClick("//div[contains(@data-role, 'grid-wrapper')]/table/thead/tr/th/span[contains(text(), 'ID')]", "//span[contains(text(), 'ID')]/parent::th[not(contains(@class, '_descend'))]/parent::tr/parent::thead/parent::table/parent::div[contains(@data-role, 'grid-wrapper')]", true); // stepKey: clickToAttemptSortByIdDescendingSortByIdDescending
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForFirstIdSortDescendingToFinishSortByIdDescending
		$I->comment("Conditional Click again in case it goes from default state to ascending on first click");
		$I->conditionalClick("//div[contains(@data-role, 'grid-wrapper')]/table/thead/tr/th/span[contains(text(), 'ID')]", "//span[contains(text(), 'ID')]/parent::th[not(contains(@class, '_descend'))]/parent::tr/parent::thead/parent::table/parent::div[contains(@data-role, 'grid-wrapper')]", true); // stepKey: secondClickToAttemptSortByIdDescendingSortByIdDescending
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForSecondIdSortDescendingToFinishSortByIdDescending
		$I->comment("Exiting Action Group [sortByIdDescending] SortByIdDescendingActionGroup");
		$I->waitForElementVisible("//div[text()='" . $I->retrieveEntityField('createPreReqCMSPage', 'identifier', 'test') . "']/parent::td//following-sibling::td[@class='data-grid-actions-cell']//button[text()='Select']", 30); // stepKey: waitForCMSPageGrid
		$I->scrollTo("//div[text()='" . $I->retrieveEntityField('createPreReqCMSPage', 'identifier', 'test') . "']/parent::td//following-sibling::td[@class='data-grid-actions-cell']//button[text()='Select']"); // stepKey: scrollToCMSPage
		$I->click("//div[text()='" . $I->retrieveEntityField('createPreReqCMSPage', 'identifier', 'test') . "']/parent::td//following-sibling::td[@class='data-grid-actions-cell']//button[text()='Select']"); // stepKey: clickSelect
		$I->waitForElementVisible("//div[text()='" . $I->retrieveEntityField('createPreReqCMSPage', 'identifier', 'test') . "']/parent::td//following-sibling::td[@class='data-grid-actions-cell']//a[text()='Edit']", 30); // stepKey: waitForEditLink
		$I->click("//div[text()='" . $I->retrieveEntityField('createPreReqCMSPage', 'identifier', 'test') . "']/parent::td//following-sibling::td[@class='data-grid-actions-cell']//a[text()='Edit']"); // stepKey: clickEdit
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad3
		$I->scrollTo("input[name=title]"); // stepKey: scrollToPageTitle
		$I->click("div[data-index=content]"); // stepKey: clickContentTab
		$I->waitForElementVisible("#togglecms_page_form_content", 30); // stepKey: waitforShowHideBtn
		$I->click("#togglecms_page_form_content"); // stepKey: clickShowHideBtn2
		$I->waitForElementVisible(".action-add-widget", 30); // stepKey: waitForInsertInsertWidgetBtn
		$I->seeElement(".action-add-widget"); // stepKey: widgetBtn
		$I->click(".action-add-widget"); // stepKey: clickInsertWidgetBtn
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad4
		$I->selectOption("#select_widget_type", "CMS Static Block"); // stepKey: selectCMSStaticBlock
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskDisappear
		$I->selectOption("select[name='parameters[template]']", "CMS Static Block Default Template"); // stepKey: selectTemplate
		$I->click(".btn-chooser"); // stepKey: clickSelectPageBtn
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskDisappearAfterClickingBtnChooser
		$I->comment("Entering Action Group [sortByIdDescending2] SortByIdDescendingActionGroup");
		$I->conditionalClick("//div[contains(@data-role, 'grid-wrapper')]/table/thead/tr/th/span[contains(text(), 'ID')]", "//span[contains(text(), 'ID')]/parent::th[not(contains(@class, '_descend'))]/parent::tr/parent::thead/parent::table/parent::div[contains(@data-role, 'grid-wrapper')]", true); // stepKey: clickToAttemptSortByIdDescendingSortByIdDescending2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForFirstIdSortDescendingToFinishSortByIdDescending2
		$I->comment("Conditional Click again in case it goes from default state to ascending on first click");
		$I->conditionalClick("//div[contains(@data-role, 'grid-wrapper')]/table/thead/tr/th/span[contains(text(), 'ID')]", "//span[contains(text(), 'ID')]/parent::th[not(contains(@class, '_descend'))]/parent::tr/parent::thead/parent::table/parent::div[contains(@data-role, 'grid-wrapper')]", true); // stepKey: secondClickToAttemptSortByIdDescendingSortByIdDescending2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForSecondIdSortDescendingToFinishSortByIdDescending2
		$I->comment("Exiting Action Group [sortByIdDescending2] SortByIdDescendingActionGroup");
		$I->waitForElementVisible("//td[contains(text(),'block" . msq("_defaultBlock") . "')]", 30); // stepKey: waitForBlockCode
		$I->scrollTo("//td[contains(text(),'block" . msq("_defaultBlock") . "')]"); // stepKey: scrollToBlockIdentifier
		$I->click("//td[contains(text(),'block" . msq("_defaultBlock") . "')]"); // stepKey: selectPreCreateBlock
		$I->wait(3); // stepKey: wait1
		$I->click("#insert_button"); // stepKey: clickInsertWidget
		$I->waitForPageLoad(30); // stepKey: clickInsertWidgetWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad5
		$I->waitForElementVisible("#save-button", 30); // stepKey: waitForSaveButtonVisible
		$I->waitForPageLoad(10); // stepKey: waitForSaveButtonVisibleWaitForPageLoad
		$I->click("//button[@data-ui-id='save-button-dropdown']"); // stepKey: expandButtonMenu
		$I->waitForPageLoad(10); // stepKey: expandButtonMenuWaitForPageLoad
		$I->click("#save_and_close"); // stepKey: clickSavePage
		$I->waitForPageLoad(10); // stepKey: clickSavePageWaitForPageLoad
		$I->see("You saved the page."); // stepKey: seeSuccessMessage
		$I->amOnPage($I->retrieveEntityField('createPreReqCMSPage', 'identifier', 'test')); // stepKey: amOnPageTestPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad6
		$I->comment("see content of Block on Storefront");
		$I->see("Hello Block Page!"); // stepKey: seeContent
	}
}
