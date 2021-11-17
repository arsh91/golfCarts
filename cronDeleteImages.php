<?php

include 'db_connection.php';

$picsData= $db->query('SELECT Datesubmitted, DLpiclink, Inspiclink, CCfrontpiclink, CCbackpiclink FROM golfcartusers  WHERE Datesubmitted  <= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)')->fetchAll();

 //echo "<pre>";  print_r($picsData); echo "</pre>";die();

 $path="/home/equisngs/equisourceholdings.com/golfcarts/";
foreach($picsData as $picData){

    if($picData['DLpiclink'] != ""){
        unlink($path.$picData['DLpiclink']);
    }
    if($picData['Inspiclink'] != ""){
        unlink($path.$picData['Inspiclink']);
    }
    if($picData['CCfrontpiclink'] != ""){
        unlink($path.$picData['CCfrontpiclink']);
    }
    if($picData['CCbackpiclink'] != ""){
        unlink($path.$picData['CCbackpiclink']);
    }
    

//    echo "<pre>"; print_r($picData); echo "</pre>"; 
}





?>