<?php

$libs = ['Core', 'libxml', 'gd', 'mbstring', 'test', 'zlib', 'bcmath'];

$foundLibs = [];

foreach ($libs as $i => $ext)
{
   if (in_array($ext, get_loaded_extensions()))
   {
      $libs[$i] = ['name'=>  $ext, 'version'=> phpversion($ext)];
   } 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medians setup form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="//gaming.medianssolutions.com/installer/vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="//gaming.medianssolutions.com/installer/css/style.css">
</head>

<body>

    <div class="main">

        <div class="container">
            <form method="POST" id="signup-form" class="signup-form" action="#">
                <div>
                    <h3>Check requirements</h3>
                    <fieldset>
                        <h2>Check requirements</h2>
                        <p class="desc">Please make sure all requirements are available before installing</p>
                        <div class="fieldset-content">
                            <?php foreach ($libs as $key => $value) { ?>
                            <div class="form-flex" >
                                <label class="form-label"><?php echo is_array($value) ? $value['name'] : $value; ?></label>
                                <span style="min-width: 200px;"><?php echo is_array($value) ? ($value['version'] >= 8 ? $value['version'] : '<span style="color:red">Found: '.$value['version'].' </span> REQUIRED 8+') : '<span style="color:red">REQUIRED</span>'; ?></span>
                            </div>
                            <hr style="opacity: 0.5" />
                            <?php } ?>
                        </div>
                    </fieldset>

                    <h3>Database information</h3>
                    <fieldset>
                        <h2>Database information</h2>
                        <p class="desc">Please add your database server information</p>
                        <div class="fieldset-content">
                            <div class="form-flex">
                                <div class="form-group">
                                    <label for="db_host" class="form-label">Database host</label>
                                    <input type="text" required name="db_host" id="db_host" value="localhost" />
                                    <span class="text-input" style="margin-bottom: 10px;">Example  :<span>  localhost</span></span>
                                </div>
                                <div class="form-group" >
                                    <label for="db_name" class="form-label">Database name</label>
                                    <input type="text" required name="db_name" id="db_name" />
                                </div>
                            </div>
                            <div class="form-flex">
                                <div class="form-group">
                                    <label for="db_user" class="form-label">Database user</label>
                                    <input type="text" required name="db_user" id="db_user" />
                                </div>
                                <div class="form-group">
                                    <label for="db_password" class="form-label">Database password</label>
                                    <input type="text" name="db_password" id="db_password" />
                                </div>
                            </div>
                            <hr />
                            <h4>Administrator info</h4>
                            <div class="form-group">
                                <label for="user_name" class="form-label">Admin name</label>
                                <input type="text" value="Admin" required name="user[name]" id="user_name" />
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="form-label">Admin email</label>
                                <input type="email"  value="admin@a.com" required name="user[email]" id="user_email" />
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="form-label">Admin password</label>
                                <input type="text"  value="123456" required name="user[password]" id="user_password" />
                            </div>
                        </div>
                    </fieldset>

                    <h3>Finish</h3>
                    <fieldset>
                        <h2>We are finished</h2>
                        <p class="desc">Set up your money limit to reach the future plan</p>
                        <div class="fieldset-content">
                            <div class="donate-us">
                                <div class="price_slider ui-slider ui-slider-horizontal">
                                    <div id="slider-margin"></div>
                                    <p class="your-money">
                                        Your money you can spend per month :
                                        <span class="money" id="value-lower"></span>
                                        <span class="money" id="value-upper"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="//gaming.medianssolutions.com/installer/vendor/jquery/jquery.min.js"></script>
    <script src="//gaming.medianssolutions.com/installer/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="//gaming.medianssolutions.com/installer/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="//gaming.medianssolutions.com/installer/vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="//gaming.medianssolutions.com/installer/vendor/minimalist-picker/dobpicker.js"></script>
    <script src="//gaming.medianssolutions.com/installer/vendor/nouislider/nouislider.min.js"></script>
    <script src="//gaming.medianssolutions.com/installer/vendor/wnumb/wNumb.js"></script>
    <script src="//gaming.medianssolutions.com/installer/js/main.js"></script>
</body>

</html>