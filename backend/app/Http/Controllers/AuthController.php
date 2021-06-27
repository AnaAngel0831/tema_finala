<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{

  public function login(Request $request) {
      $validator = Validator::make($request->all(), [

          'email' => 'required|email|max:16',
          'password' => 'required|string|min:6|max:16',
      ]);

      if($validator->fails()) {
          return response()->json([
            'messages' => $validator->messages()
              'status' => 'error',

          ], 200);


      }


      if (! $token = Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password])) {


          return response()->json(['error' => ' Unauthorized '], 401);
      }

      return $this->respondWithToken($token);
  }
    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,

            'token_type' => 'bearer',

            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout() {

        Auth::guard('api')->logout();
        return response()->json([

            'status' => 'success',
            
            'message' => 'logout'
        ], 200);
    }
}
