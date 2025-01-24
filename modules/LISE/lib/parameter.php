<?php
/**
 * test... may be removed at some point
 */

namespace LISE;


class parameter
{
  private int $_type;
  private $_value;
  
  
  /**
   * private methods
   */
  private function _get_value()
  {
    $tmp = $this->_value;
    
    if($this->_type !== parameters::TYPE_UNDEFINED)
    {
      if($this->_type & parameters::TYPE_BOOL)
      {
        $tmp = (bool)$this->_value;
      }
    }
    
    return $tmp;
  }
  
  /**
   * public methods
   *
   * @param null $value
   * @param int  $type
   */
  
  public function __construct($value = NULL, $type = parameters::TYPE_UNDEFINED)
  {
    $this->_value = $value;
    $this->_type = $type;
  }

  public function __serialize() : array
  {
    return [
      'type'  => $this->_type,
      'value' => $this->_value
    ];
  }
  
  public function __unserialize(array $data) : void
  {
    $this->_value = $data['value'];
    $this->_type  = $data['type'];
  }
  
  public function __toString()
  {
    return (string)$this->_value;
  }
  
  public function __invoke()
  {
    return ;
  }
  
  
  public function __debugInfo()
  {
    return [
      'type'  => $this->_type,
      'value' => $this->_value
    ];
  }
  
  
  public function __set($name, $value)
  {
    switch ($name)
    {
      case 'type':
            $this->_type = $value;
          break;
          
      case 'value':
            $this->_value = $value;
          break;

      default:
        throw new \RuntimeException('Invalid access of parameter property ' . $name);
    }
  }
  
  public function __get($name)
  {
    switch($name)
    {
      case 'type':
        return $this->_type;
      break;
    
      case 'value':
        return $this->_value;
      break;
    
      default:
        throw new \RuntimeException('Invalid access of parameter property ' . $name);
    }
  }
  
  public function __isset($name)
  {
    switch($name)
    {
      case 'type':
        return isset($this->_type);
      break;
    
      case 'value':
        return isset($this->_value);
      break;
    
      default:
        throw new \RuntimeException('Invalid access of parameter property ' . $name);
    }
  }
  
  public function __unset($name)
  {
    switch($name)
    {
      case 'type':
        unset($this->_type);
      break;
    
      case 'value':
        unset($this->_value);
      break;
    
      default:
        throw new \RuntimeException('Invalid access of parameter property ' . $name);
    }
  }
  
}

?>