<ul class="nav">
    <li class="active">
        <a href="/">Home</a>
    </li>
    <li>
        <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
    </li>
    <li class="dropdown">
        <a href="#"class="dropdown-toggle"data-toggle="dropdown">
            Deals <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo site_url('deals'); ?>">View Deals</a>
            </li>
            <li>
                <a href="<?php echo site_url('vendors'); ?>">View Vendors</a>
            </li>
        </ul>
    </li>
</ul>
<ul class="nav pull-right">
    <li class="divider-vertical"></li>
    <li class="dropdown">
        <a href="#"class="dropdown-toggle"data-toggle="dropdown">
            <?php
            if (!isset($session['logged_in'])) {
                echo "Account";
            } else {
                echo $session['username'];
            }
            ?> 
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo site_url('signout'); ?>">Sign-Out</a>
                <a href="#">Profile</a>
            </li>
        </ul>
    </li>
    <li class="divider-vertical"></li>
</ul>