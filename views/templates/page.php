<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?= $this->title ?></title>
        <link rel="icon" href="img/favicon.png">
        <?= $this->headers ?>
    </head>
    <body>
        <?= $this->insert_view('body'); ?>
    </body>
</html>