<?php


namespace LISE;


class RandomString
{
  # flags
  const MIXED  = 0; # 0000
  const LOWER  = 1; # 0001
  const UPPER  = 2; # 0010
  const DIGITS = 4; # 0100
  # no support for foreign language characters nor special chars yet
  
  private static $_lower = 'abcdefghijklmnopqrstuvwxyz';
  private static $_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  private static $_digits = '0123456789';
  
  static function get($length = 10, $flags = RandomString::MIXED)
  {
    $string = '';
    
    if($flags & self::DIGITS)
    {
      $string .= self::$_digits;
    }
    
    if($flags & self::LOWER)
    {
      $string .= self::$_lower;
    }
    
    if($flags & self::UPPER)
    {
      $string .= self::$_upper;
    }
  
    if($flags === self::MIXED)
    {
      $string = SELF::$_digits . SELF::$_lower . SELF::$_upper;
    }
    
    $out = '';
  
    for ($i = 0; $i < $length; $i++)
    {
      $index = rand(0, strlen($string) - 1);
      $out .= $string[$index];
    }
    
    return $out;
  }
  
}

?>