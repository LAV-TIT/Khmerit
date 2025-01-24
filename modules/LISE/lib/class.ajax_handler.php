<?php


namespace LISE;


final class ajax_handler
{
  # backend functions (be_)
  
  /**
   * @param string $instance_name
   *
   * @return string
   * @throws \LISEException
   */
  public static function be_gen_title($instance_name = '') : string
  {
    return api::GenerateTitle($instance_name);
  }
  
  static function be_gen_alias($instance_name = '', $title = '')
  {
    return alias_generator::getInstance()->generate_new($instance_name, $title);
  }
  
  static function be_gen_slug($instance_name = '', $title = '', $iid = -1, $cid = -1)
  {
    if( empty($instance_name) ){ $instance_name = self::InstanceName(); }
    if( empty($title) ){ throw new \Exception('Missing title parameter'); }
    
    return slug_generator::getInstance()->generate_new($instance_name, $title, $iid, $cid);
  }
  
  # frontend functions (fe_)
  
  # static function fe_test(){ return 'test'; }
}

?>