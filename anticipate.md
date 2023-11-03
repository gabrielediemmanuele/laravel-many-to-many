# Esercizio Laravel API

-   Dentro api.php vicino a web.php

```php
Route::apiResource("projects", ProjectController::class)->only(["index", "show"]);
```

```php
use App\Http\Controllers\Api\ProjectController;
```

-   poi creare il controller per l'API

`php artisan make:controller Api\ProjectController --api`

-   dentro il controller

```php
use App\Model\Project;
```

```php
public function index() {
    /* $project = Project::all();
    Ma cosi facendo ti porti tutto quanto.
    */
    $project = Project::select("id", "altro")->paginate(2);
    return response()->json($projects);
}
```
