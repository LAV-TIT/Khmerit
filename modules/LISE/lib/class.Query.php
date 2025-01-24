<?php
/**
 *
 */

namespace LISE;

use Closure;
use RuntimeException;

/**
 * Class query
 *
 * @package LISE
 */
class Query
{
  # Action types
  /**
   *
   */
  protected const TYPE_SELECT  = 'SELECT';
  protected const TYPE_INSERT  = 'INSERT';
  protected const TYPE_UPDATE  = 'UPDATE';
  protected const TYPE_DELETE  = 'DELETE';
  protected const TYPE_REPLACE = 'REPLACE';
  
  #
  protected const NL = "\r\n";
  protected const TAB = '  ';
  
  private static array $_module_map = [];
  
  
  /**
   *  protected props
   */
  
  protected string $_module_name;
  protected string $_table_prefix;
  
  /**
   * ORDER BY random keyword
   *
   * @var array
   */
  protected array $random_keyword = [
    'RAND()',
    'RAND(%d)',
  ];
  
  /**
   * Tables relation types
   *
   * @var array
   */
  protected array $join_types = [
    'LEFT',
    'RIGHT',
    'OUTER',
    'INNER',
    'CROSS',
    'LEFT OUTER',
    'RIGHT OUTER',
  ];
  
  /**
   *  private props
   */
  private string                            $_table                = '';
  private string                            $_query                = '';
  private array                             $_cols                 = [];
  private array                             $_values               = [];
  private string                            $_from                 = '';
  private int                               $_limit                = 0;
  private int                               $_offset               = 0;
  private string                            $_distinct             = '';
  private array                             $_set                  = [];
  private array                             $_where_stack          = [];
  private array                             $_where_bindings_stack = [];
  private array                             $_order_by_stack       = [];
  private array                             $_joins_stack          = [];
  private array                             $_table_aliases_map    = [];
  private \CMSMS\Database\Connection        $_db;
  private                                   $_rs;
  private                                   $_type;
  private Query                             $_sub_query;
  
  /**
   *  private methods
   */
  
  /**
   *
   */
  private function _reset_table() : void
  {
    $this->_table = '';
  }
  
  /**
   *
   */
  private function _reset_table_aliases_map() : void
  {
    $this->_table_aliases_map = [];
  }
  
  /**
   *
   */
  private function _reset_from() : void
  {
    $this->_from = '';
  }
  
  /**
   *
   */
  private function _reset_query() : void
  {
    $this->_query = '';
  }
  
  /**
   *
   */
  private function _reset_cols() : void
  {
    $this->_cols = [];
  }
  
  /**
   *
   */
  private function _reset_values() : void
  {
    $this->_values = [];
  }
  
  private function _reset_result_set() : void
  {
    $this->_rs = [];
  }
  
  /**
   * resets all internal data
   */
  private function _reset_all() : void
  {
    $this->_reset_table();
    $this->_reset_table_aliases_map();
    $this->_reset_from();
    $this->_reset_query();
    $this->_reset_result_set();
    $this->_reset_cols();
    $this->_reset_values();
    $this->_stack_clear('where');
    $this->_stack_clear('where_bindings');
    $this->_stack_clear('order_by');
  }
  
  /**
   * resets all write data
   */
  private function _reset_write_data() : void
  {
    $this->_reset_query();
    $this->_reset_cols();
    $this->_reset_values();
    $this->_stack_clear('where');
    $this->_stack_clear('where_bindings');
    $this->_stack_clear('order_by');
  }
  
  /**
   *
   */
  private function _load_module_names() : void
  {
    if( empty(self::$_module_map ) )
    {
      self::$_module_map = \ModuleOperations::get_instance()->GetAllModuleNames();
    }
  }
  
  /**
   * @param $module_name
   *
   * @return bool
   */
  private function _module_exists($module_name) : bool
  {
    $this->_load_module_names();
    
    static $lower_case_list;
    
    if( empty($lower_case_list) )
    {
      $lower_case_list = self::$_module_map;
      
      $to_lower = static function(&$item, $key)
      {
        $item = strtolower($item);
        $item = (string)$item;
      };
      
      array_walk_recursive($rep_map, $to_lower);
    }
    
    return (in_array($module_name, self::$_module_map, TRUE) || in_array($module_name, $lower_case_list, TRUE));
  }
  
