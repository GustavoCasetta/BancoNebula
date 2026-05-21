<?php
// Mini sistema bancário  ©Gustavo Casetta

require __DIR__ . "/app.php"; // Arquivo que é obrigatório para rodar o programa

do{
    echo "------------------------\n";
    echo "Banco Matriz\n";
    echo "------------------------\n";
    echo "1 - Entrar\n2 - Cadastrar\n0 - Sair\nDigite uma opção: ";
    $opcaoLogin = (int) trim(fgets(STDIN));
    $saldo = 0; // Variável inicia em 0 (zero)
    $extrato = [];
    limparTela(); // Chama a função para limpar a tela

    switch($opcaoLogin){
        case 1:
            $loginOk = false; // Variável para verificar se login está correto, começa como "false"
            echo "------------------------\n";
            echo "Insira os dados para efetuar o login\n";
            echo "------------------------\n";
            echo "Usuário: ";
            $usuarioLogin = (string) trim(fgets(STDIN)); // Usuário insere nome
            echo "Senha: ";
            $senhaLogin = (string) trim(fgets(STDIN)); // Usuário insere senha

            if(!file_exists(__DIR__ . "/usuarios.txt")){ // Verifica se existe o arquivo onde se encontram os cadastros
                echo "------------------------\n";
                echo "Nenhum usuário cadastrado!\n";
                echo "------------------------\n";
                break;
            }

            $cadastroUsuario = file(__DIR__ . "/usuarios.txt"); // Abre o arquivo e o coloca em uma variável

            foreach($cadastroUsuario as $nomes){ // Verifica cada nome e senha para ver se o login está correto

                list($loginArquivo, $senhaArquivo) = explode(";", trim($nomes));

                if($loginArquivo === $usuarioLogin && $senhaArquivo === $senhaLogin){
                    $loginOk = true; // Se o login estiver correto a variável do login muda para true
                    break;
                }
            }

            if($loginOk === false){ // Verifica se a varíavel do login é false ou true
                echo "------------------------\n";
                echo "Login incorreto!\n";
                echo "------------------------\n";
                break;
            }

                do{
                    exibeMenu($usuarioLogin); // Chama a função para exibir o menu

                    echo "Opções:\n"; // Mostra as opções
                    echo "1 - Saldo\n2 - Depositar\n3 - Sacar\n4 - Ver extrato\n5 - Sair\nDigite a opção: ";
                    $opcaoMenu = (int) trim(fgets(STDIN)); // Grava a opção escolhida na variável
                    limparTela(); // Chama a função para limpar a tela
                    
                    switch($opcaoMenu){ // Switch das opções
                        case 1:
                            saldoBancario($saldo); // Chama a função para mostrar o saldo
                        break;

                        case 2:
                            list ($saldo, $extrato) = depositoBancario($saldo, $extrato); // Chama a função para realizar o depósito
                        break;

                        case 3:
                            list ($saldo, $extrato) = saqueBancario($saldo, $extrato); // Chama a função para realizar o saque
                        break;

                        case 4:
                            list ($saldo, $extrato) = mostrarExtrato($saldo, $extrato); // Chama a função que mostra o extrato bancário
                        break;

                        case 5: // Sai do programa
                            echo "------------------------\n";
                            echo "Saindo...\n";
                            echo "------------------------\n";
                        break;

                        default: // Caso uma opção inválida seja enviada
                            echo "------------------------\n";
                            echo "Opção inválida/inexistente! Verifique!\n"; 
                            echo "------------------------\n";
                        break;
                    }

            } while ($opcaoMenu != 5);  // o loop para quando o usuário digitar 5 (zero)

        break;
        case 2:
            // Efetua cadastro do usuário
            $cadastroUsuario = fopen(__DIR__ . "/usuarios.txt", "a");
            echo "------------------------\n";
            echo "Olá! Vamos efetuar seu cadastro!\n";
            echo "------------------------\n";
            echo "Insira um nome de usuário: ";
            $nomeUsuario = (string) trim(fgets(STDIN));
            echo "Informe uma senha: ";
            $senhaUsuario = (string) trim(fgets(STDIN));
            echo "Confirme a senha: ";
            $confirmacaoDeSenha = (string) trim(fgets(STDIN));
           
            // Se a senhas não forem iguais
            if($senhaUsuario !== $confirmacaoDeSenha){
                echo "------------------------\n";
                echo "As senhas não conferem!\n";
                echo "------------------------\n";
                break;
            }

            //Guarda o cadastro do usuário no arquivo
            fwrite($cadastroUsuario, $nomeUsuario . ";" . $senhaUsuario . "\n");

            fclose($cadastroUsuario);
            echo "Usuário cadastrado!\n";
            limparTela(); // Chama a função para limpar a tela
        break;
        case 0:
            echo "------------------------\n";
            echo "Saindo...\n";
            echo "------------------------\n";
            echo "\n";
        break;
        default:
            echo "------------------------\n";
            echo "Opção inválida!\n";
            echo "------------------------\n";
        break;
    }
}while($opcaoLogin != 0);

?>
