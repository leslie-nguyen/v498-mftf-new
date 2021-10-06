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
 * @Description("Checkout as guest with Credit Card - Stripe<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\CheckoutAsGuestCreditCardTest.xml<br>")
 * @TestCaseId("FLOW01")
 * @group CheckoutFlow
 */
class CheckoutAsGuestCreditCardTestCest
{
	/**
	 * @Features({"Theme"})
	 * @Stories({"Checkout as guest with Credit Card - Stripe"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CheckoutAsGuestCreditCardTest(AcceptanceTester $I)
	{
		$I->comment("Access Cate Listing page page");
		$I->comment("Entering Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("<maximizeWindow stepKey=\"maximizeWindow\"/>");
		$I->amOnPage("/"); // stepKey: accessHomeAccessPageAndVerifyJSError
		$I->amOnPage("/en_ca/mens-cycling-jerseys.html"); // stepKey: redirectToTargetPageAccessPageAndVerifyJSError
		$I->dontSeeJsError(); // stepKey: dontSeeJsErrorAccessPageAndVerifyJSError
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAccessPageAndVerifyJSError
		$I->comment("Exiting Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("Entering Action Group [closeCookiePopup] CloseCookiePopupActionGroup");
		$I->waitForElement("#onetrust-close-btn-container button", 30); // stepKey: waitForOneTrustCookieDisplayedCloseCookiePopup
		$I->click("#onetrust-close-btn-container button"); // stepKey: closeCookiePopupCloseCookiePopup
		$I->comment("Exiting Action Group [closeCookiePopup] CloseCookiePopupActionGroup");
		$I->comment("Check product link");
		$I->comment("Entering Action Group [verifyFirstProductLinkInCateListingPage] VerifyFirstProductLinkInProductListingPageActionGroup");
		$I->comment("Grab first product ID, name in product listing page");
		$grabFirstProductIdInListingPageVerifyFirstProductLinkInCateListingPage = $I->grabAttributeFrom("(//div[contains(@class,'price-box')][contains(@data-product-id,'')])[1]", "data-product-id"); // stepKey: grabFirstProductIdInListingPageVerifyFirstProductLinkInCateListingPage
		$grabFirstProductNameInListingPageVerifyFirstProductLinkInCateListingPage = $I->grabTextFrom("(//strong[contains(@class,'product-item-name')])[1]"); // stepKey: grabFirstProductNameInListingPageVerifyFirstProductLinkInCateListingPage
		$I->comment("Grab product ID, name in product page");
		$I->scrollTo(".breadcrumbs ul"); // stepKey: scrollToBreadcrumbVerifyFirstProductLinkInCateListingPage
		$I->click("(//div[@class='product-photo-wrapper desktop'])[1]"); // stepKey: clickOnFirstProductImageVerifyFirstProductLinkInCateListingPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadVerifyFirstProductLinkInCateListingPage
		$grabProductIdInPDPVerifyFirstProductLinkInCateListingPage = $I->grabAttributeFrom(".price-box.price-final_price", "data-product-id"); // stepKey: grabProductIdInPDPVerifyFirstProductLinkInCateListingPage
		$I->comment("Assert product ID, name in product listing & PDP are matched");
		$I->assertEquals("$grabFirstProductIdInListingPageVerifyFirstProductLinkInCateListingPage", "$grabProductIdInPDPVerifyFirstProductLinkInCateListingPage", "Product ID does not matched"); // stepKey: assertProductIDBetweenListingPageAndPDPVerifyFirstProductLinkInCateListingPage
		$I->see($grabFirstProductNameInListingPageVerifyFirstProductLinkInCateListingPage, "strong[itemprop='name']"); // stepKey: seeProductNameMatchedVerifyFirstProductLinkInCateListingPage
		$I->comment("Exiting Action Group [verifyFirstProductLinkInCateListingPage] VerifyFirstProductLinkInProductListingPageActionGroup");
		$I->comment("Check add product to cart & verify in mini cart");
		$I->amOnPage("/en_ca/test-2.html"); // stepKey: accessConfigurablePdp
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->comment("Entering Action Group [addConfigurablePrdToCart] AddConfigurableProductToCartActionGroup");
		$I->click("//div[contains(@class,'swatch-attribute')][contains(@class,'color')]"); // stepKey: clickToOpenSizeDropdownAddConfigurablePrdToCart
		$I->click("//div[contains(@class,'swatch-attribute')][contains(@class,'color')]//*[contains(@class,'swatch-option')][contains(text(),'Navy')]"); // stepKey: selectAttributeOptionAddConfigurablePrdToCart
		$I->click("#product-addtocart-button"); // stepKey: clickOnAddToCartButtonAddConfigurablePrdToCart
		$I->waitForPageLoad(60); // stepKey: clickOnAddToCartButtonAddConfigurablePrdToCartWaitForPageLoad
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxLoadAddConfigurablePrdToCart
		$I->seeElement(".block-minicart"); // stepKey: seeMiniCartBlockAddConfigurablePrdToCart
		$I->waitForPageLoad(30); // stepKey: seeMiniCartBlockAddConfigurablePrdToCartWaitForPageLoad
		$I->comment("Exiting Action Group [addConfigurablePrdToCart] AddConfigurableProductToCartActionGroup");
		$getProductPriceInPdp = $I->grabTextFrom(".price-box"); // stepKey: getProductPriceInPdp
		$I->comment("Entering Action Group [assertItemInMiniCart] VerifyMiniCartItemsActionGroup");
		$I->see("test 2", ".minicart-items"); // stepKey: seeProductNameInMiniCartAssertItemInMiniCart
		$I->see($getProductPriceInPdp, ".minicart-items"); // stepKey: seeProductPriceInMiniCartAssertItemInMiniCart
		$I->see("Color", "//a[text()='test 2']/../following-sibling::div[contains(@class,'options')]//dt[@class='label']"); // stepKey: seeAttributeNameAssertItemInMiniCart
		$I->see("Navy", "//a[text()='test 2']/../following-sibling::div[contains(@class,'options')]//dd/span"); // stepKey: seeAttributeOptionAssertItemInMiniCart
		$I->seeElement("#top-cart-btn-checkout"); // stepKey: seeCheckOutButtonInMiniCartAssertItemInMiniCart
		$I->waitForPageLoad(30); // stepKey: seeCheckOutButtonInMiniCartAssertItemInMiniCartWaitForPageLoad
		$I->seeElement("//ol[@id='mini-cart']//img[@class='product-image-photo']"); // stepKey: seeProductImageAssertItemInMiniCart
		$I->comment("Exiting Action Group [assertItemInMiniCart] VerifyMiniCartItemsActionGroup");
		$I->comment("Check redirect to Cart page");
		$I->conditionalClick("a#cafedu-minicart-overlay", ".block-minicart", false); // stepKey: openMiniCart
		$I->waitForPageLoad(30); // stepKey: openMiniCartWaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: clickCheckoutButtonInMiniCart
		$I->waitForPageLoad(30); // stepKey: clickCheckoutButtonInMiniCartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCartPageLoad
		$I->seeInCurrentUrl("/checkout/cart/"); // stepKey: seeCartLinkInCurrentUrl
		$I->comment("Check cart page display");
		$I->comment("Entering Action Group [verifyCartSummaryCartTotalAndCheckoutButtonDisplayed] VerifyCartSummaryBlockCartTotalBlockAndCheckoutButtonActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement("span[data-th='Subtotal']"); // stepKey: verifySubTotalPriceDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement("//*[@id='cart-totals']//tr[contains(@class,'shipping')]//span[@class='price']"); // stepKey: verifyShippingPriceDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement(".grand.totals .amount .price"); // stepKey: verifyOrderTotalPriceDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement("main .action.primary.checkout span"); // stepKey: verifyCheckoutButtonDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->waitForPageLoad(30); // stepKey: verifyCheckoutButtonDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayedWaitForPageLoad
		$I->seeElement("main .action.continue"); // stepKey: verifyContinueShoppingButtonDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement("#block-shiiping-return"); // stepKey: verifyShippingAndReturnsTabDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement("#block-canwe-help"); // stepKey: verifyCanWeHelpTabDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement("#block-secure-payments"); // stepKey: verifySecurePaymentsTabDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement("#block-giftcard"); // stepKey: verifyRedeemAGiftCardTabDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->seeElement("#block-discount"); // stepKey: verifyDiscountTabDisplayedVerifyCartSummaryCartTotalAndCheckoutButtonDisplayed
		$I->comment("Exiting Action Group [verifyCartSummaryCartTotalAndCheckoutButtonDisplayed] VerifyCartSummaryBlockCartTotalBlockAndCheckoutButtonActionGroup");
		$I->comment("Entering Action Group [verifyCartItemInformation] VerifyCartItemsActionGroup");
		$I->waitForElementVisible("//tbody[@class='cart item']//strong[@class='product-item-name']", 60); // stepKey: waitForProductNameVisibleVerifyCartItemInformation
		$I->see("test 2", "//tbody[@class='cart item']//strong[@class='product-item-name']"); // stepKey: seeProductNameInCheckoutSummaryVerifyCartItemInformation
		$I->see($getProductPriceInPdp, "(//tbody[@class='cart item']//a[text()='test 2']/..)/..//span[@class='price']"); // stepKey: seeProductPriceInCartVerifyCartItemInformation
		$I->see("Navy", "//main//table[@id='shopping-cart-table']//tbody//tr[.//strong[contains(@class, 'product-item-name')]//a[contains(text(), 'test 2')]]//dl[@class='item-options']//dt[.='Color']/following-sibling::dd[1]"); // stepKey: seeProductOptionInCartVerifyCartItemInformation
		$I->comment("Exiting Action Group [verifyCartItemInformation] VerifyCartItemsActionGroup");
		$I->comment("Enter coupon code");
		$grabTotalBeforeAppliedDiscount = $I->grabTextFrom(".grand.totals .amount .price"); // stepKey: grabTotalBeforeAppliedDiscount
		$I->conditionalClick("#block-discount", "#coupon_code", false); // stepKey: expandDiscountTab
		$I->comment("Entering Action Group [enterCouponCode] StorefrontApplyCouponActionGroup");
		$I->waitForElement("#block-discount-heading", 30); // stepKey: waitForCouponHeaderEnterCouponCode
		$I->conditionalClick("#block-discount-heading", ".block.discount.active", false); // stepKey: clickCouponHeaderEnterCouponCode
		$I->waitForElementVisible("#coupon_code", 30); // stepKey: waitForCouponFieldEnterCouponCode
		$I->fillField("#coupon_code", "99999testing99999"); // stepKey: fillCouponFieldEnterCouponCode
		$I->click("#discount-coupon-form button[class*='apply']"); // stepKey: clickApplyButtonEnterCouponCode
		$I->waitForPageLoad(30); // stepKey: clickApplyButtonEnterCouponCodeWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadEnterCouponCode
		$I->comment("Exiting Action Group [enterCouponCode] StorefrontApplyCouponActionGroup");
		$I->seeElement("td[data-th='Discount']"); // stepKey: verifyDiscountAmountDisplayed
		$I->comment("Check redirect to checkout page");
		$I->click("main .action.primary.checkout span"); // stepKey: clickCheckoutButtonInCheckoutPage
		$I->waitForPageLoad(30); // stepKey: clickCheckoutButtonInCheckoutPageWaitForPageLoad
		$I->comment("Check display checkout page - Shipping step, Filling Email, address form & proceed to Payment tep");
		$I->comment("Entering Action Group [checkDisplayedCheckoutPageShippingStep] VerifyDisplayedCheckoutShippingStepActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForCheckoutPageLoadCheckDisplayedCheckoutPageShippingStep
		$I->seeElement("#checkout"); // stepKey: verifyCheckoutContainerInPageCheckDisplayedCheckoutPageShippingStep
		$I->seeElement("div.block.items-in-cart"); // stepKey: checkDisplayedItemListBlockCheckDisplayedCheckoutPageShippingStep
		$I->seeElement("#co-shipping-method-form"); // stepKey: checkDisplayedShippingMethodBlockCheckDisplayedCheckoutPageShippingStep
		$I->seeElement("#co-shipping-form"); // stepKey: checkDisplayedAddressFormCheckDisplayedCheckoutPageShippingStep
		$I->comment("Exiting Action Group [checkDisplayedCheckoutPageShippingStep] VerifyDisplayedCheckoutShippingStepActionGroup");
		$I->selectOption("//select[contains(@name,'cafedu_phone_preffix')]", "France: +33"); // stepKey: selectPhoneCode
		$I->comment("Entering Action Group [fillingEmailAndAddress] GuestCheckoutFillingShippingSectionRewriteActionGroup");
		$I->fillField("input[id*=customer-email]", "testmagentobss@gmail.com"); // stepKey: enterEmailFillingEmailAndAddress
		$I->fillField("input[name=firstname]", "test"); // stepKey: enterFirstNameFillingEmailAndAddress
		$I->fillField("input[name=lastname]", "test"); // stepKey: enterLastNameFillingEmailAndAddress
		$I->fillField("input[name='street[0]']", "T"); // stepKey: enterStreetFillingEmailAndAddress
		$I->fillField("input[name=city]", "Test city"); // stepKey: enterCityFillingEmailAndAddress
		$I->selectOption("select[name=region_id]", "Alberta"); // stepKey: selectRegionFillingEmailAndAddress
		$I->fillField("input[name=postcode]", "test"); // stepKey: enterPostcodeFillingEmailAndAddress
		$I->fillField("input[name=telephone]", "234234"); // stepKey: enterTelephoneFillingEmailAndAddress
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskFillingEmailAndAddress
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfPagesFillingEmailAndAddress
		$I->waitForElement("//div[@id='checkout-shipping-method-load']//td[contains(., 'Free')]/..//input/following-sibling::label", 30); // stepKey: waitForShippingMethodFillingEmailAndAddress
		$I->click("//div[@id='checkout-shipping-method-load']//td[contains(., 'Free')]/..//input/following-sibling::label"); // stepKey: selectShippingMethodFillingEmailAndAddress
		$I->waitForElement("button.button.action.continue.primary", 30); // stepKey: waitForNextButtonFillingEmailAndAddress
		$I->waitForPageLoad(30); // stepKey: waitForNextButtonFillingEmailAndAddressWaitForPageLoad
		$I->click("button.button.action.continue.primary"); // stepKey: clickNextFillingEmailAndAddress
		$I->waitForPageLoad(30); // stepKey: clickNextFillingEmailAndAddressWaitForPageLoad
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoadedFillingEmailAndAddress
		$I->seeInCurrentUrl("/checkout/#payment"); // stepKey: assertCheckoutPaymentUrlFillingEmailAndAddress
		$I->comment("Exiting Action Group [fillingEmailAndAddress] GuestCheckoutFillingShippingSectionRewriteActionGroup");
		$I->comment("Check payment step display");
		$I->comment("Entering Action Group [checkDisplayedCheckoutPagePaymentStep] VerifyDisplayedCheckoutPaymentStepActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForCheckoutPageLoadCheckDisplayedCheckoutPagePaymentStep
		$I->seeElement("//*[@id='checkout-payment-method-load']//*[contains(@class, 'payment-group')]//label[normalize-space(.)='Pay by Card (Stripe)']"); // stepKey: verifyDisplayedCreditCardPaymentMethodCheckDisplayedCheckoutPagePaymentStep
		$I->seeElement("//*[@id='checkout-payment-method-load']//*[contains(@class, 'payment-group')]//label[normalize-space(.)='PayPal What is PayPal?']"); // stepKey: verifyDisplayedPaypalPaymentMethodCheckDisplayedCheckoutPagePaymentStep
		$I->seeElement("div.block.items-in-cart"); // stepKey: checkDisplayedItemListBlockCheckDisplayedCheckoutPagePaymentStep
		$I->seeElement("//tr[@class='totals sub']//span[@class='price']"); // stepKey: checkDisplayedOrderSummarySubtotalCheckDisplayedCheckoutPagePaymentStep
		$I->seeElement("//tr[@class='totals shipping incl']//span[@class='price']"); // stepKey: checkDisplayedOrderShippingTotalIncludingCheckDisplayedCheckoutPagePaymentStep
		$I->seeElement("//tr[@class='grand totals']//span[@class='price']"); // stepKey: checkDisplayedOrderSummaryTotalCheckDisplayedCheckoutPagePaymentStep
		$I->click("#opc-block-shipping-information .cafedu-opc-sidebar-title"); // stepKey: openShippingInformationTabCheckDisplayedCheckoutPagePaymentStep
		$I->waitForElement("//div[@class='ship-via']//div[@class='shipping-information-content']", 30); // stepKey: waitForShippingInformationDisplayedCheckDisplayedCheckoutPagePaymentStep
		$I->seeElement("//div[@class='ship-via']//div[@class='shipping-information-content']"); // stepKey: checkDisplayedShippingMethodInformationCheckDisplayedCheckoutPagePaymentStep
		$I->seeElement(".ship-to .shipping-information-content"); // stepKey: checkDisplayedShippingAddressCheckDisplayedCheckoutPagePaymentStep
		$I->comment("Exiting Action Group [checkDisplayedCheckoutPagePaymentStep] VerifyDisplayedCheckoutPaymentStepActionGroup");
		$I->comment("Fill Credit card form");
		$I->click("//*[@id='checkout-payment-method-load']//*[contains(@class, 'payment-group')]//label[normalize-space(.)='Pay by Card (Stripe)']"); // stepKey: selectStripe
		$I->comment("Entering Action Group [fillCreditCardForm] StripeFillCreditCartFormActionGroup");
		$I->wait(4); // stepKey: waitFourSecondsFillCreditCardForm
		$I->switchToIFrame("stripe-payments-card-number iframe"); // stepKey: switchToCardNumberIframeFillCreditCardForm
		$I->fillField(".InputElement[name='cardnumber']", "4242424242424242"); // stepKey: fillCardNumberFillCreditCardForm
		$I->switchToIFrame(); // stepKey: switchToDefaultContentFillCreditCardForm
		$I->switchToIFrame("stripe-payments-card-expiry iframe"); // stepKey: switchToCardExpireIframeFillCreditCardForm
		$I->fillField(".InputElement[name='exp-date']", "1222"); // stepKey: fillCardExpireFillCreditCardForm
		$I->switchToIFrame(); // stepKey: switchToDefaultContent1FillCreditCardForm
		$I->switchToIFrame("stripe-payments-card-cvc iframe"); // stepKey: switchToCardCVCIframeFillCreditCardForm
		$I->fillField(".InputElement[name='cvc']", "123"); // stepKey: fillCardCVCFillCreditCardForm
		$I->switchToIFrame(); // stepKey: switchToDefaultContent2FillCreditCardForm
		$I->wait(2); // stepKey: waitTwoSecondsFillCreditCardForm
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrderFillCreditCardForm
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrderFillCreditCardFormWaitForPageLoad
		$I->comment("Exiting Action Group [fillCreditCardForm] StripeFillCreditCartFormActionGroup");
		$I->comment("Entering Action Group [checkDisplayedSuccessPage] VerifyDisplayedSuccessPageActionGroup");
		$I->waitForElement("div.checkout-success", 30); // stepKey: waitForMainContentSuccessPageDisplayedCheckDisplayedSuccessPage
		$I->seeInCurrentUrl("/checkout/onepage/success/"); // stepKey: assertSuccessPageUrlCheckDisplayedSuccessPage
		$I->seeElement(".order-number>strong"); // stepKey: seeOrderNumberInPageContentCheckDisplayedSuccessPage
		$I->see("testmagentobss@gmail.com", ".success-order .email"); // stepKey: seeCustomerEmailInMainContentCheckDisplayedSuccessPage
		$I->comment("Exiting Action Group [checkDisplayedSuccessPage] VerifyDisplayedSuccessPageActionGroup");
	}
}