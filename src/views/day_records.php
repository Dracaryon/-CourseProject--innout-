<main class="content">


<?php 
    renderTitle(
        'Registrar Ponto',
        'Mantenha seu ponto consistente!',
        'icofont-check-alt'   
    );
    include(TEMPLATE_PATH . "/messages.php");
?>
    <!-- Essa parte abaixo foi para o title.php -->
    <!-- <div class="content-title mb-4">
        <i class="icon icofont-check-alt mr-2"></i>
        <div>
            <h1>Registrar Ponto</h1>
            <h2>Mantenha seu ponto consistente!</h2>
        </div>
    </div> -->
    <div class="card">
        <div class="card-header">
            <h3><?= $today ?></h3>
            <p class="mb-0">Os batimentos efetuados hoje</p>
        </div>
        <div class="card-body">
            <div class="d-flex m-5 justify-content-around">
                <span class="record"> Entrada 1: <?= $records->time1 ?? '---'?> </span>
                <span class="record"> Saída 1: <?= $records->time2 ?? '---'?></span>
            </div>
            <div class="d-flex m-5 justify-content-around">
                <span class="record"> Entrada 2: <?= $records->time3 ?? '---'?></span>
                <span class="record"> Saída 2: <?= $records->time4 ?? '---'?></span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="innout.php" class="btn btn-success btn-lg">
                <i class="icofont-check mr-1"></i>
                Bater o Ponto
            </a>
        </div>
    </div>

    <form class="mt-5" action="innout.php" method="post">
        <div class="input-group no-border">
        <input type="text" name="forcedTime" class="form-control" placeholder="informe a hora para registrar o ponto">
        <button class="btn btn-danger ml3">
            Simular Ponto
        </button>

        </div>
    </form>

</main>