  /**
   * @param $table_name
   *
   * @return string
   * @throws \RuntimeException
   */
  private function _extract_module_name_from_table($table_name) : string
  {
    $found = FALSE;
    # remove the usual cms prefix if there
    $tmp = str_replace(\cms_db_prefix(), '', $table_name);
    
    $parts = explode('_', $tmp);
    
    $module_name = '';
    
    if($parts[0] === 'module')
    {
      //$done = FALSE;
      
      do
      {
        array_shift($parts);
        $module_name .= $parts[0];
        $found =  $this->_module_exists($module_name);
        $done = $found || !count($parts);
        
        if(!$done) { $module_name .= '_'; }
      }
      while(!$done);
    }
    
    if( !count($parts) )
    {
      throw new RuntimeException('Could not extract a valid table name!');
    }
    
    if($found) { return $module_name; }
    
    return '';
  }
  
  /**
   * @param $from
   * @param $alias
   */
  private function _map_alias($from, $alias) : void
  {
    if( !isset($this->_table_aliases_map[$from]) )
    {
      $this->_table_aliases_map[$from] = $alias;
    }
  }
  
  /**
   * @param $table_string
   */
  private function _process_alias($table_string) : void
  {
    if( count( $tmp = explode(' ', trim($table_string) ) ) === 2)
    {
      [$table, $alias] = $tmp;
      $table = $this->_table = $this->_get_table( $this->_clean_table_name($table) );
      $this->_map_alias($table, $alias);
    }
  }
  
  /**
   * set the main table for basic query DML operations
   * SELECT / UPDATE / INSERT / DELETE
   * $table can include its alias if separated by a space
   * @param $table
   */
  private function _set_table($table) : void
  {
    if( count( $tmp = explode(' ', trim($table) ) ) === 2)
    {
      [$table, $alias] = $tmp;
    }
  
    $this->_table = $this->_clean_table_name($table);
    $this->_from  = $this->_get_table();
    
    if( isset($alias) )
    {
      $this->_map_alias($this->_from, $alias);
    }
  }
  
  /**
   * remove all prefix and module name from the table name
   * we can safely rebuild it later
   *
   * @param $table_name
   *
   * @return string|string[]
   */
  private function _clean_table_name($table_name)
  {
    
    if( empty($this->_module_name) )
    {
      $mn                 = $this->_extract_module_name_from_table($table_name);
      $this->_module_name = empty($mn) ? strtolower(__NAMESPACE__) : $mn;
    }
    
    # remove the usual cms prefix
    # remove the module name
  
    return str_replace(
      [
        $this->_table_prefix,
       'module_' . $this->_module_name . '_'
      ],
      '', $table_name
    );
    
  }
  
  /**
   * return a valid table name:
   * SELECT / UPDATE / INSERT / DELETE
   *
   * @param string $table_name
   *
   * @return string
   */
  private function _get_table($table_name = '') : string
  {
    if( empty($table_name) )
    {
      $table_name = $this->_table;
    }
    
    return $this->_table_prefix . 'module_' . $this->_module_name . '_' . $table_name;
  }
  
  /**
   * stack related methods
   */
  
  /**
   * This is only temporary (JM)
   * low level
   * @ignore
   */
  
  /**
   * @param $stack
   *
   * @return int
   */
  private function _ll_stack_count($stack) : int
  {
    return count($stack);
  }
  
  /**
   * @param $stack
   *
   * @return mixed
   */
  private function _ll_stack_peek($stack)
  {
    return end($stack);
  }
  
  /**
   * @param $stack
   * @param $token
   */
  private function _ll_stack_push(&$stack, $token) : void
  {
    $stack[] = $token;
  }
  
  /**
   * @param $stack
   */
  private function _ll_stack_clear(&$stack) : void
  {
    $stack = [];
  }
  
  /**
   * @param $stack
   *
   * @return mixed
   */
  private function _ll_stack_pop(&$stack)
  {
    return  array_pop($stack);
  }
  
  
  /**
   * @internal
   */
  
  /**
   * @param $stack
   *
   * @return int
   */
  private function _stack_count($stack) : int
  {
    $stack_name = "_{$stack}_stack";
    
    return $this->_ll_stack_count($this->$stack_name);
  }
  
  /**
   * @param $stack
   *
   * @return mixed
   */
  private function _stack_peek($stack)
  {
    $stack_name = "_{$stack}_stack";
    
    return $this->_ll_stack_peek($this->$stack_name);
  }
  
  /**
   * @param $stack
   * @param $token
   */
  private function _stack_push($stack, $token) : void
  {
    $stack_name          = "_{$stack}_stack";
    $this->_ll_stack_push($this->$stack_name, $token);
  }
  
  /**
   * @param $stack
   */
  private function _stack_clear($stack) : void
  {
    $stack_name = "_{$stack}_stack";
    $this->_ll_stack_clear($this->$stack_name);
  }
  
  /**
   * @param $stack
   *
   * @return mixed
   */
  private function _stack_pop($stack)
  {
    $stack_name = "_{$stack}_stack";
    return $this->_ll_stack_pop($this->$stack_name);
  }
  
  /**
   * compile methods
   */
  
