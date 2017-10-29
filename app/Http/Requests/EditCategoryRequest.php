<?php namespace App\Http\Requests;

class EditCategoryRequest extends Request
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
          'name' => 'required|between:2,255',
          'parent_id' => '',
          'slug' => 'required|between:2,255|alpha_dash'
        ];
    }

}
