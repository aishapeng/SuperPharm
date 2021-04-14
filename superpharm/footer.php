<div class="footer">
	<br>
	<div class="container">
		<div class="row">
			<!----- Superpharm Logo ----->
			<div class="col-12 col-md-3">
				<a href="project.php" target="_self"><img src="icon/logo.png" class="footer-logo" alt="SuperPharm"></a></div>
			<!----- Superpharm Logo ----->
			<!----- Superpharm Social Media Account ----->
			<div class="col-12 col-md-3">
				<p class="black">| Follow Us</p>
				<div class="row social-media">
					<div class="col-3 col-md-3">
						<a href="https://www.facebook.com/" target="_blank"><img src="icon/fb.svg" alt="Facebook" class="social-media-logo"></a></div>
					<div class="col-3 col-md-3">
						<a href="https://www.twitter.com/" target="_blank"><img src="icon/twitter.svg" alt="Twitter" class="social-media-logo"></a></div>
					<div class="col-3 col-md-3">
						<a href="https://www.linkedin.com/" target="_blank"><img src="icon/linkedin.svg" alt="LinkedIn" class="social-media-logo"></a></div>
				</div>
			</div>
			<!----- Superpharm Social Media Account ----->
			<!----- About Superpharm ----->
			<div class="col-12 col-md-3">
				<p class="black">| About Us</p>
				<div class="row">
					<a href="#" target="_self" class="footer-text">Our Service</a></div>
				<div class="row">
					<a href="https://www.google.com.my/maps" target="_blank" class="footer-text">Store Locator</a></div>
				<div class="row">
					<a href="#" target="_self" class="footer-text">Careers</a></div>
			</div>
			<div class="col-12 col-md-3">
				<p class="black">| Contact Us</p>
				<div class="row">
					<a href = "mailto: superpharm@service.com" target="_blank" class="footer-text">superpharm@service.com</a></div>
				<div class="row">
					<p class="footer-text">+0123456789</p></div>
				<div class="row">
					<p class="footer-text">123, Jalan 123, 12345, Pulau Pinang.</p></div>
			</div>
			<!----- About Superpharm ----->
		</div>
		<div class="row">
			<p class="copyright">&copy; SuperPharm Copyright 2099. All Rights Reserved. <a href="http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Flocalhost%2F" target="_blank"><img style="border:0; width:88px; height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" /></a></p>
		</div>
	</div>
</div>
    <script>
        
    ///// Quantity Increment /////
    function wcqib_refresh_quantity_increments() {
        jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
            var c = jQuery(b);
            c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
            })
    }
    String.prototype.getDecimals || (String.prototype.getDecimals = function() {
        var a = this,
            b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
        return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
    }), jQuery(document).ready(function() {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on("updated_wc_div", function() {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on("click", ".plus, .minus", function() {
        var a = jQuery(this).closest(".quantity").find(".qty"),
            b = parseFloat(a.val()),
            c = parseFloat(a.attr("max")),
            d = parseFloat(a.attr("min")),
            e = a.attr("step");
        b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
    });
    //////////////////
    </script>