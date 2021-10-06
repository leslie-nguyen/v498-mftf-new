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
 * @Title("MAGETWO-96133: Checking country drop-down with one allowed country")
 * @Description("Check country drop-down with one allowed country<h3>Test files</h3>vendor\magento\module-config\Test\Mftf\Test\CheckingCountryDropDownWithOneAllowedCountryTest.xml<br>")
 * @TestCaseId("MAGETWO-96133")
 * @group configuration
 */
class CheckingCountryDropDownWithOneAllowedCountryTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->createEntity("setAllowedCountries", "hook", "EnableAdminAccountAllowCountry", [], []); // stepKey: setAllowedCountries
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->createEntity("setDefaultValueForAllowCountries", "hook", "DisableAdminAccountAllowCountry", [], []); // stepKey: setDefaultValueForAllowCountries
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->comment("Entering Action Group [deleteCustomer] AdminDeleteCustomerActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/customer/index/"); // stepKey: navigateToCustomersPageDeleteCustomer
		$I->conditionalClick(".admin__data-grid-header .action-tertiary.action-clear", ".admin__data-grid-header .action-tertiary.action-clear", true); // stepKey: clickClearFiltersDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersDeleteCustomerWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForFiltersClearDeleteCustomer
		$I->click("#container > div > div.admin__data-grid-header > div:nth-child(1) > div.data-grid-filters-actions-wrap > div > button"); // stepKey: openFiltersDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: openFiltersDeleteCustomerWaitForPageLoad
		$I->fillField("input[name=email]", msq("CustomerEntityOne") . "test@email.com"); // stepKey: fillEmailDeleteCustomer
		$I->click("button[data-action=grid-filter-apply]"); // stepKey: clickApplyFiltersDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: clickApplyFiltersDeleteCustomerWaitForPageLoad
		$I->click("//*[contains(text(),'" . msq("CustomerEntityOne") . "test@email.com')]/parent::td/preceding-sibling::td/label[@class='data-grid-checkbox-cell-inner']//input"); // stepKey: chooseCustomerDeleteCustomer
		$I->click(".action-select"); // stepKey: openActionsDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: waitActionsDeleteCustomer
		$I->click("//*[contains(@class, 'admin__data-grid-header')]//span[contains(@class,'action-menu-item') and text()='Delete']"); // stepKey: deleteDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: waitForConfirmationAlertDeleteCustomer
		$I->click("//button[@data-role='action']//span[text()='OK']"); // stepKey: acceptDeleteCustomer
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForSuccessMessageDeleteCustomer
		$I->see("A total of 1 record(s) were deleted.", "#messages div.message-success"); // stepKey: seeSuccessMessageDeleteCustomer
		$I->waitForPageLoad(30); // stepKey: waitForCustomersGridIsLoadedDeleteCustomer
		$I->comment("Exiting Action Group [deleteCustomer] AdminDeleteCustomerActionGroup");
		$I->comment("Entering Action Group [clearFilters] AdminClearCustomersFiltersActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/customer/index/"); // stepKey: amOnCustomersPageClearFilters
		$I->waitForPageLoad(30); // stepKey: WaitForPageToLoadClearFilters
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clickOnButtonToRemoveFiltersIfPresentClearFilters
		$I->waitForPageLoad(30); // stepKey: clickOnButtonToRemoveFiltersIfPresentClearFiltersWaitForPageLoad
		$I->comment("Exiting Action Group [clearFilters] AdminClearCustomersFiltersActionGroup");
		$I->waitForPageLoad(30); // stepKey: WaitForPageToLoad
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
	 * @Features({"Config"})
	 * @Stories({"MAGETWO-96107: Additional blank option in country dropdown"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CheckingCountryDropDownWithOneAllowedCountryTest(AcceptanceTester $I)
	{
		$I->comment("Flush Magento Cache");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Create a customer account from Storefront");
		$I->comment("Entering Action Group [openCreateAccountPage] StorefrontOpenCustomerAccountCreatePageActionGroup");
		$I->amOnPage("/customer/account/create/"); // stepKey: goToCustomerAccountCreatePageOpenCreateAccountPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadedOpenCreateAccountPage
		$I->comment("Exiting Action Group [openCreateAccountPage] StorefrontOpenCustomerAccountCreatePageActionGroup");
		$I->comment("Entering Action Group [fillCreateAccountForm] StorefrontFillCustomerAccountCreationFormActionGroup");
		$I->fillField("#firstname", "John"); // stepKey: fillFirstNameFillCreateAccountForm
		$I->fillField("#lastname", "Doe"); // stepKey: fillLastNameFillCreateAccountForm
		$I->fillField("#email_address", msq("CustomerEntityOne") . "test@email.com"); // stepKey: fillEmailFillCreateAccountForm
		$I->fillField("#password", "pwdTest123!"); // stepKey: fillPasswordFillCreateAccountForm
		$I->fillField("#password-confirmation", "pwdTest123!"); // stepKey: fillConfirmPasswordFillCreateAccountForm
		$I->comment("Exiting Action Group [fillCreateAccountForm] StorefrontFillCustomerAccountCreationFormActionGroup");
		$I->comment("Entering Action Group [submitCreateAccountForm] StorefrontClickCreateAnAccountCustomerAccountCreationFormActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForCreateAccountButtonIsActiveSubmitCreateAccountForm
		$I->click("button.action.submit.primary"); // stepKey: clickCreateAccountButtonSubmitCreateAccountForm
		$I->waitForPageLoad(30); // stepKey: clickCreateAccountButtonSubmitCreateAccountFormWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerSavedSubmitCreateAccountForm
		$I->comment("Exiting Action Group [submitCreateAccountForm] StorefrontClickCreateAnAccountCustomerAccountCreationFormActionGroup");
		$I->comment("Entering Action Group [seeSuccessMessage] AssertMessageCustomerCreateAccountActionGroup");
		$I->see("Thank you for registering with Main Website Store.", "#maincontent .message-success"); // stepKey: verifyMessageSeeSuccessMessage
		$I->comment("Exiting Action Group [seeSuccessMessage] AssertMessageCustomerCreateAccountActionGroup");
		$I->click("//a[text()='Address Book']"); // stepKey: goToAddressBook
		$I->click("#country"); // stepKey: clickToExpandCountryDropDown
		$I->see("United States", "#country"); // stepKey: seeSelectedCountry
		$I->dontSee("Brazil", "#country"); // stepKey: canNotSeeSelectedCountry
	}
}
