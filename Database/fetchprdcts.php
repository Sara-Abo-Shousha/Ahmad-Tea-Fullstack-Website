<?php
class fetchprdcts{

    public $db=null;

    public function __construct(DBcontrol $db)
    {
        if(!isset($db->con))return null;
        $this->db=$db;
    }

    //method to get products data
    public function getdata($table="products"){

             $res = $this->db->con->query("SELECT * FROM {$table}");
            $resarr=array();

            //fetch products data one by one
            while($item=mysqli_fetch_array($res,MYSQLI_ASSOC)){
                
                $resarr[]=$item;
            }

         return $resarr;
    }
    public function getProduct($item_id = null, $table= "products"){
        if (isset($item_id)){

           $res = $this->db->con->query("SELECT * FROM {$table} WHERE Product_ID={$item_id}");

            $resarr=array();

            //fetch products data one by one
            while($item_id=mysqli_fetch_array($res, MYSQLI_ASSOC)){
                
                $resarr[]=$item_id;
            }

         return $resarr;
        }
    }
}