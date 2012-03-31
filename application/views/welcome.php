<?php
if (isset($data['exception'])) {
    echo $data['exception'];
}
?>
<!-- welcome -->
<!-- <div class="hero-unit span3">
    <h1>Welcome to Karrrma.</h1>
    <p>
        <a class="btn btn-primary btn-large" href="<?php echo site_url('signup'); ?>">Get Started! &raquo;</a>
    </p>
</div> -->

<div class="row">

    <div id="betaTestingContainer" class="span6">
        Karrrma is an deal service that provides a fun and exciting experience, allowing you to exchange good deeds for great discounts on the items and services you love. The more you share, the more you save! Sound exciting?
    </div>

    <div id="welcomeContainer" class="pull-right">
        <span id="welcomeWords"></span>

        <form id="loginForm" method="post" action="<?php echo site_url('signin'); ?>" class="form-horizontal pull-left ">
            <fieldset>
                <!--  <legend>Member Sign In</legend> -->
                <div class="control-group">
                    <label>Username</label>
                    <input type="text" id="username" name="username" class="span4" placeholder="Enter E-mail or Username..."/>
                </div>

                <div class="control-group">
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="span4" placeholder="Password..."/>
                </div>
            </fieldset>
            <div class="control-group">
                <div class="row">
                    <button type="submit" class="btn btn-primary span2"> <i class="icon-user icon-white"></i>
                        Login
                    </button>
                    <a href="<?php echo site_url('signup'); ?>" type="button" class="btn btn-primary signupButton pull-right"> <i class="icon-heart icon-white"></i>
                        Sign Up
                    </a>
                </div>
            </div>
        </form>

    </div>
</div>





