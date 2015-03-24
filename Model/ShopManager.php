<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

abstract class ShopManager implements ShopManagerInterface
{
    public function findShopByName($name)
    {
        $result = $this->findByCriteria(array(
            'name'=>$name
        ));

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    public function findShopByNameAndApplication($name, $application){
        $result = $this->findByCriteria(array(
            'name'=>$name,
            'app'=>$application
        ));

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }
}
