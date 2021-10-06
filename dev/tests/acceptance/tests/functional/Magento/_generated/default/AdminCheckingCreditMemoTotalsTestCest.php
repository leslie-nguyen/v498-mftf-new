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
 * @Title("MC-18159: Checking Credit Memo Update Totals button")
 * @Description("Checking Credit Memo Update Totals button<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\AdminCheckingCreditMemoUpdateTotalsTest.xml<br>")
 * @TestCaseId("MC-18159")
 * @group sales
 */
class AdminCheckingCreditMemoTotalsTestCest
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
		$I->comment("Create product");
		$I->createEntity("createSimpleProduct", "hook", "SimpleProduct2", [], []); // stepKey: createSimpleProduct
		$I->comment("Create customer");
		$I->createEntity("createCustomer", "hook", "Simple_US_CA_Customer", [], []); // stepKey: createCustomer
		$I->comment("Login to admin page");
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
		$I->comment("Delete simple product");
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteSimpleProduct
		$I->comment("Delete customer");
		$I->deleteEntity("createCustomer", "hook"); // stepKey: deleteCustomer
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
	 * @Features({"Sales"})
	 * @Stories({"Create credit memo"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCheckingCreditMemoTotalsTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [createOrder] CreateOrderActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_create/index"); // stepKey: navigateToNewOrderPageCreateOrder
		$I->waitForPageLoad(30); // stepKey: waitForNewOrderPageOpenedCreateOrder
		$I->click("(//td[contains(text(),'" . $I->retrieveEntityField('createCustomer', 'firstname', 'test') . "')])[1]"); // stepKey: chooseCustomerCreateOrder
		$I->waitForPageLoad(60); // stepKey: chooseCustomerCreateOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForStoresPageOpenedCreateOrder
		$I->click("#add_products"); // stepKey: clickOnAddProductsCreateOrder
		$I->waitForPageLoad(60); // stepKey: clickOnAddProductsCreateOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductsListForOrderCreateOrder
		$I->click("//td[contains(text(),'" . $I->retrieveEntityField('createSimpleProduct', 'sku', 'test') . "')]"); // stepKey: chooseTheProductCreateOrder
		$I->waitForPageLoad(60); // stepKey: chooseTheProductCreateOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickProductCreateOrder
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: addSelectedProductToOrderCreateOrder
		$I->waitForPageLoad(30); // stepKey: addSelectedProductToOrderCreateOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductAddedInOrderCreateOrder
		$I->click("//span[text()='Get shipping methods and rates']"); // stepKey: openShippingMethodCreateOrder
		$I->waitForPageLoad(60); // stepKey: openShippingMethodCreateOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethodsCreateOrder
		$I->click("//label[contains(text(), 'Fixed')]"); // stepKey: chooseShippingMethodCreateOrder
		$I->waitForPageLoad(60); // stepKey: chooseShippingMethodCreateOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethodsThickenedCreateOrder
		$I->click("#submit_order_top_button"); // stepKey: submitOrderCreateOrder
		$I->waitForPageLoad(60); // stepKey: submitOrderCreateOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSubmitOrderCreateOrder
		$I->see("You created the order."); // stepKey: seeSuccessMessageForOrderCreateOrder
		$I->comment("Exiting Action Group [createOrder] CreateOrderActionGroup");
		$grabOrderId = $I->grabFromCurrentUrl("~/order_id/(\d+)/~"); // stepKey: grabOrderId
		$I->comment("Create invoice");
		$I->comment("Entering Action Group [startCreateInvoice] StartCreateInvoiceFromOrderPageActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoiceActionStartCreateInvoice
		$I->waitForPageLoad(30); // stepKey: clickInvoiceActionStartCreateInvoiceWaitForPageLoad
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_invoice/new/order_id/"); // stepKey: seeNewInvoiceUrlStartCreateInvoice
		$I->see("New Invoice", ".page-header h1.page-title"); // stepKey: seeNewInvoicePageTitleStartCreateInvoice
		$I->comment("Exiting Action Group [startCreateInvoice] StartCreateInvoiceFromOrderPageActionGroup");
		$I->comment("Submit invoice");
		$I->comment("Entering Action Group [submitInvoice] SubmitInvoiceActionGroup");
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: clickSubmitInvoiceSubmitInvoice
		$I->waitForPageLoad(60); // stepKey: clickSubmitInvoiceSubmitInvoiceWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForMessageAppearsSubmitInvoice
		$I->see("The invoice has been created.", "#messages div.message-success"); // stepKey: seeInvoiceCreateSuccessSubmitInvoice
		$grabOrderIdSubmitInvoice = $I->grabFromCurrentUrl("~/order_id/(\d+)/~"); // stepKey: grabOrderIdSubmitInvoice
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/view/order_id/"); // stepKey: seeViewOrderPageInvoiceSubmitInvoice
		$I->comment("Exiting Action Group [submitInvoice] SubmitInvoiceActionGroup");
		$I->comment("Create Credit Memo");
		$I->comment("Entering Action Group [startToCreateCreditMemo] StartToCreateCreditMemoActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/view/order_id/{$grabOrderId}"); // stepKey: navigateToOrderPageStartToCreateCreditMemo
		$I->click("#order_creditmemo"); // stepKey: clickCreditMemoStartToCreateCreditMemo
		$I->waitForPageLoad(30); // stepKey: clickCreditMemoStartToCreateCreditMemoWaitForPageLoad
		$I->waitForElementVisible(".page-header h1.page-title", 30); // stepKey: waitForPageTitleStartToCreateCreditMemo
		$I->see("New Memo", ".page-header h1.page-title"); // stepKey: seeNewMemoPageTitleStartToCreateCreditMemo
		$I->comment("Exiting Action Group [startToCreateCreditMemo] StartToCreateCreditMemoActionGroup");
		$I->fillField(".order-subtotal-table tbody input[name='creditmemo[shipping_amount]']", "0"); // stepKey: setRefundShipping
		$I->comment("Entering Action Group [updateCreditMemoTotals] UpdateCreditMemoTotalsActionGroup");
		$I->waitForElementVisible(".update-totals-button", 30); // stepKey: waitUpdateTotalsButtonEnabledUpdateCreditMemoTotals
		$I->waitForPageLoad(30); // stepKey: waitUpdateTotalsButtonEnabledUpdateCreditMemoTotalsWaitForPageLoad
		$I->click(".update-totals-button"); // stepKey: clickUpdateTotalsUpdateCreditMemoTotals
		$I->waitForPageLoad(30); // stepKey: clickUpdateTotalsUpdateCreditMemoTotalsWaitForPageLoad
		$I->comment("Exiting Action Group [updateCreditMemoTotals] UpdateCreditMemoTotalsActionGroup");
		$I->comment("Entering Action Group [submitCreditMemo] SubmitCreditMemoActionGroup");
		$grabOrderIdSubmitCreditMemo = $I->grabFromCurrentUrl("~/order_id/(\d+)/~"); // stepKey: grabOrderIdSubmitCreditMemo
		$I->waitForElementVisible(".order-totals-actions button[data-ui-id='order-items-submit-button']:not(.disabled)", 30); // stepKey: waitButtonEnabledSubmitCreditMemo
		$I->waitForPageLoad(60); // stepKey: waitButtonEnabledSubmitCreditMemoWaitForPageLoad
		$I->click(".order-totals-actions button[data-ui-id='order-items-submit-button']:not(.disabled)"); // stepKey: clickSubmitCreditMemoSubmitCreditMemo
		$I->waitForPageLoad(60); // stepKey: clickSubmitCreditMemoSubmitCreditMemoWaitForPageLoad
		$I->waitForElementVisible("#messages div.message-success", 30); // stepKey: waitForMessageAppearsSubmitCreditMemo
		$I->see("You created the credit memo.", "#messages div.message-success"); // stepKey: seeCreditMemoCreateSuccessSubmitCreditMemo
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/view/order_id/$grabOrderIdSubmitCreditMemo"); // stepKey: seeViewOrderPageCreditMemoSubmitCreditMemo
		$I->comment("Exiting Action Group [submitCreditMemo] SubmitCreditMemoActionGroup");
		$I->comment("Go to Credit Memo tab");
		$I->click("#sales_order_view_tabs_order_creditmemos"); // stepKey: clickCreditMemosTab
		$I->waitForPageLoad(30); // stepKey: waitForCreditMemosGridToLoad
		$I->comment("Check refunded total");
		$I->see("$123", "#sales_order_view_tabs_order_creditmemos_content .data-grid tbody > tr:nth-of-type(1)"); // stepKey: seeCreditMemoInGrid
	}
}
