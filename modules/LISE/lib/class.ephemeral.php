<?php
/**
 * ephemeral functions
 * methods on this class can't be relied to exist
 * from one release to another
 */

namespace LISE;


final class ephemeral
{
  static function remove_md()
  {
    $lise = \cms_utils::get_module('LISE');
    $root = $lise->GetModulePath();
    $fn = \cms_join_path($root , '.moduledata');
    
    if( \is_dir($fn) ) { FileSys::delete($fn); }
  }
}

?>