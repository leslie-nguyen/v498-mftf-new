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
 * @Title("MC-14007: Export Simple Product with custom attribute")
 * @Description("Admin should be able to export Simple Product with custom attribute<h3>Test files</h3>vendor\magento\module-catalog-import-export\Test\Mftf\Test\AdminExportSimpleProductWithCustomAttributeTest.xml<br>")
 * @TestCaseId("MC-14007")
 * @group catalog_import_export
 * @group mtf_migrated
 */
class AdminExportSimpleProductWithCustomAttributeTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Create simple product with custom attribute set");
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
		$I->createEntity("createAttributeSet", "hook", "CatalogAttributeSet", [], []); // stepKey: createAttributeSet
		$I->createEntity("createSimpleProductWithCustomAttributeSet", "hook", "SimpleProductWithCustomAttributeSet", ["createCategory", "createAttributeSet"], []); // stepKey: createSimpleProductWithCustomAttributeSet
		$cronRun = $I->magentoCLI("cron:run", 60, "--group index"); // stepKey: cronRun
		$I->comment($cronRun);
		$cronRunToStartReindex = $I->magentoCLI("cron:run", 60, "--group index"); // stepKey: cronRunToStartReindex
		$I->comment($cronRunToStartReindex);
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
		$I->comment("Delete product creations");
		$I->deleteEntity("createSimpleProductWithCustomAttributeSet", "hook"); // stepKey: deleteSimpleProductWithCustomAttributeSet
		$I->deleteEntity("createAttributeSet", "hook"); // stepKey: deleteAttributeSet
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$reindexInvalidatedIndices = $I->magentoCron("index", 90); // stepKey: reindexInvalidatedIndices
		$I->comment($reindexInvalidatedIndices);
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
	 * @Features({"CatalogImportExport"})
	 * @Stories({"Export products"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminExportSimpleProductWithCustomAttributeTest(AcceptanceTester $I)
	{
		$I->comment("Go to export page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/export/"); // stepKey: goToExportIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForExportIndexPageLoad
		$I->comment("Export created below products");
		$I->comment("Entering Action Group [exportCreatedProducts] ExportAllProductsActionGroup");
		$I->selectOption("#entity", "Products"); // stepKey: selectProductsOptionExportCreatedProducts
		$I->waitForElementVisible("#export_filter_form", 5); // stepKey: waitForElementVisibleExportCreatedProducts
		$I->scrollTo("//*[@id='export_filter_container']/button"); // stepKey: scrollToContinueExportCreatedProducts
		$I->waitForPageLoad(30); // stepKey: scrollToContinueExportCreatedProductsWaitForPageLoad
		$I->wait(5); // stepKey: waitForScrollExportCreatedProducts
		$I->click("//*[@id='export_filter_container']/button"); // stepKey: clickContinueButtonExportCreatedProducts
		$I->waitForPageLoad(30); // stepKey: clickContinueButtonExportCreatedProductsWaitForPageLoad
		$I->wait(5); // stepKey: waitForClickExportCreatedProducts
		$I->see("Message is added to queue, wait to get your file soon. Make sure your cron job is running to export the file", "#messages div.message-success"); // stepKey: seeSuccessMessageExportCreatedProducts
		$I->comment("Exiting Action Group [exportCreatedProducts] ExportAllProductsActionGroup");
		$I->comment("Start message queue for export consumer");
		$I->comment("Entering Action Group [startMessageQueue] CliConsumerStartActionGroup");
		$startMessageQueueStartMessageQueue = $I->magentoCLI("queue:consumers:start exportProcessor --max-messages=100", 60); // stepKey: startMessageQueueStartMessageQueue
		$I->comment($startMessageQueueStartMessageQueue);
		$I->comment("Exiting Action Group [startMessageQueue] CliConsumerStartActionGroup");
		$I->reloadPage(); // stepKey: pageReload
		$I->waitForElementVisible("[data-role='grid'] tr[data-repeat-index='0'] div.data-grid-cell-content", 30); // stepKey: waitForFileName
		$grabNameFile = $I->grabTextFrom("[data-role='grid'] tr[data-repeat-index='0'] div.data-grid-cell-content"); // stepKey: grabNameFile
		$I->comment("Download product");
		$I->comment("Entering Action Group [downloadCreatedProducts] DownloadFileActionGroup");
		$I->reloadPage(); // stepKey: refreshPageDownloadCreatedProducts
		$I->waitForPageLoad(30); // stepKey: waitFormReloadDownloadCreatedProducts
		$I->click("//div[@class='data-grid-cell-content'][text()='{$grabNameFile}']/../..//button[@class='action-select']"); // stepKey: clickSelectBtnDownloadCreatedProducts
		$I->click("//div[@class='data-grid-cell-content'][text()='{$grabNameFile}']/../..//a[text()='Download']"); // stepKey: clickOnDownloadDownloadCreatedProducts
		$I->waitForPageLoad(30); // stepKey: clickOnDownloadDownloadCreatedProductsWaitForPageLoad
		$I->comment("Exiting Action Group [downloadCreatedProducts] DownloadFileActionGroup");
		$I->comment("Delete exported file");
		$I->comment("Entering Action Group [deleteExportedFile] DeleteExportedFileActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/export/"); // stepKey: goToExportIndexPageDeleteExportedFile
		$I->waitForPageLoad(30); // stepKey: waitFormReloadDeleteExportedFile
		$I->click("//div[@class='data-grid-cell-content'][text()='{$grabNameFile}']/../..//button[@class='action-select']"); // stepKey: clickSelectBtnDeleteExportedFile
		$I->click("//div[@class='data-grid-cell-content'][text()='{$grabNameFile}']/../..//a[text()='Delete']"); // stepKey: clickOnDeleteDeleteExportedFile
		$I->waitForPageLoad(30); // stepKey: clickOnDeleteDeleteExportedFileWaitForPageLoad
		$I->waitForElementVisible(".modal-popup.confirm h1.modal-title", 30); // stepKey: waitForConfirmModalDeleteExportedFile
		$I->click(".modal-popup.confirm button.action-accept"); // stepKey: confirmDeleteDeleteExportedFile
		$I->waitForPageLoad(60); // stepKey: confirmDeleteDeleteExportedFileWaitForPageLoad
		$I->waitForPageLoad(30); // stepKey: waitFormReload2DeleteExportedFile
		$I->dontSeeElement("//div[@class='data-grid-cell-content'][text()='{$grabNameFile}']"); // stepKey: assertDontSeeFileDeleteExportedFile
		$I->comment("Exiting Action Group [deleteExportedFile] DeleteExportedFileActionGroup");
	}
}
