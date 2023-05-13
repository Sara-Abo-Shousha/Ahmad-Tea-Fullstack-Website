
<?php

    class Cart{

        public $db=null;

        public function __construct(DBcontrol $db)
        {
            if(!isset($db->con))return null;
            $this->db=$db;
        }
        
        //insert to cart items
        public function insertIntoCart($parms=null, $table="cart "){

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

        //to get user id and item id
        public function addToCart($uid, $item_id){
            if(isset($uid)&&isset($item_id)){

                $parms=array(
                    "uid"=>$uid,
                    "item_id"=>$item_id
                );
                //insert data into cart
               $res=$this->insertIntoCart($parms);
               if($res){
                   //relode page
                   header("Location ".$_SERVER['PHP_SELF']);
               }
            }

        }
         // delete cart item using cart item id
            public function deleteCart($item_id = null, $table = 'cart'){
                if($item_id != null){
                    $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
                    if($result){
                        header("Location:" . $_SERVER['PHP_SELF']);
                    }
                    return $result;
        }
    }
                // calculate sub total
            public function getSum($arr){
                    if(isset($arr)){
                        $sum = 0;
                        foreach ($arr as $item){
                            
                               $sum += floatval($item[0]);
                        }
                        return sprintf('%.2f' , $sum);
                    }

                }
    // get item_it of shopping cart list
            public function getCartId($cartArray = null, $key = "item_id"){
                if ($cartArray != null){
                    $cart_id = array_map(function ($value) use($key){
                        return $value[$key];
                    }, $cartArray);
                    return $cart_id;
                }
            }
    }

?>