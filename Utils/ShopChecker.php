<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

class ShopChecker
{

    const HTTP_READ_TIMEOUT = 3;
    const MAX_REDIRECTS = 5;

    /**
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
     * check if specified shop supports full SSL
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

            $headers = get_headers($url);
            if (!$headers) {
                return false;
            }

            $hasLocation = false;

            foreach($headers as $h){
                $row = explode(': ', $h, 2);
                if($row[0]=='Location'){
                    $url = trim($row[1]);
                    $hasLocation = true;
                    break;
                }
            }

        }while($limit>0 && $hasLocation);

        if($limit==0){
            return false;
        }

        return $url;

    }

}