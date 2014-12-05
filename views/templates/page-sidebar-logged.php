<?php
$userFirstName = explode(' ', $this->getPage()->getUser()->getName())[0];
?> 


<section>
    <p><b>Olá, <?= $userFirstName; ?> </b> </p>
</section>  


<nav id="page-menu">
    <ul>
        <li class="<?= $this->isPage('index.php') ? 'active' : ''; ?>">
            <a href="index.php"> Destaques <span class="glyphicon glyphicon-home"> </span></a>
        </li>
        <li class="<?= $this->isPage('managepoll.php') ? 'active' : ''; ?>">
            <a href="managepoll.php"> Criar Votação <span class="glyphicon glyphicon-plus"> </span></a>
        </li>
        <li class="<?= $this->isPage('mypolls.php') ? 'active' : ''; ?>">
            <a href="mypolls.php"> Minhas votações <span class="glyphicon glyphicon-briefcase"> </span></a>
        </li>
        <li class="<?= $this->isPage('history.php') ? 'active' : ''; ?>">
            <a href="history.php"> Histórico <span class="glyphicon glyphicon-time"> </span></a>
        </li>
        <li>
            <a href="logout.php"> Sair <span class="glyphicon glyphicon-off"> </span></a>
        </li>
    </ul>
</nav>