  /**
   * TODO maybe $limit and $offset?
   */
  private function _compile_query() : void
  {
    switch ($this->_type)
    {
      case self::TYPE_SELECT:
        $this->_compile_select();
      break;
      case self::TYPE_INSERT:
        $this->_compile_insert();
      break;
      case self::TYPE_UPDATE:
        $this->_compile_update();
      break;
      case self::TYPE_DELETE:
        $this->_compile_delete();
      break;
      case self::TYPE_REPLACE:
        $this->_compile_replace();
      break;
      
      default:
    }
  }
  
  /**
   * @return string
   */
  private function _compile_where() : string
  {
    if( !$this->_stack_count('where') )
    {
      return '';
    }
    
    $where = 'WHERE ' . self::NL;
    $where .= implode(' ', $this->_where_stack);
    
    $this->_values = array_merge($this->_values, $this->_where_bindings_stack);
    
    return $where . self::NL;
  }
  
  /**
   * @return string
   */
  private function _compile_joins() : string
  {
    if( !$this->_stack_count('joins') )
    {
      return '';
    }
    
    $joins = '';
    
    foreach( $this->_joins_stack as $join)
    {
      $joins .= $join . self::NL;
    }
    
    return $joins;
  }
  
  /**
   * @return string
   */
  private function _compile_order_by() : string
  {
    if( !$this->_stack_count('order_by') )
    {
      return '';
    }
    
    $order_by = 'ORDER BY ' . self::NL;
    $order_by .= implode(',' . self::NL . self::TAB, $this->_order_by_stack);
    
    return $order_by . self::NL;
  }
  
  /**
   *
   */
  private function _compile_select() : void
  {
    $this->_reset_query();
    $this->_query = 'SELECT ';
    
    if( !empty($this->_distinct) )
    {
      $this->_query .= $this->_distinct . ' ';
    }
    
    $this->_query .= self::NL . self::TAB;
    
    if( empty($this->_cols) ) { $this->_cols[] = '*'; }
    
    $this->_query .= implode(',', $this->_cols) . self::NL;
    $this->_query .= 'FROM ' . self::NL . self::TAB;
    $this->_query .= $this->_from . self::NL;
    $this->_query .= $this->_compile_joins();
    $this->_query .= $this->_compile_where();
    $this->_query .= $this->_compile_order_by();
    
    if($this->_limit > 0)
    {
      $this->_query .= ' LIMIT ' . $this->_limit;
      
      if($this->_offset > 0)
      {
        $this->_query .= ' OFFSET ' . $this->_offset;
      }
    }
  }
  
  /**
   *
   */
  private function _compile_insert() : void
  {
    $this->_reset_query();
    $keys = array_keys($this->_set);
    $this->_values = array_values($this->_set);
    $place_holders =  array_fill(0, count($keys), '?');
    
    $this->_query = 'INSERT INTO ' . self::NL;
    $this->_query .= self::TAB . $this->_from . self::NL;
    $this->_query .= self::TAB . '(';
    $this->_query .= implode(',', $keys);
    $this->_query .= ')' . self::NL . 'VALUES' . self::NL . self::TAB .  '(';
    $this->_query .= implode(',', $place_holders);
    $this->_query .= ')';
  }
  
  /**
   *
   */
  private function _compile_update() : void
  {
    $keys = array_keys($this->_set);
    $this->_values = array_values($this->_set);
    //$place_holders =  array_fill(0, count($keys), '?');
    
    $this->_reset_query();
    $this->_query = 'UPDATE ' . self::NL;
    $this->_query .= self::TAB . $this->_from . self::NL;
    $this->_query .= 'SET' . self::NL;
    
    $temp = [];
    
    foreach($keys as $one)
    {
      $temp[]= self::TAB .  $one . ' = ?';
    }
    
    $this->_query .= implode(',' . self::NL, $temp) . self::NL;
    
    $this->_query .= $this->_compile_where() . self::NL;
    $this->_query .= $this->_compile_order_by() . self::NL;
    
    if($this->_limit > 0)
    {
      $this->_query .= ' LIMIT ' . $this->_limit;
      
      if($this->_offset > 0)
      {
        $this->_query .= ' OFFSET ' . $this->_offset;
      }
    }
  }
  
  /**
   *
   */
  private function _compile_delete() : void
  {
    $this->_reset_query();
    $this->_query = 'DELETE FROM ' . self::NL;
    $this->_query .= self::TAB . $this->_from . self::NL;
    $this->_query .= $this->_compile_where() . self::NL;
    $this->_query .= $this->_compile_order_by() . self::NL;
    
    if($this->_limit > 0)
    {
      $this->_query .= ' LIMIT ' . $this->_limit;
      
      if($this->_offset > 0)
      {
        $this->_query .= ' OFFSET ' . $this->_offset;
      }
    }
  }
  
