<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        return Auth::attempt($credentials)
            ? $this->sendResponse(true, 'Успешно авторизован')
            : $this->sendError('Неверное имя пользователя или пароль', null, 401);
    }

    public function signout(Request $request)
    {
        try {
            Session::flush();

            return $this->sendResponse(true, 'Выход из системы успешно');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function signup(RegisterRequest $request)
    {
        $fields = $request->validated();
        try {
            $user = User::create([
                'name'     => $fields['name'],
                'email'    => $fields['email'],
                'password' => Hash::make($fields['password']),
            ]);
            
            if (!
                Auth::attempt([
                    'email'    => $fields['email'],
                    'password' => $fields['password'],
                ])
            ) {
                return $this->sendError('Ошибка входа', [
                    'message' => 'ошибка аутентификаций',
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $error = 'Ошибка при создании учетной записи';

            switch ($e->getCode()) {
                case 23505:
                    $error = "Email \"$fields[email]\" существует!";
                    break;
            }
            
            return $this->sendError($error, [
                'code' => $e->getCode(),
            ]);
        }

        return $this->sendResponse(true, 'Учетная запись успешно создано!');
    }
}
