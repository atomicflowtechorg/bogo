<?php
$nav = array();
$session = $this->session->all_userdata();
if (!isset($session['logged_in'])) {
    $nav['nav_account'] = site_url('signin');
    //potentially this line below and the partner line below are causing slow loadtimes.
    $nav['nav_LogInOutText'] = "Sign-In";
} else {
    $nav['nav_account'] = site_url('signout');
    $nav['nav_LogInOutText'] = "Sign-Out";
}
?><!-- Layout/Index -->
<html>
    <head>
        <meta charset="utf-8">
        <title>user Home</title>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/supersized.core.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">

        <script type="text/javascript" src="/assets/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="/assets/font/cufon-yui.js"></script>
        <script type="text/javascript" src="/assets/font/Exo-Regular_400-Exo-Regular_700-Exo-Regular_italic_400-Exo-Regular_italic_700.font.js"></script>
        <script type="text/javascript" src="/assets/js/jquery.masonry.min.js"></script>

       <!--  <?php if (!isset($session['logged_in']) || $session['logged_in'] == false): true ?>
            <?php echo "<script type='text/javascript' src='/assets/js/supersized.core.3.2.1.min.js'></script>" ?>
            <?php echo "<script type='text/javascript' src='/assets/js/loggedOut.js'></script>" ?>
        <?php endif ?> --> 
        <script type="text/javascript" src="/assets/js/starter.js"></script>
    </head>
    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="/" class="brand">BoGo</a>

                    <?php

                    if (!isset($session['logged_in'])) {
                                   $this->load->view('layout/template/loggedOutNavigation', $nav);
                                } 
                    else {
                                   $this->load->view('layout/template/loggedInNavigation');
                                }
                    ?>
            

                </div>
            </div>
        </div>

        <div class="container-fluid">
            <?php
            $this->load->view($viewLocation, $data);
            ?>
        </div><!-- /container -->
        <div class="footerContainer">
            <footer>
                <p>&copy; BoGo 2012</p>
            </footer>
        </div>
    </body>
</html>