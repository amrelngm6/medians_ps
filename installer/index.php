<?php

$libs = ['Core', 'libxml', 'gd', 'mbstring', 'zlib', 'bcmath'];

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
    <link rel="stylesheet" href="./vendor/nouislider/nouislider.min.css">
    
    <!-- Main css -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div class="main">

        <div class="container">
            <form method="POST"  class="signup-form" id="signup-form" action="./install.php">
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
                                    <input type="text" required name="db_name" id="db_name" value="" />
                                </div>
                            </div>
                            <div class="form-flex">
                                <div class="form-group">
                                    <label for="db_user" class="form-label">Database user</label>
                                    <input type="text" required name="db_user" id="db_user"  value="" />
                                </div>
                                <div class="form-group">
                                    <label for="db_password" class="form-label">Database password</label>
                                    <input type="text" name="db_password" id="db_password" value="" />
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h3>Account information</h3>
                    <fieldset>
                        <h2>Business Account information</h2>
                        <p class="desc">Make sure your installer folder has been deleted from your directory.</p>
                        <div class="fieldset-content">

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
                            <hr />
                            <h4>Main Branch info</h4>
                            <div class="form-group">
                                <label for="branch_name" class="form-label">Branh name</label>
                                <input type="text" value="Medians DDD" required name="branch[name]" id="user_name" />
                            </div>
                        </div>
                    </fieldset>

                    <h3>Finish</h3>
                    <fieldset>
                        <h2>We are finished</h2>
                        <p class="desc">Make sure your installer folder has been deleted from your directory.</p>
                        <div class="fieldset-content">
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="./vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="./vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="./vendor/minimalist-picker/dobpicker.js"></script>
    <script src="./vendor/nouislider/nouislider.min.js"></script>
    <script src="./vendor/wnumb/wNumb.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>