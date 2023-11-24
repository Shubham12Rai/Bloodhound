<?php

namespace App\Http\Controllers\Api\Inspectors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\client_general_info;
use App\Models\answers;
use App\Models\questions;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormDataController extends Controller
{
    public function catData(Request $request)
    {
        $catData = new answers;
        $insId = Auth::user();

        if ($insId) {

            $credentials = $request->only('cat_id', 'sub_cat_id', 'question_id', 'client_id');
            $validator = Validator::make($credentials, [
                'cat_id' => 'required|integer|min:1',
                'sub_cat_id' => 'required|integer|min:1',
                'question_id' => 'required|integer|min:1',
                'client_id' => 'required|integer|min:1'
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

            $check1 = DB::table('form_categories')
            ->where('id', $request->cat_id)->first();
            
            $check2 = DB::table('form_sub_categories')
            ->where('id', $request->sub_cat_id)->first();

            if (empty($check1) || empty($check2)) {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 400,
                                'message' => 'Subcategory/Category id is invalid.'
                            ],
                        ],
                        400
                    )
                );
            }

            $check3 = DB::table('questions')
            ->where('id', $request->question_id)->first();
            if (empty($check3)) {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 400,
                                'message' => 'Question id is invalid.'
                            ],
                        ],
                        400
                    )
                );
            }

            $answers = DB::table('answers')
                ->where('client_id', '=', $request->client_id)
                ->where('cat_id', '=', $request->cat_id)
                ->where('sub_cat_id', '=', $request->sub_cat_id)
                ->where('question_id', '=', $request->question_id)
                ->get();

            $check = client_general_info::where('id', $request->client_id)->first();
            if ($check)
            {
              if (empty($answers[0])) {
                    $catData->inspector_id = $insId->id;
                    $catData->client_id = $request->client_id;
                    $catData->question_id = $request->question_id;
                    $catData->sub_cat_id = $request->sub_cat_id;
                    $catData->cat_id = $request->cat_id;
                    $catData->answer = $request->answer;
                    $catData->save();
                    return $this->successRespond($catData, 'success');
                } else {
                           DB::table('answers')
                            ->where('client_id', '=', $request->client_id)
                            ->where('cat_id', '=', $request->cat_id)
                            ->where('sub_cat_id', '=', $request->sub_cat_id)
                            ->where('question_id', '=', $request->question_id)
                            ->update(array('answer' => $request->answer));
                            $answers = DB::table('answers')
                                    ->where('id', '=', $answers[0]->id)
                                    ->get();
                            return $this->successRespond($answers, 'success');
                }
            } else {
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

    public function catAllData(Request $request)
    {

        $insId = Auth::user();
        $data = array();
        $validatedData = $request->all();
        if ($insId)
        {
            $validator = Validator::make($validatedData,[
                '*.client_id' => 'required|integer|min:1',
                '*.cat_id' => 'required|integer|min:1',
                '*.sub_cat_id' => 'required|integer|min:1',
                '*.question_id' => 'required|integer|min:1',
                '*.answer' => 'nullable',
                '*.row_type' => 'nullable'
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

            foreach ($validatedData as $key => $val) {

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
                                    'message' => 'The '.$key.'.Category/SubCategory field is invalid.'
                                ],
                            ],
                            400
                        )
                    );
                }

                $check3 = DB::table('questions')->where('id', $val['question_id'])->first();
                if (empty($check3)) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'The '.$key.'.Question id field is invalid.'
                                ],
                            ],
                            400
                        )
                    );
                }

                if (array_key_exists('answer', $val)) {
                    $answer = $val['answer'];
                }

                $answers = DB::table('answers')
                ->where('inspector_id', '=', $insId->id)
                ->where('client_id', '=', $val['client_id'])
                ->where('cat_id', '=', $val['cat_id'])
                ->where('sub_cat_id', '=', $val['sub_cat_id'])
                ->where('question_id', '=', $val['question_id'])
                ->get();


                $checkClient = DB::table('client_general_info')
                ->where('id', $val['client_id'])->first();

                if ($checkClient)
                {
                    if (empty($answers[0]))
                    {

                        if (!empty($answer)) {
                            $catData = new answers;
                            $catData->inspector_id = $insId->id;
                            $catData->client_id = $val['client_id'];
                            $catData->sub_cat_id = $val['sub_cat_id'];
                            $catData->cat_id = $val['cat_id'];
                            $catData->question_id = $val['question_id'];
                            $catData->answer = $answer;
                            $catData->row_type = isset($val['row_type']) ? $val['row_type'] : "Plain";
                            $catData->save();

                            $savedData = answers::select('id', 'client_id', 'cat_id', 'sub_cat_id', 'inspector_id', 'question_id', 'answer', 'row_type')
                            ->where('id', '=', $catData->id)
                            ->first();
                            $data[] = $savedData;
                        }
                                            
                    }
                    else
                    {

                        $updateData = answers::
                            where('inspector_id', '=', $insId->id)
                            ->where('client_id', '=', $val['client_id'])
                            ->where('cat_id', '=', $val['cat_id'])
                            ->where('sub_cat_id', '=', $val['sub_cat_id'])
                            ->where('question_id', '=', $val['question_id'])->first();

                        foreach ($answers as $ans) {

                            if ($updateData) {
                                
                                if (empty($answer)) {
                                    $ansData = "";
                                } else {
                                    $ansData = $answer ? $answer : $ans->answer;
                                }
                                $updateData->answer = $ansData;
                                $updateData->row_type = isset($val['row_type']) ? $val['row_type'] : $ans->row_type;

                                $updateData->update();
                            }
                                                                            
                        }
                        $updatedData = answers::select('id', 'client_id', 'cat_id', 'sub_cat_id', 'inspector_id', 'question_id', 'answer', 'row_type')
                        ->where('id', '=', $updateData->id)
                        ->first();
                        $data[] = $updatedData;
                        
                    }
                }
                else
                {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'The '.$key.'.client_id field is invalid.'
                                ],
                            ],
                            400
                        )
                    );
                }

            }
            return $this->successRespond($data, 'success');

        } else {
            throw new HttpResponseException(
                response()->json(
                    [
                        'error' => [
                            'status' => 401,
                            'message' =>  'Token Not Valid!!'
                        ],
                    ],
                    401
                )
            );
        }

    }

    public function getAllFormData(Request $request)
    {

        $credentials = $request->only('client_id');
            $validator = Validator::make($credentials,[
                'client_id' => 'required|integer|min:1'
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

        $steptwo = answers::select('id', 'inspector_id', 'client_id','cat_id','sub_cat_id','question_id','answer', 'row_type')
                ->where('client_id', '=', $request->client_id)
                ->get();

           return $this->successRespond($steptwo, 'success');

    }
}
