<?php
session_start();
include("config.php");
//include("usersession.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title> Online Shopping </title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	    <link rel="shortcut icon" href="images/favicon.png" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/proStyle.css" type="text/css" media="all" />
	   	
	 	<link rel="stylesheet" href="css/cart.css" type="text/css" media="all" />
		 <link rel="stylesheet" href="css/chatStyle.css" type="text/css" media="screen" />
	<script src="js/jquery-1.6.2.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/Myriad_Pro_700.font.js" type="text/javascript"></script>
	<script src="js/jquery.jcarousel.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/functions.js" type="text/javascript" charset="utf-8"></script>
	
		 <!-- Linking scripts -->
    <script src="js/main.js" type="text/javascript"></script>
	
	
	<!-- WAA DHAMAADKA JQueryga CHaTTIng Ka-->

<script type="text/javascript">
$(document).ready(function() {

	// load messages every 1000 milliseconds from server.
	load_data = {'fetch':1};
	window.setInterval(function(){
	 $.post('shout.php', load_data,  function(data) {
		$('.message_box').html(data);
		var scrolltoh = $('.message_box')[0].scrollHeight;
		$('.message_box').scrollTop(scrolltoh);
	 });
	}, 1000);
	
	//method to trigger when user hits enter key
	$("#shout_message").keypress(function(evt) {
		if(evt.which == 13) {
				var iusername = $('#shout_username').val();
				var imessage = $('#shout_message').val();
				post_data = {'username':iusername, 'message':imessage};
			 	
				//send data to "shout.php" using jQuery $.post()
				$.post('shout.php', post_data, function(data) {
					
					//append data into messagebox with jQuery fade effect!
					$(data).hide().appendTo('.message_box').fadeIn();
	
					//keep scrolled to bottom of chat!
					var scrolltoh = $('.message_box')[0].scrollHeight;
					$('.message_box').scrollTop(scrolltoh);
					
					//reset value of message box
					$('#shout_message').val('');
					
				}).fail(function(err) { 
				
				//alert HTTP server error
				alert(err.statusText); 
				});
			}
	});
	
	//toggle hide/show shout box
	$(".close_btn").click(function (e) {
		//get CSS display state of .toggle_chat element
		var toggleState = $('.toggle_chat').css('display');
		
		//toggle show/hide chat box
		$('.toggle_chat').slideToggle();
		
		//use toggleState var to change close/open icon image
		if(toggleState == 'block')
		{
			$(".header div").attr('class', 'open_btn');
		}else{
			$(".header div").attr('class', 'close_btn');
		}
		 
		 
	});
});

</script>

<!-- WAA DHAMAADKA JQueryga CHaTTIng Ka-->
</head>
<body>
	<!-- Begin Wrapper -->
	<div id="wrapper">
		<!-- Begin Header -->
		<div id="header">
			<!-- Begin Shell -->
			<div class="shell">
				<h1 id="logo"><a class="notext" href="#" title="Somstore">Somstore</a></h1>
				<div id="top-nav">
					<ul>
					
			<?php
			if(isset($_SESSION['login_username']))
			{		
			
			echo "<li ><span><font color=Green size=3px>","Welcome ".$_SESSION['login_username'],"</font></span></li>";
			echo '<li><a href="logout.php" title="log out"><span>log out</span></a></li>';
			}
			else
			{			
			echo '<li><a href="Sign In.php" title="Sign In"><span>Sign In</span></a></li>';
		// header("location: home.php");
			}	
			?>	
			<li><a href="contact.php" title="Contact"><span>Contact</span></a></li>	
					</ul>
				</div>
				<div class="cl">&nbsp;</div>
	<div class="shopping-cart"  id="cart" id="right" >
<dl id="acc">	
<dt class="active">								
<p class="shopping" >Shopping Cart &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</dt>
<dd class="active" style="display: block;">
<?php
   //current URL of the Page. cart_update.php redirects back to this URL
	$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

