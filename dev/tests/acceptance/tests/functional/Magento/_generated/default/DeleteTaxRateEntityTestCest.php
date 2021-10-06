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
 * @Title("MC-5801: Delete tax rate")
 * @Description("Test log in to Tax Rate and Delete Tax Rate<h3>Test files</h3>vendor\magento\module-tax\Test\Mftf\Test\DeleteTaxRateEntityTest.xml<br>")
 * @TestCaseId("MC-5801")
 * @group tax
 * @group mtf_migrated
 */
class DeleteTaxRateEntityTestCest
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
	 * @Stories({"Delete Tax Rate"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Tax"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function DeleteTaxRateEntityTest(AcceptanceTester $I)
	{
		$I->comment("Search the tax rate on tax grid page");
		$I->comment("Entering Action Group [goToTaxRateIndex1] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRateIndex1
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRateIndex1
		$I->comment("Exiting Action Group [goToTaxRateIndex1] AdminTaxRateGridOpenPageActionGroup");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters1
		$I->waitForPageLoad(30); // stepKey: clickClearFilters1WaitForPageLoad
		$I->fillField("#tax_rate_grid_filter_code", $I->retrieveEntityField('initialTaxRate', 'code', 'test')); // stepKey: fillCode
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch1
		$I->waitForPageLoad(30); // stepKey: clickSearch1WaitForPageLoad
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRow1
		$I->waitForPageLoad(30); // stepKey: clickFirstRow1WaitForPageLoad
		$I->comment("Delete values on the tax rate form page");
		$I->click("#delete"); // stepKey: clickDeleteRate
		$I->waitForPageLoad(30); // stepKey: clickDeleteRateWaitForPageLoad
		$I->click("button.action-primary.action-accept"); // stepKey: clickOk
		$I->waitForPageLoad(30); // stepKey: clickOkWaitForPageLoad
		$I->see("You Deleted the tax rate.", "#messages div.message-success"); // stepKey: seeSuccess1
		$I->comment("Confirm Deleted TaxIdentifier(from the above step) on the tax rate grid page");
		$I->comment("Entering Action Group [goToTaxRateIndex2] AdminTaxRateGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rate/"); // stepKey: goToTaxRatePageGoToTaxRateIndex2
		$I->waitForPageLoad(30); // stepKey: waitForTaxRatePageGoToTaxRateIndex2
		$I->comment("Exiting Action Group [goToTaxRateIndex2] AdminTaxRateGridOpenPageActionGroup");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters2
		$I->waitForPageLoad(30); // stepKey: clickClearFilters2WaitForPageLoad
		$I->fillField("#tax_rate_grid_filter_code", "Tax Rate " . msq("defaultTaxRate")); // stepKey: fillTaxIdentifierField3
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch2
		$I->waitForPageLoad(30); // stepKey: clickSearch2WaitForPageLoad
		$I->see("We couldn't find any records.", ".empty-text"); // stepKey: seeSuccess
		$I->comment("Confirm Deleted TaxIdentifier on the tax rule grid page");
		$I->comment("Entering Action Group [goToTaxRuleIndex3] AdminTaxRuleGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageGoToTaxRuleIndex3
		$I->waitForPageLoad(30); // stepKey: waitForTaxRulePageGoToTaxRuleIndex3
		$I->comment("Exiting Action Group [goToTaxRuleIndex3] AdminTaxRuleGridOpenPageActionGroup");
		$I->click("#add"); // stepKey: clickAddNewTaxRuleButton
		$I->waitForPageLoad(30); // stepKey: clickAddNewTaxRuleButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleIndex1
		$I->fillField("input[data-role='advanced-select-text']", $I->retrieveEntityField('initialTaxRate', 'code', 'test')); // stepKey: fillTaxRateSearch
		$I->wait(5); // stepKey: waitForSearch
		$I->dontSee($I->retrieveEntityField('initialTaxRate', 'code', 'test'), "div.field-tax_rate"); // stepKey: dontSeeInTaxRuleForm
	}
}
