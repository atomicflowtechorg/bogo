<html>
    <head>
        <meta charset="utf-8">
        <title>Consumer Home</title>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
        <script type="text/javascript" src="/assets/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
    </head>
    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a href="#index" class="brand">BoGo</a>
                    <ul class="nav">
                        <li class="active">
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">Groups</a>
                        </li>
                        <li>
                            <a href="#">Offers</a>
                        </li>
                        <li><a href="#">Account</a></li>
                        li
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
