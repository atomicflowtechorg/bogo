<ul>
    <li>
        <a href="<?php echo site_url('vendor/add_item') ?>">add item</a>
    </li>
</ul>

<ul>
    <?php
    foreach ($items as $item) {
        
        ?>
        <li>
            <div class="vendor-item">
                <h3><?php echo $item->name; ?></h3>
                <span><?php echo $item->initPrice . ' ' . $item->basePrice; ?></span>
                <span><?php echo $item->totalQty . ' ' . $item->currentQty; ?></span>

                <a href="<?php echo site_url('vendor/create/campaign');?>">Create Campaign</a>
            </div>
        </li>
        <?php
    }
    ?>
</ul>