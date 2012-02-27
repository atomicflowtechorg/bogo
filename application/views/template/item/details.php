<?php
if(isset($data['exception'])){
    echo $data['exception'];
}
else{
    print_r($data['item']);
    print_r($data['cohorts']);
}

?>
