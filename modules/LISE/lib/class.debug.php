<?php
/**
 *
 */

namespace LISE;

/**
 * Class debug
 *
 * @package LISE
 */

final class debug
{
  
  /**
   * private properties
   */
  
  private static $_objects;
  private static $_output;
  private static $_depth;
  private static $_flags = [];
  
  /**
   * constants
   */
  
  # modes
  const M_DUMP   = 'dump';
  const M_XDUMP  = 'xdump';
  const M_EXPORT = 'export';
  
  # flags
  const F_DEFAULT    =  0;   #BIN 00000000
  const F_ECHO       =  1;   #BIN 00000001
  const F_HTML       =  2;   #BIN 00000010
  const F_STRIP_TAGS =  4;   #BIN 00000100
  const F_HIGHLIGHT  =  8;   #BIN 00001000
  const F_DIE        = 16;   #BIN 00010000
  const F_TRACE      = 32;   #BIN 00100000
  
  /**
   * private methods
   */
  
  private function __construct(){}
  
  private static function _process_flags($flags = self::F_DEFAULT)
  {
    if($flags === self::F_DEFAULT)
    {
      self::$_flags['echo']       = TRUE;
      self::$_flags['html']       = TRUE;
      self::$_flags['strip_tags'] = FALSE;
      self::$_flags['highlight']  = TRUE;
      self::$_flags['die']        = FALSE;
      self::$_flags['trace']      = FALSE;
      
      return;
    }
  
    self::$_flags['echo']       = $flags & self::F_ECHO;
    self::$_flags['html']       = $flags & self::F_HTML;
    self::$_flags['strip_tags'] = $flags & self::F_HTML;
    self::$_flags['highlight']  = $flags & self::F_HIGHLIGHT;
    self::$_flags['die']        = $flags & self::F_DIE;
    self::$_flags['trace']      = $flags & self::F_TRACE;
  }
  
  /**
   * A function to generate a backtrace in a readable format.
   */
    private static function _bt($bt)
    {
      $output = '';
      $file = $bt[0]['file'];
      $line = $bt[0]['line'];
  
      $output .= "\n\n\n<p><b>Backtrace in $file on line $line</b></p>\n";
  
      $bt = array_reverse($bt);
  
      $output .=  "<pre><dl>\n";
  
      foreach($bt as $trace)
      {
        $file     = $trace['file'];
        $line     = $trace['line'];
        $function = $trace['function'];
        
        $args = [];
        foreach($trace['args'] as $arg)
        {
          switch( gettype($arg) )
          {
            case 'boolean':
              $args .= $arg ? 'TRUE' : 'FALSE';
            break;
  
            case 'integer':
              $args[] = "$arg";
            break;
  
            case 'double':
              $args[] = "$arg";
            break;
  
            case 'string':
              $args[] = "'$arg'";
            break;
  
            case 'resource':
              $args[] = '{resource}';
            break;
  
            case 'NULL':
              $args[] = "NULL";
            break;
  
            case 'unknown type':
              $args[] = '{unknown}';
            break;
            
            case 'array':
              //$args[] = "$arg";
              $args[] = print_r($arg, TRUE);
            break;
            
            case 'object':
              $args[] = '{object} ' . get_class($arg);
            break;
            
          }

        }
  
        $args = implode(', ', $args);
        
        $output .= "
          <dt><b>$function</b>($args) </dt>
          <dd>$file on line $line</dd>
  		";
      }
  
      $output .=  "</dl></pre>\n";
      
      return $output;
    }
  
