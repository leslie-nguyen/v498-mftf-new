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
 * @Title("MAGETWO-93794: :Proudct with html special characters in name")
 * @Description("Product with html entities in the name should appear correctly on the PDP breadcrumbs on storefront<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\StorefrontProductNameWithDoubleQuoteTest\StorefrontProductNameWithHTMLEntitiesTest.xml<br>")
 * @group product
 * @TestCaseId("MAGETWO-93794")
 */
class StorefrontProductNameWithHTMLEntitiesTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->createEntity("createCategoryOne", "hook", "_defaultCategory", [], []); // stepKey: createCategoryOne
		$I->createEntity("productOne", "hook", "productWithHTMLEntityOne", ["createCategoryOne"], []); // stepKey: productOne
		$I->createEntity("productTwo", "hook", "productWithHTMLEntityTwo", ["createCategoryOne"], []); // stepKey: productTwo
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("productOne", "hook"); // stepKey: deleteProductOne
		$I->deleteEntity("productTwo", "hook"); // stepKey: deleteProductTwo
		$I->deleteEntity("createCategoryOne", "hook"); // stepKey: deleteCategory
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
	 * @Stories({"Create product"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontProductNameWithHTMLEntitiesTest(AcceptanceTester $I)
	{
		$I->comment("Run re-index task");
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Check product in category listing");
		$I->amOnPage("/" . $I->retrieveEntityField('createCategoryOne', 'name', 'test') . ".html"); // stepKey: navigateToCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitforCategoryPageToLoad
		$I->see("SimpleOne™Product" . msq("productWithHTMLEntityOne"), "//main//li//a[contains(text(), 'SimpleOne™Product" . msq("productWithHTMLEntityOne") . "')]"); // stepKey: seeCorrectNameProd1CategoryPage
		$I->see("SimpleTwo霁产品<カネボウPro" . msq("productWithHTMLEntityTwo"), "//main//li//a[contains(text(), 'SimpleTwo霁产品<カネボウPro" . msq("productWithHTMLEntityTwo") . "')]"); // stepKey: seeCorrectNameProd2CategoryPage
		$I->comment("Open product display page");
		$I->click("//main//li//a[contains(text(), 'SimpleOne™Product" . msq("productWithHTMLEntityOne") . "')]"); // stepKey: clickProductToGoProductPage
		$I->waitForPageLoad(30); // stepKey: waitForProductDisplayPageLoad2
		$I->see("SimpleOne™Product" . msq("productWithHTMLEntityOne"), ".base"); // stepKey: seeCorrectName
		$I->comment("Entering Action Group [seeCorrectSku] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("SimpleOne™Product" . msq("productWithHTMLEntityOne"), ".product.attribute.sku>.value"); // stepKey: seeProductSkuSeeCorrectSku
		$I->comment("Exiting Action Group [seeCorrectSku] StorefrontAssertProductSkuOnProductPageActionGroup");
		$I->see("$50.00", "div.price-box.price-final_price"); // stepKey: seeCorrectPrice
		$I->comment("Veriy the breadcrumbs on Product Display page");
		$I->see("Home", ".items"); // stepKey: seeHomePageInBreadcrumbs1
		$I->see($I->retrieveEntityField('createCategoryOne', 'name', 'test'), ".items"); // stepKey: seeCorrectBreadCrumbCategory
		$I->see($I->retrieveEntityField('productOne', 'name', 'test'), ".items"); // stepKey: seeCorrectBreadCrumbProduct
		$I->click("//a[contains(@class,'level-top')]/span[contains(text(),'" . $I->retrieveEntityField('createCategoryOne', 'name', 'test') . "')]"); // stepKey: goBackToCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitforCategoryPageToLoad2
		$I->comment("Open product display page");
		$I->click("//main//li//a[contains(text(), 'SimpleTwo霁产品<カネボウPro" . msq("productWithHTMLEntityTwo") . "')]"); // stepKey: clickProductToGoSecondProductPage
		$I->waitForPageLoad(30); // stepKey: waitForProductDisplayPageLoad3
		$I->comment("Verify the breadcrumbs on Product Display page");
		$I->see("Home", ".items"); // stepKey: seeHomePageInBreadcrumbs2
		$I->see($I->retrieveEntityField('createCategoryOne', 'name', 'test'), ".items"); // stepKey: seeCorrectBreadCrumbCategory2
		$I->see($I->retrieveEntityField('productTwo', 'name', 'test'), ".items"); // stepKey: seeCorrectBreadCrumbProduct2
	}
}
