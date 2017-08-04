// tinymce Start
tinyMCE.init({
    // General options

    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,

    verify_html:false,
    valid_elements : "td[background]",
    document_base_url : base_url,
    mode : "exact",
    elements : "notes,content,description,comments,overview,includes",
    theme : "advanced",
    plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    <!--theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",-->
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    file_browser_callback : "tinyBrowser",

    // Example content CSS (should be your site CSS)
    //content_css : base_url+"assets/css/style.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "lists/template_list.js",
    external_link_list_url : "lists/link_list.js",
    external_image_list_url : "lists/image_list.js",
    media_external_list_url : "lists/media_list.js",

    // Style formats
    style_formats : [
        {title : 'Bold text', inline : 'b'},
        {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
        {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
        {title : 'Example 1', inline : 'span', classes : 'example1'},
        {title : 'Example 2', inline : 'span', classes : 'example2'},
        {title : 'Table styles'},
        {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
    ],

    // Replace values for the template plugin
    template_replace_values : {
        username : "Some User",
        staffid : "991234"
    }
});
// tinymce end

// validation start
/*j(document).ready(function(){
    // binds form submission and fields to the validation engine

    j("#loginForm,#accountSettingsFrm,#categoriesFrm,#contentFrm,#questionsFrm,#membersFrm,#templatesFrm,#uniFrm").validationEngine({
       ajaxFormValidationMethod: 'post'
        //autoHidePrompt: true,
       //autoHideDelay:5000

    });

    j('input').attr('data-prompt-position','topRight');
    j('input').data('promptPosition','topRight');
    j('textarea').attr('data-prompt-position','topRight');
    j('textarea').data('promptPosition','topRight');
    j('select').attr('data-prompt-position','topRight');
    j('select').data('promptPosition','topRight');
   
});*/
// validation end

// DataTables Start
// This function is to refresh the grid user of function is $('#example').dataTable().fnReloadAjax();
$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
{
    if ( typeof sNewSource != 'undefined' && sNewSource != null ) {
        oSettings.sAjaxSource = sNewSource;
    }

    // Server-side processing should just call fnDraw
    if ( oSettings.oFeatures.bServerSide ) {
        this.fnDraw();
        return;
    }

    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    var iStart = oSettings._iDisplayStart;
    var aData = [];

    this.oApi._fnServerParams( oSettings, aData );

    oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
        /* Clear the old information from the table */
        that.oApi._fnClearTable( oSettings );

        /* Got the data - add it to the table */
        var aData =  (oSettings.sAjaxDataProp !== "") ?
            that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;

        for ( var i=0 ; i<aData.length ; i++ )
        {
            that.oApi._fnAddData( oSettings, aData[i] );
        }

        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

        if ( typeof bStandingRedraw != 'undefined' && bStandingRedraw === true )
        {
            oSettings._iDisplayStart = iStart;
            that.fnDraw( false );
        }
        else
        {
            that.fnDraw();
        }

        that.oApi._fnProcessingDisplay( oSettings, false );

        /* Callback user function - for event handlers etc */
        if ( typeof fnCallback == 'function' && fnCallback != null )
        {
            fnCallback( oSettings );
        }
    }, oSettings );
};

function gen_link(loc,icon,id,_alert)
{
    var linkhtml = '';

    if(_alert){
        linkhtml = '<a onclick ="return confirm(\'Are you sure to delete this record?\');" href ="'+base_url+loc+id+'"><img src = "'+base_url+'assets/images/administration/icons/'+icon+'" alt="" /></a>';
    }
    else{
        linkhtml = '<a href ="'+base_url+loc+id+'"><img src = "'+base_url+'assets/images/administration/icons/'+icon+'" alt="" /></a>';
    }


    return linkhtml;
}

function gen_simple_link(url,txt){
	return linkHtml = '<a href="'+url+'">'+txt+'</a>';
}
// DataTables End

// colorbox functions start
function open_popup_refresh(url)
{
    cb.colorbox({
        iframe:true,
        innerWidth:32,
        innerHeight:32,
        initialWidth:32,
        initialHeight:32,
        opacity:0.6,
        href:url,
        fastIframe:false,
        open:true,
        onClosed: function()
        {
            $('#example').dataTable().fnReloadAjax();
        }
    });
}

function open_popup(url)
{
    cb.colorbox({
        iframe:true,
        innerWidth:32,
        innerHeight:32,
        initialWidth:32,
        initialHeight:32,
        opacity:0.6,
        href:url,
        fastIframe:false,
        open:true,
        onClosed: function()
        {
            //$('#example').dataTable().fnReloadAjax();
        }
    });
}

// colorbox functions end

// General functions start
function showhide_(objid)
{
    obj = document.getElementById(objid);
    if (obj.style.display == 'none')
    {
        obj.style.display = 'inline';
    }
    else if (obj.style.display == 'inline')
    {
        obj.style.display = 'none';
    }
}

function generateSlug(field_id,Txt)
{
    document.getElementById(field_id).value = Txt.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}

// General functions end