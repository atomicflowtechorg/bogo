<ul>
    <li>
        <a href="<?php echo site_url('vendor/add_item') ?>">add item</a>
    </li>
</ul>

<ul>
    <?php
    foreach ($items as $item) {
        $url = '';
        $urlText = '';
        if ($item->enabled == true) {
                    $url = site_url('vendor/disable_item/' . $item->itemId);
                    $urlText = 'disable';
                } else {
                    $url = site_url('vendor/enable_item/' . $item->itemId);
                    $urlText = 'enable';
                }
        
        ?>
        <li>
            <div class="vendor-item">
                <h3><?php echo $item->name; ?></h3>
                <span><?php echo $item->initPrice . ' ' . $item->basePrice; ?></span>
                <span><?php echo $item->totalQty . ' ' . $item->currentQty; ?></span>

                <a href="<?php echo $url;?>"><?php echo $urlText; ?></a>
            </div>
        </li>
        <?php
    }
    ?>
</ul>