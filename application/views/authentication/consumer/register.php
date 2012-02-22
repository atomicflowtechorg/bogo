<?php
echo validation_errors();
echo form_open(site_url('authentication/consumer_signup'));

$username = array(
              'name'        => 'username',
              'id'          => 'username',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('Username:','username');
echo form_input($username);

$password = array(
              'name'        => 'password',
              'id'          => 'password',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('Password:','password');
echo form_password($password);

$passwordConfirm = array(
              'name'        => 'passwordConfirm',
              'id'          => 'passwordConfirm',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('Confirm Password:','passwordConfirm');
echo form_password($passwordConfirm);

$firstname = array(
              'name'        => 'firstname',
              'id'          => 'firstname',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('First Name:','firstname');
echo form_input($firstname);

$lastname = array(
              'name'        => 'lastmame',
              'id'          => 'lastname',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('Last Name:','lastname');
echo form_input($lastname);

$default = $states[0];

echo form_dropdown('states', $states , $default);

$defaultCity = $cities[0];

echo form_dropdown('cities', $cities , $defaultCity);

echo form_reset('reset','Reset');
echo form_submit('submit','Submit');
echo form_close();
?>
