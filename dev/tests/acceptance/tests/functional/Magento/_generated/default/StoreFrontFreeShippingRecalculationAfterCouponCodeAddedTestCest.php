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
 * @Title("MAGETWO-96537: Checkout Free Shipping Recalculation after Coupon Code Added")
 * @Description("User should be able to do checkout free shipping recalculation after adding coupon code<h3>Test files</h3>vendor\magento\module-checkout\Test\Mftf\Test\StoreFrontFreeShippingRecalculationAfterCouponCodeAddedTest.xml<br>")
 * @TestCaseId("MAGETWO-96537")
 * @group Checkout
 */
class StoreFrontFreeShippingRecalculationAfterCouponCodeAddedTestCest
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
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$createSimpleUsCustomerFields['group_id'] = "1";
		$I->createEntity("createSimpleUsCustomer", "hook", "Simple_US_Customer", [], $createSimpleUsCustomerFields); // stepKey: createSimpleUsCustomer
		$I->createEntity("defaultCategory", "hook", "_defaultCategory", [], []); // stepKey: defaultCategory
		$simpleProductFields['price'] = "90";
		$I->createEntity("simpleProduct", "hook", "_defaultProduct", ["defaultCategory"], $simpleProductFields); // stepKey: simpleProduct
		$I->comment("It is default for FlatRate");
		$I->createEntity("enableFlatRate", "hook", "FlatRateShippingMethodConfig", [], []); // stepKey: enableFlatRate
		$I->createEntity("freeShippingMethodsSettingConfig", "hook", "FreeShippingMethodsSettingConfig", [], []); // stepKey: freeShippingMethodsSettingConfig
		$I->createEntity("minimumOrderAmount90", "hook", "MinimumOrderAmount90", [], []); // stepKey: minimumOrderAmount90
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Entering Action Group [createCartPriceRule] AdminCreateCartPriceRuleWithCouponCodeActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales_rule/promo_quote/"); // stepKey: amOnCartPriceListCreateCartPriceRule
		$I->waitForPageLoad(30); // stepKey: waitForPriceListCreateCartPriceRule
		$I->click("#add"); // stepKey: clickAddNewRuleCreateCartPriceRule
		$I->waitForPageLoad(30); // stepKey: clickAddNewRuleCreateCartPriceRuleWaitForPageLoad
		$I->fillField("input[name='name']", "CartPriceRule" . msq("CatPriceRule")); // stepKey: fillRuleNameCreateCartPriceRule
		$I->selectOption("select[name='coupon_type']", "Specific Coupon"); // stepKey: selectCouponTypeCreateCartPriceRule
		$I->waitForElementVisible("input[name='coupon_code']", 30); // stepKey: waitForElementVisibleCreateCartPriceRule
		$I->fillField("input[name='coupon_code']", "CouponCode" . msq("CatPriceRule")); // stepKey: fillCouponCodeCreateCartPriceRule
		$I->fillField("//input[@name='uses_per_coupon']", "99"); // stepKey: fillUserPerCouponCreateCartPriceRule
		$I->selectOption("select[name='website_ids']", "Main Website"); // stepKey: selectWebsitesCreateCartPriceRule
		$I->selectOption("select[name='customer_group_ids']", ['NOT LOGGED IN',  'General',  'Wholesale',  'Retailer']); // stepKey: selectCustomerGroupCreateCartPriceRule
		$I->click("div[data-index='actions']"); // stepKey: clickToExpandActionsCreateCartPriceRule
		$I->waitForPageLoad(30); // stepKey: clickToExpandActionsCreateCartPriceRuleWaitForPageLoad
		$I->selectOption("select[name='simple_action']", "Fixed amount discount for whole cart"); // stepKey: selectActionTypeToFixedCreateCartPriceRule
		$I->fillField("input[name='discount_amount']", "1"); // stepKey: fillDiscountAmountCreateCartPriceRule
		$I->click("#save"); // stepKey: clickSaveButtonCreateCartPriceRule
		$I->waitForPageLoad(30); // stepKey: clickSaveButtonCreateCartPriceRuleWaitForPageLoad
		$I->see("You saved the rule.", "div.message.message-success.success"); // stepKey: seeSuccessMessageCreateCartPriceRule
		$I->comment("Exiting Action Group [createCartPriceRule] AdminCreateCartPriceRuleWithCouponCodeActionGroup");
		$I->comment("Entering Action Group [loginToStoreFront] LoginToStorefrontActionGroup");
		$I->amOnPage("/customer/account/login/"); // stepKey: amOnSignInPageLoginToStoreFront
		$I->waitForPageLoad(30); // stepKey: waitPageFullyLoadedLoginToStoreFront
		$I->waitForElementVisible("#email", 30); // stepKey: waitFormAppearsLoginToStoreFront
		$I->fillField("#email", $I->retrieveEntityField('createSimpleUsCustomer', 'email', 'hook')); // stepKey: fillEmailLoginToStoreFront
		$I->fillField("#pass", $I->retrieveEntityField('createSimpleUsCustomer', 'password', 'hook')); // stepKey: fillPasswordLoginToStoreFront
		$I->click("#send2"); // stepKey: clickSignInAccountButtonLoginToStoreFront
		$I->waitForPageLoad(30); // stepKey: clickSignInAccountButtonLoginToStoreFrontWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCustomerLoggedInLoginToStoreFront
		$I->comment("Exiting Action Group [loginToStoreFront] LoginToStorefrontActionGroup");
		$I->amOnPage($I->retrieveEntityField('simpleProduct', 'name', 'hook') . ".html"); // stepKey: navigateToProductPage
		$I->waitForPageLoad(30); // stepKey: waitForProductPage
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("simpleProduct", "hook"); // stepKey: deleteProduct
		$I->deleteEntity("defaultCategory", "hook"); // stepKey: deleteCategory
		$I->createEntity("defaultShippingMethodsConfig", "hook", "DefaultShippingMethodsConfig", [], []); // stepKey: defaultShippingMethodsConfig
		$I->createEntity("defaultMinimumOrderAmount", "hook", "DefaultMinimumOrderAmount", [], []); // stepKey: defaultMinimumOrderAmount
		$I->deleteEntity("createSimpleUsCustomer", "hook"); // stepKey: deleteCustomer
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Entering Action Group [deleteCartPriceRule] DeleteCartPriceRuleByName");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales_rule/promo_quote/"); // stepKey: amOnCartPriceListDeleteCartPriceRule
		$I->waitForPageLoad(30); // stepKey: waitForPriceListDeleteCartPriceRule
		$I->fillField("input[name='name']", "CartPriceRule" . msq("CatPriceRule")); // stepKey: filterByNameDeleteCartPriceRule
		$I->click("#promo_quote_grid button[title='Search']"); // stepKey: doFilterDeleteCartPriceRule
		$I->waitForPageLoad(30); // stepKey: doFilterDeleteCartPriceRuleWaitForPageLoad
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: goToEditRulePageDeleteCartPriceRule
		$I->waitForPageLoad(30); // stepKey: goToEditRulePageDeleteCartPriceRuleWaitForPageLoad
		$I->click("button#delete"); // stepKey: clickDeleteButtonDeleteCartPriceRule
		$I->waitForPageLoad(30); // stepKey: clickDeleteButtonDeleteCartPriceRuleWaitForPageLoad
		$I->click("button.action-accept"); // stepKey: confirmDeleteDeleteCartPriceRule
		$I->waitForPageLoad(30); // stepKey: confirmDeleteDeleteCartPriceRuleWaitForPageLoad
		$I->comment("Exiting Action Group [deleteCartPriceRule] DeleteCartPriceRuleByName");
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
	 * @Stories({"Checkout Free Shipping Recalculation after Coupon Code Added"})
	 * @Features({"Checkout"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StoreFrontFreeShippingRecalculationAfterCouponCodeAddedTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [applyCartRule] ApplyCartRuleOnStorefrontActionGroup");
		$I->click("#product-addtocart-button"); // stepKey: addToCartApplyCartRule
		$I->waitForPageLoad(60); // stepKey: addToCartApplyCartRuleWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAddToCartApplyCartRule
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageApplyCartRule
		$I->waitForText("You added " . $I->retrieveEntityField('simpleProduct', 'name', 'test') . " to your shopping cart.", 30); // stepKey: waitForTextApplyCartRule
		$I->amOnPage("/checkout/cart"); // stepKey: goToCheckoutPageApplyCartRule
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad1ApplyCartRule
		$I->click("//*[text()='Apply Discount Code']"); // stepKey: clickToDiscountTabApplyCartRule
		$I->fillField("#coupon_code", "CouponCode" . msq("CatPriceRule")); // stepKey: fillCouponCodeApplyCartRule
		$I->click("//span[text()='Apply Discount']"); // stepKey: applyCodeApplyCartRule
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad2ApplyCartRule
		$I->comment("Exiting Action Group [applyCartRule] ApplyCartRuleOnStorefrontActionGroup");
		$I->comment("Entering Action Group [goToCheckoutFromMinicart1] GoToCheckoutFromMinicartActionGroup");
		$I->waitForElementNotVisible(".counter.qty.empty", 30); // stepKey: waitUpdateQuantityGoToCheckoutFromMinicart1
		$I->wait(5); // stepKey: waitMinicartRenderingGoToCheckoutFromMinicart1
		$I->click("a.showcart"); // stepKey: clickCartGoToCheckoutFromMinicart1
		$I->waitForPageLoad(60); // stepKey: clickCartGoToCheckoutFromMinicart1WaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutGoToCheckoutFromMinicart1
		$I->waitForPageLoad(30); // stepKey: goToCheckoutGoToCheckoutFromMinicart1WaitForPageLoad
		$I->comment("Exiting Action Group [goToCheckoutFromMinicart1] GoToCheckoutFromMinicartActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForpageLoad1
		$I->dontSee("//div[@id='checkout-shipping-method-load']//td[contains(., 'Free')]/.."); // stepKey: dontSeeFreeShipping
		$I->comment("Entering Action Group [goToShoppingCartPage] StorefrontCartPageOpenActionGroup");
		$I->amOnPage("/checkout/cart"); // stepKey: openCartPageGoToShoppingCartPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadedGoToShoppingCartPage
		$I->comment("Exiting Action Group [goToShoppingCartPage] StorefrontCartPageOpenActionGroup");
		$I->conditionalClick("//*[text()='Apply Discount Code']", "#coupon_code", false); // stepKey: clickIfDiscountTabClosed1
		$I->waitForPageLoad(30); // stepKey: waitForCouponTabOpen1
		$I->click("//button[@value='Cancel Coupon']"); // stepKey: cancelCoupon
		$I->waitForPageLoad(30); // stepKey: waitForCancel
		$I->see("You canceled the coupon code."); // stepKey: seeCancellationMessage
		$I->comment("Entering Action Group [goToCheckoutFromMinicart2] GoToCheckoutFromMinicartActionGroup");
		$I->waitForElementNotVisible(".counter.qty.empty", 30); // stepKey: waitUpdateQuantityGoToCheckoutFromMinicart2
		$I->wait(5); // stepKey: waitMinicartRenderingGoToCheckoutFromMinicart2
		$I->click("a.showcart"); // stepKey: clickCartGoToCheckoutFromMinicart2
		$I->waitForPageLoad(60); // stepKey: clickCartGoToCheckoutFromMinicart2WaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutGoToCheckoutFromMinicart2
		$I->waitForPageLoad(30); // stepKey: goToCheckoutGoToCheckoutFromMinicart2WaitForPageLoad
		$I->comment("Exiting Action Group [goToCheckoutFromMinicart2] GoToCheckoutFromMinicartActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethods
		$I->click("//div[@id='checkout-shipping-method-load']//td[contains(., 'Free')]/.."); // stepKey: chooseFreeShipping
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext1
		$I->waitForPageLoad(30); // stepKey: clickNext1WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForReviewAndPayments1
		$I->conditionalClick("//*[text()='Apply Discount Code']", "#coupon_code", false); // stepKey: clickIfDiscountTabClosed2
		$I->waitForPageLoad(30); // stepKey: waitForCouponTabOpen2
		$I->fillField("#discount-code", "CouponCode" . msq("CatPriceRule")); // stepKey: fillCouponCode
		$I->click("//span[text()='Apply Discount']"); // stepKey: applyCode
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->see("Your coupon was successfully applied."); // stepKey: seeSuccessMessage
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrder1
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrder1WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForError
		$I->see("The shipping method is missing. Select the shipping method and try again."); // stepKey: seeShippingMethodError
		$I->amOnPage("/checkout/#shipping"); // stepKey: navigateToShippingPage
		$I->waitForPageLoad(30); // stepKey: waitForShippingPageLoad
		$I->click("//div[@id='checkout-shipping-method-load']//td[contains(., 'Flat Rate')]/.."); // stepKey: chooseFlatRateShipping
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext2
		$I->waitForPageLoad(30); // stepKey: clickNext2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForReviewAndPayments2
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrder2
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrder2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSuccessfullyPlacedOrder
		$I->see("Thank you for your purchase!"); // stepKey: seeSuccessMessageForPlacedOrder
	}
}
