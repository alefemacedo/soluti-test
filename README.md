# Soluti-Test
Prova prática do processo seletivo para desenvolvedor PHP da Soluti

## API

### Dependências
- Tenha php-xml e php-pdo_mysql instalados pois utiliza-se para conexão com banco de dados
- Composer
### Instale as dependêcias
- composer install
### Executar as migrations
- vendor/bin/doctrine-module migrations:migrate
### Crie um cliente na tabela Client_OAauth2
- Não insira senha
- Insira "a:3:{i:0;s:8:"password";i:1;s:13:"refresh_token";i:2;s:5:"token";}" na propriedade grantType
- A propriedade redirectUri deve ter enpoint /oauth/[alguma coisa]
### Configure a conexão com o banco de dados
- Renomeie o arquivo api/config/autoload/doctrine.local.php.dist para doctrine.local.php
- Insira os parâmetros para conexão com o banco de dados
### Execute o servidor
- php -S localhost:8888 -t public/ ou composer serve
### Documentação das rotas
- Para ver a documentação das rotas acesse localhost:8888
- Vá em documentação e olhe aquela referente a versão mais recente da API

## Front-End

### Instale as dependências
- npm install
### Configure o clientId cadastrado na tabela Client_OAuth2
- Insira o clientId na propriedade VUE_APP_CLIENT_ID no aruivo admin/.env.development
### Execute o servidor
- npm run serve
