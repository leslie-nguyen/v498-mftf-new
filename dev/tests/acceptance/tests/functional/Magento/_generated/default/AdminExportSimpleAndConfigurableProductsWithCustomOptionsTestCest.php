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
 * @Title("MC-14005: Export Simple and Configurable products with custom options")
 * @Description("Admin should be able to export Simple and Configurable products with custom options<h3>Test files</h3>vendor\magento\module-catalog-import-export\Test\Mftf\Test\AdminExportSimpleAndConfigurableProductsWithCustomOptionsTest.xml<br>")
 * @TestCaseId("MC-14005")
 * @group catalog_import_export
 * @group mtf_migrated
 */
class AdminExportSimpleAndConfigurableProductsWithCustomOptionsTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _before(AcceptanceTester $I)
	{
		$I->comment("Create category");
		$I->createEntity("createCategory", "hook", "SimpleSubCategory", [], []); // stepKey: createCategory
		$I->comment("Create configurable product with two attributes");
		$I->createEntity("createConfigProduct", "hook", "ApiConfigurableProduct", ["createCategory"], []); // stepKey: createConfigProduct
		$I->createEntity("createConfigProductAttribute", "hook", "productAttributeWithTwoOptions", [], []); // stepKey: createConfigProductAttribute
		$I->createEntity("createConfigProductAttributeFirstOption", "hook", "productAttributeOption1", ["createConfigProductAttribute"], []); // stepKey: createConfigProductAttributeFirstOption
		$I->createEntity("createConfigProductAttributeSecondOption", "hook", "productAttributeOption2", ["createConfigProductAttribute"], []); // stepKey: createConfigProductAttributeSecondOption
		$I->createEntity("createConfigAddToAttributeSet", "hook", "AddToDefaultSet", ["createConfigProductAttribute"], []); // stepKey: createConfigAddToAttributeSet
		$I->getEntity("getConfigAttributeFirstOption", "hook", "ProductAttributeOptionGetter", ["createConfigProductAttribute"], null, 1); // stepKey: getConfigAttributeFirstOption
		$I->getEntity("getConfigAttributeSecondOption", "hook", "ProductAttributeOptionGetter", ["createConfigProductAttribute"], null, 2); // stepKey: getConfigAttributeSecondOption
		$I->comment("Add custom options to configurable product");
		$I->updateEntity("createConfigProduct", "hook", "productWithOptions",[]); // stepKey: updateProductWithOptions
		$I->comment("Create two simple product which will be the part of configurable product");
		$I->createEntity("createConfigFirstChildProduct", "hook", "ApiSimpleOne", ["createConfigProductAttribute", "getConfigAttributeFirstOption"], []); // stepKey: createConfigFirstChildProduct
		$I->createEntity("createConfigSecondChildProduct", "hook", "ApiSimpleTwo", ["createConfigProductAttribute", "getConfigAttributeSecondOption"], []); // stepKey: createConfigSecondChildProduct
		$I->createEntity("createConfigProductOption", "hook", "ConfigurableProductTwoOptions", ["createConfigProduct", "createConfigProductAttribute", "getConfigAttributeFirstOption", "getConfigAttributeSecondOption"], []); // stepKey: createConfigProductOption
		$I->comment("Add created below children products to configurable product");
		$I->createEntity("createConfigProductAddFirstChild", "hook", "ConfigurableProductAddChild", ["createConfigProduct", "createConfigFirstChildProduct"], []); // stepKey: createConfigProductAddFirstChild
		$I->createEntity("createConfigProductAddSecondChild", "hook", "ConfigurableProductAddChild", ["createConfigProduct", "createConfigSecondChildProduct"], []); // stepKey: createConfigProductAddSecondChild
		$runCronIndex = $I->magentoCron("index", 90); // stepKey: runCronIndex
		$I->comment($runCronIndex);
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
		$I->comment("Delete configurable product creation");
		$I->deleteEntity("createConfigProduct", "hook"); // stepKey: deleteConfigProduct
		$I->deleteEntity("createConfigFirstChildProduct", "hook"); // stepKey: deleteConfigFirstChildProduct
		$I->deleteEntity("createConfigSecondChildProduct", "hook"); // stepKey: deleteConfigSecondChildProduct
		$I->deleteEntity("createConfigProductAttribute", "hook"); // stepKey: deleteConfigProductAttribute
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
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
	public function AdminExportSimpleAndConfigurableProductsWithCustomOptionsTest(AcceptanceTester $I)
	{
		$I->comment("Go to export page");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/admin/export/"); // stepKey: goToExportIndexPage
		$I->waitForPageLoad(30); // stepKey: waitForExportIndexPageLoad
		$I->comment("Fill entity attributes data");
		$I->comment("Entering Action Group [exportProductBySku] ExportProductsFilterByAttributeActionGroup");
		$I->selectOption("#entity", "Products"); // stepKey: selectProductsOptionExportProductBySku
		$I->waitForElementVisible("#export_filter_form", 30); // stepKey: waitForElementVisibleExportProductBySku
		$I->scrollTo("//*[@name='export_filter[sku]']/ancestor::tr//input[@type='checkbox']"); // stepKey: scrollToAttributeExportProductBySku
		$I->checkOption("//*[@name='export_filter[sku]']/ancestor::tr//input[@type='checkbox']"); // stepKey: selectAttributeExportProductBySku
		$I->fillField("//*[@name='export_filter[sku]']/ancestor::tr//input[@type='text']", $I->retrieveEntityField('createConfigProduct', 'sku', 'test')); // stepKey: setDataInFieldExportProductBySku
		$I->waitForPageLoad(30); // stepKey: waitForUserInputExportProductBySku
		$I->scrollTo("//*[@id='export_filter_container']/button"); // stepKey: scrollToContinueExportProductBySku
		$I->waitForPageLoad(30); // stepKey: scrollToContinueExportProductBySkuWaitForPageLoad
		$I->click("//*[@id='export_filter_container']/button"); // stepKey: clickContinueButtonExportProductBySku
		$I->waitForPageLoad(30); // stepKey: clickContinueButtonExportProductBySkuWaitForPageLoad
		$I->see("Message is added to queue, wait to get your file soon", "#messages div.message-success"); // stepKey: seeSuccessMessageExportProductBySku
		$I->comment("Exiting Action Group [exportProductBySku] ExportProductsFilterByAttributeActionGroup");
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
