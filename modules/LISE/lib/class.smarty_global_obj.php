<?php


namespace LISE;

use \LISE\instances_operations as io;

class smarty_global_obj implements \ArrayAccess
{
  private $_props;
  private $_global_instances;
  private $_initialized = FALSE;
  
  private function _initialize()
  {
    if(!$this->_initialized)
    {
      # instances and properties
      foreach(io::ListModules(\LISE::MODE_GLOBAL) as $one)
      {
        $this->_global_instances[] = $one->module_name;
        $mod = \cms_utils::get_module($one->module_name);

        $item = $mod->LoadItemByIdentifier('alias', $one->module_name);
        $fds = $item->fielddefs;

        foreach($fds as $fld)
        {
          $this->_props[$fld['alias']] = $fld['value'];
        }
      }

      $this->_initialized = TRUE;
    }
  }

  //public function __construct(){}
  
//  public function __toString()
//  {
//    $this->_initialize();
//    return (string)\json_encode($this->_props, \JSON_PRETTY_PRINT);
//  }
  
  public function __toString()
  {
    $this->_initialize();
    $ret = \json_encode($this->_props, \JSON_PRETTY_PRINT);
    $ret = $ret ? (string)$ret : '';
    return $ret;
  }
  
  public function __set($name, $value)
  {
    return '<!-- read only -->';
  }
  
  public function __get($name)
  {
    $this->_initialize();
    
    if(isset( $this->_props[$name]) ) return $this->_props[$name];
  
    return '<!-- invalid -->';
  }
  
  public function __call($name, $arguments)
  {
    $this->_initialize();
  
    if(isset( $this->_props[$name]) ) return $this->_props[$name];
  
    return '<!-- invalid -->';
  }
  
  public function get($property = '')
  {
    if( !empty($property) )
    {
      $this->_initialize();

      if(isset( $this->_props[$property]) ) return $this->_props[$property];
    }

    return '<!-- invalid -->';
  }
  
  #[\ReturnTypeWillChange]
  public function offsetSet($offset, $value)
  {
    return '<!-- invalid -->';
  }
  
  #[\ReturnTypeWillChange]
  public function offsetGet($offset)
  {
    $this->_initialize();
    return $this->_props[$offset];
  }
  
  #[\ReturnTypeWillChange]
  public function offsetExists($offset)
  {
    $this->_initialize();
    return array_key_exists($offset, $this->_props);
  }
  
  #[\ReturnTypeWillChange]
  public function offsetUnset($offset)
  {
    return '<!-- invalid -->';
  }
}

?>