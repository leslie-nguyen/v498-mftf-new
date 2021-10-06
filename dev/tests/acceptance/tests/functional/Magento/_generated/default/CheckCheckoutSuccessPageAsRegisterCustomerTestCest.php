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
 * @Title("MC-16488: Customer Checkout")
 * @Description("To be sure that other elements of Success page are shown for placed order as registered Customer.<h3>Test files</h3>vendor\magento\module-checkout\Test\Mftf\Test\CheckCheckoutSuccessPageTest\CheckCheckoutSuccessPageAsRegisterCustomerTest.xml<br>")
 * @TestCaseId("MC-16488")
 * @group checkout
 */
class CheckCheckoutSuccessPageAsRegisterCustomerTestCest
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
		$I->createEntity("createSimpleProduct", "hook", "SimpleTwo", [], []); // stepKey: createSimpleProduct
		$createSimpleUsCustomerFields['group_id'] = "1";
		$I->createEntity("createSimpleUsCustomer", "hook", "Simple_US_Customer", [], $createSimpleUsCustomerFields); // stepKey: createSimpleUsCustomer
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Logout from customer account");
		$I->amOnPage("customer/account/logout/"); // stepKey: logoutCustomerOne
		$I->waitForPageLoad(30); // stepKey: waitLogoutCustomerOne
		$I->comment("Entering Action Group [adminLogout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAdminLogout
		$I->comment("Exiting Action Group [adminLogout] AdminLogoutActionGroup");
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteProduct
		$I->deleteEntity("createSimpleUsCustomer", "hook"); // stepKey: deleteCustomer
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
	 * @Stories({"Success page elements are presented for placed order as Customer"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CheckCheckoutSuccessPageAsRegisterCustomerTest(AcceptanceTester $I)
	{
		$I->comment("Log in to Storefront as Customer");
		$I->comment("Entering Action Group [signUpNewUser] LoginToStorefrontActionGroup");
		$I->amOnPage("/customer/account/login/"); // stepKey: amOnSignInPageSignUpNewUser
		$I->waitForPageLoad(30); // stepKey: waitPageFullyLoadedSignUpNewUser
		$I->waitForElementVisible("#email", 30); // stepKey: waitFormAppearsSignUpNewUser
		$I->fillField("#email", $I->retrieveEntityField('createSimpleUsCustomer', 'email', 'test')); // stepKey: fillEmailSignUpNewUser
		$I->fillField("#pass", $I->retrieveEntityField('createSimpleUsCustomer', 'password', 'test')); // stepKey: fillPasswordSignUpNewUser
		$I->click("#send2"); // stepKey: clickSignInAccountButtonSignUpNewUser
		$I->waitForPageLoad(30); // stepKey: clickSignInAccountButtonSignUpNewUserWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerLoggedInSignUpNewUser
		$I->comment("Exiting Action Group [signUpNewUser] LoginToStorefrontActionGroup");
		$I->comment("Go to product page");
		$I->amOnPage($I->retrieveEntityField('createSimpleProduct', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: navigateToSimpleProductPage
		$I->waitForPageLoad(30); // stepKey: waitForCatalogPageLoad
		$I->comment("Add Product to Shopping Cart");
		$I->comment("Entering Action Group [addToCartFromStorefrontProductPage] AddToCartFromStorefrontProductPageActionGroup");
		$I->click("#product-addtocart-button"); // stepKey: addToCartAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(60); // stepKey: addToCartAddToCartFromStorefrontProductPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAddToCartAddToCartFromStorefrontProductPage
		$I->waitForElementNotVisible("//button/span[text()='Adding...']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddingAddToCartFromStorefrontProductPage
		$I->waitForElementNotVisible("//button/span[text()='Added']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddedAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddToCartFromStorefrontProductPage
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageAddToCartFromStorefrontProductPage
		$I->see("You added " . $I->retrieveEntityField('createSimpleProduct', 'name', 'test') . " to your shopping cart.", "div.message-success.success.message"); // stepKey: seeAddToCartSuccessMessageAddToCartFromStorefrontProductPage
		$I->comment("Exiting Action Group [addToCartFromStorefrontProductPage] AddToCartFromStorefrontProductPageActionGroup");
		$I->comment("Go to Checkout");
		$I->comment("Entering Action Group [goToCheckoutFromMinicart] GoToCheckoutFromMinicartActionGroup");
		$I->waitForElementNotVisible(".counter.qty.empty", 30); // stepKey: waitUpdateQuantityGoToCheckoutFromMinicart
		$I->wait(5); // stepKey: waitMinicartRenderingGoToCheckoutFromMinicart
		$I->click("a.showcart"); // stepKey: clickCartGoToCheckoutFromMinicart
		$I->waitForPageLoad(60); // stepKey: clickCartGoToCheckoutFromMinicartWaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutGoToCheckoutFromMinicart
		$I->waitForPageLoad(30); // stepKey: goToCheckoutGoToCheckoutFromMinicartWaitForPageLoad
		$I->comment("Exiting Action Group [goToCheckoutFromMinicart] GoToCheckoutFromMinicartActionGroup");
		$I->click("//*[@id='checkout-shipping-method-load']//input[@class='radio']"); // stepKey: selectFirstShippingMethod
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask2
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButton
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonWaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext
		$I->waitForPageLoad(30); // stepKey: clickNextWaitForPageLoad
		$I->comment("Checkout select Check/Money Order payment");
		$I->comment("Entering Action Group [selectCheckMoneyPayment] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSelectCheckMoneyPayment
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSelectCheckMoneyPayment
		$I->conditionalClick("//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", "//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", true); // stepKey: selectCheckmoPaymentMethodSelectCheckMoneyPayment
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskAfterPaymentMethodSelectionSelectCheckMoneyPayment
		$I->comment("Exiting Action Group [selectCheckMoneyPayment] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->comment("Click Place Order button");
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrder
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrderWaitForPageLoad
		$I->see("Thank you for your purchase!", ".page-title"); // stepKey: seeSuccessTitle
		$I->see("Your order number is: ", ".checkout-success > p:nth-child(1)"); // stepKey: seeOrderNumber
		$I->see("We'll email you an order confirmation with details and tracking info.", "div.checkout-success"); // stepKey: seeSuccessNotify
		$I->click("a[href*=order_id].order-number"); // stepKey: clickOrderLink
		$I->waitForPageLoad(30); // stepKey: clickOrderLinkWaitForPageLoad
		$I->seeInCurrentUrl("sales/order/view/order_id/"); // stepKey: seeMyOrderPage
		$I->comment("Go to product page");
		$I->amOnPage($I->retrieveEntityField('createSimpleProduct', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: navigateToSimpleProductPage2
		$I->waitForPageLoad(30); // stepKey: waitForCatalogPageLoad2
		$I->comment("Add Product to Shopping Cart");
		$I->comment("Entering Action Group [addToCartFromStorefrontProductPage2] AddToCartFromStorefrontProductPageActionGroup");
		$I->click("#product-addtocart-button"); // stepKey: addToCartAddToCartFromStorefrontProductPage2
		$I->waitForPageLoad(60); // stepKey: addToCartAddToCartFromStorefrontProductPage2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAddToCartAddToCartFromStorefrontProductPage2
		$I->waitForElementNotVisible("//button/span[text()='Adding...']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddingAddToCartFromStorefrontProductPage2
		$I->waitForElementNotVisible("//button/span[text()='Added']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddedAddToCartFromStorefrontProductPage2
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddToCartFromStorefrontProductPage2
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageAddToCartFromStorefrontProductPage2
		$I->see("You added " . $I->retrieveEntityField('createSimpleProduct', 'name', 'test') . " to your shopping cart.", "div.message-success.success.message"); // stepKey: seeAddToCartSuccessMessageAddToCartFromStorefrontProductPage2
		$I->comment("Exiting Action Group [addToCartFromStorefrontProductPage2] AddToCartFromStorefrontProductPageActionGroup");
		$I->comment("Go to Checkout");
		$I->comment("Entering Action Group [goToCheckoutFromMinicart2] GoToCheckoutFromMinicartActionGroup");
		$I->waitForElementNotVisible(".counter.qty.empty", 30); // stepKey: waitUpdateQuantityGoToCheckoutFromMinicart2
		$I->wait(5); // stepKey: waitMinicartRenderingGoToCheckoutFromMinicart2
		$I->click("a.showcart"); // stepKey: clickCartGoToCheckoutFromMinicart2
		$I->waitForPageLoad(60); // stepKey: clickCartGoToCheckoutFromMinicart2WaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutGoToCheckoutFromMinicart2
		$I->waitForPageLoad(30); // stepKey: goToCheckoutGoToCheckoutFromMinicart2WaitForPageLoad
		$I->comment("Exiting Action Group [goToCheckoutFromMinicart2] GoToCheckoutFromMinicartActionGroup");
		$I->click("//*[@id='checkout-shipping-method-load']//input[@class='radio']"); // stepKey: selectFirstShippingMethod2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask3
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButton2
		$I->waitForPageLoad(30); // stepKey: waitForNextButton2WaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext2
		$I->waitForPageLoad(30); // stepKey: clickNext2WaitForPageLoad
		$I->comment("Checkout select Check/Money Order payment");
		$I->comment("Entering Action Group [selectCheckMoneyPayment2] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSelectCheckMoneyPayment2
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSelectCheckMoneyPayment2
		$I->conditionalClick("//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", "//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", true); // stepKey: selectCheckmoPaymentMethodSelectCheckMoneyPayment2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskAfterPaymentMethodSelectionSelectCheckMoneyPayment2
		$I->comment("Exiting Action Group [selectCheckMoneyPayment2] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->comment("Click Place Order button");
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrder2
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrder2WaitForPageLoad
		$I->see("Thank you for your purchase!", ".page-title"); // stepKey: waitForLoadSuccessPage2
		$I->click(".action.primary.continue"); // stepKey: clickContinueShoppingButton
		$I->waitForPageLoad(30); // stepKey: clickContinueShoppingButtonWaitForPageLoad
		$I->see("Home Page", "#maincontent .page-title"); // stepKey: seeHomePageTitle
		$I->seeCurrentUrlEquals(getenv("MAGENTO_BASE_URL")); // stepKey: seeHomePageUrl
		$I->comment("Go to product page");
		$I->amOnPage($I->retrieveEntityField('createSimpleProduct', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: navigateToSimpleProductPage3
		$I->waitForPageLoad(30); // stepKey: waitForCatalogPageLoad3
		$I->comment("Add Product to Shopping Cart");
		$I->comment("Entering Action Group [addToCartFromStorefrontProductPage3] AddToCartFromStorefrontProductPageActionGroup");
		$I->click("#product-addtocart-button"); // stepKey: addToCartAddToCartFromStorefrontProductPage3
		$I->waitForPageLoad(60); // stepKey: addToCartAddToCartFromStorefrontProductPage3WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAddToCartAddToCartFromStorefrontProductPage3
		$I->waitForElementNotVisible("//button/span[text()='Adding...']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddingAddToCartFromStorefrontProductPage3
		$I->waitForElementNotVisible("//button/span[text()='Added']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddedAddToCartFromStorefrontProductPage3
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddToCartFromStorefrontProductPage3
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageAddToCartFromStorefrontProductPage3
		$I->see("You added " . $I->retrieveEntityField('createSimpleProduct', 'name', 'test') . " to your shopping cart.", "div.message-success.success.message"); // stepKey: seeAddToCartSuccessMessageAddToCartFromStorefrontProductPage3
		$I->comment("Exiting Action Group [addToCartFromStorefrontProductPage3] AddToCartFromStorefrontProductPageActionGroup");
		$I->comment("Go to Checkout");
		$I->comment("Entering Action Group [goToCheckoutFromMinicart3] GoToCheckoutFromMinicartActionGroup");
		$I->waitForElementNotVisible(".counter.qty.empty", 30); // stepKey: waitUpdateQuantityGoToCheckoutFromMinicart3
		$I->wait(5); // stepKey: waitMinicartRenderingGoToCheckoutFromMinicart3
		$I->click("a.showcart"); // stepKey: clickCartGoToCheckoutFromMinicart3
		$I->waitForPageLoad(60); // stepKey: clickCartGoToCheckoutFromMinicart3WaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutGoToCheckoutFromMinicart3
		$I->waitForPageLoad(30); // stepKey: goToCheckoutGoToCheckoutFromMinicart3WaitForPageLoad
		$I->comment("Exiting Action Group [goToCheckoutFromMinicart3] GoToCheckoutFromMinicartActionGroup");
		$I->click("//*[@id='checkout-shipping-method-load']//input[@class='radio']"); // stepKey: selectFirstShippingMethod3
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask4
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButton3
		$I->waitForPageLoad(30); // stepKey: waitForNextButton3WaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext3
		$I->waitForPageLoad(30); // stepKey: clickNext3WaitForPageLoad
		$I->comment("Checkout select Check/Money Order payment");
		$I->comment("Entering Action Group [selectCheckMoneyPayment3] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSelectCheckMoneyPayment3
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadSelectCheckMoneyPayment3
		$I->conditionalClick("//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", "//div[@id='checkout-payment-method-load']//div[@class='payment-method']//label//span[contains(., 'Check / Money order')]/../..//input", true); // stepKey: selectCheckmoPaymentMethodSelectCheckMoneyPayment3
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskAfterPaymentMethodSelectionSelectCheckMoneyPayment3
		$I->comment("Exiting Action Group [selectCheckMoneyPayment3] CheckoutSelectCheckMoneyOrderPaymentActionGroup");
		$I->comment("Click Place Order button");
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrder3
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrder3WaitForPageLoad
		$I->see("Thank you for your purchase!", ".page-title"); // stepKey: waitForLoadSuccessPage3
		$I->comment("Check \"Print Receipt\" button is presented (desktop only)");
		$I->seeElement(".print"); // stepKey: seeVisiblePrint
		$I->waitForPageLoad(30); // stepKey: seeVisiblePrintWaitForPageLoad
		$I->resizeWindow(600, 800); // stepKey: resizeWindow
		$I->waitForElementNotVisible(".print", 30); // stepKey: waitInvisiblePrint
		$I->waitForPageLoad(30); // stepKey: waitInvisiblePrintWaitForPageLoad
		$I->dontSeeElement(".print"); // stepKey: seeInvisiblePrint
		$I->waitForPageLoad(30); // stepKey: seeInvisiblePrintWaitForPageLoad
		$I->resizeWindow(1360, 1020); // stepKey: maximizeWindowKey1
		$I->waitForElementVisible(".print", 30); // stepKey: waitVisiblePrint
		$I->waitForPageLoad(30); // stepKey: waitVisiblePrintWaitForPageLoad
		$I->seeElement(".print"); // stepKey: seeVisiblePrint2
		$I->waitForPageLoad(30); // stepKey: seeVisiblePrint2WaitForPageLoad
		$I->comment("See print page");
		$I->click(".print"); // stepKey: clickPrintLink
		$I->waitForPageLoad(30); // stepKey: clickPrintLinkWaitForPageLoad
		$I->switchToWindow(); // stepKey: switchToWindow
		$I->switchToNextTab(); // stepKey: switchToTab
		$I->seeInCurrentUrl("sales/order/print/order_id"); // stepKey: seePrintPage
		$I->seeElement(".page-title span"); // stepKey: seeOrderTitleOnPrint
		$I->switchToWindow(); // stepKey: switchToWindow2
	}
}