  /**
   * based on Qiang Xue's TVarDumper
   *
   * @param $var
   * @param $level
   */
  private static function _dumpInternal($var, $level)
  {
    switch( gettype($var) )
    {
      case 'boolean':
        self::$_output .= $var ? 'TRUE' : 'FALSE';
      break;
      
      case 'integer':
        self::$_output .= "$var";
      break;
      
      case 'double':
        self::$_output .= "$var";
      break;
      
      case 'string':
        self::$_output .= "'$var'";
      break;
      
      case 'resource':
        self::$_output .= '{resource}';
      break;
      
      case 'NULL':
        self::$_output .= "NULL";
      break;
      
      case 'unknown type':
        self::$_output .= '{unknown}';
      break;
      
      case 'array':
        if(self::$_depth <= $level)
        {
          self::$_output .= 'array(...)';
        }
        else if(empty($var))
        {
          self::$_output .= 'array()';
        }
        else
        {
          $keys          = array_keys($var);
          $spaces        = str_repeat(' ', $level * 4);
          self::$_output .= "array\n" . $spaces . '(';
          
          foreach($keys as $key)
          {
            self::$_output .= "\n" . $spaces . "    [$key] => ";
            self::$_output .= self::_dumpInternal($var[$key], $level + 1);
          }
          
          self::$_output .= "\n" . $spaces . ')';
        }
      break;
      
      case 'object':
        if(($id = array_search($var, self::$_objects, TRUE)) !== FALSE)
        {
          self::$_output .= get_class($var) . ' #' . ($id + 1) . '(...)';
        }
        else if(self::$_depth <= $level)
        {
          self::$_output .= get_class($var) . '(...)';
        }
        else
        {
          $id            = array_push(self::$_objects, $var);
          $className     = get_class($var);
          $members       = (array)$var;
          $keys          = array_keys($members);
          $spaces        = str_repeat(' ', $level * 4);
          self::$_output .= "$className #$id\n" . $spaces . '(';
          
          foreach($keys as $key)
          {
            $keyDisplay    = strtr(trim($key), array("\0" => ':'));
            self::$_output .= "\n" . $spaces . "    [$keyDisplay] => ";
            self::$_output .= self::_dumpInternal($members[$key], $level + 1);
          }
          
          self::$_output .= "\n" . $spaces . ')';
        }
      break;
    }
  }
  
  /**
   * @param mixed $var
   * @param int   $maxDepth
   *
   * @return mixed
   */
  private static function _export($var, $maxDepth)
  {
    $return = NULL;
    
    $isObj  = is_object($var);
    
    if(!$maxDepth)
    {
      return is_object($var) ? get_class($var)
        : (is_array($var) ? 'Array(' . count($var) . ')' : $var);
    }
    
    if(is_array($var))
    {
      $return = [];
      
      foreach($var as $k => $v)
      {
        $return[$k] = self::_export($v, $maxDepth - 1);
      }
      
      return $return;
    }
    
    if(!$isObj)
    {
      return $var;
    }
    
    $return = new \stdClass();
    
    if($var instanceof \DateTimeInterface)
    {
      $return->__CLASS__ = get_class($var);
      $return->date      = $var->format('c');
      $return->timezone  = $var->getTimezone()->getName();
      
      return $return;
    }
    
    if($var instanceof \ArrayObject || $var instanceof \ArrayIterator)
    {
      $return->__STORAGE__ = self::_export($var->getArrayCopy(), $maxDepth - 1);
    }
    
    return self::_fillWithClassAttributes($var, $return, $maxDepth);
  }
  
  /**
   * Fill the $return variable with class attributes
   * Based on obj2array function from {@see https://secure.php.net/manual/en/function.get-object-vars.php#47075}
   *
   * @param object   $var
   * @param \stdClass $return
   * @param int      $maxDepth
   *
   * @return mixed
   */
  private static function _fillWithClassAttributes($var, \stdClass $return, $maxDepth)
  {
    $clone = (array)$var;
    
    foreach(array_keys($clone) as $key)
    {
      $aux  = explode("\0", $key);
      $name = end($aux);
      
      if($aux[0] === '')
      {
        $name .= ':' . ($aux[1] === '*' ? 'protected' : $aux[1] . ':private');
      }
      
      $return->$name = self::_export($clone[$key], $maxDepth - 1);;
    }
    
    return $return;
  }
  
  /**
   * public methods
   */
  
  /**
   * based on Qiang Xue's TVarDumper
   *
   * echo debug_display::dump($var);
   *
   * Converts a variable into a string representation.
   * This method achieves the similar functionality as var_dump and print_r
   *
   * @param mixed variable to be dumped
   * @param integer maximum depth that the dumper should go into the variable. Defaults to 10.
   *
   * @return string the string representation of the variable
   */
  public static function dump($var, $depth = 10, $highlight = FALSE)
  {
    self::$_objects = array();
    self::$_depth   = $depth;
    self::_dumpInternal($var, 0);
    

  }
  
