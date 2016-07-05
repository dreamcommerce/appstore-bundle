<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

class ShopChecker
{

    const HTTP_READ_TIMEOUT = 3;
    const MAX_REDIRECTS = 5;

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
        $var = ($cont['options']['ssl']['peer_certificate']);

        return (!is_null($var)) ? true : false;
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
        $limit = self::MAX_REDIRECTS;

        do {
            $limit--;

            $url = $this->toHttp($url, true);
            $hasSsl = $this->verifySslUrl($url);
            if(!$hasSsl){
                $url = $this->toHttp($url);
            }

            $headers = get_headers($url, true);
            if (!$headers) {
                return false;
            }

            if(!empty($headers['Location'])){
                $url = $headers['Location'];
                continue;
            }

            break;

        }while($limit>0);

        if($limit==0){
            return false;
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

}