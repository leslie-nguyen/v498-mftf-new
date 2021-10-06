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
 * @Title("[NO TESTCASEID]: Remove products from the wishlist using the sidebar.")
 * @Description("Products removed from wishlist and a customer remains on the same page.<h3>Test files</h3>vendor\magento\module-wishlist\Test\Mftf\Test\StorefrontRemoveProductsFromWishlistUsingSidebarTest.xml<br>")
 * @group wishlist
 */
class StorefrontRemoveProductsFromWishlistUsingSidebarTestCest
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
		$I->createEntity("categoryFirst", "hook", "SimpleSubCategory", [], []); // stepKey: categoryFirst
		$I->createEntity("categorySecond", "hook", "SimpleSubCategory", [], []); // stepKey: categorySecond
		$I->createEntity("simpleProduct1", "hook", "SimpleProduct", ["categoryFirst"], []); // stepKey: simpleProduct1
		$I->createEntity("simpleProduct2", "hook", "SimpleProduct", ["categorySecond"], []); // stepKey: simpleProduct2
		$I->createEntity("customer", "hook", "Simple_US_Customer", [], []); // stepKey: customer
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("simpleProduct1", "hook"); // stepKey: deleteSimpleProduct1
		$I->deleteEntity("simpleProduct2", "hook"); // stepKey: deleteSimpleProduct2
		$I->deleteEntity("categoryFirst", "hook"); // stepKey: deleteCategoryFirst
		$I->deleteEntity("categorySecond", "hook"); // stepKey: deleteCategorySecond
		$I->deleteEntity("customer", "hook"); // stepKey: deleteCustomer
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
	 * @Features({"Wishlist"})
	 * @Stories({"Remove from wishlist"})
	 * @Severity(level = SeverityLevel::MINOR)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontRemoveProductsFromWishlistUsingSidebarTest(AcceptanceTester $I)
	{
		$I->comment("Perform reindex and flush cache");
		$I->comment("Entering Action Group [reindex] CliIndexerReindexActionGroup");
		$reindexSpecifiedIndexersReindex = $I->magentoCLI("indexer:reindex", 60, ""); // stepKey: reindexSpecifiedIndexersReindex
		$I->comment($reindexSpecifiedIndexersReindex);
		$I->comment("Exiting Action Group [reindex] CliIndexerReindexActionGroup");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Sign in as customer");
		$I->comment("Entering Action Group [loginToStorefrontAccount] LoginToStorefrontActionGroup");
		$I->amOnPage("/customer/account/login/"); // stepKey: amOnSignInPageLoginToStorefrontAccount
		$I->waitForPageLoad(30); // stepKey: waitPageFullyLoadedLoginToStorefrontAccount
		$I->waitForElementVisible("#email", 30); // stepKey: waitFormAppearsLoginToStorefrontAccount
		$I->fillField("#email", $I->retrieveEntityField('customer', 'email', 'test')); // stepKey: fillEmailLoginToStorefrontAccount
		$I->fillField("#pass", $I->retrieveEntityField('customer', 'password', 'test')); // stepKey: fillPasswordLoginToStorefrontAccount
		$I->click("#send2"); // stepKey: clickSignInAccountButtonLoginToStorefrontAccount
		$I->waitForPageLoad(30); // stepKey: clickSignInAccountButtonLoginToStorefrontAccountWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerLoggedInLoginToStorefrontAccount
		$I->comment("Exiting Action Group [loginToStorefrontAccount] LoginToStorefrontActionGroup");
		$I->comment("Add product from first category to the wishlist");
		$I->amOnPage("/" . $I->retrieveEntityField('categoryFirst', 'name', 'test') . ".html"); // stepKey: navigateToCategoryFirstPage
		$I->comment("Entering Action Group [browseAssertCategoryProduct1] StorefrontCheckCategorySimpleProductActionGroup");
		$I->waitForElementVisible("//main//li//a[contains(text(), '" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "')]", 30); // stepKey: waitForProductBrowseAssertCategoryProduct1
		$I->seeElement("//main//li//a[contains(text(), '" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "')]"); // stepKey: assertProductNameBrowseAssertCategoryProduct1
		$I->see("$" . $I->retrieveEntityField('simpleProduct1', 'price', 'test') . ".00", "//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "')]]//span[@class='price']"); // stepKey: AssertProductPriceBrowseAssertCategoryProduct1
		$I->moveMouseOver("//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "')]]//div[@class='product-item-info']"); // stepKey: moveMouseOverProductBrowseAssertCategoryProduct1
		$I->seeElement("//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "')]]//button[contains(@class, 'tocart')]"); // stepKey: AssertAddToCartBrowseAssertCategoryProduct1
		$I->comment("Exiting Action Group [browseAssertCategoryProduct1] StorefrontCheckCategorySimpleProductActionGroup");
		$I->comment("Entering Action Group [addSimpleProduct1ToWishlist] StorefrontCustomerAddCategoryProductToWishlistActionGroup");
		$I->moveMouseOver("//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "')]]//div[@class='product-item-info']"); // stepKey: addCategoryProductToWishlistMoveMouseOverProductAddSimpleProduct1ToWishlist
		$I->click("//main//li[.//a[contains(text(), '" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "')]]//a[contains(@class, 'towishlist')]"); // stepKey: addCategoryProductToWishlistClickAddProductToWishlistAddSimpleProduct1ToWishlist
		$I->waitForElement("div.message-success.success.message", 30); // stepKey: addCategoryProductToWishlistWaitForSuccessMessageAddSimpleProduct1ToWishlist
		$I->see($I->retrieveEntityField('simpleProduct1', 'name', 'test') . " has been added to your Wish List.", "div.message-success.success.message"); // stepKey: addCategoryProductToWishlistSeeProductNameAddedToWishlistAddSimpleProduct1ToWishlist
		$I->seeCurrentUrlMatches("~/wishlist_id/\d+/$~"); // stepKey: seeCurrentUrlMatchesAddSimpleProduct1ToWishlist
		$I->comment("Exiting Action Group [addSimpleProduct1ToWishlist] StorefrontCustomerAddCategoryProductToWishlistActionGroup");
		$I->comment("Remove product from the Wishlist using the sidebar from the second category page");
		$I->amOnPage("/" . $I->retrieveEntityField('categorySecond', 'name', 'test') . ".html"); // stepKey: navigateToCategorySecondPage
		$I->comment("Entering Action Group [switchCategoryViewToListMode] StorefrontSwitchCategoryViewToListModeActionGroup");
		$I->click("#mode-list"); // stepKey: switchCategoryViewToListModeSwitchCategoryViewToListMode
		$I->waitForElement("#page-title-heading span", 30); // stepKey: waitForCategoryReloadSwitchCategoryViewToListMode
		$I->comment("Exiting Action Group [switchCategoryViewToListMode] StorefrontSwitchCategoryViewToListModeActionGroup");
		$I->comment("Entering Action Group [checkSimpleProduct1InWishlistSidebar] StorefrontCustomerCheckProductInWishlistSidebarActionGroup");
		$I->waitForElement("//main//ol[@id='wishlist-sidebar']//a[@class='product-item-link']/span[text()='" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "']", 30); // stepKey: assertWishlistSidebarProductNameCheckSimpleProduct1InWishlistSidebar
		$I->see("$" . $I->retrieveEntityField('simpleProduct1', 'price', 'test') . ".00", "//main//ol[@id='wishlist-sidebar']//a[@class='product-item-link']/span[text()='" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "']//ancestor::ol//span[@class='price']"); // stepKey: AssertWishlistSidebarProductPriceCheckSimpleProduct1InWishlistSidebar
		$I->seeElement("//main//ol[@id='wishlist-sidebar']//a[@class='product-item-link']/span[text()='" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "']//ancestor::ol//button[contains(@class, 'action tocart primary')]"); // stepKey: AssertWishlistSidebarAddToCartCheckSimpleProduct1InWishlistSidebar
		$I->seeElement("//main//ol[@id='wishlist-sidebar']//a[@class='product-item-link']/span[text()='" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "']//ancestor::ol//img[@class='product-image-photo']"); // stepKey: AssertWishlistSidebarProductImageCheckSimpleProduct1InWishlistSidebar
		$I->comment("Exiting Action Group [checkSimpleProduct1InWishlistSidebar] StorefrontCustomerCheckProductInWishlistSidebarActionGroup");
		$I->comment("Entering Action Group [removeProduct1FromWishlistUsingSidebar] StorefrontCustomerRemoveProductFromWishlistUsingSidebarActionGroup");
		$I->click("//main//ol[@id='wishlist-sidebar']//a[@class='product-item-link']/span[text()='" . $I->retrieveEntityField('simpleProduct1', 'name', 'test') . "']//ancestor::ol//a[contains(@class, 'action delete')]"); // stepKey: RemoveProductFromWishlistUsingSidebarClickRemoveItemFromWishlistRemoveProduct1FromWishlistUsingSidebar
		$I->waitForElement("div.message-success", 30); // stepKey: RemoveProductFromWishlistUsingSidebarWaitForSuccessMessageRemoveProduct1FromWishlistUsingSidebar
		$I->see($I->retrieveEntityField('simpleProduct1', 'name', 'test') . " has been removed from your Wish List.", "div.message-success"); // stepKey: RemoveProductFromWishlistUsingSidebarSeeProductNameRemovedFromWishlistRemoveProduct1FromWishlistUsingSidebar
		$I->comment("Exiting Action Group [removeProduct1FromWishlistUsingSidebar] StorefrontCustomerRemoveProductFromWishlistUsingSidebarActionGroup");
		$I->comment("Check that a customer on the same page as before");
		$I->comment("hardcoded URL because this method does not support replacement");
		$I->seeCurrentUrlMatches("~\/" . $I->retrieveEntityField('categorySecond', 'name', 'test') . "\.html\?(\S+)?\w+=list(&\S+)?$~i"); // stepKey: seeCurrentCategoryUrlMatches
	}
}
