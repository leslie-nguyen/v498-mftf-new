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
 * @Title("MAGETWO-89910: Admin should be able to create a product with zero price")
 * @Description("Admin should be able to create a product with zero price<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminCreateSimpleProductTest\AdminCreateSimpleProductZeroPriceTest.xml<br>")
 * @TestCaseId("MAGETWO-89910")
 * @group product
 */
class AdminCreateSimpleProductZeroPriceTestCest
{
	/**
	 * @Features({"Catalog"})
	 * @Stories({"Create a Simple Product via Admin"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateSimpleProductZeroPriceTest(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin"); // stepKey: navigateToAdminLoginAsAdmin
		$I->fillField("#username", getenv("MAGENTO_ADMIN_USERNAME")); // stepKey: fillUsernameLoginAsAdmin
		$I->fillField("#login", getenv("MAGENTO_ADMIN_PASSWORD")); // stepKey: fillPasswordLoginAsAdmin
		$I->click(".actions .action-primary"); // stepKey: clickLoginLoginAsAdmin
		$I->waitForPageLoad(30); // stepKey: clickLoginLoginAsAdminWaitForPageLoad
		$I->conditionalClick(".modal-popup .action-secondary", ".modal-popup .action-secondary", true); // stepKey: clickDontAllowButtonIfVisibleLoginAsAdmin
		$I->closeAdminNotification(); // stepKey: closeAdminNotificationLoginAsAdmin
		$I->comment("Exiting Action Group [loginAsAdmin] AdminLoginActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/product/new/set/4/type/simple/"); // stepKey: goToCreateProduct
		$I->waitForPageLoad(30); // stepKey: wait1
		$I->fillField(".admin__field[data-index=name] input", "SimpleProduct" . msq("SimpleProduct")); // stepKey: fillName
		$I->fillField(".admin__field[data-index=price] input", "0"); // stepKey: fillPrice
		$I->comment("Entering Action Group [clickSave] AdminProductFormSaveActionGroup");
		$I->click("#save-button"); // stepKey: saveProductClickSave
		$I->waitForPageLoad(30); // stepKey: saveProductClickSaveWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitForProductSavingClickSave
		$I->comment("Exiting Action Group [clickSave] AdminProductFormSaveActionGroup");
		$I->amOnPage("/SimpleProduct" . msq("SimpleProduct") . ".html"); // stepKey: viewProduct
		$I->waitForPageLoad(30); // stepKey: wait2
		$I->see("$0.00", "div.price-box.price-final_price"); // stepKey: seeZeroPrice
	}
}
