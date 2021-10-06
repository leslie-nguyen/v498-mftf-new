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
 * @group Cms
 * @Title("MC-6114: Admin should able to switch between versions of TinyMCE")
 * @Description("Admin should able to switch between versions of TinyMCE<h3 class='y-label y-label_status_broken'>Deprecated Notice(s):</h3><ul><li>TinyMCE3 is no longer supported</li></ul><h3>Test files</h3>vendor\magento\module-tinymce-3\Test\Mftf\Test\AdminSwitchWYSIWYGOptionsTest.xml<br>")
 * @TestCaseId("MC-6114")
 */
class AdminSwitchWYSIWYGOptionsTestCest
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
	 * @Features({"Tinymce3"})
	 * @Stories({"MAGETWO-51829-Extensible list of WYSIWYG editors available in Magento"})
	 * @Severity(level = SeverityLevel::CRITICAL)
	 * @Parameter(name = "AcceptanceTester", value="$I")
	 * @param AcceptanceTester $I
	 * @return void
	 * @throws \Exception
	 */
	public function AdminSwitchWYSIWYGOptionsTest(AcceptanceTester $I, \Codeception\Scenario $scenario)
	{
		$scenario->skip("This test is skipped due to the following issues:\nTinyMCE3 is no longer supported");
	}
}
