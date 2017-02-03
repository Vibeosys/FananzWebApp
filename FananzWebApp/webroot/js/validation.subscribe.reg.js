$(document).ready(function () {
    $("#frmCorporateRegistration").validate({
        rules: {
            cor_business_name: {
                required: true,
                minlength: 5
            },
            cor_represent_name: {
                required: true,
                minlength: 3
            },
            cor_email: {
                required: true,
                email: true
            },
            cor_password: {
                required: true,
                minlength: 5
            },
            cor_tel_no: {
                minlength: 10,
                maxlength: 10
            },
            cor_mob_no: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            cor_website_name: {
                required: true,
                minlength: 5
            },
            cor_country: {
                required: true,
                minlength: 3
            },
            trade_certificate: {
                required: true,
            }
        },
        messages: {
            cor_business_name: {
                required: "Please enter a business name",
                minlength: "Your username must consist of at least 5 characters"
            },
            cor_represent_name: {
                required: "Please enter a representative name",
                minlength: "Your username must consist of at least 3 characters"
            },
            cor_email: {
                required: "Please enter a email",
                email: "Please enter a valid email address"
            },
            cor_password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 5 characters long"
            },
            cor_tel_no: {
                minlength: "Your telephone must consist of at least 10 digits"
            },
            cor_mob_no: {
                required: "Please enter a mobile no",
                minlength: "Your mobile must consist of at least 10 digits"
            },
            cor_website_name: "Please enter a website name",
            cor_country: "Please enter a country",
            trade_certificate: "Please Select Trade Certificate"
        }
    });
    $("#frmFreelanceRegistration").validate({
        rules: {
            nick_name: {
                required: true,
                minlength: 5
            },
            dob: {
                required: true
            },
            fl_email: {
                required: true,
                email: true
            },
            fl_password: {
                required: true,
                minlength: 5
            },
            fl_tel_no: {
                minlength: 10,
                maxlength: 10
            },
            fl_mob_no: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            fl_website_name: {
                required: true,
                minlength: 5
            },
            fl_country: {
                required: true,
                minlength: 3
            },
            freelance_check: {
                required: true
            }
        },
        messages: {
            nick_name: {
                required: "Please enter a name",
                minlength: "Your username must consist of at least 5 characters"
            },
            dob: {
                required: "Please enter a  date of birth"
            },
            fl_email: {
                required: "Please enter a email",
                email: "Please enter a valid email address"
            },
            fl_password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 5 characters long"
            },
            fl_tel_no: {
                minlength: "Your telephone must consist of at least 10 digits"
            },
            fl_mob_no: {
                required: "Please enter a mobile no",
                minlength: "Your mobile must consist of at least 10 digits"
            },
            fl_website_name: "Please enter a website name",
            fl_country: "Please enter a country",
            freelance_check: "Please agree our Terms & Conditions"
        }
    });
    $("#login").validate({
        rules: {
            firstName: {
                required: true,
                minlength: 3
            },
            lastName: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            mobileNo: {
                required: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            firstName: {
                required: "Please enter a first name",
                minlength: "Your username must consist of at least 5 characters"
            },
            lastName: {
                required: "Please enter a last name",
                minlength: "Your username must consist of at least 3 characters"
            },
            email: {
                required: "Please enter a email",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 5 characters long"
            },
            mobileNo: {
                required: "Please enter a mobile no",
                minlength: "Your mobile must consist of at least 10 digits"
            }
        }
    });
    $("#spec_form").validate({
        rules: {
            spec_name: {
                required: true,
                minlength: 3
            },
            spec_email: {
                required: true,
                email: true
            },
            spec_mobile: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            spec_msg: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            spec_name: {
                required: "Please enter a first name",
                minlength: "Your username must consist of at least 5 characters"
            },
            spec_email: {
                required: "Please enter a email",
                email: "Please enter a valid email address"
            },
            spec_mobile: {
                required: "Please enter a mobile no",
                minlength: "Your mobile must consist of at least 10 digits"
            },
            spec_msg: {
                required: "Please enter a message",
                minlength: "Your message must be at least 5 characters long"
            },
        },
        submitHandler: function (form) {
            var name = $('#name').val();
            var email = $('#email').val();
            var mobNo = $('#mobNo').val();
            var yourRequest = $('#spec_msg').val();
            
            $.ajax({
                url: WEBSITE_VIRTUAL_DIR_NAME + '/HomePage/specialRequest',
                type: 'POST',
                dataType: 'json',
                data: {
                    name: name,
                    email: email,
                    mobNo: mobNo,
                    yourRequest: yourRequest
                },
                success: function (result, jqXHR) {
                    if (result)
                    {
                        swal('Special request', 'Email has been sent, we will contact you soon', 'success');
                        //alert('done');
                    }
                    
                }

            });
            return false;  // blocks regular submit since you have ajax
        }
    });
    $("#frmAddPortfolio").validate({
			rules: {
				min_price: {
					required: true,
					number: true
				},
                max_price: {
					required: true,
					number: true
				},
                corpo_self:{
                    required: true,
                },
                select_cat: {
					min: 1
                    // valueNotEquals: "Please select Categories"
				},
                coverImage :{
                    required: true,
                   // accept: "image/*"
                }
			},
			messages: {
				min_price: {
					required: "Please enter a minimum price"
				},
				max_price: {
                    required: "Please enter a maximum price"
                },
				corpo_self: {
					required: "Please enter a message",
				},
                select_cat:{
                    min: "Please select Categories"
                    //valueNotEquals: "Select Category"
                },
                coverImage :{
                    required: "Please select cover image",
                   // accept: "Please select only image"
                }
            }
//             submitHandler: function(form) {
//                 
//                return;  // blocks regular submit since you have ajax
//             }
		  });
    $("#frmUpdatePortfolio").validate({
			rules: {
				min_price: {
					required: true,
					number: true
				},
                max_price: {
					required: true,
					number: true
				},
                corpo_self:{
                    required: true,
                },
                select_cat: {
					min: 1
                    // valueNotEquals: "Please select Categories"
				}
//                coverImage :{
//                    required: true,
//                   // accept: "image/*"
//                }
			},
			messages: {
				min_price: {
					required: "Please enter a minimum price"
				},
				max_price: {
                    required: "Please enter a maximum price"
                },
				corpo_self: {
					required: "Please enter a message",
				},
                select_cat:{
                    min: "Please select Categories"
                    //valueNotEquals: "Select Category"
                }
//                coverImage :{
//                    required: "Please select cover image",
//                   // accept: "Please select only image"
//                }
            }
//             submitHandler: function(form) {
//                 
//                return;  // blocks regular submit since you have ajax
//             }
		  });

    $('.cor_submit').attr('disabled', 'disabled');
    $('.cor_submit').css('cursor', 'not-allowed');
    $('.fl_submit').attr('disabled', 'disabled');
    $('.fl_submit').css('cursor', 'not-allowed');
    $('#register').attr('disabled', 'disabled');
    $('#register').css('cursor', 'not-allowed');

    $('#cor_check').bind('change', function () {
        if ($(this).is(':checked')) {
            $(".cor_submit").removeAttr('disabled');
            $('.cor_submit').css('cursor', 'pointer');// checked 
        }
        else {
            $(".cor_submit").attr('disabled', 'disabled');
            $('.cor_submit').css('cursor', 'not-allowed');
        }
    });

    $('#freelance_check').bind('change', function () {
        if ($(this).is(':checked')) {
            $(".fl_submit").removeAttr('disabled');
            $('.fl_submit').css('cursor', 'pointer');// checked 
        }
        else {
            $(".fl_submit").attr('disabled', 'disabled');
            $('.fl_submit').css('cursor', 'not-allowed');
        }
    });

    $('#user_check').bind('change', function () {
        if ($(this).is(':checked')) {
            $("#register").removeAttr('disabled');
            $('#register').css('cursor', 'pointer');// checked 
        }
        else {
            $("#register").attr('disabled', 'disabled');
            $('#register').css('cursor', 'not-allowed');
        }
    });
});