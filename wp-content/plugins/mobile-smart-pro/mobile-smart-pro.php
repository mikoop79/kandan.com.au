<?php
/*
Plugin Name: Mobile Smart Pro
Plugin URI: http://www.mobile-smart.co.uk/
Version: v1.2.1
Author: <a href="http://www.dansmart.co.uk/">Dan Smart</a>
Description: Mobile Smart Pro contains helper tools for mobile devices +  switching mobile themes. <a href="/wp-admin/options-general.php?page=mobile-smart-pro.php">Settings</a>
             determination of mobile device type or tier in CSS and PHP code, using
             detection by Mobile ESP project.
 */

/*  Copyright 2012 Dan Smart  (email : dan@dansmart.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
 * Attributation:
 *  - Detection performed by MobileESP project code (www.mobileesp.com)
 *  - plugin disabling adapted from http://wordpress.org/extend/plugins/plugin-organizer/
 * - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */


// -------------------------------------------------------------------------
// Defines
// -------------------------------------------------------------------------
define('MOBILESMART_DOMAIN', 'mobilesmart');
define('MOBILESMART_PLUGIN_PATH', WP_PLUGIN_DIR . '/mobile-smart-pro');
define('MOBILESMART_PLUGIN_PATH_REL', '/mobile-smart-pro');
define('MOBILESMART_PLUGIN_URL', WP_PLUGIN_URL .'/mobile-smart-pro');

// MAIN DEVICES (for more, see lib/mdetect.php which can be detected directly)
define ('MOBILE_DEVICE_OPERA_MINI', 'operamini');
define ('MOBILE_DEVICE_IPHONE', 'iphone');
define ('MOBILE_DEVICE_IPAD', 'ipad');
define ('MOBILE_DEVICE_IPOD', 'ipod');
define ('MOBILE_DEVICE_ANDROID', 'android');
define ('MOBILE_DEVICE_ANDROID_WEBKIT', 'android_webkit');
define ('MOBILE_DEVICE_ANDROID_TABLET', 'android table');
define ('MOBILE_DEVICE_SERIES60', 'series_60');
define ('MOBILE_DEVICE_SYMBIAN_OS', 'symbian_os');
define ('MOBILE_DEVICE_WINDOWS_MOBILE', 'windows_mobile');
define ('MOBILE_DEVICE_WINDOWS_PHONE_7', 'windows_phone_7');
define ('MOBILE_DEVICE_BLACKBERRY', 'blackberry');
define ('MOBILE_DEVICE_BLACKBERRY_TABLET', 'blackberry_tablet');
define ('MOBILE_DEVICE_BLACKBERRY_WEBKIT', 'blackberry_webkit');
define ('MOBILE_DEVICE_BLACKBERRY_TOUCH', 'blackberry_touch');
define ('MOBILE_DEVICE_PALM_OS', 'palm_os');
define ('MOBILE_DEVICE_OTHER', 'other_mobile');

// TIERS
define ('MOBILE_DEVICE_TIER_TOUCH', 'mobile-tier-touch');
define ('MOBILE_DEVICE_TIER_TABLET', 'mobile-tier-tablet');
define ('MOBILE_DEVICE_TIER_RICH_CSS', 'mobile-tier-rich-css');
define ('MOBILE_DEVICE_TIER_SMARTPHONE', 'mobile-tier-smartphone');
define ('MOBILE_DEVICE_TIER_OTHER', 'mobile-tier-other-mobile');

// MANUAL SWITCHING
define ('MOBILESMART_SWITCHER_GET_PARAM', 'mobile_switch');
define ('MOBILESMART_SWITCHER_MOBILE_STR', 'mobile');
define ('MOBILESMART_SWITCHER_DESKTOP_STR', 'desktop');
define ('MOBILESMART_SWITCHER_COOKIE', 'mobile-smart-switcher');
define ('MOBILESMART_SWITCHER_COOKIE_EXPIRE', 3600); // 3600
define ('MOBILESMART_SWITCHER_DOMAIN_SWITCH', 'domain_switch');
define ('MOBILESMART_SWITCHER_DOMAIN_SWITCH_DOMAIN', 'mobile_domain');


// SOME DUMMY TIER SCREEN DIMENSIONS FOR TRANSCODING IMAGES
define ('MOBILE_DEVICE_TIER_TOUCH_MAX_WIDTH', 300);
define ('MOBILE_DEVICE_TIER_TOUCH_MAX_HEIGHT', 400);
define ('MOBILE_DEVICE_TIER_TABLET_MAX_WIDTH', 1024);
define ('MOBILE_DEVICE_TIER_TABLET_MAX_HEIGHT', 768);
define ('MOBILE_DEVICE_TIER_RICH_CSS_MAX_WIDTH', 300);
define ('MOBILE_DEVICE_TIER_RICH_CSS_MAX_HEIGHT', 400);
define ('MOBILE_DEVICE_TIER_SMARTPHONE_MAX_WIDTH', 200);
define ('MOBILE_DEVICE_TIER_SMARTPHONE_MAX_HEIGHT', 250);
define ('MOBILE_DEVICE_TIER_OTHER_MAX_WIDTH', 100);
define ('MOBILE_DEVICE_TIER_OTHER_MAX_HEIGHT', 150);

// -------------------------------------------------------------------------
// Includes
// -------------------------------------------------------------------------
require_once('lib/mdetect.php');
require_once('mobile-smart-switcher-widget.php');

