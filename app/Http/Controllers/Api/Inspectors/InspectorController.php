<?php

namespace App\Http\Controllers\Api\Inspectors;


use App\Http\Resources\InspectorResources;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Print_;
use App\Models\client_general_info;
use App\Models\answers;
use App\Models\comments;
use App\Models\Report;
use App\Models\spare_images;
use App\Models\images;
use App\Models\narratives;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Foreach_;
use Throwable;
use App\Helpers\Helper;
use Illuminate\Http\Exceptions\HttpResponseException;

class InspectorController extends Controller
{

    public function getProfile(): JsonResponse
    {
        $inspector = auth('inspector')->user();
        
        return response()->json(new InspectorResources($inspector));
    }

    public function editProfile(Request $request): JsonResponse
    {
        $editData = $request->only(
            'phone',
            'status',
            'region',
            'avatar',
            'company',
            'membership',
            'address');

            $validator = Validator::make($editData, [
                'phone' => 'numeric|digits:10',
                'status' => 'boolean',
                'avatar' => 'image',
            ]);
            if ($validator->fails()) {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 422,
                                'message' => implode(" ", $validator->messages()->all())
                            ],
                        ],
                        422
                    )
                );
            }

        $profile = Auth::user();

        // $avatarPath = $request->file('avatar') ? $request->file('avatar')->store('uploads') : null;
        // if ($profile->avatar) {
        //     Storage::delete($profile->avatar);
        // }

        $path='profileimage';
        $file=$request->file('avatar');
       
        $avatarPath = Helper::instance()->fileUpload($file, $path);

        if ($profile->avatar) {
        // Delete the image from the S3 bucket
        Storage::disk('s3')->delete($profile->avatar);
        }

        $inspector = ProfileService::editInspectorProfile($editData, $profile, $avatarPath);

        return response()->json(new InspectorResources($inspector));
    }

}

