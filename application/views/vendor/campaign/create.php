<h1>Create Campaign for <?php echo $item->name; ?></h1>
<?php
echo validation_errors();
echo form_open(site_url('vendor/create/campaign/'.$item->itemId));

$item = array(
              'name'        => 'item',
              'id'          => 'item',
              'value'       => $item->itemId
            );
form_hidden($item);

$startDate = array(
              'name'        => 'startDate',
              'id'          => 'startDate',
              'class'          => 'input-append datepicker',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50',
              'data-date'   =>'12-02-2012',
              'data-date-format' => 'dd-mm-yyyy'
            );
echo form_label('Start Date:','startDate');
echo form_input($startDate);

$endDate = array(
              'name'        => 'endDate',
              'id'          => 'endDate',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50'
            );
echo form_label('End Date:','endDate');
echo form_input($endDate);


echo form_reset('reset','Reset');
echo form_submit('submit','Submit');
echo form_close();
?>
