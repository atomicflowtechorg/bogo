<?php
$nav = array();
$session = $this->
    session->all_userdata();
if (!isset($session['logged_in']) || $session['logged_in'] == false) {
    $nav['nav_account']= site_url('signin');
    //potentially this line below and the partner line below are causing slow loadtimes.
    $nav['nav_LogInOutText']= "Sign-In";
} else {
    $nav['nav_account']= site_url('signout');
    $nav['nav_LogInOutText']= "Sign-Out";
}
?><!-- Dashbord Index -->
    <html>
        <head>
            <meta charset="utf-8">
            <title>Consumer Home</title>
            <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="/assets/css/supersized.core.css">
            <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">

            <script type="text/javascript" src="/assets/js/jquery-1.7.1.min.js"></script>
            <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
            <script type="text/javascript" src="/assets/js/supersized.core.3.2.1.min.js"></script>
            <script type="text/javascript" src="/assets/js/starter.js"></script>
        </head>
        <body>

            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a href="/" class="brand">BoGo</a>
                        <ul class="nav">
                            <li class="active">
                                <a href="/">Home</a>
                            </li>
                            <li>
                                <a href="#">Groups</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('offers'); ?>">Offers</a>
                            </li>
                        </ul>

                        <ul class="nav pull-right">
    
                            <li class="dropdown">
                                <a href="#"class="dropdown-toggle"data-toggle="dropdown">
                                    Account <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo $nav['nav_account']; ?>"> <?php echo $nav['nav_LogInOutText']; ?>  </a>
                                        <a href="#">Profile</a>
                                    </li>
                                </ul>
                            </li>


                        </ul>


                    </div>
                </div>
            </div>

            <div class="container">
                <?php
            $this->
                    load->view($viewLocation, $data);
            ?>
                    <footer>
                        <p>&copy; BoGo 2012</p>
                    </footer>
                </div><!-- /container --> </body>
        </html>