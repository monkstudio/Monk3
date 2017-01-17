<?php 

if($this->main === true && is_front_page()) : ?>

<h1 id="main-logo" class="logo" style="width: <?php esc_attr_e($this->width ?: '100%') ?>" > 
    <?php bloginfo('name') ?>
</h1>

<?php else : ?>

<a id="main-logo" class="logo" rel="home" href="<?php echo esc_url(home_url('/')) ?>" style="width: <?php esc_attr_e($this->width ?: '100%') ?>" >
    <?php bloginfo('name') ?>
</a>

<?php endif; ?>
