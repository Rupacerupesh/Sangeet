<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MusicsRequest extends FormRequest
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
            'tag'=> 'required',
            'Song_name' => 'required',
            'artist_id' => 'required',
            'count' => 'required',
            'album_id' => 'required',
            'language' => 'required',
            'song_file' => 'required'
        ];
    }
}
