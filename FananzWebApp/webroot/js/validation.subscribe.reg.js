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
                cor_tel_no: {
					required: true,
					minlength: 10,
                    maxlength: 12
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
				cor_check: "required"
			},
			messages: {
				cor_business_name: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 5 characters"
				},
                cor_represent_name: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 3 characters"
				},
				cor_email: {
                    required: "Please provide a email",
                    email: "Please enter a valid email address"
                },
				cor_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
                cor_tel_no: {
					required: "Please enter a Telephone no",
					minlength: "Your telephone must consist of at least 10 to 12 digits"
				},
                cor_mob_no: {
					required: "Please enter a mobile no",
					minlength: "Your mobile must consist of at least 10 digits"
				},
                cor_website_name: "Please provide a website name",
                cor_country: "Please provide a country",
				agree: "Please agree our Terms & Conditions",
                
			}
		});
});