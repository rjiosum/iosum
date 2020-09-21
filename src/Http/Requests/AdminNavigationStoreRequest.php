<?php declare(strict_types=1);

namespace Iosum\AdminNav\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminNavigationStoreRequest extends FormRequest
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
            'title' => 'required|max:50',
            'route' => 'required',
        ];
    }
}
