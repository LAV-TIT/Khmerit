<?php
#-------------------------------------------------------------------------
# LISE - List It Special Edition
# Version 1.2.2
# A fork of ListI2
# maintained by Fernando Morgado AKA Jo Morg
# since 2015
#-------------------------------------------------------------------------
#
# Original Author: Ben Malen, <ben@conceptfactory.com.au>
# Co-Maintainer: Simon Radford, <simon@conceptfactory.com.au>
# Web: www.conceptfactory.com.au
#
#-------------------------------------------------------------------------
#
# Maintainer since 2011 up to 2014: Jonathan Schmid, <hi@jonathanschmid.de>
# Web: www.jonathanschmid.de
#
#-------------------------------------------------------------------------
#
# Some wackos started destroying stuff since 2012 and stopped at 2014:
#
# Tapio Löytty, <tapsa@orange-media.fi>
# Web: www.orange-media.fi
#
# Goran Ilic, <uniqu3e@gmail.com>
# Web: www.ich-mach-das.at
#
#-------------------------------------------------------------------------
#
# LISE is a CMS Made Simple module that enables the web developer to create
# multiple lists throughout a site. It can be duplicated and given friendly
# names for easier client maintenance.
#
#-------------------------------------------------------------------------
# BEGIN_LICENSE
#-------------------------------------------------------------------------
# This file is part of LISE
# LISE program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# LISE program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
# END_LICENSE
#-------------------------------------------------------------------------

/**
 * LISE Fielddef Base
 *
 * @package LISE
 * @author  Tapio Löytty
 * @since   1.0
 */
abstract class LISEFielddefBase implements ArrayAccess
{
  #---------------------
  # Constants
  #---------------------
  
  const TYPE_STRING    = 'string';
  const TYPE_ARRAY     = 'array';
  const TYPE_OBJECT    = 'object';
  const TYPE_TIMESTAMP = 'timestamp';
  
  #---------------------
  # Variables
  #---------------------
  
  protected $id;
  protected $name;
  protected $alias;
  protected $description;
  protected $type;
  protected $friendlytype;
  protected $value;
  protected $originator;
  protected $active;
  protected $disabled;
  protected $path;
  protected $position;
  protected $required;
  protected $options;
  protected $caller;
  protected $item_id; // deprecated
  protected $parent_array;
  protected $template;
  protected $view;
  protected $hastemplate;
  protected $event_handler;
  
  #---------------------
  # Magic methods
  #---------------------
  
  public function __construct($db_info, $caller_object = NULL)
  {
    $this->id           = -1;
    $this->name         = '';
    $this->alias        = '';
    $this->description  = '';
    $this->type         = $db_info->type;
    $this->originator   = $db_info->originator;
    $this->active       = $db_info->active;
    $this->disabled     = $db_info->disabled;
    $this->path         = $db_info->path;
    $this->friendlytype = $db_info->type;
    $this->value        = new LISEFielddefValue;
    $this->position     = -1;
    $this->required     = 0;
    $this->options      = [];
    $this->caller       = NULL;
    $this->item_id      = -1;
    $this->hastemplate  = FALSE;
    $this->template     = NULL;
    $this->_get_default_template();
    
    if($caller_object instanceof CMSModule)
    {
      $this->caller = $caller_object->GetName();
    }
    
  }
  
  public function __get($key)
  {
    return $this->_overwrite_constants($key);
  }
  
  public function __toString()
  {
    return (string)$this->value;
  }
  
  public function __call($name, $args)
  {
    return FALSE;
  }
  
  #---------------------
  # Array methods
  #---------------------
  #[\ReturnTypeWillChange]
  public function offsetGet($offset)
  {
    return $this->_overwrite_constants($offset);
  }
  #[\ReturnTypeWillChange]
  public function offsetSet($offset, $value) : void { }
  #[\ReturnTypeWillChange]
  public function offsetExists($offset) : bool {return FALSE;}
  #[\ReturnTypeWillChange]
  public function offsetUnset($offset) : void { }
  
  #---------------------
  # Private methods
  #---------------------
  
  /**
   * limits the property access to:
   * name, value, type, alias, template and view
   * mostly when called from a template
   *
   * @param mixed $key
   *
   * @return mixed|null|string
   */
  private function _overwrite_constants($key)
  {
    switch($key)
    {
      case 'name':
        return $this->GetName();
      
      case 'value':
        return $this->GetValue(self::TYPE_STRING);
      
      case 'type':
        return $this->GetType();
      
      case 'alias':
        return $this->GetAlias();
      
      case 'template':
        return $this->GetTemplate();
      
      case 'view':
        return $this->FrontEndRender();
      
      default:
        return NULL;
    }
  }
  
  private function _get_default_template() : bool
  {
    $fn = $this->GetPath() . DIRECTORY_SEPARATOR . 'output.' . $this->GetType() . '.tpl';
    
    if(is_readable($fn))
    {
      $this->template    = @file_get_contents($fn);
      $this->hastemplate = TRUE;
    }
    
    return $this->hastemplate;
  }
  
  #---------------------
  # get/set methods
  #---------------------
  
