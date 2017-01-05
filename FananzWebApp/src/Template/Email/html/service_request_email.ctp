<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <style>
        body{
             font-family: 'Source Sans Pro', sans-serif;
        }
        @media screen and (max-width:500px){
            .main-container{
                width: 320px!important;
            }
            
        }
        @media screen and (max-width:767px){
            
            .main-container{
                width: 480px;
            }
            .image-block{
                width: 100%;
                padding: 10px 0px!important;
                display: block;
                margin: 0 auto;
                text-align: center;
            }
            .service-phone, .service-email,  .cust-fname, .cust-lname, .cust-email , .cust-phone{
                width: 100%;
                border-right:none!important;
                
            }
            .border-top{
                border-top:2px solid #ffa000;
                margin-top: 10px;
                padding-top: 10px;
            }
            
        }
        @media screen and (min-width:768px){
            .main-container{
                width: 600px!important;
            }
            .image-block{
                width: 130px;
            }
            .service-phone, .service-email, .cust-fname, .cust-lname, .cust-email , .cust-phone{
                width: 49%;
            }
        }
    </style>
</head>
<body>
   <div class="main-container" style="margin: 0 auto;display: block;">
      <div style="margin: 25px 25px;border: 2px solid #ffa000;">
         <div>
            <div>
               <h2 style="margin: 0;padding: 6px 14px;background: #FFA000;color: #fff;font-weight: 400;">Service Request</h2>
            </div>
            <div>
               <div class="image-block" style="display: inline-block;padding: 10px;">
                  <img src="<?= $portfolio->coverImageUrl?>" width="120" height="120" style="width: 120px;height: 120px;max-width: 120px;max-height: 120px;">
               </div>
               <div style="display: inline-block;vertical-align: top;width: 290px;padding: 10px;">
                  <h3 style="margin: 0;font-size: 29px;font-weight: 500;"><?= $portfolio->subscriberName?></h3>
                   <span style="display: block;font-size: 20px;padding-bottom: 5px;"><?= $portfolio->contactPerson?></span>
                  <span style="display: block;font-size: 20px;padding-bottom: 5px;color:gray;"><?= $portfolio->subscriberType?></span>
                  <span style="font-size: 18px;"><?= $portfolio->category?> / <?= $portfolio->subcategory?></span>
               </div>
               <div style="padding: 11px;border-top: 2px solid #ffa000;">
                  <div class="service-phone" style="display: inline-block;text-align: center;border-right: 2px solid #ffa000;">
                     <span style="font-size: 17px;text-align: center;color: gray;">Phone</span>
                     <p style="font-size: 20px;color: #545353;margin: 3px 0px;"><?= $portfolio->subscriberPhone?></p>
                  </div>
                  <div class="service-email border-top" style="display: inline-block;text-align: center;">
                     <span style="font-size: 17px;text-align: center;color: gray;">Email</span>
                     <p style="font-size: 20px;color: #545353;margin: 3px 0px;"><?= $portfolio->subscriberEmail?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div style="margin: 25px 25px;border: 2px solid #ffa000;">
         <div>
            <h2 style="margin: 0;padding: 6px 14px;background: #FFA000;color: #fff;font-weight: 400;">Customer Information</h2>
         </div>
         <div style="padding: 11px;">
            <div class="cust-fname" style="display: inline-block;text-align: center;border-right: 2px solid #ffa000;">
               <span style="display: block;font-size: 17px;padding-bottom: 3px;color: gray;">First Name</span>
               <span style="font-size: 20px;color: #545353;"><?= $customer->firstName?></span>
            </div>
            <div class="cust-lname border-top" style="display: inline-block;text-align: center;">
               <span style="display: block;font-size: 17px;padding-bottom: 3px;color: gray;">Last Name</span>
               <span style="font-size: 20px;color: #545353;"><?= $customer->lastName?></span>
            </div>
            <div class="cust-email border-top" style="display: inline-block;text-align: center;border-right: 2px solid #ffa000;margin-top: 25px;">
               <span style="display: block;font-size: 17px;padding-bottom: 3px;color: gray;">Email</span>
               <span style="font-size: 20px;color: #545353;"><?= $customer->emailId?></span>
            </div>
            <div class="cust-phone border-top" style="display: inline-block;text-align: center;margin-top: 25px;">
               <span style="display: block;font-size: 17px;padding-bottom: 3px;color: gray;">Phone no</span>
               <span style="font-size: 20px;color: #545353;"><?= $customer->phoneNo?></span>
            </div>
              <div class="cust-msg border-top" style="display: inline-block;text-align: center;margin-top: 20px;border-top: 2px solid #ffa000;">
               <span style="display: block;font-size: 17px;padding-bottom: 3px;color: gray;">Message</span>
               <span style="font-size: 20px;color: #545353;text-align:left;"><?= $message?></span>
            </div>
         </div>
      </div>
   </div>
</body>
</html>