<?php

function saldoBancario(float $saldo): float{ // Função para exibir o saldo atual
    echo "------------------------\n";
    echo "Seu saldo é de: R$ " . number_format($saldo, 2, ",", ".") . "\n";
    echo "------------------------\n";
    return $saldo;
}

function depositoBancario($saldo, $extrato){ // Função para realizar depósitos
    echo "------------------------\n";
    echo "Digite o valor que deseja depositar:\n";
    echo "------------------------\n";
    $valorDeposito = (float) trim(fgets(STDIN));
    if($valorDeposito <= 0){
        echo "------------------------\n";
        echo "Erro! O valor não pode ser negativo!\n";
        echo "------------------------\n";
    } else {
    $saldo += $valorDeposito;
    echo "------------------------\n";
    echo "Deposito realizado com sucesso!\n";
    echo "------------------------\n";
    $extrato[] = "+ R$ " . number_format($valorDeposito, 2, ",", ".") . " (Depósito)";
    }
    return [$saldo, $extrato];
   
}

function saqueBancario($saldo, $extrato){ // Função para realizar saques
    echo "------------------------\n";
    echo "Digite o valor que deseja sacar:\n";
    echo "------------------------\n";
    $valorSaque = (float) trim(fgets(STDIN));
    if($valorSaque > $saldo || $valorSaque < 0){
        echo "------------------------\n";
        echo "Erro! Saque inválido!\n";
        echo "------------------------\n";
    } else {
        $saldo -= $valorSaque;
        echo "------------------------\n";
        echo "Saque realizado! Aguarde o dinheiro está sendo contado!\n";
        echo "------------------------\n";
        $extrato[] = "- R$ " . number_format($valorSaque, 2, ",", ".") . " (Saque)";
    }
    return [$saldo, $extrato];
}

function limparTela(){  // Função que limpa a tela após o usuário digitar uma opção
    if (PHP_OS_FAMILY === 'Windows') {
        system('cls');
    } else {
        system('clear');
    }
}

function mostrarExtrato($saldo, $extrato) { // Função que mostra o extrato atual
            echo "\n-----------------------\n";
            echo "EXTRATO\n";
            echo "-------------------------\n";
            if(empty($extrato)){
                echo "Nenhuma movimentação foi realizada!\n";
            } else {
                foreach($extrato as $mov){
                    echo $mov . "\n";
                }
                echo "Saldo autal: R$ " . number_format($saldo, 2, ",", ".") . "\n";
            }
}
