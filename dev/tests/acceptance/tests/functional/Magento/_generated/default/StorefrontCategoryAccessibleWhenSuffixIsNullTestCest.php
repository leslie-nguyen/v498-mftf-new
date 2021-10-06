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
 * @Title("[NO TESTCASEID]: Storefront category is accessible when url suffix is set to null test")
 * @Description("Check no crash occurs on Category page when catalog/seo/category_url_suffix is set to null<h3>Test files</h3>vendor\magento\module-catalog-url-rewrite\Test\Mftf\Test\StorefrontCategoryAccessibleWhenSuffixIsNullTest.xml<br>")
 * @group CatalogUrlRewrite
 */
class StorefrontCategoryAccessibleWhenSuffixIsNullTestCest
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
		$setCategoryUrlSuffix = $I->magentoCLI("config:set catalog/seo/category_url_suffix ''", 60); // stepKey: setCategoryUrlSuffix
		$I->comment($setCategoryUrlSuffix);
		$setCategoryProductRewrites = $I->magentoCLI("config:set catalog/seo/generate_category_product_rewrites 0", 60); // stepKey: setCategoryProductRewrites
		$I->comment($setCategoryProductRewrites);
		$I->comment("Entering Action Group [flushCacheBefore] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCacheBefore = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCacheBefore
		$I->comment($flushSpecifiedCacheFlushCacheBefore);
		$I->comment("Exiting Action Group [flushCacheBefore] CliCacheFlushActionGroup");
		$I->createEntity("createCategory", "hook", "_defaultCategory", [], []); // stepKey: createCategory
	}

	/**
	  * @param AcceptanceTester $I
	  * @throws \Exception
	  */
	public function _after(AcceptanceTester $I)
	{
		$I->deleteEntity("createCategory", "hook"); // stepKey: deleteCategory
		$restoreCategoryUrlSuffix = $I->magentoCLI("config:set catalog/seo/category_url_suffix '.html'", 60); // stepKey: restoreCategoryUrlSuffix
		$I->comment($restoreCategoryUrlSuffix);
		$restoreCategoryProductRewrites = $I->magentoCLI("config:set catalog/seo/generate_category_product_rewrites 1", 60); // stepKey: restoreCategoryProductRewrites
		$I->comment($restoreCategoryProductRewrites);
		$I->comment("Entering Action Group [flushCacheAfter] CliCacheFlushActionGroup");
		$flushSpecifiedCacheFlushCacheAfter = $I->magentoCLI("cache:flush", 60, ""); // stepKey: flushSpecifiedCacheFlushCacheAfter
		$I->comment($flushSpecifiedCacheFlushCacheAfter);
		$I->comment("Exiting Action Group [flushCacheAfter] CliCacheFlushActionGroup");
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
	 * @Stories({"Url rewrites", "Url rewrites"})
	 * @Features({"CatalogUrlRewrite"})
	 * @Severity(level = SeverityLevel::NORMAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function StorefrontCategoryAccessibleWhenSuffixIsNullTest(AcceptanceTester $I)
	{
		$I->amOnPage("/" . $I->retrieveEntityField('createCategory', 'name', 'test')); // stepKey: onCategoryPage
		$I->waitForPageLoad(30); // stepKey: waitForPageLoad
		$I->seeInTitle($I->retrieveEntityField('createCategory', 'name', 'test')); // stepKey: assertCategoryNameInTitle
	}
}
