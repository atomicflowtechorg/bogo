<div class="row">
    <?php echo validation_errors(); ?>
    <form method="post" action="<?php echo site_url('signin') ?>" class="form-horizontal well">
        <fieldset>
            <legend>Sign in!</legend>
            <label>Username</label>
            <input type="text" id="username" name="username" class="span3" placeholder="Enter Here..."/>
            <label>Password</label>
            <input type="password" id="password" name="password" class="span3" placeholder="Enter Here..."/>
        </fieldset>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>
<!-- end row -->