  private function _compile_replace() : void
  {
    $this->_reset_query();
    $keys = array_keys($this->_set);
    $this->_values = array_values($this->_set);
    $place_holders =  array_fill(0, count($keys), '?');
    
    $this->_query = 'REPLACE INTO ' . self::NL;
    $this->_query .= self::TAB . $this->_from . ' ';
    $this->_query .= '(';
    $this->_query .= implode(',', $keys);
    $this->_query .= ')' . self::NL . 'VALUES' . self::NL . self::TAB .  '(';
    $this->_query .= implode(',', $place_holders);
    $this->_query .= ')';
  }
  
  /**
   *
   */
  private function _execute() : void
  {
    $bindings = !empty($this->_values) ? $this->_values : FALSE;
    $this->_rs = $this->_db->Execute($this->_query, $bindings);
  }
  
  /**
   * runs methods from the connection object
   * (DB = $this->_db = \CMSMS\Database\Connection)
   * if no arguments provided we use internal sql and bindings
   * otherwise use what is provided, in order:
   * $sql -> query to be used
   * $bindings -> array of values to be linked to the placeholders
   *
   * all other arguments will be passed to the called function as are
   *
   * $this->_rs will hold the results of the method call
   * in the form of an array
   */
  private function _run_connection() : void
  {
    $args   = func_get_args();
    $method = array_shift($args);
    $this->_compile_query();
    $bindings = !empty($this->_values) ? $this->_values : FALSE;
    $c        = count($args);
    
    # in case we have arguments we use them
    # otherwise we use internal
    if($c === 0)
    {
      # none provided
      $args[0] = $this->_query;
      $args[1] = $bindings;
    }
    elseif($c === 1)
    {
      # we have an sql statement, use it
      $this->_query = $args[0];
      
      # use bindings if any
      $args[1]      = $bindings;
    }
    else
    {
      # everything provided
      $this->_query = $args[0];
      $this->_values  = $args[1];
    }
    
    $this->_rs = call_user_func_array([$this->_db, $method], $args);
  }
  
  /**
   * @param string $select
   * @param string $alias
   * @param string $type
   *
   * @return mixed
   * @throws \LISE\DataException
   */
  private function maxMinAvgSum(string $select = '', string $alias = '', string $type = 'MAX')
  {
    if ($select === '')
    {
      throw new DataException('Empty select parameter in maxMinAvgSum');
    }
    
    if (strpos($select, ',') !== false)
    {
      throw new DataException('Invalid argument in maxMinAvgSum: column name not separated by comma');
    }
    
    $type = strtoupper($type);
    
    if (! in_array($type, ['MAX', 'MIN', 'AVG', 'SUM', 'COUNT'], true))
    {
      throw new DataException('Invalid function type: ' . $type);
    }
    
    if ($alias === '')
    {
      $alias = $this->CreateAliasFromTable( trim($select) );
    }
    
    $this->_query = $type . '(' . trim($select) . ') AS ' . trim($alias) .     $this->_query .= 'FROM ' . $this->_from;
    
    return $this->GetOne($this->_query);
  }
  
  /**
   *  protected methods
   */
  
  protected function _slim_clone() : Query
  {
    return (clone $this)->FullReset();
  }
  
  protected function object_to_array($object) : array
  {
    if( !is_object($object) ) { return $object; }
    
    $array = [];
    foreach (get_object_vars($object) as $key => $val)
    {
      // There are some built in keys we need to ignore for this conversion
      if( !is_object($val) && !is_array($val) && $key !== '_parent_name')
      {
        $array[$key] = $val;
      }
    }
    
    return $array;
  }
  
  private function _set_module_name($module_name = '') : void
  {
    if( empty($module_name) )
    {
      $this->_module_name = strtolower(__NAMESPACE__);
    }
    else
    {
      $this->_module_name = $module_name;
    }
  }
  
  private function _set_table_prefix($table_prefix) : void
  {
    if( empty($table_prefix) )
    {
      $this->_table_prefix = \cms_db_prefix();
    }
    else
    {
      $this->_table_prefix = $table_prefix;
    }
  }
  
  /**
   * public methods
   */
  
  
  /**
   * query constructor.
   *
   * @param string $table_name
   * @param string $module_name
   * @param string $table_prefix
   *
   * @throws \Exception
   */
  public function __construct($table_name = '', $module_name = '', $table_prefix = '')
  {
    $this->_db = \cms_utils::get_db();
    $this->_set_table_prefix($table_prefix);
    $this->_set_module_name($module_name);
    $this->_set_table($table_name);
  }
  
