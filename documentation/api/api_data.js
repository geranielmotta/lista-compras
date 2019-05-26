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
    "type": "DELETE",
    "url": "/List/:id",
    "title": "deleteCart",
    "version": "1.0.0",
    "name": "deleteCart",
    "group": "Cart",
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
    "filename": "api/Models/Cart.php",
    "groupTitle": "Cart"
  },
  {
    "type": "GET",
    "url": "/cart/user/:user",
    "title": "getAllProductsFromUserCart",
    "version": "1.0.0",
    "name": "getAllCart",
    "group": "Cart",
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
            "field": "Object",
            "description": "<p>Retorna um objeto com todos os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"Cart\": {\"id\":\"1\",\"spending\":\"200\",\"amount\":\"3\",\"shoppinglist\":\"1\",\"products\":\"20/05/2019\"}}",
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
        "url": "http://api.lista-compras.com/Cart"
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
    "filename": "api/Models/Cart.php",
    "groupTitle": "Cart"
  },
  {
    "type": "GET",
    "url": "/List/:id",
    "title": "getOneCart",
    "version": "1.0.0",
    "name": "getOneCart",
    "group": "Cart",
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
            "field": "object",
            "description": "<p>Retorna um objeto com os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"Cart\": {\"id\":\"1\",\"spending\":\"200\",\"amount\":\"3\",\"shoppinglist\":\"1\",\"products\":\"20/05/2019\"}}",
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
    "filename": "api/Models/Cart.php",
    "groupTitle": "Cart"
  },
  {
    "type": "POST",
    "url": "/List",
    "title": "newCart",
    "version": "1.0.0",
    "name": "newCart",
    "group": "Cart",
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
            "type": "products",
            "optional": false,
            "field": "data",
            "description": "<p>da criação da lista</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "shoppinglist",
            "description": "<p>Id do usuário</p>"
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
            "field": "Object",
            "description": "<p>Retorna um objeto com os valores cadastrados</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"Cart\": {\"product\":\"1\",\"shooplist\":\"1\"}}",
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
        "url": "http://api.lista-compras/api/Cart"
      }
    ],
    "filename": "api/Models/Cart.php",
    "groupTitle": "Cart"
  },
  {
    "type": "DELETE",
    "url": "/category/:id",
    "title": "deleteCategory",
    "version": "1.0.0",
    "name": "deleteCategory",
    "group": "Category",
    "permission": [
      {
        "name": "Root"
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
    "filename": "api/Models/Category.php",
    "groupTitle": "Category"
  },
  {
    "type": "GET",
    "url": "/category",
    "title": "getAllCategory",
    "version": "1.0.0",
    "name": "getAllCategory",
    "group": "Category",
    "permission": [
      {
        "name": "Root Admin User"
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
            "field": "Object",
            "description": "<p>Retorna um objeto com todos os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"Category\": {\"id\":\"1\",\"name\":\"Grãos\"},{\"id\":\"2\",\"name\":\"Carnes\"}}",
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
        "url": "http://api.lista-compras.com/category"
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
    "filename": "api/Models/Category.php",
    "groupTitle": "Category"
  },
  {
    "type": "GET",
    "url": "/category/:id",
    "title": "getOneCategory",
    "version": "1.0.0",
    "name": "getOneCategory",
    "group": "Category",
    "permission": [
      {
        "name": "Root Admin User"
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
            "field": "object",
            "description": "<p>Retorna um objeto com os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"category\": {\"id\":\"1\",\"name\":\"Grãos\"}}",
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
    "filename": "api/Models/Category.php",
    "groupTitle": "Category"
  },
  {
    "type": "POST",
    "url": "/category",
    "title": "newCategory",
    "version": "1.0.0",
    "name": "newCategory",
    "group": "Category",
    "permission": [
      {
        "name": "Root"
      }
    ],
    "description": "<p>Esta função faz o cadastramento de um registro</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "products",
            "optional": false,
            "field": "data",
            "description": "<p>da criação da lista</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "category",
            "description": "<p>Id do categoria</p>"
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
            "field": "Object",
            "description": "<p>Retorna um objeto com os valores cadastrados</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"Category\": {\"id\":\"1\",\"name\":\"Grãos\"}}",
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
        "url": "http://api.lista-compras/api/category"
      }
    ],
    "filename": "api/Models/Category.php",
    "groupTitle": "Category"
  },
  {
    "type": "PUT",
    "url": "/user/:id",
    "title": "updateUser",
    "version": "1.0.0",
    "name": "updateCategory",
    "group": "Category",
    "permission": [
      {
        "name": "Root"
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
            "field": "name",
            "description": "<p>Nome da categoria</p>"
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
            "field": "category",
            "description": "<p>Retorna um objeto com os valores atualizados</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"category\": {\"id\":\"1\",\"name\":\"Grãos\"}}",
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
    "filename": "api/Models/Category.php",
    "groupTitle": "Category"
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
    "url": "/products/:id",
    "title": "deleteProducts",
    "version": "1.0.0",
    "name": "deleteProducts",
    "group": "Products",
    "permission": [
      {
        "name": "Root"
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
    "filename": "api/Models/Products.php",
    "groupTitle": "Products"
  },
  {
    "type": "GET",
    "url": "/products",
    "title": "getAllProducts",
    "version": "1.0.0",
    "name": "getAllProducts",
    "group": "Products",
    "permission": [
      {
        "name": "Root Admin User"
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
            "field": "Object",
            "description": "<p>Retorna um objeto com todos os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"Products\": {\"id\":\"1\",\"name\":\"Feijão\",\"value\":\"4.80\",\"category\":\"Grãos\"},{\"id\":\"2\",\"name\":\"Arroz\",\"value\":\"5.80\",\"category\":\"Grãos\"}}",
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
        "url": "http://api.lista-compras.com/products"
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
    "filename": "api/Models/Products.php",
    "groupTitle": "Products"
  },
  {
    "type": "GET",
    "url": "/products/:id",
    "title": "getOneProducts",
    "version": "1.0.0",
    "name": "getOneProducts",
    "group": "Products",
    "permission": [
      {
        "name": "Root Admin User"
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
            "field": "object",
            "description": "<p>Retorna um objeto com os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"Products\": {\"id\":\"1\",\"name\":\"Grãos\"}}",
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
    "filename": "api/Models/Products.php",
    "groupTitle": "Products"
  },
  {
    "type": "POST",
    "url": "/products",
    "title": "newProducts",
    "version": "1.0.0",
    "name": "newProducts",
    "group": "Products",
    "permission": [
      {
        "name": "Root"
      }
    ],
    "description": "<p>Esta função faz o cadastramento de um registro</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "products",
            "optional": false,
            "field": "data",
            "description": "<p>da criação da lista</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "Products",
            "description": "<p>Id do produto</p>"
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
            "field": "Object",
            "description": "<p>Retorna um objeto com os valores cadastrados</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"Products\": {\"id\":\"1\",\"name\":\"Feijão\"}}",
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
        "url": "http://api.lista-compras/api/products"
      }
    ],
    "filename": "api/Models/Products.php",
    "groupTitle": "Products"
  },
  {
    "type": "PUT",
    "url": "/products/:id",
    "title": "updateProducts",
    "version": "1.0.0",
    "name": "updateProducts",
    "group": "Products",
    "permission": [
      {
        "name": "Root Admin"
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
            "field": "name",
            "description": "<p>Nome da categoria</p>"
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
            "field": "Products",
            "description": "<p>Retorna um objeto com os valores atualizados</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"products\": {\"id\":\"1\",\"name\":\"Feijão\",\"value\":\"2.5\",\"category\":\"1\"}}",
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
    "filename": "api/Models/Products.php",
    "groupTitle": "Products"
  },
  {
    "type": "DELETE",
    "url": "/shoppinglist/:id",
    "title": "deleteShoppingList",
    "version": "1.0.0",
    "name": "deleteShoppingList",
    "group": "ShoppingList",
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
    "filename": "api/Models/ShoppingList.php",
    "groupTitle": "ShoppingList"
  },
  {
    "type": "GET",
    "url": "/shoppinglist/",
    "title": "getAllShoppingList",
    "version": "1.0.0",
    "name": "getAllShoppingList",
    "group": "ShoppingList",
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
            "field": "Object",
            "description": "<p>Retorna um objeto com todos os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"ShoppingList\": {\"id\":\"1\",\"spending\":\"200\",\"amount\":\"3\",\"user\":\"1\",\"date\":\"20/05/2019\"}}",
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
        "url": "http://api.lista-compras.com/shoppinglist"
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
    "filename": "api/Models/ShoppingList.php",
    "groupTitle": "ShoppingList"
  },
  {
    "type": "GET",
    "url": "/shoppinglist/:id",
    "title": "getOneShoppingList",
    "version": "1.0.0",
    "name": "getOneShoppingList",
    "group": "ShoppingList",
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
            "field": "object",
            "description": "<p>Retorna um objeto com os valores</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"shoppingList\": {\"id\":\"1\",\"spending\":\"200\",\"amount\":\"3\",\"user\":\"1\",\"date\":\"20/05/2019\"}}",
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
    "filename": "api/Models/ShoppingList.php",
    "groupTitle": "ShoppingList"
  },
  {
    "type": "POST",
    "url": "/shoppinglist",
    "title": "newShoppingList",
    "version": "1.0.0",
    "name": "newShoppingList",
    "group": "ShoppingList",
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
            "type": "date",
            "optional": false,
            "field": "data",
            "description": "<p>da criação da lista</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user",
            "description": "<p>Id do usuário</p>"
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
            "field": "Retorna",
            "description": "<p>um objeto com os valores cadastrados</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"type\": true,\"shoppingList\": {\"date\":\"20/05/2019\",\"user\":\"1\"}}",
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
        "url": "http://api.lista-compras/api/shoppinglist"
      }
    ],
    "filename": "api/Models/ShoppingList.php",
    "groupTitle": "ShoppingList"
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
