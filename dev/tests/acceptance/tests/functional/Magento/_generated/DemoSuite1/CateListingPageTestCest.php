<?php
namespace Magento\AcceptanceTest\_DemoSuite1\Backend;

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
 * @Description("Check display category listing page<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\CateListingPageTest.xml<br>")
 * @TestCaseId("QUICK-CATE02")
 * @group QuickGoThrough
 */
class CateListingPageTestCest
{
	/**
	 * @Features({"Theme"})
	 * @Stories({"Check display category listing page"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CateListingPageTest(AcceptanceTester $I)
	{
		$I->comment("Access category listing page");
		$I->comment("Entering Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("<maximizeWindow stepKey=\"maximizeWindow\"/>");
		$I->amOnPage("/"); // stepKey: accessHomeAccessPageAndVerifyJSError
		$I->amOnPage("/en_row/mens-cycling-jerseys.html"); // stepKey: redirectToTargetPageAccessPageAndVerifyJSError
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
		$I->seeElement("a.trigger-auth-wishlist-popup"); // stepKey: verifyWishlistIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->seeElement("a.trigger-auth-popup"); // stepKey: verifyAccountIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->seeElement("a#cafedu-minicart-overlay"); // stepKey: verifyMiniCartIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->comment("Exiting Action Group [verifyWishlistAccountMiniCartIconsDisplayed] VerifyDisplayedWishlistAccountMiniCartIconsActionGroup");
		$I->comment("Verify if Category title, description & breadcrumb are displayed");
		$I->seeElement(".listing-title-container"); // stepKey: verifyCateTitleAndDescriptionDisplayed
		$I->comment("Entering Action Group [verifyBreadcrumbDisplayed] VerifyDisplayedBreadcrumbActionGroup");
		$I->seeElement(".breadcrumbs ul"); // stepKey: verifyBreadcrumbDisplayedVerifyBreadcrumbDisplayed
		$I->comment("Exiting Action Group [verifyBreadcrumbDisplayed] VerifyDisplayedBreadcrumbActionGroup");
		$I->comment("Verify if filter section displayed");
		$I->comment("Entering Action Group [verifyFilterSectionDisplayed] VerifyDisplayedFilterSectionActionGroup");
		$I->seeElement("#navigation"); // stepKey: verifyFilterButtonDisplayedVerifyFilterSectionDisplayed
		$I->click("#navigation"); // stepKey: clickOnFilterButtonToOpenFilterSectionVerifyFilterSectionDisplayed
		$I->waitForElement("#navigation-content", 30); // stepKey: waitForFilterContentVerifyFilterSectionDisplayed
		$I->seeElement("#navigation-content"); // stepKey: verifyFilterContentDisplayedVerifyFilterSectionDisplayed
		$I->makeScreenshot("CateListingPageFilterScreenshot"); // stepKey: screenshotCateListingPageFilterVerifyFilterSectionDisplayed
		$I->click("#navigation"); // stepKey: clickOnFilterButtonToCloseFilterSectionVerifyFilterSectionDisplayed
		$I->comment("Exiting Action Group [verifyFilterSectionDisplayed] VerifyDisplayedFilterSectionActionGroup");
		$I->comment("Verify if first product displayed with image, name, description, color and price");
		$I->comment("Entering Action Group [verifyFirstProductDisplayedImageNameDesColorAndPrice] VerifyDisplayedFirstProductDetailInProductListingActionGroup");
		$I->seeElement("(//div[@class='product-photo-wrapper desktop'])[1]"); // stepKey: verifyProductImageDisplayedVerifyFirstProductDisplayedImageNameDesColorAndPrice
		$I->seeElement("(//a[@class='product-item-link'])[1]"); // stepKey: verifyProductNameDisplayedVerifyFirstProductDisplayedImageNameDesColorAndPrice
		$I->seeElement("(//div[@class='description'])[1]"); // stepKey: verifyProductDescriptionDisplayedVerifyFirstProductDisplayedImageNameDesColorAndPrice
		$I->seeElement("(//div[@class='product-color'])[1]"); // stepKey: verifyProductColorDisplayedVerifyFirstProductDisplayedImageNameDesColorAndPrice
		$I->comment("Price will not displayed inn case product out of stock");
		$I->comment("<seeElement selector=\"\{\{CateListingPageProductListSection.FirstProductPrice\}\}\" stepKey=\"verifyProductPriceDisplayed\"/>");
		$I->comment("Exiting Action Group [verifyFirstProductDisplayedImageNameDesColorAndPrice] VerifyDisplayedFirstProductDetailInProductListingActionGroup");
		$I->makeScreenshot("CateListingPageScreenshot"); // stepKey: screenshotCateListingPage
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