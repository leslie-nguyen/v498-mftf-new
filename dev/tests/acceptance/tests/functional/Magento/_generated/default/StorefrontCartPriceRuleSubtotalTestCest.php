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
 * @Title("MC-235: Customer should only see cart price rule discount if condition subtotal equals or greater than")
 * @Description("Customer should only see cart price rule discount if condition subtotal equals or greater than<h3>Test files</h3>vendor\magento\module-sales-rule\Test\Mftf\Test\StorefrontCartPriceRuleSubtotalTest.xml<br>")
 * @TestCaseId("MC-235")
 * @group SalesRule
 */
class StorefrontCartPriceRuleSubtotalTestCest
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
		$I->createEntity("createPreReqCategory", "hook", "_defaultCategory", [], []); // stepKey: createPreReqCategory
		$I->createEntity("createPreReqProduct", "hook", "_defaultProduct", ["createPreReqCategory"], []); // stepKey: createPreReqProduct
		$reindexInvalidatedIndices = $I->magentoCron("index", 90); // stepKey: reindexInvalidatedIndices
		$I->comment($reindexInvalidatedIndices);
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [cleanUpRule] DeleteCartPriceRuleByName");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales_rule/promo_quote/"); // stepKey: amOnCartPriceListCleanUpRule
		$I->waitForPageLoad(30); // stepKey: waitForPriceListCleanUpRule
		$I->fillField("input[name='name']", "SimpleSalesRule" . msq("SimpleSalesRule")); // stepKey: filterByNameCleanUpRule
		$I->click("#promo_quote_grid button[title='Search']"); // stepKey: doFilterCleanUpRule
		$I->waitForPageLoad(30); // stepKey: doFilterCleanUpRuleWaitForPageLoad
		$I->click("tr[data-role='row']:nth-of-type(1)"); // stepKey: goToEditRulePageCleanUpRule
		$I->waitForPageLoad(30); // stepKey: goToEditRulePageCleanUpRuleWaitForPageLoad
		$I->click("button#delete"); // stepKey: clickDeleteButtonCleanUpRule
		$I->waitForPageLoad(30); // stepKey: clickDeleteButtonCleanUpRuleWaitForPageLoad
		$I->click("button.action-accept"); // stepKey: confirmDeleteCleanUpRule
		$I->waitForPageLoad(30); // stepKey: confirmDeleteCleanUpRuleWaitForPageLoad
		$I->comment("Exiting Action Group [cleanUpRule] DeleteCartPriceRuleByName");
		$I->deleteEntity("createPreReqCategory", "hook"); // stepKey: deletePreReqCategory
		$I->deleteEntity("createPreReqProduct", "hook"); // stepKey: deletePreReqProduct
		$I->amOnPage("admin/admin/auth/logout/"); // stepKey: amOnLogoutPage
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
	 * @Features({"SalesRule"})
	 * @Stories({"Create cart price rule"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontCartPriceRuleSubtotalTest(AcceptanceTester $I)
	{
		$I->comment("Create the rule...");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales_rule/promo_quote/"); // stepKey: amOnCartPriceList
		$I->waitForPageLoad(30); // stepKey: waitForRulesPage
		$I->click("#add"); // stepKey: clickAddNewRule
		$I->waitForPageLoad(30); // stepKey: clickAddNewRuleWaitForPageLoad
		$I->fillField("input[name='name']", "SimpleSalesRule" . msq("SimpleSalesRule")); // stepKey: fillRuleName
		$I->selectOption("select[name='website_ids']", "Main Website"); // stepKey: selectWebsites
		$I->comment("Entering Action Group [selectNotLoggedInCustomerGroup] SelectNotLoggedInCustomerGroupActionGroup");
		$I->comment("This actionGroup was created to be merged from B2B because B2B has a very different form control here");
		$I->selectOption("select[name='customer_group_ids']", "NOT LOGGED IN"); // stepKey: selectCustomerGroupSelectNotLoggedInCustomerGroup
		$I->comment("Exiting Action Group [selectNotLoggedInCustomerGroup] SelectNotLoggedInCustomerGroupActionGroup");
		$date = new \DateTime();
		$date->setTimestamp(strtotime("-1 day"));
		$date->setTimezone(new \DateTimeZone("America/Los_Angeles"));
		$yesterdayDate = $date->format("m/d/Y");

		$I->fillField("input[name='from_date']", $yesterdayDate); // stepKey: fillFromDate
		$I->click("//div[@data-index='conditions']//span[contains(.,'Conditions')][1]"); // stepKey: expandConditions
		$I->comment("Scroll down to fix some flaky behavior...");
		$I->scrollTo("//div[@data-index='conditions']//span[contains(.,'Conditions')][1]"); // stepKey: scrollToConditionsTab
		$I->click("span.rule-param.rule-param-new-child"); // stepKey: clickNewRule
		$I->selectOption("select[data-form-part='sales_rule_form'][data-ui-id='newchild-0-select-rule-conditions-1-new-child']", "Subtotal"); // stepKey: selectProductAttributes
		$I->waitForPageLoad(30); // stepKey: waitForConditions
		$I->click("//*[@id='conditions__1__children']/li[1]/span[1]/a"); // stepKey: startEditOperator
		$I->selectOption("#conditions__1--1__operator", "equals or greater than"); // stepKey: fillOperator
		$I->click("//*[@id='conditions__1__children']/li[1]/span[2]/a"); // stepKey: startEditValue
		$I->fillField("#conditions__1--1__value", "200"); // stepKey: fillValue
		$I->click("div[data-index='actions']"); // stepKey: clickToExpandActions
		$I->waitForPageLoad(30); // stepKey: clickToExpandActionsWaitForPageLoad
		$I->selectOption("select[name='simple_action']", "Fixed amount discount for whole cart"); // stepKey: selectActionType
		$I->fillField("input[name='discount_amount']", "0.01"); // stepKey: fillDiscountAmount
		$I->click("#save"); // stepKey: clickSaveButton
		$I->waitForPageLoad(30); // stepKey: clickSaveButtonWaitForPageLoad
		$I->see("You saved the rule.", ".messages"); // stepKey: seeSuccessMessage
		$I->comment("Add 1 product worth \$123.00 to the cart");
		$I->amOnPage($I->retrieveEntityField('createPreReqProduct', 'name', 'test') . ".html"); // stepKey: goToProductPage
		$I->waitForPageLoad(30); // stepKey: waitForProductPageLoad
		$I->fillField("#qty", "1"); // stepKey: fillQuantity
		$I->comment("Entering Action Group [addToCartFromStorefrontProductPage] StorefrontClickAddToCartOnProductPageActionGroup");
		$I->click("#product-addtocart-button"); // stepKey: addToCartAddToCartFromStorefrontProductPage
		$I->waitForPageLoad(60); // stepKey: addToCartAddToCartFromStorefrontProductPageWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAddToCartAddToCartFromStorefrontProductPage
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageAddToCartFromStorefrontProductPage
		$I->comment("Exiting Action Group [addToCartFromStorefrontProductPage] StorefrontClickAddToCartOnProductPageActionGroup");
		$I->comment("Should not see the discount yet because we have not exceeded \$200");
		$I->comment("Entering Action Group [goToCartPage] StorefrontCartPageOpenActionGroup");
		$I->amOnPage("/checkout/cart"); // stepKey: openCartPageGoToCartPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadedGoToCartPage
		$I->comment("Exiting Action Group [goToCartPage] StorefrontCartPageOpenActionGroup");
		$I->see("$123.00", "//*[@id='cart-totals']//tr[@class='totals sub']//td//span[@class='price']"); // stepKey: seeSubtotal
		$I->dontSeeElement("td[data-th='Discount']"); // stepKey: dontSeeDiscount
		$I->comment("Add the same product to the cart again (\$246.00 subtotal)");
		$I->amOnPage($I->retrieveEntityField('createPreReqProduct', 'name', 'test') . ".html"); // stepKey: goToProductPage2
		$I->waitForPageLoad(30); // stepKey: waitForProductPageLoad2
		$I->fillField("#qty", "1"); // stepKey: fillQuantity2
		$I->comment("Entering Action Group [addToCartFromStorefrontProductPage2] StorefrontClickAddToCartOnProductPageActionGroup");
		$I->click("#product-addtocart-button"); // stepKey: addToCartAddToCartFromStorefrontProductPage2
		$I->waitForPageLoad(60); // stepKey: addToCartAddToCartFromStorefrontProductPage2WaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForAddToCartAddToCartFromStorefrontProductPage2
		$I->waitForElementVisible("div.message-success.success.message", 30); // stepKey: waitForSuccessMessageAddToCartFromStorefrontProductPage2
		$I->comment("Exiting Action Group [addToCartFromStorefrontProductPage2] StorefrontClickAddToCartOnProductPageActionGroup");
		$I->comment("Now we should see the discount because we exceeded \$200");
		$I->comment("Entering Action Group [goToCartPage2] StorefrontCartPageOpenActionGroup");
		$I->amOnPage("/checkout/cart"); // stepKey: openCartPageGoToCartPage2
		$I->waitForPageLoad(30); // stepKey: waitForPageLoadedGoToCartPage2
		$I->comment("Exiting Action Group [goToCartPage2] StorefrontCartPageOpenActionGroup");
		$I->see("$246.00", "//*[@id='cart-totals']//tr[@class='totals sub']//td//span[@class='price']"); // stepKey: seeSubtotal2
		$I->waitForElementVisible("td[data-th='Discount']", 30); // stepKey: waitForDiscountElement
		$I->see("-$0.01", "td[data-th='Discount']"); // stepKey: seeDiscountTotal
	}
}
