<?php


namespace LISE;

class smarty_local_obj implements \ArrayAccess
{
  private array $_instances = [];
  private array $_local_instances = [];
  private array $_props = [];
  
  private function _get_instance()
  {
    $instance_name = \cms_utils::get_app_data('lise_instance');
    
    if( empty($instance_name) ) return;
    
    if( !isset($this->_instances[$instance_name]) )
    {
      $this->_instances[$instance_name] = \cms_utils::get_module($instance_name);
    }
    
    return $this->_instances[$instance_name];
  }
  
  private function _get_local_instance_name()
  {
    $instance = $this->_get_instance();
    
    if( !\is_object($instance) ) return '';
    
    return $instance->GetPreference('local_mode_instance');
  }
  
  private function _get_local_instance()
  {
    $instance_name = $this->_get_instance();
    
    if( empty($instance_name) ) return;
    
    $local_name = $this->_get_local_instance_name();
    
    if( !isset($this->_local_instances[$local_name]) )
    {
      $this->_local_instances[$local_name] = \cms_utils::get_module($local_name);
    }
    
    return $this->_local_instances[$local_name];
  }
  
  private function _get_prop($property = '')
  {
    if( empty($property) ) return '<!-- invalid -->';
  
    $instance_name = \cms_utils::get_app_data('lise_instance');
    
    if( empty($instance_name) ) return '<!-- invalid: called outside instance scope -->';
    
    if( !isset($this->_props[$instance_name][$property] ) )
    {
      $mod = $this->_get_local_instance();
      $item = $mod->LoadItemByIdentifier('alias', $instance_name);
  
      foreach($item->fielddefs as $one)
      {
        $this->_props[$instance_name][$one['alias']] = $one['value'];
      }
      
      # still doesn't exist?
      if( !isset($this->_props[$instance_name][$property] ) ) return '<!-- invalid -->';
    }
    
    return $this->_props[$instance_name][$property];
  }
  
  public function __toString()
  {
    //$this->_initialize();
    $ret = json_encode($this->_props, JSON_PRETTY_PRINT);
    $ret = $ret ? (string)$ret : '';
    return $ret;
  }
  
  public function __set($name, $value)
  {
    return '<!-- read only -->';
  }
  
  public function __get($name)
  {
    return $this->_get_prop($name);
  }
  
  public function __call($name, $arguments)
  {
    return $this->_get_prop($name);
  }
  
  
  function get($name = '')
  {
    return $this->_get_prop($name);
  }
  
  #[\ReturnTypeWillChange]
  public function offsetSet($offset, $value)
  {
    return '<!-- invalid -->';
  }
  
  #[\ReturnTypeWillChange]
  public function offsetGet($offset)
  {
    return $this->_get_prop($offset);
  }
  
  #[\ReturnTypeWillChange]
  public function offsetExists($offset):bool
  {
    # initialize
    $this->_get_prop($offset);
    
    return array_key_exists($offset, $this->_props);
  }
  
  #[\ReturnTypeWillChange]
  public function offsetUnset($offset)
  {
    return '<!-- invalid -->';
  }
  
}

?>