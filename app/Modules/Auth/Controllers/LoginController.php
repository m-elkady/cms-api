<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Requests\LoginRequest;

/**
 * Class LoginController
 *
 * @package App\Modules\Auth\Controllers
 * @author  Mohammed Elkady <mohammed.elkady@tajawal.com>
 */
class LoginController extends Controller
{
    /**
     * Log the user in
     *
     * @param LoginRequest $request Login request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $data = $request->all();
        return $request->load($data)->process();
    }
}
