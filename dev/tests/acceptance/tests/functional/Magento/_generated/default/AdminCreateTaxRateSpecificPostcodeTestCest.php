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
 * @Title("MC-5320: Create tax rate, specific postcode")
 * @Description("Test log in to Create Tax Rate and Create specific Postcode<h3>Test files</h3>vendor\magento\module-tax\Test\Mftf\Test\AdminCreateTaxRateSpecificPostcodeTest.xml<br>")
 * @TestCaseId("MC-5320")
 * @group tax
 * @group mtf_migrated
 */
class AdminCreateTaxRateSpecificPostcodeTestCest
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
	public function AdminCreateTaxRateSpecificPostcodeTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [goToTaxRateIndex1] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRateIndex1
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRateIndex1
		$I->comment("Exiting Action Group [goToTaxRateIndex1] AdminTaxRateGridOpenPageActionGroup");
		$I->click("#add"); // stepKey: clickAddNewTaxRateButton
		$I->waitForPageLoad(30); // stepKey: clickAddNewTaxRateButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRateIndex1
		$I->comment("Create a tax rate with specific postcode");
		$I->fillField("#code", "TaxRate" . msq("SimpleTaxRate")); // stepKey: fillTaxIdentifierField1
		$I->fillField("#tax_postcode", "180"); // stepKey: fillTaxPostCode
		$I->selectOption("#tax_country_id", "Canada"); // stepKey: selectCountry
		$I->selectOption("#tax_region_id", "*"); // stepKey: selectState
		$I->fillField("#rate", "25"); // stepKey: seeRate
		$I->click("#save"); // stepKey: clickSave
		$I->waitForPageLoad(30); // stepKey: clickSaveWaitForPageLoad
		$I->see("You saved the tax rate.", "#messages div.message-success"); // stepKey: seeSuccess
		$I->comment("Entering Action Group [goToTaxRateIndex2] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRateIndex2
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRateIndex2
		$I->comment("Exiting Action Group [goToTaxRateIndex2] AdminTaxRateGridOpenPageActionGroup");
		$I->comment("Verify the tax rate grid page shows the specific postcode we just created");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters1
		$I->waitForPageLoad(30); // stepKey: clickClearFilters1WaitForPageLoad
		$I->fillField("#tax_rate_grid_filter_code", "TaxRate" . msq("SimpleTaxRate")); // stepKey: fillTaxIdentifierField2
		$I->selectOption("#tax_rate_grid_filter_tax_country_id", "Canada"); // stepKey: fillCountryFilter
		$I->fillField("#tax_rate_grid_filter_tax_postcode", "180"); // stepKey: fillPostCodeFilter
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch
		$I->waitForPageLoad(30); // stepKey: clickSearchWaitForPageLoad
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRow1
		$I->waitForPageLoad(30); // stepKey: clickFirstRow1WaitForPageLoad
		$I->comment("Verify we see expected values on the tax rate form page");
		$I->seeInField("#code", "TaxRate" . msq("SimpleTaxRate")); // stepKey: seeTaxIdentifierField2
		$I->seeInField("#tax_postcode", "180"); // stepKey: seePostCode
		$I->seeInField("#tax_country_id", "Canada"); // stepKey: seeCountry2
		$I->comment("Verify we see expected values on the tax rule form page");
		$I->comment("Entering Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageGoToTaxRuleIndex1
		$I->waitForPageLoad(30); // stepKey: waitForTaxRulePageGoToTaxRuleIndex1
		$I->comment("Exiting Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->click("#add"); // stepKey: clickAdd
		$I->waitForPageLoad(30); // stepKey: clickAddWaitForPageLoad
		$I->see("TaxRate" . msq("SimpleTaxRate"), ".mselect-list-item"); // stepKey: seeTaxRateOnNewTaxRulePage
	}
}
