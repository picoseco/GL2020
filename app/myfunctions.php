<?php
function my_login_logo() { ?>
  <style type="text/css">
  #login h1 a, .login h1 a {
    background-image: url(<?php echo get_theme_file_uri(); ?>/admin/Logo_Rainbow_256.png);
    height:65px;
    width:320px;
    background-size: contain;
    background-repeat: no-repeat;
    padding-bottom: 30px;
  }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
