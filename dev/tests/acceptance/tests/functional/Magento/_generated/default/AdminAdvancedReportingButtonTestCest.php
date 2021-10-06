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
 * @Title("MC-14800: AdvancedReportingButtonTest")
 * @Description("Test log in to AdvancedReporting and tests AdvancedReportingButtonTest<h3>Test files</h3>vendor\magento\module-analytics\Test\Mftf\Test\AdminAdvancedReportingButtonTest.xml<br>")
 * @TestCaseId("MC-14800")
 * @group analytics
 * @group mtf_migrated
 */
class AdminAdvancedReportingButtonTestCest
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
	 * @Stories({"AdvancedReporting"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Features({"Analytics"})
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminAdvancedReportingButtonTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nMC-14800");
	}
}
