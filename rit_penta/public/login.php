
<?php



include_once('../global.php'); 


 include_once('../root/functions.php'); 
 include_once('../root/connection.php'); 

 $db=new Database();
$error='';

$message=array(
  null,
  null
);


 



if( isset( $_SESSION[SYSTEM_NAME . 'userid'] ) ) {
  if( $_SESSION['type'] == 'admin' ) {
    header('Location: ' . PATH . 'admin');
  }         
  if( $_SESSION['type'] == 'volunteer' ) {
    header('Location: ' . PATH . 'volunteer' );
  }         
  exit();
}



if(isset($_POST['login'])){

  $username = $_POST['username'];
  $password = $_POST['password'];
  

   $stmnt='select * from nss_log where user_id = :username and user_pwd = :password';
  $params=array( 
   ':username'  =>  $username,
   ':password'  =>  $password
 );

  $user = $db->display($stmnt,$params);
  if($user){
    
   $_SESSION[SYSTEM_NAME . 'userid']=$username;

 
        if($user[0]['user_type'] == 'admin'){

           $_SESSION[SYSTEM_NAME . 'type']='admin'; 
          setLocation(  DIRECTORY_ADMIN );

        } else {

            $_SESSION[SYSTEM_NAME . 'type']='volunteer'; 
          setLocation(  DIRECTORY_VOLUNTEER );

        }



 

   exit();
 } else{ 

      $message [0] = 3;
   $message [1] = 'Incorrect username or password'; 


 }

 
}

  

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   





    <base href="<?php echo DIRECTORY ; ?>">
  <title><?php  echo DISPLAY_NAME; ?></title>

  <link rel="icon" href="assets/image/favicon/favicon.ico">

 
  <link rel="stylesheet" href="assets/css/style.css">  






 


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


<style type="text/css">
  
  html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>



<link rel="shortcut icon" href="assets/image/favicon/favicon.ico" /> 
<script src="assets/js/jquery.min.js"></script> 



  </head>

  <body class="text-center">
    <form class="form-signin bg-white border parsley"  id="userid"  action="" method="post" data-parsley-validate>
      <img class="mb-4" src="assets/image/logob.jpg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
     


 <div class="form-group text-left">
                  <label for="username" class="bmd-label-floating">User Id</label>
                  <div class="">
                    <input id="username" type="email" class="form-control"  placeholdera="Username..." name="username" data-parsley-required="true" data-parsley-type="">
                  </div>
                </div>




                <div class="form-group text-left">
                  <label class="bmd-label-floating">Password</label>
                  <div class="">
                    <input type="password" class="form-control"  placeholdera="Password" name="password" data-parsley-required="true"  data-parsley-type="">
                  </div>
                </div>

                <!-- data-parsley-error-message="my message" -->
    
<?php 





 echo show_error($message); ?>

   
      <button name="login" class="btn btn-lg btn-outline-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>



<script src="assets/js/popper.min.js"></script>  
<script src="assets/js/bootstrap-material-design.min.js"></script> 
<script src="assets/js/jquery.slimscroll.min.js"></script> 
<script src="assets/js/parsley.min.js"></script>
<script src="assets/js/lobibox.min.js"></script>  



<script type="text/javascript">
  $(document).ready(function($) {
    $('body').bootstrapMaterialDesign();


    $("form.parsley").parsley({
      errorClass: 'has-danger',
      successClass: 'has-success',
      classHandler: function(ParsleyField) {
        return ParsleyField.$element.parents('.form-group');
      },
      errorsContainer: function(ParsleyField) {
        return ParsleyField.$element.parents('.form-group');
      },
      errorsWrapper: '<span class="invalid-feedback d-block">',
      errorTemplate: '<div></div>',
      trigger: 'change'
    });





  });
</script>



  </body>
</html>
