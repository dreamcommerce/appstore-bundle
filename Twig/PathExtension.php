<?php
namespace DreamCommerce\ShopAppstoreBundle\Twig;

use DreamCommerce\ShopAppstoreBundle\Utils\Url;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class PathExtension
 * @package DreamCommerce\ShopAppstoreBundle\Twig
 */
class PathExtension extends AbstractExtension{

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
            new TwigFunction('app_path', array($this, 'getPath'))
        );

    }

    /**
     * @see \DreamCommerce\ShopAppstoreBundle\Utils\Url::generateUrl
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