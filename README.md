# Centinela
Ejemplo de uso de Phalcon Framework con autenticación y lista de control de acceso (usuarios, permisos y perfiles).

##Requisitos

Necesitarás al menos:

* `PHP 5.5`
* `MySQL 5.1.5`
* Apache WEB Server con `mod_rewrite enabled` y `AllowOverride Options` (o `All`) en tu `httpd.conf`.
* La más reciente extensión de [Phalcon Framework](https://github.com/phalcon/cphalcon)
* `Git`

##Instalación

1. Clona el repositorio Git
    `git clone https://github.com/elcisnedesantajulia/centinela.git`

2. Crea la base de datos del proyecto e inicializa con el schema:
    `echo 'CREATE DATABASE centinela' | mysql -u root`
    `cat schemas/centinela.sql | mysql -u root centinela`

3. Configura la base de datos en `app/config/config.php`
    Reemplaza estas líneas por las correctas en tu proyecto:

            `'host'        => 'localhost',`
            `'username'    => 'phalcon',`
            `'password'    => 'config.dev',`
            `'dbname'      => 'centinela',`

    También puedes sobreescribir la configuración creando el archivo `app/config/config.dev.php`, el cual es ignorado por Git.

4. Configura el directorio raíz de tu proyecto en `app/config/config.php`

            `'baseUri'     => '/c/',`

    Para terminar, da permisos recursivos de escritura al directorio cache
    `chmod -R 777 cache`

## Screeshots
![home 1](/public/img/home1.png)

