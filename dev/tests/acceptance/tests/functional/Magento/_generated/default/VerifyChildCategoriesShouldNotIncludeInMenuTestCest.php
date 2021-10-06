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
 * @Title("MAGETWO-72238: Customer should not see categories that are not included in the menu")
 * @Description("Customer should not see categories that are not included in the menu<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\VerifyChildCategoriesShouldNotIncludeInMenuTest.xml<br>")
 * @TestCaseId("MAGETWO-72238")
 * @group category
 */
class VerifyChildCategoriesShouldNotIncludeInMenuTestCest
{
	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->comment("Entering Action Group [navigateToCategoryPage2] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageNavigateToCategoryPage2
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadNavigateToCategoryPage2
		$I->comment("Exiting Action Group [navigateToCategoryPage2] AdminOpenCategoryPageActionGroup");
		$I->click("//a/span[contains(text(), 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]"); // stepKey: clickOnCreatedSimpleSubCategoryBeforeDelete
		$I->waitForPageLoad(30); // stepKey: clickOnCreatedSimpleSubCategoryBeforeDeleteWaitForPageLoad
		$I->comment("Entering Action Group [deleteCategory] DeleteCategoryActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: goToCategoryPageDeleteCategory
		$I->waitForPageLoad(60); // stepKey: waitForCategoryPageLoadDeleteCategory
		$I->click("//a/span[contains(text(), 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]"); // stepKey: clickCategoryLinkDeleteCategory
		$I->waitForPageLoad(30); // stepKey: clickCategoryLinkDeleteCategoryWaitForPageLoad
		$I->click(".page-actions-inner #delete"); // stepKey: clickDeleteDeleteCategory
		$I->waitForPageLoad(30); // stepKey: clickDeleteDeleteCategoryWaitForPageLoad
		$I->waitForElementVisible("aside.confirm div.modal-content", 30); // stepKey: waitForConfirmationModalDeleteCategory
		$I->see("Are you sure you want to delete this category?", "aside.confirm div.modal-content"); // stepKey: seeDeleteConfirmationMessageDeleteCategory
		$I->click("aside.confirm .modal-footer .action-primary"); // stepKey: confirmDeleteDeleteCategory
		$I->waitForPageLoad(60); // stepKey: waitForDeleteToFinishDeleteCategory
		$I->see("You deleted the category."); // stepKey: seeDeleteSuccessDeleteCategory
		$I->click(".tree-actions a:last-child"); // stepKey: expandToSeeAllCategoriesDeleteCategory
		$I->dontSee("//a/span[contains(text(), 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]"); // stepKey: dontSeeCategoryInTreeDeleteCategory
		$I->waitForPageLoad(30); // stepKey: dontSeeCategoryInTreeDeleteCategoryWaitForPageLoad
		$I->comment("Exiting Action Group [deleteCategory] DeleteCategoryActionGroup");
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
	 * @Features({"Catalog"})
	 * @Stories({"Create categories"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function VerifyChildCategoriesShouldNotIncludeInMenuTest(AcceptanceTester $I)
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
		$I->comment("Entering Action Group [navigateToCategoryPage1] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageNavigateToCategoryPage1
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadNavigateToCategoryPage1
		$I->comment("Exiting Action Group [navigateToCategoryPage1] AdminOpenCategoryPageActionGroup");
		$I->scrollToTopOfPage(); // stepKey: scrollToTopOfPage
		$I->comment("Create new category under Default Category");
		$I->comment("Entering Action Group [createSubcategory1] CreateCategoryActionGroup");
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: seeOnCategoryPageCreateSubcategory1
		$I->click("#add_subcategory_button"); // stepKey: clickOnAddSubCategoryCreateSubcategory1
		$I->waitForPageLoad(30); // stepKey: clickOnAddSubCategoryCreateSubcategory1WaitForPageLoad
		$I->see("New Category", ".page-header h1.page-title"); // stepKey: seeCategoryPageTitleCreateSubcategory1
		$I->fillField("input[name='name']", "SimpleSubCategory" . msq("SimpleSubCategory")); // stepKey: enterCategoryNameCreateSubcategory1
		$I->click("div[data-index='search_engine_optimization'] .fieldset-wrapper-title"); // stepKey: openSEOCreateSubcategory1
		$I->waitForPageLoad(30); // stepKey: openSEOCreateSubcategory1WaitForPageLoad
		$I->fillField("input[name='url_key']", "simplesubcategory" . msq("SimpleSubCategory")); // stepKey: enterURLKeyCreateSubcategory1
		$I->click(".page-actions-inner #save"); // stepKey: saveCategoryCreateSubcategory1
		$I->waitForPageLoad(30); // stepKey: saveCategoryCreateSubcategory1WaitForPageLoad
		$I->seeElement(".message-success"); // stepKey: assertSuccessCreateSubcategory1
		$I->seeInTitle("SimpleSubCategory" . msq("SimpleSubCategory")); // stepKey: seeNewCategoryPageTitleCreateSubcategory1
		$I->seeElement("//a/span[contains(text(), 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]"); // stepKey: seeCategoryInTreeCreateSubcategory1
		$I->waitForPageLoad(30); // stepKey: seeCategoryInTreeCreateSubcategory1WaitForPageLoad
		$I->comment("Exiting Action Group [createSubcategory1] CreateCategoryActionGroup");
		$I->comment("Create another subcategory under created category");
		$I->comment("Entering Action Group [createSubcategory2] CreateCategoryActionGroup");
		$I->seeInCurrentUrl((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: seeOnCategoryPageCreateSubcategory2
		$I->click("#add_subcategory_button"); // stepKey: clickOnAddSubCategoryCreateSubcategory2
		$I->waitForPageLoad(30); // stepKey: clickOnAddSubCategoryCreateSubcategory2WaitForPageLoad
		$I->see("New Category", ".page-header h1.page-title"); // stepKey: seeCategoryPageTitleCreateSubcategory2
		$I->fillField("input[name='name']", "subCategory" . msq("SubCategoryWithParent")); // stepKey: enterCategoryNameCreateSubcategory2
		$I->click("div[data-index='search_engine_optimization'] .fieldset-wrapper-title"); // stepKey: openSEOCreateSubcategory2
		$I->waitForPageLoad(30); // stepKey: openSEOCreateSubcategory2WaitForPageLoad
		$I->fillField("input[name='url_key']", "subCategory" . msq("SubCategoryWithParent")); // stepKey: enterURLKeyCreateSubcategory2
		$I->click(".page-actions-inner #save"); // stepKey: saveCategoryCreateSubcategory2
		$I->waitForPageLoad(30); // stepKey: saveCategoryCreateSubcategory2WaitForPageLoad
		$I->seeElement(".message-success"); // stepKey: assertSuccessCreateSubcategory2
		$I->seeInTitle("subCategory" . msq("SubCategoryWithParent")); // stepKey: seeNewCategoryPageTitleCreateSubcategory2
		$I->seeElement("//a/span[contains(text(), 'subCategory" . msq("SubCategoryWithParent") . "')]"); // stepKey: seeCategoryInTreeCreateSubcategory2
		$I->waitForPageLoad(30); // stepKey: seeCategoryInTreeCreateSubcategory2WaitForPageLoad
		$I->comment("Exiting Action Group [createSubcategory2] CreateCategoryActionGroup");
		$I->comment("Go to storefront and verify visibility of categories");
		$I->comment("Entering Action Group [goToStorefrontPage] StorefrontOpenHomePageActionGroup");
		$I->amOnPage("/"); // stepKey: goToStorefrontPageGoToStorefrontPage
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadGoToStorefrontPage
		$I->comment("Exiting Action Group [goToStorefrontPage] StorefrontOpenHomePageActionGroup");
		$I->seeElement("//nav//a[span[contains(., 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]]"); // stepKey: seeSimpleSubCategoryOnStorefront1
		$I->waitForPageLoad(30); // stepKey: seeSimpleSubCategoryOnStorefront1WaitForPageLoad
		$I->dontSeeElement("//nav//a[span[contains(., 'subCategory" . msq("SubCategoryWithParent") . "')]]"); // stepKey: dontSeeSubCategoryWithParentOnStorefront1
		$I->waitForPageLoad(30); // stepKey: dontSeeSubCategoryWithParentOnStorefront1WaitForPageLoad
		$I->comment("Set Include in menu to No on created category under Default Category");
		$I->comment("Entering Action Group [navigateToCategoryPage2] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageNavigateToCategoryPage2
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadNavigateToCategoryPage2
		$I->comment("Exiting Action Group [navigateToCategoryPage2] AdminOpenCategoryPageActionGroup");
		$I->click("//a/span[contains(text(), 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]"); // stepKey: clickOnCreatedSimpleSubCategory1
		$I->waitForPageLoad(30); // stepKey: clickOnCreatedSimpleSubCategory1WaitForPageLoad
		$I->click("input[name='include_in_menu']+label"); // stepKey: setNoToIncludeInMenuSelect
		$I->click(".page-actions-inner #save"); // stepKey: clickSaveButton1
		$I->waitForPageLoad(30); // stepKey: clickSaveButton1WaitForPageLoad
		$I->seeCheckboxIsChecked("input[name='is_active']"); // stepKey: seeCheckboxEnableCategoryIsChecked
		$I->dontSeeCheckboxIsChecked("input[name='include_in_menu']"); // stepKey: dontSeeCheckboxIncludeInMenuIsChecked
		$I->comment("Go to storefront and verify visibility of categories");
		$I->comment("Entering Action Group [goToStorefrontPage2] StorefrontOpenHomePageActionGroup");
		$I->amOnPage("/"); // stepKey: goToStorefrontPageGoToStorefrontPage2
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadGoToStorefrontPage2
		$I->comment("Exiting Action Group [goToStorefrontPage2] StorefrontOpenHomePageActionGroup");
		$I->dontSeeElement("//nav//a[span[contains(., 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]]"); // stepKey: dontSeeSimpleSubCategoryOnStorefront1
		$I->waitForPageLoad(30); // stepKey: dontSeeSimpleSubCategoryOnStorefront1WaitForPageLoad
		$I->dontSeeElement("//nav//a[span[contains(., 'subCategory" . msq("SubCategoryWithParent") . "')]]"); // stepKey: dontSeeSubCategoryWithParentOnStorefront2
		$I->waitForPageLoad(30); // stepKey: dontSeeSubCategoryWithParentOnStorefront2WaitForPageLoad
		$I->comment("Set Enable category to No and Include in menu to Yes on created category under Default Category");
		$I->comment("Entering Action Group [navigateToCategoryPage3] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageNavigateToCategoryPage3
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadNavigateToCategoryPage3
		$I->comment("Exiting Action Group [navigateToCategoryPage3] AdminOpenCategoryPageActionGroup");
		$I->click("//a/span[contains(text(), 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]"); // stepKey: clickOnCreatedSimpleSubCategory2
		$I->waitForPageLoad(30); // stepKey: clickOnCreatedSimpleSubCategory2WaitForPageLoad
		$I->click("input[name='is_active']+label"); // stepKey: SetNoToEnableCategorySelect
		$I->click("input[name='include_in_menu']+label"); // stepKey: SetYesToIncludeInMenuSelect
		$I->click(".page-actions-inner #save"); // stepKey: clickSaveButton2
		$I->waitForPageLoad(30); // stepKey: clickSaveButton2WaitForPageLoad
		$I->dontSeeCheckboxIsChecked("input[name='is_active']"); // stepKey: dontSeeCheckboxEnableCategoryIsChecked
		$I->seeCheckboxIsChecked("input[name='include_in_menu']"); // stepKey: seeCheckboxIncludeInMenuIsChecked
		$I->comment("Go to storefront and verify visibility of categories");
		$I->comment("Entering Action Group [goToStorefrontPage3] StorefrontOpenHomePageActionGroup");
		$I->amOnPage("/"); // stepKey: goToStorefrontPageGoToStorefrontPage3
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadGoToStorefrontPage3
		$I->comment("Exiting Action Group [goToStorefrontPage3] StorefrontOpenHomePageActionGroup");
		$I->dontSeeElement("//nav//a[span[contains(., 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]]"); // stepKey: dontSeeSimpleSubCategoryOnStorefront2
		$I->waitForPageLoad(30); // stepKey: dontSeeSimpleSubCategoryOnStorefront2WaitForPageLoad
		$I->dontSeeElement("//nav//a[span[contains(., 'subCategory" . msq("SubCategoryWithParent") . "')]]"); // stepKey: dontSeeSubCategoryWithParentOnStorefront3
		$I->waitForPageLoad(30); // stepKey: dontSeeSubCategoryWithParentOnStorefront3WaitForPageLoad
		$I->comment("Set Enable category to No and Include in menu to No on created category under Default Category");
		$I->comment("Entering Action Group [navigateToCategoryPage4] AdminOpenCategoryPageActionGroup");
		$I->amOnPage((getenv("MAGENTO_BACKEND_BASE_URL") ? rtrim(getenv("MAGENTO_BACKEND_BASE_URL"), "/") : "") . "/" . getenv("MAGENTO_BACKEND_NAME") . "/catalog/category/"); // stepKey: openAdminCategoryIndexPageNavigateToCategoryPage4
		$I->waitForPageLoad(30); // stepKey: waitForCategoryPageToLoadNavigateToCategoryPage4
		$I->comment("Exiting Action Group [navigateToCategoryPage4] AdminOpenCategoryPageActionGroup");
		$I->click("//a/span[contains(text(), 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]"); // stepKey: clickOnCreatedSimpleSubCategory3
		$I->waitForPageLoad(30); // stepKey: clickOnCreatedSimpleSubCategory3WaitForPageLoad
		$I->click("input[name='include_in_menu']+label"); // stepKey: setNoToIncludeInMenuSelect2
		$I->click(".page-actions-inner #save"); // stepKey: clickSaveButton3
		$I->waitForPageLoad(30); // stepKey: clickSaveButton3WaitForPageLoad
		$I->dontSeeCheckboxIsChecked("input[name='is_active']"); // stepKey: dontSeeCheckboxEnableCategoryIsChecked2
		$I->dontSeeCheckboxIsChecked("input[name='include_in_menu']"); // stepKey: dontSeeCheckboxIncludeInMenuIsChecked2
		$I->comment("Go to storefront and verify visibility of categories");
		$I->comment("Entering Action Group [goToStorefrontPage4] StorefrontOpenHomePageActionGroup");
		$I->amOnPage("/"); // stepKey: goToStorefrontPageGoToStorefrontPage4
		$I->waitForPageLoad(30); // stepKey: waitForStorefrontPageLoadGoToStorefrontPage4
		$I->comment("Exiting Action Group [goToStorefrontPage4] StorefrontOpenHomePageActionGroup");
		$I->dontSeeElement("//nav//a[span[contains(., 'SimpleSubCategory" . msq("SimpleSubCategory") . "')]]"); // stepKey: dontSeeSimpleSubCategoryOnStorefront3
		$I->waitForPageLoad(30); // stepKey: dontSeeSimpleSubCategoryOnStorefront3WaitForPageLoad
		$I->dontSeeElement("//nav//a[span[contains(., 'subCategory" . msq("SubCategoryWithParent") . "')]]"); // stepKey: dontSeeSubCategoryWithParentOnStorefront4
		$I->waitForPageLoad(30); // stepKey: dontSeeSubCategoryWithParentOnStorefront4WaitForPageLoad
	}
}
