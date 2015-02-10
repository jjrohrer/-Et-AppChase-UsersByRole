jQuery(document).ready(function($){
	
	$('.toplevel_page_wal_top_menu ul li a').each(function(){
		var this_attr = $(this).attr('href').split('?');
		var new_arr = this_attr[1].split('=');
		
		$(this).attr('href', 'users.php?plugin=1&role='+new_arr[1] );
	})
	//$("#toplevel_page_wal_top_menu ul li a").find("[href=\'users.php?plugin=1&role=utilizator\']").addClass("current");
	//console.debug( $("#toplevel_page_wal_top_menu ul li a").find("[href='plugin=1&role=utilizator']").html() );
	
	var pnt = $("a[href='users.php?plugin=1&role="+$('#cur_role').val()+"']");
	pnt.addClass('current');
	pnt.parent('li').addClass('current');
	//console.log( $("a[href='users.php?plugin=1&role=executive']").attr('href') );
	
	$("#toplevel_page_wal_top_menu > a, #toplevel_page_wal_top_menu li").attr("href", "users.php?plugin=1");
	$("a[href='users.php?plugin=1&role=wal_top_menu']").attr("href", "users.php?plugin=1");
	
	
});