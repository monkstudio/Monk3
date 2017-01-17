<?php

$id     = $this->id ?: 'modal';
$sizes  = [
    'large'     => 'modal-lg',
    'medium'    => 'modal-md',
    'small'     => 'modal-sm'
];

?>

<?php if($this->button) : /* Button trigger modal */ ?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?= $id ?>" ><?php _e(is_string($this->button) ? $this->button : 'Open') ?></button>
<?php endif ?>

<?php /* Modal */ ?>
<div class="modal <?= $this->fade === false ? '' : 'fade' ?>" id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="<?= "$id-label" ?>">

    <div class="modal-dialog <?= $sizes[$this->size ?: 'medium'] ?>" role="document">
        
        <div class="modal-content">
            
            <?php if($this->title) : ?>
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="<?php _e('Close') ?>"><span aria-hidden="true">&times;</span></button>
                                
                <h4 class="modal-title" id="<?= "$id-label" ?>"><?= $this->title ?></h4>
                
            </div>
            <?php endif ?>
            
            <div class="modal-body">
                
                <?php if(!$this->title) : ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php _e('Close') ?>"><span aria-hidden="true">&times;</span></button>
                <?php endif ?>
                
                <?= $this->content ?: $this->data ?>
                
                
            </div>
            
            <?php if($this->footer) : ?>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Close') ?></button>
                <button type="button" class="btn btn-primary" data-action="save" ><?php _e('Save Changes') ?></button>
                
            </div>
            <?php endif ?>
            
        </div>
        
    </div>

</div>