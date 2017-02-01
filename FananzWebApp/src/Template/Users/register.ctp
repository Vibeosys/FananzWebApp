
<?php
//$this->layout = 'home_layout';
echo $this->element('admin_header');
?>

<section class="corporate-register">
    <div class="container">
        <form id="login" action="register" method="post" class="form form--login">
            <div class="row">
                <div class="register-wrapper">
                    <div class="register-form-container">
                        <div class="col-lg-12">
                            <div class="page-title">
                                <h3>Register Now</h3>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="error-msg-container">
                                <div class="<?= $errorDivClass ?>">
                                    <p><i class="fa fa-minus-circle"></i> <?= $errorMsg ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="user_fname">First Name<span class="required_field"> *</span>
                                    <span id="Name_msg" class="error_red valid_Name_msg" style="display: none">
                                        Please Enter Your Name
                                    </span>
                                    <span id="name_ptn" class="error_red valid_name_ptn" style="display: none">
                                        Please Enter Valid Name
                                    </span>
                                    <input type="text" id="user_fname" class="form-control valid_name" name="firstName">
                                    <span class="input-icon"><i class="fa fa-user"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="user_lname">Last Name<span class="required_field"> *</span>
                                    <span id="Email_msg" class="error_red valid_lastName_msg" style="display: none">
                                        Please Enter Your Last Name
                                    </span>
                                    <input type="text" id="user_lname" class="form-control valid_last_name" name="lastName">
                                    <span class="input-icon"><i class="fa fa-user"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="user_email">Email<span class="required_field"> *</span>
                                    <span id="Email_msg" class="error_red valid_Email_msg" style="display: none">
                                        Please Enter Your Email Id
                                    </span>
                                    <span id="Email_ptn" class="error_red valid_Email_ptn" style="display: none">
                                        Please Enter Valid Email Id
                                    </span>
                                    <input type="email" id="user_email" class="form-control valid_email" name="email">
                                    <span class="input-icon"><i class="fa fa-envelope-open-o"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="user_mob_no">Mobile No<span class="required_field"> *</span>

                                    <input type="tel" id="user_mob_no" class="form-control valid_mobNo" name="mobileNo">
                                    <span class="input-icon"><i class="fa fa-mobile fa-1-5x"></i></span>
                                </label>
                            </div>
                        </div>  <div class="col-lg-12">
                            <div class="form-group">
                                <label for="password">Password<span class="required_field"> *</span>
                                    <span id="mobNo_msg" class="error_red valid_pass_msg" style="display: none">
                                        Please Enter Your password
                                    </span>
                                    <input type="password" id="password" class="form-control valid_password" name="password">
                                    <button type="button" id="show_pwd1">  <i class="fa fa-eye" id="show_icon1"></i></button>
                                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                                </label>
                            </div>
                        </div>  


                        <div class="col-lg-12">
                            <div class="form-group login-check">
                                <input type="checkbox" id="user_check" value="">
                                <label for="user_check"><span></span>I agree to <a href="#termCondModal" class="portfolio-link" data-toggle="modal">Terms & Conditions</a>.</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="button-set">
                                    <button type="submit" title="Submit" id="register" name="register" class="button black_sm">Submit</button>
                                    <a href="/FananzWebApp/users/customerlogin" class="white_back_btn">Back</a>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


<div class="register-modal modal fade" id="termCondModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header-modal"> Terms & Conditions</div>

            <div class="modal-body">
                <ul>
                    <li>No Refunds at any case.</li>
                    <li>You Verify that you own all the images, info and website of the registered corporate. </li>
                    <li>By agreeing to this term and conditions you accept that golden circle can talk with clients on your behalf. </li>
                    <li>Golden circle has the right to charge 10% of the total invoice as service charge.</li>
                    <li>In case client has comments on the work done Golden Circle has the right to hold the paid amount till the job is done properly.</li>
                </ul>
                <button type="button" class="btn btn-primary center-block" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>




<?php
echo $this->element('footer');
?>

<script>

    $(document).ready(function () {
        $('#register').on('click', function () {
            //   alert('here');
            formValidation();

//            $.ajax({
//                type: 'POST',
//                url: '/FananzWebApp/HomePage/specialRequest',
//                data: {
//                    name: name,
//                    email: email,
//                    mobNo: mobNo,
//                    yourRequest: yourRequest
//                },
//                dataType: 'json',
//                success: function (result, jqXHR) {
//                    if (result)
//                    {
//
//                    }
//                }
//
//            });
        });
    });



</script>