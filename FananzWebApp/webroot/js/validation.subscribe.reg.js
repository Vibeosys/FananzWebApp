$(document).ready(function() {
    $("#corporate_form").validate({
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
//                cor_tel_no: {
//					required: true,
//					minlength: 10,
//                    maxlength: 12
//				},
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
				}
//				cor_check: {
//                    required : true
//                }
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
//                cor_tel_no: {
//					required: "Please enter a Telephone no",
//					minlength: "Your telephone must consist of at least 10 to 12 digits"
//				},
                cor_mob_no: {
					required: "Please enter a mobile no",
					minlength: "Your mobile must consist of at least 10 digits"
				},
                cor_website_name: "Please enter a website name",
                cor_country: "Please enter a country"
				//cor_check: "Please agree our Terms & Conditions"                
			}
		});
        $("#freelance_form").validate({
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
//                fl_tel_no: {
//					required: true,
//					minlength: 10,
//                    maxlength: 12
//				},
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
                    required : true
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
//                fl_tel_no: {
//					required: "Please enter a Telephone no",
//					minlength: "Your telephone must consist of at least 10 to 12 digits"
//				},
                fl_mob_no: {
					required: "Please enter a mobile no",
					minlength: "Your mobile must consist of at least 10 digits"
				},
                fl_website_name: "Please enter a website name",
                fl_country: "Please enter a country",
				freelance_check: "Please agree our Terms & Conditions"                
			}
		});
    
    $('.cor_submit').on('click', function(){
        if ($('#cor_check').is(':checked')){
        $(".error-check.cor-error").text('');  // checked 
    }    
    else{
         $(".error-check.cor-error").text('Please agree our Terms & Conditions'); 
    }
});
    
    $('#cor_check').bind('change', function () {
   if ($(this).is(':checked'))
    $(".error-check.cor-error").text('');
   else
     $(".error-check.cor-error").text('Please agree our Terms & Conditions'); 
    });
    
    $('.fl_submit').on('click', function(){
        if ($('#freelance_check').is(':checked')){
        $(".error-check.fl-error").text('');  // checked 
    }    
    else{
         $(".error-check.fl-error").text('Please agree our Terms & Conditions'); 
    }
});
    
    $('#freelance_check').bind('change', function () {
   if ($(this).is(':checked'))
    $(".error-check.fl-error").text('');
   else
     $(".error-check.fl-error").text('Please agree our Terms & Conditions'); 
    });
    
});