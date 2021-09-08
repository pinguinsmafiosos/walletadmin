<?php
include "verifica_carteira.php";

$actions = [];
$values = [];
$rawQts = [];
$codActs = [];

$select = "select b.simbolo,a.valor,a.rawCot,a.codAcao from carteira as a join acoes as b on a.codAcao = b.id where a.usuario = '{$_SESSION['email']}'";
$result = mysqli_query($conexao, $select);

$i = 1;
while ($rows = $result->fetch_assoc()) {
    $actions[$i] = $rows['simbolo'];
    $values[$i] = $rows['valor'];
    $rawQts[$i] = $rows['rawCot'];
    $codActs[$i] = $rows['codAcao'];
    $i++;
}

//PHP array to JS array
function js_str($s)
{
    return '"' . addcslashes($s, "\0..\37\"\\") . '"';
}
function js_array($array)
{
    $temp = array_map('js_str', $array);
    return '[' . implode(',', $temp) . ']';
}

$actionsJS = 'var actions = '.js_array($actions).';';

$valuesJS = 'var values = '.js_array($values).';';

$rawCotsJS = 'var rawCots = '.js_array($rawQts).';';

$codActsJS = 'var codActs = '.js_array($codActs).';';


?>