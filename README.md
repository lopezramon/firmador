# back Firmador
Web de microsevicios API REST

## Requerimintos
- Instalacion de [docker](https://www.docker.com/products/docker-desktop)
- Instalacion de [Composer](https://getcomposer.org/doc/00-intro.md)

## Configurar el entorno de desarrollo
- Crear directorio repo
- Clonar el repositorio
- cd en el directorio clonado
- Ejecute los comandos de shell a continuación

```sh
mkdir repo
cd repo
git clone https://github.com/lopezramon/firmador.git
cd back
git fetch
git checkout develop
composer install
./vendor/bin/sail up 
cp .env.example .env
./vendor/bin/sail artisan migrate --seed 
```
## Url del servicio web por defecto
http://localhost

## Introduction
[Laravel](https://laravel.com/) es un marco de aplicación web con una sintaxis expresiva y elegante. Creemos que el desarrollo debe ser una experiencia placentera y creativa para ser realmente satisfactorio. Laravel elimina el dolor del desarrollo al facilitar las tareas comunes utilizadas en muchos proyectos web, como:

[Laravel Sail](https://laravel.com/docs/9.x/sail) es una interfaz de línea de comandos liviana para interactuar con el entorno de desarrollo Docker predeterminado de Laravel. Sail proporciona un excelente punto de partida para crear una aplicación Laravel con PHP, MySQL y Redis sin necesidad de experiencia previa en Docker.

## Configuraion alias
Configuring de Bash [Alias](https://laravel.com/docs/9.x/sail#configuring-a-bash-alias) recomendado por [Laravel Sail](https://laravel.com/docs/9.x/sail)

## Informacion de Docker-composer
- [Servidor Web](https://httpd.apache.org/).
- [Mysql](https://www.mysql.com/).
- [Redis](https://redis.io/).
- [Meilisearch](https://www.meilisearch.com/)
- [Mailhog](https://github.com/mailhog/MailHog#mailhog-----)

## Documentación de API REST FULL
Para la documentación de los endPoint creados para los microsevicios utilizaremos swagger una vez inicializado el projecto accedemos a la siguiente url [http://localhost/api/documentation](http://localhost/api/documentation#/)

Al acceder a la sección de Documentación de API se va a solicitar un token de autorización por lo que es requerido que utilice alguna aplicación de consulta de API como [Postman](https://www.postman.com/) o [Insonmia](https://insomnia.rest/download) para poder consultar la ruta login http://localhost/api/login con las credenciales necesarias para obtener el token válido a utilizar, el siguiente token se debe de incorporar en la sección de Autorize, al hacer click desplegará un modal en el cual se debe insertar el token de la siguiente manera:

Ejemplo:
```Bearer 1|e3Hj2QfIfi68y4D3NCOypq4cKD8gUd80FLgiPKhQ```