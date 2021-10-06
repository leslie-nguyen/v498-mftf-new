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
 * @Title("MC-5318: Create tax rate, all postcodes")
 * @Description("Tests log into Create tax rate and create all postcodes<h3>Test files</h3>vendor\magento\module-tax\Test\Mftf\Test\AdminCreateTaxRateAllPostCodesTest.xml<br>")
 * @TestCaseId("MC-5318")
 * @group tax
 * @group mtf_migrated
 */
class AdminCreateTaxRateAllPostCodesTestCest
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
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [goToTaxRateIndex] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRateIndex
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRateIndex
		$I->comment("Exiting Action Group [goToTaxRateIndex] AdminTaxRateGridOpenPageActionGroup");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters2
		$I->waitForPageLoad(30); // stepKey: clickClearFilters2WaitForPageLoad
		$I->fillField("#tax_rate_grid_filter_code", "TaxRate" . msq("SimpleTaxRate")); // stepKey: fillNameFilter
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch
		$I->waitForPageLoad(30); // stepKey: clickSearchWaitForPageLoad
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRow
		$I->waitForPageLoad(30); // stepKey: clickFirstRowWaitForPageLoad
		$I->click("#delete"); // stepKey: clickDeleteRate
		$I->waitForPageLoad(30); // stepKey: clickDeleteRateWaitForPageLoad
		$I->click("button.action-primary.action-accept"); // stepKey: clickOk
		$I->waitForPageLoad(30); // stepKey: clickOkWaitForPageLoad
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
	 * @Stories({"Create tax rate"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Tax"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateTaxRateAllPostCodesTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [goToTaxRateIndex1] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRateIndex1
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRateIndex1
		$I->comment("Exiting Action Group [goToTaxRateIndex1] AdminTaxRateGridOpenPageActionGroup");
		$I->comment("Create a tax rate with * for postcodes");
		$I->click("#add"); // stepKey: clickAddNewTaxRateButton
		$I->waitForPageLoad(30); // stepKey: clickAddNewTaxRateButtonWaitForPageLoad
		$I->fillField("#code", "TaxRate" . msq("SimpleTaxRate")); // stepKey: fillRuleName
		$I->fillField("#tax_postcode", "*"); // stepKey: fillPostCode
		$I->selectOption("#tax_country_id", "Australia"); // stepKey: selectCountry1
		$I->fillField("#rate", "20"); // stepKey: fillRate
		$I->click("#save"); // stepKey: clickSave
		$I->waitForPageLoad(30); // stepKey: clickSaveWaitForPageLoad
		$I->see("You saved the tax rate.", "#messages div.message-success"); // stepKey: seeSuccess
		$I->comment("Verify the tax rate grid page shows the tax rate we just created");
		$I->comment("Entering Action Group [goToTaxRateIndex2] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRateIndex2
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRateIndex2
		$I->comment("Exiting Action Group [goToTaxRateIndex2] AdminTaxRateGridOpenPageActionGroup");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters1
		$I->waitForPageLoad(30); // stepKey: clickClearFilters1WaitForPageLoad
		$I->fillField("#tax_rate_grid_filter_code", "TaxRate" . msq("SimpleTaxRate")); // stepKey: fillNameFilter
		$I->selectOption("#tax_rate_grid_filter_tax_country_id", "Australia"); // stepKey: fillCountryFilter
		$I->fillField("#tax_rate_grid_filter_tax_postcode", "*"); // stepKey: fillPostCodeFilter
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch
		$I->waitForPageLoad(30); // stepKey: clickSearchWaitForPageLoad
		$I->see("TaxRate" . msq("SimpleTaxRate"), "#tax_rate_grid"); // stepKey: seeRuleName
		$I->see("Australia", "#tax_rate_grid"); // stepKey: seeCountry
		$I->see("*", "#tax_rate_grid"); // stepKey: seePostCode
		$I->comment("Go to the tax rate edit page for our new tax rate");
		$I->comment("Entering Action Group [goToTaxRateIndex3] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRateIndex3
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRateIndex3
		$I->comment("Exiting Action Group [goToTaxRateIndex3] AdminTaxRateGridOpenPageActionGroup");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters2
		$I->waitForPageLoad(30); // stepKey: clickClearFilters2WaitForPageLoad
		$I->fillField("#tax_rate_grid_filter_code", "TaxRate" . msq("SimpleTaxRate")); // stepKey: fillNameFilter2
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch2
		$I->waitForPageLoad(30); // stepKey: clickSearch2WaitForPageLoad
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRow
		$I->waitForPageLoad(30); // stepKey: clickFirstRowWaitForPageLoad
		$I->comment("Verify we see expected values on the tax rate edit page");
		$I->seeInField("#code", "TaxRate" . msq("SimpleTaxRate")); // stepKey: seeRuleName2
		$I->seeInField("#tax_postcode", "*"); // stepKey: seeZipCode
		$I->seeOptionIsSelected("#tax_country_id", "Australia"); // stepKey: seeCountry2
		$I->seeInField("#rate", "20.0000"); // stepKey: seeRate
		$I->comment("Go to the tax rule grid page and verify our tax rate can be used in the rule");
		$I->comment("Entering Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageGoToTaxRuleIndex1
		$I->waitForPageLoad(30); // stepKey: waitForTaxRulePageGoToTaxRuleIndex1
		$I->comment("Exiting Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->click("#add"); // stepKey: clickAddNewTaxRule
		$I->waitForPageLoad(30); // stepKey: clickAddNewTaxRuleWaitForPageLoad
		$I->see("TaxRate" . msq("SimpleTaxRate"), ".mselect-list-item"); // stepKey: seeTaxRateOnNewTaxRulePage
	}
}
