<?php
$userName = $this->getPage()->getUser()->getName();
?> 


<section>
    <p><b>Olá, <?= $userName; ?> </b> </p>


    <a href="logout.php">   
        <button type="button" class="btn btn-default">LOGOUT</button>
    </a>

</section>


<nav>
    <ul>
        <li>
            <a href="createpoll.php"> Criar Votação </a>
        </li>
        <li>
            <a href="mypolls.php"> Minhas votações </a>
        </li>
        <li>
            <a href="history.php"> Histórico </a>
        </li>
    </ul>
</nav>

