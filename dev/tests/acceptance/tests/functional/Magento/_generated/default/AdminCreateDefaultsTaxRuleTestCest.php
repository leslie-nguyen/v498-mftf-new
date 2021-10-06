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
 * @Title("MC-5323: Create tax rule, defaults")
 * @Description("Test log in to Create Tax Rule and Create Defaults Tax Rule<h3>Test files</h3>vendor\magento\module-tax\Test\Mftf\Test\AdminCreateDefaultsTaxRuleTest.xml<br>")
 * @TestCaseId("MC-5323")
 * @group tax
 * @group mtf_migrated
 */
class AdminCreateDefaultsTaxRuleTestCest
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
		$I->createEntity("initialTaxRate", "hook", "defaultTaxRate", [], []); // stepKey: initialTaxRate
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
		$I->comment("Entering Action Group [deleteTaxRule] AdminDeleteTaxRule");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageDeleteTaxRule
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1DeleteTaxRule
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFiltersDeleteTaxRule
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersDeleteTaxRuleWaitForPageLoad
		$I->fillField("#taxRuleGrid_filter_code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: fillTaxRuleCodeDeleteTaxRule
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearchDeleteTaxRule
		$I->waitForPageLoad(30); // stepKey: clickSearchDeleteTaxRuleWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleSearchDeleteTaxRule
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRowDeleteTaxRule
		$I->waitForPageLoad(30); // stepKey: clickFirstRowDeleteTaxRuleWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadDeleteTaxRule
		$I->click("#delete"); // stepKey: clickDeleteRuleDeleteTaxRule
		$I->waitForPageLoad(30); // stepKey: clickDeleteRuleDeleteTaxRuleWaitForPageLoad
		$I->click("button.action-primary.action-accept"); // stepKey: clickOkDeleteTaxRule
		$I->waitForPageLoad(30); // stepKey: clickOkDeleteTaxRuleWaitForPageLoad
		$I->comment("Exiting Action Group [deleteTaxRule] AdminDeleteTaxRule");
		$I->deleteEntity("initialTaxRate", "hook"); // stepKey: deleteTaxRate
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
	 * @Stories({"Create tax rule"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Tax"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateDefaultsTaxRuleTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageGoToTaxRuleIndex1
		$I->waitForPageLoad(30); // stepKey: waitForTaxRulePageGoToTaxRuleIndex1
		$I->comment("Exiting Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->click("#add"); // stepKey: clickAddNewTaxRuleButton
		$I->waitForPageLoad(30); // stepKey: clickAddNewTaxRuleButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleIndex2
		$I->comment("Create a tax rule with defaults");
		$I->fillField("#code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: fillTaxRuleCode1
		$I->fillField("input[data-role='advanced-select-text']", $I->retrieveEntityField('initialTaxRate', 'code', 'test')); // stepKey: fillTaxRateSearch
		$I->wait(5); // stepKey: waitForSearch
		$I->click("//*[@data-ui-id='tax-rate-form-fieldset-element-form-field-tax-rate']//span[.='" . $I->retrieveEntityField('initialTaxRate', 'code', 'test') . "']"); // stepKey: selectNeededItem
		$I->click("#save"); // stepKey: saveTaxRule
		$I->waitForPageLoad(30); // stepKey: saveTaxRuleWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleSaved
		$I->comment("Verify we see success message");
		$I->see("You saved the tax rule.", "#messages"); // stepKey: assertTaxRuleSuccessMessage
		$I->comment("Verify we see created tax rule with defaults(from the above step) on the tax rule grid page");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters2
		$I->waitForPageLoad(30); // stepKey: clickClearFilters2WaitForPageLoad
		$I->fillField("#taxRuleGrid_filter_code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: fillTaxRuleCode2
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch2
		$I->waitForPageLoad(30); // stepKey: clickSearch2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleSearch
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRow2
		$I->waitForPageLoad(30); // stepKey: clickFirstRow2WaitForPageLoad
		$I->comment("Verify we see created tax rule with defaults on the tax rule form page");
		$I->seeInField("#code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: seeInTaxRuleField
		$I->seeElement("//span[contains(., '" . $I->retrieveEntityField('initialTaxRate', 'code', 'test') . "') and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeTaxRateSelected
	}
}
