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
<!-- saved from url=(0055) -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Medians SaaS Trips Installer Wizard</title>
  <link href="./assets/css.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/materialdesignicons.min.css">
  <link rel="stylesheet" href="./assets/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/bd-wizard.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-light bg-white">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="../uploads/img/logo.png" alt="logo"></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
          aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
  </header>
  <main class="d-flex align-items-center">
    <div class="container">
      <form method="POST"  id="setup-form" action="/installer/install.php">
        <div id="wizard">
          <h3>Validation</h3>
          <section>
           <h5 class="bd-wizard-step-title">Validate requirements</h5>
           <h2 class="section-heading">Check requirements </h2>
           <p>Please make sure all requirements are available before installing</p>
           
            <?php foreach ($libs as $key => $value) { ?>
              <p  style="display: flex;">
                  <span id="enteredFirstName" style="width: 100%;"><?php echo is_array($value) ? $value['name'] : $value; ?></span> 
                  <span id="enteredLastName"><?php echo is_array($value) ? ($value['version'] >= 8 ? $value['version'] : '<span style="color:red">Found: '.$value['version'].' </span> REQUIRED 8+') : '<span style="color:red">REQUIRED</span>'; ?></span> 
              </p>
              <hr style="opacity: 0.5" />
              <?php } ?>
          </section>

          <h3>Step 2 Title</h3>
          <section>
              <h5 class="bd-wizard-step-title">Step 2</h5>
              <h2 class="section-heading">Enter your Database Details</h2>
              <div class="form-group">
                <label for="db_host" class="sr-only">Database host</label>
                <input type="text" required name="db_host" id="db_host" value="localhost" class="form-control" placeholder="Database host">
              </div>
              <div class="form-group">
                <label for="db_name" class="sr-only">Database name</label>
                <input type="text" required name="db_name" id="db_name" class="form-control" placeholder="Database name">
              </div>
              <div class="form-group">
                <label for="db_user" class="sr-only">Database user</label>
                <input type="text" required name="db_user" id="db_user" class="form-control" placeholder="Database user">
              </div>
              <div class="form-group">
                <label for="db_password" class="sr-only">Database password</label>
                <input type="password" required min="5" name="db_password" id="db_password" class="form-control" placeholder="Database password">
              </div>
          </section>
          <h3>Step 3 Title</h3>
          <section>
            <h5 class="bd-wizard-step-title">Step 3</h5>
            <h2 class="section-heading">Enter your Master admin information</h2>
            <div class="form-group">
              <label for="user_name" class="sr-only">Admin name</label>
              <input type="text" required name="user[name]" id="user_name" class="form-control" placeholder="Admin name">
            </div>
            <div class="form-group">
              <label for="user_email" class="sr-only">Admin email</label>
              <input type="text" required name="user[email]" id="user_email" class="form-control" placeholder="Database email">
            </div>
            <div class="form-group">
              <label for="user_password" class="sr-only">Admin password</label>
              <input type="password" required min="5" name="user[password]" id="user_password" class="form-control" placeholder="Admin password">
            </div>
          </section>
          <h3>Step 4 Title</h3>
          <section>
              <h5 class="bd-wizard-step-title">Step 4</h5>
              <h2 class="section-heading mb-5">We are finished</h2>
              <p class="desc">Make sure your installer folder has been deleted from your directory.</p>
          </section>
        </div>
      </form>
    </div>
  </main>

  <script src="./assets/jquery-3.4.1.min.js"></script>
  <script src="./assets/popper.min.js"></script>
  <script src="./assets/bootstrap.min.js"></script>
  <script src="./assets/jquery.steps.min.js"></script>
  <script src="./assets/bd-wizard.js"></script>


</body></html>