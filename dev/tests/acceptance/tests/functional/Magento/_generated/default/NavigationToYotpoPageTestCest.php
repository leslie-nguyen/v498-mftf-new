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
 * @Title("MC-248: Navigation To Yotpo Page")
 * @Description("Test navigation To Yotpo Page<h3>Test files</h3>vendor\yotpo\magento2-module-yotpo-reviews\Test\Mftf\Test\NavigationToYotpoPageTest.xml<br>")
 * @TestCaseId("MC-248")
 * @group yotpo-navigation
 */
class NavigationToYotpoPageTestCest
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
	 * @Stories({"Navigation To Yotpo Page"})
	 * @Severity(level = SeverityLevel::MINOR)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function NavigationToYotpoPageTest(AcceptanceTester $I)
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
		$I->comment("Entering Action Group [navigateToStoresAllStoresPage] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToStoresAllStoresPage
		$I->click("li[data-ui-id='menu-magento-backend-stores']"); // stepKey: clickOnMenuItemNavigateToStoresAllStoresPage
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToStoresAllStoresPageWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-config-system-config']"); // stepKey: clickOnSubmenuItemNavigateToStoresAllStoresPage
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToStoresAllStoresPageWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToStoresAllStoresPage] AdminNavigateMenuActionGroup");
		$I->comment("Entering Action Group [switchStoreViewEnglishProduct] AdminSwitchStoreViewActionGroup");
		$I->click("#store-change-button"); // stepKey: clickStoreViewSwitchDropdownSwitchStoreViewEnglishProduct
		$I->waitForElementVisible("//*[contains(@class,'store-switcher-store-view')]/*[contains(text(), 'Default Store View')]", 30); // stepKey: waitForStoreViewsAreVisibleSwitchStoreViewEnglishProduct
		$I->waitForPageLoad(30); // stepKey: waitForStoreViewsAreVisibleSwitchStoreViewEnglishProductWaitForPageLoad
		$I->click("//*[contains(@class,'store-switcher-store-view')]/*[contains(text(), 'Default Store View')]"); // stepKey: clickStoreViewByNameSwitchStoreViewEnglishProduct
		$I->waitForPageLoad(30); // stepKey: clickStoreViewByNameSwitchStoreViewEnglishProductWaitForPageLoad
		$I->waitForElementVisible("aside.confirm .modal-footer button.action-accept", 30); // stepKey: waitingForInformationModalSwitchStoreViewEnglishProduct
		$I->waitForPageLoad(60); // stepKey: waitingForInformationModalSwitchStoreViewEnglishProductWaitForPageLoad
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmStoreSwitchSwitchStoreViewEnglishProduct
		$I->waitForPageLoad(60); // stepKey: confirmStoreSwitchSwitchStoreViewEnglishProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForStoreViewSwitchedSwitchStoreViewEnglishProduct
		$I->scrollToTopOfPage(); // stepKey: scrollToStoreSwitcherSwitchStoreViewEnglishProduct
		$I->see("Default Store View", ".store-switcher"); // stepKey: seeNewStoreViewNameSwitchStoreViewEnglishProduct
		$I->comment("Exiting Action Group [switchStoreViewEnglishProduct] AdminSwitchStoreViewActionGroup");
		$I->click("#system_config_tabs > div:nth-child(1) > div"); // stepKey: ClickOnGeneralMenu
		$I->waitForPageLoad(30); // stepKey: ClickOnGeneralMenuWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickOnGeneralMenu
		$I->seeElementInDOM("#system_config_tabs .yotpo-icon"); // stepKey: checkYotpoAppearsInTheMenu
		$I->waitForPageLoad(30); // stepKey: checkYotpoAppearsInTheMenuWaitForPageLoad
		$I->comment("open Yotpo main menu store configuration menu");
		$I->click("#system_config_tabs > div:nth-child(6) > div"); // stepKey: ClickOnYotpoMenu
		$I->waitForPageLoad(30); // stepKey: ClickOnYotpoMenuWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductPageLoad
		$I->comment("open Yotpo's sub menu 'Reviews and Visual Marketing' store configuration menu");
		$I->click("//a[contains(@class, 'item-nav')]//span[text()='Reviews and Visual Marketing']"); // stepKey: ClickOnReviewsMenu
		$I->waitForPageLoad(30); // stepKey: ClickOnReviewsMenuWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickOnReviewsMenu
		$I->comment("Check You see Yotpo page");
		$I->seeElement("//select[@id='yotpo_settings_active']"); // stepKey: seeWidgetIcon
		$I->waitForPageLoad(30); // stepKey: seeWidgetIconWaitForPageLoad
	}
}