  /**
   * Prints a dump of the public, protected and private properties of $var.
   *
   * @link https://xdebug.org/
   *
   * @param mixed   $var       The variable to dump.
   * @param integer $maxDepth  The maximum nesting level for object properties.
   * @param boolean $stripTags Whether output should strip HTML tags.
   * @param boolean $echo      Send the dumped value to the output buffer
   *
   * @return string
   */
  public static function xdump($var, $maxDepth = 2, $stripTags = TRUE, $echo = TRUE)
  {
    $html = ini_get('html_errors');
    
    if($html !== TRUE)
    {
      ini_set('html_errors', TRUE);
    }
    
    if(extension_loaded('xdebug'))
    {
      ini_set('xdebug.var_display_max_depth', $maxDepth);
    }
    
    $var = self::_export($var, $maxDepth);
    
    ob_start();
    var_dump($var);
    $dump = ob_get_contents();
    ob_end_clean();
    
    $dumpText = ($stripTags ? strip_tags(html_entity_decode($dump)) : $dump);
    
    ini_set('html_errors', $html);
    
    if($echo)
    {
      echo $dumpText;
    }
    
    return $dumpText;
  }
  
  
  
  /**
   * Another convenience function to output a human readable function stack trace.
   *
   * This method uses echo.
   */
  function stack_trace()
  {
    $stack = debug_backtrace();
    foreach($stack as $elem)
    {
      if($elem['function'] == 'stack_trace')
      {
        continue;
      }
      
      if(isset($elem['file']))
      {
        echo $elem['file'] . ':' . $elem['line'] . ' - ' . $elem['function'] . '<br/>';
      }
      else
      {
        echo ' - ' . $elem['function'] . '<br/>';
      }
    }
  }
  
  public static function display(
                                  $what,
                                  string $mode = self::M_DUMP,
                                  int $depth = 10,
                                  int $flags = self::F_DEFAULT
                                )
  {
    # gather some info from the backtrace
    $bt = debug_backtrace();
    $file = file($bt[0]['file']);
    $src  = $file[$bt[0]['line']-1];
    $pat = '#(.*)' . __FUNCTION__ . ' *?\( *?(.*) *?\)(.*)#i';
    $params  = preg_replace($pat, '$2', $src);
    $vars = explode(',', $params);
    $var = trim($vars[0]);
    self::$_output  = '';
    $final_out = '';
    
    # process flags
    self::_process_flags($flags);
    
    
    switch($mode)
    {
      case self::M_DUMP:
        self::$_output .= self::dump($what, $depth);
          break;
      case self::M_XDUMP:
        # TODO
          break;
      case self::M_EXPORT:
        # TODO
          break;
      default:
    }
  
    if(self::$_flags['highlight'])
    {
      $result = highlight_string("<?php\n" . self::$_output, TRUE);
  
      $result = preg_replace('/&lt;\\?php<br \\/>/', '', $result, 1);
    }
    else
    {
      $result = self::$_output;
    }
    
    if(self::$_flags['html'])
    {
      $final_out .= '<br/>:::::::::::::::::::::<br/>';
      $final_out .= 'called from: ';
      $final_out .= $bt[0]['file'] . ' - ' . $bt[0]['line'] . '<br/>';
      $final_out .= '- ' . $bt[0]['class'] . $bt[0]['type'] . $bt[0]['function'] . ' : ' . '<br/>';
      $final_out .= '- variable: ' . $var;
      $final_out .= '<br/>:::::::::::::::::::::<br/>';
    }
    else
    {
      $final_out .= PHP_EOL . PHP_EOL;
      $final_out .= 'called from: ';
      $final_out .= PHP_EOL;
      $final_out .= $bt[0]['file'] . ' - ' . $bt[0]['line'];
      $final_out .= PHP_EOL;
      $final_out .= '- ' . $bt[0]['class'] . $bt[0]['type'] . $bt[0]['function'];
      $final_out .= PHP_EOL;
      $final_out .= '- variable: ' . $var;
      $final_out .= PHP_EOL . PHP_EOL;
    }
  
    $final_out .= $result;
    
    if(self::$_flags['trace'])
    {
      $final_out .= self::_bt($bt);
    }
  
    if(self::$_flags['echo'])
    {
      echo $final_out;
  
      if(self::$_flags['die'])
      {
        die('<br/>RIP!<br/>');
      }
    }
    
    return $final_out;
  }
  
  
  /**
   * Returns a string representation of an object.
   *
   * @param object $obj
   *
   * @return string
   */
  public static function toString($obj)
  {
    return method_exists($obj, '__toString') ? (string) $obj : get_class($obj) . '@' . spl_object_hash($obj);
  }
}
?>