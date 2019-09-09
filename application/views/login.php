<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>PD Putera Jaya</title>

<link href='https://fonts.googleapis.com/css?family=Raleway:300,200' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/login/'); ?>css/style.css">

</head>
<body <?php //if(isset($error)){ echo "onload='alert()'";} ;?>>

  <div class="menu">
  <ul class="mainmenu clearfix">
    <li class="menuitem">Well</li>
    <li class="menuitem">how</li>
    <li class="menuitem">about</li>
    <li class="menuitem">that?</li>
  </ul>
</div>

<?php if(isset($error)){ echo "<button id='findpass'>Password Salah!</button>" ;} ;?>

<div class="form">
  <form method="POST" action="<?php echo site_url('Login/cek');?>">
    <div class="forceColor"></div>
    <div class="topbar">
      <div class="spanColor"></div>
      <input type="password" name="password" class="input" id="password" placeholder="Password"/>
    </div>
    <button class="submit" id="submit" >Login</button>
  </form>
</div>

</body>
</html>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="<?php echo base_url('assets/login/'); ?>js/index.js"></script>

<!--<script type="text/javascript">
  function alert(){
    swal("Salah!", "You clicked the button!", "error");
  }
</script>-->