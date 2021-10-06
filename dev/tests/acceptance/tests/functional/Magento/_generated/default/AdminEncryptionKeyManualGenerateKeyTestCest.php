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
 * @Title("[NO TESTCASEID]: Change Encryption Key by Manual Key")
 * @Description("Change Encryption Key by Manual Key<h3>Test files</h3>vendor\magento\module-encryption-key\Test\Mftf\Test\AdminEncryptionKeyManualGenerateKeyTest.xml<br>")
 * @group encryption_key
 */
class AdminEncryptionKeyManualGenerateKeyTestCest
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
		$I->comment("Login to Admin Area");
		$I->comment("Entering Action Group [loginToAdminArea] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginToAdminArea
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginToAdminArea
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginToAdminArea
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginToAdminArea
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginToAdminAreaWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginToAdminArea
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginToAdminArea
		$I->comment("Exiting Action Group [loginToAdminArea] AdminLoginActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Logout from Admin Area");
		$I->comment("Entering Action Group [logoutOfAdmin] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageLogoutOfAdmin
		$I->comment("Exiting Action Group [logoutOfAdmin] AdminLogoutActionGroup");
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
	 * @Features({"EncryptionKey"})
	 * @Stories({"Change Encryption Key"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminEncryptionKeyManualGenerateKeyTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [navigateToPage] AdminEncryptionKeyNavigateToChangePageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/crypt_key/index"); // stepKey: navigateToChangeEncryptionPageNavigateToPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadNavigateToPage
		$I->comment("Exiting Action Group [navigateToPage] AdminEncryptionKeyNavigateToChangePageActionGroup");
		$I->comment("Entering Action Group [changeKeyManualGenerate] AdminEncryptionKeyChangeKeyManualActionGroup");
		$I->selectOption("#generate_random", "No"); // stepKey: selectGenerateModeChangeKeyManualGenerate
		$I->fillField("input#crypt_key", "9d469ae32ec27dfec0206cb5d63f135d"); // stepKey: fillCryptKeyChangeKeyManualGenerate
		$I->click(".page-actions-buttons #save"); // stepKey: clickChangeButtonChangeKeyManualGenerate
		$I->waitForPageLoad(10); // stepKey: clickChangeButtonChangeKeyManualGenerateWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadChangeKeyManualGenerate
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForSuccessMessageChangeKeyManualGenerate
		$I->see("The encryption key has been changed.", "#messages div.message-success"); // stepKey: seeSuccessMessageChangeKeyManualGenerate
		$I->comment("Exiting Action Group [changeKeyManualGenerate] AdminEncryptionKeyChangeKeyManualActionGroup");
	}
}
