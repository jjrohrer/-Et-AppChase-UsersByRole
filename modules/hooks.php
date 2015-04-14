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
//        if (!isset($_GET['role'])) {
//            $_GET['role'] = "Users";
//        } else {
//            $_GET['role'] = "Users be". $_GET['role'];
//        }

        $sanitized_role_text = sanitize_title( $_GET['role'] );
        $role_text_translated = translate_user_role( $wp_roles->roles[ $_GET['role'] ]['name'] );
        if (trim($role_text_translated) == '') {
            $role_text_translated = 'All Users';
        }


        if (current_user_can('create_users') && function_exists('wis_activate' ) ){ //todo make way more obvious that this is -ET-AppChase-Users-Invitations
            $new_role_text = 'Invite new user';//. translate_user_role( $wp_roles->roles[ $_GET['role'] ]['name'];
            $new_role_alt = 'Invite new user with as  '.translate_user_role( $wp_roles->roles[ $_GET['role'] ]['name']). ' (you can change this before inviting)';
            $url = get_bloginfo('url').'/wp-admin/admin.php?page=wis_invite_system&role='.$_GET['role'];
            //http://mini.local/Sites/wordpress_stuff/ET-AppChase-003/wp-admin/admin.php?page=wis_invite_system&role=webmaster
            $new_role_button_html =<<<EOD
<a href="$url" title="$new_role_alt">$new_role_text</a>
EOD;
        } else {
            $new_role_button_html = '';
        }
	
//	$js =<<<EOD
//	<style>
//		.subsubsub{
//			display:none;
//		}
//	</style>
//	<input id="cur_role" type="hidden" value="$sanitized_role_text" />
//
//
//	<script>
//		jQuery(document).ready(function($){
//			$(".wp-has-current-submenu").addClass("wp-not-current-submenu");			$(".wp-has-current-submenu").removeClass("wp-has-current-submenu");
//
//			$("#toplevel_page_wal_top_menu, #toplevel_page_wal_top_menu > a").addClass("wp-has-current-submenu");
//			$("#toplevel_page_wal_top_menu, #toplevel_page_wal_top_menu > a").removeClass("wp-not-current-submenu");
//
//			$(".wrap h2").html( '$role_text_translated');
//			$(".wrap h2").append( '$new_role_button_html');
//			$(".wrap form").append('<input type="hidden" name="plugin" value="1" />');
//			$(".wrap form").append('<input  type="hidden" value="$sanitized_role_text" />);
//		});
//	</script>
//EOD;
//	#echo $js;
        $js =<<<EOD
	<style>
		.subsubsub{
			display:none;
		}
	</style>
	<input id="cur_role" type="hidden" value="$sanitized_role_text" />

	<script>
		jQuery(document).ready(function($){
			$(".wp-has-current-submenu").addClass("wp-not-current-submenu");			$(".wp-has-current-submenu").removeClass("wp-has-current-submenu");

			$("#toplevel_page_wal_top_menu, #toplevel_page_wal_top_menu > a").addClass("wp-has-current-submenu");
			$("#toplevel_page_wal_top_menu, #toplevel_page_wal_top_menu > a").removeClass("wp-not-current-submenu");

			$(".wrap h2").html( "$role_text_translated");
			$(".wrap h2").after( '$new_role_button_html');
			$(".wrap form").append('<input type="hidden" name="plugin" value="1" />');
			$(".wrap form").append('<input  type="hidden" value="$sanitized_role_text"');
		});
	</script>
	';
EOD;
        echo $js;
	}
}

}
?>