jQuery(document).ready( function($){
	$('#i_submit').click( function(e) {
	

	
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
        //get the file size and file type from file input field
        var fsize = $('#i_file')[0].files[0].size;
       
        if(fsize>  parseInt( $('#max_size').val() ) ) //do something if file size more than 1 mb (1048576)
        {
            alert(fsize +" bites\nToo big!");
			e.preventDefault();
        }else{
           // alert(fsize +" bites\nYou are good to go!");
        }
    }else{
        alert("Please upgrade your browser, because your current browser lacks some new features we need!");
    }
});
		
}) // global end
