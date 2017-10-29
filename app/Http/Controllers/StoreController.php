<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    const PAGINATION_SIZE = 40;

    public function index()
    {
        return view('store.index');
    }

    /**
     * Show all games on category page
     *
     * @param  Category $category
     * @return Response
     */
    public function showCategory(Category $category)
    {
        $games = $category->games()->where('active', 1)->orderBy('created_at', 'DESC')->get();
        return view('store.categories.show')->with(compact('games', 'category'));
    }

    /**
     * Show game with description and add to cart button
     *
     * @param  Game $game
     * @return Response
     */
    public function showGame(Game $game)
    {
        return view('store.games.show')->with(compact('game'));
    }

    public function searchGame(Request $request)
    {
        $query = $request->get('q');
        $games = Game::where('active', 1)->where('name', 'like', '%' . $query . '%')
          ->paginate(self::PAGINATION_SIZE);
        return view('store.games.search', compact('games'));
    }

    public function contact()
    {
        return view('store.contact');
    }
}
