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
 * @Title("MC-8510: Mass update simple product price")
 * @Description("Login as admin and update mass product price<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminMassProductPriceUpdateTest.xml<br>")
 * @TestCaseId("MC-8510")
 * @group mtf_migrated
 */
class AdminMassProductPriceUpdateTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginToAdminPanel
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginToAdminPanel
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginToAdminPanel
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginToAdminPanel
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginToAdminPanelWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginToAdminPanel
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginToAdminPanel
		$I->comment("Exiting Action Group [loginToAdminPanel] AdminLoginActionGroup");
		$I->createEntity("simpleProduct1", "hook", "defaultSimpleProduct", [], []); // stepKey: simpleProduct1
		$I->createEntity("simpleProduct2", "hook", "defaultSimpleProduct", [], []); // stepKey: simpleProduct2
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("simpleProduct1", "hook"); // stepKey: deleteSimpleProduct1
		$I->deleteEntity("simpleProduct2", "hook"); // stepKey: deleteSimpleProduct2
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
	 * @Stories({"Mass product update"})
	 * @Features({"Catalog"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminMassProductPriceUpdateTest(AcceptanceTester $I)
	{
		$I->comment("Open Product Index Page");
		$I->comment("Entering Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/index"); // stepKey: goToProductIndexPageNavigateToProductIndex
		$I->waitForPageLoad(30); // stepKey: waitForProductIndexPageLoadNavigateToProductIndex
		$I->comment("Exiting Action Group [navigateToProductIndex] AdminOpenProductIndexPageActionGroup");
		$I->comment("Search products using keyword");
		$I->comment("Entering Action Group [searchByKeyword] SearchProductGridByKeyword2ActionGroup");
		$I->conditionalClick(".admin__data-grid-header button[data-action='grid-filter-reset']", ".admin__data-grid-header button[data-action='grid-filter-reset']", true); // stepKey: clickClearFiltersInitialSearchByKeyword
		$I->waitForPageLoad(30); // stepKey: clickClearFiltersInitialSearchByKeywordWaitForPageLoad
		$I->fillField("input#fulltext", "Testp"); // stepKey: fillKeywordSearchFieldSearchByKeyword
		$I->click(".data-grid-search-control-wrap button.action-submit"); // stepKey: clickKeywordSearchSearchByKeyword
		$I->waitForPageLoad(30); // stepKey: clickKeywordSearchSearchByKeywordWaitForPageLoad
		$I->comment("Exiting Action Group [searchByKeyword] SearchProductGridByKeyword2ActionGroup");
		$I->comment("Sort Products by ID in descending order");
		$I->comment("Entering Action Group [sortProductsByIdDescending] SortProductsByIdDescendingActionGroup");
		$I->conditionalClick(".//*[@class='sticky-header']/following-sibling::*//th[@class='data-grid-th _sortable _draggable _ascend']/span[text()='ID']", ".//*[@class='sticky-header']/following-sibling::*//th[@class='data-grid-th _sortable _draggable _descend']/span[text()='ID']", false); // stepKey: sortByIdSortProductsByIdDescending
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSortProductsByIdDescending
		$I->comment("Exiting Action Group [sortProductsByIdDescending] SortProductsByIdDescendingActionGroup");
		$I->comment("Select products");
		$I->checkOption("//td[count(../../..//th[./*[.='SKU']]/preceding-sibling::th) + 1][./*[.='" . $I->retrieveEntityField('simpleProduct1', 'sku', 'test') . "']]/../td//input[@data-action='select-row']"); // stepKey: selectFirstProduct
		$I->checkOption("//td[count(../../..//th[./*[.='SKU']]/preceding-sibling::th) + 1][./*[.='" . $I->retrieveEntityField('simpleProduct2', 'sku', 'test') . "']]/../td//input[@data-action='select-row']"); // stepKey: selectSecondProduct
		$I->comment("Update product price");
		$I->click("div.admin__data-grid-header-row.row div.action-select-wrap button.action-select"); // stepKey: clickDropdown
		$I->click("//div[contains(@class,'admin__data-grid-header-row') and contains(@class, 'row')]//div[contains(@class, 'action-select-wrap')]//ul/li/span[text() = 'Update attributes']"); // stepKey: clickChangeStatus
		$I->waitForPageLoad(30); // stepKey: waitForProductAttributePageToLoad
		$I->scrollTo("#toggle_price", 0, -160); // stepKey: scrollToPriceCheckBox
		$I->click("#toggle_price"); // stepKey: selectPriceCheckBox
		$I->fillField("#price", "90.99"); // stepKey: fillPrice
		$I->click("button[title=Save]"); // stepKey: clickOnSaveButton
		$I->waitForPageLoad(30); // stepKey: clickOnSaveButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForUpdatedProductToSave
		$I->see("Message is added to queue", ".message.message-success.success"); // stepKey: seeAttributeUpateSuccessMsg
		$I->comment("Start message queue");
		$I->comment("Entering Action Group [startMessageQueueConsumer] CliConsumerStartActionGroup");
		$startMessageQueueStartMessageQueueConsumer = $I->magentoCLI("queue:consumers:start product_action_attribute.update --max-messages=100", 60); // stepKey: startMessageQueueStartMessageQueueConsumer
		$I->comment($startMessageQueueStartMessageQueueConsumer);
		$I->comment("Exiting Action Group [startMessageQueueConsumer] CliConsumerStartActionGroup");
		$I->comment("Run cron");
		$runCron = $I->magentoCLI("cron:run --group=index", 60); // stepKey: runCron
		$I->comment($runCron);
		$I->comment("Verify product name, sku and updated price");
		$I->click("//td[count(../../..//th[./*[.='SKU']]/preceding-sibling::th) + 1][./*[.='" . $I->retrieveEntityField('simpleProduct1', 'sku', 'test') . "']]"); // stepKey: openFirstProduct
		$I->waitForPageLoad(30); // stepKey: waitForFirstProductToLoad
		$I->seeInField(".admin__field[data-index=name] input", $I->retrieveEntityField('simpleProduct1', 'name', 'test')); // stepKey: seeFirstProductNameInField
		$I->seeInField(".admin__field[data-index=sku] input", $I->retrieveEntityField('simpleProduct1', 'sku', 'test')); // stepKey: seeFirstProductSkuInField
		$I->seeInField(".admin__field[data-index=price] input", "90.99"); // stepKey: seeFirstProductPriceInField
		$I->click("#back"); // stepKey: clickOnBackButton
		$I->waitForPageLoad(30); // stepKey: clickOnBackButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductsToLoad
		$I->click("//td[count(../../..//th[./*[.='SKU']]/preceding-sibling::th) + 1][./*[.='" . $I->retrieveEntityField('simpleProduct2', 'sku', 'test') . "']]"); // stepKey: openSecondProduct
		$I->waitForPageLoad(30); // stepKey: waitForSecondProductToLoad
		$I->seeInField(".admin__field[data-index=name] input", $I->retrieveEntityField('simpleProduct2', 'name', 'test')); // stepKey: seeSecondProductNameInField
		$I->seeInField(".admin__field[data-index=sku] input", $I->retrieveEntityField('simpleProduct2', 'sku', 'test')); // stepKey: seeSecondProductSkuInField
		$I->seeInField(".admin__field[data-index=price] input", "90.99"); // stepKey: seeSecondProductPriceInField
	}
}
