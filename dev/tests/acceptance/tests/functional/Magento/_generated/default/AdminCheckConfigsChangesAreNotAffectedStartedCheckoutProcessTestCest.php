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
 * @Title("MC-12599: Admin check configs changes are not affected started checkout process test")
 * @Description("Changes in admin for shipping rates are not affecting checkout process that has been started<h3>Test files</h3>vendor\magento\module-checkout\Test\Mftf\Test\AdminCheckConfigsChangesIsNotAffectedStartedCheckoutProcessTest.xml<br>")
 * @TestCaseId("MC-12599")
 * @group checkout
 */
class AdminCheckConfigsChangesAreNotAffectedStartedCheckoutProcessTestCest
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
		$I->comment("Create simple product");
		$I->createEntity("createProduct", "hook", "SimpleProduct2", [], []); // stepKey: createProduct
		$I->comment("Enable free shipping method");
		$enableFreeShipping = $I->magentoCLI("config:set carriers/freeshipping/active 1", 60); // stepKey: enableFreeShipping
		$I->comment($enableFreeShipping);
		$I->comment("Disable flat rate method");
		$disableFlatRate = $I->magentoCLI("config:set carriers/flatrate/active 0", 60); // stepKey: disableFlatRate
		$I->comment($disableFlatRate);
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Roll back configuration");
		$enableFlatRate = $I->magentoCLI("config:set carriers/flatrate/active 1", 60); // stepKey: enableFlatRate
		$I->comment($enableFlatRate);
		$disableFreeShipping = $I->magentoCLI("config:set carriers/freeshipping/active 0", 60); // stepKey: disableFreeShipping
		$I->comment($disableFreeShipping);
		$I->comment("Delete simple product");
		$I->deleteEntity("createProduct", "hook"); // stepKey: deleteProduct
		$I->comment("Log out");
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
	 * @Features({"Checkout"})
	 * @Stories({"Changes in configs are not affecting checkout process"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCheckConfigsChangesAreNotAffectedStartedCheckoutProcessTest(AcceptanceTester $I)
	{
		$I->comment("Add product to cart");
		$I->comment("Entering Action Group [openProductPage] OpenStoreFrontProductPageActionGroup");
		$I->amOnPage("/" . $I->retrieveEntityField('createProduct', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: amOnProductPageOpenProductPage
		$I->waitForPageLoad(30); // stepKey: waitForProductPageLoadOpenProductPage
		$I->comment("Exiting Action Group [openProductPage] OpenStoreFrontProductPageActionGroup");
		$I->comment("Entering Action Group [addProductToCart] StorefrontAddProductToCartActionGroup");
		$I->click("button#product-addtocart-button"); // stepKey: clickAddToCartAddProductToCart
		$I->waitForElementVisible("div.message-success", 30); // stepKey: waitForSuccessMessageAddProductToCart
		$I->see("You added " . $I->retrieveEntityField('createProduct', 'name', 'test') . " to your shopping cart.", ".page.messages"); // stepKey: assertSuccessMessageAddProductToCart
		$I->waitForPageLoad(30); // stepKey: assertSuccessMessageAddProductToCartWaitForPageLoad
		$I->seeLink("shopping cart", getenv("MAGENTO_BASE_URL") . "checkout/cart/"); // stepKey: assertLinkToShoppingCartAddProductToCart
		$I->waitForText("1", 30, "//header//div[contains(@class, 'minicart-wrapper')]//a[contains(@class, 'showcart')]//span[@class='counter-number']"); // stepKey: assertProductCountAddProductToCart
		$I->comment("Exiting Action Group [addProductToCart] StorefrontAddProductToCartActionGroup");
		$I->comment("Proceed to Checkout from mini shopping cart");
		$I->comment("Entering Action Group [goToCheckout] GoToCheckoutFromMinicartActionGroup");
		$I->waitForElementNotVisible(".counter.qty.empty", 30); // stepKey: waitUpdateQuantityGoToCheckout
		$I->wait(5); // stepKey: waitMinicartRenderingGoToCheckout
		$I->click("a.showcart"); // stepKey: clickCartGoToCheckout
		$I->waitForPageLoad(60); // stepKey: clickCartGoToCheckoutWaitForPageLoad
		$I->click("#top-cart-btn-checkout"); // stepKey: goToCheckoutGoToCheckout
		$I->waitForPageLoad(30); // stepKey: goToCheckoutGoToCheckoutWaitForPageLoad
		$I->comment("Exiting Action Group [goToCheckout] GoToCheckoutFromMinicartActionGroup");
		$I->comment("Fill all required fields");
		$I->comment("Entering Action Group [fillNewShippingAddress] GuestCheckoutFillNewShippingAddressActionGroup");
		$I->fillField("input[id*=customer-email]", msq("Simple_Customer_Without_Address") . "John.Doe@example.com"); // stepKey: fillEmailFieldFillNewShippingAddress
		$I->fillField("input[name=firstname]", "John"); // stepKey: fillFirstNameFillNewShippingAddress
		$I->fillField("input[name=lastname]", "Doe"); // stepKey: fillLastNameFillNewShippingAddress
		$I->fillField("input[name='street[0]']", "[\"7700 West Parmer Lane\"]"); // stepKey: fillStreetFillNewShippingAddress
		$I->fillField("input[name=city]", "Austin"); // stepKey: fillCityFillNewShippingAddress
		$I->selectOption("select[name=region_id]", "Texas"); // stepKey: selectRegionFillNewShippingAddress
		$I->fillField("input[name=postcode]", "78729"); // stepKey: fillZipCodeFillNewShippingAddress
		$I->fillField("input[name=telephone]", "512-345-6789"); // stepKey: fillPhoneFillNewShippingAddress
		$I->comment("Exiting Action Group [fillNewShippingAddress] GuestCheckoutFillNewShippingAddressActionGroup");
		$I->comment("Assert Free Shipping checkbox");
		$I->seeCheckboxIsChecked("#checkout-shipping-method-load input[value='freeshipping_freeshipping']"); // stepKey: freeShippingMethodCheckboxIsChecked
		$I->waitForPageLoad(60); // stepKey: freeShippingMethodCheckboxIsCheckedWaitForPageLoad
		$I->comment("Click Next button");
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext
		$I->waitForPageLoad(30); // stepKey: clickNextWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShipmentPageLoad
		$I->comment("Payment step is opened");
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoaded
		$I->comment("Order Summary block contains information about shipping");
		$I->comment("Entering Action Group [guestCheckoutCheckShippingMethod] CheckShippingMethodInCheckoutActionGroup");
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoadedGuestCheckoutCheckShippingMethod
		$I->see("Free Shipping", "//div[@class='ship-via']//div[@class='shipping-information-content']"); // stepKey: assertshippingMethodInformationGuestCheckoutCheckShippingMethod
		$I->comment("Exiting Action Group [guestCheckoutCheckShippingMethod] CheckShippingMethodInCheckoutActionGroup");
		$I->comment("Open new browser's window and login as Admin");
		$I->openNewTab(); // stepKey: openNewTab
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->comment("Go to Store > Configuration > Sales > Shipping Methods");
		$I->comment("Entering Action Group [openShippingMethodConfigPage] AdminOpenShippingMethodsConfigPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/system_config/edit/section/carriers/"); // stepKey: navigateToAdminShippingMethodsPageOpenShippingMethodConfigPage
		$I->waitForPageLoad(30); // stepKey: waitForAdminShippingMethodsPageToLoadOpenShippingMethodConfigPage
		$I->comment("Exiting Action Group [openShippingMethodConfigPage] AdminOpenShippingMethodsConfigPageActionGroup");
		$I->comment("Enable \"Flat Rate\"");
		$I->comment("Entering Action Group [enableFlatRateShippingStatus] AdminChangeFlatRateShippingMethodStatusActionGroup");
		$I->conditionalClick("#carriers_flatrate-head", "#carriers_flatrate_active", false); // stepKey: expandTabEnableFlatRateShippingStatus
		$I->selectOption("#carriers_flatrate_active", "1"); // stepKey: changeFlatRateMethodStatusEnableFlatRateShippingStatus
		$I->click("#save"); // stepKey: saveConfigsEnableFlatRateShippingStatus
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadEnableFlatRateShippingStatus
		$I->see("You saved the configuration.", ".message-success"); // stepKey: seeSuccessMessageEnableFlatRateShippingStatus
		$I->comment("Exiting Action Group [enableFlatRateShippingStatus] AdminChangeFlatRateShippingMethodStatusActionGroup");
		$I->comment("Flush cache");
		$I->comment("Entering Action Group [flushCache] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCache = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCache
		$I->comment($flushSpecifiedCacheFlushCache);
		$I->comment("Exiting Action Group [flushCache] CliCacheFlushActionGroup");
		$I->comment("Back to the Checkout and refresh the page");
		$I->switchToPreviousTab(); // stepKey: switchToPreviousTab
		$I->reloadPage(); // stepKey: refreshPage
		$I->waitForPageLoad(30); // stepKey: waitPageReload
		$I->comment("Payment step is opened after refreshing");
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSection
		$I->comment("Order Summary block contains information about free shipping");
		$I->comment("Entering Action Group [guestCheckoutCheckFreeShippingMethod] CheckShippingMethodInCheckoutActionGroup");
		$I->waitForElement("//*[@id='checkout-payment-method-load']//div[@data-role='title']", 30); // stepKey: waitForPaymentSectionLoadedGuestCheckoutCheckFreeShippingMethod
		$I->see("Free Shipping", "//div[@class='ship-via']//div[@class='shipping-information-content']"); // stepKey: assertshippingMethodInformationGuestCheckoutCheckFreeShippingMethod
		$I->comment("Exiting Action Group [guestCheckoutCheckFreeShippingMethod] CheckShippingMethodInCheckoutActionGroup");
	}
}
