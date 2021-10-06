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
 * @Title("MC-14765: Create search query using product description and verify search suggestions")
 * @Description("Storefront search by product description, generate search query and verify dropdown product search suggestions<h3>Test files</h3>vendor\magento\module-search\Test\Mftf\Test\StorefrontVerifySearchSuggestionByProductDescriptionTest.xml<br>")
 * @TestCaseId("MC-14765")
 * @group mtf_migrated
 */
class StorefrontVerifySearchSuggestionByProductDescriptionTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Login as admin");
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->comment("Create product with description");
		$I->createEntity("simpleProduct", "hook", "SimpleProductWithDescription", [], []); // stepKey: simpleProduct
		$I->comment("Perform reindex and flush cache");
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Delete created product");
		$I->deleteEntity("simpleProduct", "hook"); // stepKey: deleteProduct
		$I->comment("Go to the catalog search term page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/search/term/index/"); // stepKey: openAdminCatalogSearchTermIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForAdminCatalogSearchTermIndexPageLoad
		$I->comment("Filter the search term");
		$I->comment("Entering Action Group [filterByThirdSearchQuery] AdminSearchTermFilterBySearchQueryActionGroup");
		$I->click("//button[@class='action-default scalable action-reset action-tertiary']"); // stepKey: clickOnResetButtonFilterByThirdSearchQuery
		$I->waitForPageLoad(30); // stepKey: clickOnResetButtonFilterByThirdSearchQueryWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForResetFilterFilterByThirdSearchQuery
		$I->fillField("//tr[@class='data-grid-filters']//td/input[@name='search_query']", "API Product Description" . msq("ApiProductDescription")); // stepKey: fillSearchQueryFilterByThirdSearchQuery
		$I->click("//button[@class='action-default scalable action-secondary']"); // stepKey: clickSearchButtonFilterByThirdSearchQuery
		$I->waitForPageLoad(30); // stepKey: clickSearchButtonFilterByThirdSearchQueryWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSearchResultLoadFilterByThirdSearchQuery
		$I->checkOption("//*[normalize-space()='API Product Description" . msq("ApiProductDescription") . "']/preceding-sibling::td//input[@name='search']"); // stepKey: checkCheckBoxFilterByThirdSearchQuery
		$I->waitForPageLoad(30); // stepKey: checkCheckBoxFilterByThirdSearchQueryWaitForPageLoad
		$I->comment("Exiting Action Group [filterByThirdSearchQuery] AdminSearchTermFilterBySearchQueryActionGroup");
		$I->comment("Delete created below search terms");
		$I->comment("Entering Action Group [deleteSearchTerms] AdminDeleteSearchTermActionGroup");
		$I->selectOption("//div[@class='admin__grid-massaction-form']//select[@id='search_term_grid_massaction-select']", "delete"); // stepKey: selectDeleteOptionDeleteSearchTerms
		$I->click("//button[@class='action-default scalable']/span"); // stepKey: clickSubmitButtonDeleteSearchTerms
		$I->waitForPageLoad(30); // stepKey: clickSubmitButtonDeleteSearchTermsWaitForPageLoad
		$I->click("//button[@class='action-primary action-accept']/span"); // stepKey: clickOkButtonDeleteSearchTerms
		$I->waitForPageLoad(30); // stepKey: clickOkButtonDeleteSearchTermsWaitForPageLoad
		$I->waitForElementVisible("//div[@class='message message-success success']/div[@data-ui-id='messages-message-success']", 30); // stepKey: waitForSuccessMessageDeleteSearchTerms
		$I->comment("Exiting Action Group [deleteSearchTerms] AdminDeleteSearchTermActionGroup");
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
	 * @Stories({"Search Term"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Search"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontVerifySearchSuggestionByProductDescriptionTest(AcceptanceTester $I)
	{
		$I->comment("Go to storefront home page");
		$I->comment("Entering Action Group [openStoreFrontHomePage] StorefrontOpenHomePageActionGroup");
		$I->amOnPage("/"); // stepKey: goToStorefrontPageOpenStoreFrontHomePage
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadOpenStoreFrontHomePage
		$I->comment("Exiting Action Group [openStoreFrontHomePage] StorefrontOpenHomePageActionGroup");
		$I->comment("Storefront quick search by product name");
		$I->comment("Entering Action Group [quickSearchByProductName] StorefrontCheckQuickSearchStringActionGroup");
		$I->fillField("#search", "API Product Description" . msq("ApiProductDescription")); // stepKey: fillInputQuickSearchByProductName
		$I->submitForm("#search", []); // stepKey: submitQuickSearchQuickSearchByProductName
		$I->seeInCurrentUrl("/catalogsearch/result/"); // stepKey: checkUrlQuickSearchByProductName
		$I->dontSeeInCurrentUrl("form_key="); // stepKey: checkUrlFormKeyQuickSearchByProductName
		$I->seeInTitle("Search results for: 'API Product Description" . msq("ApiProductDescription") . "'"); // stepKey: assertQuickSearchTitleQuickSearchByProductName
		$I->see("Search results for: 'API Product Description" . msq("ApiProductDescription") . "'", ".page-title span"); // stepKey: assertQuickSearchNameQuickSearchByProductName
		$I->comment("Exiting Action Group [quickSearchByProductName] StorefrontCheckQuickSearchStringActionGroup");
		$I->comment("Verify search suggestions and select the suggestion from dropdown options");
		$I->comment("Entering Action Group [seeDropDownSearchSuggestion] StoreFrontSelectDropDownSearchSuggestionActionGroup");
		$I->waitForElementVisible("#search", 30); // stepKey: waitForQuickSearchToBeVisibleSeeDropDownSearchSuggestion
		$I->fillField("#search", "API Product Description" . msq("ApiProductDescription")); // stepKey: fillSearchInputSeeDropDownSearchSuggestion
		$I->waitForElementVisible("//div[@id='search_autocomplete']/ul/li/span", 30); // stepKey: WaitForSearchDropDownSuggestionSeeDropDownSearchSuggestion
		$I->see("API Product Description" . msq("ApiProductDescription"), "//div[@id='search_autocomplete']/ul/li/span"); // stepKey: seeDropDownSuggestionSeeDropDownSearchSuggestion
		$I->click("//div[@id='search_autocomplete']//span[contains(., 'API Product Description" . msq("ApiProductDescription") . "')]"); // stepKey: clickOnSearchSuggestionSeeDropDownSearchSuggestion
		$I->waitForPageLoad(30); // stepKey: waitForSelectedProductToLoadSeeDropDownSearchSuggestion
		$I->comment("Exiting Action Group [seeDropDownSearchSuggestion] StoreFrontSelectDropDownSearchSuggestionActionGroup");
		$I->comment("Assert Product storefront main page");
		$I->comment("Entering Action Group [seeProductName] StorefrontAssertProductNameOnProductMainPageActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForTheProductPageToLoadSeeProductName
		$I->see($I->retrieveEntityField('simpleProduct', 'name', 'test'), ".product-item-name"); // stepKey: seeProductNameSeeProductName
		$I->comment("Exiting Action Group [seeProductName] StorefrontAssertProductNameOnProductMainPageActionGroup");
		$I->comment("Go to the catalog search term page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/search/term/index/"); // stepKey: openAdminCatalogSearchTermIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForAdminCatalogSearchTermIndexPageLoad
		$I->comment("Filter the search term");
		$I->comment("Entering Action Group [filterByThirdSearchQuery] AdminSearchTermFilterBySearchQueryActionGroup");
		$I->click("//button[@class='action-default scalable action-reset action-tertiary']"); // stepKey: clickOnResetButtonFilterByThirdSearchQuery
		$I->waitForPageLoad(30); // stepKey: clickOnResetButtonFilterByThirdSearchQueryWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForResetFilterFilterByThirdSearchQuery
		$I->fillField("//tr[@class='data-grid-filters']//td/input[@name='search_query']", "API Product Description" . msq("ApiProductDescription")); // stepKey: fillSearchQueryFilterByThirdSearchQuery
		$I->click("//button[@class='action-default scalable action-secondary']"); // stepKey: clickSearchButtonFilterByThirdSearchQuery
		$I->waitForPageLoad(30); // stepKey: clickSearchButtonFilterByThirdSearchQueryWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSearchResultLoadFilterByThirdSearchQuery
		$I->checkOption("//*[normalize-space()='API Product Description" . msq("ApiProductDescription") . "']/preceding-sibling::td//input[@name='search']"); // stepKey: checkCheckBoxFilterByThirdSearchQuery
		$I->waitForPageLoad(30); // stepKey: checkCheckBoxFilterByThirdSearchQueryWaitForPageLoad
		$I->comment("Exiting Action Group [filterByThirdSearchQuery] AdminSearchTermFilterBySearchQueryActionGroup");
		$I->comment("Assert Search Term in grid");
		$I->see("API Product Description" . msq("ApiProductDescription"), "//tr[@data-role='row']"); // stepKey: seeSearchTermInGrid
		$I->see("1", "//tr[@data-role='row']/td[@data-column='num_results']"); // stepKey: seeNumberOfSearchTermResultInGrid
	}
}
