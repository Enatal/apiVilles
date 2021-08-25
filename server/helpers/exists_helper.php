<?php
    if(!function_exists('exists')){
        // check if a variable exists and its value is NULL
        function exists($array,$keys){
            $check=0;
            foreach ($array as $element) {
                for($i=0;$i<count($keys);$i++){
                    if(isset($element[$keys[$i]])){
/*                         if(empty($element[$keys[$i]])){
                            $check++;
                            $check--;
                        } */
                        $check++;
                    }
                }
                
            }
            var_dump($check);
            if($check == count($array)){
                return true;
            }else{
                return false;
            }
        }
    }
?>