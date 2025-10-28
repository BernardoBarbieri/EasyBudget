# 🎯 **EasyBudget – Sistema de Organização de Eventos**

> 💡 Um sistema web completo para planejar, organizar e controlar eventos — com gerenciamento de convidados, orçamentos, relatórios e estatísticas financeiras.

---

## 👥 **Integrantes**

|  Nº | Nome                    | Matrícula |
| :-: | :---------------------- | :-------: |
|  1  | **Bernardo Barbieri**   |  12302619 |
|  2  | **Bernardo Juscelino**  |  12303232 |
|  3  | **Pietro Debiagi**      |  12301701 |
|  4  | **Arthur Alvim**        |  12300829 |
|  5  | **Luiz Dutra**          |  22402713 |
|  6  | **João Vitor Santiago** |  22300317 |

---

## 🧠 **Descrição Geral**

O **EasyBudget** é um sistema web desenvolvido em **Laravel**, utilizando o padrão **MVC (Model–View–Controller)** e boas práticas de arquitetura.
Ele permite que o usuário crie e gerencie eventos, adicione orçamentos personalizados, controle convidados e gere relatórios com exportação em **PDF**, tudo em uma interface moderna e intuitiva.

---

## ⚙️ **Tecnologias Utilizadas**

| Categoria                    | Ferramentas                              |
| ---------------------------- | ---------------------------------------- |
| **Backend**                  | PHP 8+, Laravel 10/11/12                 |
| **Banco de Dados**           | MySQL                                    |
| **Frontend**                 | HTML5, CSS3, JavaScript, Bootstrap 5     |
| **Autenticação**             | Laravel Breeze                           |
| **PDF e Relatórios**         | Barryvdh DomPDF                          |
| **Gráficos**                 | Chart.js                                 |
| **Padrões de Projeto (GoF)** | Singleton, Repository, Factory, Strategy |
| **Outros**                   | Composer, Node.js / NPM                  |

---

## 🚀 **Funcionalidades (20/20)**

### 🔐 **Autenticação e Estrutura**

1. Cadastro de usuários
2. Login e autenticação de sessão
3. Dashboard com resumo e atalhos

### 📅 **Eventos**

4. Cadastro de eventos
5. Listagem de eventos
6. Edição de eventos
7. Exclusão de eventos
8. Upload de imagem do evento
9. Categoria de evento (ex: Casamento, Corporativo, Aniversário)
10. Status do evento (Planejado, Em andamento, Concluído)

### 💰 **Orçamento**

11. Cadastro de itens de orçamento (nome, preço e quantidade)
12. Cálculo automático do valor total
13. Edição e exclusão de itens

### 🎟️ **Convidados**

14. Cadastro de convidados por evento
15. Confirmação de presença
16. Exclusão de convidados

### 📊 **Relatórios e Dashboard**

17. Relatório detalhado do evento
18. Exportação de relatórios em PDF
19. Exportação da lista de convidados em PDF
20. Gráfico de resumo financeiro (Chart.js)

---

## 🗂️ **Modelagem do Banco de Dados**

### **Tabela `events`**

| Campo       | Tipo     | Descrição             |
| :---------- | :------- | :-------------------- |
| id          | bigint   | Identificador         |
| user_id     | bigint   | Dono do evento        |
| title       | varchar  | Nome do evento        |
| description | text     | Descrição do evento   |
| date        | date     | Data                  |
| location    | varchar  | Localização           |
| image       | varchar  | Caminho da imagem     |
| category    | varchar  | Categoria             |
| status      | varchar  | Status do evento      |
| timestamps  | datetime | Criação / Atualização |

---

### **Tabela `budgets`**

| Campo      | Tipo     | Descrição             |
| :--------- | :------- | :-------------------- |
| id         | bigint   | Identificador         |
| event_id   | bigint   | Evento vinculado      |
| name       | varchar  | Item do orçamento     |
| price      | decimal  | Valor unitário        |
| quantity   | int      | Quantidade            |
| timestamps | datetime | Criação / Atualização |

---

### **Tabela `guests`**

| Campo      | Tipo     | Descrição             |
| :--------- | :------- | :-------------------- |
| id         | bigint   | Identificador         |
| name       | varchar  | Nome do convidado     |
| event_id   | bigint   | Evento relacionado    |
| confirmed  | boolean  | Presença confirmada   |
| timestamps | datetime | Criação / Atualização |

---

## 🧩 **Como Executar o Projeto Localmente**

### **1️⃣ Clonar o repositório**

```bash
git clone https://github.com/seu-usuario/EasyBudget.git
cd EasyBudget
```

### **2️⃣ Instalar dependências do backend**

```bash
composer install
```

### **3️⃣ Instalar dependências do frontend**

```bash
npm install
npm run build
```

### **4️⃣ Criar e configurar o `.env`**

```bash
cp .env.example .env
php artisan key:generate
```

Edite as configurações do banco:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=easybudget
DB_USERNAME=root
DB_PASSWORD=
```

### **5️⃣ Criar o link de armazenamento (imagens dos eventos)**

```bash
php artisan storage:link
```

### **6️⃣ Rodar as migrations**

```bash
php artisan migrate
```

### **7️⃣ Iniciar o servidor**

```bash
php artisan serve
```

📍 Acesse: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 💡 **Padrões de Projeto (GoF) Aplicados**

| Padrão             | Aplicação no Sistema                                            |
| ------------------ | --------------------------------------------------------------- |
| **Singleton**      | Garante instância única da conexão com o banco de dados         |
| **Repository**     | Isola a camada de acesso aos dados e facilita manutenção        |
| **Factory Method** | Gera diferentes tipos de relatórios (PDF, visual) dinamicamente |
| **Strategy**       | Permite múltiplas formas de cálculo e filtragem nos orçamentos  |

---

## 📊 **Resumo Visual**

* 💼 **Gerencie seus eventos com facilidade**
* 🧾 **Gere relatórios automáticos e exporte em PDF**
* 🎨 **Interface limpa e responsiva com Bootstrap**
* 💸 **Acompanhe o resumo financeiro com gráficos dinâmicos**

---

## 🏁 **Conclusão**

O **EasyBudget** é uma aplicação robusta, moderna e escalável, projetada para simplificar o gerenciamento de eventos com foco em praticidade, organização e clareza visual.
Construído em **Laravel**, o sistema aplica princípios de **POO e Design Patterns (GoF)**, oferecendo uma base sólida para manutenção e expansão futura.


