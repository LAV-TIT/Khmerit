<?php

class lisefd_Preview extends LISEFielddefBase
{
	public function __construct($db_info, $caller_object) 
	{
		parent::__construct($db_info, $caller_object);
		$this->SetFriendlyType( $this->ModLang('fielddef_Preview') );
	}
  
  public function IsUnique()
  {
    return TRUE;
  }
  
  public function IsLast()
  {
    return TRUE;
  }
  
  public function CanBeGlobalField()
  {
    return FALSE;
  }

	public function closeTab()
	{
    $fn = $this->GetPath() . DIRECTORY_SEPARATOR . '_close_tab.tpl';
    $smarty = \cms_utils::get_smarty();
    
    if(is_readable($fn))
    {
      $template = @file_get_contents($fn);
    }
    
    $tpl_ob = $smarty->CreateTemplate($template);
    return $tpl_ob->fetch();
	}

	public function displayTabHeader()
	{
    $fn = $this->GetPath() . DIRECTORY_SEPARATOR . '_tab_header.tpl';
    $smarty = \cms_utils::get_smarty();
    
    if(is_readable($fn))
    {
      $template = @file_get_contents($fn);
    }
    
    $tpl_ob = $smarty->CreateTemplate('eval:' . $template);
    $tpl_ob->assign('id', $this->alias);
    $tpl_ob->assign('label', $this->name);
    
    return $tpl_ob->fetch();
	}

	public function RenderInput($id, $returnid)
	{
    # this one needs a different approach
    $fn = $this->GetPath() . DIRECTORY_SEPARATOR . '_input.tpl';
    $smarty = \cms_utils::get_smarty();
    
    if(is_readable($fn))
    {
      $template = @file_get_contents($fn);
    }
    
//    $type = CmsLayoutTemplateType::load($this->caller->GetName() . '::detail');
//    $templates = $type->get_template_list();
//    $list = array();
//
//    if(is_array($templates) && count($templates))
//    {
//      foreach ($templates as $template)
//      {
//        $list[$template->get_id()] = $template->get_name();
//      }
//    }
    $mod = cms_utils::get_module($this->caller);
    $list_all = $mod->ListTemplates();
    $list = [];
    foreach($list_all as $one)
    {
      [$tpl_type, $tpl_name] = explode('_', $one, 2);
      if('detail' === $tpl_type) { $list[$one] = $tpl_name; }
    }
    
    
    $tpl_ob = $smarty->CreateTemplate('eval:' . $template);
    $tpl_ob->assign('detail_templates', $list);
    $tpl_ob->assign('cur_detail_template', $mod->GetPreference('current_detail_template'));
    $tpl_ob->assign('alias', $this->alias);
    
    return $tpl_ob->fetch();
	}
}