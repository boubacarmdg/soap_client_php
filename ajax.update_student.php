<?php
require_once "clientSOAP.php";
$params = new stdClass();
$params->id = $_POST['id'];
$params->nom = strtoupper($_POST['nom']);
$params->prenom = $_POST['prenom'];
$res = $clientSOAP->__soapCall("updateEtudiant", array($params));
print $res->return;
