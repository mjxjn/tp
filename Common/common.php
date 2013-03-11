<?php

function Mdate(){
     return date('Y-m-d H:i:s');
}

function GetAdmin(){
    return $_SESSION[C('USER_AUTH_KEY')];
}

function GetOid(){
    return time().rand(10,99);
}
