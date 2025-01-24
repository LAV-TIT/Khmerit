<?php


namespace LISE;



final class parameters
{
  const TYPE_UNDEFINED  = 00000;
  const TYPE_BOOL       = 00001;
  const TYPE_INT        = 00010;
  const TYPE_FLOAT      = 00100;
  const TYPE_STRING     = 01000;
  const TYPE_ARRAY      = 10000;
  
  private static $_as_fncs = [
    'bool',
    'int',
    'float',
    'string',
    'array',
  ];
  
  private static array $_collections = [];
  
  
  private static function _default($value = NULL, $default = NULL)
  {
    return empty($value) ? $default : $value;
  }
  
  public static function Set($id, $key = NULL, $value = NULL, $default = NULL, $type = self::TYPE_UNDEFINED) : void
  {
    if( empty($id) ) return;
    if( empty($key) ) return;
    if( empty($value) ) return;
    
    if( !isset(self::$_collections[$id]) )
    self::$_collections[$id] = new Collection();
    
  }
  
  public static function as_bool($params = [], $key = NULL, $default = NULL)
  {
    return (boolean) (isset($params[$key]) ? self::_default($params[$key], $default) : $default);
  }
  
  public static function as_int($params = [], $key = NULL, $default = NULL)
  {
    return (int) (isset($params[$key]) ? self::_default($params[$key], $default) : $default);
  }
  
  public static function as_float($params = [], $key = NULL, $default = NULL)
  {
    return (float) (isset($params[$key]) ? self::_default($params[$key], $default) : $default);
  }
  
  public static function as_string($params = [], $key = NULL, $default = NULL)
  {
    return (string) (isset($params[$key]) ? self::_default($params[$key], $default) : $default);
  }
  
  public static function as_array($params = [], $key = NULL, $default = NULL)
  {
    $ret = (isset($params[$key]) ? self::_default($params[$key], $default) : $default);
    if( !is_array($ret) ) { $ret = [$ret]; }
    
    return $ret;
  }
  
  
  public static function from_blueprint($params = [], $blueprint = []) : array
  {
    if( empty($params) ) { return []; }
    if( empty($blueprint) ) { return $params; }
    
    $ret = [];
    
    foreach( $blueprint as $name => $props)
    {
      if(\in_array($props['type'], self::$_as_fncs, TRUE))
      {
        $fnc_name = '\\LISE\\parameters::as_' . $props['type'];
        $ret[$name] = $fnc_name($params, $name, $props['default']);
      }
    }
    
    return $ret;
  }
}
?>