  /**
   * @param string $select
   *
   * @return $this
   * @throws \LISE\DataException
   */
  public function SelectDistinct($select = '*') : Query
  {
    $this->_distinct = 'DISTINCT';
    $this->Select($select);
    
    return $this;
  }
  
  /**
   * @param string|array $select
   *
   * @return $this
   * @throws \LISE\DataException
   */
  public function Select($select = '*') : Query
  {
    if( empty($this->_from) )
    {
      throw new DataException('A table reference is needed for From!');
    }
    
    if( is_string($select) )
    {
      $select = explode(',', $select);
    }
    
    foreach($select as $val)
    {
      if ($val !== '')
      {
        $this->_cols[] = $val;
      }
    }
    
    $this->_type = self::TYPE_SELECT;
    
    return $this;
  }
  
  /**
   * @param array|null $set
   *
   * @return $this
   */
  public function Insert(array $set = null) : Query
  {
    if($set !== null) { $this->set($set, ''); }
    
    $this->_type = self::TYPE_INSERT;
    
    return $this;
  }
  
  /**
   * @param array|null $set
   *
   * @return $this
   * @throws \LISE\DataException
   */
  public function Replace(array $set = null) : Query
  {
    if($set !== null)
    {
      $this->Set($set);
    }
    
    if( empty($this->_set) )
    {
      throw new DataException('Data set cannot be empty');
    }
    
    $this->_type = self::TYPE_REPLACE;
    
    return $this;
  }
  
  
  /**
   * @param array|null $set
   *
   * @return $this
   */
  public function Update(array $set = null) : Query
  {
    if($set !== null) { $this->set($set, ''); }
    
    $this->_type = self::TYPE_UPDATE;
    
    return $this;
  }
  
  /**
   * @param string $where
   * @param bool   $reset_data
   *
   * @return $this
   */
  public function Delete($where = '', bool $reset_data = true) : Query
  {
    if($reset_data)
    {
      $this->_reset_write_data();
    }
    
    if($where !== '')
    {
      $this->Where($where);
    }
    
    $this->_type = self::TYPE_DELETE;
    
    return $this;
  }
  
  /**
   * Allows key/value pairs to be set for insert(), update() or replace().
   *
   * @param string|array|object $key    Field name, or an array of field/value pairs
   * @param string              $value  Field value, if $key is a single field
   *
   * @return $this
   */
  public function Set($key, ?string $value = '') : Query
  {
    $key = $this->object_to_array($key);
    
    if( !is_array($key) ) { $key = [$key => $value]; }
    
    foreach($key as $k => $v) { $this->_set[$k] = $v; }
    
    return $this;
  }
  
  public function From($table_name = '') : Query
  {
    $this->_set_table($table_name);
    
    return $this;
  }
  
  public function SetTable($table_name = '') : Query
  {
    $this->_set_table($table_name);
    
    return $this;
  }
  
  /**
   * @return $this
   */
  public function GroupStart() : Query
  {
    $this->_stack_push('where','(');
    
    return $this;
  }
  
  /**
   * @return $this
   */
  public function GroupEnd() : Query
  {
    $this->_stack_push('where',')');
    
    return $this;
  }
  
  /**
   * Alias for AndWhere
   * @param        $key
   * @param null   $value
   * @param string $op
   *
   * @return $this
   */
  public function Where($key, $value = NULL, $op = '=') : Query
  {
    return $this->AndWhere($key, $value, $op);
  }
  
  /**
   * @param        $key
   * @param null   $value
   * @param string $op
   *
   * @return $this
   */
  public function AndWhere($key, $value = NULL, $op = '=') : Query
  {
    
    if( $this->_stack_count('where') && !($this->_stack_peek('where') === '(') )
    {
      $this->_stack_push('where','AND');
    }
    
    if( !is_array($key) )
    {
      if($value === NULL)
      {
        # lets assume $key is a full WHERE string expression
        
        $this->_stack_push('where', $key);
      }
      else if($value instanceof Closure)
      {
        $query_obj = $this->_slim_clone();
        $value       = '(' .  $value($query_obj)->GetQuery(TRUE) . ')';
        $this->_stack_push('where',$key . ' ' . $op . ' ' . $value);
      }
      else
      {
        $this->_stack_push('where',$key . ' ' . $op . ' ?');
        $this->_stack_push('where_bindings', $value);
      }
    }
    else
    {
      $c = count($key);
      $i = 0;
      
      foreach($key as $k => $v)
      {
        if ($v !== null)
        {
          $this->_stack_push('where',$k . ' ' . $op . ' ?');
          $this->_stack_push('where_bindings', $v);
        }
        
        if(++$i < $c)
        {
          $this->_stack_push('where','AND');
        }
      }
    }
    
    return $this;
  }
  
  
  /**
   * @param        $key
   * @param null   $value
   * @param string $op
   *
   * @return $this
   */
  public function OrWhere($key, $value = NULL, $op = '=') : Query
  {
    if( $this->_stack_count('where') )
    {
      $this->_stack_push('where','OR');
    }
    
    if( !is_array($key) )
    {
      if($value === NULL)
      {
        # lets assume $key is a full WHERE string expression
        
        $this->_stack_push('where', $key);
      }
      else
      {
        $this->_stack_push('where',$key . ' ' . $op . ' ?');
        $this->_stack_push('where_bindings', $value);
      }
    }
    else
    {
      $c = count($key);
      $i = 0;
      foreach($key as $k => $v)
      {
        $this->_stack_push('where',$k . ' ' . $op . ' ?');
        $this->_stack_push('where_bindings', $v);
        
        if(++$i < $c)
        {
          $this->_stack_push('where','OR');
        }
      }
    }
    
    return $this;
  }
  
