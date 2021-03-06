<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();

    }

    public function rules()
    {

        return [
            'email' => 'required|email|max:255|unique:users,email,' . $this->id,
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
            'password' => 'sometimes|min:6|confirmed',
            'first_name' => 'required',
            'last_name' => 'required',
            'display_name' => 'required',
            'slug' => 'required|unique:users,slug,' . Auth::user()->id,
            'date_of_birth' => 'sometimes|date',
            'website_url' => 'sometimes|url',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function getValidRequest()
    {
        return [
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'display_name' => $this->display_name,
            'slug' => str_slug($this->slug),
            'address' => $this->address,
            'postcode' => $this->postcode,
            'town' => $this->town,
            'country' => $this->country,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'job' => $this->job,
            'date_of_birth' => $this->date_of_birth,
            'facebook_name' => $this->facebook_name,
            'twitter_name' => $this->twitter_name,
            'linked_in_name' => $this->linked_in_name,
            'github_name' => $this->github_name,
            'website_url' => $this->website_url,
        ];
    }
}
