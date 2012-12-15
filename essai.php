<html>
    <head>
    <script type="text/javascript" src="script/jquery.js"></script>
  	<script type="text/javascript">
	$(document).ready(function(){
    
	//Hide (Collapse) the toggle containers on load
	$("#toggle_container").hide(); 

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$("h3.trigger").click(function(){
		$(this).toggleClass("active").next().slideToggle("slow");
		return false; //Prevent the browser jump to the link anchor
	});
    
	});
	</script>
    <script type="text/javascript">
/*$(document).ready(function(){
	var $contenu = $('.toggle_container');
	$contenu.hide(); 

	$('h3.trigger').click(function(){
		$(this).toggleClass('active').next().slideToggle('slow');
		return false;
	});
	
	$('#ouvrir').click(function() {
		$contenu.show('slow');
		return false;
	});
	
	$('#fermer').click(function() {
		$(this).next().toggle('fast', function() {
			// Animation complete.
			//alert('huhhu ça marche');
		  });
          
       
	});
});*/

$(function(){
(function($) {
var allPanels = $(‘.dd’).hide();
$(‘.a’).click(function() {
allPanels.slideUp();
$(this).parent().next().slideDown();
return false;
});
})(jQuery);
});
</script>

<style>
.accordion {margin: 50px; position : relative; }

.dt, .dd {
padding: 10px;
border: 1px solid black;
border-bottom: 0;
}

.a {
display: block;
color: black;
font-weight: bold; }

.dd {
border-top: 0;
font-size: 12px;
}
</style>
    </head>
    <body>
    <!--a id="ouvrir" href="#">Ouvrir</a> - <a id="fermer" href="#">Fermer</a> 

    <h3 class="trigger"> <a href="#">Mon titre</a></h3>
	   <section class="toggle_container">
	   Ma section qui s'ouvre/se ferme.
	   </section>
    <h3 class="trigger"> <a href="#">Mon titre 2</a></h3>
	   <section class="toggle_container">
	   Ma section qui s'ouvre/se ferme 2.
	   </section-->
       <dl  classe = "accordeon">

<dl class="accordion">

<dt><a href="">Panel 1</a></dt>
<dd>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</dd>

<dt><a href="">Panel 2</a></dt>
<dd>Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.</dd>

<dt><a href="">Panel 3</a></dt>
<dd>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.</dd>

</dl>
    </body>
    
</html>