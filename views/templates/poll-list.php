
<?php
if(count($this->getPolls()) == 0){ ?>
    <div class="text-center">
        <h1>Não foram encontradas votações</h1>
    </div>

<?php }
else{
    $this->insert_view('order');
    $this->insert_view('content');
    $this->insert_view('pages');
}

?>