<?php

namespace App\Http\Requests\profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class KoperasiUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'alamat' => ['string', 'max:255'],
            'hukum' => ['string', 'max:255'],
            'foto' => File::image()
                            ->max(10 * 1024)
                            ->types('jpg,bmp,png,jpeg'),
        ];
    }
}
