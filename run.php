<?php
/**
 * 
 *  Test Run
 *
 *
 * */
if (php_sapi_name() !== 'cli')die(); // no message

if (false === isset($argv[1]) OR '' == $argv[1])
    die("\nplease enter a password to encrypt \n");
    
require 'encrypt.class.php';

$enc = new Encrypt();

$p = $argv[1];

print "\n____________________________________________________\n\n";


print "\n\npassword =  ".$p."\n";


$s = $enc->make_salt();


print "\nsalt = ".$s."\n\n";


$e = $enc->encrypt($p,$s);


print $e."\n\n";


$f = $enc->decrypt($e,$s);


print "\n\npassword decrypted =  ".$f."\n";


print "\n____________________________________________________\n\n";


?>