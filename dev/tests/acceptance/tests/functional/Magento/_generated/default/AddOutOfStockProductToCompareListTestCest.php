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
 * @Title("MAGETWO-98644: Add Product that is Out of Stock product to Product Comparison")
 * @Description("Customer should be able to add Product that is Out Of Stock to the Product Comparison<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AddOutOfStockProductToCompareListTest.xml<br>")
 * @TestCaseId("MAGETWO-98644")
 * @group Catalog
 */
class AddOutOfStockProductToCompareListTestCest
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
		$setConfigShowOutOfStockFalse = $I->magentoCLI("config:set cataloginventory/options/show_out_of_stock 0", 60); // stepKey: setConfigShowOutOfStockFalse
		$I->comment($setConfigShowOutOfStockFalse);
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->createEntity("category", "hook", "SimpleSubCategory", [], []); // stepKey: category
		$I->createEntity("product", "hook", "SimpleProduct4", ["category"], []); // stepKey: product
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$setConfigShowOutOfStockFalse = $I->magentoCLI("config:set cataloginventory/options/show_out_of_stock 0", 60); // stepKey: setConfigShowOutOfStockFalse
		$I->comment($setConfigShowOutOfStockFalse);
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->deleteEntity("product", "hook"); // stepKey: deleteProduct
		$I->deleteEntity("category", "hook"); // stepKey: deleteCategory
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
	 * @Stories({"Product Comparison for products Out of Stock"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AddOutOfStockProductToCompareListTest(AcceptanceTester $I)
	{
		$I->comment("Open product page");
		$I->comment("Open product page");
		$I->amOnPage("/" . $I->retrieveEntityField('product', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: goToSimpleProductPage
		$I->waitForPageLoad(30); // stepKey: waitForSimpleProductPage
		$I->comment("'Add to compare' link is not available");
		$I->comment("'Add to compare' link is not available");
		$I->dontSeeElement("a.action.tocompare"); // stepKey: dontSeeAddToCompareLink
		$I->comment("Turn on 'out on stock' config");
		$I->comment("Turn on 'out of stock' config");
		$setConfigShowOutOfStockTrue = $I->magentoCLI("config:set cataloginventory/options/show_out_of_stock 1", 60); // stepKey: setConfigShowOutOfStockTrue
		$I->comment($setConfigShowOutOfStockTrue);
		$I->comment("Clear cache and reindex");
		$I->comment("Clear cache and reindex");
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Open product page");
		$I->comment("Open product page");
		$I->amOnPage("/" . $I->retrieveEntityField('product', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: goToSimpleProductPage2
		$I->waitForPageLoad(30); // stepKey: waitForSimpleProductPage2
		$I->comment("Click on 'Add to Compare' link");
		$I->waitForElementVisible("a.action.tocompare", 30); // stepKey: seeAddToCompareLink
		$I->comment("Click on 'Add to Compare' link");
		$I->click("a.action.tocompare"); // stepKey: clickOnAddToCompare
		$I->waitForPageLoad(30); // stepKey: waitForProdAddToCmpList
		$I->comment("Assert success message");
		$I->comment("Assert success message");
		$grabTextFromSuccessMessage = $I->grabTextFrom("div.message-success.success.message"); // stepKey: grabTextFromSuccessMessage
		$I->assertEquals("You added product " . $I->retrieveEntityField('product', 'name', 'test') . " to the comparison list.", ($grabTextFromSuccessMessage)); // stepKey: assertSuccessMessage
		$I->comment("See product in the comparison list");
		$I->comment("See product in the comparison list");
		$I->amOnPage("catalog/product_compare/index"); // stepKey: navigateToComparePage
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductComparePageLoad
		$I->seeElement("//*[@id='product-comparison']//tr//strong[@class='product-item-name']/a[contains(text(), '" . $I->retrieveEntityField('product', 'name', 'test') . "')]"); // stepKey: seeProductInCompareList
		$I->comment("Go to Category page and delete product from comparison list");
		$I->comment("Go to Category page and delete product from comparison list");
		$I->amOnPage("/" . $I->retrieveEntityField('category', 'name', 'test') . ".html"); // stepKey: onCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1
		$I->click("//main//div[contains(@class, 'block-compare')]//a[contains(@class, 'action clear')]"); // stepKey: clickClearAll
		$I->waitForPageLoad(30); // stepKey: waitForConfirmPageLoad
		$I->click("//*[@class='action-primary action-accept']"); // stepKey: confirmProdDelate
		$I->waitForPageLoad(30); // stepKey: waitForConfirmLoad
		$I->comment("Add product to compare list from Category page");
		$I->comment("Add product to compare list fom Category page");
		$I->moveMouseOver(".product-item-info"); // stepKey: hoverOverProduct
		$I->click("a.action.tocompare"); // stepKey: clickAddToCompare
		$I->waitForPageLoad(30); // stepKey: waitProdAddingToCmpList
		$I->comment("Assert success message");
		$I->comment("Assert success message");
		$grabTextFromSuccessMessage2 = $I->grabTextFrom("div.message-success.success.message"); // stepKey: grabTextFromSuccessMessage2
		$I->assertEquals("You added product " . $I->retrieveEntityField('product', 'name', 'test') . " to the comparison list.", ($grabTextFromSuccessMessage)); // stepKey: assertSuccessMessage2
		$I->comment("Check that product displays on add to compare widget");
		$I->comment("Check that product displays on add to compare widget");
		$I->seeElement("//main//ol[@id='compare-items']//a[@class='product-item-link'][text()='" . $I->retrieveEntityField('product', 'name', 'test') . "']"); // stepKey: seeProdNameOnCmpWidget
		$I->comment("See product in the compare page");
		$I->comment("See product in the compare page");
		$I->amOnPage("catalog/product_compare/index"); // stepKey: navigateToComparePage2
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontProductComparePageLoad2
		$I->seeElement("//*[@id='product-comparison']//tr//strong[@class='product-item-name']/a[contains(text(), '" . $I->retrieveEntityField('product', 'name', 'test') . "')]"); // stepKey: seeProductInCompareList2
	}
}
