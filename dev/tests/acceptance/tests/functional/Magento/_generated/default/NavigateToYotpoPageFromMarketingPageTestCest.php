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
 * @Title("MC-248: Navigation To Yotpo Page From Magento Marketing Page")
 * @Description("Test navigation To Yotpo Page From Magento Marketing Page<h3>Test files</h3>vendor\yotpo\magento2-module-yotpo-reviews\Test\Mftf\Test\NavigateToYotpoPageFromMarketingPageTest.xml<br>")
 * @TestCaseId("MC-248")
 * @group magento-navigation-to-yotpo
 */
class NavigateToYotpoPageFromMarketingPageTestCest
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
	 * @Features({"Yotpo"})
	 * @Stories({"Navigation To Yotpo Page From Magento Marketing Page"})
	 * @Severity(level = SeverityLevel::MINOR)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function NavigateToYotpoPageFromMarketingPageTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [AdminLoginActionGroup] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminAdminLoginActionGroup
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameAdminLoginActionGroup
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordAdminLoginActionGroup
		$I->click(".actions .action-primary"); // stepKey: clickLoginAdminLoginActionGroup
		$I->waitForPageLoad(30); // stepKey: clickLoginAdminLoginActionGroupWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleAdminLoginActionGroup
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationAdminLoginActionGroup
		$I->comment("Exiting Action Group [AdminLoginActionGroup] AdminLoginActionGroup");
		$I->comment("Entering Action Group [enableYotpoPlugin] EnableYotpoPlugin");
		$I->amOnPage("admin/admin/system_config/edit/section/yotpo/store/1/"); // stepKey: navigateToYotpoConfigurationOnDefaultStoreViewEnableYotpoPlugin
		$I->comment("enable Yotpo plugin");
		$I->selectOption("//select[@id='yotpo_settings_active']", "1"); // stepKey: setYotpoAsActiveEnableYotpoPlugin
		$I->waitForPageLoad(30); // stepKey: setYotpoAsActiveEnableYotpoPluginWaitForPageLoad
		$I->seeOptionIsSelected("//select[@id='yotpo_settings_active']", "Yes"); // stepKey: seeYotpoEnabledEnableYotpoPlugin
		$I->waitForPageLoad(30); // stepKey: seeYotpoEnabledEnableYotpoPluginWaitForPageLoad
		$I->comment("set Yotpo credentials");
		$I->fillSecretField("input#yotpo_settings_app_key", $I->getSecret("yotpo_app_key")); // stepKey: fillAppKeyEnableYotpoPlugin
		$I->waitForPageLoad(30); // stepKey: fillAppKeyEnableYotpoPluginWaitForPageLoad
		$I->fillSecretField("input#yotpo_settings_secret", $I->getSecret("yotpo_secret")); // stepKey: fillSecretEnableYotpoPlugin
		$I->waitForPageLoad(30); // stepKey: fillSecretEnableYotpoPluginWaitForPageLoad
		$I->comment("save Yotpo configuration");
		$I->click("//span[text()='Save Config']"); // stepKey: ClickOnSaveConfigEnableYotpoPlugin
		$I->waitForPageLoad(30); // stepKey: ClickOnSaveConfigEnableYotpoPluginWaitForPageLoad
		$I->comment("Check that configuraion was saved");
		$I->waitForPageLoad(30); // stepKey: waitForSaveConfigEnableYotpoPlugin
		$I->seeElement("//div[text()='You saved the configuration.']"); // stepKey: checkConfigurationSavedEnableYotpoPlugin
		$I->waitForPageLoad(30); // stepKey: checkConfigurationSavedEnableYotpoPluginWaitForPageLoad
		$I->comment("Exiting Action Group [enableYotpoPlugin] EnableYotpoPlugin");
		$I->comment("Entering Action Group [navigateToYotpoReviewsFromMarketingMenu] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToYotpoReviewsFromMarketingMenu
		$I->click("li[data-ui-id='menu-magento-backend-marketing']"); // stepKey: clickOnMenuItemNavigateToYotpoReviewsFromMarketingMenu
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToYotpoReviewsFromMarketingMenuWaitForPageLoad
		$I->click("li[data-ui-id='menu-yotpo-yotpo-yotpo-report-reviews']"); // stepKey: clickOnSubmenuItemNavigateToYotpoReviewsFromMarketingMenu
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToYotpoReviewsFromMarketingMenuWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToYotpoReviewsFromMarketingMenu] AdminNavigateMenuActionGroup");
		$I->click("a.yotpo-settings"); // stepKey: ClickOnYotpoSettings
		$I->waitForPageLoad(30); // stepKey: ClickOnYotpoSettingsWaitForPageLoad
		$I->comment("Check You are now on Yotpo page and Yotpo is enabled");
		$I->seeElement("//select[@id='yotpo_settings_active']"); // stepKey: seeYotpoReviewTitle
		$I->waitForPageLoad(30); // stepKey: seeYotpoReviewTitleWaitForPageLoad
	}
}