  /**
   * @param int $limit
   * @param int $offset
   *
   * @return $this
   * @throws \LISE\DataException
   */
  public function Limit($limit = 0, $offset = 0) : Query
  {
    if( !is_numeric($limit) )
    {
      throw new DataException('Limit should be specified using numerals');
    }
    
    if( !is_numeric($offset) )
    {
      throw new DataException('Offset should be specified using numerals');
    }
    
    $this->_limit  = $limit === 0 ? $this->_limit : $limit;
    $this->_offset = $limit === 0 ? $this->_offset : $offset;
    
    return $this;
  }
  
  /**
   * @param string $orderBy
   * @param string $direction
   *
   * @return $this
   */
  public function OrderBy(string $orderBy, string $direction = '')
  {
    $direction = strtoupper( trim($direction) );
    
    if($direction === 'RANDOM')
    {
      $direction = '';
      
      // Do we have a seed value?
      $orderBy = ctype_digit($orderBy) ? sprintf($this->random_keyword[1], $orderBy) : $this->random_keyword[0];
    }
    elseif( empty($orderBy) )
    {
      return $this;
    }
    elseif( $direction !== '' )
    {
      $direction = in_array($direction, ['ASC', 'DESC'], true) ? ' ' . $direction : '';
    }
    
    $ob_arr = explode(',', $orderBy);
    
    foreach($ob_arr as $one)
    {
      if(
        $direction === ''
        && preg_match('/\s+(ASC|DESC)$/i', rtrim($one), $match, PREG_OFFSET_CAPTURE)
      )
      {
        $col = ltrim( substr($one, 0, $match[0][1]) );
        $direction =  $match[1][0];
      }
      else
      {
        $col = trim($one);
      }
      
      $this->_stack_push('order_by', $col . ' ' . $direction);
    }
    
    return $this;
  }
  
  /**
   * Tests whether the string has an SQL operator
   *
   * @param string $str
   *
   * @return boolean
   */
  protected function _has_operator(string $str) : bool
  {
    return (bool) preg_match( '/(<|>|!|=|\sIS NULL|\sIS NOT NULL|\sEXISTS|\sBETWEEN|\sLIKE|\sIN\s*\(|\s)/i', trim($str) );
  }
  
  /**
   * @param string $table
   * @param string $cond
   * @param string $type
   *
   * @return \LISE\Query
   */
  public function Join(string $table, string $cond, string $type = '')
  {
    if ($type !== '')
    {
      $type = strtoupper( trim($type) );
      
      if( !in_array($type, $this->join_types, true) )
      {
        $type = '';
      }
      else
      {
        $type .= ' ';
      }
    }
    
    $this->_process_alias($table);
    
    $table = $this->_get_table($table);
    
    if( !$this->_has_operator($cond) )
    {
      $cond = ' USING (' . $cond . ')';
    }
    else
    {
      $cond = ' ON ' . $cond;
    }
    
    // Assemble the JOIN statement
    $join = $type . 'JOIN ' . $table . $cond;
    $this->_stack_push('joins', $join);
    
    return $this;
  }
  
  /**
   * @param int $limit
   * @param int $offset
   *
   * @return mixed
   * @throws \LISE\DataException
   */
  public function Execute($limit = 0, $offset = 0)
  {
    $this->Limit($limit, $offset);
    $this->_compile_query();
    $this->_execute();
    
    return $this->_rs;
  }
  
  /**
   * @param int $number_of_rows
   *
   * @return mixed
   * @throws \LISE\DataException
   */
  public function RSGetArray($number_of_rows = 0)
  {
    $this->Limit($number_of_rows);
    $this->_compile_query();
    $this->_execute();
    
    return $this->_rs->GetArray();
  }
  
