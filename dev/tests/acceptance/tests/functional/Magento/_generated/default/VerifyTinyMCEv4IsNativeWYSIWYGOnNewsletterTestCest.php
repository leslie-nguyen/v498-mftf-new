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
 * @Title("MAGETWO-84683: Admin should see TinyMCEv4.6 is the native WYSIWYG on Newsletter")
 * @Description("Admin should see TinyMCEv4.6 is the native WYSIWYG on Newsletter<h3>Test files</h3>vendor\magento\module-newsletter\Test\Mftf\Test\VerifyTinyMCEv4IsNativeWYSIWYGOnNewsletterTest.xml<br>")
 * @TestCaseId("MAGETWO-84683")
 */
class VerifyTinyMCEv4IsNativeWYSIWYGOnNewsletterTestCest
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
	 * @Features({"Newsletter"})
	 * @Stories({"MAGETWO-47309-Apply new WYSIWYG in Newsletter"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function VerifyTinyMCEv4IsNativeWYSIWYGOnNewsletterTest(AcceptanceTester $I)
	{
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/newsletter/template/new/"); // stepKey: amOnNewsletterTemplatePage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1
		$I->fillField("#code", "Test Newsletter Template" . msq("_defaultNewsletter")); // stepKey: fillTemplateName
		$I->fillField("#subject", "Test Newsletter Subject"); // stepKey: fillTemplateSubject
		$I->fillField("#sender_name", "Admin"); // stepKey: fillSenderName
		$I->fillField("#sender_email", "admin@magento.com"); // stepKey: fillSenderEmail
		$I->conditionalClick("#toggletext", ".mce-tinymce", false); // stepKey: clickBtnIfTinyMCEHidden
		$I->waitForPageLoad(30); // stepKey: waitForTinyMce
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
		$executeJSFillContent = $I->executeJS("tinyMCE.get('text').setContent('Hello World From Newsletter Template!');"); // stepKey: executeJSFillContent
		$I->click("#toggletext"); // stepKey: clickShowHideBtn2
		$I->waitForPageLoad(60); // stepKey: clickShowHideBtn2WaitForPageLoad
		$I->waitForElementVisible(".action-add-widget", 30); // stepKey: waitForInsertWidget
		$I->see("Insert Image...", ".action-add-image"); // stepKey: assertInf17
		$I->see("Insert Widget...", ".action-add-widget"); // stepKey: assertInfo18
		$I->see("Insert Variable...", ".add-variable"); // stepKey: assertInfo19
		$I->comment("Go to Storefront");
		$I->click("button[data-role='template-save']"); // stepKey: clickSavePage
		$I->waitForPageLoad(60); // stepKey: clickSavePageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad3
		$I->click("//td[contains(text(),'Test Newsletter Template" . msq("_defaultNewsletter") . "')]//following-sibling::td/select//option[contains(text(), 'Preview')]"); // stepKey: clickPreview
		$I->waitForPageLoad(60); // stepKey: clickPreviewWaitForPageLoad
		$I->switchToWindow("action_window"); // stepKey: switchToWindow
		$I->comment("Entering Action Group [switchToIframe] SwitchToPreviewIframeActionGroup");
		$addSandboxValueSwitchToIframe = $I->executeJS("document.getElementById('preview_iframe').sandbox.add('allow-scripts')"); // stepKey: addSandboxValueSwitchToIframe
		$I->wait(10); // stepKey: waitBeforeSwitchToIframeSwitchToIframe
		$I->switchToIFrame("preview_iframe"); // stepKey: switchToIframeSwitchToIframe
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSwitchToIframe
		$I->comment("Exiting Action Group [switchToIframe] SwitchToPreviewIframeActionGroup");
		$I->waitForText("Hello World From Newsletter Template!", 30); // stepKey: waitForPageLoad2
		$I->see("Hello World From Newsletter Template!"); // stepKey: seeContent
		$I->closeTab(); // stepKey: closeTab
	}
}
