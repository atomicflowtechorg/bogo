<?php
if(isset($data['exception'])){
    echo $data['exception'];
}
?>
<!-- welcome -->
<div class="hero-unit">
    <h1>Welcome to karma.</h1>
    <p>
        karma is an deal service that provides a fun and exciting experience, allowing you to exchange good deeds for great discounts on the items and services you love. The more you share, the more you save! Sound exciting?
    </p>
    <p>
        <a class="btn btn-primary btn-large" href="<?php echo site_url('signup'); ?>">Get Started! &raquo;</a>
    </p>
</div>

<div class="row-fluid">
    <div class="span4">
        <h2>Browse deals</h2>
        <p>
            Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
        </p>
        <p>
            <a class="btn" href="<?php echo site_url('deals'); ?>">View Current Deals &raquo;</a>
        </p>
    </div>
    <div class="span4">
        <h2>Learn More</h2>
        <p>
            Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
        </p>
        <p>
            <a class="btn" href="#">Tell Me More &raquo;</a>
        </p>
    </div>
    <div class="span4">
        <h2>Get Started!</h2>
        <p>
            Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
        </p>
        <p>
            <a class="btn" href="<?php echo site_url('signup'); ?>">Sign Up &raquo;</a>
        </p>
    </div>
</div>

<hr>