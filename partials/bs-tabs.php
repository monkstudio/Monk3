<?php 

/**
 * Bootstrap Tabs
 * A handy starter pattern to build tabs off. Modify the code below to suit the project's needs.
 */

$tabs       = "";
$panes      = "";
$index      = 0;
$style      = esc_attr($this->style ?: 'tab'); // Alt. 'pill'
$selector   = $this->content ?: 'tabs';

// A single loop to generate content for the tabs and their corresponding panes.
if(have_rows($selector)) :

    while(have_rows($selector)) {
        the_row();
    
        $id     = esc_attr(sprintf("%s-tab-pane-$index", $this->id_prefix ?: uniqid()));
        $active = $this->active === $index ? true : false;

        $tabs   .= sprintf("<li role='presentation' %s><a href='#$id' aria-controls='$id' role='tab' data-toggle='$style' >%s</a></li>", $active && "class='active'", get_sub_field('tab'));
        $panes  .= sprintf("<div role='tabpanel' class='tab-pane %s %s' id='$id' >%s</div>", $this->fade && 'fade', $active && 'active', get_sub_field('pane'));

        $index++;
    
    }

// Print content
if($this->nav !== false) : /* Nav tabs */ ?>
<ul class="nav nav-<?= $style ?>s" role="tablist">
    
    <?= $tabs ?>
    
</ul>
<?php endif ?>

<?php /* Tab panes */ ?>
<div class="tab-content">
    
    <?= $panes ?>
    
</div>

<?php endif ?>