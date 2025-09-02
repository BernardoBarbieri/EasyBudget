📌 Projeto: Sistema de Organização de Eventos
👥 Integrantes

Bernardo Barbieri 1 – 12302619

Bernardo Juscelino 2 – 12303232

Pietro Debiagi 3 – 12301701

Arthur Alvim 4 - 12300829

Luiz Dutra 5 - 22402713

João Vitor Santiago 6 - 22300317

📖 Descrição

Este projeto é um sistema web desenvolvido em Laravel utilizando MVC (Model-View-Controller) e o padrão Repository como camada de persistência.
O sistema permite o gerenciamento de eventos, criação de orçamentos personalizados e geração de relatórios em PDF.

🚀 Funcionalidades Implementadas (10/10)

Cadastro de usuários – formulário de registro integrado ao Laravel Breeze.

Login com autenticação – controle de acesso seguro com sessões.

Dashboard inicial – tela de entrada após login com resumo.

Cadastro de eventos – formulário para criar novos eventos.

Listagem de eventos – exibe os eventos do usuário autenticado.

Edição de eventos – formulário para atualização de eventos existentes.

Exclusão de eventos – remoção de eventos do banco de dados.

Orçamento personalizado – inclusão de itens (nome, preço, quantidade) vinculados ao evento.

Relatórios detalhados – página com resumo do evento e dos itens de orçamento.

Exportação em PDF – geração de relatório em formato PDF para download.

🛠 Tecnologias Utilizadas

PHP 8+

Laravel 10/11/12

MySQL

Composer

Node.js + NPM

Bootstrap 5

Laravel Breeze
 (autenticação)

Barryvdh DomPDF
 (geração de PDF)

⚙️ Instruções para Rodar o Projeto
1. Clonar o repositório
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio

2. Instalar dependências
composer install
npm install && npm run dev

3. Configurar o .env

Copie o arquivo de exemplo e configure:

cp .env.example .env


Edite as credenciais do banco de dados:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventos_db
DB_USERNAME=root
DB_PASSWORD=suasenha

4. Gerar chave da aplicação
php artisan key:generate

5. Executar migrations
php artisan migrate

6. Iniciar servidor
php artisan serve


Acesse no navegador:

http://127.0.0.1:8000

🌐 URLs Principais

Cadastro de usuário → /register

Login → /login

Dashboard → /dashboard

Listar eventos → /events

Criar evento → /events/create

Editar evento → /events/{id}/edit

Orçamento → /events/{id}/budget

Relatório → /events/{id}/report

Baixar PDF → /events/{id}/report/pdf