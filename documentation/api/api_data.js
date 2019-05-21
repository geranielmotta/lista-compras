define({ "api": [
  {
    "type": "GET",
    "url": "/accesslevels/:id",
    "title": "getAllAccessLevels",
    "version": "1.0.0",
    "name": "getAllAccessLevels",
    "group": "Access_Levels",
    "permission": [
      {
        "name": "none"
      }
    ],
    "description": "<p>Esta função consulta todos os niveis de acesso.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>Id do usuário.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>Retorna verdadeiro se encontrou.</p>"
          },
          {
            "group": "Success 200",
            "type": "object[]",
            "optional": false,
            "field": "access_levels",
            "description": "<p>Retorna objeto com o valor selecionado.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\":true,\"access_levels\": {\"id\":\"4\",\"description\":\"Usuário\",\"code\":\"1\"}}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>false caso ocorra um erro.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n{\"type\": false,\"data\": \"error\"}",
          "type": "json"
        }
      ]
    },
    "filename": "api/Models/AccessLevels.php",
    "groupTitle": "Access_Levels"
  },
  {
    "type": "GET",
    "url": "/accesslevelsnotroot",
    "title": "getAllAccessLevelsNotRoot",
    "version": "1.0.0",
    "name": "getAllAccessLevelsNotRoot",
    "group": "Access_Levels",
    "permission": [
      {
        "name": "none"
      }
    ],
    "description": "<p>Esta função consulta todos os niveis de acesso que não são ROOT.</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>Retorna verdadeiro se encontrou.</p>"
          },
          {
            "group": "Success 200",
            "type": "object[]",
            "optional": false,
            "field": "access_levels",
            "description": "<p>Retorna objeto com o valor selecionado.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\":true,\"access_levels\": {\"id\":\"4\",\"description\":\"Usuário\",\"code\":\"1\"},{\"id\":\"3\",\"description\":\"Técnico\",\"code\":\"10\"},{\"id\":\"2\",\"description\":\"Administrador\",\"code\":\"100\"}}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>false caso ocorra um erro.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n{\"type\": false,\"data\": \"error\"}",
          "type": "json"
        }
      ]
    },
    "filename": "api/Models/AccessLevels.php",
    "groupTitle": "Access_Levels"
  },
  {
    "type": "GET",
    "url": "/accesslevels/:id",
    "title": "getOneAccessLevels",
    "version": "1.0.0",
    "name": "getOneAccessLevels",
    "group": "Access_Levels",
    "permission": [
      {
        "name": "none"
      }
    ],
    "description": "<p>Esta função consulta um nivel de acesso de um usuário.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>Id do usuário.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>Retorna verdadeiro se encontrou.</p>"
          },
          {
            "group": "Success 200",
            "type": "object[]",
            "optional": false,
            "field": "access_levels",
            "description": "<p>Retorna objeto com o valor selecionado.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\":true,\"access_levels\": {\"id\":\"4\",\"description\":\"Usuário\",\"code\":\"1\"}}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>false caso ocorra um erro.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n{\"type\": false,\"data\": \"error\"}",
          "type": "json"
        }
      ]
    },
    "filename": "api/Models/AccessLevels.php",
    "groupTitle": "Access_Levels"
  },
  {
    "type": "POST",
    "url": "/login",
    "title": "",
    "version": "1.0.0",
    "name": "login",
    "group": "Login",
    "permission": [
      {
        "name": "none"
      }
    ],
    "description": "<p>Faz a autenticação dos usuários</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>Email do usuário.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>Senha do usuário.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>Retorna verdadeiro se existe o usuário.</p>"
          },
          {
            "group": "Success 200",
            "type": "object[]",
            "optional": false,
            "field": "data",
            "description": "<p>Retorna um objeto com informações do usuário.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " OK\n{\"type\":true,\"data\":\"name\",\"id\":\"id\",\"token\":\"token\",\"access_levels\":\"access_levels\"}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "FALSE",
            "description": "<p>Retorna falso se o usuário não existe.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " Not Found\n{\"type\": false,\"data\": \"Incorrect email/password\"}",
          "type": "json"
        }
      ]
    },
    "filename": "api/index.php",
    "groupTitle": "Login"
  },
  {
    "type": "DELETE",
    "url": "/user/:id",
    "title": "deleteUser",
    "version": "1.0.0",
    "name": "deleteUser",
    "group": "User",
    "permission": [
      {
        "name": "admin"
      }
    ],
    "description": "<p>Esta função deleta um registro</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>Id a ser deletado</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>false caso ocorra um erro.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n{\"type\": false,\"data\": \"error\"}",
          "type": "json"
        }
      ]
    },
    "filename": "api/Models/User.php",
    "groupTitle": "User"
  },
  {
    "type": "GET",
    "url": "/user/",
    "title": "getAllUser",
    "version": "1.0.0",
    "name": "getAllUser",
    "group": "User",
    "permission": [
      {
        "name": "none"
      }
    ],
    "description": "<p>Esta função seleciona todos os registro</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>Retorna verdadeiro se encontrou</p>"
          },
          {
            "group": "Success 200",
            "type": "object[]",
            "optional": false,
            "field": "user",
            "description": "<p>Retorna um objeto com todos os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"user\": {\"id\":\"1\",\"username\":\"geranielmotta\",\"name\":\"Geraniel Motta\",\"phone\":\"+55541554448\",\"email\":\"geraniel.motta@gmail.com\",\"access_levels\":\"Adminstrador\"}}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>false caso ocorra um erro.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n{\"type\": false,\"data\": \"error\"}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "http://api.lista-compras.com/user"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": true,
            "field": "Authorization",
            "defaultValue": "bearer",
            "description": "<p>f7a18c7871d160d4202b1878c73eefc9]</p>"
          }
        ]
      }
    },
    "filename": "api/Models/User.php",
    "groupTitle": "User"
  },
  {
    "type": "GET",
    "url": "/user/:id",
    "title": "getOneUser",
    "version": "1.0.0",
    "name": "getOneUser",
    "group": "User",
    "permission": [
      {
        "name": "none"
      }
    ],
    "description": "<p>Esta função seleciona um registro</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>Id a ser selecionado</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>Retorna verdadeiro se encontrou</p>"
          },
          {
            "group": "Success 200",
            "type": "object[]",
            "optional": false,
            "field": "user",
            "description": "<p>Retorna um objeto com os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"user\": {\"id\":\"1\",\"username\":\"geranielmotta\",\"name\":\"Geraniel Motta\",\"phone\":\"+55541554448\",\"email\":\"geraniel.motta@gmail.com\",\"access_levels\":\"Adminstrador\"}}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>false caso ocorra um erro.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n{\"type\": false,\"data\": \"error\"}",
          "type": "json"
        }
      ]
    },
    "filename": "api/Models/User.php",
    "groupTitle": "User"
  },
  {
    "type": "POST",
    "url": "/user",
    "title": "newUser",
    "version": "1.0.0",
    "name": "newUser",
    "group": "User",
    "permission": [
      {
        "name": "none"
      }
    ],
    "description": "<p>Esta função faz o cadastramento de um registro</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>Nome do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>Senha do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>Name completo do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>Telefone do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>Email do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "access_levels",
            "description": "<p>Nivel de acesso do usuário</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>Retorna verdadeiro se cadastrou</p>"
          },
          {
            "group": "Success 200",
            "type": "object[]",
            "optional": false,
            "field": "user",
            "description": "<p>Retorna um objeto com os valores cadastrados</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"user\": {\"username\":\"geranielmotta\",\"name\":\"Geraniel Motta\",\"phone\":\"+55541554448\",\"email\":\"geraniel.motta@gmail.com\",\"access_levels\":\"Adminstrador\"}}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>false caso ocorra um erro.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n{\"type\": false,\"data\": \"error\"}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "http://api.lista-compras/api/user"
      }
    ],
    "filename": "api/Models/User.php",
    "groupTitle": "User"
  },
  {
    "type": "PUT",
    "url": "/user/:id",
    "title": "updateUser",
    "version": "1.0.0",
    "name": "updateUser",
    "group": "User",
    "permission": [
      {
        "name": "none"
      }
    ],
    "description": "<p>Esta função atualiza um registro</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>Nome do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>Senha do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>Name completo do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>Telefone do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>Email do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "access_levels",
            "description": "<p>Nivel de acesso do usuário</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>Id a ser atualizado</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>Retorna verdadeiro se atualizou</p>"
          },
          {
            "group": "Success 200",
            "type": "object[]",
            "optional": false,
            "field": "user",
            "description": "<p>Retorna um objeto com os valores atualizados</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"user\": {\"id\":\"1\",\"username\":\"geranielmotta\",\"name\":\"Geraniel Motta\",\"phone\":\"+55541554448\",\"email\":\"geraniel.motta@gmail.com\",\"access_levels\":\"Adminstrador\"}}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "boolean",
            "optional": false,
            "field": "type",
            "description": "<p>false caso ocorra um erro.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>Mensagem de erro.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n{\"type\": false,\"data\": \"error\"}",
          "type": "json"
        }
      ]
    },
    "filename": "api/Models/User.php",
    "groupTitle": "User"
  }
] });
