<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
 <body>
        <div class="main-page-wrapper">
          <?php include_once 'includes/menu.php'; ?>

<!--
=====================================================
        Google Map
=====================================================
-->
<!-- Google Map -->
<div class="google-map-two section-spacing">
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58775.19425534691!2d88.40678071837122!3d22.970487431238727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89520233d8901%3A0x510a57b0130c84e9!2sKolkata%2C%20West%20Bengal%20741235!5e0!3m2!1sen!2sin!4v1600253982352!5m2!1sen!2sin" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>


<!-- 
=============================================
        Conatct us Section
============================================== 
-->
<div class="contact-us-section section-spacing">
    <div class="container">
        <div class="theme-title-one">
            <h2>GET IN TOUCH</h2>
        </div> <!-- /.theme-title-one -->
        <div class="clearfix main-content no-gutters row">
            <div class="col-lg-5 col-12">
                <!--                                                    <div class="img-box"></div>-->
                <div style="margin: 50px; background-color: #142b6a; color: #fff; height: 350px;">
                    <div style="padding-top: 20px;">
                        <p style="font-family: 'Source Sans Pro', sans-serif; font-size: 20px; font-weight: 600; text-align: center;">
                            <i class="fa fa-gg-circle"></i>
                            <i class="fa fa-gg-circle"></i><br><br>
                            <i class="fa fa-map-marker"></i> &nbsp;&nbsp; A-9/1A(S), Kalyani,Nadia, West Bengal, Pin- 741235 <br><br>
                            <i class="fa fa-phone"></i> &nbsp;&nbsp;<a style="color: #fff;" href="tel: +91  8420134716"> +91 - 8420134716</a>, +91 6290386699<br><br>
                            <i class="fa fa-envelope"></i> &nbsp;&nbsp;<a style="color: #fff;" href="mailto: vastamarketing@gmail.com"> vastamarketing@gmail.com</a><br><br>
                            <i class="fa fa-gg-circle"></i>
                            <i class="fa fa-gg-circle"></i>
                        </p>
                        
                        
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="form-wrapper">
                    <form action="https://html.creativegigs.net/charles/inc/sendemail.php" class="theme-form-one form-validation" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6 col-12"><input type="text" placeholder="Name *" name="name"></div>
                            <div class="col-sm-6 col-12"><input type="text" placeholder="Phone *" name="phone"></div>
                            <div class="col-sm-6 col-12"><input type="email" placeholder="Email *" name="email"></div>
                            <div class="col-sm-6 col-12"><input type="text" placeholder="Website *" name="web"></div>
                            <div class="col-12"><textarea placeholder="Message" name="message"></textarea></div>
                        </div> <!-- /.row -->
                        <button class="theme-button-one">SEND MESSAGE</button>
                    </form>
                </div> <!-- /.form-wrapper -->
            </div> <!-- /.col- -->
        </div> <!-- /.main-content -->
    </div> <!-- /.container -->

    <!--Contact Form Validation Markup -->
    <!-- Contact alert -->
    <div class="alert-wrapper" id="alert-success">
        <div id="success">
            <button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>
            <div class="wrapper">
                <p>Your message was sent successfully.</p>
            </div>
        </div>
    </div> <!-- End of .alert_wrapper -->
    <div class="alert-wrapper" id="alert-error">
        <div id="error">
            <button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>
            <div class="wrapper">
                <p>Sorry!Something Went Wrong.</p>
            </div>
        </div>
    </div> <!-- End of .alert_wrapper -->
</div> <!-- /.contact-us-section -->



<!-- 
=============================================
        Compnay Branch Address
============================================== 
-->
<!--			<div class="branch-address">
                                <div class="container">
                                        <div class="row">
                                                <div class="address-slider">
                                                        <div class="item">
                                                                <div class="wrapper">
                                                                        <h6>United States Office</h6>
                                                                        <p><i class="fa fa-address-book-o" aria-hidden="true"></i> 23A, Queenstown St, Log Vegas, United States.</p>
                                                                </div>  /.wrapper 
                                                        </div>
                                                        <div class="item">
                                                                <div class="wrapper">
                                                                        <h6>Australia Office</h6>
                                                                        <p><i class="fa fa-address-book-o" aria-hidden="true"></i> consult floor, melbourne, Australia.</p>
                                                                </div>  /.wrapper 
                                                        </div>
                                                        <div class="item">
                                                                <div class="wrapper">
                                                                        <h6>Germany Office</h6>
                                                                        <p><i class="fa fa-address-book-o" aria-hidden="true"></i> no:108, shshi st, berlin, <br> Germany.</p>
                                                                </div>  /.wrapper 
                                                        </div>
                                                        <div class="item">
                                                                <div class="wrapper">
                                                                        <h6>London Office</h6>
                                                                        <p><i class="fa fa-address-book-o" aria-hidden="true"></i> cityhigh, clock bell floor, United Kingdom.</p>
                                                                </div>  /.wrapper 
                                                        </div>
                                                </div>  /.address-slider 
                                        </div>
                                </div>  /.container 
                        </div>  /.branch-address -->




<!--
=====================================================
        Footer
=====================================================
-->
</div>
           <?php include 'includes/footer.php'; ?>
</body>
</html>