<?PHP
namespace DreamCommerce\ShopAppstoreBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class LocaleListener
 *
 * sets application locale based on shop admin panel language
 * @package DreamCommerce\ShopAppstoreBundle\EventListener
 */
class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    /**
     * @param string $defaultLocale
     */
    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(RequestEvent $event)
    {

        $request = $event->getRequest();
        $locale = $request->query->get('locale');
        if($locale) {
            $request->setLocale($locale);
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        ];
    }
}