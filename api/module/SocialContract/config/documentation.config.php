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

           }
       ]
   }
}',
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
}',
            ],
            'PATCH' => [
                'description' => 'Atualiza os dados de um usuário de acordo com os parâmetros passados na requisição e o ID do usuário em questão',
                'request' => '{

}',
            ],
        ],
    ],
];
