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
 * @Title("[NO TESTCASEID]: Admin validates the url when getting video information")
 * @Description("Testing for a required video url when getting video information<h3>Test files</h3>vendor\magento\module-product-video\Test\Mftf\Test\AdminValidateUrlOnGetVideoInformationTest.xml<br>")
 * @group productVideo
 */
class AdminValidateUrlOnGetVideoInformationTestCest
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
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->createEntity("setStoreConfig", "hook", "ProductVideoYoutubeApiKeyConfig", [], []); // stepKey: setStoreConfig
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->createEntity("setStoreDefaultConfig", "hook", "DefaultProductVideoConfig", [], []); // stepKey: setStoreDefaultConfig
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
	 * @Features({"ProductVideo"})
	 * @Stories({"Admin validates the url when getting video information"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminValidateUrlOnGetVideoInformationTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [navigateToProductIndexPage] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageNavigateToProductIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadNavigateToProductIndexPage
		$I->comment("Exiting Action Group [navigateToProductIndexPage] AdminOpenProductIndexPageActionGroup");
		$I->comment("Entering Action Group [goToCreateProduct] GoToCreateProductPageActionGroup");
		$I->click(".action-toggle.primary.add"); // stepKey: clickAddProductToggleGoToCreateProduct
		$I->waitForPageLoad(30); // stepKey: clickAddProductToggleGoToCreateProductWaitForPageLoad
		$I->waitForElementVisible(".item[data-ui-id='products-list-add-new-product-button-item-simple']", 30); // stepKey: waitForAddProductDropdownGoToCreateProduct
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-simple']"); // stepKey: clickAddProductTypeGoToCreateProduct
		$I->waitForPageLoad(30); // stepKey: waitForCreateProductPageLoadGoToCreateProduct
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/simple/"); // stepKey: seeNewProductUrlGoToCreateProduct
		$I->see("New Product", ".page-header h1.page-title"); // stepKey: seeNewProductTitleGoToCreateProduct
		$I->comment("Exiting Action Group [goToCreateProduct] GoToCreateProductPageActionGroup");
		$I->comment("Entering Action Group [openAddProductVideoModal] AdminOpenProductVideoModalActionGroup");
		$I->scrollTo("div[data-index=gallery] .admin__collapsible-title", 0, -100); // stepKey: scrollToAreaOpenAddProductVideoModal
		$I->conditionalClick("div[data-index=gallery] .admin__collapsible-title", "div.image div.fileinput-button", false); // stepKey: openProductVideoSectionOpenAddProductVideoModal
		$I->waitForElementVisible("#add_video_button", 30); // stepKey: waitForAddVideoButtonVisibleOpenAddProductVideoModal
		$I->waitForPageLoad(60); // stepKey: waitForAddVideoButtonVisibleOpenAddProductVideoModalWaitForPageLoad
		$I->click("#add_video_button"); // stepKey: addVideoOpenAddProductVideoModal
		$I->waitForPageLoad(60); // stepKey: addVideoOpenAddProductVideoModalWaitForPageLoad
		$I->waitForElementVisible(".modal-slide.mage-new-video-dialog.form-inline._show", 30); // stepKey: waitForUrlElementVisibleslideOpenAddProductVideoModal
		$I->waitForElementVisible("#video_url", 60); // stepKey: waitForUrlElementVisibleOpenAddProductVideoModal
		$I->comment("Exiting Action Group [openAddProductVideoModal] AdminOpenProductVideoModalActionGroup");
		$I->comment("Entering Action Group [clickOnGetVideoInformation] AdminGetVideoInformationActionGroup");
		$I->click("#new_video_get"); // stepKey: getVideoInformationClickOnGetVideoInformation
		$I->comment("Exiting Action Group [clickOnGetVideoInformation] AdminGetVideoInformationActionGroup");
		$I->comment("Entering Action Group [seeUrlValidationMessage] AssertAdminVideoValidationErrorActionGroup");
		$I->see("This is a required field.", "#video_url-error"); // stepKey: seeElementValidationErrorSeeUrlValidationMessage
		$I->comment("Exiting Action Group [seeUrlValidationMessage] AssertAdminVideoValidationErrorActionGroup");
		$I->comment("Entering Action Group [fillVideoUrlField] AdminFillProductVideoFieldActionGroup");
		$I->fillField("#video_url", "https://youtu.be/bpOSxM0rNPM"); // stepKey: fillVideoFieldFillVideoUrlField
		$I->comment("Exiting Action Group [fillVideoUrlField] AdminFillProductVideoFieldActionGroup");
		$I->comment("Entering Action Group [clickOnGetVideoInformation2] AdminGetVideoInformationActionGroup");
		$I->click("#new_video_get"); // stepKey: getVideoInformationClickOnGetVideoInformation2
		$I->comment("Exiting Action Group [clickOnGetVideoInformation2] AdminGetVideoInformationActionGroup");
		$I->comment("Entering Action Group [dontSeeUrlValidationMessage] AdminAssertVideoNoValidationErrorActionGroup");
		$I->dontSeeElement("#video_url-error"); // stepKey: seeElementValidationErrorDontSeeUrlValidationMessage
		$I->comment("Exiting Action Group [dontSeeUrlValidationMessage] AdminAssertVideoNoValidationErrorActionGroup");
	}
}
