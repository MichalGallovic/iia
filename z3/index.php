<?php

$password = "FEIrulez42";
$username = 'uid=xgallovicm, ou=People, DC=stuba, DC=sk';
$ldapconn = ldap_connect("ldap.stuba.sk") or die("Could not connect to LDAP server.");

if($ldapconn) {
//    $ldapbind = ldap_bind($ldapconn, $username, $password);
    var_dump(ldap_bind($ldapconn, $username, $password));
//    if($ldapbind) {
//        $result=ldap_search($ldapconn, "ou=People, DC=stuba, DC=sk","uid="."xgallovicm");
////        $entries = ldap_get_entries($ldapconn, $result);
////        var_dump($entries);
////        $givenname = $entries[0]['cn'];
//    }
}

?>