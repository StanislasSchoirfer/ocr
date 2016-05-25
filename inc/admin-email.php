<?php

add_action('admin_menu', 'create_theme_options_page');
function create_theme_options_page() {  
	add_options_page('Activites Options', 'Activites Options ', 'administrator', __FILE__, 'build_options_page');
	}
	
	
function build_options_page() {?>  <div id="theme-options-wrap">    <div class="icon32" id="icon-tools"> <br /> </div>
    <h2>Options Activites</h2>    
   
 <form method="post" action="options.php" enctype="multipart/form-data">  <?php settings_fields('activite_options'); ?> 
  <?php do_settings_sections(__FILE__); ?>  
  <p class="submit">
  <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />  </p></form>  
  </div>
 <?php
 }
 
 
 add_action('admin_init', 'register_and_build_fields');
 function register_and_build_fields() {   
 			register_setting('activite_options', 'activite_options', 'validate_setting');
 			
 			add_settings_section('main_section', 'Main Settings', 'section_cb', __FILE__);
 			
 			add_settings_field('email_to_send', 'Email:', 'activity_email_setting', __FILE__, 'main_section');
 }
 
 
 function validate_setting($plugin_options) {   //if i need to sanitaze it
 
  return $plugin_options;
  
  }
 
 
 
 
 function section_cb() {}
 
 
 
 
 // email setts
 function activity_email_setting() {  $options = get_option('activite_options');  
 echo "<input name='activite_options[email_to_send]' type='email' value='{$options['email_to_send']}' />";}

 
 


