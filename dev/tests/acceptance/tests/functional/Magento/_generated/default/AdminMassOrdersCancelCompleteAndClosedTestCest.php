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
 * @Title("MC-16183: Mass cancel orders in status  Complete, Closed")
 * @Description("Try to cancel orders in status Complete, Closed<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\AdminMassOrdersCancelCompleteAndClosedTest.xml<br>")
 * @TestCaseId("MC-16183")
 * @group sales
 * @group mtf_migrated
 */
class AdminMassOrdersCancelCompleteAndClosedTestCest
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
		$I->comment("Entering Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [LoginAsAdmin] AdminLoginActionGroup");
		$I->comment("Create Data");
		$I->createEntity("createCustomer", "hook", "Simple_US_Customer", [], []); // stepKey: createCustomer
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createProduct", "hook", "defaultSimpleProduct", ["createCategory"], []); // stepKey: createProduct
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Delete data");
		$I->deleteEntity("createCustomer", "hook"); // stepKey: deleteCustomer
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$I->deleteEntity("createProduct", "hook"); // stepKey: deleteProduct
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
	 * @Stories({"Mass Update Orders"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Features({"Sales"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminMassOrdersCancelCompleteAndClosedTest(AcceptanceTester $I)
	{
		$I->comment("Create first order");
		$I->comment("Entering Action Group [createFirstOrder] CreateOrderActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_create/index"); // stepKey: navigateToNewOrderPageCreateFirstOrder
		$I->waitForPageLoad(30); // stepKey: waitForNewOrderPageOpenedCreateFirstOrder
		$I->click("(//td[contains(text(),'" . $I->retrieveEntityField('createCustomer', 'firstname', 'test') . "')])[1]"); // stepKey: chooseCustomerCreateFirstOrder
		$I->waitForPageLoad(60); // stepKey: chooseCustomerCreateFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForStoresPageOpenedCreateFirstOrder
		$I->click("#add_products"); // stepKey: clickOnAddProductsCreateFirstOrder
		$I->waitForPageLoad(60); // stepKey: clickOnAddProductsCreateFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductsListForOrderCreateFirstOrder
		$I->click("//td[contains(text(),'" . $I->retrieveEntityField('createProduct', 'sku', 'test') . "')]"); // stepKey: chooseTheProductCreateFirstOrder
		$I->waitForPageLoad(60); // stepKey: chooseTheProductCreateFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickProductCreateFirstOrder
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: addSelectedProductToOrderCreateFirstOrder
		$I->waitForPageLoad(30); // stepKey: addSelectedProductToOrderCreateFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductAddedInOrderCreateFirstOrder
		$I->click("//span[text()='Get shipping methods and rates']"); // stepKey: openShippingMethodCreateFirstOrder
		$I->waitForPageLoad(60); // stepKey: openShippingMethodCreateFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethodsCreateFirstOrder
		$I->click("//label[contains(text(), 'Fixed')]"); // stepKey: chooseShippingMethodCreateFirstOrder
		$I->waitForPageLoad(60); // stepKey: chooseShippingMethodCreateFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethodsThickenedCreateFirstOrder
		$I->click("#submit_order_top_button"); // stepKey: submitOrderCreateFirstOrder
		$I->waitForPageLoad(60); // stepKey: submitOrderCreateFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSubmitOrderCreateFirstOrder
		$I->see("You created the order."); // stepKey: seeSuccessMessageForOrderCreateFirstOrder
		$I->comment("Exiting Action Group [createFirstOrder] CreateOrderActionGroup");
		$getFirstOrderId = $I->grabTextFrom("|Order # (\d+)|"); // stepKey: getFirstOrderId
		$I->assertNotEmpty($getFirstOrderId); // stepKey: assertOrderIdIsNotEmpty
		$I->comment("Create Shipment for first Order");
		$I->comment("Entering Action Group [createShipmentForFirstOrder] AdminCreateInvoiceAndShipmentActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoiceCreateShipmentForFirstOrder
		$I->waitForPageLoad(30); // stepKey: clickInvoiceCreateShipmentForFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForInvoicePageCreateShipmentForFirstOrder
		$I->checkOption(".order-shipping-address input[name='invoice[do_shipment]']"); // stepKey: checkCreateShipmentCreateShipmentForFirstOrder
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: submitInvoiceCreateShipmentForFirstOrder
		$I->waitForPageLoad(60); // stepKey: submitInvoiceCreateShipmentForFirstOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForLoadPageCreateShipmentForFirstOrder
		$I->see("You created the invoice and shipment."); // stepKey: seeMessageCreateShipmentForFirstOrder
		$I->comment("Exiting Action Group [createShipmentForFirstOrder] AdminCreateInvoiceAndShipmentActionGroup");
		$I->comment("Create second order");
		$I->comment("Entering Action Group [createSecondOrder] CreateOrderActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order_create/index"); // stepKey: navigateToNewOrderPageCreateSecondOrder
		$I->waitForPageLoad(30); // stepKey: waitForNewOrderPageOpenedCreateSecondOrder
		$I->click("(//td[contains(text(),'" . $I->retrieveEntityField('createCustomer', 'firstname', 'test') . "')])[1]"); // stepKey: chooseCustomerCreateSecondOrder
		$I->waitForPageLoad(60); // stepKey: chooseCustomerCreateSecondOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForStoresPageOpenedCreateSecondOrder
		$I->click("#add_products"); // stepKey: clickOnAddProductsCreateSecondOrder
		$I->waitForPageLoad(60); // stepKey: clickOnAddProductsCreateSecondOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductsListForOrderCreateSecondOrder
		$I->click("//td[contains(text(),'" . $I->retrieveEntityField('createProduct', 'sku', 'test') . "')]"); // stepKey: chooseTheProductCreateSecondOrder
		$I->waitForPageLoad(60); // stepKey: chooseTheProductCreateSecondOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForClickProductCreateSecondOrder
		$I->click("#order-search .admin__page-section-title .actions button.action-add"); // stepKey: addSelectedProductToOrderCreateSecondOrder
		$I->waitForPageLoad(30); // stepKey: addSelectedProductToOrderCreateSecondOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductAddedInOrderCreateSecondOrder
		$I->click("//span[text()='Get shipping methods and rates']"); // stepKey: openShippingMethodCreateSecondOrder
		$I->waitForPageLoad(60); // stepKey: openShippingMethodCreateSecondOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethodsCreateSecondOrder
		$I->click("//label[contains(text(), 'Fixed')]"); // stepKey: chooseShippingMethodCreateSecondOrder
		$I->waitForPageLoad(60); // stepKey: chooseShippingMethodCreateSecondOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForShippingMethodsThickenedCreateSecondOrder
		$I->click("#submit_order_top_button"); // stepKey: submitOrderCreateSecondOrder
		$I->waitForPageLoad(60); // stepKey: submitOrderCreateSecondOrderWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForSubmitOrderCreateSecondOrder
		$I->see("You created the order."); // stepKey: seeSuccessMessageForOrderCreateSecondOrder
		$I->comment("Exiting Action Group [createSecondOrder] CreateOrderActionGroup");
		$getSecondOrderId = $I->grabTextFrom("|Order # (\d+)|"); // stepKey: getSecondOrderId
		$I->assertNotEmpty($getSecondOrderId); // stepKey: assertSecondOrderIdIsNotEmpty
		$I->comment("Create CreditMemo for second Order");
		$I->comment("Entering Action Group [createCreditMemo] AdminCreateInvoiceAndCreditMemoActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoiceCreateCreditMemo
		$I->waitForPageLoad(30); // stepKey: clickInvoiceCreateCreditMemoWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForInvoicePageCreateCreditMemo
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: submitInvoiceCreateCreditMemo
		$I->waitForPageLoad(60); // stepKey: submitInvoiceCreateCreditMemoWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForLoadPageCreateCreditMemo
		$I->see("The invoice has been created."); // stepKey: seeMessageCreateCreditMemo
		$I->click("#order_creditmemo"); // stepKey: pushButtonCreditMemoCreateCreditMemo
		$I->waitForPageLoad(30); // stepKey: pushButtonCreditMemoCreateCreditMemoWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForLoadingCreditMemoPageCreateCreditMemo
		$I->scrollTo(".order-totals-actions button[data-ui-id='order-items-submit-button']"); // stepKey: scrollToBottomCreateCreditMemo
		$I->waitForPageLoad(60); // stepKey: scrollToBottomCreateCreditMemoWaitForPageLoad
		$I->click(".order-totals-actions button[data-ui-id='order-items-submit-button']"); // stepKey: clickSubmitRefundCreateCreditMemo
		$I->waitForPageLoad(60); // stepKey: clickSubmitRefundCreateCreditMemoWaitForPageLoad
		$I->waitForPageLoad(60); // stepKey: waitForMainOrderPageLoadCreateCreditMemo
		$I->see("You created the credit memo."); // stepKey: seeCreditMemoMessageCreateCreditMemo
		$I->comment("Exiting Action Group [createCreditMemo] AdminCreateInvoiceAndCreditMemoActionGroup");
		$I->comment("Navigate to backend: Go to Sales > Orders");
		$I->comment("Entering Action Group [onOrderPage] AdminOrdersPageOpenActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: openOrdersGridPageOnOrderPage
		$I->waitForPageLoad(30); // stepKey: waitForLoadingPageOnOrderPage
		$I->comment("Exiting Action Group [onOrderPage] AdminOrdersPageOpenActionGroup");
		$I->comment("Entering Action Group [clearFilters] AdminOrdersGridClearFiltersActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: goToGridOrdersPageClearFilters
		$I->waitForPageLoad(30); // stepKey: waitForPageToLoadClearFilters
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header .admin__data-grid-filters-current._show", true); // stepKey: clickOnButtonToRemoveFiltersIfPresentClearFilters
		$I->comment("Exiting Action Group [clearFilters] AdminOrdersGridClearFiltersActionGroup");
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoading
		$I->comment("Select Mass Action according to dataset: Cancel");
		$I->comment("Entering Action Group [massActionCancel] AdminTwoOrderActionOnGridActionGroup");
		$I->checkOption("//td/div[text()='{$getFirstOrderId}']/../preceding-sibling::td//input"); // stepKey: selectOrderMassActionCancel
		$I->waitForPageLoad(60); // stepKey: selectOrderMassActionCancelWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForCheckMassActionCancel
		$I->checkOption("//td/div[text()='{$getSecondOrderId}']/../preceding-sibling::td//input"); // stepKey: selectSecondOrderMassActionCancel
		$I->waitForPageLoad(60); // stepKey: selectSecondOrderMassActionCancelWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForSecondCheckMassActionCancel
		$I->click(".action-select-wrap > .action-select"); // stepKey: openActionsMassActionCancel
		$I->waitForPageLoad(30); // stepKey: openActionsMassActionCancelWaitForPageLoad
		$I->click("(//div[contains(@class, 'action-menu-items')]//span[text()='Cancel'])[1]"); // stepKey: selectActionMassActionCancel
		$I->waitForPageLoad(30); // stepKey: selectActionMassActionCancelWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForResultsMassActionCancel
		$I->comment("Exiting Action Group [massActionCancel] AdminTwoOrderActionOnGridActionGroup");
		$I->see("You cannot cancel the order(s)."); // stepKey: assertOrderCancelMassActionFailMessage
		$I->comment("Assert first order in orders grid");
		$I->comment("Entering Action Group [seeFirstOrder] AdminOrderFilterByOrderIdAndStatusActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: navigateToOrderGridPageSeeFirstOrder
		$I->waitForPageLoad(30); // stepKey: waitForLoadingPageSeeFirstOrder
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersSeeFirstOrder
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersSeeFirstOrderWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openOrderGridFiltersSeeFirstOrder
		$I->waitForPageLoad(30); // stepKey: openOrderGridFiltersSeeFirstOrderWaitForPageLoad
		$I->fillField(".admin__data-grid-filters input[name='increment_id']", $getFirstOrderId); // stepKey: fillOrderIdFilterSeeFirstOrder
		$I->selectOption("select[name='status']", "Complete"); // stepKey: selectOrderStatusSeeFirstOrder
		$I->waitForPageLoad(60); // stepKey: selectOrderStatusSeeFirstOrderWaitForPageLoad
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickOrderApplyFiltersSeeFirstOrder
		$I->waitForPageLoad(30); // stepKey: clickOrderApplyFiltersSeeFirstOrderWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSeeFirstOrder
		$I->comment("Exiting Action Group [seeFirstOrder] AdminOrderFilterByOrderIdAndStatusActionGroup");
		$I->see($getFirstOrderId, "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[contains(., 'ID')]/preceding-sibling::th) +1 ]"); // stepKey: assertFirstOrderID
		$I->see("Complete", "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[contains(., 'Status')]/preceding-sibling::th) +1 ]"); // stepKey: assertFirstOrderStatus
		$I->comment("Assert second order in orders grid");
		$I->comment("Entering Action Group [seeSecondOrder] AdminOrderFilterByOrderIdAndStatusActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: navigateToOrderGridPageSeeSecondOrder
		$I->waitForPageLoad(30); // stepKey: waitForLoadingPageSeeSecondOrder
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersSeeSecondOrder
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersSeeSecondOrderWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openOrderGridFiltersSeeSecondOrder
		$I->waitForPageLoad(30); // stepKey: openOrderGridFiltersSeeSecondOrderWaitForPageLoad
		$I->fillField(".admin__data-grid-filters input[name='increment_id']", $getSecondOrderId); // stepKey: fillOrderIdFilterSeeSecondOrder
		$I->selectOption("select[name='status']", "Closed"); // stepKey: selectOrderStatusSeeSecondOrder
		$I->waitForPageLoad(60); // stepKey: selectOrderStatusSeeSecondOrderWaitForPageLoad
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickOrderApplyFiltersSeeSecondOrder
		$I->waitForPageLoad(30); // stepKey: clickOrderApplyFiltersSeeSecondOrderWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSeeSecondOrder
		$I->comment("Exiting Action Group [seeSecondOrder] AdminOrderFilterByOrderIdAndStatusActionGroup");
		$I->see($getSecondOrderId, "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[contains(., 'ID')]/preceding-sibling::th) +1 ]"); // stepKey: assertSecondOrderID
		$I->see("Closed", "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[contains(., 'Status')]/preceding-sibling::th) +1 ]"); // stepKey: assertSecondStatus
	}
}
