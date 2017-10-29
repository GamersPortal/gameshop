<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\Category;
use App\Models\Game;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
        // Add Category model for route model binding, use slug as id
        $router->bind('category', function ($value) {
            $category = Category::where('slug', $value)->first();
            if ($category == null) {
                abort(404);
            }
            return $category;
        });
        // Add Game model for route model binding, use slug as id
        $router->bind('game', function ($value) {
            $game = Game::where('slug', $value)->first();
            if ($game == null) {
                abort(404);
            }
            return $game;
        });
        // Add Order model for route model binding
        $router->model('order', 'App\Models\Order');
        // Add User model for route model binding
        $router->model('user', 'App\User');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }

}
