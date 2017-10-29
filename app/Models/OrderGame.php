<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGame extends Model
{
    protected $table = 'order_game';

    protected $fillable = ['order_id', 'game_id', 'quantity', 'price'];

    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }
}
