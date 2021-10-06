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
 * @Title("MAGETWO-72095: Admin should be able to create a customer")
 * @Description("Admin should be able to create a customer<h3>Test files</h3>vendor\magento\module-customer\Test\Mftf\Test\AdminCreateCustomerTest.xml<br>")
 * @TestCaseId("MAGETWO-72095")
 * @group customer
 * @group create
 */
class AdminCreateCustomerTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [reindexCustomerGrid] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindexCustomerGrid = $I->magentoCLI("indexer:reindex", 60, "customer_grid"); // stepKey: reindexSpecifiedIndexersReindexCustomerGrid
		$I->comment($reindexSpecifiedIndexersReindexCustomerGrid);
		$I->comment("Exiting Action Group [reindexCustomerGrid] CliIndexerReindexActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [adminLogout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAdminLogout
		$I->comment("Exiting Action Group [adminLogout] AdminLogoutActionGroup");
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
	 * @Features({"Customer"})
	 * @Stories({"Create a Customer via the Admin"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateCustomerTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [loginAsAdmin1] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin1
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin1
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin1
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin1
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdmin1WaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin1
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin1
		$I->comment("Exiting Action Group [loginAsAdmin1] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/customer/index/"); // stepKey: navigateToCustomers
		$I->waitForPageLoad(30); // stepKey: waitForLoad1
		$I->click("#add"); // stepKey: clickCreateCustomer
		$I->waitForPageLoad(30); // stepKey: clickCreateCustomerWaitForPageLoad
		$I->fillField("input[name='customer[firstname]']", "John"); // stepKey: fillFirstName
		$I->fillField("input[name='customer[lastname]']", "Doe"); // stepKey: fillLastName
		$I->fillField("input[name='customer[email]']", msq("CustomerEntityOne") . "test@email.com"); // stepKey: fillEmail
		$I->click("#save"); // stepKey: saveCustomer
		$I->waitForPageLoad(30); // stepKey: saveCustomerWaitForPageLoad
		$I->seeElement(".message-success"); // stepKey: assertSuccessMessage
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->reloadPage(); // stepKey: reloadPage
		$I->waitForPageLoad(30); // stepKey: waitForLoad2
		$I->click("#container > div > div.admin__data-grid-header > div:nth-child(1) > div.data-grid-filters-actions-wrap > div > button"); // stepKey: openFilter
		$I->waitForPageLoad(30); // stepKey: openFilterWaitForPageLoad
		$I->fillField("input[name=email]", msq("CustomerEntityOne") . "test@email.com"); // stepKey: filterEmail
		$I->click("button[data-action=grid-filter-apply]"); // stepKey: applyFilter
		$I->waitForPageLoad(30); // stepKey: applyFilterWaitForPageLoad
		$I->see("John", "table[data-role='grid']"); // stepKey: assertFirstName
		$I->see("Doe", "table[data-role='grid']"); // stepKey: assertLastName
		$I->see(msq("CustomerEntityOne") . "test@email.com", "table[data-role='grid']"); // stepKey: assertEmail
	}
}
