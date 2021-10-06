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
 * @Title("MC-5313: Create customer, with custom group")
 * @Description("Login as admin and create customer with custom group<h3>Test files</h3>vendor\magento\module-customer\Test\Mftf\Test\AdminCreateCustomerWithCustomGroupTest.xml<br>")
 * @TestCaseId("MC-5313")
 * @group mtf_migrated
 */
class AdminCreateCustomerWithCustomGroupTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->createEntity("customerGroup", "hook", "CustomCustomerGroup", [], []); // stepKey: customerGroup
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
		$I->comment("Entering Action Group [deleteCustomer] DeleteCustomerByEmailActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/customer/index/"); // stepKey: navigateToCustomersDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: waitForAdminCustomerPageLoadDeleteCustomer
		$I->click("#container > div > div.admin__data-grid-header > div:nth-child(1) > div.data-grid-filters-actions-wrap > div > button"); // stepKey: clickFilterButtonDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: clickFilterButtonDeleteCustomerWaitForPageLoad
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: cleanFiltersIfTheySetDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: cleanFiltersIfTheySetDeleteCustomerWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClearFiltersDeleteCustomer
		$I->fillField("input[name=email]", msq("CustomerEntityOne") . "test@email.com"); // stepKey: filterEmailDeleteCustomer
		$I->click("button[data-action=grid-filter-apply]"); // stepKey: applyFilterDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: applyFilterDeleteCustomerWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoadDeleteCustomer
		$I->click("//td[@class='data-grid-checkbox-cell']"); // stepKey: clickOnEditButton1DeleteCustomer
		$I->click("//div[@class='col-xs-2']/div[@class='action-select-wrap']/button[@class='action-select']"); // stepKey: clickActionsDropdownDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: clickActionsDropdownDeleteCustomerWaitForPageLoad
		$I->click("//*[contains(@class,'admin__data-grid-header-row row row-gutter')]//*[text()='Delete']"); // stepKey: clickDeleteDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: clickDeleteDeleteCustomerWaitForPageLoad
		$I->waitForElementVisible("//button[@data-role='action']//span[text()='OK']", 30); // stepKey: waitForOkToVisibleDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: waitForOkToVisibleDeleteCustomerWaitForPageLoad
		$I->click("//button[@data-role='action']//span[text()='OK']"); // stepKey: clickOkConfirmationButtonDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: clickOkConfirmationButtonDeleteCustomerWaitForPageLoad
		$I->waitForElementVisible("//*[@class='message message-success success']", 30); // stepKey: waitForSuccessfullyDeletedMessageDeleteCustomer
		$I->comment("Exiting Action Group [deleteCustomer] DeleteCustomerByEmailActionGroup");
		$I->deleteEntity("customerGroup", "hook"); // stepKey: deleteCustomerGroup
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
	 * @Stories({"Create customer"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Customer"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateCustomerWithCustomGroupTest(AcceptanceTester $I)
	{
		$I->comment("Open New Customer Page");
		$I->comment("Entering Action Group [navigateToNewCustomerPage] AdminNavigateNewCustomerActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/customer/index/new"); // stepKey: navigateToCustomersNavigateToNewCustomerPage
		$I->waitForPageLoad(30); // stepKey: waitForLoadNavigateToNewCustomerPage
		$I->comment("Exiting Action Group [navigateToNewCustomerPage] AdminNavigateNewCustomerActionGroup");
		$I->selectOption("[name='customer[group_id]']", $I->retrieveEntityField('customerGroup', 'code', 'test')); // stepKey: fillCustomerGroup
		$I->fillField("input[name='customer[firstname]']", "John"); // stepKey: fillFirstName
		$I->fillField("input[name='customer[lastname]']", "Doe"); // stepKey: fillLastName
		$I->fillField("input[name='customer[email]']", msq("CustomerEntityOne") . "test@email.com"); // stepKey: fillEmail
		$I->click("#save"); // stepKey: saveCustomer
		$I->waitForPageLoad(30); // stepKey: saveCustomerWaitForPageLoad
		$I->seeElement(".message-success"); // stepKey: assertSuccessMessage
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->reloadPage(); // stepKey: reloadPage
		$I->comment("Verify Customer in grid");
		$I->comment("Entering Action Group [filterTheCustomerByEmail1] AdminFilterCustomerByEmail");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/customer/index/"); // stepKey: openCustomerIndexPageFilterTheCustomerByEmail1
		$I->waitForPageLoad(30); // stepKey: waitToCustomerIndexPageToLoadFilterTheCustomerByEmail1
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openFiltersSectionOnCustomerIndexPageFilterTheCustomerByEmail1
		$I->waitForPageLoad(30); // stepKey: openFiltersSectionOnCustomerIndexPageFilterTheCustomerByEmail1WaitForPageLoad
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: cleanFiltersIfTheySetFilterTheCustomerByEmail1
		$I->waitForPageLoad(30); // stepKey: cleanFiltersIfTheySetFilterTheCustomerByEmail1WaitForPageLoad
		$I->fillField("input[name=email]", msq("CustomerEntityOne") . "test@email.com"); // stepKey: filterEmailFilterTheCustomerByEmail1
		$I->click("button[data-action=grid-filter-apply]"); // stepKey: applyFilterFilterTheCustomerByEmail1
		$I->waitForPageLoad(30); // stepKey: applyFilterFilterTheCustomerByEmail1WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoadFilterTheCustomerByEmail1
		$I->comment("Exiting Action Group [filterTheCustomerByEmail1] AdminFilterCustomerByEmail");
		$I->waitForPageLoad(30); // stepKey: waitForCustomerPageToLoad
		$I->see($I->retrieveEntityField('customerGroup', 'code', 'test'), "table[data-role='grid']"); // stepKey: assertGroup
		$I->see("John", "table[data-role='grid']"); // stepKey: assertFirstName
		$I->see("Doe", "table[data-role='grid']"); // stepKey: assertLastName
		$I->see(msq("CustomerEntityOne") . "test@email.com", "table[data-role='grid']"); // stepKey: assertEmail
		$I->comment("Assert Customer Form");
		$I->click("tr[data-repeat-index='0'] .action-menu-item"); // stepKey: clickOnEditButton1
		$I->waitForPageLoad(30); // stepKey: clickOnEditButton1WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerEditPageToLoad1
		$I->click("//a/span[text()='Account Information']"); // stepKey: clickOnAccountInformation
		$I->waitForPageLoad(30); // stepKey: waitForCustomerInformationPageToLoad
		$I->see($I->retrieveEntityField('customerGroup', 'code', 'test'), "//*[@name='customer[group_id]']/option"); // stepKey: seeCustomerGroup1
		$I->seeInField("input[name='customer[firstname]']", "John"); // stepKey: seeCustomerFirstName
		$I->seeInField("input[name='customer[lastname]']", "Doe"); // stepKey: seeCustomerLastName
		$I->seeInField("input[name='customer[email]']", msq("CustomerEntityOne") . "test@email.com"); // stepKey: seeCustomerEmail
	}
}
