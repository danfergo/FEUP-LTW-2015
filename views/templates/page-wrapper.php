<?php $this->insert_view('header'); ?>

<div id="shaddowing">

</div>
<div id="page-header-area">
</div>
<div class="container-fluid">
    <div class="row">

        <div id="page-sidebar" class="col-md-2 col-xs-0">
            <div>
                <?php $this->insert_view('sidebar'); ?>
                <?php $this->insert_view('footer'); ?>
            </div>
        </div>

        <div class="col-md-10 col-xs-12">
            <div id="page-content">
                <?php $this->insert_view('main-view') ?> 
            </div>
        </div>
    </div>
</div>

