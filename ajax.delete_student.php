<?php
require_once "clientSOAP.php";
$param = new stdClass();
$param->id = $_POST['id'];
$res = $clientSOAP->__soapCall("deleteEtudiant", array($param));
print $res->return;
