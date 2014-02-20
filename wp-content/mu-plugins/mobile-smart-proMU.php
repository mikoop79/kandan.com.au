<?php 
/*
Plugin Name: Mobile Smart Pro MU
Plugin URI: http://www.mobile-smart.co.uk/
Version: v1.2
Author: <a href="http://www.dansmart.co.uk/">Dan Smart</a>
Description: Helper plugin for Mobile Smart Pro
 */
 
include WP_PLUGIN_DIR . "/" . "mobile-smart-pro/mobile-smart-pro.php";

/**
 * MU Helper class
 */
class MobileSmartMU {
    /**
     * Disable any selected plugins
     */
    function disablePlugins($pluginList) {
      if (is_admin()) return $pluginList; // only deactivate on front end
      
      global $mobile_smart;
      
      // get options
      $options = $mobile_smart->getAdminOptions();
      
      // if theme switching enabled
      if ($options['enable_theme_switching'] == true)
      { 
        $is_mobile = $mobile_smart->switcher_isMobile();
        
        if ($is_mobile) {
          if (isset($options['plugins']) && $options['plugins']) {
            
            foreach ($options['plugins'] as $plugin) {
              if (in_array($plugin, $pluginList)) {
                unset($pluginList[array_search($plugin, $pluginList)]);
              }
            }
          }
        }
      }
      
      return $pluginList;
      
    }

}

$MobileSmartMU = new MobileSmartMU();

add_filter('option_active_plugins', array($MobileSmartMU, 'disablePlugins'), 10, 1);