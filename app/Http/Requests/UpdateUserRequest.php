<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(request()->user()->type === config('constants.personnel.types.ADMINISTRATOR')) {
            return true;
        }

        if($this->user === request()->user()->id
            && request()->user()->type === config('constants.personnel.types.JUDGE')) {
                return true;
            }
        
        if($this->user === request()->user()->id
            && request()->user()->type === config('constants.personnel.types.JOURNALIST')) {
                return true;
            }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['filled', 'string', 'max:255'],
            'surname' => ['filled', 'string', 'max:255'],
            'email' => ['filled', 'string', 'email', 'max:255', 'unique:'.User::class],
            'type' => ['filled', 'in:' . implode(',', array_values(config('constants.personnel.types')))],
            'password' => ['filled', 'confirmed', Rules\Password::defaults()],

            // Particular Fields
            'start_date' => ['required_if:type,'.config('constants.personnel.types.ADMINISTRATOR')],
            'company_name' => ['required_if:type,'. config('constants.personnel.types.JOURNALIST')],
            'judge_id' => ['required_if:type,'. config('constants.personnel.types.JUDGE')],
            'birth_date' => ['required_if:type,'. config('constants.personnel.types.PARTICIPANT')],
            'result' => ['required_if:type,'. config('constants.personnel.types.PARTICIPANT')]
        ];
    }
}
