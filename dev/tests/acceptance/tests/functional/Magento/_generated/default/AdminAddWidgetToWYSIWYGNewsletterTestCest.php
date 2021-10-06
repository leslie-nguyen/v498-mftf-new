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
 * @group Newsletter
 * @Title("MC-6070: Admin should be able to add widget to WYSIWYG Editor of Newsletter")
 * @Description("Admin should be able to add widget to WYSIWYG Editor Newsletter<h3>Test files</h3>vendor\magento\module-newsletter\Test\Mftf\Test\AdminAddWidgetToWYSIWYGNewsletterTest.xml<br>")
 * @TestCaseId("MC-6070")
 */
class AdminAddWidgetToWYSIWYGNewsletterTestCest
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
	 * @Features({"Newsletter"})
	 * @Stories({"MAGETWO-47309-Apply new WYSIWYG in Newsletter"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAddWidgetToWYSIWYGNewsletterTest(AcceptanceTester $I)
	{
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/newsletter/template/new/"); // stepKey: amOnNewsletterTemplatePage
		$I->waitForElementVisible("#code", 30); // stepKey: waitForTemplateName
		$I->fillField("#code", "Test Newsletter Template" . msq("_defaultNewsletter")); // stepKey: fillTemplateName
		$I->fillField("#subject", "Test Newsletter Subject"); // stepKey: fillTemplateSubject
		$I->fillField("#sender_name", "Admin"); // stepKey: fillSenderName
		$I->fillField("#sender_email", "admin@magento.com"); // stepKey: fillSenderEmail
		$I->conditionalClick("#toggletext", ".mce-branding", false); // stepKey: toggleEditorIfHidden
		$I->waitForElementVisible(".mce-branding", 30); // stepKey: waitForTinyMCE
		$I->waitForElementVisible("div[aria-label='Insert Widget']", 30); // stepKey: waitForInsertWidgerIconButton
		$I->click("div[aria-label='Insert Widget']"); // stepKey: clickInsertWidgetIcon
		$I->wait(10); // stepKey: waitForPageLoad
		$I->see("Inserting a widget does not create a widget instance."); // stepKey: seeMessage
		$I->selectOption("#select_widget_type", "CMS Page Link"); // stepKey: selectCMSPageLink
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskDisappear
		$I->see("Insert Widget", "//button[@id='insert_button' and not(contains(@class,'disabled'))]"); // stepKey: seeInsertWidgetEnabled
		$I->selectOption("select[name='parameters[template]']", "CMS Page Link Block Template"); // stepKey: selectTemplate
		$I->click(".btn-chooser"); // stepKey: clickSelectPageBtn
		$I->waitForElementVisible("//td[contains(text(),'Home page')]", 30); // stepKey: waitForPageVisible
		$I->click("//td[contains(text(),'Home page')]"); // stepKey: selectPreCreateCMS
		$I->waitForElementNotVisible("//h1[contains(text(),'Select Page')]", 30); // stepKey: waitForSlideOutCloses
		$I->click("#insert_button"); // stepKey: clickInsertWidget
		$I->waitForPageLoad(30); // stepKey: clickInsertWidgetWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading
		$I->waitForElementNotVisible("//h1[contains(text(),'Insert Widget')]", 30); // stepKey: waitForSlideOutCloses1
		$I->click("button[data-role='template-save']"); // stepKey: clickSaveTemplate
		$I->waitForPageLoad(60); // stepKey: clickSaveTemplateWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad10
		$I->click("//td[contains(text(),'Test Newsletter Template" . msq("_defaultNewsletter") . "')]//following-sibling::td/select//option[contains(text(), 'Preview')]"); // stepKey: clickPreview
		$I->waitForPageLoad(60); // stepKey: clickPreviewWaitForPageLoad
		$I->switchToWindow("action_window"); // stepKey: switchToWindow
		$I->comment("Entering Action Group [switchToIframe] SwitchToPreviewIframeActionGroup");
		$addSandboxValueSwitchToIframe = $I->executeJS("document.getElementById('preview_iframe').sandbox.add('allow-scripts')"); // stepKey: addSandboxValueSwitchToIframe
		$I->wait(10); // stepKey: waitBeforeSwitchToIframeSwitchToIframe
		$I->switchToIFrame("preview_iframe"); // stepKey: switchToIframeSwitchToIframe
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSwitchToIframe
		$I->comment("Exiting Action Group [switchToIframe] SwitchToPreviewIframeActionGroup");
		$I->waitForText("Home page", 30); // stepKey: waitForPageLoad9
		$I->see("Home page"); // stepKey: seeHomePageCMSPage
		$I->closeTab(); // stepKey: closeTab
	}
}
