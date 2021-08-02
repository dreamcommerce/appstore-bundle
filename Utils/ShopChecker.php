<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

class ShopChecker
{

    const HTTP_READ_TIMEOUT = 3;

    /**
     * verifies if URL has SSL valid
     * @param string $url
     * @see http://stackoverflow.com/a/27706327/2324004
     * @return bool
     */
    public function verifySslUrl($url)
    {
        $stream = stream_context_create([
            'ssl' => [
                'capture_peer_cert' => true,
            ],
            'http'=>[
                'timeout'=>self::HTTP_READ_TIMEOUT
            ]
        ]);

        $read = @fopen($url, 'rb', false, $stream);

        if(!$read){
            return false;
        }

        $cont = stream_context_get_params($read);
        $var = !empty($cont['options']['ssl']['peer_certificate']);

        return $var;
    }

    /**
     * check if specified shop supports valid SSL
     * @param ShopInterface $shop
     * @return bool
     */
    public function verifySsl(ShopInterface $shop)
    {
        $url = $shop->getShopUrl();
        return $this->verifySslUrl($url.'/basket');
    }

    /**
     * jump over redirects and return target URL
     * @param string $url
     * @return bool
     */
    public function getRealShopUrl($url)
    {
        $headers = get_headers($url, true);
        $target = $url;
        if(!empty($headers['Location'])){
            $location = (array)$headers['Location'];
            $target = end($location);
        }

        $url = $this->toHttp($target, true);
        if($url!=$target) {
            $sslHeaders = @get_headers($url, true);
        }else{
            $sslHeaders = $headers;
        }

        $hasSsl = $this->verifySslUrl($url);
        // someone may disable SSL manually (although shop has a valid chain) - prevent redirect loop
        if(!$hasSsl || !empty($sslHeaders['Location'])){
            $url = $this->toHttp($url);
        }

        return $url;
    }

    /**
     * make HTTPS URL HTTP
     * @param string $url
     * @param bool $ssl convert to https
     * @return string
     */
    protected function toHttp($url, $ssl = false){
        $proto = substr($url, 0, 5);
        if($proto=='https'){
            if(!$ssl) {
                $url = 'http'.substr($url, 5);
            }
        }else{
            if($ssl){
                $url = 'https'.substr($url, 4);
            }
        }

        return $url;
    }

    /**
     * returns an URL without protocol
     * @param string $url
     * @return string
     */
    protected function getUrlWithoutProtocol($url){
        $url = substr($url, -1)=='/' ? substr($url, 0, -1) : $url;
        $urlComponents = explode('://', $url, 2);
        return $urlComponents[1];
    }

}