<?php
    if(!function_exists('exists')){
        // check if a variable exists and its value is NULL
        function exists($array,$keys){
            $check=0;
            for($i=0;$i<count($keys);$i++){
                if(array_key_exists($keys[$i],$array)){
                        $check++;
                }
            }
            if($check == count($array)){
                return true;
            }else{
                return false;
            }
        }
    }
?>