

<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>IIA Zadanie 2</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <style>
        .username-field {
          margin-top: 15px;
          text-align: center;
        }
        
        .sweetcaptcha {
          margin:20px auto !important;
          margin-top: 0px !important;
        }
        #chat-users > * {
          display: block;
          margin-bottom: 5px;
        }
        #chat-container {
          height: 400px;
          overflow-y: scroll;
        }
        .message-container {
          padding: 10px;
          margin:6px;
          background: #f5f5f5;
          font-size: 13px;
          -moz-border-radius: 5px;
          -webkit-border-radius: 5px;
          border-radius: 5px;
        }
        .badge-danger {
          background:red;
        }
        #chat-logout {
          display: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/z3">IIA Zadanie 4</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li><button id="chat-logout" class="btn btn-danger navbar-btn">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
  <?php

// require sweetcaptcha php sdk, don't forget to set up your credentials first
require_once('sweetcaptcha.php');
require_once('redirect.php');
session_start();
if (empty($_POST)) {
  // print sweetcaptcha in your form
?>

  <form method="post">
    <!-- implement sweetcaptcha -->
    <h1 class="text-center">Prihlás sa do chatu ako</h1>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <?php if(isset($_SESSION["message"])): ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php echo $_SESSION["message"]; ?>
                <?php unset($_SESSION["message"]); ?>
            </div>
            <div class="form-group has-warning">
          <?php else: ?>
            <div class="form-group">
          <?php endif; ?>
          <input name="username" type="text" class="username-field form-control">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="text-center custom-sweetcaptcha">
          <?php echo $sweetcaptcha->get_html() ?>
          <input type="submit" class="btn btn-success"/>
        </div>
      </div>
    </div>
    
    <!-- continue with your form -->
    
  </form>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<?php

} else { 

  // looks like someone has submitted a form, let's validate it
  if (isset($_POST['sckey']) and isset($_POST['scvalue']) and $sweetcaptcha->check(array('sckey' => $_POST['sckey'], 'scvalue' => $_POST['scvalue'])) == "true") { 
    if(empty($_POST["username"])) {
      \IIA\movePage(200,'/z4/chat.php');
      $_SESSION["message"] = "Nezabudni si vybrat nejaké meno :)";
    }
    ?>
    
  <div class="container">
    <h3>Vitaj <span id="chat-username" class="label label-success"><?php echo $_POST["username"]; ?></span></h3>
    <div class="row">
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <div id="chat-container">
            
            </div>
          </div>
          <div class="panel-footer">
            <form id="form">
              <div class="input-group">
                
                  <input type="text" id="message-body" class="form-control">
                  <span class="input-group-btn">
                    <button id="message-send" class="btn btn-primary" type="button">Odošli</button>
                  </span>
              </div><!-- /input-group -->
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="panel panel-default">
          <div class="panel-body">
            <h5>Prihlásení používatelia: <span id="chat-users-count" class="badge badge-danger"></span></h5>
            <div id="chat-users">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.firebase.com/js/client/1.1.2/firebase.js"></script>
<script src="js/chat.js"></script>
  <?php
  }
  else {
    // alas! the validation has failed, the user might be a spam bot or just got the result wrong
    // handle this as you like
    echo "Boohoo! captcha validation failed!";

  }

}
?>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.min.js"></script>
</body>
</html>