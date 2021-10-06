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
 * @Description("Check display Look detail page<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\LookDetailTest.xml<br>")
 * @TestCaseId("QUICK-LOOKDETAIL01")
 * @group QuickGoThrough
 */
class LookDetailTestCest
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
	 * @Stories({"Check display Look detail page"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function LookDetailTest(AcceptanceTester $I)
	{
		$I->comment("Access Look detail page");
		$I->comment("Entering Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("<maximizeWindow stepKey=\"maximizeWindow\"/>");
		$I->amOnPage("/"); // stepKey: accessHomeAccessPageAndVerifyJSError
		$I->amOnPage("/en_row/mens-ss21-collection-shop-the-look-floriane-petunia-marinette-navy.html"); // stepKey: redirectToTargetPageAccessPageAndVerifyJSError
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
		$I->makeScreenshot("LookDetailPageScreenshot"); // stepKey: screenshotLookDetailPage
		$I->comment("Verify if Look slider block  displayed");
		$I->comment("Entering Action Group [verifyLookSliderBlockDisplayed] VerifyDisplayedLookSliderActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadVerifyLookSliderBlockDisplayed
		$I->seeElement(".header-slider"); // stepKey: verifySliderBlockDisplayedVerifyLookSliderBlockDisplayed
		$I->seeElement(".slick-list"); // stepKey: verifyLookSliderDisplayedVerifyLookSliderBlockDisplayed
		$I->seeElement(".stl-header-info-inner h2"); // stepKey: verifyLookTitleDisplayedVerifyLookSliderBlockDisplayed
		$I->seeElement(".stl-header-text"); // stepKey: verifyLookDescriptionDisplayedVerifyLookSliderBlockDisplayed
		$I->seeElement("a.stl-header-link"); // stepKey: verifyViewAllButtonDisplayedVerifyLookSliderBlockDisplayed
		$I->comment("Exiting Action Group [verifyLookSliderBlockDisplayed] VerifyDisplayedLookSliderActionGroup");
		$I->comment("Verify if product listing block displayed");
		$I->comment("Entering Action Group [verifyLookListingBlockDisplayed] VerifyDisplayedFirstProductDetailInLookListingActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadVerifyLookListingBlockDisplayed
		$I->scrollTo("a.stl-header-link"); // stepKey: scrollToProductListingVerifyLookListingBlockDisplayed
		$I->comment("Verify Listing block displayed");
		$I->seeElement("#look-item-collection"); // stepKey: verifyProductListingBlockDisplayedVerifyLookListingBlockDisplayed
		$I->comment("Verify FIRST PRODUCT item displayed: product number, image, name, color, description, wishlist icon, See detail button
NOTE: SELECTOR of first product's elements had been fixed with hardcoded ex:[1] so it can not be reuse in other case");
		$I->seeElement("(//ol/li)[1]//div[@class='product-number']"); // stepKey: verifyFirstProductNumberDisplayedVerifyLookListingBlockDisplayed
		$I->seeElement("(//ol/li)[1]//div[@class='gallery-placeholder']"); // stepKey: verifyFirstProductImageDisplayedVerifyLookListingBlockDisplayed
		$I->seeElement("(//ol/li)[1]//a[@class='product-item-link']"); // stepKey: verifyFirstProductNameDisplayedVerifyLookListingBlockDisplayed
		$I->seeElement("(//ol/li)[1]//i[contains(@class,'fa-heart')]"); // stepKey: verifyFirstWishlistIconDisplayedVerifyLookListingBlockDisplayed
		$I->seeElement("(//ol/li)[1]//div[contains(@class,'product-item-description')]"); // stepKey: verifyFirstProductDescriptionDisplayedVerifyLookListingBlockDisplayed
		$I->seeElement("(//ol/li)[1]//div[contains(@class,'product-item-description')]//a[contains(@class,'action')]"); // stepKey: verifyFirstSeeDetailButtonDisplayedVerifyLookListingBlockDisplayed
		$I->comment("Exiting Action Group [verifyLookListingBlockDisplayed] VerifyDisplayedFirstProductDetailInLookListingActionGroup");
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
		$I->comment("Verify sticky header displayed");
		$I->comment("Entering Action Group [verifyStickyHeaderDisplayed] VerifyDisplayedStickyHeaderActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadVerifyStickyHeaderDisplayed
		$I->comment("There are already action group to verify visibility of Store switcher, account, wishlist, mini cart icons
so there will be no needed to verify in this action group anymore");
		$I->comment("Scroll down to display sticky header");
		$I->scrollTo("footer.inner-footer"); // stepKey: scrollDownToFooterVerifyStickyHeaderDisplayed
		$I->seeElement(".page-header.cafedu-page-header-scroll.has-scroll"); // stepKey: verifyStickyHeaderDisplayedVerifyStickyHeaderDisplayed
		$I->comment("Verify if main menu displayed");
		$I->seeElement(".navigation a[href*='/mens-cycling-apparel.html']"); // stepKey: verifyMenCategoryDisplayedVerifyStickyHeaderDisplayed
		$I->seeElement(".navigation a[href*='/womens-cycling-apparel.html']"); // stepKey: verifyWomenCategoryDisplayedVerifyStickyHeaderDisplayed
		$I->seeElement(".navigation a[href*='/la-gazette']"); // stepKey: verifyLaGazetteCategoryDisplayedVerifyStickyHeaderDisplayed
		$I->seeElement(".navigation a[href*='/nissa.html']"); // stepKey: verifyNissaCategoryDisplayedVerifyStickyHeaderDisplayed
		$I->comment("Verify if Search icon displayed");
		$I->seeElement("a#inner-header-search-popup"); // stepKey: verifySearchIconDisplayedVerifyStickyHeaderDisplayed
		$I->comment("Exiting Action Group [verifyStickyHeaderDisplayed] VerifyDisplayedStickyHeaderActionGroup");
	}
}
