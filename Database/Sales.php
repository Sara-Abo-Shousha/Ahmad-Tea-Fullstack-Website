<?php
class Sales{
    public $db=null;

public function __construct(DBcontrol $db)
{
    if(!isset($db->con))return null;
    $this->db=$db;
}
    
        public function insertIntoSales($parms=null, $table="sales"){

            if($this->db->con!=null){
                if($parms!=null){
                    $columns=implode(',',array_keys($parms)); //get table columns
                    
                    $values=implode(',',array_values($parms));

                    $query_string=sprintf("INSERT INTO %s(%s) VALUES(%s)",$table,$columns,$values);
                    
                    $res=$this->db->con->query($query_string);
                    return $res;
                }
            }
        }
        public function addToSales($uid, $item_id){
            if(isset($uid)&&isset($item_id)){

                $parms=array(
                    "uid"=>$uid,
                    "item_id"=>$item_id
                );
                //insert data into cart
               $res=$this->insertIntoSales($parms);
               if($res){
                   //relode page
                   header("Location ".$_SERVER['PHP_SELF']);
               }
            }

        }
}
?>