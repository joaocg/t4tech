# Projeto Laravel 10 - Gerenciamento de Informações Esportivas (API REST)

---------------------------------------
# Deploy do projeto ```` com o  Docker ````

---------------------------------------
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
## Instruções para executar o Docker Compose no Laravel

Este guia ensina como configurar e executar o ambiente Docker para o seu projeto Laravel usando Docker Compose.

## Pré-requisitos

- **Docker**: Certifique-se de ter o Docker instalado em sua máquina. Se você ainda não instalou, consulte o site oficial do Docker para instruções de instalação: [Docker Install](https://docs.docker.com/get-docker/).

### Executando o Docker Compose

Dependendo da versão do Docker que você está usando, o comando para executar o Docker Compose pode variar:

  ```
  Você não deve ter outros serviços rodando nas portas 3306 e 8000.
  Se tiver, deve parar pois o docker vai utilizar essas portas para o projeto.
  ```
- **Para versões do Docker abaixo de `v2.0.0`**, use o comando com o hífen:

  ```bash
  docker-compose up -d

- **Para versões mais recentes do Docker `(v2.0.0 e acima)`**, use o comando com o hífen:

  ```bash
  docker compose up -d

# Acompanhando os Logs do Container Laravel

Para acompanhar os logs do container `laravel_app`, você pode utilizar tanto o Docker Desktop quanto a linha de comando (CLI). Siga as instruções abaixo para cada método.

  ```
  Os logs desse container docker está contido o passo a passo da execução 
  da aplicação em laravel. Composer install, php artisan migrate, 
  php artisan db:seed, php artisan optimize e um dos principais o 
  php artisan import:sports-data reponsável por importar os dados da api externa.
  ```
## 1. Acompanhando os Logs no Docker Desktop

1. **Abra o Docker Desktop**: Inicie o aplicativo Docker Desktop em sua máquina.

2. **Localize seu container**: 
   - No painel esquerdo, clique na aba **Containers**.
   - Encontre o container chamado `laravel_app` na lista de containers em execução.

3. **Visualize os logs**:
   - Clique no container `laravel_app`.
   - Na parte inferior da tela, você verá uma aba chamada **Logs**. Clique nela.
   - Os logs do container serão exibidos em tempo real. Você pode acompanhar as mensagens até que apareça a linha indicando que as rotas foram carregadas:
     ```
     routes ........................................................... 18ms DONE
     ```

## 2. Acompanhando os Logs via CLI

1. **Abra seu terminal**.

2. **Verifique se o Docker está em execução**: 
   - Use o comando abaixo para garantir que o Docker esteja ativo:
     ```bash
     docker info
     ```
   - Se o Docker estiver em execução, você verá várias informações sobre o estado atual do Docker.

3. **Use o comando `docker logs`**:
   - Para visualizar os logs do container `laravel_app`, execute:
     ```bash
     docker logs -f laravel_app
     ```
   - O parâmetro `-f` (ou `--follow`) permite que os logs sejam exibidos em tempo real, possibilitando o acompanhamento de novas entradas.

4. **Verifique as mensagens**:
   - Continue monitorando os logs até ver a linha:
     ```
     routes ........................................................... 18ms DONE
     ```

### Agora você pode acessar a Aplicação Laravel
Depois de executar o comando docker-compose ou docker compose, a aplicação Laravel estará rodando em um container. Você pode acessá-la em seu navegador na seguinte URL:
[Projeto Laravel 10](http://localhost:8000/)

### Importação dos dados da APi Externa

A Importação dos dados da Api de eportes são feitas por um comando do laravel o que dependendo da configuração da maquina que o docker está rodando, pode variar o tempo para os dados serem totalmente importados para a base local do docker.
Quando a importação é concluida.

---------------------------------------
# Deploy do projeto ```` sem o Docker ````

---------------------------------------
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



### Autorização / Autenticação:
````
Todas as requisições da API precisão ter o cabeçalho
X-Authorization. 
````
````
Uma vez logado o usuário utiliza o access_token do padrão sanctum.
````
