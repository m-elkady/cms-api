<?php

namespace App\Modules\Auth\Requests;

use Dingo\Api\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;


class LoginRequest extends FormRequest
{
    /**
     * DESC
     *
     * @return array
     *
     * @author Mohammed Elkady <mohammed.elkady@tajawal.com>
     *
     */
    public function attributes()
    {
        return [
            'username',
            'password',
        ];
    }

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'The username field is required.',
            'password.required' => 'The password field is required.',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function process()
    {
        $token = Auth::guard()->attempt($this->getAttributes());

        if (!$token) {
            throw new HttpException(401, 'Username or password is incorrect');
        }


        return response()
            ->json([
                'status'     => 'ok',
                'token'      => $token,
                'expires_in' => Auth::guard()->factory()->getTTL() * 60,
            ]);
    }
}
