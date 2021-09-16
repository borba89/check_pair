<?php

function checkPair($value){
    
    $flag = true;
    
    //Проверка входных данных на массив 
    if(is_array($value)){
        
        foreach ($value as  $val) {
            if($val === '('){
             
                $firstArr[] = $val;
            
            }else{
            
                $secondArr[] = $val;
            
            }

            $countFirstArr = count($firstArr);
            
            $countSecondArr = count($secondArr);
            
            //Если в данной итерации количество обратных скобок больше ставим флажок false
            if($countSecondArr > $countFirstArr){
                
                $flag = false;
            
            }
        }
        
        //Если флажок все еще равен true 
        if($flag === true){
        
            //Если количество разных скобок одинаково
            if($countFirstArr === $countSecondArr){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }       
        
    }else{
        return "This is not array";
    }  

}

?>