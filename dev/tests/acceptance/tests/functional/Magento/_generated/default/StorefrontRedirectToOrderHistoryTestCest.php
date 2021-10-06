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
 * @Title("MAGETWO-92854: Create Invoice")
 * @Description("Check while order printing URL with an id of not relevant order redirects to order history<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\StorefrontRedirectToOrderHistoryTest.xml<br>")
 * @TestCaseId("MAGETWO-92854")
 * @group sales
 */
class StorefrontRedirectToOrderHistoryTestCest
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
		$I->createEntity("createProduct", "hook", "_defaultProduct", ["createCategory"], []); // stepKey: createProduct
		$I->createEntity("createCustomer", "hook", "Simple_US_Customer", [], []); // stepKey: createCustomer
		$I->createEntity("createCustomer2", "hook", "Simple_US_Customer", [], []); // stepKey: createCustomer2
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createCustomer", "hook"); // stepKey: deleteCustomer
		$I->deleteEntity("createCustomer2", "hook"); // stepKey: deleteCustomer2
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("createProduct", "hook"); // stepKey: deleteProduct
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
	 * @Features({"Sales"})
	 * @Stories({"Create Invoice"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontRedirectToOrderHistoryTest(AcceptanceTester $I)
	{
		$I->comment("Log in to Storefront as Customer 1");
		$I->comment("Entering Action Group [signUp] LoginToStorefrontActionGroup");
		$I->amOnPage("/customer/account/login/"); // stepKey: amOnSignInPageSignUp
		$I->waitForPageLoad(30); // stepKey: waitPageFullyLoadedSignUp
		$I->waitForElementVisible("#email", 30); // stepKey: waitFormAppearsSignUp
		$I->fillField("#email", $I->retrieveEntityField('createCustomer', 'email', 'test')); // stepKey: fillEmailSignUp
		$I->fillField("#pass", $I->retrieveEntityField('createCustomer', 'password', 'test')); // stepKey: fillPasswordSignUp
		$I->click("#send2"); // stepKey: clickSignInAccountButtonSignUp
		$I->waitForPageLoad(30); // stepKey: clickSignInAccountButtonSignUpWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerLoggedInSignUp
		$I->comment("Exiting Action Group [signUp] LoginToStorefrontActionGroup");
		$I->comment("Create an order at Storefront as Customer 1");
		$I->comment("Entering Action Group [createOrderToPrint] CreateOrderToPrintPageWithSelectedPaymentMethodActionGroup");
		$I->amOnPage("/" . $I->retrieveEntityField('createCategory', 'name', 'test') . ".html"); // stepKey: onCategoryPageCreateOrderToPrint
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1CreateOrderToPrint
		$I->moveMouseOver(".product-item-info"); // stepKey: hoverProductCreateOrderToPrint
		$I->click("button.action.tocart.primary"); // stepKey: addToCartCreateOrderToPrint
		$I->waitForElementVisible("div.message-success", 30); // stepKey: waitForProductAddedCreateOrderToPrint
		$I->click("a.showcart"); // stepKey: clickCartCreateOrderToPrint
		$I->waitForPageLoad(60); // stepKey: clickCartCreateOrderToPrintWaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutCreateOrderToPrint
		$I->waitForPageLoad(30); // stepKey: goToCheckoutCreateOrderToPrintWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2CreateOrderToPrint
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskCreateOrderToPrint
		$I->click("//*[@id='checkout-shipping-method-load']//input[@class='radio']"); // stepKey: selectFirstShippingMethodCreateOrderToPrint
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask2CreateOrderToPrint
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButtonCreateOrderToPrint
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonCreateOrderToPrintWaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNextCreateOrderToPrint
		$I->waitForPageLoad(30); // stepKey: clickNextCreateOrderToPrintWaitForPageLoad
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoadedCreateOrderToPrint
		$I->conditionalClick("input#checkmo.radio", ".payment-method._active div.billing-address-details", false); // stepKey: clickCheckMoneyOrderPaymentCreateOrderToPrint
		$I->waitForElement(".payment-method._active button.action.primary.checkout", 30); // stepKey: waitForPlaceOrderButtonCreateOrderToPrint
		$I->waitForPageLoad(30); // stepKey: waitForPlaceOrderButtonCreateOrderToPrintWaitForPageLoad
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrderCreateOrderToPrint
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrderCreateOrderToPrintWaitForPageLoad
		$I->click("a[href*=order_id].order-number"); // stepKey: clickOrderLinkCreateOrderToPrint
		$I->waitForPageLoad(30); // stepKey: clickOrderLinkCreateOrderToPrintWaitForPageLoad
		$I->click("a.action.print"); // stepKey: clickPrintOrderLinkCreateOrderToPrint
		$I->waitForPageLoad(30); // stepKey: clickPrintOrderLinkCreateOrderToPrintWaitForPageLoad
		$I->comment("Exiting Action Group [createOrderToPrint] CreateOrderToPrintPageWithSelectedPaymentMethodActionGroup");
		$I->comment("Go to 'print order' page by grabbed order id");
		$grabOrderIdFromURL = $I->grabFromCurrentUrl("~/order_id/(\d+)/~"); // stepKey: grabOrderIdFromURL
		$I->switchToNextTab(); // stepKey: switchToPrintPage
		$I->waitForElement(".preview-area", 30); // stepKey: checkPrintPage
		$I->openNewTab(); // stepKey: openNewTab
		$I->switchToNextTab(); // stepKey: switchForward
		$I->amOnPage("/sales/order/print/order_id/{$grabOrderIdFromURL}/"); // stepKey: duplicatePrintPage
		$I->comment("Log out as customer 1");
		$I->switchToNextTab(); // stepKey: switchForward2
		$I->openNewTab(); // stepKey: openNewTab2
		$I->amOnPage("/customer/account/logout/"); // stepKey: signOut
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitSignOutPage
		$I->comment("Log in to Storefront as Customer 2");
		$I->comment("Entering Action Group [signUp2] LoginToStorefrontActionGroup");
		$I->amOnPage("/customer/account/login/"); // stepKey: amOnSignInPageSignUp2
		$I->waitForPageLoad(30); // stepKey: waitPageFullyLoadedSignUp2
		$I->waitForElementVisible("#email", 30); // stepKey: waitFormAppearsSignUp2
		$I->fillField("#email", $I->retrieveEntityField('createCustomer2', 'email', 'test')); // stepKey: fillEmailSignUp2
		$I->fillField("#pass", $I->retrieveEntityField('createCustomer2', 'password', 'test')); // stepKey: fillPasswordSignUp2
		$I->click("#send2"); // stepKey: clickSignInAccountButtonSignUp2
		$I->waitForPageLoad(30); // stepKey: clickSignInAccountButtonSignUp2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerLoggedInSignUp2
		$I->comment("Exiting Action Group [signUp2] LoginToStorefrontActionGroup");
		$I->comment("Create an order at Storefront as Customer 2");
		$I->comment("Entering Action Group [createOrderToPrint2] CreateOrderToPrintPageWithSelectedPaymentMethodActionGroup");
		$I->amOnPage("/" . $I->retrieveEntityField('createCategory', 'name', 'test') . ".html"); // stepKey: onCategoryPageCreateOrderToPrint2
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1CreateOrderToPrint2
		$I->moveMouseOver(".product-item-info"); // stepKey: hoverProductCreateOrderToPrint2
		$I->click("button.action.tocart.primary"); // stepKey: addToCartCreateOrderToPrint2
		$I->waitForElementVisible("div.message-success", 30); // stepKey: waitForProductAddedCreateOrderToPrint2
		$I->click("a.showcart"); // stepKey: clickCartCreateOrderToPrint2
		$I->waitForPageLoad(60); // stepKey: clickCartCreateOrderToPrint2WaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutCreateOrderToPrint2
		$I->waitForPageLoad(30); // stepKey: goToCheckoutCreateOrderToPrint2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2CreateOrderToPrint2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskCreateOrderToPrint2
		$I->click("//*[@id='checkout-shipping-method-load']//input[@class='radio']"); // stepKey: selectFirstShippingMethodCreateOrderToPrint2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMask2CreateOrderToPrint2
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButtonCreateOrderToPrint2
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonCreateOrderToPrint2WaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNextCreateOrderToPrint2
		$I->waitForPageLoad(30); // stepKey: clickNextCreateOrderToPrint2WaitForPageLoad
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoadedCreateOrderToPrint2
		$I->conditionalClick("input#checkmo.radio", ".payment-method._active div.billing-address-details", false); // stepKey: clickCheckMoneyOrderPaymentCreateOrderToPrint2
		$I->waitForElement(".payment-method._active button.action.primary.checkout", 30); // stepKey: waitForPlaceOrderButtonCreateOrderToPrint2
		$I->waitForPageLoad(30); // stepKey: waitForPlaceOrderButtonCreateOrderToPrint2WaitForPageLoad
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrderCreateOrderToPrint2
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrderCreateOrderToPrint2WaitForPageLoad
		$I->click("a[href*=order_id].order-number"); // stepKey: clickOrderLinkCreateOrderToPrint2
		$I->waitForPageLoad(30); // stepKey: clickOrderLinkCreateOrderToPrint2WaitForPageLoad
		$I->click("a.action.print"); // stepKey: clickPrintOrderLinkCreateOrderToPrint2
		$I->waitForPageLoad(30); // stepKey: clickPrintOrderLinkCreateOrderToPrint2WaitForPageLoad
		$I->comment("Exiting Action Group [createOrderToPrint2] CreateOrderToPrintPageWithSelectedPaymentMethodActionGroup");
		$I->comment("Try to load 'print order' page with not relevant order id to be redirected to 'order history' page");
		$I->switchToNextTab(); // stepKey: switchToPrintPage2
		$I->waitForElement(".preview-area", 30); // stepKey: checkPrintPage2
		$I->openNewTab(); // stepKey: openNewTab3
		$I->switchToNextTab(); // stepKey: switchForward4
		$I->amOnPage("/sales/order/print/order_id/{$grabOrderIdFromURL}/"); // stepKey: duplicatePrintPage2
		$I->seeElement("//*[@class='page-title']//*[contains(text(), 'My Orders')]"); // stepKey: waitOrderHistoryPage
	}
}
