<div class="row">
    <?php echo validation_errors(); ?>
    <form method="post" action="<?php echo site_url('authentication/consumer_signup') ?>" class="form-horizontal well">
        <fieldset>
            <legend>Sign up for an account now!</legend>
            <label>Desired Username</label>
            <input type="text" id="username" name="username" class="span3" placeholder="Enter Here..."/>
            <label>Choose a password</label>
            <input type="text" id="password" name="password" class="span3" placeholder="Enter Here..."/>
            <label>Confirm Password</label>
            <input type="text" class="span3" placeholder="Enter Here..."/>
            <label>First name</label>
            <input type="text" class="span3" placeholder="Enter Here..."/>
            <label>Last name</label>
            <input type="text" class="span3" placeholder="Enter Here..."/>
            <label>State name</label>
            <input type="text" class="span3" placeholder="Enter Here..."/>
            <label>City</label>
            <input type="text" class="span3" placeholder="Enter Here..."/>

        </fieldset>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>
<!-- end row -->