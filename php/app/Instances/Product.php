<?php
namespace App\Instances;

class Product
{
    public static function FromData( $data ) : Product {
        $ret = new Product();
        $ret->_id = ''.$data->id;
        $ret->_creator_id = ''.$data->creator;
        $ret->_name = $data->prod_name;
        $ret->_status = $data->status;
        return $ret;
    }

    public function getId() : string {
        return $this->_id;
    }

    public function getCreatorId() : string {
        return $this->_creator_id;
    }

    public function getProductName() : string {
        return $this->_name;
    }

    protected string $_id;
    protected string $_name = '';
    protected string $_creator_id = '';
    protected int $_status = 0;
}

