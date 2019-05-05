# lista-compras
Api para trabalho de engenharia de software

<h3>Ambiente de trabalho:</h3>
<ul> VsCode(IDE) - https://code.visualstudio.com/</ul>
<ul> xampp - https://www.apachefriends.org/index.html</ul>
<ul> framework - Slim http://www.slimframework.com/2015/03/01/version-260.html (versão desatualizada)</ul>
<ul> npm - https://www.npmjs.com/get-npm</ul>
<ul> APIDoc - http://apidocjs.com/</ul>


<h3>Como configurar no windows 10 :</h3>

Instale o xampp, após faça os passos a seguir: 
abra o CMD e navegue até C:\xampp\htdocs\ em seguida execute o comando abaixa:

``` git clone git@github.com:geranielmotta/lista-compras.git ```

caso não tenha o git instalado baixe neste endereço:

https://git-scm.com/downloads

em  C:\xampp\htdocs\lista-compras\documentation\database  abra e copie as informações do arquivo SQL lista.sql

em seu navegador padrão digite:

``` http://localhost/phpmyadmin/ ```

Click em SQL e cole as informações do arquivo lista.sql e de um executar.

<h3>Siga os passos abaixo para criar um host virtual:</h3>

1 - Mude para o diretório de instalação do XAMPP (normalmente, C:\xampp ) e abra o arquivo httpd-vhosts.conf no subdiretório apache\conf\extra\.

``` start httpd-vhosts.conf ```

2 - Substitua o conteúdo deste arquivo pelas seguintes diretivas:

```
<VirtualHost *:80>
   ServerAdmin geranielmotta@gmail.com
    DocumentRoot "C:/xampp/htdocs/lista-compras/api"
    ServerName api.lista-compras.com
    ServerAlias www.api.lista-compras.com
    ErrorLog "logs/api.lista-compras.log"
    CustomLog "logs/api.lista-compras.log" common
</VirtualHost>
 ```
 
 3 - Reinicie o Apache usando o painel de controle do XAMPP para que suas alterações entrem em vigor.
 4 - E necessário mapear o domínio personalizado para o endereço IP local. Para fazer isso, abra o arquivo C:\windows\system32\drivers\etc\ hosts e adicione a seguinte linha a ele:
```
  127.0.0.1 api.lista-compras.com
```

Para fazer uso da API você dever possuir o token de acesso, ele e facilmente encontrado na base de dados. Utilizando o Postman( Chrome) ou RESTClient( Firefox).
Em caso de dúvidas mande email para geranielmotta@gmail.com.



