<?php 
add_action('admin_init', 'wwa_save_intercept', 100); 
function wwa_save_intercept(){
		global $pagenow;
		if ( !current_user_can( 'edit_users' ) && $pagenow == 'profile.php' ){
			$_POST["_wpnonce"] = 'a'; //TODO: fix this
		}	
		#var_dump( $_POST );

}

add_Action('admin_footer', 'wal_data_order');
function wal_data_order(){
	global $pagenow;

    // ---------- never show Users menu, except to admin.  We use Users by Role, instead -BEGIN- -----------------
    if (!current_user_can('update_core')) {
        echo '
	    <style>
		#menu-users{
			display:none;

		}
		</style>';
    }
    // ---------- never show Users menu, except to admin.  We use Users by Role, instead -END- -----------------



    // --------------- Handle Users/User Role Editor -BEGIN- ----------------------------
    if (!current_user_can('update_core')) {
        echo '
	    <style>
		.capabilities{
			display:none;

		}
		</style>';
    }
    // --------------- Handle Users/User Role Editor -End- ----------------------------

//    $capability_needed_to_view_menu = 'et_rapid_list_operational_users';
//	if ( !current_user_can( $capability_needed_to_view_menu ) && $pagenow == 'profile.php'  ) {
//		echo '
//	<style>
//		#menu-users{
//			display:none;
//		}
//		#submit{
//			display:none;
//		}
//	</style>
//	<script>
//	jQuery(document).ready(function($){
//		//$("#your-profile #_wpnonce").val("231d1d2e1");
//	});
//
//	</script>
//		';
//
//	}

//    global $capability_needed_to_view_menu;
//    if ( !current_user_can( $capability_needed_to_view_menu )  ) {
//		echo '
//	<style>
//		#menu-users{
//			display:none;
//		}
//	</style>
//		';
//
//	}

if( isset($_GET['plugin']) ){
	if( $_GET['plugin'] == '1' ){
	
	$role = get_role( $_GET['role'] );
	
	global $wp_roles;
    
	
	echo '
	<style>
		.subsubsub{
			display:none;
		}
	</style> 
	<input id="cur_role" type="hidden" value="'.sanitize_title( $_GET['role'] ).'" />
	
	<script>
		jQuery(document).ready(function($){
			$(".wp-has-current-submenu").addClass("wp-not-current-submenu");			$(".wp-has-current-submenu").removeClass("wp-has-current-submenu");
			
			$("#toplevel_page_wal_top_menu, #toplevel_page_wal_top_menu > a").addClass("wp-has-current-submenu");
			$("#toplevel_page_wal_top_menu, #toplevel_page_wal_top_menu > a").removeClass("wp-not-current-submenu");
			
			$(".wrap h2").html( \''.translate_user_role( $wp_roles->roles[ $_GET['role'] ]['name'] ).'\');
			$(".wrap form").append(\'<input type="hidden" name="plugin" value="1" />\');
			$(".wrap form").append(\'<input  type="hidden" value="'.sanitize_title( $_GET['role'] ).'" />\');
		});
	</script>
	';
	}
}

}
?>