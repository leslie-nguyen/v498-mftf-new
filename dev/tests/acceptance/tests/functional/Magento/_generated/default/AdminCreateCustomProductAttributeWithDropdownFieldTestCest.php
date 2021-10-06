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
 * @Title("MC-10905: Create Custom Product Attribute Dropdown Field (Not Required) from Product Page")
 * @Description("login as admin and create configurable product attribute with Dropdown field<h3>Test files</h3>vendor\magento\module-catalog\Test\Mftf\Test\AdminCreateCustomProductAttributeWithDropdownFieldTest.xml<br>")
 * @TestCaseId("MC-10905")
 * @group mtf_migrated
 */
class AdminCreateCustomProductAttributeWithDropdownFieldTestCest
{
	/**
	 * @Stories({"Create product Attribute"})
	 * @Severity(level = SeverityLevel::BLOCKER)
	 * @Features({"Catalog"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminCreateCustomProductAttributeWithDropdownFieldTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-15474");
	}
}
