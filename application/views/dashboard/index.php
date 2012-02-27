<?php
$nav = array();
$session = $this->session->all_userdata();
if (!isset($session['logged_in']) || $session['logged_in'] == false) {
    $nav['nav_account']= site_url('signin');
} else {
    $nav['nav_account']= site_url('signout');
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Consumer Home</title>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
        <script type="text/javascript" src="/assets/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
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
                        <li><a href="<?php echo $nav['nav_account']; ?>">Account</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            <?php
            $this->load->view($viewLocation, $data);
            ?>

            <footer>
                <p>&copy; BoGo 2012</p>
            </footer>
        </div> <!-- /container -->


    </body>
</html>
