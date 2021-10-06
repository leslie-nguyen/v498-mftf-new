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
 * @Description("Check display Product  page<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\ProductPageTest.xml<br>")
 * @TestCaseId("QUICK-PDP01")
 * @group QuickGoThrough
 */
class ProductPageTestCest
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
	 * @Stories({"Check display Product  page"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function ProductPageTest(AcceptanceTester $I)
	{
		$I->comment("Access Product  page");
		$I->comment("Entering Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("<maximizeWindow stepKey=\"maximizeWindow\"/>");
		$I->amOnPage("/"); // stepKey: accessHomeAccessPageAndVerifyJSError
		$I->amOnPage("/en_row//men-cycling-jersey-floriane-petunia.html"); // stepKey: redirectToTargetPageAccessPageAndVerifyJSError
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
		$I->makeScreenshot("ProductPageScreenshot"); // stepKey: screenshotProductPage
		$I->comment("Verify Product page displayed: breadcrumb, product image slider full width, product tabs");
		$I->comment("Entering Action Group [verifyBreadcrumbDisplayed] VerifyDisplayedBreadcrumbActionGroup");
		$I->seeElement(".breadcrumbs ul"); // stepKey: verifyBreadcrumbDisplayedVerifyBreadcrumbDisplayed
		$I->comment("Exiting Action Group [verifyBreadcrumbDisplayed] VerifyDisplayedBreadcrumbActionGroup");
		$I->comment("Entering Action Group [verifyCommonProductElementsDisplayed] VerifyDisplayedCommonProductElementsInPdpActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadVerifyCommonProductElementsDisplayed
		$I->seeElement(".gallery-placeholder"); // stepKey: verifyFirstProductImageGalleryDisplayedVerifyCommonProductElementsDisplayed
		$I->seeElement("strong[itemprop='name']"); // stepKey: verifyFirstProductNameDisplayedVerifyCommonProductElementsDisplayed
		$I->seeElement(".product-title h1"); // stepKey: verifyFirstProductTitleDisplayedVerifyCommonProductElementsDisplayed
		$I->seeElement("i.fa-heart"); // stepKey: verifyFirstWishlistIconDisplayedVerifyCommonProductElementsDisplayed
		$I->comment("Exiting Action Group [verifyCommonProductElementsDisplayed] VerifyDisplayedCommonProductElementsInPdpActionGroup");
		$I->comment("Entering Action Group [verifyProductImageSliderFullWidthDisplayed] VerifyDisplayedProductImageSliderFullWidthActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadVerifyProductImageSliderFullWidthDisplayed
		$I->seeElement(".product-image-slider"); // stepKey: verifyImageSliderDisplayedVerifyProductImageSliderFullWidthDisplayed
		$I->seeElement(".long-description-block"); // stepKey: verifyProductLongDescriptionDisplayedVerifyProductImageSliderFullWidthDisplayed
		$I->comment("Exiting Action Group [verifyProductImageSliderFullWidthDisplayed] VerifyDisplayedProductImageSliderFullWidthActionGroup");
		$I->comment("Entering Action Group [verifyProductTabsDisplayed] VerifyDisplayedProductTabsActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadVerifyProductTabsDisplayed
		$I->scrollTo(".long-description-block"); // stepKey: scrollToProductTabsVerifyProductTabsDisplayed
		$I->wait(1); // stepKey: waitASecondsVerifyProductTabsDisplayed
		$I->comment("Check Product Details tab");
		$I->seeElement("div[data-info='details']"); // stepKey: verifyProductDetailsTabDisplayedVerifyProductTabsDisplayed
		$I->click("div[data-info='details']"); // stepKey: clickToOpenProductDetailsTabVerifyProductTabsDisplayed
		$I->seeElement(".information-content.details"); // stepKey: verifyProductDetailsContentDisplayedVerifyProductTabsDisplayed
		$I->comment("Check Product Delivery Info Tab");
		$I->seeElement("div[data-info='delivery']"); // stepKey: verifyProductDeliveryInfoTabDisplayedVerifyProductTabsDisplayed
		$I->click("div[data-info='delivery']"); // stepKey: clickToOpenProductDeliveryInfoTabVerifyProductTabsDisplayed
		$I->seeElement(".information-content.delivery"); // stepKey: verifyProductDeliveryInfoContentDisplayedVerifyProductTabsDisplayed
		$I->comment("Check Size help tab");
		$I->seeElement("div[data-info='size-guide']"); // stepKey: verifySizeHelpTabDisplayedVerifyProductTabsDisplayed
		$I->click("div[data-info='size-guide']"); // stepKey: clickToOpenSizeHelpTabVerifyProductTabsDisplayed
		$I->seeElement(".information-content.size-guide"); // stepKey: verifySizeHelpContentDisplayedVerifyProductTabsDisplayed
		$I->comment("Check Care Instructions tab");
		$I->seeElement("div[data-info='care-instructions']"); // stepKey: verifyCareInstructionsTabDisplayedVerifyProductTabsDisplayed
		$I->click("div[data-info='care-instructions']"); // stepKey: clickToOpenCareInstructionsTabVerifyProductTabsDisplayed
		$I->seeElement(".information-content.care-instructions"); // stepKey: verifyCareInstructionsContentDisplayedVerifyProductTabsDisplayed
		$I->comment("Exiting Action Group [verifyProductTabsDisplayed] VerifyDisplayedProductTabsActionGroup");
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
