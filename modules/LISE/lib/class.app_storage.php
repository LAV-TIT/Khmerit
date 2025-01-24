<?php


namespace LISE;


/**
 * Class app_storage
 *
 * @package LISE
 */
final class app_storage
{
  /**
   * @var \LISE\app_storage|null
   */
  private static ?app_storage $_instance = NULL;
  /**
   * @var array
   */
  protected array             $_data = [];
  
  /**
   * app_storage constructor.
   */
  private function __construct(){}
  
  /**
   * @return \LISE\app_storage
   */
  public static function getInstance()
  {
    if(self::$_instance === NULL)
    {
      self::$_instance = new app_storage();
    }
    
    return self::$_instance;
  }
  
  /**
   * @return array
   */
  public function __debugInfo()
  {
    return $this->_data;
  }
  
  /**
   * @param $name
   * @param $value
   */
  public function __set($name, $value)
  {
    $this->_data[$name] = $value;
  }
  
  /**
   * @param $name
   *
   * @return bool
   */
  public function __isset($name)
  {
    return isset($this->_data[$name]);
  }
  
  /**
   * @param $name
   *
   * @return mixed|null
   */
  public function __get($name)
  {
    return $this->_data[$name] ?? NULL;
  }
  
  /**
   * @return array
   */
  public function getData() : array
  {
    return $this->_data;
  }
  
  /**
   * @param array $data
   *
   * @return app_storage
   */
  public function setData(array $data) : app_storage
  {
    $this->_data = $data;
    
    return $this;
  }
}

?>