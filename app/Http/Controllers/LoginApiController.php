<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{

    /**
     * Checks provided email/password against admin table and returns true if
     * a match is found, else false.
     *
     * @param Request $request
     * @return boolean
     */
    public function login(Request $request)
    {
        $data = $request->all();

        $admin = Admin::where('email', '=', $data['email'])->first();

//        dd($admin, bcrypt($data['password']));

        if ($admin !== null) {
            // Now check password
            if (password_verify($data['password'], $admin->password)) {
                return json_encode(['result' => 'success']);
            }
        }

        return json_encode(['result' => 'fail']);
    }
}
