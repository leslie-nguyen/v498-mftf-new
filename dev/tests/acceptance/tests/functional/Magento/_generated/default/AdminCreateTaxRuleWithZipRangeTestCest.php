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
 * @Title("MC-5326: Create tax rule, with zip range")
 * @Description("Test log in to Create Tax Rule and Create tax rule with Zip Range<h3>Test files</h3>vendor\magento\module-tax\Test\Mftf\Test\AdminCreateTaxRuleWithZipRangeTest.xml<br>")
 * @TestCaseId("MC-5326")
 * @group tax
 * @group mtf_migrated
 */
class AdminCreateTaxRuleWithZipRangeTestCest
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
		$I->createEntity("taxRateWithZipRange", "hook", "defaultTaxRateWithZipRange", [], []); // stepKey: taxRateWithZipRange
		$I->createEntity("createCustomerTaxClass", "hook", "customerTaxClass", [], []); // stepKey: createCustomerTaxClass
		$I->createEntity("createProductTaxClass", "hook", "productTaxClass", [], []); // stepKey: createProductTaxClass
		$I->getEntity("customerTaxClass", "hook", "customerTaxClass", ["createCustomerTaxClass"], null); // stepKey: customerTaxClass
		$I->getEntity("productTaxClass", "hook", "productTaxClass", ["createProductTaxClass"], null); // stepKey: productTaxClass
		$I->comment("Entering Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [LoginAsAdmin] AdminLoginActionGroup");
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
		$I->deleteEntity("taxRateWithZipRange", "hook"); // stepKey: deleteTaxRate
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
	 * @Stories({"Create tax rule"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Tax"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateTaxRuleWithZipRangeTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/tax/rule"); // stepKey: goToTaxRuleGridPageGoToTaxRuleIndex1
		$I->waitForPageLoad(30); // stepKey: waitForTaxRulePageGoToTaxRuleIndex1
		$I->comment("Exiting Action Group [goToTaxRuleIndex1] AdminTaxRuleGridOpenPageActionGroup");
		$I->click("#add"); // stepKey: clickAddNewTaxRuleButton
		$I->waitForPageLoad(30); // stepKey: clickAddNewTaxRuleButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleIndex2
		$I->comment("Create a tax rule with new tax classes and tax rate");
		$I->fillField("#code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: fillTaxRuleCode1
		$I->fillField("input[data-role='advanced-select-text']", $I->retrieveEntityField('taxRateWithZipRange', 'code', 'test')); // stepKey: fillTaxRateSearch
		$I->wait(5); // stepKey: waitForSearch
		$I->click("//*[@data-ui-id='tax-rate-form-fieldset-element-form-field-tax-rate']//span[.='" . $I->retrieveEntityField('taxRateWithZipRange', 'code', 'test') . "']"); // stepKey: clickSelectNeededItem
		$I->fillField("input[data-role='advanced-select-text']", "US-CA-*-Rate 1"); // stepKey: fillTaxRateSearch1
		$I->wait(5); // stepKey: waitForSearch2
		$I->conditionalClick("//*[@data-ui-id='tax-rate-form-fieldset-element-form-field-tax-rate']//span[.='US-CA-*-Rate 1']", "//span[contains(., 'US-CA-*-Rate 1') and preceding-sibling::input[contains(@class, 'mselect-checked')]]", false); // stepKey: clickSelectNeededItem1
		$I->click("#details-summarybase_fieldset"); // stepKey: clickAdditionalSettings
		$I->waitForPageLoad(30); // stepKey: clickAdditionalSettingsWaitForPageLoad
		$I->scrollTo("#details-summarybase_fieldset", 0, -80); // stepKey: scrollToAdvancedSettings
		$I->waitForPageLoad(30); // stepKey: scrollToAdvancedSettingsWaitForPageLoad
		$I->wait(5); // stepKey: waitForAdditionalSettings
		$I->conditionalClick("//*[@id='tax_customer_class']/..//span[.='Retail Customer']", "//*[@id='tax_customer_class']/..//span[.='Retail Customer' and preceding-sibling::input[contains(@class, 'mselect-checked')]]", false); // stepKey: checkRetailCustomerTaxClass
		$I->conditionalClick("//*[@id='tax_product_class']/..//span[.='Taxable Goods']", "//*[@id='tax_product_class']/..//span[.='Taxable Goods' and preceding-sibling::input[contains(@class, 'mselect-checked')]]", false); // stepKey: checkTaxableGoodsTaxClass
		$I->click("//*[@id='tax_customer_class']/..//span[.='" . $I->retrieveEntityField('customerTaxClass', 'class_name', 'test') . "']"); // stepKey: clickSelectCustomerTaxClass
		$I->click("//*[@id='tax_product_class']/..//span[.='" . $I->retrieveEntityField('productTaxClass', 'class_name', 'test') . "']"); // stepKey: clickSelectProductTaxClass
		$I->fillField("#priority", "1"); // stepKey: fillPriority
		$I->click("#save"); // stepKey: clickSaveTaxRule
		$I->waitForPageLoad(30); // stepKey: clickSaveTaxRuleWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleSaved
		$I->comment("Verify we see success message");
		$I->see("You saved the tax rule.", "#messages"); // stepKey: seeAssertTaxRuleSuccessMessage
		$I->comment("Verify we see created tax rule with zip range(from the above step) on the tax rule grid page");
		$I->click(".admin__data-grid-header [data-action='grid-filter-reset']"); // stepKey: clickClearFilters2
		$I->waitForPageLoad(30); // stepKey: clickClearFilters2WaitForPageLoad
		$I->fillField("#taxRuleGrid_filter_code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: fillTaxRuleCode2
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch2
		$I->waitForPageLoad(30); // stepKey: clickSearch2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForTaxRuleSearch
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: clickFirstRow2
		$I->waitForPageLoad(30); // stepKey: clickFirstRow2WaitForPageLoad
		$I->comment("Verify we see created tax rule with zip range on the tax rule form page");
		$I->seeInField("#code", "TaxRule" . msq("SimpleTaxRule")); // stepKey: seeInTaxRuleCode
		$I->seeElement("//span[contains(., '" . $I->retrieveEntityField('taxRateWithZipRange', 'code', 'test') . "') and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeTaxRateSelected
		$I->seeElement("//span[contains(., 'US-CA-*-Rate 1') and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeSelectNeededItem1
		$I->click("#details-summarybase_fieldset"); // stepKey: clickAdditionalSettings1
		$I->waitForPageLoad(30); // stepKey: clickAdditionalSettings1WaitForPageLoad
		$I->scrollTo("#details-summarybase_fieldset", 0, -80); // stepKey: scrollToAdvancedSettings1
		$I->waitForPageLoad(30); // stepKey: scrollToAdvancedSettings1WaitForPageLoad
		$I->seeElement("//*[@id='tax_customer_class']/..//span[.='" . $I->retrieveEntityField('customerTaxClass', 'class_name', 'test') . "' and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeCustomerTaxClass
		$I->seeElement("//*[@id='tax_customer_class']/..//span[.='Retail Customer' and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeRetailCustomerTaxClass
		$I->seeElement("//*[@id='tax_product_class']/..//span[.='" . $I->retrieveEntityField('productTaxClass', 'class_name', 'test') . "' and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeProductTaxClass
		$I->seeElement("//*[@id='tax_product_class']/..//span[.='Taxable Goods' and preceding-sibling::input[contains(@class, 'mselect-checked')]]"); // stepKey: seeTaxableGoodsTaxClass
		$I->seeInField("#priority", "1"); // stepKey: seePriority
	}
}
