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
 * @Description("Checkout as guest with Paypal<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\CheckoutFlow\CheckoutAsGuestPaypalTest.xml<br>")
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
		$I->comment("Access Cart empty page");
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
		$I->comment("<grabTextFrom selector=\"strong[itemprop='name']\" stepKey=\"grabProductNameInPDP\"/>");
		$I->comment("Assert product ID, name in product listing & PDP are matched");
		$I->assertEquals("$grabFirstProductIdInListingPageVerifyFirstProductLinkInCateListingPage", "$grabProductIdInPDPVerifyFirstProductLinkInCateListingPage", "Product ID does not matched"); // stepKey: assertProductIDBetweenListingPageAndPDPVerifyFirstProductLinkInCateListingPage
		$I->comment("<assertEquals message=\"Product name does not matched\" stepKey=\"assertProductNameBetweenListingPageAndPDP\">");
		$I->comment("<expectedResult type=\"string\">\$grabFirstProductNameInListingPageVerifyFirstProductLinkInCateListingPage</expectedResult>");
		$I->comment("<actualResult type=\"string\">\$grabProductNameInPDP</actualResult>");
		$I->comment("</assertEquals>");
		$I->see($grabFirstProductNameInListingPageVerifyFirstProductLinkInCateListingPage, "strong[itemprop]"); // stepKey: seeTitleVerifyFirstProductLinkInCateListingPage
		$I->comment("Exiting Action Group [verifyFirstProductLinkInCateListingPage] VerifyFirstProductLinkInProductListingPageActionGroup");
	}
}
