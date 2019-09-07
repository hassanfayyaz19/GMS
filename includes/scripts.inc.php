<link rel="stylesheet" type="text/css" href="<?php echo $themepath;?>css/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $themepath;?>niceforms-default.css" />

<script language="javascript" type="text/javascript" src="pretty/js2/jquery-1.6.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="shadowbox/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>


<script language="javascript" src="<?php echo $themepath;?>js/validation.js"></script>
<script language="javascript" src="<?php echo $themepath;?>js/func.js"></script>
<script language="javascript" src="<?php echo $themepath;?>js/toolBox.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $themepath;?>js/ajax.js"></script>


<script type="text/javascript" src="<?php echo $themepath;?>js/ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='<?php echo $themepath;?>images/plus.gif' class='statusicon' />", "<img src='<?php echo $themepath;?>images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<script type="text/javascript" src="<?php echo $themepath;?>js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>

<script language="javascript" type="text/javascript" src="<?php echo $themepath;?>/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $themepath;?>css/niceforms-default.css" />
<!-- for dock toolbar -->
<script type="text/javascript" src="dock-menu/js/interface.js"></script>
<link href="dock-menu/style.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>
 <style type="text/css">
 div, img { behavior: url(iepngfix.htc) }
 </style>
<![endif]-->
<!-- Form Validator -->
<link rel="stylesheet" href="validator/css/validationEngine.jquery.css" type="text/css"/>
<script src="validator/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="validator/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

