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
 * @Description("Checkout as guest with Paypal<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\CheckoutAsGuestPaypalTest.xml<br>")
 * @TestCaseId("FLOW01")
 * @group CheckoutFlow
 */
class CheckoutAsGuestPaypalTestCest
{
	/**
	 * @Features({"Theme"})
	 * @Stories({"Checkout as guest with Paypal"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CheckoutAsGuestPaypalTest(AcceptanceTester $I)
	{
		$I->comment("Access Cate Listing page page");
		$I->comment("Entering Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("<maximizeWindow stepKey=\"maximizeWindow\"/>");
		$I->amOnPage("/"); // stepKey: accessHomeAccessPageAndVerifyJSError
		$I->amOnPage("/en_row/mens-cycling-jerseys.html"); // stepKey: redirectToTargetPageAccessPageAndVerifyJSError
		$I->dontSeeJsError(); // stepKey: dontSeeJsErrorAccessPageAndVerifyJSError
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAccessPageAndVerifyJSError
		$I->comment("Exiting Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
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
		$I->amOnPage("/en_row/men-cycling-jersey-floriane-groseille.html"); // stepKey: accessConfigurablePdp
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->comment("Entering Action Group [addConfigurablePrdToCart] AddConfigurableProductToCartActionGroup");
		$I->click("//div[contains(@class,'swatch-attribute')][contains(@class,'size')]"); // stepKey: clickToOpenSizeDropdownAddConfigurablePrdToCart
		$I->click("//div[contains(@class,'swatch-attribute')][contains(@class,'size')]//*[contains(@class,'swatch-option')][contains(text(),'M')]"); // stepKey: selectAttributeOptionAddConfigurablePrdToCart
		$I->click("#product-addtocart-button"); // stepKey: clickOnAddToCartButtonAddConfigurablePrdToCart
		$I->waitForPageLoad(60); // stepKey: clickOnAddToCartButtonAddConfigurablePrdToCartWaitForPageLoad
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxLoadAddConfigurablePrdToCart
		$I->seeElement(".block-minicart"); // stepKey: seeMiniCartBlockAddConfigurablePrdToCart
		$I->waitForPageLoad(30); // stepKey: seeMiniCartBlockAddConfigurablePrdToCartWaitForPageLoad
		$I->comment("Exiting Action Group [addConfigurablePrdToCart] AddConfigurableProductToCartActionGroup");
		$getProductPriceInPdp = $I->grabTextFrom(".price-box"); // stepKey: getProductPriceInPdp
		$I->comment("Entering Action Group [assertItemInMiniCart] VerifyMiniCartItemsActionGroup");
		$I->see("Floriane", ".minicart-items"); // stepKey: seeProductNameInMiniCartAssertItemInMiniCart
		$I->see($getProductPriceInPdp, ".minicart-items"); // stepKey: seeProductPriceInMiniCartAssertItemInMiniCart
		$I->see("Size", "//a[text()='Floriane']/../following-sibling::div[contains(@class,'options')]//dt[@class='label']"); // stepKey: seeAttributeNameAssertItemInMiniCart
		$I->see("M", "//a[text()='Floriane']/../following-sibling::div[contains(@class,'options')]//dd/span"); // stepKey: seeAttributeOptionAssertItemInMiniCart
		$I->seeElement("#top-cart-btn-checkout"); // stepKey: seeCheckOutButtonInMiniCartAssertItemInMiniCart
		$I->waitForPageLoad(30); // stepKey: seeCheckOutButtonInMiniCartAssertItemInMiniCartWaitForPageLoad
		$I->seeElement("//ol[@id='mini-cart']//img[@class='product-image-photo']"); // stepKey: seeProductImageAssertItemInMiniCart
		$I->comment("Exiting Action Group [assertItemInMiniCart] VerifyMiniCartItemsActionGroup");
		$I->comment("Check redirect to Cart page");
		$I->conditionalClick("a#cafedu-minicart-overlay", ".block-minicart", false); // stepKey: openMiniCart
		$I->waitForPageLoad(30); // stepKey: openMiniCartWaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: clickCheckoutButton
		$I->waitForPageLoad(30); // stepKey: clickCheckoutButtonWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waiForPageLoad
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
		$I->see("Floriane", "//tbody[@class='cart item']//strong[@class='product-item-name']"); // stepKey: seeProductNameInCheckoutSummaryVerifyCartItemInformation
		$I->see($getProductPriceInPdp, "(//tbody[@class='cart item']//a[text()='Floriane']/..)/..//span[@class='price']"); // stepKey: seeProductPriceInCartVerifyCartItemInformation
		$I->see("M", "//main//table[@id='shopping-cart-table']//tbody//tr[.//strong[contains(@class, 'product-item-name')]//a[contains(text(), 'Floriane')]]//dl[@class='item-options']//dt[.='Size']/following-sibling::dd[1]"); // stepKey: seeProductOptionInCartVerifyCartItemInformation
		$I->comment("Exiting Action Group [verifyCartItemInformation] VerifyCartItemsActionGroup");
	}
}
