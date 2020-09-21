# Projeto Web - CRUD de Pacientes

## Front-End: CSS/Bootstrap e Javascript/Jquery
## Back-End: PHP e Banco de Dados Postgrees
## Framework Back-End Utilizado: Code Igniter

###### Desenvolvimento de um sistema simples para Controle de Pacientes.

## Ferramentas utilizadas:
- Linguagem de Programação: PHP;
- Banco de Dados => Postgress;
- Framework PHP => Code Igniter 3.1
- Framework JS => Jquery;
- Framework CSS => Bootstrap;

## Requisitos funcionais do Projeto:
- Campos para o cadastro de paciente: 
    Foto do Paciente; 
    Nome Completo do Paciente; *
    Nome Completo da Mãe; *
    Data de Nascimento; *
    CPF (com validação); *
    CNS(Cartão nacional de saúde), *
    Endereço completo;
- Utilizada máscara nos campos CPF e Celular;
- Todos os campos com exceção da foto são obrigatórios;
- Executar a leitura, edição e remoção do paciente;
- Consultar endereço utilizando webservice pela api do ViaCEP - https://viacep.com.br/;
- Para validar CNS utilizar este algoritmo: https://integracao.esusab.ufsc.br/ledi/documentacao/regras/algoritmo_CNS.html;

## Para executar a aplicação:
- Editar arquivo config/database.php para conectar ao seu servidor de banco de dados
- Editar arquivo config/config.php e colocar a url base do seu servidor
- Executar a única migration disponível para criar a tabela de pacientes
