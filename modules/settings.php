<?php 
	
add_action('admin_menu', 'wal_settings_menu');


function wal_settings_menu() {
    global $capability_needed_to_view_settings_menu;
	if ( current_user_can( $capability_needed_to_view_settings_menu ) ) {//et_rapid_options
        add_menu_page(  __('Roles Settings', 'sc'), __('Users by Role Settings', 'sc'), $capability_needed_to_view_settings_menu, 'wws_config1', 'wws_config1');
	} else {
    }


    //$capability_needed_to_view_menu = 'et_rapid_options';
    global $capability_needed_to_view_menu ;
    if( current_user_can( $capability_needed_to_view_menu ) && current_user_can( 'list_users' ) ){
        add_menu_page( 'Users by Role', __('All Users'), $capability_needed_to_view_menu, 'wal_top_menu', 'wal_top_menu' );
		
		global $wp_roles;

		$all_roles = $wp_roles->roles;
		$editable_roles = $all_roles; //apply_filters('editable_roles', $all_roles);
		
				
		$config = get_option('wal_options'); 
		foreach( $editable_roles as $key => $value ){
			if(  @in_array( $value['name'] , $config['hide_users'] ) ) continue;
			add_submenu_page( 'wal_top_menu', $value['name'] , $value['name'], $capability_needed_to_view_menu, $key, 'fn_'.$key );
		}
	}
	
}

function wws_config1(){

?>
<div class="wrap tw-bs">
<h2><?php _e('Settings', 'sc'); ?></h2>
<hr/>
 <?php if(  @wp_verify_nonce($_POST['_wpnonce']) ): ?>
  <div id="message" class="updated" ><?php _e('Settings saved successfully', 'sc'); ?></div>  
  <?php 
 
  $config = get_option('wal_options'); 

	foreach( $_POST as $key=>$value ){
		$wal_options[$key] = $value;
	}
	
	update_option('wal_options', $wal_options );
  ?>
  <?php else:  ?>
  

  
  <?php //exit; ?>
  
  <?php endif; ?> 
<form class="form-horizontal" method="post" action="">
<?php wp_nonce_field();  
$config = get_option('wal_options'); 

//var_dump( $config );


global $wp_roles;

    $all_roles = $wp_roles->roles;
    //$editable_roles = apply_filters('editable_roles', $all_roles);
	$editable_roles = $all_roles;
?>  
<fieldset>  
		  
		  <div class="control-group">  
            <label class="control-label" for="optionsCheckbox">Users to hide from list</label>  
            <div class="controls">
				
              <select name="hide_users[]" multiple="multiple" id="multiSelect">  
                <?php 
				
				foreach( $editable_roles as $key => $value ){
					echo '<option '.( in_array( $value['name'] , $config['hide_users'] ) ? ' selected ' : '' ).' value="'.$value['name'].'">'.$value['name'].'</option>  ';
				}
				?>
              </select>  
			<p class="help-block">Hold CTRL and click on items, you want to hide from menu </p> 
            </div> 
          </div>
		  

		  
          <div class="form-actions">  
            <button type="submit" class="btn btn-primary">Save Settings</button>  
          </div>  
        </fieldset>  

</form>

</div>


<?php 
}
?>