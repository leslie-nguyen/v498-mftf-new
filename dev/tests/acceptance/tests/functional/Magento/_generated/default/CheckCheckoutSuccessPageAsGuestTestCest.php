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
 * @Title("MC-16490: Guest Checkout - elements of success page are presented for placed order as guest")
 * @Description("To be sure that other elements of Success page are presented for placed order as Guest<h3>Test files</h3>vendor\magento\module-checkout\Test\Mftf\Test\CheckCheckoutSuccessPageTest\CheckCheckoutSuccessPageAsGuestTest.xml<br>")
 * @TestCaseId("MC-16490")
 * @group checkout
 */
class CheckCheckoutSuccessPageAsGuestTestCest
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
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [adminLogout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageAdminLogout
		$I->comment("Exiting Action Group [adminLogout] AdminLogoutActionGroup");
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteProduct
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
	 * @Stories({"Success page elements are presented for placed order as Guest"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CheckCheckoutSuccessPageAsGuestTest(AcceptanceTester $I)
	{
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
		$I->comment("Entering Action Group [guestCheckoutFillingShippingSection] GuestCheckoutFillingShippingSectionActionGroup");
		$I->fillField("input[id*=customer-email]", msq("CustomerEntityOne") . "test@email.com"); // stepKey: enterEmailGuestCheckoutFillingShippingSection
		$I->fillField("input[name=firstname]", "John"); // stepKey: enterFirstNameGuestCheckoutFillingShippingSection
		$I->fillField("input[name=lastname]", "Doe"); // stepKey: enterLastNameGuestCheckoutFillingShippingSection
		$I->fillField("input[name='street[0]']", "7700 W Parmer Ln"); // stepKey: enterStreetGuestCheckoutFillingShippingSection
		$I->fillField("input[name=city]", "Austin"); // stepKey: enterCityGuestCheckoutFillingShippingSection
		$I->selectOption("select[name=region_id]", "Texas"); // stepKey: selectRegionGuestCheckoutFillingShippingSection
		$I->fillField("input[name=postcode]", "78729"); // stepKey: enterPostcodeGuestCheckoutFillingShippingSection
		$I->fillField("input[name=telephone]", "1234568910"); // stepKey: enterTelephoneGuestCheckoutFillingShippingSection
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskGuestCheckoutFillingShippingSection
		$I->waitForElement("//div[@id='checkout-shipping-method-load']//td[contains(., '')]/..//input/following-sibling::label", 30); // stepKey: waitForShippingMethodGuestCheckoutFillingShippingSection
		$I->click("//div[@id='checkout-shipping-method-load']//td[contains(., '')]/..//input/following-sibling::label"); // stepKey: selectShippingMethodGuestCheckoutFillingShippingSection
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButtonGuestCheckoutFillingShippingSection
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonGuestCheckoutFillingShippingSectionWaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNextGuestCheckoutFillingShippingSection
		$I->waitForPageLoad(30); // stepKey: clickNextGuestCheckoutFillingShippingSectionWaitForPageLoad
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoadedGuestCheckoutFillingShippingSection
		$I->seeInCurrentUrl("/checkout/#payment"); // stepKey: assertCheckoutPaymentUrlGuestCheckoutFillingShippingSection
		$I->comment("Exiting Action Group [guestCheckoutFillingShippingSection] GuestCheckoutFillingShippingSectionActionGroup");
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
		$I->see("Thank you for your purchase!", ".page-title"); // stepKey: waitForLoadSuccessPage
		$I->comment("See success messages");
		$I->see("Thank you for your purchase!", ".page-title"); // stepKey: seeSuccessTitle
		$I->see("Your order # is: ", ".checkout-success > p:nth-child(1)"); // stepKey: seeOrderNumber
		$I->comment("Check register section");
		$I->see("We'll email you an order confirmation with details and tracking info.", "div.checkout-success"); // stepKey: seeSuccessNotify
		$I->see("You can track your order status by creating an account.", "#registration p:nth-child(1)"); // stepKey: seeRegisterMessage
		$I->see("Email Address: " . msq("CustomerEntityOne") . "test@email.com", ".success-order .email"); // stepKey: seeCustomerEmail
		$I->seeElement("[data-bind*=\"i18n: 'Create an Account'\"]"); // stepKey: seeVisibleCreateAccountButton
		$I->waitForPageLoad(30); // stepKey: seeVisibleCreateAccountButtonWaitForPageLoad
		$I->click("[data-bind*=\"i18n: 'Create an Account'\"]"); // stepKey: clickCreateAccountButton
		$I->waitForPageLoad(30); // stepKey: clickCreateAccountButtonWaitForPageLoad
		$I->seeInCurrentUrl("/customer/account/create/"); // stepKey: seeCreateAccountPage
		$I->see("Create New Customer Account", "#maincontent .page-title"); // stepKey: seeCreateAccountPageTitle
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
		$I->comment("Entering Action Group [guestCheckoutFillingShippingSection2] GuestCheckoutFillingShippingSectionActionGroup");
		$I->fillField("input[id*=customer-email]", msq("CustomerEntityOne") . "test@email.com"); // stepKey: enterEmailGuestCheckoutFillingShippingSection2
		$I->fillField("input[name=firstname]", "John"); // stepKey: enterFirstNameGuestCheckoutFillingShippingSection2
		$I->fillField("input[name=lastname]", "Doe"); // stepKey: enterLastNameGuestCheckoutFillingShippingSection2
		$I->fillField("input[name='street[0]']", "7700 W Parmer Ln"); // stepKey: enterStreetGuestCheckoutFillingShippingSection2
		$I->fillField("input[name=city]", "Austin"); // stepKey: enterCityGuestCheckoutFillingShippingSection2
		$I->selectOption("select[name=region_id]", "Texas"); // stepKey: selectRegionGuestCheckoutFillingShippingSection2
		$I->fillField("input[name=postcode]", "78729"); // stepKey: enterPostcodeGuestCheckoutFillingShippingSection2
		$I->fillField("input[name=telephone]", "1234568910"); // stepKey: enterTelephoneGuestCheckoutFillingShippingSection2
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskGuestCheckoutFillingShippingSection2
		$I->waitForElement("//div[@id='checkout-shipping-method-load']//td[contains(., '')]/..//input/following-sibling::label", 30); // stepKey: waitForShippingMethodGuestCheckoutFillingShippingSection2
		$I->click("//div[@id='checkout-shipping-method-load']//td[contains(., '')]/..//input/following-sibling::label"); // stepKey: selectShippingMethodGuestCheckoutFillingShippingSection2
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButtonGuestCheckoutFillingShippingSection2
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonGuestCheckoutFillingShippingSection2WaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNextGuestCheckoutFillingShippingSection2
		$I->waitForPageLoad(30); // stepKey: clickNextGuestCheckoutFillingShippingSection2WaitForPageLoad
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoadedGuestCheckoutFillingShippingSection2
		$I->seeInCurrentUrl("/checkout/#payment"); // stepKey: assertCheckoutPaymentUrlGuestCheckoutFillingShippingSection2
		$I->comment("Exiting Action Group [guestCheckoutFillingShippingSection2] GuestCheckoutFillingShippingSectionActionGroup");
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
		$I->comment("Continue shopping");
		$I->click(".action.primary.continue"); // stepKey: clickContinueShoppingButton
		$I->waitForPageLoad(30); // stepKey: clickContinueShoppingButtonWaitForPageLoad
		$I->seeCurrentUrlEquals(getenv("MAGENTO_BASE_URL")); // stepKey: seeHomePageUrl
		$I->see("Home Page", "#maincontent .page-title"); // stepKey: seeHomePageTitle
	}
}
