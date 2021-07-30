<!DOCTYPE html>
<html>
<head>
	<title>About us</title>
	<!--------Css File Include ------>
<?= view('Home/css_file'); ?>
<!--------Css File Include ------>
</head>
<body>

<!--------Hader Section Start ----->
<?= view('Home/header_section'); ?>
<!--------Hader Section End ----->

<!------Body Section Start ----->
		<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">About us </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="about-us-area pt-50 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-7 d-flex align-items-center">
                        <div class="overview-content-2">
                            <h2>Welcome To <span>Khan Rayees</span> Store !</h2>
                            <p class="peragraph-blog">Online food ordering is a process of ordering food from a local restaurant or food cooperative through a web page or app. ... A customer will search for a favorite restaurant, usually filtered via type of cuisine and choose from available items, and choose delivery or pick-up.</p>
                            <p>If a customer purchases an item from you with Square Online, they can pick it up from a brick and mortar location. ... If you're ready for your customer to pick up an order, click Mark as Ready. Once your customer picks up their item(s), locate the order and select Mark Picked Up.</p>
                            <p> The Ordering. app directly integrates with Clover. For restaurants using these POS systems, orders will flow directly into your POS, and print from your pre-existing printers. For restaurants using a different POS system, we will send online orders directly to via an external tablet, email, or SMS.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
<!------Body Section End ----->

<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
<!---------Customer Js File Include ------>
<?= view('Home/custom_js'); ?>
<!---------Customer Js File Include ------>
</body>
</html>