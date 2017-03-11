<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;


use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator\Types\RequestValidatorInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\ShopAppstoreLib\Handler;
use Symfony\Component\HttpFoundation\Request;

abstract class RequestValidatorAbstract implements RequestValidatorInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Applications
     *
     * @var array
     */
    protected $apps;

    /**
     * TODO: Application
     * @var array
     */
    protected $application;

    /**
     * @param Request $req
     */
    public function __construct(Request $req, array $apps)
    {
        $this->request  = $req;
        $this->apps     = $apps;

        $this->init();
    }

    /**
     * Return request object
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param string $name
     * @throws InvalidRequestException
     */
    protected function setApplication(string $name)
    {
        if (isset($this->apps[$name])) {
            $this->application = $this->apps[$name];
            $this->application['name'] = $name;
        } else {
            throw new InvalidRequestException(sprintf('Application NAME#%s not configured', $name));
        }
    }

    /**
     * Bootstrap function using to execute additional constructor code
     */
    protected function init()
    {

    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getApplication(): array
    {
        if (empty($this->application)) {
            throw new InvalidRequestException('Your validator must set application');
        }
        return $this->application;
    }

    /**
     * @return Handler
     * @throws InvalidRequestException
     */
    protected function getHandler()
    {
        if (empty($this->application)) {
            throw new InvalidRequestException('Application is empty');
        }

        return new Handler(
            $this->getRequest()->request->get('shop_url', 'https://example.org'),
            $this->application['app_id'],
            $this->application['app_secret'],
            $this->application['appstore_secret']
        );
    }


    protected function getApplicationNameFromRequest(): string
    {
        $code = $this->request->query->get('application');
        if (empty($code)) {
            $code = $this->request->request->get('application_code');
        }

        if (empty($code)) {
            throw new InvalidRequestException('Cannot find application_code field');
        }

        foreach($this->apps as $key=>$data) {
            $found = null;

            if ($code == $data['app_id']) {
                return $key;
            }
        }

        throw new InvalidRequestException(sprintf('Application ID#%s not configured', $code));
    }

    public function getApplicationNameFromShopModel(ShopInterface $shop): string
    {
        return $shop->getApp();
    }
}