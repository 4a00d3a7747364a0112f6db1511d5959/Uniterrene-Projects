<script>
    var base_url = "<?PHP echo base_url();?>";
    var max_limit = "";
</script>

<!-- Jquery validation -->
<link rel="stylesheet" type="text/css" media="screen" href="<?PHP echo base_url();?>assets/validationscriptfiles/css/validation.css" />
<script type="text/javascript" src="<?PHP echo base_url();?>assets/validationscriptfiles/lib/jquery-1.4.2.js"></script>
<script src="<?PHP echo base_url();?>assets/validationscriptfiles/lib/jquery.validate.js?v=1" type="text/javascript"></script>
<script src="<?PHP echo base_url();?>assets/validationscriptfiles/lib/additional-methods.js" type="text/javascript"></script>
<script>$jqvalidation =  $.noConflict();</script>
<!-- End Jquery validation -->


<!-- Accordion Start-->
<script type="text/javascript" src="<?PHP echo base_url();?>assets/scripts/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/scripts/jquery/jquery.nestedAccordion.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/scripts/jquery/expand.js"></script>
<script type="text/javascript">

$jqAcc =  $.noConflict();

$jqAcc("html").addClass("js");

$jqAcc(function() {

  $jqAcc("#side").accordion({initShow: "#current", uri: "full", splitUrl: '/',iconTrigger :false, activeLink : true});
 
  /*$("#side ul.accordion").expandAll({
      trigger: "li", 
      ref: "", 
      cllpsEl : "ul", 
      state : '',
      oneSwitch : false
  });*/
 
  $jqAcc("html").removeClass("js");

});

</script>
<!-- Accordion End-->




<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

<!-- Data Table Includes -->
<style type="text/css" title="currentStyle">
	
	@import "<?PHP echo base_url()?>assets/media/css/smoothness/jquery-ui-1.8.22.custom.css";	

</style>
<script type="text/javascript" language="javascript" src="<?PHP echo base_url()?>assets/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?PHP echo base_url()?>assets/media/js/jquery-ui.js"></script>
<!-- Data Table Includes -->

<!--Bubble Tooltip-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
<script src="<?PHP echo base_url();?>assets/bubbletip/js/jQuery.bubbletip-1.0.6.js" type="text/javascript"></script>
<link href="<?PHP echo base_url();?>assets/bubbletip/js/bubbletip/bubbletip.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">$bt = $.noConflict();</script>
<!--End Bubble Tooltip-->

<!-- Rating -->
<script type="text/javascript" src="<?PHP echo base_url();?>assets/rating/js/jquery.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/rating/js/jquery.raty.js"></script>
<script>ratingJQ = jQuery.noConflict();</script>
<!-- End Rating -->

