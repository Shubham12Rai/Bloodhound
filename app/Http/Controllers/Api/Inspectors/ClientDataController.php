<?php

namespace App\Http\Controllers\Api\Inspectors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\client_general_info;
use App\Models\spare_images;
use App\Models\answers;
use App\Models\comments;
use App\Models\images;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Helpers\Helper;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientDataController extends Controller
{
    public function formData(Request $request)
    {

        $insId = Auth::user();
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'inspection_address' => 'required',
            'client_name' => 'required',
            'inspection_date' => 'date',
            'client_id' => 'integer|min:1',
            'banner_image' => 'image'
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
        
        if (empty($request->reportUUID)) {
            throw new HttpResponseException(
                response()->json(
                    [
                        'error' => [
                            'status' => 422,
                            'message' => "The reportUUID field is required."
                        ],
                    ],
                    422
                )
            );
        }
        $input['inspector_id'] = $insId->id;
        // $input['banner_image'] = $request->file('banner_image') ?
        //                          $request->file('banner_image')->store('uploads/form') : null;
        $path='spareimage';
        $file=$request->file('banner_image');
       
        $input['banner_image'] = Helper::instance()->fileUpload($file, $path);
        $arr = array();

        if ($insId) {
            if (empty($request->client_id)) {

                 $formcreate = client_general_info::create($input);
                  if (!empty($formcreate)) {
                    
                    $lastdata = DB::table('client_general_info')
                                ->where('id', '=', $formcreate->id)
                                ->first();
                    $arr = $lastdata;
                  } else { throw new HttpResponseException(
                            response()->json(
                                [
                                    'error' => [
                                        'status' => 400,
                                        'message' => 'Unable To Create Form!!'
                                    ],
                                ],
                                400
                            )
                        );
                }

            } else {

                $formexists = client_general_info::select('*')
                ->where('id', '=', $request->client_id)
                ->first();
                if (!$formexists){
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'Client id is invalid.'
                                ],
                            ],
                            400
                        )
                    );
                }

                    // if (!empty($formexists) && Storage::exists($formexists->banner_image)) {
                    //     Storage::delete($formexists->banner_image);
                    // }
                    $editData = $request->only(
                        'inspection_address',
                        'inspection_date',
                        'client_name',
                        'client_onsite',
                        'property_type',
                        'add_suites',
                        'add_structure',
                        'year_build',
                        'approx_yrs',
                        'utilities',
                        'reportUUID'
                    );
                    if (!empty($input['banner_image'])) {
                    $editData['banner_image'] = $input['banner_image'];
                    } else {
                        $editData['banner_image'] = $formexists->banner_image;
                    }
                    $formexists->update($editData);
                    $updateData = client_general_info::find($formexists->id);
                    
                    
                    $arr = $updateData;
                 }
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

    public function dataList()
    {
        $insId = Auth::user();

        $dataList = DB::table('client_general_info')
                ->where('inspector_id', '=', $insId->id)
                ->get();
                return $this->successRespond($dataList, 'success');
    }

    public function deleteClientData(Request $request)
    {
        $Cid = $request->client_id;
        $insId = Auth::user();
        $arr = array();
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|min:1',
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

            $cData = client_general_info::select('*')
                    ->where('id', '=', $Cid)
                    ->where('inspector_id', '=', $insId->id)
                    ->first();
              if(!empty($cData)){
                    $ansData = DB::table('answers')
                    ->where('client_id', '=', $Cid)
                    ->where('inspector_id', '=', $insId->id)
                    ->first();

                    $commData =  DB::table('comments')
                    ->where('client_id', '=', $Cid)
                    ->where('inspector_id', '=', $insId->id)
                    ->first();

                    $imgData =  DB::table('images')
                    ->where('client_id', '=', $Cid)
                    ->first();

                    $spareImgData =  DB::table('spare_images')
                    ->where('client_id', '=', $Cid)
                    ->first();

                    if ($ansData) {
                        answers::where('client_id', $Cid)->delete();
                    }
                    if ($commData) {
                        comments::where('client_id', $Cid)->delete();
                    }
                    if ($imgData) {
                        if (isset($imgData->image_path) && Storage::exists($imgData->image_path)) {
                            Storage::delete($imgData->image_path);
                        }
                        images::where('client_id', $Cid)->delete();
                    }

                    if ($spareImgData) {
                        $imagePaths = (array) $spareImgData->image_path;
                        foreach ($imagePaths as $imagePath) {
                            if (!empty($imagePath) && Storage::exists($imagePath)) {
                                Storage::delete($imagePath);
                            }
                        }
                        spare_images::where('client_id', $Cid)->delete();
                    }

                     DB::table('client_general_info')
                    ->where('id', '=', $Cid)
                    ->where('inspector_id', '=', $insId->id)
                    ->delete();
                return $this->successRespond($arr, 'Client Data Deleted Successfully');
              } else {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 400,
                                'message' => 'Client Id is not valid!!'
                            ],
                        ],
                        400
                    )
                );
              }

    }
    
}
