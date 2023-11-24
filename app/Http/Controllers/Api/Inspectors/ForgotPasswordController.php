<?php

namespace App\Http\Controllers\Api\Inspectors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgotPasswordRequest;
use App\Models\Inspector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ApiController;
use App\Helpers\ApiHelper;
use Illuminate\Http\Exceptions\HttpResponseException;

class ForgotPasswordController extends Controller
{
    protected function broker()
    {
        return Password::broker('inspectors');
    }

    public function forgot(ForgotPasswordRequest $request) {
        $credentials = $request->all();
        
        $profile = (new Inspector)->getByEmail($request->get('email'));

        if(!$profile){
            throw new HttpResponseException(
                response()->json(
                    [
                        'error' => [
                            'status' => 400,
                            'message' => 'This email does not exist'
                        ],
                    ],
                    400
                )
            );
        }

        $response = $this->broker()
            ->sendResetLink($credentials);
        $success = $response == Password::RESET_LINK_SENT;
        
        if (!$request->wantsJson()) {
            return $success
                ? $this->successRespond($request, 'Link Sent!!')
                : $this->sendResetLinkFailedResponse($request, $response);
        }

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => trans($response)
            ]);
        }

        throw new HttpResponseException(
            response()->json(
                [
                    'error' => [
                        'status' => 422,
                        'message' => trans($response)
                    ],
                ],
                422
            )
        );
        
    }
}
