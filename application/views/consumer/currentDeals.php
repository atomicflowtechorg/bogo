<?php
if(isset($exception)){
    echo $exception;
    $items = array();
}
else{
    
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<ul>
    <?php
    foreach ($offers as $offer) {
            $url;
            if($offer->userInCohort == 0){
                //see cohorts for item (or create one if none exist)
                $url = site_url('offers/'. $offer->itemId);
            }
            else{
                //see the users cohort for this item
                $url = site_url('offers/cohort/'. $offer->cohortId);
            }
        ?>
        <li class="item">
            <div class="vendor-item">
                <h3><a href="<?php echo $url; ?>"><?php echo $offer->name; ?></a></h3>
                <span><?php echo $offer->initPrice . ' ' . $offer->basePrice; ?></span>
                <span><?php echo $offer->totalQty . ' ' . $offer->currentQty; ?></span>
            </div>
        </li>
        <?php
    }
    ?>
</ul>