// -------------------------------------------------------------------------
// Plugin Class
// -------------------------------------------------------------------------
if (!class_exists("MobileSmart"))
{
  class MobileSmart extends uagent_info
  {
    // -------------------------------------------------------------------------
    // Attributes
    // -------------------------------------------------------------------------
    var $admin_optionsName = "MobileSmartOptions";
    var $admin_options = array('mobile_theme'=>'default',
                               'enable_theme_switching'=>true);

    var $device = ''; // current device
    var $device_tier = ''; // current device tier

    var $switcher_cookie = null;
    
    var $detectmobile = false;
    var $detect_from_domain = false;
    var $detect_from_cookie = false;

    // -------------------------------------------------------------------------
    // Methods
    // -------------------------------------------------------------------------

    // -------------------------------------------------------------------------
    // Method: Constructor
    // -------------------------------------------------------------------------
    // PHP 4 version
    function MobileSmart()
    {
      // init parent constructor
      parent::uagent_info();
      
      // translations
      load_plugin_textdomain(MOBILESMART_DOMAIN, false, MOBILESMART_PLUGIN_PATH_REL.'/language');

      if (isset($_COOKIE[MOBILESMART_SWITCHER_COOKIE]))
      {
        $this->switcher_cookie = $_COOKIE[MOBILESMART_SWITCHER_COOKIE];
        //echo "Construct cookie: $this->switcher_cookie<br/><br/>";
      }
    }
    
    // PHP 5 version
    function __construct()
    {
      $this->MobileSmart();
    }

    // -------------------------------------------------------------------------
    // Method: initialisePlugin
    // Description: WP initialisation of the plugin
    // -------------------------------------------------------------------------
    function initialisePlugin()
    {
      // initialise the admin options
      $this->addAdminOptions();

      // idea about moving MU plugins taken from http://wordpress.org/extend/plugins/plugin-organizer/
      if (!file_exists(ABSPATH . "wp-content/mu-plugins/")) {
  			@mkdir(ABSPATH . "wp-content/mu-plugins/");
  		}

  		if (file_exists(ABSPATH . "wp-content/mu-plugins/mobile-smart-proMU.php")) {
  			@unlink(ABSPATH . "wp-content/mu-plugins/mobile-smart-proMU.php");
  		}
  		
  		if (file_exists(WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)) . "/lib/mobile-smart-proMU.php")) {
  			@copy(WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)) . "/lib/mobile-smart-proMU.php", ABSPATH . "wp-content/mu-plugins/mobile-smart-proMU.php");
  		}
    }
    
    /**
     * Plugin deactivation
     */
    function deactivatePlugin() {
      if (file_exists(ABSPATH . "wp-content/mu-plugins/mobile-smart-proMU.php")) {
  			@unlink(ABSPATH . "wp-content/mu-plugins/mobile-smart-proMU.php");
  		}
    }

    // -------------------------------------------------------------------------
    // Method: addAdminOptions
    // Description: add the options
    // -------------------------------------------------------------------------
    function addAdminOptions()
    {
      add_option($this->admin_optionsName, $this->admin_options);
    }

    // -------------------------------------------------------------------------
    // Method: getAdminOptions
    // Description: gets the admin panel options
    // -------------------------------------------------------------------------
    function getAdminOptions()
    {
      // get the options from WP
      $wp_options = get_option($this->admin_optionsName);

      // if already existing data
      if (!empty($wp_options))
      {
        // populate our adminOptions with wp options
        foreach($wp_options as $key=>$wp_option)
        {
          $this->admin_options[$key] = $wp_option;
        }
      }

      // update WP
      update_option($this->admin_optionsName, $this->admin_options);

      return $this->admin_options;
    }
    
    
    /**
     * Set meta data option from a checkbox in the admin
     * @param array $options
     * @param type $meta_key
     * @param type $label
     * @return array status message array
     */
    private function adminSetOptionFromCheckbox(&$options, $meta_key, $label)
    {
      $status_message = array();
      if (isset($_POST[$meta_key]))
      {
        // enable theme switching
        if ($options[$meta_key] != true)
        {
          $options[$meta_key] = true;

          $status_message = array('updated', $label.' : '.__('enabled', MOBILESMART_DOMAIN));
        }
      }
      else
      {
        // disable theme switching
        if ($options[$meta_key] != false)
        {
          $options[$meta_key] = false;

          $status_message = array('updated', $label.' : '.__('disabled', MOBILESMART_DOMAIN));
        }
      }

      return $status_message;
    }
    
    /**
     * Set meta data option from a checkbox in the admin
     * @param array $options
     * @param type $meta_key
     * @param type $label
     * @return array status message array
     */
    private function adminSetOptionFromTextboxURL(&$options, $meta_key, $label)
    {
      $status_message = array();
      if (isset($_POST[$meta_key]))
      {
        $options[$meta_key] = filter_var($_POST[$meta_key], FILTER_SANITIZE_URL);

        $status_message = array('updated', $label.' : '.__('saved', MOBILESMART_DOMAIN));
      }
      else
      {
        $options[$meta_key] = '';

        $status_message = array('updated', $label.' : '.__('saved', MOBILESMART_DOMAIN));
      }

      return $status_message;
    }
    
    /**
     * Set the disabled plugin meta data option from the admin
     * @param array $options
     * @param type $label
     * @return array status message array
     */
    private function adminSetDisabledPlugins(&$options, $label)
    {
      $status_message = array();
      if (isset($_POST['plugins']))
      {
        $options['plugins'] = $_POST['plugins'];
        
        $status_message = array('updated', $label.' : '.__('added plugins to the disabled list', MOBILESMART_DOMAIN));
      }
      else
      {
        // disable theme switching
        if ($this->getOption($options, 'plugins') != false)
        {
          $options['plugins'] = false;

          $status_message = array('updated', $label.' : '.__('all active plugins enabled on mobile theme', MOBILESMART_DOMAIN));
        }
      }

      return $status_message;
    }
    
    /**
     * get option value
     */
    private function getOption($options, $option_name) {
      $options = $this->getAdminOptions();
      
      if (isset($options[$option_name])) {
        return $options[$option_name];
      }
      
      return false;
    }

    // -------------------------------------------------------------------------
    // Method: displayAdminOptions
    // Description: displays the admin panel
    // -------------------------------------------------------------------------
    function displayAdminOptions()
    {
      $options = $this->getAdminOptions();
      
      $themes = get_themes();
      
      $current_tab = (isset($_GET['tab']) ? $_GET['tab'] : 1);
      
      /*echo '<pre>';
      print_r($_POST);
      echo '</pre>';*/

      if (isset($_POST['submit']))
      {
        $status_messages = array();
        
        switch ($current_tab)
        {
          case 1:
            // Enable / Disable theme switching
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'enable_theme_switching', __('Theme switching', MOBILESMART_DOMAIN));
            
            // Get choice of mobile theme
            if ($this->getOption($options, 'mobile_theme') != $_POST['theme'])
            {
              $theme_name = $_POST['theme'];

              if (array_key_exists($theme_name, $themes))
              {
                $options['mobile_theme'] = $themes[$theme_name]['Template'];
                $options['mobile_theme_stylesheet'] = $themes[$theme_name]['Stylesheet'];

                $status_messages[] = array('updated', __('Mobile theme updated to: ', MOBILESMART_DOMAIN) . $_POST['theme']);
              }
            }
            
            // Enable / Disable switching for tablets
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'switch_for_tablets', __('Switching for Tablets', MOBILESMART_DOMAIN));
            break;
          case 2:
            // Enable / Disable domain switching
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'enable_domain_switching', __('Domain Switching', MOBILESMART_DOMAIN));
            
            // Save Domain Switching URL
            $status_messages[] = $this->adminSetOptionFromTextboxURL($options, 'mobile_domain', __('Mobile Domain', MOBILESMART_DOMAIN));
            break;
          case 3:
            // Enable / Disable manual switching
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'enable_manual_switch', __('Manual theme switching', MOBILESMART_DOMAIN));
            
            // Enable / Disable footer manual switching
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'enable_manual_switch_in_footer', __('Manual theme switching in footer', MOBILESMART_DOMAIN));

            // Enable / Disable desktop manual switching
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'allow_desktop_switcher', __('Manual theme switching on desktop', MOBILESMART_DOMAIN));
            break;
          case 4:
            // Enable / Disable image transcoding
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'enable_image_transcoding', __('Image transcoding', MOBILESMART_DOMAIN));
            break;
          case 5:
            // Enable / Disable mobile pages
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'enable_mobile_pages', __('Mobile Pages', MOBILESMART_DOMAIN));
            
            // Enable / Disable mobile menus
            $status_messages[] = $this->adminSetOptionFromCheckbox($options, 'enable_mobile_menus', __('Mobile Menus', MOBILESMART_DOMAIN));
            break;
          case 6:
            $status_messages[] = $this->adminSetDisabledPlugins($options, __('Mobile Plugins', MOBILESMART_DOMAIN));
            break;
        }

        // output status messages
        if (!empty($status_messages))
        {
          ?>
            <div class="updated">
              <?php foreach ($status_messages as $message) : ?>
                <p><strong><?php echo $message[1] ?></strong></p>
              <?php endforeach; ?>
            </div>
          <?php
        }

        // update the options
        update_option($this->admin_optionsName, $options);
      }

      // Display the admin page
      ?>
      <script type="text/javascript">
      </script>
      <div class="wrap">
        <style type="text/css" media="all">
          
          #mobilesmart_infobox {
            border: 1px solid #999;
            padding: 10px; margin: 10px;
            background-color: #efefef;
            float: right;
            width: 200px;
          }
          
          #mobilesmart_infobox .subsection {
            border: 1px solid #cdcdcd;
            padding: 10px; margin: 10px 0;
          }
        </style>
          <h2>Mobile Smart Pro</h2>
          <div id="mobilesmart_infobox">
            <div class="subsection clearfix">
              <h3>Mobile Smart Newsletter</h3>
              <!-- Begin MailChimp Signup Form -->
              <div id="mc_embed_signup">
              <form action="http://dansmart.us2.list-manage.com/subscribe/post?u=d2059b426acf8c7232bd417a2&amp;id=eddd2b41ad" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                  <p><label for="mce-EMAIL">Sign up for Mobile Smart updates, plus articles on developing websites for mobile devices and WordPress. </label>
                  <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required/></p>
                  <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
              </form>
              </div>

              <!--End mc_embed_signup-->
            </div>
          </div>
          <div id="mobilesmart_main_container">
            <p><em><strong>Mobile theme switching and more</strong></em></p>
            <p><strong>Tabs overview:</strong><br/><em>Mobile Theme: Set the mobile theme to be displayed when viewed on a mobile device</br>
              Domain Switching: Redirect to a mobile domain (e.g. m.yourdomain.com) when viewed on a mobile device<br/>
              Manual Switching: Add a link in footer (or widget) allowing user to switch between mobile and desktop versions<br/>
              Transcoding: Resize images to mobile scale<br/>
              Mobile Pages: Mobile versions of normal page content, and mobile-only menus<br/>
              Plugins: Disable selected plugins when you're on a mobile theme</em>
            </p>
            <?php
              function display_active_tab($tab, $current_tab)
              { 
                if ($current_tab == $tab) {
                  echo 'nav-tab-active';
                }
              }
            ?>
            <h3 class="nav-tab-wrapper">
              <a href="<?php echo add_query_arg('tab', 1); ?>" class="nav-tab <?php display_active_tab(1, $current_tab); ?>">Mobile Theme</a>
              <a href="<?php echo add_query_arg('tab', 2); ?>" class="nav-tab <?php display_active_tab(2, $current_tab); ?>">Domain Switching</a>
              <a href="<?php echo add_query_arg('tab', 3); ?>" class="nav-tab <?php display_active_tab(3, $current_tab); ?>">Manual Switching</a>
              <a href="<?php echo add_query_arg('tab', 4); ?>" class="nav-tab <?php display_active_tab(4, $current_tab); ?>">Transcoding</a>
              <a href="<?php echo add_query_arg('tab', 5); ?>" class="nav-tab <?php display_active_tab(5, $current_tab); ?>">Mobile Pages</a>
              <a href="<?php echo add_query_arg('tab', 6); ?>" class="nav-tab <?php display_active_tab(6, $current_tab); ?>">Mobile Plugins</a>
            </h3>
            <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
              <?php
                switch ($current_tab)
                {
                  case 1: $this->displayAdminTabMobileTheme($options, $themes); break;
                  case 2: $this->displayAdminTabDomainSwitching($options); break;
                  case 3: $this->displayAdminTabManualSwitching($options); break;
                  case 4: $this->displayAdminTabTranscoding($options); break;
                  case 5: $this->displayAdminTabMobilePages($options); break;
                  case 6: $this->displayAdminTabMobilePlugins($options); break;
                  default: $this->displayAdminTabMobileTheme($options, $themes); break;
                }
              ?>

              <div class="submit">
                <input type="submit" name="submit" value="<?php _e('Update Settings', 'MobileSmart'); ?>"/>
              </div>
            </form>
          </div>
      </div>
      <?php
    }
    
    /**
     * display mobile theme admin tab
     * @param type $options
     * @param type $themes 
     */
    function displayAdminTabMobileTheme($options, $themes)
    {
      ?>
      <h3>Mobile Theme</h3>
      
      <h4>Mobile Switching</h4>
      <p>Enable switching via user agent detection:</p>
      <label for="enable_theme_switching">Enable <input type="checkbox" name="enable_theme_switching" id="enable_theme_switching" <?php if ($this->getOption($options, 'enable_theme_switching')) { echo "checked"; } ?>/></label>
      
      <p>Choose the mobile theme that will be displayed when a mobile device is detected.</p>
        <label for="theme">Mobile theme: <select id="theme" name="theme">
            <?php
              foreach ($themes as $theme_name => $theme)
              {
                ?>
                <option value="<?php echo $theme_name; ?>" <?php if ($theme['Template'] == $this->getOption($options, 'mobile_theme')) { echo "selected"; } ?>><?php echo $theme['Name']; ?></option>
                <?php
              }
            ?>
          </select></label>
      
      <h4>Tablets</h4>
      <p>
        <em>Most people choose to show the desktop theme on tablets such as iPads. You may wish to enable your mobile theme and pull
        in a tablet specific stylesheet and/or other content via the mobile theme.</em></p>
      <p>
        <label for="switch_for_tablets">Enable theme switching for tablets (e.g. iPad):  <input type="checkbox" name="switch_for_tablets" id="switch_for_tablets" <?php if ($this->getOption($options, 'switch_for_tablets')) { echo "checked"; } ?>/></label>
      </p>
      <?php
    }
    
    /**
     * Display domain switching tab
     * @param type $options 
     */
    function displayAdminTabDomainSwitching($options)
    {
      ?>
      <h3>Domain Switching</h3>
      
      <p>If a user arrives at your mobile subdomain, you can automatically switch to the mobile theme by enabling domain switching.</p>
      <p>If you also have manual switching enabled, manual switching will take priority - so they will be redirected to the desktop version of the site
         until they switch back.</p>
      <p>
        <label for="enable_domain_switching"><strong>Enable domain switching: </strong> <input type="checkbox" name="enable_domain_switching" id="enable_domain_switching" <?php if ($this->getOption($options, 'enable_domain_switching')) { echo "checked"; } ?>/></label>
      </p>
      
      <p>
        <label for="mobile_domain"><strong>Your mobile domain: </strong> <input type="text" name="mobile_domain" value="<?php echo $this->getOption($options, 'mobile_domain'); ?>"/></label><em> You must enable domain switching and have a subdomain for this to function correctly.</em>
      </p>
      <br/>
      <h4><em>Notes on subdomains and DNS</em></h4>
      <p><em>To use a mobile subdomain, you'll need to go to your DNS control panel (domain name), and create either an A record or a CNAME record
         pointing to the same location. An A record would point the to the same IP address, a CNAME record would point to the main domain.</em></p>
      <p><em>If you're on shared hosting, you may need to get your hosting provider to add your mobile subdomain as a 'parked domain'
         to your account so that the server points you to your existing account.</em></p>
      <?php
    }
    
    /**
     * display Transcoding admin tab
     * @param type $options 
     */
    function displayAdminTabTranscoding($options)
    {
      ?>
      <h3>Transcoding</h3>
      
      <h4>In development: Enable image transcoding</h4>
      
      <p>Do not enable this unless you want to try the TimThumb powered image transcoding. Make sure you enable your cache folder to 777.</p>
      <p><em>Manual switching (above) must be enabled for this to work properly.</em></p>
      <label for="enable_image_transcoding">Enable image transcoding <input type="checkbox" name="enable_image_transcoding" id="enable_image_transcoding" <?php if ($this->getOption($options, 'enable_image_transcoding')) { echo "checked"; } ?>/>
      </label>
      <?php
    }
    
    /**
     * Display Manual Switching admin tab
     * @param type $options 
     */
    function displayAdminTabManualSwitching($options)
    {
      ?>
      <h3>Manual Switching</h3>
      
      <h4>Enable Manual Switcher</h4>
      <p>You can add a link to your pages which will allow the user to manually select the version
       (desktop or mobile) that they want. Once you enable Manual Switching, you can use either the
       footer link or the Mobile Smart Manual Switcher widget.</p>
      <label for="enable_manual_switch"><strong>Enable Manual Switcher:</strong> <input type="checkbox" name="enable_manual_switch" id="enable_manual_switch" <?php if ($this->getOption($options, 'enable_manual_switch')) { echo "checked"; } ?>/>
      </label><br/>

      <h4>Enable a Manual Switcher link in the footer</h4>
      <p><em>Manual switching (above) must be enabled for this to work properly.</em></p>
      <label for="enable_manual_switch_in_footer"><strong>Enable Manual Switcher in footer:</strong> <input type="checkbox" name="enable_manual_switch_in_footer" id="enable_manual_switch_in_footer" <?php if ($this->getOption($options, 'enable_manual_switch_in_footer')) { echo "checked"; } ?>/>
      </label><br/>

      <h4>Allow manual switching on desktop</h4>
      <p>This is most useful for debugging your themes. You probably
      do not want to allow your users to switch to the mobile version whilst viewing on a desktop in other cases.</p>
      <p><em>Manual switching (above) must be enabled for this to work properly.</em></p>
      <label for="allow_desktop_switcher"><strong>Enable Manual Switcher Link whilst on Desktop</strong> <input type="checkbox" name="allow_desktop_switcher" id="allow_desktop_switcher" <?php if ($this->getOption($options, 'allow_desktop_switcher')) { echo "checked"; } ?>/>
      </label>
      <?php
    }
    
    /**
     * Display Mobile Pages admin tab
     * @param type $options 
     */
    function displayAdminTabMobilePages($options)
    {
      ?>
      <h3>Mobile Pages</h3>
      
      <h4>Mobile content</h4>
      <p>It can be beneficial to have mobile versions of your content, specifically targeted at the smaller mobile pages. Once enabled, on each Edit Post or Edit Page (or other custom post types) screen
         you will see a box called 'Mobile Pages', which you can enter mobile-specific content in. If you do not add any content, it will just use
         the existing content.</p>
      <p>
        <label for="enable_mobile_pages"><strong>Enable Mobile content</strong> <input type="checkbox" name="enable_mobile_pages" <?php if ($this->getOption($options, 'enable_mobile_pages')) { echo "checked"; } ?>/></label>
      </p>
      <h4>Mobile menus</h4>
      <p>You may wish to have mobile-only menus. This adds mobile-specific versions of your theme locations, so that
         you can assign mobile-specific menus to them. If there is no menu assigned, it will use your existing menu.
         <em>Note: this only works with wp_nav_menu().</em></p>
      <p>
        <label for="enable_mobile_menus"><strong>Enable Mobile menus</strong> <input type="checkbox" name="enable_mobile_menus" <?php if ($this->getOption($options, 'enable_mobile_menus')) { echo "checked"; } ?>/></label>
      </p>
      <?php
    }
    
    /**
     * display Transcoding admin tab
     * @param type $options 
     */
    function displayAdminTabMobilePlugins($options)
    {
      ?>
      <h3>Mobile Plugins</h3>
      
      <h4>Mobile Device: Disable plugins</h4>
      
      <p>Check the box of any plugin you want to temporarily disable when your site is showing the mobile theme. The plugin will <em>not</em> be disabled or deactivated, and will not run its deactivation routine. This is
         purely a temporary disabling for the individual user viewing the site with the mobile theme.</p>
      <?php $plugins = get_plugins();
      
          if (! current_user_can( 'activate_plugins' ) ) {
            echo 'You do not have privileges to manage plugins';
            return;
          }
      
          if (!empty($plugins)) : ?>
          <ul>
      <?php foreach ($plugins as $plugin_key => $plugin) : 
              $checked = (isset($options['plugins']) && $options['plugins'] && in_array($plugin_key, $options['plugins']) ? 'checked="checked"' : '');
      ?>
            <li><input type="checkbox" <?php echo $checked; ?> name="plugins[]" value="<?php echo $plugin_key; ?>"/> <label for="plugin"><?php echo $plugin['Name']; ?>
                - <small><?php if ( is_plugin_active($plugin_key) ) : echo 'Currently Active'; else : echo 'Currently Inactive'; endif; ?></small></li>      
      <?php endforeach; ?>
          </ul>
      <?php endif;
      ?>
      <?php
    }

    // ---------------------------------------------------------------------------
    // Function: getUserAgentString
    // Description: gets the user agent string
    // ---------------------------------------------------------------------------
    function getUserAgentString()
    {
      return $this->Get_Uagent();
    }

    // ---------------------------------------------------------------------------
    // Function: getAcceptString
    // Description: gets the accept string
    // ---------------------------------------------------------------------------
    function getAcceptString()
    {
      return $this->Get_HttpAccept();
    }

    // ---------------------------------------------------------------------------
    // Function: getCurrentDevice
    // Description: gets the current device
    // ---------------------------------------------------------------------------
    function getCurrentDevice()
    {
      if ($this->device == '')
      {
        if ($this->DetectOperaMini())
        {
          $this->device = MOBILE_DEVICE_OPERA_MINI;
        }
        else if ($this->DetectIpad())
        {
          $this->device = MOBILE_DEVICE_IPAD;
        }
        else if ($this->DetectIphone())
        {
          $this->device = MOBILE_DEVICE_IPHONE;
        }
        else if ($this->DetectIpod())
        {
          $this->device = MOBILE_DEVICE_IPOD;
        }
        else if ($this->DetectAndroid())
        {
          $this->device = MOBILE_DEVICE_ANDROID;
        }
        else if ($this->DetectAndroidTablet())
        {
          $this->device = MOBILE_DEVICE_ANDROID_TABLET;
        }
        else if ($this->DetectAndroidWebkit())
        {
          $this->device = MOBILE_DEVICE_ANDROID_WEBKIT;
        }
        else if ($this->DetectSeries60())
        {
          $this->device = MOBILE_DEVICE_SERIES60;
        }
        else if ($this->DetectSymbianOS())
        {
          $this->device = MOBILE_DEVICE_SYMBIAN_OS;
        }
        else if ($this->DetectWindowsMobile())
        {
          $this->device = MOBILE_DEVICE_WINDOWS_MOBILE;
        }
        else if ($this->DetectWindowsPhone7())
        {
          $this->device = MOBILE_DEVICE_WINDOWS_PHONE_7;
        }
        else if ($this->DetectBlackBerry())
        {
          $this->device = MOBILE_DEVICE_BLACKBERRY;
        }
        else if ($this->DetectBlackBerryTablet())
        {
          $this->device = MOBILE_DEVICE_BLACKBERRY_TABLET;
        }
        else if ($this->DetectBlackBerryWebkit())
        {
          $this->device = MOBILE_DEVICE_BLACKBERRY_WEBKIT;
        }
        else if ($this->DetectBlackBerryTouch())
        {
          $this->device = MOBILE_DEVICE_BLACKBERRY_TOUCH;
        }
        else if ($this->DetectPalmOS())
        {
          $this->device = MOBILE_DEVICE_PALM_OS;
        }
        else if ($this->DetectIsMobile())
        {
          $this->device = MOBILE_DEVICE_OTHER;
        }
        // To do...add the rest
      }
      return $this->device;
    }

    // ---------------------------------------------------------------------------
    // Function: getCurrentDeviceTier
    // Description: gets the current device tier
    // ---------------------------------------------------------------------------
    function getCurrentDeviceTier()
    {
      if ($this->device_tier == '')
      {
        if ($this->DetectTierTablet())
        {
          $this->device_tier = MOBILE_DEVICE_TIER_TABLET;
        }
        if ($this->DetectTierIphone())
        {
          $this->device_tier = MOBILE_DEVICE_TIER_TOUCH;
        }
        if ($this->DetectTierRichCSS())
        {
          $this->device_tier = MOBILE_DEVICE_TIER_RICH_CSS;
        }
        if ($this->DetectTierRichCss())
        {
          $this->device_tier = MOBILE_DEVICE_TIER_SMARTPHONE;
        }
        if ($this->DetectTierOtherPhones())
        {
          $this->device_tier = MOBILE_DEVICE_TIER_OTHER;
        }
      }

      return $this->device_tier;
    }


    // ---------------------------------------------------------------------------
    // Function: filter_add_body_classes
    // Description: adds device specific CSS class to the body
    // - Filter: see add_filter('body_class'...)
    // ---------------------------------------------------------------------------
    function filter_addBodyClasses($classes)
    {
      $options = $this->getAdminOptions();

      // if theme switching enabled
      if ($this->getOption($options, 'enable_theme_switching') == true)
      {
        // if is a mobile device
        if ($this->DetectIsMobile())
        {
          $classes[] .= "mobile" ;
        }

        // add current device string to body class
        $classes[] .= $this->getCurrentDevice();

        // add the tier of device also to body class
        $classes[] .= $this->getCurrentDeviceTier();
      }

      return $classes;
    }

    // ---------------------------------------------------------------------------
    // Function: filter_switchTheme
    // Description: switches the theme if it's a mobile device to the specified theme
    // - Filter: see add_filter('template'...)
    // ---------------------------------------------------------------------------
    function filter_switchTheme($theme)
    {
      // get options
      $options = $this->getAdminOptions();

      // if theme switching enabled
      if ($this->getOption($options, 'enable_theme_switching') == true)
      { 
        // if is a mobile device or is mobile due to cookie switching
        if ($this->switcher_isMobile())
        { 
          $theme = $this->getOption($options, 'mobile_theme');
        }
      }

      return $theme;
    }
    
    // ---------------------------------------------------------------------------
    // Function: filter_switchTheme_stylesheet
    // Description: switches the theme if it's a mobile device to the specified theme - stylesheet - for child themes
    // - Filter: see add_filter('template'...)
    // ---------------------------------------------------------------------------
    function filter_switchTheme_stylesheet($theme)
    {
      // get options
      $options = $this->getAdminOptions();

      // if theme switching enabled
      if ($this->getOption($options, 'enable_theme_switching') == true)
      {
        // if is a mobile device or is mobile due to cookie switching
        if ($this->switcher_isMobile())
        {
          $theme = $this->getOption($options, 'mobile_theme_stylesheet');
        }
      }

      return $theme;
    }

     //---------------------------------------------------------------------------
     // Function: switcher_isMobile
     // Description: determines whether the mode is mobile or switched
     // ---------------------------------------------------------------------------
     function switcher_isMobile()
     {
        $is_mobile = false;

        // get the mobile detect value
        $detectmobile = $this->DetectIsMobile();
        $detect_domain = $this->DetectMobileDomain();
        
        if ($detect_domain === true)
        {
          $detectmobile |= $detect_domain;
        }

        // check the switcher cookie
        $is_mobile = $this->switcher_getMobileCookieDetect($detectmobile);

        //echo "Is Mobile: ".($is_mobile ? "true" : "false")."<br/><br/>";

        return $is_mobile;
     }
     
     /**
      * Detect if it's mobile from the cookie - overrides mobile status
      * @param boolean $detectmobile
      * @return boolean
      */
     function switcher_getMobileCookieDetect($detectmobile)
     {
       if (!$this->detect_from_cookie)
       {
          // check the switcher cookie
        if ($detectmobile && $this->switcher_cookie)
        {
          if (($this->switcher_cookie == MOBILESMART_SWITCHER_DESKTOP_STR))
          {
            $is_mobile = false;
          }
          else
          {
            $is_mobile = true;
          }
        }
        // if we're not a mobile, then we invert the check string
        else if (!$detectmobile)
        {
          if (($this->switcher_cookie == MOBILESMART_SWITCHER_MOBILE_STR))
          {
            $is_mobile = true;
          }
          else
          {
            $is_mobile = false;
          }
        }
        else
        {
          $is_mobile = $detectmobile;
        }
          
          $this->detect_from_cookie = $is_mobile;
       }

        //echo "Is Mobile: ".($is_mobile ? "true" : "false")."<br/><br/>";

        return $this->detect_from_cookie;
     }
     
     /**
      * is it a mobile device (including iPad)
      * @return boolean
      */
     function DetectIsMobile()
     {
       if (!$this->detectmobile)
       {
         $options = $this->getAdminOptions();
         $is_mobile =  false;

         if ($this->getOption($options, 'switch_for_tablets'))
         {
           $is_mobile =  $this->DetectMobileQuick() || $this->DetectIpad();
         }
         else
         {
           $is_mobile = $this->DetectMobileQuick();
         }
         
         $this->detectmobile = $is_mobile;
       }
       
       return $this->detectmobile;
     }
     
     /**
      * Detect if is a mobile domain
      * @return boolean 
      */
     function DetectMobileDomain()
     {
       if (!$this->detect_from_domain)
       {
         $options = $this->getAdminOptions();
         $is_mobilesubdomain = false;

         if ($this->getOption($options, 'enable_domain_switching')
             && (stripos($_SERVER['HTTP_HOST'], $this->getOption($options, 'mobile_domain')) !== false))
         {
            $is_mobilesubdomain = true;
         }
         
         $this->detect_from_domain = $is_mobilesubdomain;
       }
        
       return $this->detect_from_domain;
     }
     
     /**
      * can we redirect to a mobile domain
      * @return string
      */
     function switcher_canRedirectDomain($is_mobile)
     {
       $options = $this->getAdminOptions();
       $redirect = false;
       
       if ($this->getOption($options, 'enable_domain_switching'))
       {
         // if not is mobile device (could be cookie switched) and we're on the mobile domain, then redirect to main domain
         if (!$is_mobile && (stripos($_SERVER['HTTP_HOST'], $this->getOption($options, 'mobile_domain')) !== false))
         {
            $redirect = site_url();
         }
         // else if we're mobile device and not on mobile domain then redirect to mobile domain
         else if ($is_mobile && (stripos($_SERVER['HTTP_HOST'], $this->getOption($options, 'mobile_domain')) === false))
         {
             $redirect = (is_ssl() ? 'https://' : 'http://') . $this->getOption($options, 'mobile_domain');
         }
         
         if ($redirect)
         {
           if (isset($_SERVER['REQUEST_URI']))
           {
	    	  $redirect .= $_SERVER['REQUEST_URI'];
           }
           else if (isset($_SERVER['REDIRECT_URL']) && $_SERVER['REDIRECT_URL'])
           {
             $redirect .= $_SERVER['REDIRECT_URL'];
           }
           if ((stripos($redirect, '?') === false) && isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'])
           {
             $redirect .= '?'.$_SERVER['QUERY_STRING'];
           }
         }
       }
       
       return $redirect;
     }

     // ---------------------------------------------------------------------------
     // Function: addSwitcherLink
     // Description: checks if the plugin option is enabled and if so adds the html switcher
     // ---------------------------------------------------------------------------
     function addSwitcherLink()
     {
        // get options
        $options = $this->getAdminOptions();

        // if theme switching enabled
        if ($this->getOption($options, 'enable_manual_switch') == true)
        {
          // if is a mobile device or cookie switcher allows it.
          $is_mobile = $this->switcher_isMobile();
          if ($is_mobile || $this->getOption($options, 'allow_desktop_switcher'))
          {
            ?>
      <!-- START MobileSmart - Switcher - http://www.dansmart.co.uk/ -->
      <div id="mobilesmart_switcher">
        <?php if ($is_mobile) : ?>
          <a href="<?php echo $this->get_switcherLink(MOBILESMART_SWITCHER_DESKTOP_STR); ?>"><?php _e('Switch to desktop version', MOBILESMART_DOMAIN); ?></a>
        <?php else : ?>
          <a href="<?php echo $this->get_switcherLink(MOBILESMART_SWITCHER_MOBILE_STR); ?>"><?php _e('Switch to mobile version', MOBILESMART_DOMAIN); ?></a>
        <?php endif; ?>
      </div>
      <!-- END MobileSmart - Switcher - http://www.dansmart.co.uk/ -->
            <?php
          }
        }
     }

     // ---------------------------------------------------------------------------
     // Function: action_addSwitcherLinkInFooter
     // Description: action call for too add link into wp_footer
     // ---------------------------------------------------------------------------
     function action_addSwitcherLinkInFooter()
     {
        // get options
        $options = $this->getAdminOptions();

        // if theme switching enabled
        if ($this->getOption($options, 'enable_manual_switch') == true && $this->getOption($options, 'enable_manual_switch_in_footer') == true)
        {
          // display the link
          $this->addSwitcherLink();
        }
     }
    
    /**
     * Modify a URL
     */ 
    function modify_url($original_link) {
       // get options
      $options = $this->getAdminOptions();
      
      $new_link = $original_link;
    
      if (!$this->getOption($options, 'enable_domain_switching')) return $original_link;
      
      $is_mobile = $this->switcher_isMobile();
      
      // we need to rewrite the permalink to the domain switched url only if on a mobile site
      if ($is_mobile) {
        $domain = (is_ssl() ? 'https://' : 'http://') . $this->getOption($options, 'mobile_domain');
      
        $new_link = str_replace(home_url(), $domain, $original_link);
      }
      
      return $new_link;
    }
    
     /**
      * Run init action
      */
     function action_init()
     {
        // get options
        $options = $this->getAdminOptions();

        // if theme switching enabled
        if ($this->getOption($options, 'enable_theme_switching') == true)
        { 
          $is_mobile = $this->switcher_isMobile();

          // if is a mobile device or is mobile due to cookie switching
          if ($is_mobile)
          { 
            // run redirect if necessary
            $redirect = $this->switcher_canRedirectDomain($is_mobile);
            
            if ($redirect && !is_admin())
            {
              wp_redirect($redirect);
              exit();
            }
          }
          else {
            $redirect = $this->switcher_canRedirectDomain($is_mobile);
            
            if ($redirect && !is_admin())
            {
              wp_redirect($redirect);
              exit();
            }
          }
        }
     }
    
    /**
     * Add Google Webmasters head
     */ 
    function action_head() {
      $options = $this->getAdminOptions();
      
      $is_mobile = $this->switcher_isMobile();
      
      if ($is_mobile) {
        $root = site_url();
      }
      else {
        $root = (is_ssl() ? 'https://' : 'http://') . $this->getOption($options, 'mobile_domain');
      }
      
      $redirect = $this->generateRedirectLink($root);
      
      if ($is_mobile) :
        ?>
        <link rel="canonical" href="<?php echo $redirect; ?>" >
        <?php
      else :
       ?>
       <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo $redirect; ?>" >
       <?php
      endif;
    }
    
    /**
     * Generate the redirect link
     */
    function generateRedirectLink($root) {
      $redirect = $root;
         
       if ($redirect)
       {
         if (isset($_SERVER['REQUEST_URI']))
         {
    	  $redirect .= $_SERVER['REQUEST_URI'];
         }
         else if (isset($_SERVER['REDIRECT_URL']) && $_SERVER['REDIRECT_URL'])
         {
           $redirect .= $_SERVER['REDIRECT_URL'];
         }
         if ((stripos($redirect, '?') === false) && isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'])
         {
           $redirect .= '?'.$_SERVER['QUERY_STRING'];
         }
       }
       return $redirect;

    }

    // ---------------------------------------------------------------------------
    // Function: get_switcherLink
    // Description: gets the link to display the switcher
    // Parameters: version - should be 'mobile' or 'desktop'
    // ---------------------------------------------------------------------------
    function get_switcherLink($version)
    {
      $switcher_str = add_query_arg (array (MOBILESMART_SWITCHER_GET_PARAM => $version));

      return $switcher_str;
    }

    // ---------------------------------------------------------------------------
    // Function: action_addSwitcherLink
    // Description: checks if the html switcher link has been called and acts appropriately
    // ---------------------------------------------------------------------------
    function action_handleSwitcherLink()
    {
      if (isset($_GET[MOBILESMART_SWITCHER_GET_PARAM]))
      {
        // get the version
        $version = $_GET[MOBILESMART_SWITCHER_GET_PARAM];

        // set the cookie to say which version it is
        setcookie(MOBILESMART_SWITCHER_COOKIE,
                  $version,
                  time()+MOBILESMART_SWITCHER_COOKIE_EXPIRE,
                  COOKIEPATH,
                  COOKIE_DOMAIN,false,false);

        // save version in class for viewing the page before a refresh
        $this->switcher_cookie = $version;

        //echo "Version to set: $version<br/>";
        //echo "Set version: $this->switcher_cookie<br/><br/>";
      }
    }
    
    // ---------------------------------------------------------------------------
    // Function: isTierTablet
    // Description: is the current device tier - table
    // ---------------------------------------------------------------------------
    function isTierTablet()
    {
      return $this->getCurrentDeviceTier() == MOBILE_DEVICE_TIER_TABLET;
    }

    // ---------------------------------------------------------------------------
    // Function: isTierTouch
    // Description: is the current device tier - touch
    // ---------------------------------------------------------------------------
    function isTierTouch()
    {
      return $this->getCurrentDeviceTier() == MOBILE_DEVICE_TIER_TOUCH;
    }
    
    // ---------------------------------------------------------------------------
    // Function: isTierRichCSS
    // Description: is the current device tier - Rich CSS
    // ---------------------------------------------------------------------------
    function isTierRichCSS()
    {
      return $this->getCurrentDeviceTier() == MOBILE_DEVICE_TIER_RICH_CSS;
    }

    // ---------------------------------------------------------------------------
    // Function: isTierSmartphone
    // Description: is the current device tier - smartphone
    // ---------------------------------------------------------------------------
    function isTierSmartphone()
    {
      return $this->getCurrentDeviceTier() == MOBILE_DEVICE_TIER_SMARTPHONE;
    }

    // ---------------------------------------------------------------------------
    // Function: isTierOtherMobile
    // Description: is the current device tier - other mobile devices (non-smartphone / non-touch)
    // ---------------------------------------------------------------------------
    function isTierOtherMobile()
    {
      return $this->getCurrentDeviceTier() == MOBILE_DEVICE_TIER_OTHER;
    }

     /**
      * Magic function - to catch old naming scheme of method with decapitalised first character. Change was caused by inclusion of mdetect.php
      * @param type $name
      * @param type $arguments 
      */
     function __call($name, $arguments)
     {
       $old_naming_scheme = ucwords($name);
       
       // check for method with capitalised first character - for backwards compatibility, as previous plugin had lowercase first characters in method name
       if (method_exists($this, $old_naming_scheme))
       {
         $name($arguments);
       }
     }

     // ------------------------------------------------------------------------
     // Function: filter_processContent
     // Description: processes the post's content and transcodes the post's images
     // Credits: idea and regexp taken from wpmp_transcoder.php, but brought into
     //          MobileSmart domain with improvements
     // ------------------------------------------------------------------------
     function filter_processContent($the_content)
     {
       $options = $this->getAdminOptions();
       
       // only process the content if we're in mobile mode
      if (!$this->switcher_isMobile() || !$this->getOption($options, 'enable_image_transcoding'))
        return $the_content;
     
       preg_match_all("/\<img.* src=((?:'[^']*')|(?:\"[^\"]*\")).*\>/Usi", $the_content, $images);

       foreach ($images[0] as $images_key=>$image)
       {
        $img_src = $images[1][$images_key];

        // remove the site url
        $site_url = str_replace('/', '\/', get_bloginfo('siteurl'));
        $img_src = preg_replace("/[\"|']".$site_url."(.*)[\"|']/", '\1', $img_src);

        // get the width and height
        preg_match_all("/(width|height)[=:'\"\s]*(\d+)(?:px|[^\d])/Usi", $image, $img_dimensions);

        $width = 0; $height = 0;
        foreach ($img_dimensions[2] as $dim_index=>$dim_val)
        {
          if ($img_dimensions[1][$dim_index] == 'height')
            $height = $dim_val;
          else if ($img_dimensions[1][$dim_index] == 'width')
            $width = $dim_val;
        }

        // * * * * * * *
        // to do: get max dimensions of images for each device / tier from somewhere like WURFL
        switch ($this->device_tier)
        {
          case MOBILE_DEVICE_TIER_TOUCH: $max_width = MOBILE_DEVICE_TIER_TOUCH_MAX_WIDTH; $max_height = MOBILE_DEVICE_TIER_TOUCH_MAX_HEIGHT; break;
          case MOBILE_DEVICE_TIER_TABLET: $max_width = MOBILE_DEVICE_TIER_TABLET_MAX_WIDTH; $max_height = MOBILE_DEVICE_TIER_TABLET_MAX_HEIGHT; break;
          case MOBILE_DEVICE_TIER_SMARTPHONE: $max_width = MOBILE_DEVICE_TIER_SMARTPHONE_MAX_WIDTH; $max_height = MOBILE_DEVICE_TIER_SMARTPHONE_MAX_HEIGHT; break;
          case MOBILE_DEVICE_TIER_RICH_CSS: $max_width = MOBILE_DEVICE_TIER_RICH_CSS_MAX_WIDTH; $max_height = MOBILE_DEVICE_TIER_RICH_CSS_MAX_HEIGHT; break;
          case MOBILE_DEVICE_TIER_OTHER: $max_width = MOBILE_DEVICE_TIER_OTHER_MAX_WIDTH; $max_height = MOBILE_DEVICE_TIER_OTHER_MAX_HEIGHT; break;
          default: $max_width = 100; $max_height = 100; break;
        }
        // * * * * * * *

        // rescale image
        if ($width > $max_width)
        {
          $height = floor($width / $max_width) * $height;
          $width = $max_width;
        }

        if ($height > $max_height)
        {
          $width = floor($height / $max_height) * $width;
          $height = $max_height;
        }

        // create new rescaled image
        $rescaled_image = '<img src="'.MOBILESMART_PLUGIN_URL.'/includes/timthumb.php?src='.$img_src.'&w='.$width.'&h='.$height.'&zc=0"'
                          .' width="'.$width.'"'.' height="'.$height.'"'.'/>';

        // replace the entire text of the old image with the text of the resized image
        $the_content = str_replace($image, $rescaled_image, $the_content);
       }

       return $the_content;
     }
     
     /**
      * Add mobile pages post type
      */
     function mobilePages_init()
     {
       $options = $this->getAdminOptions();
       
       if ($this->getOption($options, 'enable_mobile_pages'))
       {
          // add the meta box to each post type
          $post_types=get_post_types('','names'); 

          foreach ($post_types as $post_type)
          {
            add_meta_box( 
              'mobileSmart_mobilePage'
              ,__( 'Mobile Version', MOBILESMART_DOMAIN )
              ,array( &$this, 'mobilePages_displayMetaBox' )
              ,$post_type
              ,'normal'
              ,'high'
            );
          }
       }
     }
     
      /**
       * Prep for TinyMCE editor
       */
      function mobilePages_adminHead()
      {
        global $post;
        
        $options = $this->getAdminOptions();

        if ($this->getOption($options, 'enable_mobile_pages'))
        {
          wp_enqueue_script(array('jquery', 'editor', 'thickbox', 'media-upload'));
          wp_enqueue_style('thickbox');

          wp_tiny_mce(false, array('editor_selector' => 'mobileSmart_mobilePage'));
        }
      }
     
     /**
      * Display the meta box
      * @param type $post 
      */
     function mobilePages_displayMetaBox($post)
     {
       $mobilePage_content = $this->mobilePages_getContent($post->ID);
       
       // compatibility with WordPress 3.3 - wp_editor only works with version 3.3 or after
       if (function_exists('wp_editor')) {
         wp_editor($mobilePage_content, 'mobileSmartmobilePage');
       }
       else // if not, just show an empty textbox for the moment
       {
         ?>
      <textarea name="mobileSmartmobilePage" cols="80" rows="7" style="width:100%;"><?php echo $mobilePage_content; ?></textarea>
      <?php
       }
     }
     
     /**
      * Get the mobile pages content for a post
      * @param type $post_id
      * @return string 
      */
     function mobilePages_getContent($post_id)
     {
       return get_post_meta($post_id, 'mobileSmart_mobilepages', true);
     }
     
     /**
      * Save the mobiel pages content
      * @param type $post_id
      * @param type $content 
      */
     function mobilePages_storeContent($post_id, $content)
     {
       update_post_meta($post_id, 'mobileSmart_mobilepages', $content);
     }
     
     /**
      * Save mobile page data
      * @global type $post
      * @param type $post_id
      * @return type 
      */
     function mobilePages_save($post_id)
     {
       // verify if this is an auto save routine. 
       // If it is our form has not been submitted, so we dont want to do anything
       if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
          return;
       
       $options = $this->getAdminOptions();
       
       if ($this->getOption($options, 'enable_mobile_pages'))
       {
         global $post;
         
         // Check permissions
          if ( !current_user_can( 'edit_post', $post_id ) )
              return;
         
          // save post data
          if (isset($_POST['mobileSmartmobilePage']))
          {
            $this->mobilePages_storeContent($post_id, $_POST['mobileSmartmobilePage']);
          }
       }
     }
     
     /**
      * Display the content if it exists
      * @global obj $post
      * @param type $content 
      */
     function mobilePages_the_content($content = false)
     {
       $options = $this->getAdminOptions();
       
       if ($this->getOption($options, 'enable_mobile_pages'))
       {
         if ($this->switcher_isMobile())
         {
           global $post;

           $mobile_content = $this->mobilePages_getContent($post->ID);

           if ($mobile_content)
           {
             $content = $mobile_content;
           }
         }
       }
       
       return $content;
     }
     
     /**
      * Adds mobile menu locations (if enabled) 
      */
     function mobileMenus_add_menus()
     { 
       $options = $this->getAdminOptions();
       
       if ($this->getOption($options, 'enable_mobile_menus'))
       {
          // get list of locations
          $locations = get_registered_nav_menus();
          $mobile_locations = array();

          // create mobile versions
          foreach ($locations as $location_name=>$location)
          {
            $mobile_locations['mobile-'.$location_name] = 'Mobile version of '.$location;
          }

          // register mobile versions
          register_nav_menus($mobile_locations);
       }
     }
     
     /**
      * Filter nav menu to override menu
      * @param type $args
      * @return type 
      */
     function mobileMenus_wp_nav_menu_args($args)
     {
       $options = $this->getAdminOptions();
       
       if ($this->getOption($options, 'enable_mobile_menus'))
       {
         if ($this->switcher_isMobile())
         {
           $location = $args['theme_location'];
           
           $locations = get_registered_nav_menus();
           
           // if mobile location exists, and has a nav menu attached to that location
           if (array_key_exists('mobile-'.$location, $locations) && has_nav_menu('mobile-'.$location))
           {
             $args['theme_location'] = 'mobile-'.$location;
           }
         }
       }
       
       return $args;
     }
     
     function mobileSidebars_init() {
       /*$sidebars = wp_get_sidebars_widgets();
       echo "<pre>";
       print_r($sidebars);
       
       global $wp_registered_sidebars;
       print_r($wp_registered_sidebars);
       echo "</pre>";
       die();*/
     }
     
     function mobileSidebars_control() {
       global $wp_registered_widgets;
       global $wp_registered_widget_controls;
       
       foreach ( $wp_registered_widgets as $id => $widget )
       {	// controll-less widgets need an empty function so the callback function is called.
        	if (!$wp_registered_widget_controls[$id])
        		wp_register_widget_control($id,$widget['name'], 'mobileSidebars_emptyControl');
        		
          // replace the current callback with our own callback, and save the existing callback to be called by our own method
          $wp_registered_widget_controls[$id]['callback_mobilesmart_redirect'] = $wp_registered_widget_controls[$id]['callback'];
        	$wp_registered_widget_controls[$id]['callback'] = 'mobileSidebars_mobileControl';
        	array_push($wp_registered_widget_controls[$id]['params'],$id);	
       }
       
     }
     
     /**
      * adds the checkbox for each widget
      */
     function mobileSidebars_mobileControl($params) {
      global $wp_registered_widget_controls;
      
      $options = $this->getAdminOptions();

      // get widget id
      $id = array_pop($params);
  
      // go to the original control function for the widget
      $callback = $wp_registered_widget_controls[$id]['callback_mobilesmart_redirect'];
      if ( is_callable($callback) )
          call_user_func_array($callback, $params);       
  
      // value should be true by default
      $value = isset( $options['mobileSidebar-'.$id] ) ? $options['mobileSidebar-'.$id] : true;
  
      // dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
      $number = $params[0]['number'];
      if ($number == -1) {
          $number = "%i%"; 
          $value = "";
      }
      $id_disp=$id;
      if ( isset($number) ) 
          $id_disp = $wp_registered_widget_controls[$id]['id_base'].'-'.$number;

       ?>
        <fieldset style="border: 1px solid #999; padding: 5px; margin: 10px 0;">
          <legend>Mobile Smart Pro</legend>
        <p>
          <label for="<?php echo $id_disp; ?>-mobileSmartShowMobile">Show widget on mobile device?</label>
          <input type="checkbox" value="show-mobile" name="<?php echo $id_disp; ?>-mobileSmartShowMobile" id="<?php echo $id_disp; ?>-mobileSmartShowMobile" <?php echo $value ? 'checked="checked"' : ''; ?>/>
        </p>
        </fieldset>
       <?php
     }
     
     function mobileSidebars_emptyControl() {
       // empty
     }
     
    /**
     * Callback to save widget content
     */
    function mobileSidebars_ajax_update_callback($instance, $new_instance, $old_instance, $this_widget)
    {
      $options = $this->getAdminOptions();
      
    	$widget_id = $this_widget->id;
    	
    	if ( isset($_POST[$widget_id.'-mobileSmartShowMobile']))
    	{
        $value = true;
    	}
    	else {
    	  $value = 0;
      }
      
      $options['mobileSidebar-'.$widget_id] = $value;
    	
  	  // update the options
		  update_option($this->admin_optionsName, $options);
    	return $instance;
    }
    
    /**
     * only display the sidebar if needed
     */
    function mobileSidebars_filter_sidebars_widgets($sidebars_widgets) {
    
      $options = $this->getAdminOptions();
      
      if ($this->switcher_isMobile()) {
      	// loop through every widget in every sidebar (barring 'wp_inactive_widgets') checking WL for each one
      	foreach($sidebars_widgets as $widget_area => $widget_list)
      	{
      	  if ($widget_area == 'wp_inactive_widgets' || empty($widget_list)) continue;
      
      		foreach ($widget_list as $pos => $widget_id)
      		{
      		  // only hide on mobile if explicitly set
      			$display_on_mobile = isset($options['mobileSidebar-'.$widget_id]) ?	$options['mobileSidebar-'.$widget_id] : true;
  
      			if (!$display_on_mobile && $this->switcher_isMobile())
      				unset($sidebars_widgets[$widget_area][$pos]);
      		}
      	}
      }
    	return $sidebars_widgets;
    }
     
  } // MobileSmart
}

