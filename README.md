# Centinela
Ejemplo de uso de Phalcon Framework con autenticación y lista de control de acceso (usuarios, permisos y perfiles).

## Requisitos

Necesitarás al menos:

* `PHP 5.5`
* `MySQL 5.1.5`
* Apache WEB Server con `mod_rewrite enabled` y `AllowOverride Options` (o `All`) en tu `httpd.conf`.
* La más reciente extensión de [Phalcon Framework](https://github.com/phalcon/cphalcon)

## Instalación

1. Clona el repositorio.

```bash
git clone https://github.com/elcisnedesantajulia/centinela.git
```

2. Crea la base de datos del proyecto e inicializa con el schema:

```bash
echo 'CREATE DATABASE centinela' | mysql -u root
cat schemas/centinela.sql | mysql -u root centinela
```

3. Configura la base de datos en `app/config/config.php`.

    Reemplaza estas líneas por las correctas en tu proyecto:

```php
            'host'        => 'localhost',
            'username'    => 'phalcon',
            'password'    => 'config.dev',
            'dbname'      => 'centinela',
```
También puedes sobreescribir la configuración creando el archivo `app/config/config.dev.php`, el cual es ignorado por Git.

4. Configura el directorio raíz de tu proyecto en `app/config/config.php`.

```php
            'baseUri'     => '/c/',
```
5. Da permisos recursivos de escritura al directorio cache.

```bash
chmod -R 777 cache
```

6. Asegúrate de que la carpeta `public/` sea visible desde Apache.

7. Para terminar, crea una cuenta.

Crea un cuenta en tu sitio recién instalado y dale permisos de Super Usuario (`perfilId` = 1 en tabla `usuarios`).

## Demo

Prueba este Demo creando una cuenta [aquí](https://centinela.softle.com/).

Centinela es un proyecto de open source. No dudes en enviar tus comentarios, reportar bugs o sugerir alguna mejora o nueva funcionalidad a contacto@softle.com, así como enviar un Pull Request. 

## Screenshots

![home 1](/public/img/home1.png)

---

![home 2](/public/img/home2.png)

---

![home 3](/public/img/home3.png)

---

![home 4](/public/img/home4.png)

