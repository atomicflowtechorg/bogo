<div class="row">
    <?php echo validation_errors(); ?>
    <div id="signinFormBackground" class="span">

        <div class="row" >

            <div class="span4" id="signinFormAside">
               The Bogo Experience. We give you a chance to lower the price on items that you want by performing simple tasks. The better you do, the better the price you'll get!
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