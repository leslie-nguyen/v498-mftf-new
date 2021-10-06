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
 * @group reports
 * @Title("MAGETWO-95960: Canceled orders in order sales report")
 * @Description("Verify canceling of orders in order sales report<h3>Test files</h3>vendor\magento\module-reports\Test\Mftf\Test\CancelOrdersInOrderSalesReportTest.xml<br>")
 * @TestCaseId("MAGETWO-95960")
 */
class CancelOrdersInOrderSalesReportTestCest
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
		$I->comment("log in as admin");
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->comment("create new product");
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createSimpleProduct", "hook", "SimpleProduct", ["createCategory"], []); // stepKey: createSimpleProduct
		$I->comment("create new customer");
		$I->createEntity("createCustomer", "hook", "Simple_US_Customer", [], []); // stepKey: createCustomer
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createCustomer", "hook"); // stepKey: deleteCustomer
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("createSimpleProduct", "hook"); // stepKey: deleteProduct
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
	 * @Features({"Reports"})
	 * @Stories({"Order Sales Report includes canceled orders"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CancelOrdersInOrderSalesReportTest(AcceptanceTester $I)
	{
		$I->comment("Create completed order");
		$I->comment("Entering Action Group [createOrderd] CreateOrderActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_create/index"); // stepKey: navigateToNewOrderPageCreateOrderd
		$I->waitForPageLoad(30); // stepKey: waitForNewOrderPageOpenedCreateOrderd
		$I->click("(//td[contains(text(),'" . $I->retrieveEntityField('createCustomer', 'firstname', 'test') . "')])[1]"); // stepKey: chooseCustomerCreateOrderd
		$I->waitForPageLoad(60); // stepKey: chooseCustomerCreateOrderdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForStoresPageOpenedCreateOrderd
		$I->click("#add_products"); // stepKey: clickOnAddProductsCreateOrderd
		$I->waitForPageLoad(60); // stepKey: clickOnAddProductsCreateOrderdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductsListForOrderCreateOrderd
		$I->click("//td[contains(text(),'" . $I->retrieveEntityField('createSimpleProduct', 'sku', 'test') . "')]"); // stepKey: chooseTheProductCreateOrderd
		$I->waitForPageLoad(60); // stepKey: chooseTheProductCreateOrderdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickProductCreateOrderd
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: addSelectedProductToOrderCreateOrderd
		$I->waitForPageLoad(30); // stepKey: addSelectedProductToOrderCreateOrderdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductAddedInOrderCreateOrderd
		$I->click("//span[text()='Get shipping methods and rates']"); // stepKey: openShippingMethodCreateOrderd
		$I->waitForPageLoad(60); // stepKey: openShippingMethodCreateOrderdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethodsCreateOrderd
		$I->click("//label[contains(text(), 'Fixed')]"); // stepKey: chooseShippingMethodCreateOrderd
		$I->waitForPageLoad(60); // stepKey: chooseShippingMethodCreateOrderdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethodsThickenedCreateOrderd
		$I->click("#submit_order_top_button"); // stepKey: submitOrderCreateOrderd
		$I->waitForPageLoad(60); // stepKey: submitOrderCreateOrderdWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSubmitOrderCreateOrderd
		$I->see("You created the order."); // stepKey: seeSuccessMessageForOrderCreateOrderd
		$I->comment("Exiting Action Group [createOrderd] CreateOrderActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoiceAction
		$I->waitForPageLoad(30); // stepKey: clickInvoiceActionWaitForPageLoad
		$I->see("New Invoice", ".page-header h1.page-title"); // stepKey: seePageNameNewInvoicePage
		$I->comment("Entering Action Group [clickSubmitInvoice] AdminInvoiceClickSubmitActionGroup");
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: clickSubmitInvoiceClickSubmitInvoice
		$I->waitForPageLoad(60); // stepKey: clickSubmitInvoiceClickSubmitInvoiceWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForInvoiceToBeCreatedClickSubmitInvoice
		$I->comment("Exiting Action Group [clickSubmitInvoice] AdminInvoiceClickSubmitActionGroup");
		$I->click("#order_ship"); // stepKey: clickShipAction
		$I->waitForPageLoad(30); // stepKey: clickShipActionWaitForPageLoad
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/order_shipment/new/order_id/"); // stepKey: seeOrderShipmentUrl
		$I->click("button.action-default.save.submit-button"); // stepKey: clickSubmitShipment
		$I->waitForPageLoad(60); // stepKey: clickSubmitShipmentWaitForPageLoad
		$I->comment("Create Order");
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
		$I->comment("Cancel order");
		$I->comment("Entering Action Group [cancelOrder] CancelPendingOrderActionGroup");
		$I->click("#order-view-cancel-button"); // stepKey: clickCancelOrderCancelOrder
		$I->waitForPageLoad(30); // stepKey: clickCancelOrderCancelOrderWaitForPageLoad
		$I->waitForElement("aside.confirm .modal-content", 30); // stepKey: waitForCancelConfirmationCancelOrder
		$I->see("Are you sure you want to cancel this order?", "aside.confirm .modal-content"); // stepKey: seeConfirmationMessageCancelOrder
		$I->click("aside.confirm .modal-footer button.action-accept"); // stepKey: confirmOrderCancelCancelOrder
		$I->waitForPageLoad(60); // stepKey: confirmOrderCancelCancelOrderWaitForPageLoad
		$I->see("You canceled the order.", "#messages div.message-success"); // stepKey: seeCancelSuccessMessageCancelOrder
		$I->see("Canceled", ".order-information table.order-information-table #order_status"); // stepKey: seeOrderStatusCanceledCancelOrder
		$I->comment("Exiting Action Group [cancelOrder] CancelPendingOrderActionGroup");
		$I->comment("Generate Order report for statuses");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/reports/report_sales/sales/"); // stepKey: goToOrdersReportPage1
		$I->waitForPageLoad(30); // stepKey: waitForOrdersReportPageLoad1
		$I->comment("Get date");
		$date = new \DateTime();
		$date->setTimestamp(strtotime("+0 day"));
		$date->setTimezone(new \DateTimeZone("America/Los_Angeles"));
		$generateEndDate = $date->format("m/d/Y");

		$date = new \DateTime();
		$date->setTimestamp(strtotime("-1 day"));
		$date->setTimezone(new \DateTimeZone("America/Los_Angeles"));
		$generateStartDate = $date->format("m/d/Y");

		$I->comment("Entering Action Group [generateReportAfterCancelOrderBefore] GenerateOrderReportForNotCancelActionGroup");
		$I->click("//a[contains(text(), 'here')]"); // stepKey: clickOnHereGenerateReportAfterCancelOrderBefore
		$I->waitForPageLoad(60); // stepKey: clickOnHereGenerateReportAfterCancelOrderBeforeWaitForPageLoad
		$I->fillField("#sales_report_from", "$generateStartDate"); // stepKey: fillFromDateGenerateReportAfterCancelOrderBefore
		$I->fillField("#sales_report_to", "$generateEndDate"); // stepKey: fillToDateGenerateReportAfterCancelOrderBefore
		$I->selectOption("#sales_report_show_order_statuses", "Specified"); // stepKey: selectSpecifiedOptionGenerateReportAfterCancelOrderBefore
		$I->selectOption("#sales_report_order_statuses", ['closed',  'complete',  'fraud',  'holded',  'payment_review',  'paypal_canceled_reversal',  'paypal_reversed',  'processing']); // stepKey: selectSpecifiedOptionStatusGenerateReportAfterCancelOrderBefore
		$I->click("#filter_form_submit"); // stepKey: showReportGenerateReportAfterCancelOrderBefore
		$I->waitForPageLoad(60); // stepKey: showReportGenerateReportAfterCancelOrderBeforeWaitForPageLoad
		$I->comment("Exiting Action Group [generateReportAfterCancelOrderBefore] GenerateOrderReportForNotCancelActionGroup");
		$I->waitForElement("//tr[@class='totals']/th[@class=' col-orders col-orders_count col-number']", 30); // stepKey: waitForOrdersCountBefore
		$grabCanceledOrdersSpecified = $I->grabTextFrom("//tr[@class='totals']/th[@class=' col-orders col-orders_count col-number']"); // stepKey: grabCanceledOrdersSpecified
		$I->comment("Generate Order report");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/reports/report_sales/sales/"); // stepKey: goToOrdersReportPage2
		$I->waitForPageLoad(30); // stepKey: waitForOrdersReportPageLoad2
		$I->comment("Get date");
		$I->comment("Entering Action Group [generateReportAfterCancelOrder] GenerateOrderReportActionGroup");
		$I->click("//a[contains(text(), 'here')]"); // stepKey: clickOnHereGenerateReportAfterCancelOrder
		$I->waitForPageLoad(60); // stepKey: clickOnHereGenerateReportAfterCancelOrderWaitForPageLoad
		$I->fillField("#sales_report_from", "$generateStartDate"); // stepKey: fillFromDateGenerateReportAfterCancelOrder
		$I->fillField("#sales_report_to", "$generateEndDate"); // stepKey: fillToDateGenerateReportAfterCancelOrder
		$I->selectOption("#sales_report_show_order_statuses", "Any"); // stepKey: selectAnyOptionGenerateReportAfterCancelOrder
		$I->click("#filter_form_submit"); // stepKey: showReportGenerateReportAfterCancelOrder
		$I->waitForPageLoad(60); // stepKey: showReportGenerateReportAfterCancelOrderWaitForPageLoad
		$I->comment("Exiting Action Group [generateReportAfterCancelOrder] GenerateOrderReportActionGroup");
		$I->waitForElement("//tr[@class='totals']/th[@class=' col-orders col-orders_count col-number']", 30); // stepKey: waitForOrdersCount
		$grabCanceledOrdersAny = $I->grabTextFrom("//tr[@class='totals']/th[@class=' col-orders col-orders_count col-number']"); // stepKey: grabCanceledOrdersAny
		$I->comment("Compare canceled orders price");
		$I->assertEquals($grabCanceledOrdersSpecified, $grabCanceledOrdersAny); // stepKey: assertEquals
	}
}
