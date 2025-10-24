# **EasyBudget – Sistema de Organização de Eventos**

## **Descrição Geral**

O EasyBudget é um sistema web para gerenciamento e organização de eventos, desenvolvido em Laravel seguindo o padrão MVC e aplicando boas práticas de arquitetura.
O sistema permite o cadastro de eventos, controle de orçamento, gerenciamento de convidados, relatórios e visualização de indicadores.

---

## **Integrantes**

| Nome                | Matrícula |
| ------------------- | --------- |
| Bernardo Barbieri   | 12302619  |
| Bernardo Juscelino  | 12303232  |
| Pietro Debiagi      | 12301701  |
| Arthur Alvim        | 12300829  |
| Luiz Dutra          | 22402713  |
| João Vitor Santiago | 22300317  |

---

## **Tecnologias Utilizadas**

* PHP 8+
* Laravel 10/11/12
* MySQL
* Composer
* Node.js / NPM
* HTML / CSS / JavaScript
* Barryvdh DomPDF (exportação para PDF)
* Chart.js (gráficos)
* Filesystem Laravel (armazenamento de imagens)

---

## **Funcionalidades Implementadas (20/20)**

### **Autenticação e Estrutura do Sistema**

1. **Cadastro de Usuário**
2. **Login e Autenticação de Sessão**
3. **Dashboard com Resumo do Sistema**

### **Gerenciamento de Eventos**

4. **Cadastro de Eventos**
5. **Listagem de Eventos**
6. **Edição de Eventos**
7. **Exclusão de Eventos**
8. **Upload de Imagem para o Evento**
9. **Classificação por Categoria do Evento**
10. **Status do Evento (Planejado, Em andamento, Concluído)**

### **Orçamento**

11. **Cadastro de Itens de Orçamento** (nome, valor, quantidade)
12. **Cálculo Automático do Valor Total do Orçamento**
13. **Edição e Exclusão de Itens do Orçamento**

### **Convidados**

14. **Cadastro de Convidados Vinculados ao Evento**
15. **Confirmação e Controle de Presença**
16. **Exclusão de Convidados**

### **Relatórios**

17. **Relatório Detalhado do Evento**
18. **Exportação de Relatório Completo para PDF**
19. **Exportação da Lista de Convidados para PDF**

### **Dashboard Gerencial**

20. **Gráfico de Resumo Financeiro dos Eventos (Chart.js)**

---

## **Modelagem do Banco de Dados**

### **Tabela `events`**

| Campo                   | Tipo       | Descrição                         |
| ----------------------- | ---------- | --------------------------------- |
| id                      | bigint     | Identificador                     |
| user_id                 | bigint     | Dono do evento                    |
| title                   | varchar    | Nome do evento                    |
| description             | text       | Descrição                         |
| date                    | date       | Data                              |
| location                | varchar    | Local                             |
| image                   | varchar    | Caminho da imagem                 |
| category                | varchar    | Categoria do evento               |
| status                  | varchar    | Status do evento                  |
| created_at / updated_at | timestamps | Controle de criação e atualização |

### **Tabela `budgets`**

| Campo                   | Tipo       | Descrição                 |
| ----------------------- | ---------- | ------------------------- |
| id                      | bigint     |                           |
| event_id                | bigint     | Relacionamento com evento |
| name                    | varchar    | Item                      |
| price                   | decimal    | Valor unitário            |
| quantity                | int        | Quantidade                |
| created_at / updated_at | timestamps |                           |

### **Tabela `guests`**

| Campo                   | Tipo       | Descrição                  |
| ----------------------- | ---------- | -------------------------- |
| id                      | bigint     |                            |
| name                    | varchar    | Nome do convidado          |
| event_id                | bigint     | Relacionamento             |
| confirmed               | boolean    | Presença confirmada ou não |
| created_at / updated_at | timestamps |                            |

---

## **Como Executar o Projeto**

```bash
git clone https://github.com/seu-usuario/EasyBudget.git
cd EasyBudget

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate
```

### **Configurar Banco de Dados**

No arquivo `.env`, ajustar:

```
DB_CONNECTION=mysql
DB_DATABASE=easybudget
DB_USERNAME=root
DB_PASSWORD=senha
```

### **Rodar Migrations**

```bash
php artisan migrate
```

### **Executar o Servidor**

```bash
php artisan serve
```

Acesse:

http://127.0.0.1:8000



## **Conclusão**

O EasyBudget entrega uma solução completa para o gerenciamento de eventos, oferecendo organização, controle financeiro, relatórios estruturados e interface eficiente, atendendo às demandas de organização e apresentação profissional.

