<?php

function validation($value){
    if(isset($_POST[$value]) && !empty($_POST[$value])){
        if($value === "fname" || $value === "lname"){
            $filter = htmlspecialchars($_POST[$value]);
            $filter = trim($_POST[$value]);
            $filter = preg_replace('/\s+/', '', $_POST[$value]);
        }
        if($value === "email"){
            $filter = filter_var($_POST[$value],  FILTER_VALIDATE_EMAIL); 
        }
        return $filter;
        
    }else{
        return false;
    }
}