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
 * @Title("MC-6031: Create virtual product filling required fields only")
 * @Description("Test log in to Create virtual product and Create virtual product filling required fields only<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminCreateVirtualProductFillingRequiredFieldsOnlyTest.xml<br>")
 * @TestCaseId("MC-6031")
 * @group catalog
 * @group mtf_migrated
 */
class AdminCreateVirtualProductFillingRequiredFieldsOnlyTestCest
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
	 * @Stories({"Create virtual product"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateVirtualProductFillingRequiredFieldsOnlyTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [openProductCatalogPage] AdminProductCatalogPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/"); // stepKey: openProductCatalogPageOpenProductCatalogPage
		$I->waitForPageLoad(30); // stepKey: waitForProductCatalogPageLoadOpenProductCatalogPage
		$I->comment("Exiting Action Group [openProductCatalogPage] AdminProductCatalogPageOpenActionGroup");
		$I->click(".action-toggle.primary.add"); // stepKey: clickAddProductToggle
		$I->waitForPageLoad(30); // stepKey: clickAddProductToggleWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductToggleToSelectProduct
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-virtual']"); // stepKey: clickVirtualProduct
		$I->waitForPageLoad(30); // stepKey: clickVirtualProductWaitForPageLoad
		$I->comment("Create virtual product with required fields only");
		$I->fillField(".admin__field[data-index=name] input", "virtualProduct" . msq("virtualProductWithRequiredFields")); // stepKey: fillProductName
		$I->fillField(".admin__field[data-index=sku] input", "virtualsku" . msq("virtualProductWithRequiredFields")); // stepKey: fillProductSku
		$I->fillField(".admin__field[data-index=price] input", "10"); // stepKey: fillProductPrice
		$I->comment("Entering Action Group [clickSaveButton] AdminProductFormSaveButtonClickActionGroup");
		$I->click("#save-button"); // stepKey: clickSaveButtonClickSaveButton
		$I->waitForPageLoad(30); // stepKey: clickSaveButtonClickSaveButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavedClickSaveButton
		$I->comment("Exiting Action Group [clickSaveButton] AdminProductFormSaveButtonClickActionGroup");
		$I->comment("Verify we see success message");
		$I->see("You saved the product.", "#messages"); // stepKey: seeAssertVirtualProductSuccessMessage
		$I->comment("Verify we see created virtual product(from the above step) on the product grid page");
		$I->comment("Entering Action Group [openProductCatalogPage1] AdminProductCatalogPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/"); // stepKey: openProductCatalogPageOpenProductCatalogPage1
		$I->waitForPageLoad(30); // stepKey: waitForProductCatalogPageLoadOpenProductCatalogPage1
		$I->comment("Exiting Action Group [openProductCatalogPage1] AdminProductCatalogPageOpenActionGroup");
		$I->conditionalClick(".admin__data-grid-header .admin__data-grid-filters-current._show .action-clear", ".admin__data-grid-header .admin__data-grid-filters-current._show .action-clear", true); // stepKey: clickSelector
		$I->waitForPageLoad(30); // stepKey: clickSelectorWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: clickFilter
		$I->fillField("input.admin__control-text[name='name']", "virtualProduct" . msq("virtualProductWithRequiredFields")); // stepKey: fillProductName1
		$I->fillField("input.admin__control-text[name='sku']", "virtualsku" . msq("virtualProductWithRequiredFields")); // stepKey: fillVirtualProductSku
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickSearch2
		$I->waitForPageLoad(30); // stepKey: clickSearch2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSearch
		$I->seeInField("input.admin__control-text[name='name']", "virtualProduct" . msq("virtualProductWithRequiredFields")); // stepKey: seeVirtualProductName
		$I->seeInField("input.admin__control-text[name='sku']", "virtualsku" . msq("virtualProductWithRequiredFields")); // stepKey: seeVirtualProductSku
	}
}
