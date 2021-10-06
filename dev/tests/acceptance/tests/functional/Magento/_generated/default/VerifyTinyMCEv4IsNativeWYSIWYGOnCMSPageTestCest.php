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
 * @Title("MAGETWO-84182: Admin should see TinyMCEv4.6 is the native WYSIWYG on CMS Page")
 * @Description("Admin should see TinyMCEv4.6 is the native WYSIWYG on CMS Page<h3>Test files</h3>vendor\magento\module-cms\Test\Mftf\Test\VerifyTinyMCEv4IsNativeWYSIWYGOnCMSPageTest.xml<br>")
 * @TestCaseId("MAGETWO-84182")
 */
class VerifyTinyMCEv4IsNativeWYSIWYGOnCMSPageTestCest
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
	 * @Features({"Cms"})
	 * @Stories({"MAGETWO-42046-Apply new WYSIWYG on CMS Page"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function VerifyTinyMCEv4IsNativeWYSIWYGOnCMSPageTest(AcceptanceTester $I)
	{
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/cms/page"); // stepKey: amOnPagePagesGrid
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1
		$I->click("#add"); // stepKey: clickAddNewPage
		$I->waitForPageLoad(30); // stepKey: clickAddNewPageWaitForPageLoad
		$I->fillField("input[name=title]", "Test CMS Page"); // stepKey: fillFieldTitle
		$I->click("div[data-index=content]"); // stepKey: clickExpandContent
		$I->fillField("input[name=content_heading]", "Test Content Heading"); // stepKey: fillFieldContentHeading
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
		$executeJSFillContent = $I->executeJS("tinyMCE.get('cms_page_form_content').setContent('Hello World!');"); // stepKey: executeJSFillContent
		$I->click("#togglecms_page_form_content"); // stepKey: clickShowHideBtn
		$I->waitForElementVisible(".action-add-widget", 30); // stepKey: waitForInsertWidget
		$I->see("Insert Image...", ".scalable.action-add-image.plugin"); // stepKey: assertInf17
		$I->see("Insert Widget...", ".action-add-widget"); // stepKey: assertInfo18
		$I->see("Insert Variable...", ".scalable.add-variable.plugin"); // stepKey: assertInfo19
		$I->click("div[data-index=search_engine_optimisation]"); // stepKey: clickExpandSearchEngineOptimisation
		$I->waitForPageLoad(30); // stepKey: clickExpandSearchEngineOptimisationWaitForPageLoad
		$I->fillField("input[name=identifier]", "test-page-" . msq("_defaultCmsPage")); // stepKey: fillFieldUrlKey
		$I->waitForElementVisible("#save-button", 30); // stepKey: waitForSaveButtonVisible
		$I->waitForPageLoad(10); // stepKey: waitForSaveButtonVisibleWaitForPageLoad
		$I->click("//button[@data-ui-id='save-button-dropdown']"); // stepKey: expandButtonMenu
		$I->waitForPageLoad(10); // stepKey: expandButtonMenuWaitForPageLoad
		$I->click("#save_and_close"); // stepKey: clickSavePage
		$I->waitForPageLoad(10); // stepKey: clickSavePageWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading
		$I->see("You saved the page."); // stepKey: seeSuccessMessage
		$I->amOnPage("test-page-" . msq("_defaultCmsPage")); // stepKey: amOnPageTestPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2
		$I->see("Test Content Heading"); // stepKey: seeContentHeading
		$I->see("Hello World!"); // stepKey: seeContent
	}
}
