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
    foreach ($items as $item) {

        ?>
        <li>
            <div class="vendor-item">
                <h3><a href="<?php echo site_url('offers/create/'. $item->itemId); ?>"><?php echo $item->name; ?></a></h3>
                <span><?php echo $item->initPrice . ' ' . $item->basePrice; ?></span>
                <span><?php echo $item->totalQty . ' ' . $item->currentQty; ?></span>
            </div>
        </li>
        <?php
    }
    ?>
</ul>