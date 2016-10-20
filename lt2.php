<?php
/**
 *
 *
 *
 *
 *
 *
 *
 *
 *
 * */
$lt = false;
/**
 *
 *
 * */
function build_lt()
{
    global $lt;
    if(false !== $lt)return true;
    $lt = array();
    $c = 1110;
    $p = 0;
    $o = '';
    for($y = 33; $y<=126; $y++) {
        $c++;
        if(($c - round_down($c,10)) > 3) {
            $c = (round_down($c,10) + 10);
        }
        $o = '';
        $d = strval($c);
        for($x = 0; $x < 4; $x++) {
            $e = substr($d,$x,1);
            if($e == 2)$e = 'A';
            if($e == 3)$e = 'B';
            $o.=$e;
        }
        $lt[$y] = $o;
    }
}
/**
 *
 *
 * */
function round_down($n,$pos)
{
    return ((int) ($n/$pos)) * $pos;
}
/**
 *
 *
 * */
function encrypt($p,$s)
{
    global $lt;
    // build a cypher 
    build_lt();

    // use basic base64 encoding with a salt
    $i = base64_encode($s.$p);
    // further encrypt using lt
    $j = '';
    for($l = 0; $l < strlen($i); $l++) {
         $j.=$lt[ord(substr($i,$l,1))];
    }
    print "\nencrypted uncompressed length = ".strlen($j)."\n";
    
    $j = gzcompress($j,9);
    print "\nencrypted compressed length = ".strlen($j)."\n";
    return $j;
}
/**
 *
 *
 * */
function decrypt($p,$s)
{
    global $lt;
    // build a cypher 
    build_lt();

    $tl = array();
    foreach($lt as $k => $v) {
        $tl[$v] = $k; 
    }
    
    $p = gzuncompress($p);
    $x = 0;
    $j = '';
    $k = '';
    for($l = 0; $l < strlen($p); $l++) {
        $k.=substr($p,$l,1);
        $x++;
        if($x == 4) {
            $j.=chr($tl[$k]);
            $k = '';
            $x = 0;
            
        }
    }
    // use basic base64 encoding with a salt
    $j = base64_decode($j);
    $j = str_replace($s,'',$j);
    return $j;
}
/**
 *
 *
 * */
function make_salt($l = 16)
{
    $return = '';
    for($i=0;$i<$l;$i++){
	$return.=chr(floor(mt_rand(33,122)));
    }
    return $return;
}

if (false === isset($argv[1]) OR '' == $argv[1]) die("\nplease enter a password to encrypt \n");
$p = $argv[1];
print "\n____________________________________________________\n\n";
print "\n\npassword =  ".$p."\n";
$s = make_salt();
print "\nsalt = ".$s."\n\n";
$e = encrypt($p,$s);
print "\nencrypted =  ".$e."\n\n";
$f = decrypt($e,$s);
print "\n\npassword decrypted =  ".$f."\n";
print "\n____________________________________________________\n\n";