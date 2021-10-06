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
 * @Title("MC-10895: Admin should be able to create a Date product attribute")
 * @Description("Admin should be able to create a Date product attribute<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\CreateProductAttributeEntityTest\CreateProductAttributeEntityDateTest.xml<br>")
 * @TestCaseId("MC-10895")
 * @group Catalog
 * @group mtf_migrated
 */
class CreateProductAttributeEntityDateTestCest
{
	/**
	 * @Features({"Catalog"})
	 * @Stories({"Create Product Attributes"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function CreateProductAttributeEntityDateTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-13817");
	}
}
