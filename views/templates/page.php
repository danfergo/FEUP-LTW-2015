<!DOCTYPE html>
<html lang="<?= $this->lang ?>">
    <head>
        <meta charset="utf-8">
        <title><?= $this->title ?></title>
        <?= $this->headers ?>
    </head>
    <body>
        <?= $this->insert_view('body'); ?>
    </body>
</html>