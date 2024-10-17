# Projeto Laravel 10 - Gerenciamento de Informações Esportivas (API REST)

## Requisitos Necessários

Para rodar este projeto Laravel 10, certifique-se de ter os seguintes requisitos instalados no seu ambiente:

- PHP 8.1 ou superior
- Composer 2.x
- MySQL 5.7 ou superior / MariaDB
- Git (opcional, mas recomendado)
- Extensões PHP necessárias:
  - `mbstring`
  - `openssl`
  - `pdo`
  - `json`
  - `xml`
  - `curl`

## Passos para Configuração do Ambiente

Siga os passos abaixo para configurar o ambiente e rodar o projeto:

1. Clone o repositório do projeto:

````
    git clone https://github.com/joaocg/t4tech
````

2. Navegue até o diretório do projeto:

````
cd t4tech
````

3. Instale as dependências do PHP usando o Composer:

````
composer install
````

4. Copie o arquivo .env.example para .env e configure as variáveis de ambiente, como conexão ao banco de dados e chave da API externa:

````
cp .env.example .env
````

5. Gere a chave da aplicação Laravel:

````
php artisan key:generate
````

6. Configure o banco de dados no arquivo .env, alterando as variáveis DB_HOST, DB_DATABASE, DB_USERNAME e DB_PASSWORD conforme sua configuração local.

7. Execute as migrações para criar as tabelas no banco de dados:

````
php artisan migrate
````

8. Popule o banco de dados com dados fictícios:

````
php artisan db:seed
````

## Como Rodar a Aplicação
1. Inicie o servidor de desenvolvimento Laravel:

````
php artisan serve
````

A aplicação estará acessível em: http://localhost:8000

## Como Rodar os Testes
Este projeto utiliza PHPUnit para testes de unidade e de integração.

1. Para rodar os testes, execute o seguinte comando:

````
php artisan test
````

Ou, se preferir, você pode rodar apenas um grupo de testes específico:

````
php artisan test --filter=NomeDoTeste
````

2. Se você quiser rodar os testes utilizando um banco de dados em memória (sqlite), configure o driver do banco de dados no arquivo .env.testing da seguinte forma:

env
````
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
````
Isso garantirá que os testes utilizem um banco em memória e que não modifiquem o banco de dados principal.

## Como Utilizar o Comando de Importação de Dados
O projeto inclui um comando para importar dados esportivos de uma API externa.

### Executar o Comando Manualmente
Para importar dados manualmente, use o seguinte comando Artisan:

````
php artisan sports-data:import
````
Este comando irá buscar as informações mais recentes de Players, Teams e Games, e armazená-las no banco de dados.

### Execução Automática com Cron
Esse comando foi configurado para ser executado automaticamente uma vez por dia utilizando o cron. Para isso, é necessário adicionar a seguinte entrada na sua configuração de cron:

````
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
````

Essa entrada no cron vai verificar o agendamento a cada minuto e executar os comandos agendados. O comando de importação de dados será executado uma vez por dia.





