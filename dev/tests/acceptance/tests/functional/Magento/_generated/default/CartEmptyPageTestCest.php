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
 * @Description("Check display Cart empty page<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\CartEmptyPageTest.xml<br>")
 * @TestCaseId("QUICK-CARTEMPTY01")
 * @group QuickGoThrough
 * @group 1
 */
class CartEmptyPageTestCest
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
	 * @Features({"Theme"})
	 * @Stories({"Check display Cart empty page"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CartEmptyPageTest(AcceptanceTester $I)
	{
		$I->comment("Access Cart empty page");
		$I->comment("Entering Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("<maximizeWindow stepKey=\"maximizeWindow\"/>");
		$I->amOnPage("/"); // stepKey: accessHomeAccessPageAndVerifyJSError
		$I->amOnPage("/en_row/checkout/cart/"); // stepKey: redirectToTargetPageAccessPageAndVerifyJSError
		$I->dontSeeJsError(); // stepKey: dontSeeJsErrorAccessPageAndVerifyJSError
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAccessPageAndVerifyJSError
		$I->comment("Exiting Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("Verify header displayed");
		$I->comment("Entering Action Group [verifyLogoMainMenuAndSearchIcon] VerifyDisplayedMainHeaderActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadVerifyLogoMainMenuAndSearchIcon
		$I->comment("There are already action group to verify visibility of Store switcher, account, wishlist, mini cart icons
 so there will be no needed to verify in this action group anymore");
		$I->seeElement("a.logo"); // stepKey: verifyLogoDisplayedVerifyLogoMainMenuAndSearchIcon
		$I->seeElement(".navigation a[href*='/mens-cycling-apparel.html']"); // stepKey: verifyMenCategoryDisplayedVerifyLogoMainMenuAndSearchIcon
		$I->seeElement(".navigation a[href*='/womens-cycling-apparel.html']"); // stepKey: verifyWomenCategoryDisplayedVerifyLogoMainMenuAndSearchIcon
		$I->seeElement(".navigation a[href*='/la-gazette']"); // stepKey: verifyLaGazetteCategoryDisplayedVerifyLogoMainMenuAndSearchIcon
		$I->seeElement(".navigation a[href*='/nissa.html']"); // stepKey: verifyNissaCategoryDisplayedVerifyLogoMainMenuAndSearchIcon
		$I->seeElement("a#inner-header-search-popup"); // stepKey: verifySearchIconDisplayedVerifyLogoMainMenuAndSearchIcon
		$I->comment("Exiting Action Group [verifyLogoMainMenuAndSearchIcon] VerifyDisplayedMainHeaderActionGroup");
		$I->comment("Entering Action Group [verifyCountryDropdownDisplayed] VerifyDisplayedStoreSwitchersActionGroup");
		$I->seeElement("#switcher-store"); // stepKey: verifyCountryDropdownDisplayedVerifyCountryDropdownDisplayed
		$I->seeElement("#switcher-language"); // stepKey: verifyLanguageDropdownDisplayedVerifyCountryDropdownDisplayed
		$I->comment("Exiting Action Group [verifyCountryDropdownDisplayed] VerifyDisplayedStoreSwitchersActionGroup");
		$I->comment("Entering Action Group [verifyWishlistAccountMiniCartIconsDisplayed] VerifyDisplayedWishlistAccountMiniCartIconsActionGroup");
		$I->seeElement(".wishlist-link"); // stepKey: verifyWishlistIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->seeElement(".authorization-link"); // stepKey: verifyAccountIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->seeElement("a#cafedu-minicart-overlay"); // stepKey: verifyMiniCartIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->comment("Exiting Action Group [verifyWishlistAccountMiniCartIconsDisplayed] VerifyDisplayedWishlistAccountMiniCartIconsActionGroup");
		$I->comment("Verify cart empty block displayed");
		$I->comment("Entering Action Group [verifyCartIsEmpty] AssertShoppingCartIsEmptyActionGroup");
		$I->amOnPage("/checkout/cart"); // stepKey: amOnPageShoppingCartVerifyCartIsEmpty
		$I->waitForPageLoad(30); // stepKey: waitForCheckoutPageLoadVerifyCartIsEmpty
		$I->seeElement(".cart-empty"); // stepKey: seeCartEmptyBlockVerifyCartIsEmpty
		$grabLinkInClickHereMessageVerifyCartIsEmpty = $I->grabAttributeFrom(".cart-empty a", "href"); // stepKey: grabLinkInClickHereMessageVerifyCartIsEmpty
		$I->seeInCurrentUrl($grabLinkInClickHereMessageVerifyCartIsEmpty); // stepKey: seeClickHereLinkInCurrentUrlVerifyCartIsEmpty
		$I->comment("Exiting Action Group [verifyCartIsEmpty] AssertShoppingCartIsEmptyActionGroup");
		$I->comment("Verify footer displayed");
		$I->comment("Entering Action Group [verifyMainFooterDisplayed] VerifyDisplayedMainFooterActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadVerifyMainFooterDisplayed
		$I->scrollTo("footer.inner-footer"); // stepKey: scrollToFooterVerifyMainFooterDisplayed
		$I->seeElement(".footer-top-row div.newsletter"); // stepKey: verifyNewsletterBlockDisplayedVerifyMainFooterDisplayed
		$I->seeElement(".social-icons"); // stepKey: verifySocialIconsDisplayedVerifyMainFooterDisplayed
		$I->seeElement("(//div[@class='footer-cloumn'])[1]"); // stepKey: verifyServiceBlockDisplayedVerifyMainFooterDisplayed
		$I->seeElement("(//div[@class='footer-cloumn'])[2]"); // stepKey: verifyContactBlockDisplayedVerifyMainFooterDisplayed
		$I->seeElement("(//div[@class='footer-cloumn'])[3]"); // stepKey: verifyShopsBlockDisplayedVerifyMainFooterDisplayed
		$I->seeElement(".copyright"); // stepKey: verifyCopyrightTextDisplayedVerifyMainFooterDisplayed
		$I->comment("Exiting Action Group [verifyMainFooterDisplayed] VerifyDisplayedMainFooterActionGroup");
	}
}
