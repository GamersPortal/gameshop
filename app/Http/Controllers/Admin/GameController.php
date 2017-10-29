<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\GameRequest;
use App\Http\Requests\EditGameRequest;
use App\Http\Controllers\Controller;
/**
 * Imported Game and Category model classes
 */
use App\Models\Game;
use App\Models\Category;
use File;
use Illuminate\Http\Request;

class GameController extends Controller
{

    const DEFAULT_IMG = "img/no_game_img.jpg";
    const PAGINATION_SIZE = 40;

    /**
     * Display a listing of the Game model instances.
     *
     * @return Response
     */
    public function index()
    {
        // Select all games with pagination, paginate 40 games per page
        $games = Game::paginate(self::PAGINATION_SIZE);
        return view('admincp.games.index')->with(compact('games'));
    }

    /**
     * Show the form for creating a new game.
     *
     * @return Response
     */
    public function create()
    {
        /**
         * Select all categories that have no child categories and return them in form of
         * associative array (id => slug) for purpose of selecting game category
         *
         * @var Category
         */
        $categories = Category::allLeaves()->lists('slug', 'id');
        $categories[null] = 'No category';
        return view('admincp.games.create')->with(compact('categories'));
    }

    /**
     * Store a newly created Game in database.
     *
     * @return Response
     */
    public function store(GameRequest $request)
    {
        /**
         * Take all inputs except image, store image in seperate variable
         *
         * @var Array
         */
        $input = $request->except('image');
        $image = $request->file('image');
        if ($image != null) {
            // Picture name will be same as SKU
            $name = $input['sku'];
            // Extenstion of original picture
            $extension = '.' . $image->getClientOriginalExtension();
            // Set paths for full image and thumbnail
            $imagePath = 'img/' . $name . $extension;
            $thumbnailPath = 'img/thumbs/' . $name . $extension;
            // Save original picture
            \Image::make($image->getRealPath())->save(public_path($imagePath));
            // Save resized thumbnail
            \Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($thumbnailPath));
        } else {
            // Set default 'No image avaliable' images
            $imagePath = self::DEFAULT_IMG;
            $thumbnailPath = self::DEFAULT_IMG;
        }
        // Create Game model and save pictures
        $game = Game::create($input);
        $game->image = $imagePath;
        $game->image_thumb = $thumbnailPath;
        $game->save();
        return redirect(route('AdminGameIndex'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show(Game $game)
    {
        return view('admincp.games.show')->with(compact('game'));
    }

    /**
     * Shows form for editing game
     *
     * @param  Game $game
     * @return Response
     */
    public function edit(Game $game)
    {
        /**
         * Select all categories that have no child categories and return them in form of
         * associative array (id => slug) for purpose of selecting game category
         *
         * @var Category
         */
        $categories = Category::allLeaves()->lists('slug', 'id');
        /*
        print_r($categories);
        exit;
        */
        $categories[null] = 'No category';
        return view('admincp.games.edit')->with(compact('game', 'categories'));
    }

    /**
     * Update the specified game
     *
     * @param  GameRequest $request
     * @param  Game $game
     * @return Response
     */
    public function update(EditGameRequest $request, Game $game)
    {
        $input = $request->except('image');
        $image = $request->file('image');
        if (!isset($input['active'])) {
            $input['active'] = false;
        }
        if (!isset($input['new'])) {
            $input['new'] = false;
        }
        if ($image != null) {
            // Picture name will be same as SKU
            $name = $input['sku'];
            // Extenstion of original picture
            $extension = '.' . $image->getClientOriginalExtension();
            // Set paths for full image and thumbnail
            $imagePath = 'img/' . $name . $extension;
            $thumbnailPath = 'img/thumbs/' . $name . $extension;
            // Save original picture
            \Image::make($image->getRealPath())->save(public_path($imagePath));
            // Save resized thumbnail
            \Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($thumbnailPath));
            // Create Game model and save pictures
            $game->fill($input);
            $game->image = $imagePath;
            $game->image_thumb = $thumbnailPath;
            $game->save();
            return redirect(route('AdminGameShow', $game->slug));
        }
        $game->fill($input);
        $game->save();
        return redirect(route('AdminGameShow', $game->slug));
    }

    /**
     * Show the form for deleting specific game
     *
     * @param  Game $game
     * @return Response
     */
    public function delete(Game $game)
    {
        return view('admincp.games.delete')->with(compact('game'));
    }

    /**
     * Deletes game
     *
     * @param  Game $game
     * @return Response
     */
    public function destroy(Game $game)
    {
        /**
         * If the image of the game is not default 'No image available'
         * image delete image from public directory
         */
        if (public_path($game->image) != public_path(self::DEFAULT_IMG)) {
            // Check if files exist
            if (File::exists(public_path($game->image)) && File::exists(public_path($game->image_thumb))) {
                File::delete(public_path($game->image));
                File::delete(public_path($game->image_thumb));
            }
        }
        // Delete game
        $game->delete();
        return redirect(route('AdminGameIndex'));
    }

    /**
     * Search games table
     *
     * @param  Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $games = Game::where('name', 'like', '%' . $query . '%')
          ->paginate(self::PAGINATION_SIZE);
        return view('admincp.games.index', compact('games'));
    }
}
