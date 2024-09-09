<?php

class Validation{
    function validateForm($value1, $value2){
        //validate the values
        if(!empty($value1) && !empty($value2)){
            return true;
        } else {
            return false;
        }
    }
}