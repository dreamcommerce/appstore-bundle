<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-28
 * Time: 14:03
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;

use Psr\Log\LoggerInterface;

class DebugProxy {

    /**
     * @var LoggerInterface
     */
    static private $logger;

    static public function setLogger(LoggerInterface $logger){
        self::$logger = $logger;
    }

    function stream_open($path, $mode, $options, &$opened_path)
    {
        return true;
    }

    function stream_read($count)
    {
        return true;
    }

    function stream_write($data)
    {
        self::$logger->debug($data);
        return strlen($data);
    }

    function stream_tell()
    {
        return true;
    }

    function stream_eof()
    {
        return true;
    }

    function stream_seek($offset, $whence)
    {
        return false;
    }

    function stream_metadata($path, $option, $var)
    {
        return false;
    }
}