  final public function GetId() : int
  {
    return $this->id;
  }
  
  final public function SetId($value) : void
  {
    $this->id = $value;
  }
  
  final public function GetName() : string
  {
    return $this->name;
  }
  
  final public function SetName($value) : void
  {
    $this->name = $value;
  }
  
  final public function GetAlias() : string
  {
    return $this->alias;
  }
  
  final public function SetAlias($value) : void
  {
    $this->alias = $value;
  }
  
  final public function GetDesc() : string
  {
    return $this->description;
  }
  
  final public function SetDesc($value) : void
  {
    $this->description = $value;
  }
  
  final public function GetType()
  {
    return $this->type;
  }
  
  final public function GetFriendlyType()
  {
    return $this->friendlytype;
  }
  
  final public function SetFriendlyType($value) : void
  {
    $this->friendlytype = $value;
  }
  
  final public function HasValue() : bool
  {
    if($this->GetValue(self::TYPE_STRING) !== '')
    {
      return TRUE;
    }
    
    return FALSE;
  }
  
  final public function GetValue($type = self::TYPE_OBJECT)
  {
    $type = strtolower($type);
    
    switch($type)
    {
      case self::TYPE_STRING:
        return (string)$this->value;
      
      case self::TYPE_ARRAY:
        return (array)$this->value;
      
      case self::TYPE_TIMESTAMP:
        return strtotime((string)$this->value);
      
      default:
        return $this->value;
    }
  }
  
  final public function SetValue($value = [])  : void
  {
    $this->value = new LISEFielddefValue($value);
  }
  
  final public function GetOriginator()
  {
    return $this->originator;
  }
  
  final public function IsActive() : bool
  {
    return $this->active ? TRUE : FALSE;
  }
  
  final public function IsDisabled() : bool
  {
    return $this->disabled ? TRUE : FALSE;
  }
  
  // deprecated
  final public function GetActive()
  {
    return $this->active;
  }
  
  final public function GetPosition()
  {
    return $this->position;
  }
  
  final public function SetPosition($value)
  {
    $this->position = $value;
  }
  
  final public function GetPath()
  {
    return $this->path;
  }
  
  final public function GetURLPath() : string
  {
    $config = cmsms()->GetConfig();
    
    $url = substr($this->GetPath(), strlen($config['root_path']));
    $url = str_replace(DIRECTORY_SEPARATOR, '/', $url);
    $url = $config->smart_root_url() . $url;
    
    return $url;
  }
  
  final public function IsRequired() : bool
  {
    return $this->required ? TRUE : FALSE;
  }
  
  final public function GetRequired() : string
  {
    return (string)$this->required;
  }
  
  final public function SetRequired($value) : void
  {
    $this->required = $value;
  }
  
  final public function GetItemId()
  {
    return $this->GetParentItem()->item_id;
  }
  
  final public function GetItemAlias()
  {
    return $this->GetParentItem()->alias;
  }
  
  // deprecated
  final public function SetItemId($value)
  {
    $this->item_id = $value;
  }
  
  final public function GetParentArray()
  {
    if(isset($this->parent_array))
    {
      return $this->parent_array;
    }
    
    return FALSE;
  }
  
  final public function SetParentArray(LISEFielddefArray &$obj) : void
  {
    $this->parent_array = $obj;
  }
  
  final public function GetParentItem()
  {
    if($this->GetParentArray())
    {
      if($this->GetParentArray()->GetParentItem())
      {
        return $this->GetParentArray()->GetParentItem();
      }
    }
    
    return FALSE;
  }
  
  final public function SetTemplate($content) : void
  {
    $this->template = $content;
  }
  
  final public function GetTemplate()
  {
    return $this->template;
  }
  
  final public function HasTemplate() : bool
  {
    return $this->hastemplate;
  }
  
  #---------------------
  # Option methods
  #---------------------
  
  final public function GetOptionValues() : array
  {
    return $this->options;
  }
  
  final public function GetOptionValue($key, $default = '')
  {
    return isset($this->options[$key]) ? $this->options[$key] : $default;
  }
  
  final public function SetOptionValue($key, $value) : void
  {
    $this->options[$key] = $value;
  }
  
  #---------------------
  # Overwrite methods
  #---------------------
  
  static public function GetModuleDeps()
  {
    return NULL;
  }
  
  public function GetHeaderHTML()
  {
    $ret = NULL;
    
    $fn = $this->GetPath() . DIRECTORY_SEPARATOR . 'header.' . $this->GetType() . '.tpl';
    
    if(is_readable($fn))
    {
      $ret    = @file_get_contents($fn);
      $smarty = cmsms()->GetSmarty();
      $smarty->assign('fielddefdir', $this->GetURLPath());
      $ret = $smarty->fetch('eval:' . $ret);
    }
    
    return $ret;
  }
  
  public function IsUnique()
  {
    return FALSE;
  }
  
  public function IsLast()
  {
    return FALSE;
  }
  
