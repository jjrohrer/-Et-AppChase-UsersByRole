jQuery(document).ready(function($){

    var canvas = document.getElementById('cv');
    var viewer = new JSC3D.Viewer(canvas);
    var ctx = canvas.getContext('2d');


    //Function Definitions
    //====================================================================
    function loadModelByPath($path) {
        viewer.enableDefaultInputHandler(true);
        viewer.replaceSceneFromUrl($path);
        viewer.update();
    }

    function loadFromJSON() {
        $.getJSON( $('#file_url').val() ,function(ajaxresult){
            //3D Object loading
            loadModelByPath(ajaxresult.stlpath);
            viewer.setParameter('InitRotationX', 20);
            viewer.setParameter('InitRotationY', 20);
            viewer.setParameter('InitRotationZ', 0);
            viewer.setParameter('ModelColor', '#959595');
            viewer.setParameter('BackgroundColor1', '#FFFFFF');
            viewer.setParameter('BackgroundColor2', '#FFFFFF');
            viewer.setParameter('RenderMode', 'flat');
            viewer.setParameter('Definition', 'high');
            viewer.init();
            viewer.update();
            ctx.font = '12px Courier New';
            ctx.fillStyle = '#FF0000';

            //Meta information loading
            $("#objtitle").text(ajaxresult.objtitle);
            $("#description").text(ajaxresult.description);
            $.each(ajaxresult.materials, function(k){
                $('<button type="button" class="btn btn-default">'+ajaxresult.materials[k]+'</button>').appendTo("#materials");
            });
            $("#price").text(ajaxresult.price);
            $("#price_subtext").text(ajaxresult.price_subtext);
        });
    }
    //END Function Definitions
    //====================================================================


    // Handlers
    //=====================================================================
    viewer.afterupdate = function () {
        var scene = viewer.getScene();
        if (scene !== null && scene.getChildren().length > 0) {
            //DEMO values !
			
			if( $('#size_l').val() && $('#size_w').val() && $('#size_h').val()  ){
				ctx.fillText('Box (mm): '+$('#size_l').val()+' x '+$('#size_w').val()+' x '+$('#size_h').val()+'', 10, 20);
			}
			
            
            ctx.fillText('Volume (cc): '+$('#volume').val(), 10, 35);
			ctx.fillText('Number of triangles: '+$('#triangle').val(), 10, 50);
            //
        }
    };
    //END Handlers
    //====================================================================


    // Execution space
    //=====================================================================

    loadFromJSON();

    //Interaction Tip init and behavior
    $("#tip").hide();
    $("#info").mouseenter(function(){
        $("#tip").fadeIn();
    });
    $("#info").mouseleave(function(){
        $("#tip").fadeOut("slow");
    });

    //Render mode selection events
    $("a.rendermode").click(function(evt){
        $mode = $(this).attr("href").substr(1);
        viewer.setRenderMode($mode);
        viewer.update();
    });

});
