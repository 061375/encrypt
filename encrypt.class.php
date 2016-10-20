<?php
/**
 *  
 *  Encrypt
 *  
 *  By Jeremy Heminger
 *  j.heminger13@gmail.com
 *  © 2016 
 *
 *
 * */

class Encrypt
{
    //
    
    //
    private $lt = false;
    //
    
    //
    function __construct() {
        
    }
    /**
     *
     *  build_lt
     *  @param boolean $again
     *  @return void
     *
     * */
    function build_lt($again = false)
    {
        // this has already run...no need to run it again
        if(false !== $this->lt AND false === $again)return true;
        
        // re-cast the variable as an array
        $this->lt = array();
        
        // the starting key
        $c = 1110;
        
        // init some empty variables
        $p = 0;
        
        $o = '';
        
        // loop through the regular ascii characters
        for($y = 33; $y<=126; $y++) {
            // 
            $c++;
            // we really are only dealing with the first two rows
            // and we want whole number values divisible by tens
            if(($c - $this->round_down($c,10)) > 3)
                $c = ($this->round_down($c,10) + 10);
            // empty the current number
            $o = '';
            // convert the number to a string
            $d = strval($c); 
            // replaces 10's as letters we will assume this is a 2 number system that replaces A,B
            // this is just a simple cypher
            // to make an "efficient" encryption we might use...like
            // 1AA to represent 11010 ... 
            for($x = 0; $x < 4; $x++) {
                // 
                $e = substr($d,$x,1);
                // 
                if($e == 2)$e = 'A';
                if($e == 3)$e = 'B';
                // 
                $o.=$e;
            }
            // add our value to the array
            $this->lt[$y] = $o;
        }
    }
    /**
     *
     *  round_down
     *  @param int $n
     *  @param int $pos
     *  @return int
     *
     * */
    function round_down($n,$pos)
    {
        return ((int) ($n/$pos)) * $pos;
    }
    /**
     *
     *  encrypt
     *  @param string $p the password to be encrypted
     *  @param string $s the salt
     *  @param boolean $c compress the ourput?
     *  @return string
     *
     * */
    function encrypt($p,$s,$c=true)
    {
        // build a cypher 
        $this->build_lt();
    
        // use basic base64 encoding with a salt
        $i = base64_encode($s.$p);
        // further encrypt using lt
        $j = '';
        for($l = 0; $l < strlen($i); $l++) {
            $j.=$this->lt[ord(substr($i,$l,1))];
        }
        // true compress the output
        if(true === $c)
        $j = gzcompress($j,9);

        return $j;
    }
    /**
     *
     *  decrypt
     *  @param string $p
     *  @param string $s
     *  @return string
     *
     * */
    function decrypt($p,$s,$c=true)
    {
        // build a cypher if neccessary
        $this->build_lt();
        
        // swap the array values for the keys 
        $tl = array();
        foreach($this->lt as $k => $v) {
            $tl[$v] = $k; 
        }

        // check if the string needs to be decompressed
        if(preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $p) > 0)
        $p = gzuncompress($p); // if neccessary decompress
        
        
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
     *  make_salt
     *  @param int $l length of the string to return
     *  @return string
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
}