  public function RenderForAdminListing($id, $returnid)
  {
    $rn = 'list.' . $this->GetType() . '.tpl';
    $fn = $this->GetPath() . DIRECTORY_SEPARATOR . $rn;

    if( is_readable($fn) )
    {
      $smarty = cmsms()->GetSmarty();
      $smarty->assign('actionid', $id);
      $smarty->assign('returnid', $returnid);
      $smarty->assign('value', $this->GetValue() );
      $smarty->assign('fielddef', $this);
      
      $param2 = $this->caller . ':' . $this->originator;
  
      return $smarty->fetch('lisetemplate:fielddefs;' . $param2 . ';' . $this->alias . ';'  . $rn);
    }
    
    return $this->GetValue(self::TYPE_STRING);
  }
  
  public function RenderForEdit($id, $returnid)
  {
    $rn = 'admin.' . $this->GetType() . '.tpl';
    $fn = $this->GetPath() . DIRECTORY_SEPARATOR . $rn;
    
    if( is_readable($fn) )
    {
      $smarty = cmsms()->GetSmarty();
      $smarty->assign('actionid', $id);
      $smarty->assign('returnid', $returnid);
      $smarty->assign('value', $this->GetValue() );
      $smarty->assign('fielddef', $this);
  
      $param2 = $this->caller . ':' . $this->originator;
  
      return $smarty->fetch('lisetemplate:fielddefs;' . $param2 . ';' . $this->alias . ';'  . $rn);
    }
    
    return '';
  }
  
  public function RenderInput($id, $returnid)
  {
    $rn = 'input.' . $this->GetType() . '.tpl';
    $fn = $this->GetPath() . DIRECTORY_SEPARATOR . $rn;
    
    if( is_readable($fn) )
    {
      $smarty = cmsms()->GetSmarty();
      $smarty->assign('actionid', $id);
      $smarty->assign('returnid', $returnid);
      $smarty->assign('value', $this->GetValue() );
      $smarty->assign('fielddef', $this);
  
      $param2 = $this->caller . ':' . $this->originator;
  
      return $smarty->fetch('lisetemplate:fielddefs;' . $param2 . ';' . $this->alias . ';'  . $rn);
    }
    
    return '';
  }
  
  public function FrontEndRender($params = array())
  {
    if(empty($this->view) && $this->hastemplate)
    {
      $smarty = cmsms()->GetSmarty();
      $smarty->assign('name', $this->name);
      $smarty->assign('value', $this->value);
      $smarty->assign('type', $this->type);
      $smarty->assign('alias', $this->alias);
      $smarty->assign('params', $params);
      $this->view = $smarty->fetch('string:' . $this->GetTemplate());
    }
    else
    {
      $this->view = '';
    }
    
    return $this->view;
  }
  
  /**
   * a shorter alias to FrontEndRender() method
   */
  public function View($params = array())
  {
    return $this->FrontEndRender($params);
  }
  
  public function Validate(&$errors): void
  {
    if($this->GetValue(self::TYPE_STRING) == '' && $this->IsRequired())
    {
      $errors[] = $this->ModLang('required_field_empty') . ' (' . $this->GetName() . ')';
    }
  }
  
  #---------------------
  # Event handler
  #---------------------
  
  /************************************
   * NOTICE: Highly experimental
   ************************************/
  
  // Should i make this final or not, lets leave it like this for now.
  public function EventHandler()
  {
    // Check if field has own event handler
    if(!isset($this->event_handler))
    {
      
      $fn = $this->GetPath() . DIRECTORY_SEPARATOR . 'liseeh.' . $this->GetType() . '.php';
      if(is_readable($fn))
      {
        
        require_once($fn);
        
        $class = 'liseeh_' . $this->GetType();
        if(class_exists($class))
        {
          $this->event_handler = new $class($this);
        }
      }
    }
    
    // Ensure that we have default event handler
    if(!isset($this->event_handler))
    {
      $this->event_handler = new LISEEventHandlerBase($this);
    }
    
    return $this->event_handler;
  }
  
  #---------------------
  # Module methods
  #---------------------
  
  final public function GetModuleInstance($caller = FALSE)
  {
    if($caller && !is_null($this->caller))
    {
      return cmsms()->GetModuleInstance($this->caller);
    }
    
    return cmsms()->GetModuleInstance($this->originator);
  }
  
  #---------------------
  # Lang methods
  #---------------------
  
  final public function ModLang()
  {
    $mod = $this->GetModuleInstance();
    if(!is_object($mod))
    {
      throw new \LISE\Exception('Could not retrive module instance from originator!');
    }
    //throw new LISEException('Could not retrive module instance from originator!'); // <- Send own missing lang string instead of failure?
    $args = func_get_args();
    
    return call_user_func_array(array($mod, 'lang'), $args);
  }
  
} // end of class

/**
 * LISE Fielddef value
 *
 * @package LISE
 * @author  Tapio L
 * @since   1.3.1
 */
class LISEFielddefValue extends ArrayObject
{
  #---------------------
  # Magic methods
  #---------------------
  
  public function __construct($array = [])
  {
    foreach((array)$array as $key => $value)
    {
      
      $this->offsetSet($key, $value);
    }
  }
  
  public function __toString()
  {
    return (string)implode(LISE_VALUE_SEPARATOR, (array)$this);
  }
  
} // end of class
?>