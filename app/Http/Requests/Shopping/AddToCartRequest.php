<?php
namespace App\Http\Requests\Shopping;

use App\Http\Requests\Request;

class AddToCartRequest extends Request
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
          'game_id' => 'required|exists:games,id'
        ];
    }
}
