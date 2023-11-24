<?php

namespace App\Http\Controllers\Api\Inspectors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\narratives;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;


class NarrativeController extends Controller
{
    public function saveNarratives(Request $request)
    {
        $insId = Auth::user();
        $data = array();
        $validatedData = $request->all();

        if ($insId) {
            $validator = Validator::make($validatedData,[
                '*.cat_id' => 'required|integer|min:1',
                '*.sub_cat_id' => 'required|integer|min:1',
                '*.narratives_title' => 'required',
                '*.narratives_text' => 'required',
                '*.narrative_id' => 'nullable|integer|min:1'
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
                
            foreach ($validatedData as $val) {
                $narrative = new Narratives;

                $check1 = DB::table('form_categories')
                ->where('id', $val['cat_id'])->first();
                
                $check2 = DB::table('form_sub_categories')
                ->where('id', $val['sub_cat_id'])->first();

                if (empty($check1) || empty($check2)) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'Category/Subcategory id is not valid.'
                                ],
                            ],
                            400
                        )
                    );
                }

                if (empty($val['narrative_id'])) {
                    $narrative->cat_id = $val['cat_id'];
                    $narrative->sub_cat_id = $val['sub_cat_id'];
                    $narrative->inspector_id = $insId->id;
                    $narrative->narratives_title = $val['narratives_title'];
                    $narrative->narratives_text = $val['narratives_text'];
                    $narrative->save();
                    
                    $narrateIn = narratives::select('cat_id', 'sub_cat_id', 'narratives_title', 'narratives_text', 'id')
                        ->where('id', '=', $narrative->id)
                        ->first();
                    $data[] = $narrateIn;

                } else {
                    
                    $checkId = $narrative->where('id', $val['narrative_id'])->first();
                    if (!$checkId){
                        throw new HttpResponseException(
                            response()->json(
                                [
                                    'error' => [
                                        'status' => 400,
                                        'message' => 'Narrative id is invalid.'
                                    ],
                                ],
                                400
                            )
                        );
                    }
                
                $dataExist = narratives::where('id', $val['narrative_id'])
                    ->where('cat_id', $val['cat_id'])
                    ->where('sub_cat_id', $val['sub_cat_id'])->first();

                if (!$dataExist) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'Failed To Update Data'
                                ],
                            ],
                            400
                        )
                    );
                }

                    $dataExist->narratives_title = $val['narratives_title'];
                    $dataExist->narratives_text = $val['narratives_text'];
                    $dataExist->update();

                    $updateData = narratives::select('cat_id', 'sub_cat_id', 'narratives_title', 'narratives_text', 'id')
                            ->where('id', '=', $dataExist->id)
                            ->first();
                    $data[] = $updateData;
                }
            }
        
            return $this->successRespond($data, 'success');

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

    /**
     * @param $request
     * @return mixed
     */
    public function getNarratives(Request $request)
    {
        $insId = Auth::user();
        if ($insId) {
            
            $validator = Validator::make($request->all(), [
                'cat_id' => 'required|integer|min:1',
                'sub_cat_id' => 'required|integer|min:1',
            ]);

            if ($validator->fails()){
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

            try {
                
                    $check1 = DB::table('form_categories')
                    ->where('id', $request->cat_id)->first();
                    
                    $check2 = DB::table('form_sub_categories')
                    ->where('id', $request->sub_cat_id)->first();

                    if (empty($check1) || empty($check2)) {
                            return response()->json(
                                [
                                    'error' => [
                                        'status' => 400,
                                        'message' => 'Enter a valid Category/Subcategory id.'
                                    ],
                                ],
                                400
                            );
                    }

                    $query = DB::table('narratives');
                    if (!empty($request->cat_id)) {
                        $query->where('cat_id', '=', $request->cat_id);
                    }
                    if (!empty($request->sub_cat_id)) {
                        $query->where('sub_cat_id', '=', $request->sub_cat_id);
                    }
                    if (!empty($insId)) {
                        $query->where('inspector_id', '=', $insId->id);
                    }
                    $narratives = $query->get();
                    return $this->successRespond($narratives, 'success');
            } catch (Throwable $t) {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 422,
                                'message' => $t->getMessage()
                            ],
                        ],
                        422
                    )
                );
            }
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

    public function deleteNarratives(Request $request)
    {
        $insId = Auth::user();
        if ($insId)
        {
                $narrativeId = $request->narrative_id;
                $arr = array();

                $validator = Validator::make($request->all(), [
                    'narrative_id' => 'required|array',
                    'narrative_id.*' => 'required|integer|min:1',
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

                    foreach ((array) $narrativeId as $id) {
                        $updateData = DB::table('narratives')
                            ->where('inspector_id', $insId->id)
                            ->find($id);
                        if(empty($updateData)){
                            throw new HttpResponseException(
                                response()->json(
                                    [
                                        'error' => [
                                            'status' => 400,
                                            'message' => 'Invalid Narrative Id!!'
                                        ],
                                    ],
                                    400
                                )
                            );
                        }
                            narratives::where('id', $id)->delete();
                    }
                    return $this->successRespond($arr, 'Narrative Deleted Successfully');

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
