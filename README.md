## <p align="center">Prueba Técnica - Programador (Back-end) (LARAVEL)</p>


Una vez intalado el proyecto inicie el servidor:

```php
  php artisan serve
```

Corra el siguiente comando para poblar la base de datos con datos de prueba:

```bash
  php artisan db:seed
```

Liste las rutas con:

```bash
  php artisan route:list
```

El proyecto no tiene interfaz gráfica. Puede probar los endpoint con Postman o cualquier cliente HTTP.

Todas las rutas están declaradas en route/api.php, hay dos controladores en app/Http/Controllers y los modelos en app/Models. Todo el código está en esos archivos.
