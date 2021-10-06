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
 * @Title("MC-10898: Admin should be able to create a Dropdown product attribute containing a single quote")
 * @Description("Admin should be able to create a Dropdown product attribute containing a single quote<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\CreateProductAttributeEntityTest\CreateProductAttributeEntityDropdownWithSingleQuoteTest.xml<br>")
 * @TestCaseId("MC-10898")
 * @group Catalog
 * @group mtf_migrated
 */
class CreateProductAttributeEntityDropdownWithSingleQuoteTestCest
{
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
		$I->comment("Entering Action Group [goToEditPage] NavigateToEditProductAttributeActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product_attribute"); // stepKey: navigateToProductAttributeGridGoToEditPage
		$I->fillField("#attributeGrid_filter_frontend_label", "attribute" . msq("dropdownProductAttributeWithQuote")); // stepKey: navigateToAttributeEditPage1GoToEditPage
		$I->click("button[data-action=grid-filter-apply]"); // stepKey: navigateToAttributeEditPage2GoToEditPage
		$I->waitForPageLoad(30); // stepKey: navigateToAttributeEditPage2GoToEditPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2GoToEditPage
		$I->click("//*[@id='attributeGrid_table']/tbody/tr[1]"); // stepKey: navigateToAttributeEditPage3GoToEditPage
		$I->waitForPageLoad(30); // stepKey: navigateToAttributeEditPage3GoToEditPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad3GoToEditPage
		$I->comment("Exiting Action Group [goToEditPage] NavigateToEditProductAttributeActionGroup");
		$I->click("#delete"); // stepKey: clickDelete
		$I->waitForPageLoad(30); // stepKey: clickDeleteWaitForPageLoad
		$I->click(".modal-popup.confirm .action-accept"); // stepKey: clickOk
		$I->waitForPageLoad(30); // stepKey: waitForDeletion
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
	 * @Features({"Catalog"})
	 * @Stories({"Create Product Attributes"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CreateProductAttributeEntityDropdownWithSingleQuoteTest(AcceptanceTester $I)
	{
		$I->comment("Navigate to Stores > Attributes > Product.");
		$I->comment("Entering Action Group [goToProductAttributes] AdminOpenProductAttributePageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product_attribute"); // stepKey: goToAttributePageGoToProductAttributes
		$I->waitForPageLoad(30); // stepKey: waitForAttributePageLoadGoToProductAttributes
		$I->comment("Exiting Action Group [goToProductAttributes] AdminOpenProductAttributePageActionGroup");
		$I->comment("Create new Product Attribute as TextField, with code and default value.");
		$I->comment("Entering Action Group [createAttribute] CreateProductAttributeActionGroup");
		$I->click("#add"); // stepKey: createNewAttributeCreateAttribute
		$I->fillField("#attribute_label", "attribute" . msq("dropdownProductAttributeWithQuote")); // stepKey: fillDefaultLabelCreateAttribute
		$I->selectOption("#frontend_input", "select"); // stepKey: checkInputTypeCreateAttribute
		$I->selectOption("#is_required", "No"); // stepKey: checkRequiredCreateAttribute
		$I->click("#save"); // stepKey: saveAttributeCreateAttribute
		$I->waitForPageLoad(30); // stepKey: saveAttributeCreateAttributeWaitForPageLoad
		$I->comment("Exiting Action Group [createAttribute] CreateProductAttributeActionGroup");
		$I->comment("Navigate to Product Attribute, add Product Option and Save - 1");
		$I->comment("Entering Action Group [goToEditPage1] NavigateToEditProductAttributeActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product_attribute"); // stepKey: navigateToProductAttributeGridGoToEditPage1
		$I->fillField("#attributeGrid_filter_frontend_label", "attribute" . msq("dropdownProductAttributeWithQuote")); // stepKey: navigateToAttributeEditPage1GoToEditPage1
		$I->click("button[data-action=grid-filter-apply]"); // stepKey: navigateToAttributeEditPage2GoToEditPage1
		$I->waitForPageLoad(30); // stepKey: navigateToAttributeEditPage2GoToEditPage1WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2GoToEditPage1
		$I->click("//*[@id='attributeGrid_table']/tbody/tr[1]"); // stepKey: navigateToAttributeEditPage3GoToEditPage1
		$I->waitForPageLoad(30); // stepKey: navigateToAttributeEditPage3GoToEditPage1WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad3GoToEditPage1
		$I->comment("Exiting Action Group [goToEditPage1] NavigateToEditProductAttributeActionGroup");
		$I->comment("Entering Action Group [createOption1] CreateAttributeDropdownNthOptionAsDefaultActionGroup");
		$I->click("#add_new_option_button"); // stepKey: clickAddOptionsCreateOption1
		$I->waitForPageLoad(30); // stepKey: clickAddOptionsCreateOption1WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForNewOptionCreateOption1
		$I->fillField("tbody[data-role='options-container'] tr:nth-child(1) td:nth-child(3) input", "opt1'Admin" . msq("dropdownProductAttributeWithQuote")); // stepKey: fillAdminCreateOption1
		$I->fillField("tbody[data-role='options-container'] tr:nth-child(1) td:nth-child(4) input", "opt1'Front" . msq("dropdownProductAttributeWithQuote")); // stepKey: fillStoreViewCreateOption1
		$I->checkOption("tbody[data-role='options-container'] tr:nth-child(1) .input-radio"); // stepKey: setAsDefaultCreateOption1
		$I->comment("Exiting Action Group [createOption1] CreateAttributeDropdownNthOptionAsDefaultActionGroup");
		$I->click("#save"); // stepKey: saveAttribute
		$I->waitForPageLoad(30); // stepKey: saveAttributeWaitForPageLoad
		$I->comment("Perform appropriate assertions against dropdownProductAttribute entity");
		$I->comment("Entering Action Group [goToEditPageForAssertions] NavigateToEditProductAttributeActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product_attribute"); // stepKey: navigateToProductAttributeGridGoToEditPageForAssertions
		$I->fillField("#attributeGrid_filter_frontend_label", "attribute" . msq("dropdownProductAttributeWithQuote")); // stepKey: navigateToAttributeEditPage1GoToEditPageForAssertions
		$I->click("button[data-action=grid-filter-apply]"); // stepKey: navigateToAttributeEditPage2GoToEditPageForAssertions
		$I->waitForPageLoad(30); // stepKey: navigateToAttributeEditPage2GoToEditPageForAssertionsWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2GoToEditPageForAssertions
		$I->click("//*[@id='attributeGrid_table']/tbody/tr[1]"); // stepKey: navigateToAttributeEditPage3GoToEditPageForAssertions
		$I->waitForPageLoad(30); // stepKey: navigateToAttributeEditPage3GoToEditPageForAssertionsWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad3GoToEditPageForAssertions
		$I->comment("Exiting Action Group [goToEditPageForAssertions] NavigateToEditProductAttributeActionGroup");
		$I->seeInField("#attribute_label", "attribute" . msq("dropdownProductAttributeWithQuote")); // stepKey: assertLabel
		$I->seeOptionIsSelected("#frontend_input", "Dropdown"); // stepKey: assertInputType
		$I->seeOptionIsSelected("#is_required", "No"); // stepKey: assertRequired
		$I->seeInField("#attribute_code", "attribute" . msq("dropdownProductAttributeWithQuote")); // stepKey: assertAttrCode
		$I->comment("Assert options are in order and with correct attributes");
		$I->seeInField("tbody[data-role='options-container'] tr:nth-child(1) td:nth-child(3) input", "opt1'Admin" . msq("dropdownProductAttributeWithQuote")); // stepKey: seeOption1Admin
		$I->seeInField("tbody[data-role='options-container'] tr:nth-child(1) td:nth-child(4) input", "opt1'Front" . msq("dropdownProductAttributeWithQuote")); // stepKey: seeOption1StoreView
		$I->seeCheckboxIsChecked("tbody[data-role='options-container'] tr:nth-child(1) .input-radio"); // stepKey: seeOption1Default
		$I->comment("Go to New Product page, add Attribute and check dropdown values");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/simple/"); // stepKey: goToCreateSimpleProductPage
		$I->comment("Entering Action Group [addAttributeToProduct] AddProductAttributeInProductModalActionGroup");
		$I->click("#addAttribute"); // stepKey: addAttributeAddAttributeToProduct
		$I->waitForPageLoad(30); // stepKey: addAttributeAddAttributeToProductWaitForPageLoad
		$I->conditionalClick(".product_form_product_form_add_attribute_modal .action-clear", ".product_form_product_form_add_attribute_modal .action-clear", true); // stepKey: clearFiltersAddAttributeToProduct
		$I->waitForPageLoad(30); // stepKey: clearFiltersAddAttributeToProductWaitForPageLoad
		$I->click(".product_form_product_form_add_attribute_modal button[data-action='grid-filter-expand']"); // stepKey: clickFiltersAddAttributeToProduct
		$I->waitForPageLoad(30); // stepKey: clickFiltersAddAttributeToProductWaitForPageLoad
		$I->fillField(".product_form_product_form_add_attribute_modal input[name='attribute_code']", "attribute" . msq("dropdownProductAttributeWithQuote")); // stepKey: fillCodeAddAttributeToProduct
		$I->click(".product_form_product_form_add_attribute_modal .admin__data-grid-filters-footer .action-secondary"); // stepKey: clickApplyAddAttributeToProduct
		$I->waitForPageLoad(30); // stepKey: clickApplyAddAttributeToProductWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForFiltersAddAttributeToProduct
		$I->checkOption(".product_form_product_form_add_attribute_modal .data-grid-checkbox-cell input"); // stepKey: checkAttributeAddAttributeToProduct
		$I->click(".product_form_product_form_add_attribute_modal .page-main-actions .action-primary"); // stepKey: addSelectedAddAttributeToProduct
		$I->waitForPageLoad(30); // stepKey: addSelectedAddAttributeToProductWaitForPageLoad
		$I->comment("Exiting Action Group [addAttributeToProduct] AddProductAttributeInProductModalActionGroup");
		$I->click("div[data-index='attributes']"); // stepKey: openAttributes
		$I->waitForPageLoad(30); // stepKey: openAttributesWaitForPageLoad
		$I->waitForElementVisible("div[data-index='attribute" . msq("dropdownProductAttributeWithQuote") . "'] .admin__field-control select", 30); // stepKey: waitforLabel
		$I->seeOptionIsSelected("div[data-index='attribute" . msq("dropdownProductAttributeWithQuote") . "'] .admin__field-control select", "opt1'Admin" . msq("dropdownProductAttributeWithQuote")); // stepKey: seeDefaultIsCorrect
		$I->see("opt1'Admin" . msq("dropdownProductAttributeWithQuote"), "div[data-index='attribute" . msq("dropdownProductAttributeWithQuote") . "'] .admin__field-control select"); // stepKey: seeOption1Available
	}
}
