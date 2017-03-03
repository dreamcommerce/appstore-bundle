<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Twig;

use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Url;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class PathExtension
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Twig
 */
class PathExtension extends \Twig_Extension{

    /**
     * Url service
     * @var Url
     */
    protected $url;

    /**
     * @param Url $url
     */
    function __construct(Url $url)
    {
        $this->url = $url;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {

        return array(
            new \Twig_SimpleFunction('app_path', array($this, 'getPath'))
        );

    }

    /**
     * @see DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Url::generateUrl
     * @param $name
     * @param array $parameters
     * @param bool|false $relative
     * @return string
     */
    public function getPath($name, $parameters = array(), $relative = false)
    {
        return $this->url->generateUrl($name, $parameters, $relative ? UrlGeneratorInterface::RELATIVE_PATH : UrlGeneratorInterface::ABSOLUTE_PATH);
    }

    /**
     * @inheritdoc
     */
    public function getName(){
        return 'path_extension';
    }


}