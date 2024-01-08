# PSI_PLSI_202324
Projeto de Plataformas de Sistemas de Informação

# LusitaniaTravel
A aplicação LusitaniaTravel é uma aplicação web projetada para a reserva e gestão de estadias em Portugal Continental.O sistema fornece diferentes funcionalidades para funcionários, administradores e clientes, permitindo que gerenciem as reservas, dados de clientes, serviços e taxas de IVA. A aplicação segue a arquitetura MVC e é desenvolvida em PHP. Ela utiliza uma base de dados de apoio para armazenar as informações necessárias.

## Principais Funcionalidades
Perfil Funcionário
- Autenticação: Os funcionários podem fazer login para aceder à sua área reservada.
- Emitir Faturas e reservar estadias, quando em ambiente presencial.
- Registo de Clientes: Podem criar novas fichas para clientes.
- Histórico de Faturas: Os funcionários podem visualizar o histórico de faturas geradas anteriormente.

Perfil Administrador
- Autenticação: Os administradores podem fazer login para aceder à sua área reservada.
- Gestão de Funcionários: Os administradores podem criar e gerir contas de funcionários.
- Configuração da Empresa: Os administradores podem configurar os dados da empresa para a emissão de folhas de obra.
- Histórico de Faturas: Os administradores podem visualizar o histórico de todas as faturas geradas pelos funcionários.
- Todas as funcionalidades disponíveis para funcionários.

Perfil Cliente
- Autenticação: Os clientes podem fazer login para aceder à sua área reservada, apenas no frontend.
- Lista de Faturas: Os clientes podem visualizar a sua lista de faturas.
- Pagamento Simulado: Os clientes podem simular o pagamento de uma fatura.
- Download de Faturas: Os clientes podem efetuar o download de faturas individuais num formato imprimível.
- Pesquisa de Alojamentos por nome de distrito: Os clientes podem efetuar uma pesquisa em que resulta a listagem de todos os alojamentos com a localização escolhida.

Perfil Fornecedor:
- Autenticação: Os fornecedores podem fazer login para aceder à sua área reservada.
- Atualização de Dados: Os fornecedores podem atualizar os dados do seu de alojamento (CRUD).
- Visualizar feedback de clientes: Os fornecedores podem visualizar o feedback, composto por comentários e avalações, das respetivas estadias.
- Confirmar estadias: Os fornecedores podem validar o estado das estadias, para 'Confirmadas' ou 'Canceladas'. No caso de ainda não terem sido validadas aparecem como 'Pendentes'.

## Pré-requisitos
- Servidor web (por exemplo, Apache)
- PHP 7 ou superior
- MySQL Workbench ou outro sistema de gestão de base de dados compatível
- Composer (para gerir dependências)

## Instalação
1. Clone o repositório do projeto do GitHub.
2. Certifique-se de ter o servidor web (por exemplo, Apache) configurado e apontando para o diretório público do projeto.
3. No terminal, navegue até o diretório do projeto e execute os seguintes comandos para instalar as dependências e Mpdf:
```
composer install
```
```
composer require mpdf/mpdf
```
4. Correr o sql da estrutura e de dados (LusitaniaTravel.sql e os sql's da pasta DumpLusitaniaTravel).


## Utilização
1. Aceda a aplicação através da URL definida.
2. Dependendo do seu perfil (funcionário, administrador ou cliente), faça login usando as credenciais adequadas.
3. Explore as funcionalidades disponíveis com base no seu perfil:
    - Funcionários podem criar reservas, gerar faturas, gerir clientes, etc.
    - Administradores têm acesso adicional para gerir funcionários e configurar a empresa.
    - Clientes podem visualizar a lista das suas faturas, simular pagamentos, reservar estadias, imprimir e efeutar o download das suas faturas.
4. Siga a interface intuitiva da aplicação para realizar as ações desejadas e navegar pelas diferentes secções.
5. Certifique-se de fazer logout quando terminar de usar a aplicação para garantir a segurança da sua conta.

## Autores
Diana Catarino `2220863`
<br> Maria Jesus `2211923`

>Unidade Curricular: Plataformas de Sistemas de Informação @2024
> <br> Curso Técnico Superior Profissional de Programação de Sistemas de Informação