<?php
ob_start();
session_start();
$current__file = $_SERVER['SCRIPT_NAME'];

if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){

    $http_referer = $_SERVER['HTTP_REFERER'];
}
    function loggedin(){
        if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])){
            return true;
        }else{
            return false;
        }
    }

    function getuserfield($field){
        require 'dbh.php';
        $query = "SELECT `$field` FROM `user` WHERE `id`='".$_SESSION['userId']."'";
        if($query_run = mysqli_query($conn, $query)){
            while($query_rows = mysqli_fetch_assoc($query_run)){
                if($fields = $query_rows[$field]){
                    return $fields;
                }else{
                    echo 'No field founds.';
                }
            }
        }
    }

?>
