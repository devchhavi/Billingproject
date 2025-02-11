<?php
session_start();
if (isset($_SESSION['m_id'])) {
    session_unset();
    session_destroy();
}
?>
<!doctype html>
<html lang="en">
    <?php
    include_once './include/ram.php';
    require_once './include/db.php';
    $ramObj = new ram;
    ?>

    <head>
        <meta charset="utf-8" />
        <title>Raj</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Futurerise" name="description" />
        <meta content="Edward" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="admin/assets/images/Vasta.png">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />



    </head>
    <body>
      
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            
                           <!-- <img src="admin/assets/images/Vasta.png" style="width: 200px;margin-top: 25px;margin-left: 100px;"> -->
                            <div class="card-body pt-5">
                                <div class="p-2">
                                    <?php $ramObj->Login(); ?>
                                    <form class="form-horizontal" method="post" action="">

                                        <div class="form-group">
                                            <label for="member_id">User ID</label>
                                            <input type="text" name="member_id" id="member_id" onblur="checkId()" class="form-control" placeholder="Enter UserId">
                                            <div class="text-danger" id="errorOfEmail"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" onblur="checkPassword()" name="password" required class="form-control" placeholder="Enter password">
                                            <div class="text-danger" id="errorOfPassword"></div>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                            <label class="custom-control-label" for="remember">Remember me</label>
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit" name="login">Log In</button>
                                        </div>

                                        <div class="mt-5 text-center">
                          
                            <p>© 2024 Raj Building Material </p>
                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                      

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
    <script>
                                                function checkId() {
                                                    var val = document.getElementById('member_id').value;
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "check_email.php",
                                                        data: 'id=' + val,
                                                        success: function (data) {
                                                            var n = data.length;

                                                            if (data.trim() =="") {
                                                                document.getElementById('errorOfEmail').innerHTML = data;

                                                            } else {
                                                                document.getElementById('member_id').value = "";
                                                                document.getElementById('errorOfEmail').innerHTML = data;

                                                            }
                                                        }
                                                    });
                                                }

                                                function checkPassword() {
                                                    var val = document.getElementById('password').value;
                                                    var val2 = document.getElementById('member_id').value;
                                                    if (val2 != "") {
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "check_password.php",
                                                            data: {password: val, email: val2},
                                                            success: function (data) {
                                                                var n = data.length;
                                                                if (data.trim() =="") {
                                                                    document.getElementById('errorOfPassword').innerHTML = data;

                                                                } else {
                                                                    document.getElementById('password').value = "";
                                                                    document.getElementById('errorOfPassword').innerHTML = data;

                                                                }
                                                            }
                                                        });
                                                    }
                                                }
    </script>
</html>