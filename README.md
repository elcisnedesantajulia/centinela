# Centinela
Ejemplo de uso de Phalcon Framework (autenticación y lista de control de acceso).

## Requisitos

Para correr esta aplicación necesitarás al menos:

* `>=` PHP 5.5
* `>=` Phalcon 3.0
* `>=` MySQL 5.1.5
* Apache Web Server con `mod_rewrite enabled` y `AllowOverride Options` (o `All`) en tu `httpd.conf`.
* La más reciente extensión de [Phalcon Framework](https://github.com/phalcon/cphalcon).

**NOTA**: Después de la instalación, asegúrate de que los siguientes folders tengan permisos de escritura:
- `cache`
- `cache/acl`
- `cache/volt`
