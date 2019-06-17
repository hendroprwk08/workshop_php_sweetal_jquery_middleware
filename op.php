<?php
include "database.php";

$action = null;

if (!isset($_REQUEST['act'])){
   $action = null; 
}else{
   $action = $_REQUEST['act'];  
}

$d = new Database();
$d->open();

$result = array();

if ($action == null){
    $myarray[] = array(
        "pesan" => "0"
    );
    
    $result = array("result"=>$myarray);
    print json_encode($result);
}elseif($action == "1"){
    $sql = "insert into barang (nama, jenis, stok) values "
        . "('". $_REQUEST['nm']."', '". $_REQUEST['jn']."', " 
        . "'". $_REQUEST['st']."')";

    $d->execute($sql);
    
    $myarray[] = array(
        "pesan" => $_REQUEST['nm']." berhasil disimpan"
    );
    
    $result = array("hasil"=>$myarray);
    print json_encode($result);
}elseif($action == "2"){
    $sql = "update barang set nama = '". $_REQUEST['nm']."', "
        . "jenis = '". $_REQUEST['jn']."', "
        . "stok = '". $_REQUEST['st']."' "
        . "where id = '". $_REQUEST['id']."'";

    $d->execute($sql);
    
    $myarray[] = array(
        "pesan" => $_REQUEST['nm']." telah diubah"
    );
    
    $result = array("hasil"=>$myarray);
    print json_encode($result);
}elseif($action == "3"){
    $sql = "delete from barang where id = ". $_REQUEST['id'];
    $d->execute($sql);
    
    $myarray[] = array(
        "pesan" => "ID: ".$_REQUEST['id']." berhasil dihapus"
    );
    
    $result = array("hasil"=>$myarray);
    print json_encode($result);
}elseif($action == "4"){
    $sql = "select * from barang";
    $result = array("hasil"=>$d->getAll($sql));
    print json_encode($result);
}elseif($action == "5"){
    $sql = "select USERNAME, EMAIL, PHONE, ACTIVE, TYPE from pengguna where username like '%". $_REQUEST['find'] ."%'";
        $result = array("result"=>$d->getAll($sql));
    print json_encode($result);
}
?>
