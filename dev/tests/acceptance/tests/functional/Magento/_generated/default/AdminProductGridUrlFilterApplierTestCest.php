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
 * @Title("https://studio.cucumber.io/projects/131313/test-plan/folders/1320712/scenarios/4931106: Verify that filter is applied on product grid when filters parameter is set on url")
 * @Description("Accessing product grid url with filters parameter<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminProductGridUrlFilterApplierTest.xml<br>")
 * @TestCaseId("https://studio.cucumber.io/projects/131313/test-plan/folders/1320712/scenarios/4931106")
 * @group product
 */
class AdminProductGridUrlFilterApplierTestCest
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
		$I->createEntity("createSimpleProduct", "hook", "SimpleProduct2", [], []); // stepKey: createSimpleProduct
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteProduct
		$I->comment("Entering Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageNavigateToProductIndex
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadNavigateToProductIndex
		$I->comment("Exiting Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->comment("Entering Action Group [clearGridFilter] ClearFiltersAdminDataGridActionGroup");
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersClearGridFilter
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersClearGridFilterWaitForPageLoad
		$I->comment("Exiting Action Group [clearGridFilter] ClearFiltersAdminDataGridActionGroup");
		$I->comment("Entering Action Group [logoutOfAdmin] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageLogoutOfAdmin
		$I->comment("Exiting Action Group [logoutOfAdmin] AdminLogoutActionGroup");
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
	 * @Stories({"Filter product using GET URL parameter"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminProductGridUrlFilterApplierTest(AcceptanceTester $I)
	{
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index?filters[sku]=" . $I->retrieveEntityField('createSimpleProduct', 'sku', 'test')); // stepKey: navigateToProductGridWithFilters
		$I->waitForPageLoad(30); // stepKey: waitForProductGrid
		$I->see($I->retrieveEntityField('createSimpleProduct', 'name', 'test'), "//tbody//tr//td//div[contains(., '" . $I->retrieveEntityField('createSimpleProduct', 'name', 'test') . "')]"); // stepKey: seeProduct
		$I->waitForPageLoad(30); // stepKey: seeProductWaitForPageLoad
		$I->waitForElementVisible(".admin__data-grid-header .admin__data-grid-filters-current._show", 30); // stepKey: waitForEnabledFilters
		$I->seeElement(".admin__data-grid-header .admin__data-grid-filters-current._show"); // stepKey: seeEnabledFilters
		$I->see("SKU: " . $I->retrieveEntityField('createSimpleProduct', 'sku', 'test'), ".admin__data-grid-header .admin__data-grid-filters-current._show"); // stepKey: seeProductNameFilter
	}
}
