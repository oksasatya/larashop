<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;

class Updatebook_category_tableRequest extends Storebook_category_tableRequest
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
        return array_merge(parent::rules(), [
            'slug' => ['required', Rule::unique("categories")->ignore(Category::select('slug')->first(), 'slug')],
        ]);
    }
}
