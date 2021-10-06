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
 * @Title("MC-18962: Media Gallery popup upload images without error")
 * @Description("Media Gallery popup upload images without error<h3>Test files</h3>vendor\magento\module-cms\Test\Mftf\Test\AdminMediaGalleryPopupUploadImagesWithoutErrorTest.xml<br>")
 * @TestCaseId("MC-18962")
 * @group Cms
 */
class AdminMediaGalleryPopupUploadImagesWithoutErrorTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Enable WYSIWYG options");
		$I->comment("Enable WYSIWYG options");
		$enableWYSIWYGEditor = $I->magentoCLI("config:set cms/wysiwyg/enabled enabled", 60); // stepKey: enableWYSIWYGEditor
		$I->comment($enableWYSIWYGEditor);
		$setValueWYSIWYGEditor = $I->magentoCLI("config:set cms/wysiwyg/editor 'TinyMCE 4'", 60); // stepKey: setValueWYSIWYGEditor
		$I->comment($setValueWYSIWYGEditor);
		$I->comment("Create block");
		$I->comment("Create block");
		$I->createEntity("createBlock", "hook", "Sales25offBlock", [], []); // stepKey: createBlock
		$I->comment("Entering Action Group [login] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLogin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLogin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLogin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLogin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLogin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLogin
		$I->comment("Exiting Action Group [login] AdminLoginActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Disable WYSIWYG options");
		$I->comment("Disable WYSIWYG options");
		$disableWYSIWYG = $I->magentoCLI("config:set cms/wysiwyg/enabled disabled", 60); // stepKey: disableWYSIWYG
		$I->comment($disableWYSIWYG);
		$I->deleteEntity("createBlock", "hook"); // stepKey: deleteBlock
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
	 * @Stories({"Spinner is Always Displayed on Media Gallery popup"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminMediaGalleryPopupUploadImagesWithoutErrorTest(AcceptanceTester $I)
	{
		$I->comment("Open created block page and add image");
		$I->comment("Open create block page and add image");
		$I->comment("Entering Action Group [navigateToCreatedCMSBlockPage1] NavigateToCreatedCMSBlockPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/cms/block/"); // stepKey: navigateToCMSBlocksGridNavigateToCreatedCMSBlockPage1
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1NavigateToCreatedCMSBlockPage1
		$I->conditionalClick("//div[@class='admin__data-grid-header']//button[contains(text(), 'Clear all')]", "//div[@class='admin__data-grid-header']//span[contains(text(), 'Active filters:')]", true); // stepKey: clickToResetFilterNavigateToCreatedCMSBlockPage1
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2NavigateToCreatedCMSBlockPage1
		$I->conditionalClick("//div[contains(@data-role, 'grid-wrapper')]/table/thead/tr/th/span[contains(text(), 'ID')]", "//span[contains(text(), 'ID')]/parent::th[not(contains(@class, '_descend'))]/parent::tr/parent::thead/parent::table/parent::div[contains(@data-role, 'grid-wrapper')]", true); // stepKey: clickToAttemptSortByIdDescendingNavigateToCreatedCMSBlockPage1
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForFirstIdSortDescendingToFinishNavigateToCreatedCMSBlockPage1
		$I->comment("Conditional Click again in case it goes from default state to ascending on first click");
		$I->conditionalClick("//div[contains(@data-role, 'grid-wrapper')]/table/thead/tr/th/span[contains(text(), 'ID')]", "//span[contains(text(), 'ID')]/parent::th[not(contains(@class, '_descend'))]/parent::tr/parent::thead/parent::table/parent::div[contains(@data-role, 'grid-wrapper')]", true); // stepKey: secondClickToAttemptSortByIdDescendingNavigateToCreatedCMSBlockPage1
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForSecondIdSortDescendingToFinishNavigateToCreatedCMSBlockPage1
		$I->click("//div[text()='" . $I->retrieveEntityField('createBlock', 'identifier', 'test') . "']//parent::td//following-sibling::td//button[text()='Select']"); // stepKey: clickSelectCreatedCMSBlockNavigateToCreatedCMSBlockPage1
		$I->click("//div[text()='" . $I->retrieveEntityField('createBlock', 'identifier', 'test') . "']//parent::td//following-sibling::td//a[text()='Edit']"); // stepKey: navigateToCreatedCMSBlockNavigateToCreatedCMSBlockPage1
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad3NavigateToCreatedCMSBlockPage1
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskOfStagingSectionNavigateToCreatedCMSBlockPage1
		$I->comment("Exiting Action Group [navigateToCreatedCMSBlockPage1] NavigateToCreatedCMSBlockPageActionGroup");
		$I->comment("Entering Action Group [addImage] AdminAddImageToCMSBlockContent");
		$I->click(".mce-i-image"); // stepKey: clickAddImageButtonAddImage
		$I->waitForElementVisible(".mce-i-browse", 30); // stepKey: waitForBrowseImageAddImage
		$I->click(".mce-i-browse"); // stepKey: clickBrowseImageAddImage
		$I->waitForElementVisible("#root > .jstree-icon", 30); // stepKey: waitForAttacheFilesAddImage
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForStorageRootLoadingMaskDisappearAddImage
		$I->click("#root > .jstree-icon"); // stepKey: clickRootAddImage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddImage
		$I->attachFile(".fileupload", "magento-again.jpg"); // stepKey: attachLogoAddImage
		$I->waitForElementVisible("#insert_files", 30); // stepKey: waitForAddSelectedAddImage
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskDisappearAddImage
		$I->click("#insert_files"); // stepKey: clickAddSelectedAddImage
		$I->waitForElementVisible("//span[text()='Ok']", 30); // stepKey: waitForOkButtonAddImage
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskToDisappear2AddImage
		$I->click("//span[text()='Ok']"); // stepKey: clickOkAddImage
		$I->comment("Exiting Action Group [addImage] AdminAddImageToCMSBlockContent");
		$I->click("#togglecms_block_form_content"); // stepKey: clickShowHideBtnFirstTime
		$I->click("#togglecms_block_form_content"); // stepKey: clickShowHideBtnSecondTime
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->comment("Switch to content frame and click on image");
		$I->comment("Switch to content frame and click on image");
		$I->switchToIFrame("cms_block_form_content_ifr"); // stepKey: switchToContentFrame
		$I->click("#tinymce img"); // stepKey: clickImage
		$I->switchToIFrame(); // stepKey: switchBack
		$I->comment("Add image second time and assert");
		$I->comment("Add image second time and assert");
		$I->comment("Entering Action Group [addImageSecondTime] AdminAddImageToCMSBlockContent");
		$I->click(".mce-i-image"); // stepKey: clickAddImageButtonAddImageSecondTime
		$I->waitForElementVisible(".mce-i-browse", 30); // stepKey: waitForBrowseImageAddImageSecondTime
		$I->click(".mce-i-browse"); // stepKey: clickBrowseImageAddImageSecondTime
		$I->waitForElementVisible("#root > .jstree-icon", 30); // stepKey: waitForAttacheFilesAddImageSecondTime
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForStorageRootLoadingMaskDisappearAddImageSecondTime
		$I->click("#root > .jstree-icon"); // stepKey: clickRootAddImageSecondTime
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddImageSecondTime
		$I->attachFile(".fileupload", "magento-logo.png"); // stepKey: attachLogoAddImageSecondTime
		$I->waitForElementVisible("#insert_files", 30); // stepKey: waitForAddSelectedAddImageSecondTime
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskDisappearAddImageSecondTime
		$I->click("#insert_files"); // stepKey: clickAddSelectedAddImageSecondTime
		$I->waitForElementVisible("//span[text()='Ok']", 30); // stepKey: waitForOkButtonAddImageSecondTime
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskToDisappear2AddImageSecondTime
		$I->click("//span[text()='Ok']"); // stepKey: clickOkAddImageSecondTime
		$I->comment("Exiting Action Group [addImageSecondTime] AdminAddImageToCMSBlockContent");
		$I->switchToIFrame("cms_block_form_content_ifr"); // stepKey: switchToContentFrameSecondTime
		$I->seeElement("#tinymce img"); // stepKey: seeImageElement
	}
}
