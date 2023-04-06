# Router

Roteador PHP simples baseado no código do [Pinatra](https://pinatra.github.io/routing.html) (versão PHP do roteador do [Sinatra](https://sinatrarb.com/))

## Instalação

```bash
composer require gaucho/router
```

## Utilização

```php
<?php
require 'vendor/autoload.php';
get('/',function(){
	print 'hello world';
});
get('{name}',function($name){
	code(200);
	print 'hello '.$name;
});
```

### Apache

Adicione o seguinte código ao .htaccess:

```apache
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
```
