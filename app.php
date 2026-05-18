<?php

function exibeMenu($usuarioLogin){ // Função para exibir o menu
echo "\n------------------------\n";
echo "Bem-vindo(a) " . $usuarioLogin . "!\n";
echo "------------------------\n";
}

function saldoBancario($saldo){ // Função para exibir o saldo atual
    echo "Seu saldo é de: R$ " . number_format($saldo, 2, ",", ".") . "\n";
    return $saldo;
}

function depositoBancario($saldo, $extrato){ // Função para realizar depósitos
    echo "Digite o valor que deseja depositar:\n";
    $valorDeposito = (float) trim(fgets(STDIN));
    if($valorDeposito <= 0){
        echo "Erro! O valor não pode ser negativo!\n";
    } else {
    $saldo += $valorDeposito;
    echo "Deposito realizado com sucesso!\n";
    $extrato[] = "+ R$ " . number_format($valorDeposito, 2, ",", ".") . " (Depósito)";
    }
    return [$saldo, $extrato];
   
}

function saqueBancario($saldo, $extrato){ // Função para realizar saques
    echo "Digite o valor que deseja sacar:\n";
    $valorSaque = (float) trim(fgets(STDIN));
    if($valorSaque > $saldo || $valorsaque < 0){
        echo "Erro! Saque inválido!\n";
    } else {
        $saldo -= $valorSaque;
        echo "Saque realizado! Aguarde o dinheiro está sendo contado!\n";
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

function mostrarExtrato($saldo, $extrato) {
        echo "\n------------------------\n";
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