/**
 * Callbacks
 */

function mobileSidebars_mobileControl() {
   global $mobile_smart;
   
   $params = func_get_args();
   
   $mobile_smart->mobileSidebars_mobileControl($params);
}

function mobileSidebars_emptyControl() {
   global $mobile_smart;
   $mobile_smart->mobileSidebars_emptyControl();
}

function mobileSidebars_ajax_update_callback($instance, $new_instance, $old_instance, $this_widget)
{
  global $mobile_smart;
  return $mobile_smart->mobileSidebars_ajax_update_callback($instance, $new_instance, $old_instance, $this_widget);
}



// -------------------------------------------------------------------------
// Instantiate class
// -------------------------------------------------------------------------
if (class_exists("MobileSmart"))
{
  $mobile_smart = new MobileSmart();
}


// -------------------------------------------------------------------------
// Actions and Filters
// -------------------------------------------------------------------------
if (isset($mobile_smart))
{
  // Activation
  register_activation_hook(__FILE__, array(&$mobile_smart, 'initialisePlugin'));
  register_deactivation_hook(__FILE__, array(&$mobile_smart, 'deactivatePlugin'));

  // Switcher {
    // Actions
    add_action('admin_menu', 'MobileSmart_ap');
    add_action('setup_theme', array($mobile_smart, 'action_handleSwitcherLink'));
    add_action('wp_footer', array($mobile_smart, 'action_addSwitcherLinkInFooter'));
    add_action('init', array($mobile_smart, 'action_init'));
    add_action('wp_head', array($mobile_smart, 'action_head'));

    // Filters
    add_filter('body_class', array(&$mobile_smart, 'filter_addBodyClasses'));
    add_filter('template', array(&$mobile_smart, 'filter_switchTheme'));
    add_filter('stylesheet', array(&$mobile_smart, 'filter_switchTheme_stylesheet'));
    
    add_filter('post_link', array(&$mobile_smart, 'modify_url'));
    add_filter('walker_nav_menu_start_el', array(&$mobile_smart, 'modify_url'));
    add_filter('the_category', array($mobile_smart, 'modify_url'));
    add_filter('the_terms', array($mobile_smart, 'modify_url'));
    add_filter('the_content', array($mobile_smart, 'modify_url'));
 // } End Switcher

  // Content transformation {
    // Filters
    add_filter('the_content', array(&$mobile_smart, 'filter_processContent'));
  // } End Content transformation
    
  // Mobile Pages {
    // Actions
    add_action('add_meta_boxes', array(&$mobile_smart, 'mobilePages_init'));
    add_action( 'save_post', array(&$mobile_smart, 'mobilePages_save'));
    
    // Mobile menu
    add_action('init', array($mobile_smart, 'mobileMenus_add_menus'));
    
    // Sidebars
    add_action('init', array($mobile_smart, 'mobileSidebars_init'));
    if (is_admin()) {
      add_action('sidebar_admin_setup', array($mobile_smart, 'mobileSidebars_control'));
      add_filter('widget_update_callback', 'mobileSidebars_ajax_update_callback', 10, 4); 				// widget changes submitted by ajax method
    }
    else  {
      add_filter( 'sidebars_widgets', array($mobile_smart, 'mobileSidebars_filter_sidebars_widgets'), 10, 1);
    }
    
    // Filters
    add_filter('the_content', array(&$mobile_smart, 'mobilePages_the_content'), 1, 1);
    
    add_filter('wp_nav_menu_args', array($mobile_smart, 'mobileMenus_wp_nav_menu_args'), 1, 1);
  // } End Mobile Pages
}

// -------------------------------------------------------------------------
// initialise the Admin Panel
// -------------------------------------------------------------------------
if (!function_exists("MobileSmart_ap"))
{
  function MobileSmart_ap()
  {
    global $mobile_smart;

    if (!isset($mobile_smart)) return;

    // add the options page
    if (function_exists('add_options_page'))
    {
      add_options_page("Mobile Smart Pro", "Mobile Smart Pro", 9, basename(__FILE__),
                       array(&$mobile_smart, 'displayAdminOptions'));
    }
  }
}

?>
