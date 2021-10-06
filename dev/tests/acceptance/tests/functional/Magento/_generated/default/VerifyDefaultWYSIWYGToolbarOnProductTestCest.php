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
 * @Title("MAGETWO-80505: Admin should be able to see default toolbar display on Description content area")
 * @Description("Admin should be able to see default toolbar display on Description content area<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\VerifyDefaultWYSIWYGToolbarOnProductTest\VerifyDefaultWYSIWYGToolbarOnProductTest.xml<br>")
 * @TestCaseId("MAGETWO-80505")
 */
class VerifyDefaultWYSIWYGToolbarOnProductTestCest
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
	 * @Stories({"MAGETWO-70412-Default toolbar configuration in Magento"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function VerifyDefaultWYSIWYGToolbarOnProductTest(AcceptanceTester $I)
	{
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/simple/"); // stepKey: navigateToProduct
		$I->waitForPageLoad(30); // stepKey: wait
		$I->scrollTo(".admin__field[data-index=qty] input"); // stepKey: scrollToQty
		$I->click("//strong[contains(@class, 'admin__collapsible-title')]/span[text()='Content']"); // stepKey: clickContentTab
		$I->waitForElementVisible("div#editorproduct_form_description .mce-branding", 30); // stepKey: waitforTinyMCE4Visible1
		$I->seeElement("div#editorproduct_form_description .mce-branding"); // stepKey: TinyMCE4Description
		$I->seeElement("//div[@id='editorproduct_form_description']//span[text()='Paragraph']"); // stepKey: assertInfo2
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-bold']"); // stepKey: assertInfo3
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-italic']"); // stepKey: assertInfo4
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-underline']"); // stepKey: assertInfo5
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-alignleft']"); // stepKey: assertInfo6
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-aligncenter']"); // stepKey: assertInfo7
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-alignright']"); // stepKey: assertInfo8
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-bullist']"); // stepKey: assertInfo9
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-numlist']"); // stepKey: assertInfo10
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-link']"); // stepKey: assertInfo11
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-image']"); // stepKey: assertInf12
		$I->waitForPageLoad(30); // stepKey: assertInf12WaitForPageLoad
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-table']"); // stepKey: assertInfo13
		$I->seeElement("//div[@id='editorproduct_form_description']//i[@class='mce-ico mce-i-charmap']"); // stepKey: assertInfo14
	}
}
