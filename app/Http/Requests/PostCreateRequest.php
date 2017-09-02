<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// creted by php artisan make:request PostCreateRequest
class PostCreateRequest extends FormRequest
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
            //
            'title'         =>'required',
            'category_id'    =>'required',
            'photo_id'      =>'required',
            'body'          =>'required'
        ];
    }


    public  function messages() // those are to display custom messages
    {
        return [
            'category_id.required'=>'Please Select a category for the Post!',
            'title.required'=>'Please Enter a title for the Post!',
            'photo_id.required'=>'Please Select a Photo for the Post!',
            'body.required'=>'Please Enter a Body Description!',

        ];
    }
}
