<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Game;
use App\Models\Order;
use Auth;
use Cart;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeSidebarNavigation();
        $this->composeNewGamesPanel();
        $this->composeDiscountedGamesPanel();
        $this->composeCartPanel();
        $this->composeCartInstance();
        $this->composeAdminSidebar();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Send categories variable to side.navigation partial
     * @return void
     */
    private function composeSidebarNavigation()
    {
        view()->composer('store.side-navigation', function ($view) {
            $view->with('categories', Category::all()->toHierarchy());
        });
    }

    /**
     * Select 8 games with New label
     * @return Void
     */
    private function composeNewGamesPanel()
    {
        view()->composer('store.games.new-games', function ($view) {
            $view->with('games', Game::where('active', 1)
              ->where('new', 1)
              ->orderBy('created_at', 'DESC')
              ->take(8)->get());
        });
    }

    private function composeDiscountedGamesPanel()
    {
        view()->composer('store.games.discounted-games', function ($view) {
            $view->with('games', Game::where('active', 1)
              ->where('discounted_price', '!=', "NULL")
              ->orderBy('created_at', 'DESC')
              ->take(8)->get());
        });
    }

    /**
     * Sends user and cartCount variables to cart-panel view
     * @return Response
     */
    private function composeCartPanel()
    {
        view()->composer('store.shopping.cart-panel', function ($view) {
            $view->with([
              'user' => Auth::user(),
              'cartCount' => Cart::count(),
            ]);
        });
    }

    /**
     * Enable access to Cart main instance to several cart and order related views
     * @return
     */
    private function composeCartInstance()
    {
        view()->composer([
          'store.shopping.cart',
          'store.shopping.checkout',
          'store.shopping.confirm',
          'store.shopping.order-shipping'
        ], function ($view) {
            $view->with([
              'cart' => Cart::instance('main'),
            ]);
        });
    }

    private function composeAdminSidebar()
    {
        view()->composer('admincp.sidebar', function ($view) {
            $view->with([
              'pendingOrderCount' => Order::where('status_code_id', 1)->count(),
              'proccessingOrderCount' => Order::where('status_code_id', 2)->count(),
            ]);
        });
    }
}
