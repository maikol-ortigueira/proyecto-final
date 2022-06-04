## Recetucha
***
Recetucha es el resultado de mi proyecto fin de ciclo.

Consiste en una aplicación que permite desplegar un sitio de recetas en la web.

Dispone de una parte pública que muestras las recetas y un formulario de contacto, y de una parte privada que permite añadir nuevas recetas a usuarios con privilegios de acceso a dicha parte. Este usuario también puede revisar la lista de contactos recibidos.

## Instalación
***
### Requisitos técnicos

-   PHP >= 8.0
-   MCrypt PHP Extensión
-   [Composer](https://getcomposer.org/)
-   [Nodejs](https://nodejs.org/es/)
-   [npmjs](https://www.npmjs.com/)
-   Si el servidor utilizado es Apache deberá tener **mod_rewrite** habilitado

### Pasos a seguir

1. Clonar este repositorio en el servidor de destino

```
git clone https://github.com/maikol-ortigueira/proyecto-final.git
```

2. Crear el archivo **.env**

Debes crear el archivo de variables de entorno **.env** a partir de **.env.example**.

Debes al menos configurar las siguiente variables:

-   **DB_CONNECTION**   Tipo de driver de la base de datos
-   **DB_HOST**         Host en donde se ubica el gestor de bases de datos
-   **DB_PORT**         El puerto de conexión a la base de datos
-   **DB_DATABASE**     El nombre de la base de datos
-   **DB_USERNAME**     El nombre de un usuario con privilegios sobre la base de datos
-   **DB_PASSWORD**     La contraseña del usuario anterior para acceder a la base de datos

3. Instalar los paquetes de **composer**

```shell
proyecto-final$ composer install
```

4. Establecer la key de la aplicación

Debes entrar en la carpeta que se ha creado al clonar el repositorio y desde la línea de comandos generar la key.

```shell
proyecto-final$ php artisan key:generate
```

Este comando debería haber generado dicha key. Podrás comprobarlo entrando en el archivo .env, debería haber aplicado la key a la variable APP_KEY

5. Instalar los paquetes de node

```shell
proyecto-final$ npm install
```

6. Crear las tablas en la base de datos

Debemos volver a utilizar artisan

```shell
proyecto-final$ php artisan migrate
```

7. Crear los registros de roles de usuario

```shell
proyecto-final$ php artisan db:seed --class RolSeeder
```

8. Crear un usuario superadministrador para poder entrar a la parte privada

```shell
proyecto-final$ php artisan db:seed --class UsuarioSeeder
```

Este comando creará un usuario con correo electrónico ``admin@ejemplo.com`` cuya contraseña es ``password``.

Podrás cambiar posteriormente su contraseña para hacer una mas segura.


9. Crear los primeros registros de categorías

```shell
proyecto-final$ php artisan db:seed --class CategoriaSeeder
```

10. Crear los registros de tipos de unidad de medida

```shell
proyecto-final$ php artisan db:seed --class UnidadSeeder
```

11. Permitir que las imágenes sean accesibles

```shell
proyecto-final$ php artisan storage:link
```


## Como se usa
***

### Parte privada

Para acceder a la parte privada de la aplicación es necesario disponer de una cuenta que tenga permisos para dicho acceso.
Actualmente los roles generados y con permiso para el acceso a la parte privada son:

-   superadmin
-   editor

#### Editor

El usuario con rol editor puede crear contenidos, es decir, recetas para ser publicadas en la web.

Solo podrá editar sus propias recetas.

Puede ver el listado de usuarios registrados, pero no puede editar los datos de estos.

Puede crear y editar: Ingredientes, categorías, y etiquetas.

#### Superadmin

El usuario con rol superadmin tiene todos los privilegios del editor, pero a mayores puede:

-   Editar y modificar el contenido de cualquiera de las recetas
-   Editar, modificar y crear usuarios (es el único que puede asignar roles a estos)
-   Editar, modificar y crear roles

Para acceder al panel de control de la parte privada debemos pulsar sobre el icono de usuario en el menú superior de cualquiera de las páginas y seleccionar la opción **Iniciar sesión**

Nos lleva a la página de inicio de sesión en la que debemos añadir nuestro correo electrónico y nuestra contraseña.

Si el usuario y contraseña son correctos y disponemos de una cuenta de administrador nos habrá redirigido al panel de control.

#### **Creación de recetas**

Antes de crear una receta debemos asegurarnos que disponemos de las etiquetas, categorías e ingredientes necesarios.

##### Crear una etiqueta

Dentro de la página *etiquetas* debemos pulsar *Nueva etiqueta*, y simplemente añadimos la nueva etiqueta.

##### Crear una categoría

Dentro de la página *categorías* debemos pulsar *Nueva categoría*.

El formulario nos pide el nombre de la categoría, una categoría padre (suponiendo que la categoría a crear será una sub-categoría), y finalmente el tipo de categoría.

Los tipos permitidos son:
-   Unidad

Para crear una receta debemos acceder a recetas