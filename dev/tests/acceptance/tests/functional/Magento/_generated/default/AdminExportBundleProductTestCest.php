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
 * @Title("MC-14008: Export Bundle Product")
 * @Description("Admin should be able to export Bundle Product<h3>Test files</h3>vendor\magento\module-catalog-import-export\Test\Mftf\Test\AdminExportBundleProductTest.xml<br>")
 * @TestCaseId("MC-14008")
 * @group catalog_import_export
 * @group mtf_migrated
 */
class AdminExportBundleProductTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Create bundle product with dynamic price with two simple products");
		$I->createEntity("firstSimpleProductForDynamic", "hook", "SimpleProduct2", [], []); // stepKey: firstSimpleProductForDynamic
		$I->createEntity("secondSimpleProductForDynamic", "hook", "SimpleProduct2", [], []); // stepKey: secondSimpleProductForDynamic
		$I->createEntity("createDynamicBundleProduct", "hook", "ApiBundleProduct", [], []); // stepKey: createDynamicBundleProduct
		$I->createEntity("createFirstBundleOption", "hook", "DropDownBundleOption", ["createDynamicBundleProduct"], []); // stepKey: createFirstBundleOption
		$I->createEntity("firstLinkOptionToDynamicProduct", "hook", "ApiBundleLink", ["createDynamicBundleProduct", "createFirstBundleOption", "firstSimpleProductForDynamic"], []); // stepKey: firstLinkOptionToDynamicProduct
		$I->createEntity("secondLinkOptionToDynamicProduct", "hook", "ApiBundleLink", ["createDynamicBundleProduct", "createFirstBundleOption", "secondSimpleProductForDynamic"], []); // stepKey: secondLinkOptionToDynamicProduct
		$I->comment("Create bundle product with fixed price with two simple products");
		$I->createEntity("firstSimpleProductForFixed", "hook", "SimpleProduct2", [], []); // stepKey: firstSimpleProductForFixed
		$I->createEntity("secondSimpleProductForFixed", "hook", "SimpleProduct2", [], []); // stepKey: secondSimpleProductForFixed
		$I->createEntity("createFixedBundleProduct", "hook", "ApiFixedBundleProduct", [], []); // stepKey: createFixedBundleProduct
		$I->createEntity("createSecondBundleOption", "hook", "DropDownBundleOption", ["createFixedBundleProduct"], []); // stepKey: createSecondBundleOption
		$I->createEntity("firstLinkOptionToFixedProduct", "hook", "ApiBundleLink", ["createFixedBundleProduct", "createSecondBundleOption", "firstSimpleProductForFixed"], []); // stepKey: firstLinkOptionToFixedProduct
		$I->createEntity("secondLinkOptionToFixedProduct", "hook", "ApiBundleLink", ["createFixedBundleProduct", "createSecondBundleOption", "secondSimpleProductForFixed"], []); // stepKey: secondLinkOptionToFixedProduct
		$I->comment("Create bundle product with custom textarea attribute with two simple products");
		$I->createEntity("createProductAttribute", "hook", "productAttributeWysiwyg", [], []); // stepKey: createProductAttribute
		$I->createEntity("addToDefaultAttributeSet", "hook", "AddToDefaultSet", ["createProductAttribute"], []); // stepKey: addToDefaultAttributeSet
		$I->createEntity("createFixedBundleProductWithAttribute", "hook", "ApiFixedBundleProduct", ["addToDefaultAttributeSet"], []); // stepKey: createFixedBundleProductWithAttribute
		$I->createEntity("firstSimpleProductForFixedWithAttribute", "hook", "SimpleProduct2", [], []); // stepKey: firstSimpleProductForFixedWithAttribute
		$I->createEntity("secondSimpleProductForFixedWithAttribute", "hook", "SimpleProduct2", [], []); // stepKey: secondSimpleProductForFixedWithAttribute
		$I->createEntity("createBundleOptionWithAttribute", "hook", "DropDownBundleOption", ["createFixedBundleProductWithAttribute"], []); // stepKey: createBundleOptionWithAttribute
		$I->createEntity("firstLinkOptionToFixedProductWithAttribute", "hook", "ApiBundleLink", ["createFixedBundleProductWithAttribute", "createBundleOptionWithAttribute", "firstSimpleProductForFixedWithAttribute"], []); // stepKey: firstLinkOptionToFixedProductWithAttribute
		$I->createEntity("secondLinkOptionToFixedProductWithAttribute", "hook", "ApiBundleLink", ["createFixedBundleProductWithAttribute", "createBundleOptionWithAttribute", "secondSimpleProductForFixedWithAttribute"], []); // stepKey: secondLinkOptionToFixedProductWithAttribute
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
		$I->deleteEntity("createDynamicBundleProduct", "hook"); // stepKey: deleteDynamicBundleProduct
		$I->deleteEntity("firstSimpleProductForDynamic", "hook"); // stepKey: deleteFirstSimpleProductForDynamic
		$I->deleteEntity("secondSimpleProductForDynamic", "hook"); // stepKey: deleteSecondSimpleProductForDynamic
		$I->deleteEntity("createFixedBundleProduct", "hook"); // stepKey: deleteFixedBundleProduct
		$I->deleteEntity("firstSimpleProductForFixed", "hook"); // stepKey: deleteFirstSimpleProductForFixed
		$I->deleteEntity("secondSimpleProductForFixed", "hook"); // stepKey: deleteSecondSimpleProductForFixed
		$I->deleteEntity("createFixedBundleProductWithAttribute", "hook"); // stepKey: deleteFixedBundleProductWithAttribute
		$I->deleteEntity("firstSimpleProductForFixedWithAttribute", "hook"); // stepKey: deleteFirstSimpleProductForFixedWithAttribute
		$I->deleteEntity("secondSimpleProductForFixedWithAttribute", "hook"); // stepKey: deleteSecondSimpleProductForFixedWithAttribute
		$I->deleteEntity("createProductAttribute", "hook"); // stepKey: deleteProductAttribute
		$reindexInvalidatedIndices = $I->magentoCron("index", 90); // stepKey: reindexInvalidatedIndices
		$I->comment($reindexInvalidatedIndices);
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
	public function AdminExportBundleProductTest(AcceptanceTester $I)
	{
		$I->comment("Go to export page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/export/"); // stepKey: goToExportIndexPage
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
		$I->reloadPage(); // stepKey: refreshPage
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
