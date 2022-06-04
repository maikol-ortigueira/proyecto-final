## Recetucha

Recetucha es el resultado de mi proyecto fin de ciclo.

Consiste en una aplicación que permite desplegar un sitio de recetas en la web. 

Dispone de una parte pública que muestras las recetas y un formulario de contacto, y de una parte privada que permite añadir nuevas recetas a usuarios con privilegios de acceso a dicha parte. Este usuario también puede revisar la lista de contactos recibidos.

## Instalación

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

2. Establecer la key de la aplicación

Debes entrar en la carpeta que se ha creado al clonar el repositorio y desde la línea de comandos generar la key.

```
proyecto-final$ php artisan key:generate
```

Este comando debería haber generado dicha key. Podrás comprobarlo entrando en el archivo .env, debería haber aplicado la key a la variable APP_KEY



## Como se usa

