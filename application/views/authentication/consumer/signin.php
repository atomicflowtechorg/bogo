<!-- Consumer/Sigin -->
<div class="row">
    <?php echo validation_errors(); ?>
    <div id="signinFormBackground" class="span">

        <div class="row" >

            <div class="span4" id="signinFormAside">
               GoodsDeed.com is a service that allows you to exchange helpful deeds for discounts on the items and services you love. 
            </div>

            <form id="signinForm" method="post" action="<?php echo site_url('signin') ?>" class="form-horizontal well span4">
                <fieldset>
                    <legend>Sign in!</legend>
                    <label>Username</label>
                    <input type="text" id="username" name="username" class="span3" placeholder="Enter Here..."/>
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="span3" placeholder="Enter Here..."/>
                </fieldset>
                <button type="submit" class="btn">Login</button>
            </form>

            
        </div>

    </div>
</div>
<!-- end row -->