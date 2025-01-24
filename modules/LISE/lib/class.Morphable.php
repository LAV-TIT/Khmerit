<?php


namespace LISE;


class Morphable extends \ArrayObject
{
  public function __construct($input = array(), $flags = 0, $iterator_class = 'ArrayIterator')
  {
    parent::__construct($input, $flags, $iterator_class);
  }
  
  public function __call($func, $argv)
  {
    if (!is_callable($func) || substr($func, 0, 6) !== 'array_')
    {
      throw new \BadMethodCallException(__CLASS__ . '->' . $func);
    }
  
    return call_user_func_array( $func, array_merge( array( $this->getArrayCopy() ), $argv ) );
  }
  
}

?>