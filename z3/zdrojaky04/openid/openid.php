<?php require '../../../lightopenid/openid.php';
try 
{   $openid = new LightOpenID('http://vmzakova2.fei.stuba.sk/');
    if(!$openid->mode) {
       if(isset($_GET['login'])) 
       {  $openid->identity = 'https://www.google.com/accounts/o8/id';
          header('Location: ' . $openid->authUrl()); }
?>
<form action="?login" method="post">
    <button>Login with Google</button>
</form>
<?php 
    } elseif($openid->mode == 'cancel') 
        { echo 'User has canceled authentication!'; } 
      else 
        { echo 'User ' . ($openid->validate() ? $openid->identity . 
               ' has ' : 'has not ') . 'logged in.';  }
} 
catch(ErrorException $e) { echo $e->getMessage(); }
