<?php

function logAction($conn,$account_id,$lastname,$firstname,$account_type,$action){

    $logAction = mysqli_query($conn,"INSERT INTO logs(account_id,last_name,first_name,account_type,action,timestamp) VALUES($account_id,'$lastname','$firstname','$account_type','$action',NOW())");

}

?>