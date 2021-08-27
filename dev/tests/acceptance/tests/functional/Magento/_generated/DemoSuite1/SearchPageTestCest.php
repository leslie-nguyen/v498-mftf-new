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
 * @Description("Check display ProSearchduct  page<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\SearchPageTest.xml<br>")
 * @TestCaseId("QUICK-SEARCH01")
 * @group QuickGoThrough
 */
class SearchPageTestCest
{
	/**
	 * @Features({"Theme"})
	 * @Stories({"Check display Search page"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function SearchPageTest(AcceptanceTester $I)
	{
		$I->comment("Access Search page");
		$I->comment("Entering Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("<maximizeWindow stepKey=\"maximizeWindow\"/>");
		$I->amOnPage("/"); // stepKey: accessHomeAccessPageAndVerifyJSError
		$I->amOnPage("/en_row/mens-cycling-apparel.html"); // stepKey: redirectToTargetPageAccessPageAndVerifyJSError
		$I->dontSeeJsError(); // stepKey: dontSeeJsErrorAccessPageAndVerifyJSError
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAccessPageAndVerifyJSError
		$I->comment("Exiting Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("Search by key");
		$I->click("a#inner-header-search-popup"); // stepKey: clickSearchIconToOpenSearchForm
		$I->comment("Entering Action Group [searchByKey] SearchByKeywordActionGroup");
		$I->waitForElement("#search", 30); // stepKey: waitForSearchFieldSearchByKey
		$I->fillField("#search", "JERSEYS"); // stepKey: fillSearchFieldSearchByKey
		$pressEnterSearchByKey = $I->executeJS("var form = document.getElementById('search_mini_form'); form.submit();"); // stepKey: pressEnterSearchByKey
		$I->waitForPageLoad(30); // stepKey: waitForSearchResultsSearchByKey
		$I->comment("Exiting Action Group [searchByKey] SearchByKeywordActionGroup");
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
		$I->comment("Verify Search result's content");
		$I->comment("Entering Action Group [verifyBreadcrumbDisplayed] VerifyDisplayedBreadcrumbActionGroup");
		$I->seeElement(".breadcrumbs ul"); // stepKey: verifyBreadcrumbDisplayedVerifyBreadcrumbDisplayed
		$I->comment("Exiting Action Group [verifyBreadcrumbDisplayed] VerifyDisplayedBreadcrumbActionGroup");
		$I->comment("Entering Action Group [verifyProductResultDisplayed] VerifyDisplayedProductResultActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfPagesVerifyProductResultDisplayed
		$I->seeElement(".result-product-tab"); // stepKey: verifyProductTabDisplayedVerifyProductResultDisplayed
		$I->click(".result-product-tab"); // stepKey: clickProductTabVerifyProductResultDisplayed
		$I->waitForElement(".product-row-container", 30); // stepKey: waitForProductListDisplayedVerifyProductResultDisplayed
		$I->seeElement(".product-row-container"); // stepKey: verifyProductListDisplayedVerifyProductResultDisplayed
		$I->makeScreenshot("SearchPageProductResultScreenshot"); // stepKey: screenshotProductResultInSearchPageVerifyProductResultDisplayed
		$I->scrollTo("#toolbar-amount"); // stepKey: scrollTotalResultProductVerifyProductResultDisplayed
		$I->seeElement("#toolbar-amount"); // stepKey: verifyTotalResultProductDisplayedVerifyProductResultDisplayed
		$I->comment("Exiting Action Group [verifyProductResultDisplayed] VerifyDisplayedProductResultActionGroup");
		$I->comment("Entering Action Group [verifyBlogResultDisplayed] VerifyDisplayedBlogResultActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfPagesVerifyBlogResultDisplayed
		$I->seeElement(".result-blog-tab"); // stepKey: verifyBlogTabDisplayedVerifyBlogResultDisplayed
		$I->click(".result-blog-tab"); // stepKey: clickBlogTabVerifyBlogResultDisplayed
		$I->waitForAjaxLoad(30); // stepKey: waitForAjaxLoadVerifyBlogResultDisplayed
		$I->makeScreenshot("SearchPageBlogResultScreenshot"); // stepKey: screenshotBlogResultInSearchPageVerifyBlogResultDisplayed
		$I->seeElement("#gazette-container"); // stepKey: verifyBlogListDisplayedVerifyBlogResultDisplayed
		$I->scrollTo(".toolbar-amount"); // stepKey: scrollTotalResultBlogVerifyBlogResultDisplayed
		$I->seeElement(".toolbar-amount"); // stepKey: verifyTotalResultBlogDisplayedVerifyBlogResultDisplayed
		$I->comment("Exiting Action Group [verifyBlogResultDisplayed] VerifyDisplayedBlogResultActionGroup");
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
