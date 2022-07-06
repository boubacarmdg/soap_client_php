<?php
require_once "clientSOAP.php";
$params = new stdClass();
$params->nom = strtoupper($_POST['nom']);
$params->prenom = $_POST['prenom'];
$res = $clientSOAP->__soapCall("addEtudiant", array($params));
print $res->return;
