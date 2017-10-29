<?php namespace App\Http\Requests;

class GameRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|between:3,255',
          'category_id' => '',
          'description' => 'required|min:10',
          'image' => 'image|max:2048',
          'price' => 'required|numeric',
          'slug' => 'required|between:3,255|alpha_dash|unique:games,slug',
          'sku' => 'required|between:3,255|alpha_dash|unique:games,sku',
          'quantity' => 'required|integer',
          'weight' => 'required|numeric',
        ];
    }

}