if(isset($_SESSION["cart_session"]))
{
    $total = 0;
    echo '<ul>';
    foreach ($_SESSION["cart_session"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>'."</br>";
        echo '<h3  style="color: green" ><big> '.$cart_itm["name"].' </big></h3>';
        echo '<div class="p-code"><b><i>ID:</i></b><strong style="color: #d7565b" ><big> '.$cart_itm["code"].' </big></strong></div>';
		echo '<span><b><i>Shopping Cart</i></b>( <strong style="color: #d7565b" ><big> '.$cart_itm["TiradaProductTiga"].'</big></strong>) </span>';
        echo '<div class="p-price"><b><i>Price:</b></i> <strong style="color: #d7565b" ><big>'.$currency.$cart_itm["Qiimaha"].'</big></strong></div>';
        echo '</li>';
        $subtotal = ($cart_itm["Qiimaha"]*$cart_itm["TiradaProductTiga"]);
        $total = ($total + $subtotal) ."</br>"; 
    }
    echo '</ul>';
    echo '<span class="check-out-txt"><strong style="color:green" ><i>Total:</i> <big style="color:green" >'.$currency.$total.'</big></strong> <a   class="a-btnjanan"  href="view_cart.php"> <span class="a-btn-text">Check Out</span></a></span>';
	echo '&nbsp;&nbsp;<a   class="a-btnjanan"  href="cart_update.php?emptycart=1&return_url='.$current_url.'"><span class="a-btn-text">Clear Cart</span></a>';
}else{
    echo ' <h4>(Your Shopping Cart Is Empty!!!)</h4>';
}
?>

</dd>
</dl>
</div>
 <div class="clear"></div>
			</div>
			<!-- End Shell -->
		</div>
		<!-- End Header -->
		<!-- Begin Navigation -->
		<div id="navigation">
			<!-- Begin Shell -->
			<div class="shell">
				<ul>
					<li class="active"><a href="index.php" title="index.php">Home</a></li>
					
					<li>
						<a href="products.php">Category</a>
						<div class="dd">
							<ul>
								<li>
									 <a href="products.php"> FoodStuff</a>
									<div class="dd">
										<ul>
											<li><a href="products.php">Fruits</a></li>
                                            <li><a href="products.php">Biscuits</a></li>
										</ul>
									</div>
								</li>
								
								<li>
									 <a href="products.php"> Beverage</a>
									<div class="dd">
										<ul>
											  <li><a href="products.php">Bavaria</a></li>
                                             <li><a href="products.php">Reddbull</a></li>
										</ul>
									</div>
								</li>
								
								<li>
									<a href="products.php"> Cleaning Material</a>
									<div class="dd">
										<ul>
											<li><a href="products.php">Fairy</a></li>
                                            <li><a href="products.php">Harpic</a></li>
										</ul>
									</div>
								</li>
								
								<li>
									<a href="products.php"> Clothes</a>
									<div class="dd">
										<ul>
											  <li><a href="products.php">Suit</a></li>
                                              <li><a href="products.php">T.shirts</a></li>
										</ul>
									</div>
								</li>
								
							</ul>
						</div>
					</li>
					   <li><a href="products.php"> Products</a></li>
					   	   <li>
						<a href="products.php">Warehouse</a>
						<div class="dd">
							<ul>
								<li>
									 <a href="warehouse_1.php"> Warehouse A</a>
									
								</li>
								
								<li>
									 <a href="warehouse_2.php"> Warehouse B</a>
									
								</li>
								
								<li>
									<a href="warehouse_3.php"> Warehouse C</a>
									
								</li>
								
								<li>
									<a href="warehouse_4.php"> Warehouse D</a>
									
								</li>
								
							</ul>
						</div>
					</li>
					  <li><a href="about.php">About Us</a></li>
					  
					<?php
						if(isset($_SESSION['login_username']))
						{		
							echo '<li><a href="profile.php" title="Profile">Profile</a></li>';
						}
						else
						{
							echo '<li><a href="customer.php">Free Sign Up</a> </li>';
						}
			
						?>
				</ul>
				<div class="cl">&nbsp;</div>
			</div>
			<!-- End Shell -->
		</div>
		<!-- End Navigation -->

		<!-- Begin Main -->
		<div id="main" class="shell">
			<!-- Begin Content -->
			<div id="content">
				<div class="post">
					<h2>Welcome!</h2>
					<img src="images/logo.png" alt="Post Image" height="160" width="260"/>
					You can be confident when you're shopping online with OnlineShopping. Our Secure online shopping website encrypts your personal and financial information to ensure your order information is protected.We use industry standard 128-bit encryption. Our Secure online shopping website locks all critical information passed from you to us,
                   such as personal information, in an encrypted envelope, making it extremely difficult for this information to be intercepted.. <a href="#" class="more" title="Read More">Read More</a></p>
					<div class="cl">&nbsp;</div>
				</div>
				
				
				<div class="post">
				
					<h1 align="center"><font color="blue">About The Project Developers</font></h1><br>
					<h2>Developer</h2>
					<img src="images/xogmo.jpg" alt="Post Image" width="140" height="159" />
					<p>Abdirahman Osman Sheikh farah. </p>
					<p>. <a href="#" class="more" title="Read More">Read More</a></p>
					<div class="cl">&nbsp;</div>
				</div>
				<div class="post">
					<h2>Developer</h2>
					<img src="images/jananka.jpg" alt="Post Image" width="140" height="159" />
					<p>Abdirahman Ali Abdi. </p>
					<p>. <a href="#" class="more" title="Read More">Read More</a></p>
					<div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- End Content -->
			
			
<!-- Begin Sidebar -->
			<div id="sidebar">
				<ul>
					<li class="widget">
						<h2>TOP Warehouse</h2>
						<div class="brands">
							<ul>
								<li><a href="warehouse_1.php" title="Brand 1"><img src="images/k.png" width="103" height="51" alt="Brand 1" /></a></li>
								<li><a href="warehouse_2.php" title="Brand 2"><img src="images/b.png" width="103" height="51" alt="Brand 2" /></a></li>
								<li><a href="warehouse_3.php" title="Brand 3"><img src="images/ab.png" width="103" height="51" alt="Brand 3" /></a></li>
								<li><a href="warehouse_4.php" title="Brand 4"><img src="images/33.png" width="103" height="51" alt="Brand 4" /></a></li>
							</ul>
							<div class="cl">&nbsp;</div>
						</div>
						<a href="products.php" class="more" title="More Brands">All Products</a>
					</li>
				</ul>
			</div>
			<!-- End Sidebar -->
			<div class="cl">&nbsp;</div>
	
		</div>
		<!-- End Main -->

			<div class="boxes">
			
			<div class="copy">
				<!-- Begin Shell -->
				<div class="shell">
					<div class="carts">
				
	<!-- End Wrapper -->
</body>
</html>