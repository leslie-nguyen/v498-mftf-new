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
 * @Title("https://app.hiptest.com/projects/131313/test-plan/folders/943908/scenarios/3216034: User configures Adobe Stock Integration")
 * @TestCaseId("https://app.hiptest.com/projects/131313/test-plan/folders/943908/scenarios/3216034")
 * @Description("Admin should be able to configure Adobe Stock Integration<h3>Test files</h3>vendor\magento\module-adobe-stock-admin-ui\Test\Mftf\Test\AdminAdobeStockConfigTest.xml<br>")
 * @group adobe_stock_integration_configuration
 */
class AdminAdobeStockConfigTestCest
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
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
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
	 * @Features({"AdobeStockAdminUi"})
	 * @Stories({"[Story #6] User configures Adobe Stock integration"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAdobeStockConfigTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [navigateToAdobeStockConfigurationFieldset] AdminOpenAdobeStockConfigActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_config/edit/section/system"); // stepKey: navigateToSystemConfigurationPageNavigateToAdobeStockConfigurationFieldset
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadNavigateToAdobeStockConfigurationFieldset
		$I->scrollTo("#system_adobe_stock_integration-head"); // stepKey: scrollToAdobeStockIntegrationSectionNavigateToAdobeStockConfigurationFieldset
		$I->conditionalClick("#system_adobe_stock_integration-head", "[data-ui-id='select-groups-adobe-stock-integration-fields-enabled-value']", false); // stepKey: expandAdobeStockIntegrationTabNavigateToAdobeStockConfigurationFieldset
		$I->comment("Exiting Action Group [navigateToAdobeStockConfigurationFieldset] AdminOpenAdobeStockConfigActionGroup");
		$I->comment("Entering Action Group [checkAdobeStockConfigurationFields] AssertAdminAdobeStockConfigFieldsActionGroup");
		$I->seeElement("[data-ui-id='select-groups-adobe-stock-integration-fields-enabled-value']"); // stepKey: seeIsEnabledFieldCheckAdobeStockConfigurationFields
		$I->seeElement("[data-ui-id='password-groups-adobe-stock-integration-fields-api-key-value']"); // stepKey: seeApiKeyFieldCheckAdobeStockConfigurationFields
		$I->seeElement("[data-ui-id='password-groups-adobe-stock-integration-fields-private-key-value']"); // stepKey: seePrivateKeyFieldCheckAdobeStockConfigurationFields
		$I->seeElement("[data-ui-id='adobe-stock-integration-buttons-test-connection']"); // stepKey: seeTestConnectionButtonCheckAdobeStockConfigurationFields
		$I->waitForPageLoad(30); // stepKey: seeTestConnectionButtonCheckAdobeStockConfigurationFieldsWaitForPageLoad
		$I->comment("Exiting Action Group [checkAdobeStockConfigurationFields] AssertAdminAdobeStockConfigFieldsActionGroup");
		$I->comment("Entering Action Group [testConnection] AssertAdminAdobeStockConnectionTestActionGroup");
		$I->fillField("[data-ui-id='password-groups-adobe-stock-integration-fields-api-key-value']", "blahblahblah"); // stepKey: enterIncorrectAdobeStockApiKeyTestConnection
		$I->click("[data-ui-id='adobe-stock-integration-buttons-test-connection']"); // stepKey: testConnectionTestConnection
		$I->waitForPageLoad(30); // stepKey: testConnectionTestConnectionWaitForPageLoad
		$I->see("Connection Failed!", "div.message-error"); // stepKey: seeConnectionFailedMethodTestConnection
		$I->fillSecretField("[data-ui-id='password-groups-adobe-stock-integration-fields-api-key-value']", $I->getSecret("magento/adobe_stock_api_key")); // stepKey: enterAdobeStockApiKeyTestConnection
		$I->click("[data-ui-id='adobe-stock-integration-buttons-test-connection']"); // stepKey: testConnection1TestConnection
		$I->waitForPageLoad(30); // stepKey: testConnection1TestConnectionWaitForPageLoad
		$I->see("Connection Successful!", "div.message-success"); // stepKey: seeConnectionSuccessfulMessageTestConnection
		$I->comment("Exiting Action Group [testConnection] AssertAdminAdobeStockConnectionTestActionGroup");
	}
}
