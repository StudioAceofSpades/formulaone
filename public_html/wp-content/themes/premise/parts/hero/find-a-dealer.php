<?php $zip_rand = rand(); ?>

<div class="find-a-dealer-widget" data-site="<?php bloginfo('url'); ?>" data-form="<?php echo $zip_rand; ?>">
    <form class="zip-search">
        <label class="lg" for="zip-<?php echo $zip_rand; ?>">Find a Dealer</label>
        <label for="zip-<?php echo $zip_rand; ?>">Zip Code</label>
        <div class="d-flex align-items-center <?php echo $classes; ?>">
            <input type="number" id="zip-<?php echo $zip_rand; ?>" placeholder="12345">
            <input type="submit" id="submit-<?php echo $zip_rand; ?>" value="Search">
        </div>
    </form>
</div>
