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
 * @Description("Check display homepage<h3>Test files</h3>app\code\Cafedu\Theme\Test\Mftf\Test\HomePageTest.xml<br>")
 * @TestCaseId("QUICK-HOME01")
 * @group QuickGoThrough
 */
class HomepageTestCest
{
	/**
	 * @Features({"Theme"})
	 * @Stories({"Check display homepage"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function HomepageTest(AcceptanceTester $I)
	{
		$I->comment("Access Homepage, close cookie popup");
		$I->comment("Entering Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->comment("<maximizeWindow stepKey=\"maximizeWindow\"/>");
		$I->amOnPage("/"); // stepKey: accessHomeAccessPageAndVerifyJSError
		$I->amOnPage("/en_row/"); // stepKey: redirectToTargetPageAccessPageAndVerifyJSError
		$I->dontSeeJsError(); // stepKey: dontSeeJsErrorAccessPageAndVerifyJSError
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAccessPageAndVerifyJSError
		$I->comment("Exiting Action Group [accessPageAndVerifyJSError] AmOnPageVerifyJSErrorActionGroup");
		$I->waitForElement("#onetrust-close-btn-container button", 30); // stepKey: waitForOneTrustCookieDisplayed
		$I->click("#onetrust-close-btn-container button"); // stepKey: closeCookiePopup
		$I->comment("Verify display banner, logo, menu, Search field and search icon");
		$I->seeElement(".banner-wrapper"); // stepKey: verifyBannerImageDisplayed
		$I->seeElement(".home-category"); // stepKey: verifyHomeMenuCategoriesDisplayed
		$I->seeElement(".home-logo"); // stepKey: verifyLogoDisplayed
		$I->seeElement(".search-box #search"); // stepKey: verifySearchBoxDisplayed
		$I->seeElement(".search-submit"); // stepKey: verifySearchIconDisplayed
		$I->comment("Verify display store switchers, copyright text, wishlist icon, account icon, mini cart icon");
		$I->scrollTo(".home-footer"); // stepKey: scrollToFooter
		$I->comment("Entering Action Group [verifyCountryDropdownDisplayed] VerifyDisplayedStoreSwitchersActionGroup");
		$I->seeElement("#switcher-store"); // stepKey: verifyCountryDropdownDisplayedVerifyCountryDropdownDisplayed
		$I->seeElement("#switcher-language"); // stepKey: verifyLanguageDropdownDisplayedVerifyCountryDropdownDisplayed
		$I->comment("Exiting Action Group [verifyCountryDropdownDisplayed] VerifyDisplayedStoreSwitchersActionGroup");
		$I->comment("Entering Action Group [verifyWishlistAccountMiniCartIconsDisplayed] VerifyDisplayedWishlistAccountMiniCartIconsActionGroup");
		$I->seeElement("a.trigger-auth-wishlist-popup"); // stepKey: verifyWishlistIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->seeElement("a.trigger-auth-popup"); // stepKey: verifyAccountIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->seeElement("a#cafedu-minicart-overlay"); // stepKey: verifyMiniCartIconDisplayedVerifyWishlistAccountMiniCartIconsDisplayed
		$I->comment("Exiting Action Group [verifyWishlistAccountMiniCartIconsDisplayed] VerifyDisplayedWishlistAccountMiniCartIconsActionGroup");
		$I->see("Copyright©2019 CAFÉ DU CYCLISTE. All rights reserved.", ".copyright"); // stepKey: verifyCopyrightText
		$I->click("#switcher-store"); // stepKey: clickCountryDropdown
		$I->makeScreenshot("HomepageScreenshot"); // stepKey: screenshotHomepage
	}
}
