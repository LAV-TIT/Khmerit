<?php


namespace LISE;


class Collection extends Morphable
{
  /**
   * params
   * in a key => value format
   * @var array
   */
  protected array $_items = [];
  
  
  #---------------------
  # Private methods
  #---------------------
  
  /**
   * @return array
   */
  private function _to_array() : array
  {
    $r = [];
    
    foreach($this->_items as $one)
    {
      $key = preg_replace('/^_/', '', $one);
      $r[$key] = $this->$one;
    }
    
    return $r;
  }
  
  /**
   * @param $array
   */
  private function _from_array($array) : void
  {
    foreach($this->_get_props() as $one)
    {
      $key = preg_replace('/^_/', '', $one);
      $method = 'set' . $key;
      $this->$method($array[$key]);
    }
  }
  
  /**
   * @return array
   */
  private function _get_props() : array
  {
    return array_keys( $this->_items );
  }
  
  #---------------------
  # Magic methods
  #---------------------
  
  /**
   * Collection constructor.
   *
   * @param array|\Elements\Data|NULL $data
   */
  public function __construct($array = [])
  {
    parent::__construct();
    
    if( isset($array) )
    {
      $this->_from_array($array);
    }
  }
  
  /**
   * @param $name
   *
   * @return mixed
   */
  public function __get($name)
  {
    return $this->_items[$name] ?? NULL;
  }
  
  /**
   * @param $name
   * @param $value
   *
   * @return $this
   */
  public function __set($name, $value)
  {
    $this->_items[$name] = $value;
    
    return $this;
  }
  
  /**
   * @return string
   */
  public function __toString()
  {
    return implode(',', $this->_items);
  }
  
  
  
  public function FromArray($array = [])
  {
    $this->_from_array($array);
  }
  
  /**
   * @return array
   */
  public function AsArray()
  {
    return $this->_to_array();
  }
  
  /**
   * @return object
   */
  public function AsStdClass()
  {
    return (object)$this->_to_array();
  }
}

?>