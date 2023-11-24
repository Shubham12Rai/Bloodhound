<?php

namespace App\Http\Controllers\Api\Inspectors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\spare_images;
use App\Models\images;
use App\Models\client_general_info;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Helpers\Helper;
use Illuminate\Http\Exceptions\HttpResponseException;

class SpareImageController extends Controller
{
    public function spareImage(Request $request)
    {
        $insId = Auth::user();
        $arr = array();

            $validated = validator::make($request->all(), [
                'client_id' => 'required|integer|min:1',
                'image_path' => 'required',
                'image_path.*' => 'required|image',
            ]);
            if ($validated->fails())
            {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 422,
                                'message' => implode(" ", $validated->messages()->all())
                            ],
                        ],
                        422
                    )
                );
            }
            
            $check = client_general_info::find($request->client_id);
            if (!$check) {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 400,
                                'message' => 'Invalid Client Id!!'
                            ],
                        ],
                        400
                    )
                );
            }

                $images = array();
                $data = array();
                foreach ($request->file('image_path') as $image) {
                    $pathStorage='spareimage';
                    $spareimg = new spare_images;
                    // $path = $image->store('uploads/form');
                    $path = Helper::instance()->fileUpload($image, $pathStorage);
                    $spareimg->inspector_id = (int)$insId->id;
                    $spareimg->client_id = (int)$request->client_id;
                    $spareimg->image_path = $path ? $path : null;
                    $spareimg->save();

                    $images['id'] = $spareimg->id;
                    $images['inspector_id'] = $spareimg->inspector_id;
                    $images['client_id'] = $spareimg->client_id;
                    $images['image_path'] = $spareimg->image_path;

                    $data[]= $images;
                    
                }
                $arr = $data;

                return $this->successRespond($arr, 'Data Saved Successfully', config('constants.CODE.success'));

    }

    public function spareImgDelete(Request $request)
    {
        $insId = Auth::user();

        if ($insId)
        {
            $credentials = $request->only('spareImage_id');
            $validator = Validator::make($credentials, [
                'spareImage_id' => 'required|array',
                'spareImage_id.*' => 'required|integer|min:1',
            ]);

            if ($validator->fails())
            {
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

            $spareImageId = $request->spareImage_id;
            $arr = array();
            
            foreach ((array) $spareImageId as $id) {
                $id = (int) $id;
                $checkdata = spare_images::find($id);
                if (!empty($checkdata) && isset($checkdata->image_path)) {
                    // Storage::delete($checkdata->image_path);
                    $checkdata->delete();
                } else {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'Invalid Spare-Image ID'
                                ],
                            ],
                            400
                        )
                    );
                }
            }
            return $this->successRespond($arr, 'Spare Image Deleted Successfully', config('constants.CODE.success'));
        } else {
            throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 401,
                                'message' => 'Token Not Valid!!'
                            ],
                        ],
                        401
                    )
                );
        }
    }

    public function getspareImg(Request $request)
    {
        $insId = Auth::user();
        if ($insId){
            $credentials = $request->only('client_id');
            $validator = Validator::make($credentials, [
                'client_id' => 'required|integer|min:1'
            ]);

            if ($validator->fails())
            {
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

            $arr = array();

            $data = DB::table('spare_images')
            ->select('id', 'inspector_id', 'client_id', 'image_path')
            ->where('inspector_id', $insId->id)
            ->where('client_id', $request->client_id)
            ->get();

            $arr = $data;

                return $this->successRespond($arr, 'success');
            

        } else {
            throw new HttpResponseException(
                response()->json(
                    [
                        'error' => [
                            'status' => 401,
                            'message' => 'Token Not Valid!!'
                        ],
                    ],
                    401
                )
            );
        }
    }
}
