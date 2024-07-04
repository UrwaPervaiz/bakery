<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
    <title>Cake - Bakery</title>

    <!-- Icon css link -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/linearicons/style.css" rel="stylesheet">
    <link href="vendors/flat-icon/flaticon.css" rel="stylesheet">
    <link href="vendors/stroke-icon/style.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Rev slider css -->
    <link href="vendors/revolution/css/settings.css" rel="stylesheet">
    <link href="vendors/revolution/css/layers.css" rel="stylesheet">
    <link href="vendors/revolution/css/navigation.css" rel="stylesheet">
    <link href="vendors/animate-css/animate.css" rel="stylesheet">
    
    <!-- Extra plugin css -->
    <link href="vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
    <link href="vendors/magnifc-popup/magnific-popup.css" rel="stylesheet">
    <link href="vendors/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="vendors/nice-select/css/nice-select.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!--================Main Header Area =================-->
    <header class="main_header_area">
        <div class="top_header_area row m0">
            <div class="container">
                <div class="float-right">
                    <ul class="h_search list_style">
                        <li class="shop_cart"><a href="cart.php"><i class="lnr lnr-cart"></i></a></li>
                        <li><a class="popup-with-zoom-anim" href="logout.php"><i class="fa fa-user"></i></a></li>
						</ul>
                </div>
            </div>
        </div>
        <div class="main_menu_area">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="index-2.php">
                        <img src="img/logo.png" alt="">
                        <img src="img/logo-2.png" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="my_toggle_menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="dropdown submenu">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index-2.php">Home</a></li>
                                </ul>
                            </li>
                            <li><a href="cake.php">Our Cakes</a></li>
                            <!-- <li><a href="menu.html">Menu</a></li> -->
                            <li class="dropdown submenu">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About Us</a>
                                <ul class="dropdown-menu">
                                    <li><a href="about-us.php">About Us</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="navbar-nav justify-content-end">
                            <li class="dropdown submenu active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu">
                                    <li><a href="cart.php">Cart Page</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!--================End Main Header Area =================-->
    
    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="container">
            <div class="banner_text">
                <h3>Cart</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!--================End Banner Area =================-->
    
    <!--================Cart Table Area =================-->
    <section class="cart_table_area p_100">
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "cake";

						$conn = new mysqli($servername, $username, $password, $dbname);

						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
                        

						if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
							$delete_id = $_POST['delete_id'];
							
							$sql_delete = "DELETE FROM cart WHERE id = $delete_id";
							if ($conn->query($sql_delete) === TRUE) {
								echo "Record deleted successfully";
								
							} else {
								echo "Error deleting record: " . $conn->error;
							}
						}

						$sql = "SELECT * FROM cart";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$price = (float)str_replace('$', '', $row['price']);
								echo "<tr>";
								echo "<td><img src='" . $row['image'] . "' alt=''></td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>$" . number_format($price, 2) . "</td>";
								echo '<td>';
								echo '<input type="number" name="quantity" step="1" pattern="\d+" title="Please enter only numeric values" style="width:100px;" required>';
								echo '</td>';
								echo "<td>$" . number_format($price, 2) . "</td>";
								echo "<td>";
								echo '<form method="post">';
								echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';

								echo '<button type="submit">Delete</button>';
								echo '</form>';
								echo "</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
						}

						$conn->close();
					?>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--================End Cart Table Area =================-->
    
    <!--================Footer Area =================-->
    <footer class="footer_area">
        <div class="footer_widgets">
            <div class="container">
                <div class="row footer_wd_inner">
                    <div class="col-lg-3 col-6">
                        <aside class="f_widget f_about_widget">
                            <img src="img/footer-logo.png" alt="">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum maxime, accusamus minima repellat aspernatur porro modi esse quaerat suscipit rem! Architecto quibusdam aliquam impedit eum, quisquam animi veniam fugit nihil.</p>
                            <ul class="nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-6">
                        <aside class="f_widget f_link_widget">
                            <div class="f_title">
                                <h3>Quick links</h3>
                            </div>
                            <ul class="list_style">
                                <li><a href="#">Your Account</a></li>
                                <li><a href="#">View Order</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-6">
                        <aside class="f_widget f_link_widget">
                            <div class="f_title">
                                <h3>Work Times</h3>
                            </div>
                            <ul class="list_style">
                                <li><a href="#">Mon. - Fri.: 8 am - 8 pm</a></li>
                                <li><a href="#">Sat. : 9am - 4pm</a></li>
                                <li><a href="#">Sun. : Closed</a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-6">
                        <aside class="f_widget f_contact_widget">
                            <div class="f_title">
                                <h3>Contact Info</h3>
                            </div>
                            <h4>1234567890</h4>
                            <p>Bakery Store <br />256, Baker Street, Faisalabad, Pakistan</p>
                            <h5>abc@contact.co.in</h5>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--================End Footer Area =================-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Rev slider js -->
    <script src="vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <!-- Extra plugin js -->
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="vendors/magnifc-popup/jquery.magnific-popup.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="vendors/datetime-picker/js/moment.min.js"></script>
    <script src="vendors/datetime-picker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    
    <script src="js/theme.js"></script>
</body>
</html>