<?php $this->insert_view('header'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <?php $this->insert_view('sidebar'); ?>
        </div>
        <div class="col-md-10">
            <?php $this->insert_view('main-view') ?> 
        </div>
    </div>
</div>