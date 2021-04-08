<?php 
require('include/config.php'); 
include('auth_session.php'); 

$query = mysqli_query($sql, "SELECT * FROM user");
while($row = mysqli_fetch_assoc($query)){
	$user_id = $row['user_id'];
}?>
<div class="header">
	<div class="container header-width">
		<div class="row">
			<div class="col-auto me-auto">
	  			<a href="project.php" target="_self"><img src="icon/logo.png" alt="SuperPharm" class="logo"/></a></div>
	  		<!----- My Account Dropdown Menu ----->
            <div class="col-auto">
	  			<?php
	  			if(!isset($_SESSION["username"])){
	  			 	echo '<div class="dropdown">
	  				<button class="dropbtn">My Account</button>
	  				<div class="dropdown-content">
	  					<a href="account.php">Login</a>
	  				</div>';
	  			} else {
					echo '<div class="dropdown">
	  				<button class="dropbtn">My Account</button>
	  				<div class="dropdown-content">
	  					<a href="account.php?uid='.$user_id.'" target="_blank">Profile</a>
	  					<a href="logout.php">Logout</a>
	  				</div>';
	  			}?>
			</div>
            <!----- My Account Dropdown Menu ----->
	  	</div>
	</div>
</div>

<!----- Sticky Navigation Bar ----->
<!----- Category Sidebar ----->
<div id="mySidebar" class="sidebar">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
	<br>
	<?php
	$query = mysqli_query($sql, "SELECT * FROM category");

	if(mysqli_num_rows($query) > 0) {
		while($row = mysqli_fetch_assoc($query)){
			echo '<a href="product.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a><hr class="sidebar-line">';
		}
	}?>
</div>
<!----- Category Sidebar ----->

<div id="navbar">
	<a href="project.php" target="_self" class="active">Home</a>
	<a id="main" class="categoryBtn" href="javascript:openNav()">☰ Categories</a>
	<form class="search search-bar" action="">
		<input type="text" placeholder="What are you looking for" name="search">
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
  	<?php echo '<a href="cart.php?uid='.$user_id.'" target="_blank" class="fl-right"><img src="icon/cart.svg" alt="My Cart" class="my-cart-icon"></a>'; ?>
</div>
<!----- Sticky Navigation Bar ----->

<!------- Go to top button ------->
<button onclick="topFunction()" id="goToTopBtn" title="Go to top"><i class='fas fa-chevron-up'></i></button>
<!------- Go to top button ------->

<script>
	window.onscroll = function() {
		myFunction()
	};

	var navbar = document.getElementById("navbar");
	var sticky = navbar.offsetTop;

	function myFunction() {
		if (window.pageYOffset >= sticky) {
			navbar.classList.add("sticky")
		} else {
			navbar.classList.remove("sticky");
		}
    	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		document.getElementById("goToTopBtn").style.display = "block";
		} else {
		  	document.getElementById("goToTopBtn").style.display = "none";
		}
	}

	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}

    ///// Ad Images /////
    var slideIndex = 0;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("adSlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 5000); // Change image every 5 seconds
    }
    ////////////////////

    ///// Sidebar /////
	function openNav() {
	  	document.getElementById("mySidebar").style.width = "200px";
	  	document.getElementById("main").style.marginLeft = "200px";
	}

	function closeNav() {
	  	document.getElementById("mySidebar").style.width = "0";
	  	document.getElementById("main").style.marginLeft= "0";
	}
    ///////////////////

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

    ///// Tab /////
    var TabBlock = {
        s: {
            animLen: 200
        },
  
        init: function() {
            TabBlock.bindUIActions();
            TabBlock.hideInactive();
        },
      
        bindUIActions: function() {
            $('.tabBlock-tabs').on('click', '.tabBlock-tab', function(){
            TabBlock.switchTab($(this));
            });
        },
      
        hideInactive: function() {
            var $tabBlocks = $('.tabBlock');
        
            $tabBlocks.each(function(i) {
            var 
                $tabBlock = $($tabBlocks[i]),
                $panes = $tabBlock.find('.tabBlock-pane'),
                $activeTab = $tabBlock.find('.tabBlock-tab.is-active');
          
            $panes.hide();
            $($panes[$activeTab.index()]).show();
            });
        },
      
        switchTab: function($tab) {
            var $context = $tab.closest('.tabBlock');
        
            if (!$tab.hasClass('is-active')) {
                $tab.siblings().removeClass('is-active');
                $tab.addClass('is-active');
       
                TabBlock.showPane($tab.index(), $context);
            }
        },
      
        showPane: function(i, $context) {
            var $panes = $context.find('.tabBlock-pane');
       
            $panes.slideUp(TabBlock.s.animLen);
            $($panes[i]).slideDown(TabBlock.s.animLen);
        }
    };

    $(function() {
        TabBlock.init();
    });
    ///////////////

    ///// Edit Information Form /////
    function openEditForm() {
        document.getElementById("popupForm").style.display = "block";
      }
  	function closeEditForm() {
    	document.getElementById("popupForm").style.display = "none";
  	}
    ///////////////
</script>