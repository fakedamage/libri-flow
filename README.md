# Libri Flow - Gestão de Biblioteca Online

O **Libri Flow** é um sistema de gestão de biblioteca online desenvolvido com as seguintes tecnologias:

-   **Backend**: PHP 8.4 e Laravel 11
-   **Frontend**: Vue 3
-   **Banco de Dados**: MySQL
-   **Node.js**: 20 (para gerenciamento de dependências e build do frontend)

Este projeto permite gerenciar livros, usuários, empréstimos e devoluções de forma eficiente e intuitiva.

---

## Pré-requisitos

Antes de começar, certifique-se de que você possui os seguintes requisitos instalados em sua máquina:

-   **PHP 8.4**
-   **Composer** (gerenciador de dependências do PHP)
-   **Node.js 20** (com npm incluso)
-   **MySQL** (ou outro banco de dados suportado pelo Laravel)
-   **Git** (para clonar o repositório)

---

## Instalação

Siga os passos abaixo para configurar e executar o projeto localmente.

### 1. Clonar o repositório

Clone o repositório do projeto para o seu ambiente local:

```bash
git clone https://github.com/fakedamage/libri-flow.git
cd libri-flow
```

### 2. Configurar o ambiente

#### Instalar dependências do PHP

Instale as dependências do PHP usando o Composer:

```bash
composer install
```

#### Configurar o arquivo .env

Crie uma cópia do arquivo .env.example e renomeie para .env:

```bash
cp .env.example .env
```

#### Gerar a chave do Laravel

Gere a chave de aplicação do Laravel:

```bash
php artisan key:generate
```

#### Executar migrações e seeders

Execute as migrações para criar as tabelas no banco de dados e popular com dados iniciais (se necessário):

```bash
php artisan migrate
```

### 3. Instalar dependências do Node.js

Instale as dependências do frontend usando o npm:

```bash
npm install
```

## Executando o Projeto

### 1. Iniciar o servidor Laravel

Execute o servidor de desenvolvimento do Laravel:

```bash
npm run dev
```

O servidor estará disponível em: http:/localhost:8000.
