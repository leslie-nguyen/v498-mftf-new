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
 * @Title("MC-14731: Check updating shopping cart while updating items qty")
 * @Description("Check updating shopping cart while updating items qty<h3>Test files</h3>vendor\magento\module-checkout\Test\Mftf\Test\StorefrontUpdateShoppingCartSimpleProductQtyTest.xml<br>")
 * @TestCaseId("MC-14731")
 * @group shoppingCart
 * @group mtf_migrated
 */
class StorefrontUpdateShoppingCartSimpleProductQtyTestCest
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
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createProduct", "hook", "SimpleProduct", ["createCategory"], []); // stepKey: createProduct
		$I->comment("Add the newly created product to the shopping cart");
		$I->comment("Entering Action Group [addToCartFromStorefrontProductPage] AddSimpleProductToCartActionGroup");
		$I->amOnPage("/" . $I->retrieveEntityField('createProduct', 'custom_attributes[url_key]', 'hook') . ".html"); // stepKey: goToProductPageAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: waitForProductPageAddToCartFromStorefrontProductPage
		$I->click("button.action.tocart.primary"); // stepKey: addToCartAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: addToCartAddToCartFromStorefrontProductPageWaitForPageLoad
		$I->waitForElementNotVisible("//button/span[text()='Adding...']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddingAddToCartFromStorefrontProductPage
		$I->waitForElementNotVisible("//button/span[text()='Added']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddedAddToCartFromStorefrontProductPage
		$I->waitForElementVisible("//button/span[text()='Add to Cart']", 30); // stepKey: waitForElementVisibleAddToCartButtonTitleIsAddToCartAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddToCartFromStorefrontProductPage
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForProductAddedMessageAddToCartFromStorefrontProductPage
		$I->see("You added " . $I->retrieveEntityField('createProduct', 'name', 'hook') . " to your shopping cart.", "div.message-success.success.message"); // stepKey: seeAddToCartSuccessMessageAddToCartFromStorefrontProductPage
		$I->comment("Exiting Action Group [addToCartFromStorefrontProductPage] AddSimpleProductToCartActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createProduct", "hook"); // stepKey: deleteProduct
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
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
	 * @Features({"Checkout"})
	 * @Stories({"Shopping cart"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontUpdateShoppingCartSimpleProductQtyTest(AcceptanceTester $I)
	{
		$I->comment("Go to the shopping cart");
		$I->comment("Entering Action Group [amOnPageShoppingCart] StorefrontCartPageOpenActionGroup");
		$I->amOnPage("/checkout/cart"); // stepKey: openCartPageAmOnPageShoppingCart
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadedAmOnPageShoppingCart
		$I->comment("Exiting Action Group [amOnPageShoppingCart] StorefrontCartPageOpenActionGroup");
		$I->comment("Change the product QTY");
		$I->fillField("//main//table[@id='shopping-cart-table']//tbody//tr[..//strong[contains(@class, 'product-item-name')]//a/text()='" . $I->retrieveEntityField('createProduct', 'name', 'test') . "'][1]//td[contains(@class, 'qty')]//input[contains(@class, 'qty')]", "3"); // stepKey: changeCartQty
		$I->click("#form-validate button[type='submit'].update"); // stepKey: openShoppingCart
		$I->waitForPageLoad(30); // stepKey: openShoppingCartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCheckoutPageLoad2
		$I->comment("The price and QTY values should be updated for the product");
		$grabProductQtyInCart = $I->grabValueFrom("//main//table[@id='shopping-cart-table']//tbody//tr[..//strong[contains(@class, 'product-item-name')]//a/text()='" . $I->retrieveEntityField('createProduct', 'name', 'test') . "'][1]//td[contains(@class, 'qty')]//input[contains(@class, 'qty')]"); // stepKey: grabProductQtyInCart
		$I->see("$369.00", "//main//table[@id='shopping-cart-table']//tbody//tr[..//strong[contains(@class, 'product-item-name')]//a/text()='" . $I->retrieveEntityField('createProduct', 'name', 'test') . "'][1]//td[contains(@class, 'subtotal')]//span[@class='price']"); // stepKey: assertProductPrice
		$I->assertEquals("3", $grabProductQtyInCart); // stepKey: assertProductQtyInCart
		$I->comment("Subtotal should be updated");
		$I->see("$369.00", "//*[@id='cart-totals']//tr[@class='totals sub']//td//span[@class='price']"); // stepKey: assertCartSubtotal
		$I->comment("Minicart product price and subtotal should be updated");
		$I->comment("Entering Action Group [openMinicart] ClickViewAndEditCartFromMiniCartActionGroup");
		$I->scrollTo("a.showcart"); // stepKey: scrollToMiniCartOpenMinicart
		$I->waitForPageLoad(60); // stepKey: scrollToMiniCartOpenMinicartWaitForPageLoad
		$I->conditionalClick("a.showcart", "a.showcart.active", false); // stepKey: openMiniCartOpenMinicart
		$I->waitForElementVisible(".action.viewcart", 30); // stepKey: waitForViewAndEditCartVisibleOpenMinicart
		$I->waitForPageLoad(30); // stepKey: waitForViewAndEditCartVisibleOpenMinicartWaitForPageLoad
		$I->click(".action.viewcart"); // stepKey: viewAndEditCartOpenMinicart
		$I->waitForPageLoad(30); // stepKey: viewAndEditCartOpenMinicartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoadOpenMinicart
		$I->seeInCurrentUrl("checkout/cart"); // stepKey: seeInCurrentUrlOpenMinicart
		$I->comment("Exiting Action Group [openMinicart] ClickViewAndEditCartFromMiniCartActionGroup");
		$grabProductQtyInMinicart = $I->grabValueFrom("//a[text()='" . $I->retrieveEntityField('createProduct', 'name', 'test') . "']/../..//input[contains(@class,'cart-item-qty')]"); // stepKey: grabProductQtyInMinicart
		$I->assertEquals("3", $grabProductQtyInMinicart); // stepKey: assertProductQtyInMinicart
		$I->see("$369.00", "//tr[@class='totals sub']//td[@class='amount']/span"); // stepKey: assertMinicartSubtotal
	}
}
