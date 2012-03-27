<?php
// print_r($vendors);

// var_dump($vendors);

foreach($vendors as $vendor){
    $this->load->view('user/template/vendorItem', $vendor);
}


// foreach( $vendors as $vendor => $value){
//     // echo "Name: $key, Age: $value <br />";
//     // echo $->karrrma;
//     echo "Name: $vendor";
// }

?>


<!-- <div class="vendorCard">
    <div class="vendorDetailsContainer">
        details
    </div>
    <div class="vendorNameContainer">
        <div class="moreTriangle"><img src="/assets/image/icon/moreTriangle.png" alt=""></div>
        <h3 class="vcVendorName">Nike Outlet</h3>
    </div>
    <div class="karmaIndicatorContainer">
        <div class="karmaIndicator"><span class="karmaPoints">224</span></div>
    </div>
</div> -->