  /**
   * @param int $number_of_rows
   *
   * @return mixed
   * @throws \LISE\DataException
   */
  public function RSGetRows($number_of_rows = 0)
  {
    $this->Limit($number_of_rows);
    $this->_compile_query();
    $this->_execute();
    
    return $this->_rs->GetRows();
  }
  
  /**
   * @param bool $force_array
   *
   * @return mixed
   */
  public function RSGetAssoc($force_array = FALSE)
  {
    $this->_compile_query();
    $this->_execute();
    
    return $this->_rs->GetAssoc($force_array);
  }
  
  /**
   * Alias for GetArray
   * @param      $sql
   * @param bool $inputarr
   *
   * @return mixed
   */
  public function Get($sql, $inputarr = FALSE)
  {
    return $this->GetArray($sql, $inputarr);
  }
  
  
  public function GetOne() : \CMSMS\Database\ResultSet
  {
    $args = func_get_args();
    array_unshift($args,__FUNCTION__);
    call_user_func_array([$this, '_run_connection'], $args);
    
    return $this->_rs;
  }
  
  
  public function GetRow() : array
  {
    $args = func_get_args();
    array_unshift($args,__FUNCTION__);
    call_user_func_array([$this, '_run_connection'], $args);
    
    return $this->_rs;
  }
  
  
  public function GetCol() : array
  {
    $args = func_get_args();
    array_unshift($args,__FUNCTION__);
    call_user_func_array([$this, '_run_connection'], $args);
    
    return $this->_rs;
  }
  
  public function GetAll() : array
  {
    $args = func_get_args();
    array_unshift($args,__FUNCTION__);
    call_user_func_array([$this, '_run_connection'], $args);
    
    return $this->_rs;
  }
  
  public function GetArray() : \CMSMS\Database\ResultSet
  {
    $args = func_get_args();
    array_unshift($args,__FUNCTION__);
    call_user_func_array([$this, '_run_connection'], $args);
    
    return $this->_rs;
  }
  
  /**
   * Try to update a record, and if the record is not found,
   * an insert statement is generated and executed.
   * This differs from MySQL's replace which deletes the record and inserts a new record.
   * This also means you cannot update the primary key.
   *
   *
   * @param      $table       = the table name
   * @param      $arrFields   = an associative array where the keys are the field names
   * @param      $keyCols     = the name of the primary key, or an array of field names if it is a compound key
   * @param bool $autoQuote = if true Replace() will quote all values that are non-numeric;
   *
   * auto-quoting will not quote nulls. Note that auto-quoting will not work if you use SQL functions or operators.
   *
   * @return int Returns 0 on failure,
   *                     1 if update statement worked,
   *                     2 if no record was found and the insert was executed successfully.
   */
  public function AdodbLteReplace($table, $arrFields, $keyCols, $autoQuote = false) : int
  {
    $args = func_get_args();
    array_unshift($args,'Replace');
    call_user_func_array([$this, '_run_connection'], $args);
    
    return $this->_rs;
  }
  
  /**
   * Injects a direct SQL statement
   *
   * @param string $sql
   *
   * @return $this
   */
  public function SQL($sql = '') : Query
  {
    $this->_reset_query();
    $this->_query = $sql;
    
    return $this;
  }
  
  /**
   *  Truncates the table
   */
  public function Truncate() : void
  {
    $sql = 'TRUNCATE TABLE ' . $this->_from;
    $this->SQL($sql)->Execute();
  }
  
  
  /**
   * Alias for Execute
   *
   * @param int $limit
   * @param int $offset
   *
   * @return \CMSMS\Database\ResultSet
   * @throws \LISE\DataException
   */
  public function Run($limit = 0, $offset = 0)
  {
    return $this->Execute($limit, $offset);
  }
  
  public function Count()
  {
    $this->_type = self::TYPE_SELECT;
    # RecordCount method is from the RecordSet object
    return $this->Execute()->RecordCount();
  }
  
  /**
   * @param string $select
   * @param string $alias
   *
   * @return mixed
   * @throws \LISE\DataException
   */
  public function SelectMax(string $select = '', string $alias = '')
  {
    return $this->maxMinAvgSum($select, $alias);
  }
  
  /**
   * @param string $select
   * @param string $alias
   *
   * @return mixed
   * @throws \LISE\DataException
   */
  public function SelectMin(string $select = '', string $alias = '')
  {
    return $this->maxMinAvgSum($select, $alias, 'MIN');
  }
  
  /**
   * @param string $select
   * @param string $alias
   *
   * @return array|mixed
   * @throws \LISE\DataException
   */
  public function SelectAvg(string $select = '', string $alias = '')
  {
    return $this->maxMinAvgSum($select, $alias, 'AVG');
  }
  
