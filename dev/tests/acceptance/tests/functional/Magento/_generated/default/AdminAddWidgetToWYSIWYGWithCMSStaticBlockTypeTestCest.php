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
 * @Title("MAGETWO-83787: Admin should be able to create a CMS page with widget type: CMS Static Block")
 * @Description("Admin should be able to create a CMS page with widget type: CMS Static Block<h3>Test files</h3>vendor\magento\module-cms\Test\Mftf\Test\AdminAddWidgetToWYSIWYGWithCMSStaticBlockTypeTest.xml<br>")
 * @TestCaseId("MAGETWO-83787")
 */
class AdminAddWidgetToWYSIWYGWithCMSStaticBlockTypeTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->createEntity("createPreReqBlock", "hook", "_defaultBlock", [], []); // stepKey: createPreReqBlock
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
		$I->deleteEntity("createPreReqBlock", "hook"); // stepKey: deletePreReqBlock
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
	 * @Stories({"MAGETWO-42156-Widgets in WYSIWYG"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAddWidgetToWYSIWYGWithCMSStaticBlockTypeTest(AcceptanceTester $I)
	{
		$I->comment("Main test");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/cms/page/new"); // stepKey: navigateToPage
		$I->waitForPageLoad(30); // stepKey: wait1
		$I->fillField("input[name=title]", "Test CMS Page"); // stepKey: fillFieldTitle
		$I->click("div[data-index=content]"); // stepKey: clickContentTab
		$I->waitForElementVisible(".mce-branding", 30); // stepKey: waitForTinyMCE4
		$executeJSFillContent = $I->executeJS("tinyMCE.activeEditor.setContent('Hello CMS Page!');"); // stepKey: executeJSFillContent
		$I->seeElement("div[aria-label='Insert Widget']"); // stepKey: seeWidgetIcon
		$I->click("div[aria-label='Insert Widget']"); // stepKey: clickInsertWidgetIcon
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->see("Inserting a widget does not create a widget instance."); // stepKey: seeMessage
		$I->comment("see Insert Widget button disabled");
		$I->see("Insert Widget", "//button[@id='insert_button' and contains(@class,'disabled')]"); // stepKey: seeInsertWidgetDisabled
		$I->comment("see Cancel button enabed");
		$I->see("Cancel", "//button[@id='reset' and not(contains(@class,'disabled'))]"); // stepKey: seeCancelBtnEnabled
		$I->comment("Select \"Widget Type\"");
		$I->selectOption("#select_widget_type", "CMS Static"); // stepKey: selectCMSStaticBlock
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskDisappear
		$I->comment("see Insert Widget button enabled");
		$I->see("Insert Widget", "//button[@id='insert_button' and not(contains(@class,'disabled'))]"); // stepKey: seeInsertWidgetEnabled
		$I->selectOption("select[name='parameters[template]']", "CMS Static Block Default Template"); // stepKey: selectTemplate
		$I->click(".btn-chooser"); // stepKey: clickSelectPageBtn
		$I->waitForLoadingMaskToDisappear(); // stepKey: wait3
		$I->comment("Entering Action Group [sortByIdDescending] SortByIdDescendingActionGroup");
		$I->conditionalClick("//div[contains(@data-role, 'grid-wrapper')]/table/thead/tr/th/span[contains(text(), 'ID')]", "//span[contains(text(), 'ID')]/parent::th[not(contains(@class, '_descend'))]/parent::tr/parent::thead/parent::table/parent::div[contains(@data-role, 'grid-wrapper')]", true); // stepKey: clickToAttemptSortByIdDescendingSortByIdDescending
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForFirstIdSortDescendingToFinishSortByIdDescending
		$I->comment("Conditional Click again in case it goes from default state to ascending on first click");
		$I->conditionalClick("//div[contains(@data-role, 'grid-wrapper')]/table/thead/tr/th/span[contains(text(), 'ID')]", "//span[contains(text(), 'ID')]/parent::th[not(contains(@class, '_descend'))]/parent::tr/parent::thead/parent::table/parent::div[contains(@data-role, 'grid-wrapper')]", true); // stepKey: secondClickToAttemptSortByIdDescendingSortByIdDescending
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForSecondIdSortDescendingToFinishSortByIdDescending
		$I->comment("Exiting Action Group [sortByIdDescending] SortByIdDescendingActionGroup");
		$I->waitForElementVisible("//td[contains(text(),'" . $I->retrieveEntityField('createPreReqBlock', 'identifier', 'test') . "')]", 30); // stepKey: waitForSlideoutOpens
		$I->scrollTo("//td[contains(text(),'" . $I->retrieveEntityField('createPreReqBlock', 'identifier', 'test') . "')]"); // stepKey: scrollToBlockIdentifier
		$I->click("//td[contains(text(),'" . $I->retrieveEntityField('createPreReqBlock', 'identifier', 'test') . "')]"); // stepKey: selectPreCreateBlock
		$I->waitForElementNotVisible("//h1[contains(text(),'Select Block')]", 30); // stepKey: waitForSlideoutCloses
		$I->click("#insert_button"); // stepKey: clickInsertWidget
		$I->waitForPageLoad(30); // stepKey: clickInsertWidgetWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitingForLoading
		$I->scrollTo("div[data-index=search_engine_optimisation]"); // stepKey: scrollToSearchEngineTab
		$I->waitForPageLoad(30); // stepKey: scrollToSearchEngineTabWaitForPageLoad
		$I->click("div[data-index=search_engine_optimisation]"); // stepKey: clickExpandSearchEngineOptimisation
		$I->waitForPageLoad(30); // stepKey: clickExpandSearchEngineOptimisationWaitForPageLoad
		$I->fillField("input[name=identifier]", "test-page-" . msq("_defaultCmsPage")); // stepKey: fillFieldUrlKey
		$I->click("//button[@data-ui-id='save-button-dropdown']"); // stepKey: expandButtonMenu
		$I->waitForPageLoad(10); // stepKey: expandButtonMenuWaitForPageLoad
		$I->waitForElementVisible("//ul[@data-ui-id='save-button-dropdown-menu']", 30); // stepKey: waitForSplitButtonMenuVisible
		$I->waitForPageLoad(10); // stepKey: waitForSplitButtonMenuVisibleWaitForPageLoad
		$I->click("#save_and_close"); // stepKey: clickSavePage
		$I->waitForPageLoad(10); // stepKey: clickSavePageWaitForPageLoad
		$I->see("You saved the page."); // stepKey: seeSuccessMessage
		$I->amOnPage("test-page-" . msq("_defaultCmsPage")); // stepKey: amOnPageTestPage
		$I->waitForPageLoad(30); // stepKey: wait5
		$I->comment("see widget on Storefront");
		$I->see("Hello CMS Page!"); // stepKey: seeContent
		$I->see($I->retrieveEntityField('createPreReqBlock', 'content', 'test')); // stepKey: seeBlockLink
	}
}
