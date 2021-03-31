<!DOCTYPE html>
<html lang="en">

<head>

    <title>Shopping Cart</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Mlungisi Mcvillan">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- <link rel="stylesheet" href="./bootstrap-4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/logo/fav.png">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/tooplate-style.css">
    <script src="./jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".content .box").hide();
            $(".content .box:first-child").show();
            $(".radio_wrap").click(function() {
                var current_raido = $(this).attr("data-radio");
                $(".content .box").hide();
                $("." + current_raido).show();
            })
        });
    </script>


</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section>


    <!-- HEADER -->
    <header>
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-5">
                    <p>Welcome to our Professional Spa Care and treatment</p>
                </div>

                <div class="col-md-8 col-sm-7 text-align-right">

                    <span class="phone-icon"><i class="fa fa-phone-square"></i> +268 7663 4889</span>
                    <span class="email-icon"><i class="fa fa-envelope"></i> <a href="#">info@vijanaspa.com
                        </a></span>
                    <span class="sm-social-link"> <a class="h-facebook" href="https://www.facebook.com/MusicWetfucom-110332261108283"><i class="fa fa-facebook"></i></a>
                        <a class="h-twitter" href="https://twitter.com/musicwetfu"><i class="fa fa-twitter"></i></a>
                        <a class="h-google" href="https://www.instagram.com/music.wetfu/"><i class="fa fa-instagram"></i></a>
                        <a class="h-google" href="https://www.instagram.com/music.wetfu/"><i class="fa fa-whatsapp"></i></a></span>


                </div>
            </div>
    </header>


    <!-- MENU -->
    <section class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE -->
                <a href="index.html" class="navbar-brand"><img src="images/logo/logo-1.png" height="60"></a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html" class="smoothScroll">Home</a></li>
                    <li><a href="#about" class="smoothScroll">About Us</a></li>
                    <li><a href="#team" class="smoothScroll">VIP Treatment</a></li>
                    <li><a href="#news" class="smoothScroll">General Treatment</a></li>
                    <li><a href="#google-map" class="smoothScroll">Contact</a></li>
                    <li class="appointment-btn"><a href="#appointment">Make an appointment</a></li>
                    <li><a href="cart.html"><i class="fa fa-shopping-cart"> Shopping Cart (5)</i></a>

                </ul>

            </div>

        </div>
    </section>


    <!-- CART DETAIL -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div style="display:<?php if(isset($_SESSION['showAlert'])){
                    echo $_SESSION['showAlert'];
                }else{
                    echo 'none';
                }unset($_SESSION['showAlert']);
                ?>" class="alert alert-danger alert-dismissible mt-4">
                    <button type="button" class="close" data-dismiss="alert">
                        &times;
                    </button>
                    <strong>
                        <?php if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                        }?>
                    </strong>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-center text-info m-0">Products in your Cart</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                    <a href="action.php?clear=all" class="badge badge-danger p-1" onclick='return confirm("Are you sure ou want to clear your cart")'><i class="fas fa-trash"></i>&nbsp; Clear Cart</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require './includes/db.php';
                            $stmt = $connectingDB->prepare("SELECT * FROM cart");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            while ($row = $result->fetch_assoc()) :

                            ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                    <td><img src="/uploadsImg/<?= $row['productImage'] ?>" alt="" width="50"></td>
                                    <td><?= $row['productName'] ?></td>
                                    <td>E&nbsp;<?= number_format($row['productPrice'], 2) ?></td>
                                    <input type="hidden" class="pprice" value="<?= $row['productPrice'] ?>">
                                    <td><input type="number" class="form-control itemQty" value="<?= $row['Qty'] ?>" style="width:75px;"></td>
                                    <td>E&nbsp;<?= number_format($row['totalPrice'], 2) ?></td>
                                    <td><a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure you want toremove this item?')"> <i class="fas fa-trash"></i></a></td>
                                </tr>
                                <?php $grand_total += $row['totalPrice'];
                                ?>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="3">
                                    <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp; Continue Shopping</a>
                                </td>
                                <td colspan="2"><b>Grand Total</b></td>
                                <td><b>E&nbsp;<?= number_format($grand_total, 2) ?></b></td>
                                <td><a href="checkout.php" class="btn btn-info <?= ($grand_total > 0) ? "" : "disabled" ?>"><i class="far fa-credit-card"></i>&nbsp; Check Out</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   

    
    <div class="container"></div>
    <div class="row">
    <div class="col-md-6 col-md-offset-3 order-md-2 mb-4">
    <h4 class="mb-3">PAYMENT</h4>
                    <div class="wrapper">
                        <div class="radio_tabs">
                            <label class="radio_wrap" data-radio="debit">
                                <input type="radio" name="sports" class="input" checked>
                                <span class="radio_mark">
                                    Debit Card
                                </span>
                            </label>
                            <label class="radio_wrap" data-radio="Momo">
                                <input type="radio" name="sports" class="input">
                                <span class="radio_mark">
                                    MoMo Pay
                                </span>
                            </label>
                            <label class="radio_wrap" data-radio="ewallet">
                                <input type="radio" name="sports" class="input">
                                <span class="radio_mark">
                                    E-Wallet
                                </span>
                            </label>

                        </div>
                        <div class="content">
                            <div class="box debit">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cc-name">Name on card</label>
                                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                        <small class="text-muted">Full name as displayed on card</small>
                                        <div class="invalid-feedback">
                                            Name on card is required
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cc-number">Credit card number</label>
                                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Credit card number is required
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cc-expiration">Expiration</label>
                                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Expiry date required
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cc-cvv">CVV</label>
                                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Security code required
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box Momo">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="reference">MoMo Reference:</label>
                                        <input id="reference" type="text" class="form-control" placeholder="Enter your MoMo Pay Reference Here">
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="requirement">Some Other Detail:</label>
                                        <input id="requirement" type="text" class="form-control" placeholder="Enter detail Here">
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="otherrequiremt">Yet Another Detail:</label>
                                        <input id="otherrequirement" type="text" class="form-control" placeholder="Enter Another thingie Here">
                                    </div>
                                
                                </div>

                            </div>
                            <div class="box ewallet">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="detail1">ewallet detail 1:</label>
                                        <input id="detail1" class="form-control" placeholder="enter detail 1">
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="detail2">ewallet detail 2:</label>
                                        <input id="detail1" class="form-control" placeholder="enter detail 2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="btn btn-info btn-block" type="submit" id="cf-submit" name="submit">Continue Checkout</button><br><br>
                </form>

            </div>
    </div>
    </div>
    
        </div>
    </div>
    </div>

    <!-- FOOTER -->
    <footer data-stellar-background-ratio="5">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-4">
                    <div class="footer-thumb">
                        <h4 class="wow fadeInUp" data-wow-delay="0.4s">Contact Info</h4>
                        <p>For more information or for feedback. Please dont hesitate to contact us.</p>

                        <div class="contact-info">
                            <p><i class="fa fa-phone"></i> <a href="#">+268 7663 4889</a></p>
                            <p><i class="fa fa-envelope"></i> <a href="#">info@vijanaspa.com</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="footer-thumb">
                        <h4 class="wow fadeInUp" data-wow-delay="0.4s">Testimonials</h4>
                        <div class="latest-stories">
                            <div class="stories-image">
                                <a href="#"><img src="images/spa/happy-young-beautiful-couple-enjoying-head-massage-spa.jpg" class="img-responsive" alt=""></a>
                            </div>
                            <div class="stories-info">
                                <a href="#">
                                    <h5>"Amazing Masssage Therapy"</h5>
                                </a>
                                <span> By: Maria Hill</span>
                            </div>
                        </div>

                        <div class="latest-stories">
                            <div class="stories-image">
                                <a href="#"><img src="images/spa/sportsmassagetherapy.jpg" class="img-responsive" alt=""></a>
                            </div>
                            <div class="stories-info">
                                <a href="#">
                                    <h5>"Sensational relief"</h5>
                                </a>
                                <span>By: Princess Mthethwa</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="footer-thumb">
                        <div class="opening-hours">
                            <h4 class="wow fadeInUp" data-wow-delay="0.4s">Opening Hours</h4>
                            <p>Monday - Friday <span>06:00 AM - 10:00 PM</span></p>
                            <p>Saturday <span>09:00 AM - 08:00 PM</span></p>
                            <p>Sunday <span>Closed</span></p>
                        </div>

                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-instagram"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 border-top">
                    <div class="col-md-4 col-sm-6">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2021

                                | Designed by: Mlungisi Mcvillan</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="footer-link">
                            <a href="#">Make an Apointment</a>
                            <a href="#">Refund Policy</a>
                            <a href="#">About us</a>
                            <a href="#">Covid 19</a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 text-align-center">
                        <div class="angle-up-btn">
                            <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>


    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>