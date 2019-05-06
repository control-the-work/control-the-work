<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [];
        switch ($this->getControllerMethod()) {
            case 'store' :
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6|confirmed',
                    'role' => 'required',
                    'timezone' => 'required',
                ];
                break;
            case 'update':
                $rules = [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,'. $this->route('user')->id,
                    'password' => 'nullable|min:6|confirmed',
                    'role' => 'required',
                    'timezone' => 'required',
                ];
                break;
        }
        return $rules;
    }

    public function getControllerMethod()
    {
        try{
            $fullMethod = ($this->route()->getAction())['controller'];
            return substr($fullMethod, strpos($fullMethod, '@') + 1);
        }
        catch (\Exception $e){
            return '';
        }
    }
}
