<?php

namespace App\Http\Controllers\Api\Inspectors;

use App\Http\Requests\Api\StartLoginRequest;
use App\Models\Inspector;
use App\Models\narratives;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;


class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     * @param StartLoginRequest $request
     * @return JsonResponse
     */
    public function login(StartLoginRequest $request): JsonResponse
    {
        $credentials = request(['email', 'password']);
        if (isset($credentials['email'])) {
            $credentials['email'] = strtolower($credentials['email']);
        }
        if (!$token = auth('inspector')->attempt($credentials)) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'error' => [
                            'status' => 401,
                            'message' => 'Wrong email or password'
                        ],
                    ],
                    401
                )
            );
        }

        $profile = (new Inspector)->getByEmail($request->get('email'));
        
        if(!$profile->status){
            throw new HttpResponseException(
                response()->json(
                    [
                        'error' => [
                            'status' => 423,
                            'message' => 'Your account is blocked. Please, contact admin to unblock it'
                        ],
                    ],
                    423
                )
            );
        }
        //Check if assignments has been done or not else assign default narratives
        $this->checkDefaultNarrativesStatus($profile->id);
        return $this->respondWithToken($token);
    }
    public function checkDefaultNarrativesStatus($id) {
        if (narratives::where('inspector_id', '=', $id)->where('default', true)->count() > 0) {
            // default found
        } else {
            $defaultNarratives = DB::table('default_narratives')->get();

            foreach($defaultNarratives as $deaultNarrative) {
                DB::table('narratives')->insert(
                    [
                        'cat_id' => $deaultNarrative->cat_id, 
                        'sub_cat_id' => $deaultNarrative->sub_cat_id,
                        'narratives_title' => $deaultNarrative->narratives_title,
                        'narratives_text' => $deaultNarrative->narratives_text,
                        'status' => true,
                        'default' => true,
                        'inspector_id' => $id,
                    ]
                );
            }
        }

    }
    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('inspector')->logout();
        $arr = array();
        return $this->successRespond($arr, 'Successfully logged out');
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {

        return $this->respondWithToken(auth('inspector')->refresh());
        
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') . ' minutes'
        ]);
    }
}
