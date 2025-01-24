<?php


namespace LISE;


final class FileSys
{
  public static function create_dir($dir, $m = 0777, $r= TRUE) { mkdir($dir, $m, $r); }
  
  public static function read_file($file)
  {
    if( ($h = fopen($file, 'r') ) == FALSE ) { return FALSE; }
    if( ( $contents = fread( $h, filesize($file) ) ) == FALSE ) { return FALSE; }
    fclose($h);
    
    return $contents;
  }
  
  public static function write($file, $contents, $flag = 'w+')
  {
    if( ( $h = fopen($file, $flag) ) == FALSE){ return FALSE; }
    if(fwrite($h, $contents) == FALSE){ return FALSE; }
    
    return TRUE;
  }
  
  public static function recursive_search($dir, $patt = NULL, $depth = -1, $flags = \RecursiveIteratorIterator::SELF_FIRST)
  {
    $di = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
    $i  = new \RecursiveIteratorIterator($di, $flags);
    $i->setMaxDepth($depth);
    
    if(is_null($patt)){ return $i; }
    else{ return new \RegexIterator($i, $patt); }
  }
  
  public static function search($dir, $pattern = NULL){ return self::recursive_search($dir, $pattern, 0); }
  
  public static function recursive_delete($dir, $pattern = NULL, $depth = -1)
  {
    foreach(self::recursive_search($dir, $pattern, $depth, \RecursiveIteratorIterator::CHILD_FIRST) as $file)
    {
      if( $file->isFile() ) { unlink($file); }
      else if( $file->isDir() ) { @rmdir($file); }
    }
    
    if( is_dir($dir) ) { @rmdir($dir); }
  }
  
  public static function delete($item, $pattern = NULL)
  {
    if( is_file($item) ) { unlink($item); }
    else { self::recursive_delete($item, $pattern, 0); }
  }
}

?>