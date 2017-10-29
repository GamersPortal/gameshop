<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $table = 'games';

    protected $fillable = [
      'name',
      'category_id',
      'sku',
      'quantity',
      'image',
      'image_thumb',
      'slug',
      'weight',
      'price',
      'description',
      'discounted_price',
      'active',
      'new'
    ];

    protected $casts = [
      'new' => 'boolean',
    ];

    /**
     * Returns category of game
     *
     * @return App\Models\Category
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get discounted price if there'is discount
     *
     * @return Decimal
     */
    public function getRealPriceAttribute()
    {
        if ($this->discounted_price != null) {
            return $this->discounted_price;
        }
        return $this->price;
    }

    /**
     * Model events
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        /**
         * Triggered when Game model is saved
         */
        static::saving(function ($model) {
            /**
             * If discounted price is empty string, set it to null
             */
            if (empty(trim($model->discounted_price))) {
                $model->discounted_price = null;
            }
        });
    }

    public function games()
    {
        return $this->belongsToMany('App\Models\Order', 'order_game');
    }
}
