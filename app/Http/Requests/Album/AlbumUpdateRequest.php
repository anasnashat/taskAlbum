<?php

namespace App\Http\Requests\Album;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AlbumUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required_if:name,==,null', 'string', Rule::unique('albums')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            })->ignore($this->route('id')),]
        ];
    }

    public function messages():array
    {
        return [
            "name.unique" => "Name Already Taken Please Type Another Name",
        ];
    }
}
