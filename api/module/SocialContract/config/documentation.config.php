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
           "href": "/user"
       },
       "first": {
           "href": "/user?page={page}"
       },
       "prev": {
           "href": "/user?page={page}"
       },
       "next": {
           "href": "/user?page={page}"
       },
       "last": {
           "href": "/user?page={page}"
       }
   }
   "_embedded": {
       "users": [
           {
               "_links": {
                   "self": {
                       "href": "/user[/:user_id]"
                   }
               }
              "email": "E-mail/Login do usuário",
              "password": "Senha do usuário para login",
              "person": {
                    "cpf": "CPF da pessoa a qual o usuário pertence",
                    "name": "Nome da pessoa a qual o usuário é vinculado"
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
                'description' => 'Retorna os dados referentes a um usuário de acordo com seu identificador no banco (pode ser um OAuth2 Access Token)',
                'response' => '{
   "_links": {
       "self": {
           "href": "/user[/:user_id]"
       }
   }
    "email": "E-mail/Login do usuário",
    "password": "Senha do usuário para login",
    "person": {
         "cpf": "CPF da pessoa a qual o usuário pertence",
         "name": "Nome da pessoa a qual o usuário é vinculado"
     }
}',
            ],
            'PATCH' => [
                'description' => 'Atualiza os dados de um usuário de acordo com os parâmetros passados na requisição e o ID do usuário em questão',
                'request' => '{
   "name": "Nome da pessoa a qual o usuário pertence",
   "cpf": "CPF da pessoa a qual o usuário pertence",
   "password": "Senha do usuário",
   "email": "E-mail/Login do usuário"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/user[/:user_id]"
       }
   }
   "message": "Mensagem informando se a atualização foi realizada com sucesso"
}',
            ],
            'POST' => [
                'description' => 'Insere um novo usuário no banco de dados',
                'request' => '{
   "email": "E-mail/Login do usuário",
   "cpf": "CPF da pessoa a qual o usuário pertence",
   "name": "Nome da pessoa a qual o usuário é vinculado",
   "password": "Senha do usuário para login"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/usuario[/:usuario_id]"
       }
   }
   "message": "Mensagem informando se o usuário foi cadastrado com sucesso"
}',
            ],
            'DELETE' => [
                'description' => 'Remove um usuário do banco de acordo com seu ID (Este método não foi implementado)',
                'request' => '',
                'response' => '',
            ],
        ],
    ],
    'SocialContract\\V1\\Rest\\Empresa\\Controller' => [
        'description' => 'Serviço para cadastro de empresas juntamente com seu contrato social (opcional)',
        'collection' => [
            'description' => 'Coleção de instâncias da entidade Empresa',
            'GET' => [
                'description' => 'Retorna todas as empresas cadastradas no banco de dados',
                'response' => '{
   "_links": {
       "self": {
           "href": "/company"
       },
       "first": {
           "href": "/company?page={page}"
       },
       "prev": {
           "href": "/company?page={page}"
       },
       "next": {
           "href": "/company?page={page}"
       },
       "last": {
           "href": "/company?page={page}"
       }
   }
   "_embedded": {
       "companies": [
           {
               "_links": {
                   "self": {
                       "href": "/company[/:company_id]"
                   }
               }
              "cnpj": "CNPJ da empresa",
              "name": "Nome fantasia da empresa",
              "corporateName": "Rasão Social da empresa"
           }
       ]
   }
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => 'Busca uma empresa no banco de dados de acordo com seu identificador que pode ser o ID no banco ou seu CNPJ',
                'response' => '{
   "_links": {
       "self": {
           "href": "/company[/:company_id]"
       }
   }
   "cnpj": "CNPJ da empresa",
   "name": "Nome fantasia da empresa",
   "corporateName": "Rasão Social da empresa",
   "_embedded": {
        "socialContract": {
              "filePath": "Caminho do arquivo PDF do Contrato Social"
              "_embedded": {
                    "responsible": "Array contento os dados de todos os responsáveis definidos no Contrato Social"
              }
        }
   }
}',
            ],
            'PATCH' => [
                'description' => 'Atualiza uma instância existente no banco da entidade Empresa juntamente com os dados de seus responsáveis e do Contrato Social',
                'request' => '{
   "cnpj": "CNPJ da empresa",
   "name": "Nome fantasia da empresa",
   "file": "Arquivo PDF representando o Contrato Social da empresa",
   "corporate_name": "Rasão Social da empresa",
   "responsible": "Responsáveis pela empresa de acordo com o Contrato Social",
   "userFile": "Identificador do usuário que realizou o último upload de arquivo para o contrato social da empresa"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/company[/:company_id]"
       }
   }
   "message": "Mensagem informando se os dados  da Empresa foram atualizados com sucesso"
}',
            ],
            'DELETE' => [
                'description' => 'Remove uma instância da entidade Empresa do banco de dados de acordo com seu ID no banco ou CNPJ',
            ],
            'POST' => [
                'description' => 'Insere uma instância da entidade Empresa no banco, juntamente com os dados do contrato social (opcional) e portanto  seus responsáveis',
                'request' => '{
   "cnpj": "CNPJ da empresa",
   "name": "Nome fantasia da empresa",
   "file": "Arquivo PDF representando o Contrato Social da empresa",
   "corporate_name": "Rasão Social da empresa",
   "responsible": "Responsáveis pela empresa de acordo com o Contrato Social",
   "userFile": "Identificador do usuário que realizou o último upload de arquivo para o contrato social da empresa"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/company[/:company_id]"
       }
   }
   "message": "Mensagem informando se a Empresa foi cadastrada com sucesso"
}',
            ],
            'description' => 'Entidade que representa as instâncias de Empresa cadastradas no banco de dados',
        ],
    ],
    'SocialContract\\V1\\Rest\\Contrato\\Controller' => [
        'description' => 'Serviço para gestão dos dados referentes aos contratos sociais das empresas cadastradas no banco de dados',
        'collection' => [
            'description' => 'Coleção de instâncias da entidade Contrato Social juntamente com os dados de seus responsáveis',
            'GET' => [
                'description' => 'Retorna uma coleção com todas as instâncias da entidade Contrato Social paginadas, que estão cadastradas no banco de dados',
                'response' => '{
   "_links": {
       "self": {
           "href": "/contract"
       },
       "first": {
           "href": "/contract?page={page}"
       },
       "prev": {
           "href": "/contract?page={page}"
       },
       "next": {
           "href": "/contract?page={page}"
       },
       "last": {
           "href": "/contract?page={page}"
       }
   }
   "_embedded": {
       "contracts": [
           {
               "_links": {
                   "self": {
                       "href": "/contract[/:contract_id]"
                   }
               }
              "filename": Nome do arquivo PDF que representa o Contrato Social da empresa",
              "validated": "Flag indicando se o contrato já foi validado",
              "company": "Objeto contendo os dados da empresa à qual o Contrato Social é vinculado",
              "user": "Objeto contendo o identificador do usuário que fez upload do Contrato Social,  e os dados da 
               Pessoa Física vinculada à este",
           }
       ]
   }
}',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => 'Retorna os dados referentes a uma instância da entidade Contrato Social juntamente com os dados de seus reponsáveis',
                'response' => '{
   "_links": {
       "self": {
           "href": "/contract[/:contract_id]"
       }
   }
   "file": "FilePath do arquivo PDF que representa o Contrato Social da empresa",
   "responsible": "Array formatado de objetos com os dados dos responsáveis descritos no Contrato Social, como ID da pessoa e sua responsabilidade",
   "company": "Objeto contendo os dados da Empresa à qual o Contrato Social é vinculado"
}',
            ],
            'PATCH' => [
                'description' => 'Atualiza os dados de uma instância da entidade Contrato Social, de acordo com seu identificador no banco (ID)',
                'request' => '{
   "validate": "Flag identificando se a requisição é para validar o Contrato Social"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/contract[/:contract_id]"
       }
   }
   "message": "Mensagem informando se o Contrato Social foi atualizado ou validado com sucesso"
}',
            ],
            'DELETE' => [
                'description' => 'Remove uma instância da entidade Contrato Social do banco de  dados, de acordo com o ID',
                'request' => '{
   "file": "Arquivo PDF representando o Contrato Social da empresa",
   "responsible": "Coleção de objetos com os dados dos responsáveis descritos no Contrato Social, como ID da pessoa e sua responsabilidade",
   "company_id": "Identificador (ID do banco de dados) da empresa a qual o Contrato Social é referente",
   "validated": "Define se a instância em questão já foi validada"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/contract[/:contract_id]"
       }
   }
   "file": "Arquivo PDF representando o Contrato Social da empresa",
   "responsible": "Coleção de objetos com os dados dos responsáveis descritos no Contrato Social, como ID da pessoa e sua responsabilidade",
   "company_id": "Identificador (ID do banco de dados) da empresa a qual o Contrato Social é referente",
   "validated": "Define se a instância em questão já foi validada"
}',
            ],
            'POST' => [
                'description' => 'Insere uma instância da entidade Contrato Social no banco de dados, juntamente com os dados de seus responsáveis',
                'request' => '{
   "file": "Arquivo PDF representando o Contrato Social da empresa",
   "responsible": "Coleção de objetos com os dados dos responsáveis descritos no Contrato Social, como ID da pessoa e sua responsabilidade",
   "company_id": "Identificador (ID do banco de dados) da empresa a qual o Contrato Social é referente",
   "validated": "Define se a instância em questão já foi validada"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/contract[/:contract_id]"
       }
   }
   "file": "Arquivo PDF representando o Contrato Social da empresa",
   "responsible": "Coleção de objetos com os dados dos responsáveis descritos no Contrato Social, como ID da pessoa e sua responsabilidade",
   "company_id": "Identificador (ID do banco de dados) da empresa a qual o Contrato Social é referente",
   "validated": "Define se a instância em questão já foi validada"
}',
            ],
            'description' => 'Entidade que representa os dados do Contrato Social de uma empresa',
        ],
    ],
    'SocialContract\\V1\\Rest\\PessoaFisica\\Controller' => [
        'description' => 'Serviço para gestão das instâncias da entidade de Pessoa Física',
        'collection' => [
            'description' => 'Coleção de instâncias da entidade de Pessoa Física',
            'GET' => [
                'description' => 'Retorna uma coleção com as instâncias da entidade de Pessoa Física cadastradas no banco de dados',
                'response' => '{
   "_links": {
       "self": {
           "href": "/person"
       },
       "first": {
           "href": "/person?page={page}"
       },
       "prev": {
           "href": "/person?page={page}"
       },
       "next": {
           "href": "/person?page={page}"
       },
       "last": {
           "href": "/person?page={page}"
       }
   }
   "_embedded": {
       "people": [
           {
               "_links": {
                   "self": {
                       "href": "/person[/:person_id]"
                   }
               }
              "value": "ID da pessoa",
              "text": "Nome da pessoa formatado juntamente com o CPF"
           }
       ]
   }
}',
            ],
        ],
        'entity' => [
            'description' => 'Entidade que representa as instâncias de Pessoa Física',
            'GET' => [
                'description' => 'Retorna os dados de uma instância de pessoa física, bem com se ela possui ou não um usuário',
                'response' => '{
   "_links": {
       "self": {
           "href": "/person[/:person_id]"
       }
   }
   "person": {
        "name": "Nome da pessoa",
        "cpf": "CPF que identifica a pessoa"
    },
    "hasUser": "Flag que identifica se a pessoa tem um usuário cadastrado ou não"
}',
            ],
            'PATCH' => [
                'description' => 'Atualiza os dados de uma instância de Pessoa Física',
                'request' => '{
   "name": "Nome da pessoa",
   "cpf": "CPF que identifica a pessoa"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/person[/:person_id]"
       }
   }
   "name": "Nome da pessoa",
   "cpf": "CPF que identifica a pessoa",
   "user": "Objeto contendo os dados do usuário desta pessoa (pode não ter)"
}',
            ],
            'DELETE' => [
                'description' => 'Remove uma instância de Pessoa Física do banco de dados de acordo com o identificador (ID)',
            ],
            'POST' => [
                'description' => 'Insere uma instância de Pessoa Física no banco de dados',
                'request' => '{
   "name": "Nome da pessoa",
   "cpf": "CPF que identifica a pessoa"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/person[/:person_id]"
       }
   }
   "message": "Mensagem informando se a Pessoa Física foi cadastrada com sucesso"
}',
            ],
        ],
    ],
];
