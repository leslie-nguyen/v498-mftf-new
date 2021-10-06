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
 * @Title("MAGETWO-94330: Required fields should have the required asterisk indicator")
 * @Description("Verify that Required fields should have the required indicator icon next to the field name<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminRequiredFieldsHaveRequiredFieldIndicatorTest.xml<br>")
 * @TestCaseId("MAGETWO-94330")
 * @group Catalog
 */
class AdminRequiredFieldsHaveRequiredFieldIndicatorTestCest
{
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
	 * @Stories({"Verify the presence of required field indicators across different pages in Magento Admin"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminRequiredFieldsHaveRequiredFieldIndicatorTest(AcceptanceTester $I)
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
		$I->comment("Entering Action Group [navigateToCategoryPage] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageNavigateToCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadNavigateToCategoryPage
		$I->comment("Exiting Action Group [navigateToCategoryPage] AdminOpenCategoryPageActionGroup");
		$I->waitForElementVisible("#add_subcategory_button", 30); // stepKey: waitForAddSubCategoryVisible
		$I->waitForPageLoad(30); // stepKey: waitForAddSubCategoryVisibleWaitForPageLoad
		$I->click("#add_subcategory_button"); // stepKey: clickOnAddSubCategory
		$I->waitForPageLoad(30); // stepKey: clickOnAddSubCategoryWaitForPageLoad
		$I->comment("Verify that the Category Name field has the required field name indicator");
		$getRequiredFieldIndicator = $I->executeJS(" return window.getComputedStyle(document.querySelector('._required[data-index=name]>.admin__field-label span'), ':after').getPropertyValue('content');"); // stepKey: getRequiredFieldIndicator
		$I->assertEquals("\"*\"", $getRequiredFieldIndicator, "pass"); // stepKey: assertRequiredFieldIndicator1
		$getRequiredFieldIndicatorColor = $I->executeJS(" return window.getComputedStyle(document.querySelector('._required[data-index=name]>.admin__field-label span'), ':after').getPropertyValue('color');"); // stepKey: getRequiredFieldIndicatorColor
		$I->assertEquals("rgb(226, 38, 38)", $getRequiredFieldIndicatorColor, "pass"); // stepKey: assertRequiredFieldIndicator2
		$I->comment("Entering Action Group [navigateToProductIndexPage] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageNavigateToProductIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadNavigateToProductIndexPage
		$I->comment("Exiting Action Group [navigateToProductIndexPage] AdminOpenProductIndexPageActionGroup");
		$I->click(".action-toggle.primary.add"); // stepKey: addProductDropdown
		$I->waitForPageLoad(30); // stepKey: addProductDropdownWaitForPageLoad
		$I->click(".item[data-ui-id='products-list-add-new-product-button-item-simple']"); // stepKey: addSimpleProduct
		$I->waitForPageLoad(30); // stepKey: addSimpleProductWaitForPageLoad
		$I->comment("Verify that the Product Name and Sku fields have the required field name indicator");
		$productNameRequiredFieldIndicator = $I->executeJS(" return window.getComputedStyle(document.querySelector('._required[data-index=name]>.admin__field-label span'), ':after').getPropertyValue('content');"); // stepKey: productNameRequiredFieldIndicator
		$I->assertEquals("\"*\"", $productNameRequiredFieldIndicator, "pass"); // stepKey: assertRequiredFieldIndicator3
		$productSkuRequiredFieldIndicator = $I->executeJS(" return window.getComputedStyle(document.querySelector('._required[data-index=sku]>.admin__field-label span'), ':after').getPropertyValue('content');"); // stepKey: productSkuRequiredFieldIndicator
		$I->assertEquals("\"*\"", $productSkuRequiredFieldIndicator, "pass"); // stepKey: assertRequiredFieldIndicator4
		$I->comment("Verify that the CMS page have the required field name indicator next to Page Title");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/cms/page"); // stepKey: amOnPagePagesGrid
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1
		$I->click("#add"); // stepKey: clickAddNewPage
		$I->waitForPageLoad(30); // stepKey: clickAddNewPageWaitForPageLoad
		$pageTitleRequiredFieldIndicator = $I->executeJS(" return window.getComputedStyle(document.querySelector('._required[data-index=title]>.admin__field-label span'), ':after').getPropertyValue('content');"); // stepKey: pageTitleRequiredFieldIndicator
		$I->assertEquals("\"*\"", $pageTitleRequiredFieldIndicator, "pass"); // stepKey: assertRequiredFieldIndicator5
	}
}
