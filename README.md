EasyBudget – Sistema de Organização de Eventos
Descrição Geral

O EasyBudget é um sistema web para gerenciamento e organização de eventos, desenvolvido em Laravel seguindo o padrão MVC e aplicando boas práticas de arquitetura.
O sistema permite o cadastro de eventos, controle de orçamento, gerenciamento de convidados, relatórios e visualização de indicadores financeiros.

Integrantes
Nome	Matrícula
Bernardo Barbieri	12302619
Bernardo Juscelino	12303232
Pietro Debiagi	12301701
Arthur Alvim	12300829
Luiz Dutra	22402713
João Vitor Santiago	22300317
Tecnologias Utilizadas

PHP 8+

Laravel 10/11/12

MySQL

Composer

Node.js / NPM

HTML / CSS / JavaScript

Barryvdh DomPDF (exportação para PDF)

Chart.js (gráficos)

Filesystem Laravel (armazenamento de imagens)

Padrões de Projeto GoF (Singleton, Repository, Factory, Strategy)

Funcionalidades Implementadas (20/20)
Autenticação e Estrutura do Sistema

Cadastro de usuário

Login e autenticação de sessão

Dashboard com resumo do sistema

Gerenciamento de Eventos

Cadastro de eventos

Listagem de eventos

Edição de eventos

Exclusão de eventos

Upload de imagem para o evento

Classificação por categoria do evento

Status do evento (Planejado, Em andamento, Concluído)

Orçamento

Cadastro de itens de orçamento (nome, valor e quantidade)

Cálculo automático do valor total do orçamento

Edição e exclusão de itens do orçamento

Convidados

Cadastro de convidados vinculados ao evento

Confirmação e controle de presença

Exclusão de convidados

Relatórios

Relatório detalhado do evento

Exportação de relatório completo para PDF

Exportação da lista de convidados para PDF

Dashboard Gerencial

Gráfico de resumo financeiro dos eventos (Chart.js)

Modelagem do Banco de Dados
Tabela events
Campo	Tipo	Descrição
id	bigint	Identificador
user_id	bigint	Dono do evento
title	varchar	Nome do evento
description	text	Descrição
date	date	Data
location	varchar	Local
image	varchar	Caminho da imagem
category	varchar	Categoria do evento
status	varchar	Status do evento
created_at / updated_at	timestamps	Controle de criação e atualização
Tabela budgets
Campo	Tipo	Descrição
id	bigint	
event_id	bigint	Relacionamento com evento
name	varchar	Item
price	decimal	Valor unitário
quantity	int	Quantidade
created_at / updated_at	timestamps	
Tabela guests
Campo	Tipo	Descrição
id	bigint	
name	varchar	Nome do convidado
event_id	bigint	Relacionamento
confirmed	boolean	Presença confirmada ou não
created_at / updated_at	timestamps	
Como Executar o Projeto Localmente
1. Clonar o repositório
git clone https://github.com/seu-usuario/EasyBudget.git
cd EasyBudget

2. Instalar dependências do backend
composer install

3. Instalar dependências do frontend
npm install
npm run build

4. Criar e configurar o arquivo .env
cp .env.example .env
php artisan key:generate


Edite o .env e configure o banco de dados:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=easybudget
DB_USERNAME=root
DB_PASSWORD=

5. Criar o link de armazenamento (imagens dos eventos)
php artisan storage:link

6. Executar as migrations
php artisan migrate

7. Iniciar o servidor
php artisan serve


Acesse no navegador:

http://127.0.0.1:8000

Conclusão

O EasyBudget é uma solução completa para a organização de eventos, integrando controle financeiro, gerenciamento de convidados, relatórios e uma interface moderna e intuitiva.
O sistema aplica padrões de projeto reconhecidos (GoF), garantindo manutenção facilitada e escalabilidade.