  /**
   * @param string $select
   * @param string $alias
   *
   * @return array|mixed
   * @throws \LISE\DataException
   */
  public function SelectSum(string $select = '', string $alias = '')
  {
    return $this->maxMinAvgSum($select, $alias, 'SUM');
  }
  
  /**
   * @param string $select
   * @param string $alias
   *
   * @return array|mixed
   * @throws \LISE\DataException
   */
  public function SelectCount(string $select = '', string $alias = '')
  {
    return $this->maxMinAvgSum($select, $alias, 'COUNT');
  }
  
  /**
   * Returns the query after compiled
   * Doesn't execute it
   * @param bool $stripped
   *
   * @return string|string[]|null
   */
  public function GetQuery($stripped = FALSE)
  {
    $this->_compile_query();
    
    $ret = $this->_query;
    
    if($stripped)
    {
      $ret = preg_replace('/\s+/', ' ', $ret);
    }
    
    return $ret;
  }
  
  /**
   * @return $this
   */
  public function ResetQuery() : Query
  {
    $this->_reset_query();
    
    return $this;
  }
  
  /**
   * @return $this
   */
  public function FullReset() : Query
  {
    $this->_reset_all();
    
    return $this;
  }
  
  /**
   * @param $module_name
   *
   * @return $this
   */
  public function SetModuleName($module_name) : Query
  {
    $this->_set_module_name($module_name);
    
    return $this;
  }
  
  /**
   * @param $table_prefix
   *
   * @return $this
   */
  public function SetTablePrefix($table_prefix)
  {
    $this->_set_table_prefix($table_prefix);
    
    return $this;
  }
  
  /**
   * "Count All" query
   */
  public function CountAll()
  {
    $this->_query = 'SELECT COUNT(*) AS c FROM ' . $this->_from;
    $result = $this->GetArray(1);
    return $result[0]['c'];
  }
  
  /**
   * @return string
   */
  public function GetDebugData() : string
  {
    $data = $this->GetQuery();
    $data .= self::NL;
    $data .= 'bindings array("' . implode('","', $this->_values) . '")';
    return $data;
    
  }
  
  /**
   * @return int
   */
  public function InsertId() : int
  {
    return $this->_db->Insert_ID();
  }
  
  /**
   * @return int
   */
  public function Insert_Id() : int
  {
    return $this->InsertId;
  }
  
  /**
   * @return int
   */
  public function GetErrorNumber() : int
  {
    return $this->_db->ErrorNo();
  }
  
  /**
   * @return string
   */
  public function GetErrorMessage() : string
  {
    return $this->_db->ErrorMsg();
  }
  
  /**
   * Try to generate an alias for a table
   * @todo improve the algorithms
   *
   * @param string $table
   *
   * @return string
   */
  public function CreateAliasFromTable(string $table = '') : string
  {
    return $this->_generate_minimal_raw_alias($this->_clean_table_name($table) );
  }
  
  /**
   * @param string $name
   *
   * @return string the generated alias or empty if none could be generated
   */
  private function _generate_minimal_raw_alias(string $name = '') : string
  {
    $ret = '';
    # remove any vowels except if the 1st chr of the str to get something that might resemble a mnemonic
    # and convert it to an array;
    $t1 = $name[0];
    $t2 = substr($name, 1);
    $tmp = array_reverse( str_split( $t1. preg_replace('#[aeiou]+#i', '', $t2) ) );
    
    # prevent infinite loops
    $i = 0; $last = '';
    
    # build an alias from 1 to 20 characters from the mnemonic while checking if already exists
    do
    {
      $last = $ret;
      $ret .= $this->_ll_stack_pop($tmp);
    }
    while($last !== $ret && isset( array_flip($this->_table_aliases_map)[$ret] ) && ++$i <= 20);

    # if $i > 20 then a suitable alias couldn't be found
    if($i > 20) { $ret = ''; }
    
    return $ret;
  }
  
  /**
   * sub queries stuff
   *
   * @param \LISE\Query $from
   * @param string      $alias
   *
   * @return \LISE\Query
   */
  public function FromSubquery(Query $from, string $alias): self
  {
    $this->_from = $this->_build_subquery($from, true, $alias);

    return $this;
  }
  
  public function SelectSubquery(Query $subquery, string $as): self
  {
    $this->_from = $this->_build_subquery($subquery, true, $as);
    
    return $this;
  }
  
  /**
   * @param \LISE\Query $from
   * @param bool        $wrap Wrap the subquery in brackets
   * @param string      $alias Subquery alias
   *
   * @return string
   */
  private function _build_subquery(Query $from, bool $wrap, string $alias) : string
  {
    $ret = $from->GetQuery();
    
    if($wrap)
    {
      $ret = '('. $ret . ')';
    }
    
    $this->_map_alias($ret, $alias);
    
    return $ret;
  }
  
  
  
  
}

?>