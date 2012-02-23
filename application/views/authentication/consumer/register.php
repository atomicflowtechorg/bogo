<div class="row">
    <?php echo validation_errors(); ?>
    <form method="post" action="<?php echo site_url('authentication/consumer_signup') ?>" class="form-horizontal well">
        <fieldset>
            <legend>Sign up for an account now!</legend>

            <label for="username" >Desired Username</label>
            <input type="text" id="username" name="username" class="span3" placeholder="Username..."/>

            <label>Choose a password</label>
            <input type="text" id="password" name="password" class="span3" placeholder="Password..."/>

            <label>Confirm Password</label>
            <input type="text" id="passwordConfirm" name="passwordConfirm" class="span3" placeholder="Confirm Password..."/>

            <label>First name</label>
            <input type="text" id="firstname" name="firstName" class="span3" placeholder="First name..."/>

            <label>Last name</label>
            <input type="text" id="lastname" name="lastName" class="span3" placeholder="Last Name..."/>

            <label>State name</label>
            <input type="text" id="state" name="state" class="span3" placeholder="State..."/>

            <label>City</label>
            <input type="text" id="city" name="city" class="span3" placeholder="City..."/>


        </fieldset>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>
<!-- end row -->