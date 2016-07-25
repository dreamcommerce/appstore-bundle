<?php


namespace DreamCommerce\ShopAppstoreBundle\Tests\EventListener;

use DreamCommerce\ShopAppstoreBundle\EventListener\ApplicationControllerListener;
use PHPUnit_Framework_MockObject_MockObject;
use ReflectionMethod;
use Symfony\Component\HttpKernel\Exception\HttpException;


class ApplicationControllerListenerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $router;
    /**
     * @var []
     */
    protected $applications;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $applicationRegistry;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $shopManager;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $tokenRefresher;
    /**
     * @var []
     */
    protected $routes;
    /**
     * @var ApplicationControllerListener
     */
    protected $listener;

    public function setUp()
    {
        $this->router = $this->getMockBuilder('Symfony\Component\Routing\RouterInterface')->disableOriginalConstructor()->getMock();
        $this->applications = ['app' => ['appId' => 'id', 'appSecret' => 'secret', 'appstoreSecret' => 'secret', 'minimalVersion' => 1]];
        $this->applicationRegistry = $this->getMockBuilder('DreamCommerce\ShopAppstoreBundle\Handler\ApplicationRegistry')->disableOriginalConstructor()->getMock();
        $this->shopManager = $this->getMockBuilder('DreamCommerce\ShopAppstoreBundle\Model\ObjectManagerInterface')->disableOriginalConstructor()->getMock();
        $this->tokenRefresher = $this->getMockBuilder('DreamCommerce\ShopAppstoreBundle\Utils\TokenRefresher')->disableOriginalConstructor()->getMock();
        $this->routes = [
            'route'=>'value'
        ];

        $this->listener = new ApplicationControllerListener($this->applications, $this->routes, $this->applicationRegistry, $this->shopManager, $this->tokenRefresher, $this->router);
    }

    public function testRedirect()
    {

        $this->router->method('generate')->willReturnArgument(0);
        $event = $this->getMockBuilder('Symfony\Component\HttpKernel\Event\FilterControllerEvent')->disableOriginalConstructor()->getMock();

        $method = new ReflectionMethod(
            'DreamCommerce\ShopAppstoreBundle\EventListener\ApplicationControllerListener', 'redirect'
        );
        $method->setAccessible(TRUE);

        try {
            $method->invokeArgs($this->listener, [$event, 'route']);
            $this->fail();
        }catch(HttpException $ex){
            $this->assertEquals('value', $ex->getHeaders()['Location']);
        }


    }

}
