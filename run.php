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

system('clear');

print "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";

print "Begin Encryption Algorithm\n\n\n____________________________________________________\n\n";


print "\n\npassword =  ".$p."\n\n";


// this just demonstrates what the encryption looks like uncompressed
$demo = $enc->encrypt($p,false,false);

print "This is the encrypted data uncompressed:\n".$demo."\n\n";

// this returned value will have a different salt and will therefore does not actually represent
// the same result displayed above...its simply a demonstration
$e = $enc->encrypt($p,false);

print "\nThis is the ecrypted data after compression:\n\n";
print $e."\n\n";

$f = $enc->decrypt($e,$s);


print "\n\npassword decrypted =  ".$f."\n";


print "\n____________________________________________________\n\n\n\n\n";


?>