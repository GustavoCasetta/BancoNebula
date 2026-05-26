<?php

require __DIR__ . "/app.php";

if(!file_exists("cadastroUsuario.json")){
    $usuario = [
        [
            "Login" => "Gustavo",
            "Senha" => "senha123",
            "Nascimento" => 2003
        ]
    ];

file_put_contents("cadastroUsuario.json", json_encode($usuario, JSON_PRETTY_PRINT));
}

do{
echo "- - - - - - - - - -" . "\n";
echo "- - Banco Nébula - -" . "\n";
echo "- - - - - - - - - -" . "\n";
echo "1 - Entrar\n2 - Cadastrar\n0 - Sair\nDigite a opção: ";
$opcaoLogin = (int) trim(fgets(STDIN));
limparTela();

switch($opcaoLogin){
    case 1:
        echo "- - - - - - - - - -" . "\n";
        echo "- - Banco Nébula - -" . "\n";
        echo "- - - - - - - - - -" . "\n";
        echo "Login: ";
        $login = (string) trim(fgets(STDIN));
        echo "Senha: ";
        $senha = (string) trim(fgets(STDIN));
        $loginOk = false;

        $dados = file_get_contents("cadastroUsuario.json");
        $listaUsuarios = json_decode($dados, true);

        foreach($listaUsuarios as $cadastro){
            if(strtolower($login) === strtolower($cadastro["Login"]) && strtolower($senha) === strtolower($cadastro["Senha"])){
                $loginOk = true;
            };
        }

        file_put_contents("cadastroUsuario.json", json_encode($listaUsuarios, JSON_PRETTY_PRINT));

        if($loginOk === false){
            echo "Login incorreto!" . "\n";
        } else {
            $saldo = 0; 
            $extrato = [];
            do{
                echo "- - - - - - - - - -" . "\n";
                echo "Bem-vindo(a) " . $login . "\n";
                echo "- - - - - - - - - -" . "\n";
                echo "1 - Saldo\n2 - Depositar\n3 - Sacar\n4 - Ver extrato\n5 - Sair\nDigite a opção: ";
                $opcaoMenu = (int) trim(fgets(STDIN));
                limparTela();

                switch($opcaoMenu){
                    case 1:
                        saldoBancario($saldo);
                    break;
                    case 2:
                        list ($saldo, $extrato) = depositoBancario($saldo, $extrato);
                    break;
                    case 3:
                        list ($saldo, $extrato) = saqueBancario($saldo, $extrato);
                    break;
                    case 4:
                        list ($saldo, $extrato) = mostrarExtrato($saldo, $extrato);
                    break;
                    case 5:
                        echo "Saindo..." . "\n";
                    break;
                    default:
                        echo "Opção Inválida!" . "\n";
                    break;
            }
            }while($opcaoMenu != 5);
        }
    break;
    case 2:
        echo "- - - - - - - - - -" . "\n";
        echo "- - - CADASTRO - - -" . "\n";
        echo "- - - - - - - - - -" . "\n";
        echo "Insira um nome para login: ";
        $nomeCadastro = (string) trim(fgets(STDIN));
        echo "Insira uma senha: ";
        $senhaCadastro = (string) trim(fgets(STDIN));
        echo "Confirme a senha: ";
        $senhaConfirmacao = (string) trim(fgets(STDIN));
        echo "Informe seu ano de nascimento: ";
        $anoCadastro = (int) trim(fgets(STDIN));

        if($senhaCadastro !== $senhaConfirmacao){
            echo "As senhas não conferem!" . "\n";
            break;
        }

        $novoCadastro = [
            "Login" => $nomeCadastro,
            "Senha" => $senhaCadastro,
            "Nascimento" => $anoCadastro
        ];

        $dados = file_get_contents("cadastroUsuario.json");
        $listaUsuarios = json_decode($dados, true);

        foreach($listaUsuarios as $cadastro){
            if(strtolower($nomeCadastro) === strtolower($cadastro["Login"])){
                echo "O usuário já contem cadastro!" . "\n";
                break;
            }
        }

        if(!$usuarioExiste){
            $listaUsuarios[] = $novoCadastro;

            file_put_contents("cadastroUsuario.json", json_encode($listaUsuarios, JSON_PRETTY_PRINT));

            echo "Usuário cadastrado!" . "\n";
        }
    break;
    case 0:
        echo "Saindo..." . "\n";
    break;
    default:
        echo "Opção inválida!" . "\n";
    break;
}
}while($opcaoLogin != 0);
