<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-30
 * Time: 14:49
 */

namespace DreamCommerce\ShopAppstoreBundle\Twig;

use DreamCommerce\ShopAppstoreBundle\Utils\Url;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PathExtension extends \Twig_Extension{

    protected $url;

    function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function getFunctions()
    {

        return array(
            new \Twig_SimpleFunction('app_path', array($this, 'getPath'))
        );

    }

    public function getPath($name, $parameters = array(), $relative = false)
    {
        return $this->url->generateUrl($name, $parameters, $relative ? UrlGeneratorInterface::RELATIVE_PATH : UrlGeneratorInterface::ABSOLUTE_PATH);
    }

    public function getName(){
        return 'path_extension';
    }


}