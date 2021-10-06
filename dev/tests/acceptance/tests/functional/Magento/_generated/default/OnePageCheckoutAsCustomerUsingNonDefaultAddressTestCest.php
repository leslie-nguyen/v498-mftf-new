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
 * @Title("MC-14739: OnePageCheckout as customer using non default address test")
 * @Description("Checkout as customer using non default address<h3>Test files</h3>vendor\magento\module-checkout\Test\Mftf\Test\OnePageCheckoutAsCustomerUsingNonDefaultAddressTest.xml<br>")
 * @TestCaseId("MC-14739")
 * @group checkout
 * @group mtf_migrated
 */
class OnePageCheckoutAsCustomerUsingNonDefaultAddressTestCest
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
		$I->comment("Create Simple Product");
		$createSimpleProductFields['price'] = "560";
		$I->createEntity("createSimpleProduct", "hook", "SimpleProduct2", [], $createSimpleProductFields); // stepKey: createSimpleProduct
		$I->comment("Create customer");
		$I->createEntity("createCustomer", "hook", "Customer_US_UK_DE", [], []); // stepKey: createCustomer
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Admin log out");
		$I->comment("Entering Action Group [logout] AdminLogoutActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/auth/logout/"); // stepKey: amOnLogoutPageLogout
		$I->comment("Exiting Action Group [logout] AdminLogoutActionGroup");
		$I->comment("Customer Log out");
		$I->comment("Entering Action Group [customerLogout] StorefrontCustomerLogoutActionGroup");
		$I->amOnPage("customer/account/logout/"); // stepKey: storefrontSignOutCustomerLogout
		$I->waitForPageLoad(30); // stepKey: waitForSignOutCustomerLogout
		$I->comment("Exiting Action Group [customerLogout] StorefrontCustomerLogoutActionGroup");
		$I->comment("Delete created product");
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteSimpleProduct
		$I->comment("Delete customer");
		$I->deleteEntity("createCustomer", "hook"); // stepKey: deleteCustomer
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
	 * @Stories({"OnePageCheckout within Offline Payment Methods"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function OnePageCheckoutAsCustomerUsingNonDefaultAddressTest(AcceptanceTester $I)
	{
		$I->comment("Add Simple Product to cart");
		$I->amOnPage("/" . $I->retrieveEntityField('createSimpleProduct', 'custom_attributes[url_key]', 'test') . ".html"); // stepKey: navigateToSimpleProductPage
		$I->waitForPageLoad(30); // stepKey: waitForSimpleProductPageLoad
		$I->comment("Entering Action Group [addToCartFromStorefrontProductPage] AddToCartFromStorefrontProductPageActionGroup");
		$I->click("#product-addtocart-button"); // stepKey: addToCartAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(60); // stepKey: addToCartAddToCartFromStorefrontProductPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAddToCartAddToCartFromStorefrontProductPage
		$I->waitForElementNotVisible("//button/span[text()='Adding...']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddingAddToCartFromStorefrontProductPage
		$I->waitForElementNotVisible("//button/span[text()='Added']", 30); // stepKey: waitForElementNotVisibleAddToCartButtonTitleIsAddedAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadAddToCartFromStorefrontProductPage
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageAddToCartFromStorefrontProductPage
		$I->see("You added " . $I->retrieveEntityField('createSimpleProduct', 'name', 'test') . " to your shopping cart.", "div.message-success.success.message"); // stepKey: seeAddToCartSuccessMessageAddToCartFromStorefrontProductPage
		$I->comment("Exiting Action Group [addToCartFromStorefrontProductPage] AddToCartFromStorefrontProductPageActionGroup");
		$I->comment("Go to shopping cart");
		$I->comment("Entering Action Group [goToShoppingCartFromMinicart] ClickViewAndEditCartFromMiniCartActionGroup");
		$I->scrollTo("a.showcart"); // stepKey: scrollToMiniCartGoToShoppingCartFromMinicart
		$I->waitForPageLoad(60); // stepKey: scrollToMiniCartGoToShoppingCartFromMinicartWaitForPageLoad
		$I->conditionalClick("a.showcart", "a.showcart.active", false); // stepKey: openMiniCartGoToShoppingCartFromMinicart
		$I->waitForElementVisible(".action.viewcart", 30); // stepKey: waitForViewAndEditCartVisibleGoToShoppingCartFromMinicart
		$I->waitForPageLoad(30); // stepKey: waitForViewAndEditCartVisibleGoToShoppingCartFromMinicartWaitForPageLoad
		$I->click(".action.viewcart"); // stepKey: viewAndEditCartGoToShoppingCartFromMinicart
		$I->waitForPageLoad(30); // stepKey: viewAndEditCartGoToShoppingCartFromMinicartWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoadGoToShoppingCartFromMinicart
		$I->seeInCurrentUrl("checkout/cart"); // stepKey: seeInCurrentUrlGoToShoppingCartFromMinicart
		$I->comment("Exiting Action Group [goToShoppingCartFromMinicart] ClickViewAndEditCartFromMiniCartActionGroup");
		$I->comment("Entering Action Group [fillShippingZipForm] FillShippingZipForm");
		$I->conditionalClick("#block-shipping-heading", "select[name='country_id']", false); // stepKey: openShippingDetailsFillShippingZipForm
		$I->waitForPageLoad(10); // stepKey: openShippingDetailsFillShippingZipFormWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskFillShippingZipForm
		$I->waitForElementVisible("select[name='country_id']", 30); // stepKey: waitForCountryFieldAppearsFillShippingZipForm
		$I->waitForPageLoad(10); // stepKey: waitForCountryFieldAppearsFillShippingZipFormWaitForPageLoad
		$I->selectOption("select[name='country_id']", "United States"); // stepKey: selectCountryFillShippingZipForm
		$I->waitForPageLoad(10); // stepKey: selectCountryFillShippingZipFormWaitForPageLoad
		$I->selectOption("select[name='region_id']", "California"); // stepKey: selectStateProvinceFillShippingZipForm
		$I->waitForPageLoad(10); // stepKey: selectStateProvinceFillShippingZipFormWaitForPageLoad
		$I->fillField("input[name='postcode']", "90001"); // stepKey: fillPostCodeFillShippingZipForm
		$I->waitForPageLoad(10); // stepKey: fillPostCodeFillShippingZipFormWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForFormUpdateFillShippingZipForm
		$I->comment("Exiting Action Group [fillShippingZipForm] FillShippingZipForm");
		$I->click("main .action.primary.checkout span"); // stepKey: clickProceedToCheckout
		$I->waitForPageLoad(30); // stepKey: clickProceedToCheckoutWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProceedToCheckout
		$I->comment("Login as customer on checkout page");
		$I->comment("Entering Action Group [customerLogin] LoginAsCustomerOnCheckoutPageActionGroup");
		$I->waitForPageLoad(30); // stepKey: waitForCheckoutShippingSectionToLoadCustomerLogin
		$I->fillField("input[id*=customer-email]", $I->retrieveEntityField('createCustomer', 'email', 'test')); // stepKey: fillEmailFieldCustomerLogin
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskToDisappearCustomerLogin
		$I->waitForElementVisible("#customer-password", 30); // stepKey: waitForElementVisibleCustomerLogin
		$I->fillField("#customer-password", $I->retrieveEntityField('createCustomer', 'password', 'test')); // stepKey: fillPasswordFieldCustomerLogin
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskToDisappear2CustomerLogin
		$I->waitForElementVisible("//button[@data-action='checkout-method-login']", 30); // stepKey: waitForLoginButtonVisibleCustomerLogin
		$I->waitForPageLoad(30); // stepKey: waitForLoginButtonVisibleCustomerLoginWaitForPageLoad
		$I->doubleClick("//button[@data-action='checkout-method-login']"); // stepKey: clickLoginBtnCustomerLogin
		$I->waitForPageLoad(30); // stepKey: clickLoginBtnCustomerLoginWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskToDisappear3CustomerLogin
		$I->waitForPageLoad(30); // stepKey: waitToBeLoggedInCustomerLogin
		$I->waitForElementNotVisible("input[id*=customer-email]", 60); // stepKey: waitForEmailInvisibleCustomerLogin
		$I->comment("Exiting Action Group [customerLogin] LoginAsCustomerOnCheckoutPageActionGroup");
		$I->click("//div[text()='Augsburger Strabe 41']/button[@class='action action-select-shipping-item']"); // stepKey: clickShipHere
		$I->waitForPageLoad(30); // stepKey: clickShipHereWaitForPageLoad
		$I->comment("Click next button to open payment section");
		$I->click("button.button.action.continue.primary"); // stepKey: clickNext
		$I->waitForPageLoad(30); // stepKey: clickNextWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShipmentPageLoad
		$I->uncheckOption("#billing-address-same-as-shipping-checkmo"); // stepKey: selectPaymentSolution
		$I->comment("Change the address");
		$I->click("button.action.action-edit-address"); // stepKey: editAddress
		$I->waitForElementVisible("[name=billing_address_id]", 30); // stepKey: waitForDropDownToBeVisible
		$I->selectOption("[name=billing_address_id]", "172, Westminster Bridge Rd"); // stepKey: addAddress
		$I->comment("Check order summary in checkout");
		$I->click(".action-update"); // stepKey: clickToUpdate
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->comment("Place order");
		$I->click(".payment-method._active button.action.primary.checkout"); // stepKey: clickPlaceOrder
		$I->waitForPageLoad(30); // stepKey: clickPlaceOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForCheckoutPaymentSectionPageLoad
		$I->seeElement("div.checkout-success"); // stepKey: orderIsSuccessfullyPlaced
		$grabOrderNumber = $I->grabTextFrom(".order-number>strong"); // stepKey: grabOrderNumber
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->comment("Open created order in backend");
		$I->comment("Entering Action Group [goToOrders] AdminOrdersPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: openOrdersGridPageGoToOrders
		$I->waitForPageLoad(30); // stepKey: waitForLoadingPageGoToOrders
		$I->comment("Exiting Action Group [goToOrders] AdminOrdersPageOpenActionGroup");
		$I->comment("Entering Action Group [filterOrderGridById] OpenOrderByIdActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: navigateToOrderGridPageFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: waitForOrdersPageFilterOrderGridById
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersFilterOrderGridByIdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClearFiltersFilterOrderGridById
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openOrderGridFiltersFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: openOrderGridFiltersFilterOrderGridByIdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickFiltersFilterOrderGridById
		$I->fillField(".admin__data-grid-filters input[name='increment_id']", "$grabOrderNumber"); // stepKey: fillOrderIdFilterFilterOrderGridById
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickOrderApplyFiltersFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: clickOrderApplyFiltersFilterOrderGridByIdWaitForPageLoad
		$I->click("tr.data-row:nth-of-type(1)"); // stepKey: openOrderViewPageFilterOrderGridById
		$I->waitForPageLoad(60); // stepKey: openOrderViewPageFilterOrderGridByIdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForOrderViewPageOpenedFilterOrderGridById
		$I->waitForPageLoad(30); // stepKey: waitForApplyFiltersFilterOrderGridById
		$I->comment("Exiting Action Group [filterOrderGridById] OpenOrderByIdActionGroup");
		$I->comment("Assert order total");
		$I->scrollTo(".order-subtotal-table tfoot tr.col-0>td span.price"); // stepKey: scrollToOrderTotalSection
		$I->see("$565.00", ".order-subtotal-table tfoot tr.col-0>td span.price"); // stepKey: checkOrderTotalInBackend
		$I->comment("Assert order addresses");
		$I->see("172, Westminster Bridge Rd", ".order-billing-address address"); // stepKey: seeBillingAddressStreet
		$I->see("London", ".order-billing-address address"); // stepKey: seeBillingAddressCity
		$I->see("SE1 7RW", ".order-billing-address address"); // stepKey: seeBillingAddressPostcode
		$I->see("Augsburger Strabe 41", ".order-shipping-address address"); // stepKey: seeShippingAddressStreet
		$I->see("Berlin", ".order-shipping-address address"); // stepKey: seeShippingAddressCity
		$I->see("10789", ".order-shipping-address address"); // stepKey: seeShippingAddressPostcode
	}
}
