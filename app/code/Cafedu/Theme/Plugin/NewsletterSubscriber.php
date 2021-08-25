<?php
namespace Cafedu\Theme\Plugin;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\RequestInterface;
use Cafedu\Theme\Model\Subscriber;

class NewsletterSubscriber
{
    const OMETRIA_LINK = 'https://api.ometria.com/forms/signup';

    /**
     * @var Curl
     */
    protected $curl;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * NewsletterSubscriber constructor.
     * @param Curl $curl
     * @param RequestInterface $request
     */
    public function __construct(
        Curl $curl,
        RequestInterface $request
    ) {
        $this->curl = $curl;
        $this->request = $request;
    }

    /**
     * @param Subscriber $subject
     * @param $proceed
     * @param $email
     * @param $country
     * @param $gender
     * @return int
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundSubscribe(
        Subscriber $subject,
        $proceed,
        $email,
        $country = null,
        $gender = null
    ) {
        $result = $proceed($email, $country, $gender);
        $ometriaAccount = $this->request->getParam('ometria_account', null);
        $ometriaForm = $this->request->getParam('ometria_form', null);
        if ($ometriaAccount && $ometriaForm) {
            $this->curl->post(self::OMETRIA_LINK, [
                "__form_id" => $ometriaForm,
                "@account" => $ometriaAccount,
                "@subscription_status" => 'SUBSCRIBED',
                "ue" => $email,
                "country_id" => $country,
                "gender" => $gender,
            ]);
        }
        return $result;
    }
}
