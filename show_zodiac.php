<?php include('layout/header.php'); ?>

<?php

$data_nascimento = $_POST['data_nascimento'];

$dataObj = DateTime::createFromFormat("Y-m-d", $data_nascimento);
$dataFormatada = $dataObj->format("d/m");

$signos = simplexml_load_file("signos.xml");

$meu_signo = null;

foreach ($signos->signo as $signo) {

    list($diaIni, $mesIni) = explode("/", (string)$signo->dataInicio);
    list($diaFim, $mesFim) = explode("/", (string)$signo->dataFim);
    list($diaNasc, $mesNasc) = explode("/", $dataFormatada);

    // ajuste de ano
    $anoAtual = date("Y");

    $inicio = DateTime::createFromFormat("d/m/Y", "$diaIni/$mesIni/$anoAtual");
    $fim = DateTime::createFromFormat("d/m/Y", "$diaFim/$mesFim/$anoAtual");
    $nasc = DateTime::createFromFormat("d/m/Y", "$diaNasc/$mesNasc/$anoAtual");

    // caso o signo atravesse o ano (ex: Capricórnio)
    if ($fim < $inicio) {
        // fim está no ano seguinte
        $fim->modify("+1 year");

        // se o nascimento for no começo do ano, ajuste também
        if ($nasc < $inicio) {
            $nasc->modify("+1 year");
        }
    }

    if ($nasc >= $inicio && $nasc <= $fim) {
        $meu_signo = $signo;
        break;
    }
}
?>

<div class="container mt-5">
<?php if ($meu_signo): ?>
    <div class="card shadow p-4">
        <h2 class="text-center"><?= $meu_signo->signoNome ?></h2>
        <p class="mt-3 text-center"><?= $meu_signo->descricao ?></p>
        <a href="index.php" class="btn btn-secondary mt-3 w-100">Voltar</a>
    </div>
<?php else: ?>
    <div class="alert alert-danger text-center">
        Não foi possível identificar o signo. Tente novamente.
    </div>
    <a href="index.php" class="btn btn-secondary mt-3 w-100">Voltar</a>
<?php endif; ?>
</div>

</body>
</html>
