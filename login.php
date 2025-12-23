<?php

include("config.php");

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=DEFAULT_TITLE?> | Login</title>

<?php

include("include/head.php");

?>

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/parsley/parsley.js"></script>

</head>



<body>



<div id="loading">

    <div class="spinner">

        <div class="bounce1"></div>

        <div class="bounce2"></div>

        <div class="bounce3"></div>

    </div>

</div>



<style type="text/css">



    html,body {

        height: 100%;

    }



</style>

<?php /*?><img src="<?=BASE_URL?>assets/image-resources/blurred-bg/travel-bgss.jpg" class="login-img wow fadeIn" alt=""><?php */?>



<div class="center-vertical">

    <div class="center-content row">

        <form action="ajax/login.php" id="login_form" class="col-md-4 col-sm-5 col-xs-11 col-lg-3 center-margin" method="post" data-parsley-validate="">

            <h3 class="text-center pad45B font-black text-transform-upr font-size-23">Admin</h3>

            <div id="login-form" class="content-box">

                <div class="content-box-wrapper pad20A">

                   <?php /*?> <img class="mrg25B center-margin display-block" src="<?=BASE_URL?>assets/image-resources/logo.png" width="60%"  alt=""><?php */?>

					  <img class="mrg25B center-margin display-block" src="<?=BASE_URL?>assets/images/logo.png" width="60%"  alt="">
					
                    <div class="form-group">

                      <label for="exampleInputEmail1">Email address:</label>

                        <div class="input-group">

                            <!--<span class="input-group-addon addon-inside bg-white font-primary">

                                <i class="glyph-icon icon-envelope-o"></i>

                            </span>-->

                            <input type="email" name="email" id="email" required class="form-control" placeholder="Enter email"/>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="exampleInputPassword1">Password:</label>

                        <div class="input-group">

                            <!--<span class="input-group-addon addon-inside bg-white font-primary">

                                <i class="glyph-icon icon-unlock-alt"></i>

                            </span>-->

                            <input type="password" name="password" required class="form-control" placeholder="Password"/>

                        </div>

                    </div>
                    
           
                </div>

                <div class="button-pane">

                    <input type="submit" id="login_button" class="btn btn-block btn-primary" value="Login"/>

                   

                </div>

            </div>



            <div id="login-forgot" class="content-box modal-content hide">

                <div class="content-box-wrapper pad20A">



                    <div class="form-group">

                        <label for="exampleInputEmail1">Email address:</label>

                        <div class="input-group input-group-lg">

                            <span class="input-group-addon addon-inside bg-white font-primary">

                                <i class="glyph-icon icon-envelope-o"></i>

                            </span>

                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">

                        </div>

                    </div>

                </div>

                <div class="button-pane text-center">

                    <button type="button" class="btn btn-md btn-primary">Recover Password</button>

                    <a href="#" class="btn btn-md btn-link switch-button" switch-target="#login-form" switch-parent="#login-forgot" title="Cancel">Cancel</a>

                </div>

            </div>



        </form>



    </div>

</div>

<script type="text/javascript">

$(document).ready(function(){



$( "#login_form" ).submit(function(e) {

      e.preventDefault();

	  var f = $('#login_form');

	  var l = $('#ajax_loading'); // loder.gif image

	  var b = $("#login_button"); // upload button

	  var p = $('#error'); // preview area

	 

	 $.ajax({

		    url:'ajax/login.php',

			type:"POST",

			dataType:"json",

			data:f.serialize(),

			beforeSend:function()

			 {

			  b.attr("disabled","disabled");

			  b.val("Please Wait...");

			 },

			success:function(r)

			 {

			  

			  if(r.status=="success")	 

			   {

				 noty({

					  text: "You have been logged in successfully. Please wait while you are redirecting",

					  type: 'success',

					  dismissQueue: true,

					  theme: 'agileUI',

					  layout: 'top'

          			});

				window.location="index.php";

			   }

			 else

			   {

				var n = noty({

					  text: r.msg,

					  type: 'error',

					  dismissQueue: true,

					  theme: 'agileUI',

					  layout: 'top'

          			});

			    n.setTimeout(2000);

			    b.removeAttr("disabled")

			    b.val("Login");

		     }  

			 },
             error:function()
             {
                b.removeAttr("disabled")

                b.val("Login");
             }

		    })

});

});

</script>

<?php

include("include/footer-js.php");

?>

</body>

</html>

