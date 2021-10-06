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
 * @Title("MAGETWO-82551: Admin should see TinyMCEv4.6 is the native WYSIWYG on Catalog Page")
 * @Description("Admin should see TinyMCEv4.6 is the native WYSIWYG on Catalog Page<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\VerifyTinyMCEv4IsNativeWYSIWYGOnCatalogTest.xml<br>")
 * @TestCaseId("MAGETWO-82551")
 */
class VerifyTinyMCEv4IsNativeWYSIWYGOnCatalogTestCest
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
	 * @Stories({"MAGETWO-72137-Apply new WYSIWYG on Categories Page"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function VerifyTinyMCEv4IsNativeWYSIWYGOnCatalogTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [navigateToNewCatalog] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageNavigateToNewCatalog
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadNavigateToNewCatalog
		$I->comment("Exiting Action Group [navigateToNewCatalog] AdminOpenCategoryPageActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: wait2
		$I->click("#add_subcategory_button"); // stepKey: clickOnAddSubCategory
		$I->waitForPageLoad(30); // stepKey: clickOnAddSubCategoryWaitForPageLoad
		$I->fillField("input[name='name']", "SimpleSubCategory" . msq("SimpleSubCategory")); // stepKey: enterCategoryName
		$I->click("//strong[contains(@class, 'admin__collapsible-title')]/span[text()='Content']"); // stepKey: clickContentTab
		$I->waitForElementVisible(".mce-branding", 30); // stepKey: waitForTinyMCE4
		$I->seeElement("#togglecategory_form_description"); // stepKey: seeShowHideBtn
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
		$executeJSFillContent = $I->executeJS("tinyMCE.get('category_form_description').setContent('Hello World!');"); // stepKey: executeJSFillContent
		$I->click("#togglecategory_form_description"); // stepKey: clickShowHideBtn
		$I->waitForElementVisible(".scalable.action-add-image.plugin", 30); // stepKey: waitForInsertImage
		$I->seeElement(".scalable.action-add-image.plugin"); // stepKey: insertImage
		$I->dontSee(".action-add-widget"); // stepKey: insertWidget
		$I->dontSee(".scalable.add-variable.plugin"); // stepKey: insertVariable
		$I->comment("Entering Action Group [saveCatalog] AdminSaveCategoryActionGroup");
		$I->click(".page-actions-inner #save"); // stepKey: saveCategoryWithProductsSaveCatalog
		$I->waitForPageLoad(30); // stepKey: saveCategoryWithProductsSaveCatalogWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCategorySavedSaveCatalog
		$I->comment("Exiting Action Group [saveCatalog] AdminSaveCategoryActionGroup");
		$I->comment("Go to storefront product page, assert product content");
		$I->amOnPage("/simplesubcategory" . msq("SimpleSubCategory") . ".html"); // stepKey: goToCategoryFrontPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2
		$I->waitForElementVisible("//div[@class='category-description']//p", 30); // stepKey: waitForDesVisible
		$I->see("Hello World!", "//div[@class='category-description']//p"); // stepKey: assertCatalogDescription
	}
}
