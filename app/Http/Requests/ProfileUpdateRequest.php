<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'alamat' => ['string', 'max:255'],
            'foto' => File::image()
                            ->max(10 * 1024)
                            ->types('jpg,bmp,png,jpeg'),
            // 'foto' => ['image|file|max:10240'],
        ];
    }
}
