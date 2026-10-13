<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=env('APP');?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url();?>assets/min/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/min/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/min/css/style.css">
    <meta name="robots" content="noindex">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?=base_url();?>assets/min/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo text-center">
                  <img src="<?=base_url();?>assets/img/logo-tridi.png">
                </div>
                <h4 class="text-danger font-weight-light text-center"><?=!empty($session['message']) ? $session['message'] : "";?></h4>
                <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                <form class="pt-3" method="POST" action="<?=base_url();?>auth/login">
                  <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" autofocus>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group text-center">
                    <img src="<?php //echo $builder->inline(); ?>" />
                  </div>
                  <div class="form-group">
                    <input type="text" name="captcha" class="form-control form-control-lg" id="captcha" placeholder="Enter Captca">
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn" href="index.html">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?=base_url();?>assets/min/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?=base_url();?>assets/min/js/off-canvas.js"></script>
    <script src="<?=base_url();?>assets/min/js/hoverable-collapse.js"></script>
    <script src="<?=base_url();?>assets/min/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>