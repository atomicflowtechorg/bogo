<?php
if(isset($data['exception'])){
    echo $data['exception'];
}
else{
    echo "Success!";
    print_r($campaign);
}
?>