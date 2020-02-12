<?php
return [
    'SocialContract\\V1\\Rest\\Usuario\\Controller' => [
        'description' => 'Serviço para cadastro e manutenção de usuários da aplicação',
        'collection' => [
            'description' => 'Coleção de objetos da entidade Usuário',
            'GET' => [
                'description' => 'Retorna uma coleção contendo os usuários de acordo com os parâmetros passados',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario"
       },
       "first": {
           "href": "/usuario?page={page}"
       },
       "prev": {
           "href": "/usuario?page={page}"
       },
       "next": {
           "href": "/usuario?page={page}"
       },
       "last": {
           "href": "/usuario?page={page}"
       }
   }
   "_embedded": {
       "usuarios": [
           {
               "_links": {
                   "self": {
                       "href": "/usuario[/:usuario_id]"
                   }
               }
              "senha": "Senha do usuário",
              "email": "E-mail/Login do usuário",
              pessoa: {
                  "cpf": "CPF da pessoa a qual o usuário pertence",
                  "nome": "Nome da pessoa a qual o usuário é vinculado"
              }
           }
       ]
   }
}',
            ],
            'POST' => [
                'request' => '',
            ],
        ],
        'entity' => [
            'description' => 'Entidade que representa as instâncias de usuários da aplicação cadastrados no banco',
            'GET' => [
                'description' => 'Retorna os dados referentes a um usuário de acordo com seu ID no banco',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario[/:usuario_id]"
       }
   }
  "senha": "Senha do usuário",
  "email": "E-mail/Login do usuário",
   pessoa: {
       "cpf": "CPF da pessoa a qual o usuário pertence",
       "nome": "Nome da pessoa a qual o usuário é vinculado"
    }
}',
            ],
            'PATCH' => [
                'description' => 'Atualiza os dados de um usuário de acordo com os parâmetros passados na requisição e o ID do usuário em questão',
                'request' => '{
   "name": "Nome da pessoa a qual o usuário pertence",
   "cpf": "CPF da pessoa a qual o usuário pertence",
   "password": "Senha do usuário",
   "email": "E-mail/Login do usuário",
   "person_id": "Identificador da pessoa a qual o usuário pertence"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario[/:usuario_id]"
       }
   }
   "name": "Nome da pessoa a qual o usuário pertence",
   "cpf": "CPF da pessoa a qual o usuário pertence",
   "password": "Senha do usuário",
   "email": "E-mail/Login do usuário",
   "person_id": "Identificador da pessoa a qual o usuário pertence"
}',
            ],
            'POST' => [
                'description' => 'Insere um novo usuário no banco de dados',
                'request' => '{
   "email": "E-mail/Login do usuário",
   "cpf": "CPF da pessoa a qual o usuário pertence",
   "nome": "Nome da pessoa a qual o usuário é vinculado",
   "senha": "Senha do usuário"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario[/:usuario_id]"
       }
   }
   "email": "E-mail/Login do usuário",
   "cpf": "CPF da pessoa a qual o usuário pertence",
   "nome": "Nome da pessoa a qual o usuário é vinculado",
   "senha": "Senha do usuário"
}',
            ],
        ],
    ],
];
