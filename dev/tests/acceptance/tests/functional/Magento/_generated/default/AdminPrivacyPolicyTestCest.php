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
 * @Title("MC-17787: There should be a privacy policy url in the admin page and every sub page")
 * @Description("There should be a privacy policy url in the admin page and every sub page<h3>Test files</h3>vendor\magento\module-backend\Test\Mftf\Test\AdminPrivacyPolicyTest.xml<br>")
 * @TestCaseId("MC-17787")
 * @group backend
 * @group login
 */
class AdminPrivacyPolicyTestCest
{
	/**
	 * @Features({"Backend"})
	 * @Stories({"Checks to see if privacy policy url is in the admin page and every sub page"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminPrivacyPolicyTest(AcceptanceTester $I)
	{
		$I->comment("Logging in Magento admin and checking for Privacy policy footer in dashboard");
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->closeAdminNotification(); // stepKey: closeAdminNotification
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkDashboard
		$I->comment("Checking for Privacy policy footer in salesOrderPage");
		$I->comment("Entering Action Group [navigateToSalesOrder] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToSalesOrder
		$I->click("li[data-ui-id='menu-magento-sales-sales']"); // stepKey: clickOnMenuItemNavigateToSalesOrder
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToSalesOrderWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-sales-sales-order']"); // stepKey: clickOnSubmenuItemNavigateToSalesOrder
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToSalesOrderWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToSalesOrder] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkSalesOrder
		$I->comment("Checking for Privacy policy footer in catalogProductsPage");
		$I->comment("Entering Action Group [navigateToCatalogProducts] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToCatalogProducts
		$I->click("li[data-ui-id='menu-magento-catalog-catalog']"); // stepKey: clickOnMenuItemNavigateToCatalogProducts
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToCatalogProductsWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-catalog-catalog-products']"); // stepKey: clickOnSubmenuItemNavigateToCatalogProducts
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToCatalogProductsWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToCatalogProducts] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkCatalogProducts
		$I->comment("Checking for Privacy policy footer in customersAllCustomersPage");
		$I->comment("Entering Action Group [navigateToCustomersAllCustomers] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToCustomersAllCustomers
		$I->click("li[data-ui-id='menu-magento-customer-customer']"); // stepKey: clickOnMenuItemNavigateToCustomersAllCustomers
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToCustomersAllCustomersWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-customer-customer-manage']"); // stepKey: clickOnSubmenuItemNavigateToCustomersAllCustomers
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToCustomersAllCustomersWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToCustomersAllCustomers] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkCustomersAllCustomers
		$I->comment("Checking for Privacy policy footer in marketingCatalogPriceRulePage");
		$I->comment("Entering Action Group [navigateToMarketingCatalogPriceRule] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToMarketingCatalogPriceRule
		$I->click("li[data-ui-id='menu-magento-backend-marketing']"); // stepKey: clickOnMenuItemNavigateToMarketingCatalogPriceRule
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToMarketingCatalogPriceRuleWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-catalogrule-promo-catalog']"); // stepKey: clickOnSubmenuItemNavigateToMarketingCatalogPriceRule
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToMarketingCatalogPriceRuleWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToMarketingCatalogPriceRule] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkMarketingCatalogPriceRule
		$I->comment("Checking for Privacy policy footer in contentBlocksPage");
		$I->comment("Entering Action Group [navigateToContentBlocks] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToContentBlocks
		$I->click("li[data-ui-id='menu-magento-backend-content']"); // stepKey: clickOnMenuItemNavigateToContentBlocks
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToContentBlocksWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-cms-cms-block']"); // stepKey: clickOnSubmenuItemNavigateToContentBlocks
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToContentBlocksWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToContentBlocks] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkContentBlocks
		$I->comment("Checking for Privacy policy footer in reportSearcbTermsPage");
		$I->comment("Entering Action Group [navigateToReportsSearchTerms] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToReportsSearchTerms
		$I->click("li[data-ui-id='menu-magento-reports-report']"); // stepKey: clickOnMenuItemNavigateToReportsSearchTerms
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToReportsSearchTermsWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-search-report-search-term']"); // stepKey: clickOnSubmenuItemNavigateToReportsSearchTerms
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToReportsSearchTermsWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToReportsSearchTerms] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkReportsSearchTerms
		$I->comment("Checking for Privacy policy footer in storesAllStoresPage");
		$I->comment("Entering Action Group [navigateToStoresAllStores] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToStoresAllStores
		$I->click("li[data-ui-id='menu-magento-backend-stores']"); // stepKey: clickOnMenuItemNavigateToStoresAllStores
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToStoresAllStoresWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-backend-system-store']"); // stepKey: clickOnSubmenuItemNavigateToStoresAllStores
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToStoresAllStoresWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToStoresAllStores] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkStoresAllStores
		$I->comment("Checking for Privacy policy footer in systemImportPage");
		$I->comment("Entering Action Group [navigateToSystemImport] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToSystemImport
		$I->click("li[data-ui-id='menu-magento-backend-system']"); // stepKey: clickOnMenuItemNavigateToSystemImport
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToSystemImportWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-importexport-system-convert-import']"); // stepKey: clickOnSubmenuItemNavigateToSystemImport
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToSystemImportWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToSystemImport] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkSystemImport
		$I->comment("Checking for Privacy policy footer in findPartnersAndExtensionsPage");
		$I->comment("Entering Action Group [navigateToFindPartnersAndExtensions] AdminNavigateMenuActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitPageLoadNavigateToFindPartnersAndExtensions
		$I->click("li[data-ui-id='menu-magento-marketplace-partners']"); // stepKey: clickOnMenuItemNavigateToFindPartnersAndExtensions
		$I->waitForPageLoad(30); // stepKey: clickOnMenuItemNavigateToFindPartnersAndExtensionsWaitForPageLoad
		$I->click("li[data-ui-id='menu-magento-marketplace-partners']"); // stepKey: clickOnSubmenuItemNavigateToFindPartnersAndExtensions
		$I->waitForPageLoad(30); // stepKey: clickOnSubmenuItemNavigateToFindPartnersAndExtensionsWaitForPageLoad
		$I->comment("Exiting Action Group [navigateToFindPartnersAndExtensions] AdminNavigateMenuActionGroup");
		$I->seeLink("Privacy Policy", "https://magento.com/sites/default/files/REVISED-MAGENTO-PRIVACY-POLICY.pdf"); // stepKey: seePrivacyPolicyLinkFindPartnersAndExtensions
	}
}
