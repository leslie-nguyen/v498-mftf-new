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
 * @Title("MC-16186: Try to put order in status Complete on Hold")
 * @Description("Try to put order in status Complete on Hold<h3>Test files</h3>vendor\magento\module-sales\Test\Mftf\Test\AdminMassOrdersHoldOnCompleteTest.xml<br>")
 * @TestCaseId("MC-16186")
 * @group sales
 * @group mtf_migrated
 */
class AdminMassOrdersHoldOnCompleteTestCest
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
	public function AdminMassOrdersHoldOnCompleteTest(AcceptanceTester $I)
	{
		$I->comment("Create order");
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
		$getOrderId = $I->grabTextFrom("|Order # (\d+)|"); // stepKey: getOrderId
		$I->assertNotEmpty($getOrderId); // stepKey: assertOrderIdIsNotEmpty
		$I->comment("Create Shipment for Order");
		$I->comment("Entering Action Group [createShipment] AdminCreateInvoiceAndShipmentActionGroup");
		$I->click("#order_invoice"); // stepKey: clickInvoiceCreateShipment
		$I->waitForPageLoad(30); // stepKey: clickInvoiceCreateShipmentWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForInvoicePageCreateShipment
		$I->checkOption(".order-shipping-address input[name='invoice[do_shipment]']"); // stepKey: checkCreateShipmentCreateShipment
		$I->click(".action-default.scalable.save.submit-button.primary"); // stepKey: submitInvoiceCreateShipment
		$I->waitForPageLoad(60); // stepKey: submitInvoiceCreateShipmentWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForLoadPageCreateShipment
		$I->see("You created the invoice and shipment."); // stepKey: seeMessageCreateShipment
		$I->comment("Exiting Action Group [createShipment] AdminCreateInvoiceAndShipmentActionGroup");
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
		$I->comment("Select Mass Action according to dataset: Hold");
		$I->comment("Entering Action Group [actionHold] AdminOrderActionOnGridActionGroup");
		$I->checkOption("//td/div[text()='$getOrderId']/../preceding-sibling::td//input"); // stepKey: selectOrderActionHold
		$I->waitForPageLoad(60); // stepKey: selectOrderActionHoldWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForCheckActionHold
		$I->click(".action-select-wrap > .action-select"); // stepKey: openActionsActionHold
		$I->waitForPageLoad(30); // stepKey: openActionsActionHoldWaitForPageLoad
		$I->click("(//div[contains(@class, 'action-menu-items')]//span[text()='Hold'])[1]"); // stepKey: selectActionActionHold
		$I->waitForPageLoad(30); // stepKey: selectActionActionHoldWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForResultsActionHold
		$I->comment("Exiting Action Group [actionHold] AdminOrderActionOnGridActionGroup");
		$I->see("No order(s) were put on hold."); // stepKey: assertOrderOnHoldFailMessage
		$I->comment("Assert order in orders grid");
		$I->comment("Entering Action Group [seeFirstOrder] AdminOrderFilterByOrderIdAndStatusActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/sales/order/"); // stepKey: navigateToOrderGridPageSeeFirstOrder
		$I->waitForPageLoad(30); // stepKey: waitForLoadingPageSeeFirstOrder
		$I->conditionalClick(".admin__data-grid-header [data-action='grid-filter-reset']", ".admin__data-grid-header [data-action='grid-filter-reset']", true); // stepKey: clearExistingOrderFiltersSeeFirstOrder
		$I->waitForPageLoad(30); // stepKey: clearExistingOrderFiltersSeeFirstOrderWaitForPageLoad
		$I->click("button[data-action='grid-filter-expand']"); // stepKey: openOrderGridFiltersSeeFirstOrder
		$I->waitForPageLoad(30); // stepKey: openOrderGridFiltersSeeFirstOrderWaitForPageLoad
		$I->fillField(".admin__data-grid-filters input[name='increment_id']", $getOrderId); // stepKey: fillOrderIdFilterSeeFirstOrder
		$I->selectOption("select[name='status']", "Complete"); // stepKey: selectOrderStatusSeeFirstOrder
		$I->waitForPageLoad(60); // stepKey: selectOrderStatusSeeFirstOrderWaitForPageLoad
		$I->click("button[data-action='grid-filter-apply']"); // stepKey: clickOrderApplyFiltersSeeFirstOrder
		$I->waitForPageLoad(30); // stepKey: clickOrderApplyFiltersSeeFirstOrderWaitForPageLoad
		$I->waitForLoadingMaskToDisappear(); // stepKey: waitForLoadingMaskSeeFirstOrder
		$I->comment("Exiting Action Group [seeFirstOrder] AdminOrderFilterByOrderIdAndStatusActionGroup");
		$I->see($getOrderId, "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[contains(., 'ID')]/preceding-sibling::th) +1 ]"); // stepKey: assertOrderID
		$I->see("Complete", "//tr[1]//td[count(//div[@data-role='grid-wrapper']//tr//th[contains(., 'Status')]/preceding-sibling::th) +1 ]"); // stepKey: assertOrderStatus
	}
}
