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
 * @Title("MC-5819: Update tax rule, tax rule default")
 * @Description("Test log in to Update tax rule and Update default tax rule<h3>Test files</h3>vendor\magento\module-tax\Test\Mftf\Test\AdminUpdateDefaultTaxRuleTest.xml<br>")
 * @TestCaseId("MC-5819")
 * @group tax
 * @group mtf_migrated
 */
class AdminUpdateDefaultTaxRuleTestCest
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
		$I->createEntity("initialTaxRule", "hook", "defaultTaxRule", [], []); // stepKey: initialTaxRule
		$I->createEntity("initialTaxRate", "hook", "defaultTaxRate", [], []); // stepKey: initialTaxRate
		$I->createEntity("createCustomerTaxClass", "hook", "customerTaxClass", [], []); // stepKey: createCustomerTaxClass
		$I->createEntity("createProductTaxClass", "hook", "productTaxClass", [], []); // stepKey: createProductTaxClass
		$I->getEntity("customerTaxClass", "hook", "customerTaxClass", ["createCustomerTaxClass"], null); // stepKey: customerTaxClass
		$I->getEntity("productTaxClass", "hook", "productTaxClass", ["createProductTaxClass"], null); // stepKey: productTaxClass
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
		$I->deleteEntity("initialTaxRule", "hook"); // stepKey: deleteTaxRule
		$I->deleteEntity("initialTaxRate", "hook"); // stepKey: deleteTaxRate
		$I->deleteEntity("createCustomerTaxClass", "hook"); // stepKey: deleteCustomerTaxClass
		$I->deleteEntity("createProductTaxClass", "hook"); // stepKey: deleteProductTaxClass
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
	 * @Stories({"Update tax rule"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Tax"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminUpdateDefaultTaxRuleTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageGoToTaxRuleIndex1
		$I->waitForPageLoad(30); // stepKey: waitForTaxRulePageGoToTaxRuleIndex1
		$I->comment("Exiting Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters1
		$I->waitForPageLoad(30); // stepKey: clickClearFilters1WaitForPageLoad
		$I->fillField("#taxRuleGrid_filter_code", $I->retrieveEntityField('initialTaxRule', 'code', 'test')); // stepKey: fillTaxCodeSearch
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch1
		$I->waitForPageLoad(30); // stepKey: clickSearch1WaitForPageLoad
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRow1
		$I->waitForPageLoad(30); // stepKey: clickFirstRow1WaitForPageLoad
		$I->comment("Update tax rule with default");
		$I->fillField("#code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: fillTaxRuleCode1
		$I->fillField("input[data-role='advanced-select-text']", $I->retrieveEntityField('initialTaxRate', 'code', 'test')); // stepKey: fillTaxRateSearch
		$I->wait(5); // stepKey: waitForSearch
		$I->click("//*[@data-ui-id='tax-rate-form-fieldset-element-form-field-tax-rate']//span[.='" . $I->retrieveEntityField('initialTaxRate', 'code', 'test') . "']"); // stepKey: clickSelectNeededItem
		$I->click("#details-summarybase_fieldset"); // stepKey: clickAdditionalSettings
		$I->waitForPageLoad(30); // stepKey: clickAdditionalSettingsWaitForPageLoad
		$I->scrollTo("#details-summarybase_fieldset", 0, -80); // stepKey: scrollToAdvancedSettings
		$I->waitForPageLoad(30); // stepKey: scrollToAdvancedSettingsWaitForPageLoad
		$I->wait(5); // stepKey: waitForAdditionalSettings
		$I->conditionalClick("//*[@id='tax_customer_class']/..//span[.='Retail Customer']", "//*[@id='tax_customer_class']/..//span[.='Retail Customer' and preceding-sibling::input[contains(@class, 'mselect-checked')]]", false); // stepKey: checkRetailCustomerTaxClass
		$I->conditionalClick("//*[@id='tax_product_class']/..//span[.='Taxable Goods']", "//*[@id='tax_product_class']/..//span[.='Taxable Goods' and preceding-sibling::input[contains(@class, 'mselect-checked')]]", false); // stepKey: checkTaxableGoodsTaxClass
		$I->click("//*[@id='tax_customer_class']/..//span[.='" . $I->retrieveEntityField('customerTaxClass', 'class_name', 'test') . "']"); // stepKey: clickSelectCustomerTaxClass
		$I->click("//*[@id='tax_product_class']/..//span[.='" . $I->retrieveEntityField('productTaxClass', 'class_name', 'test') . "']"); // stepKey: clickSelectProductTaxClass
		$I->fillField("#priority", "2"); // stepKey: fillPriority
		$I->fillField("#position", "2"); // stepKey: fillPosition
		$I->click("#save"); // stepKey: clickSaveTaxRule
		$I->waitForPageLoad(30); // stepKey: clickSaveTaxRuleWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleSaved
		$I->comment("Verify we see success message");
		$I->see("You saved the tax rule.", "#messages"); // stepKey: seeAssertTaxRuleSuccessMessage
		$I->comment("Verify we see updated tax rule with default(from the above step) on the tax rule grid page");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters2
		$I->waitForPageLoad(30); // stepKey: clickClearFilters2WaitForPageLoad
		$I->fillField("#taxRuleGrid_filter_code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: fillTaxRuleCode2
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch2
		$I->waitForPageLoad(30); // stepKey: clickSearch2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleSearch
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRow2
		$I->waitForPageLoad(30); // stepKey: clickFirstRow2WaitForPageLoad
		$I->comment("Verify we see updated tax rule with default on the tax rule form page");
		$I->seeInField("#code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: seeInTaxRuleCode
		$I->seeElement("//span[contains(., '" . $I->retrieveEntityField('initialTaxRate', 'code', 'test') . "') and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeTaxRateSelected
		$I->click("#details-summarybase_fieldset"); // stepKey: clickAdditionalSettings1
		$I->waitForPageLoad(30); // stepKey: clickAdditionalSettings1WaitForPageLoad
		$I->scrollTo("#details-summarybase_fieldset", 0, -80); // stepKey: scrollToAdvancedSettings1
		$I->waitForPageLoad(30); // stepKey: scrollToAdvancedSettings1WaitForPageLoad
		$I->seeElement("//*[@id='tax_customer_class']/..//span[.='" . $I->retrieveEntityField('customerTaxClass', 'class_name', 'test') . "' and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeCustomerTaxClass
		$I->seeElement("//*[@id='tax_product_class']/..//span[.='" . $I->retrieveEntityField('productTaxClass', 'class_name', 'test') . "' and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeProductTaxClass
		$I->seeInField("#priority", "2"); // stepKey: seePriority
		$I->seeInField("#position", "2"); // stepKey: seePosition
	}
}
