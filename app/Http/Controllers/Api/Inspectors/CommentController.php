<?php

namespace App\Http\Controllers\Api\Inspectors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\comments;
use App\Models\spare_images;
use App\Models\images;
use App\Models\client_general_info;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;


class CommentController extends Controller
{
    public function comments(Request $request)
    {

        $insId = Auth::user();
        $data = array();
        $validatedData = $request->all();
            
            $validator = Validator::make($validatedData, [
                'sub_cat_id' => 'required|array',
                'client_id' => 'required|array',
                'comments' => 'required|array',
                'image_path' => 'nullable',
                'pinned' => 'required|array',
                'image_link' => 'nullable',
                'isOfflineData_sync' => 'nullable|boolean',
                'isSpareImageData' => 'required|array'

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

            $subCatId = json_decode($validatedData['sub_cat_id'][0]);

            if (!isset($subCatId[0])) {
                throw new HttpResponseException(response()->json([
                    'error' => [
                        'status' => 422,
                        'message' => 'The sub cat id field is required',
                    ],
                ], 422));
            }

            $clientId = json_decode($validatedData['client_id'][0]);
            $comment = json_decode(stripslashes($validatedData['comments'][0]), true);
            $pinned = json_decode($validatedData['pinned'][0]);
            $imgLink = json_decode($validatedData['image_link'][0]);
            $isOfflineData_sync = $request->isOfflineData_sync;
            $isSpareImageData = json_decode($validatedData['isSpareImageData'][0]);
            $length = count($subCatId);
            
            for ($i = 0; $i < $length; $i++) {

                $input['inspector_id'] = $insId->id;
                $input['sub_cat_id'] = $subCatId[$i];

                if (empty($clientId[$i])) {
                    throw new HttpResponseException(response()->json([
                        'error' => [
                            'status' => 422,
                            'message' => 'The client id.'.$i. ' field is required',
                        ],
                    ], 422));
                }
                    
                $input['client_id'] = $clientId[$i];

                if (empty($comment[$i])) {
                    throw new HttpResponseException(response()->json([
                        'error' => [
                            'status' => 422,
                            'message' => 'The comments .'.$i. ' field is required',
                        ],
                    ], 422));
                }
                    
                $input['comments'] = $comment[$i];

                if (!isset($pinned[$i])) {
                    throw new HttpResponseException(response()->json([
                        'error' => [
                            'status' => 422,
                            'message' => 'The pinned .'.$i.' field is required.',
                        ],
                    ], 422));
                }

                if ($pinned[$i] !== 1 && $pinned[$i] !== 0) {
                    throw new HttpResponseException(response()->json([
                        'error' => [
                            'status' => 422,
                            'message' => 'The pinned .'.$i.' field must be true or false.',
                        ],
                    ], 422));
                }
                $input['pinned'] = $pinned[$i];

                if (!isset($isSpareImageData[$i])) {
                    throw new HttpResponseException(response()->json([
                        'error' => [
                            'status' => 422,
                            'message' => 'The is spare image .'.$i.' field is required.',
                        ],
                    ], 422));
                }

                if ($isSpareImageData[$i] !== 1 && $isSpareImageData[$i] !== 0) {
                    throw new HttpResponseException(response()->json([
                        'error' => [
                            'status' => 422,
                            'message' => 'The is spare image .'.$i.' field must be true or false.',
                        ],
                    ], 422));
                }

                $imgData['sub_cat_id'] = $subCatId[$i];
                $imgData['client_id'] = $clientId[$i];

                $check = DB::table('form_sub_categories')
                ->where('id', $input['sub_cat_id'])->first();
                if (!$check) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'Invalid Sub Cat Id!!'
                                ],
                            ],
                            400
                        )
                    );
                }
                
                $check1 = client_general_info::where('id', $input['client_id'])->first();
                if (!$check1) {
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

                if (empty($imgLink[$i])) {
                    $file = $request->file('image_path.' . $i);
                    $path='spareimage';
                    if (!empty($file)) {
                        $allowedMimeTypes = ['jpeg', 'png', 'jpg'];
                        
                        if (in_array($file->guessExtension(), $allowedMimeTypes)) {
                            // $imgData['image_path'] = $file->store('uploads/form');
                            $imgData['image_path']=Helper::instance()->fileUpload($file, $path);

                            if ($isOfflineData_sync === 0 || empty($isOfflineData_sync)) {
                                if ($isSpareImageData[$i] === 0 || empty($isSpareImageData[$i])) {
                                    spare_images::create([
                                        'image_path' => $imgData['image_path'],
                                        'inspector_id' => $insId->id,
                                        'client_id' => $imgData['client_id'],
                                        'status' => true
                                    ]);
                                }
                            }
                        } else {

                            $imgData['image_path'] = null;
                        }

                    } else {
                        $imgData['image_path'] = null;
                    }

                } else {
                    $imgData['image_path'] = $imgLink[$i];
                }

                $commentCreate = comments::create($input);

                $imgData['comment_id'] = $commentCreate->id;

                $imgCreate = images::create($imgData);

                
                $lastdata['image_path'] = $imgCreate->image_path;
                $lastdata['comments'] = $commentCreate->comments;
                $lastdata['sub_cat_id'] = (int) $commentCreate->sub_cat_id;
                $lastdata['cat_id'] = (int) $check->cat_id;
                $lastdata['inspector_id'] = (int) $insId->id;
                $lastdata['client_id'] = (int) $commentCreate->client_id;
                $lastdata['comment_id'] = (int) $commentCreate->id;
                $lastdata['pinned'] = (int) $commentCreate->pinned;
                $data[] = $lastdata;
            
            }
            return $this->successRespond($data, 'success');

    }

    public function editComment(Request $request)
    {
        $insId = Auth::user();
        $data = array();
        $validatedData = $request->all();

        $validator = Validator::make($validatedData, [
            'sub_cat_id' => 'required|integer',
            'client_id' => 'required|integer',
            'comments' => 'required',
            'image_path' => 'nullable',
            'pinned' => 'required|boolean',
            'image_link' => 'nullable',
            'comment_id' => 'required|integer',
            'isSpareImageData' => 'required|boolean'
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

            $check = DB::table('form_sub_categories')
            ->where('id', $request->sub_cat_id)->first();
            if (!$check) {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 400,
                                'message' => 'Invalid Sub Cat Id!!'
                            ],
                        ],
                        400
                    )
                );
            }

            $check1 = client_general_info::where('id', $request->client_id)->first();
            if (!$check1) {
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
            
            $input['inspector_id'] = $insId->id;
            $input['sub_cat_id'] = $request->sub_cat_id;
            $input['client_id'] = $request->client_id;
            $input['comments'] = $request->comments;
            $input['pinned'] = $request->pinned;

            $imgData['sub_cat_id'] = $request->sub_cat_id;
            $imgData['client_id'] = $request->client_id;

            if (empty($request->image_link)) {

                // $imgData['image_path'] = $request->file('image_path') ? $request->file('image_path')->store('uploads/form') : null;
                $file=$request->file('image_path');
                $path='spareimage';
                $imgData['image_path']=Helper::instance()->fileUpload($file, $path);

                if (!empty($imgData['image_path'])) {
                    if ($request->isSpareImageData === 0 || empty($request->isSpareImageData)) {
                        spare_images::create([
                            'image_path' => $imgData['image_path'],
                            'inspector_id' => $insId->id,
                            'client_id' => $imgData['client_id'],
                            'status' => true
                        ]);
                    }
                }
                
            } else {
                $imgData['image_path'] = $request->image_link;
            }

            $checkComment = comments::where('id', $request->comment_id)
                        ->where('sub_cat_id', $request->sub_cat_id)
                        ->where('client_id', $request->client_id)
                        ->first();

            if (!$checkComment) {
                throw new HttpResponseException(
                    response()->json(
                        [
                            'error' => [
                                'status' => 400,
                                'message' => 'Invalid comment Id!!'
                            ],
                        ],
                        400
                    )
                );
            }

                $checkComment->sub_cat_id = $input['sub_cat_id'];
                $checkComment->client_id = $input['client_id'];
                $checkComment->comments = $input['comments'];
                $checkComment->pinned = $input['pinned'];
                $checkComment->update();

                $imageData['comment_id'] = $checkComment->id;
                $checkImage = images::where('comment_id', $request->comment_id)->first();

                if ($checkImage) {
                    if (isset($checkImage->image_path) && Storage::exists($checkImage->image_path)) {
                    
                    // Storage::delete($checkImage->image_path);
                }

                if (!empty($imgData['image_path'])) {
                    $editImg['image_path'] = $imgData['image_path'];
                } else {
                    $editImg['image_path'] = $checkImage->image_path;
                }

                $checkImage->sub_cat_id = $imgData['sub_cat_id'];
                $checkImage->client_id = $imgData['client_id'];
                $checkImage->comment_id = $request->comment_id;
                $checkImage->image_path = $editImg['image_path'];
                $checkImage->update();

                $lastdata['image_path'] = $editImg['image_path'];
                $lastdata['comments'] = $checkComment->comments;
                $lastdata['sub_cat_id'] = (int) $checkComment->sub_cat_id;
                $lastdata['cat_id'] = (int) $check->cat_id;
                $lastdata['inspector_id'] = (int) $insId->id;
                $lastdata['client_id'] = (int) $checkComment->client_id;
                $lastdata['comment_id'] = (int) $checkComment->id;
                $lastdata['pinned'] = (int) $checkComment->pinned;
                $data[] = $lastdata;

                return $this->successRespond($data, 'success');
        }
    }

    public function commentDelete(Request $request)
    {
        $commentId = $request->comment_id;
        $arr = array();

        $validator = Validator::make($request->all(), [
            'comment_id' => 'required|array',
            'comment_id.*' => 'required|integer|min:1',
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
             
                foreach ((array) $commentId as $id) {
                   $checkcomment = comments::find($id);
                   if(empty($checkcomment)){
                        throw new HttpResponseException(
                            response()->json(
                                [
                                    'error' => [
                                        'status' => 400,
                                        'message' => 'Invalid comment ID'
                                    ],
                                ],
                                400
                            )
                        );
                    }

                        $checkdata = images::find($id);
                    if (!empty($checkdata) && Storage::exists($checkdata->image_path)) {
                        Storage::delete($checkdata->image_path);
                    }
                    images::where('comment_id', $id)->delete();
                        comments::destroy($id);

                }
                   return $this->successRespond($arr, 'Comment Deleted Successfully');
                 
    }

    public function getComment(Request $request){

        $insId = Auth::user();
        $credentials = $request->only('sub_cat_id', 'client_id');
        $validator = Validator::make($credentials, [
            'sub_cat_id' => 'integer|min:1',
            'client_id' => 'integer|min:1'
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

            $subCatId = $request->sub_cat_id;
            $clientId = $request->client_id;

            if (!empty($subCatId) && !empty($clientId)) {

                $check = DB::table('form_sub_categories')
                ->where('id', $subCatId)->first();

                $check2 = DB::table('client_general_info')
                ->where('id', $clientId)->first();

                if (empty($check) || empty($check2)) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'Invalid SubCat/Client Id!!'
                                ],
                            ],
                            400
                        )
                    );
                }

                $data = DB::table('comments')
                ->join('images', 'images.comment_id', '=', 'comments.id')
                ->join('form_sub_categories', 'form_sub_categories.id', '=', 'comments.sub_cat_id')
                ->where('comments.sub_cat_id', '=', $subCatId)
                ->where('comments.client_id', '=', $clientId)
                ->select('images.comment_id', 'images.image_path', 'comments.inspector_id','comments.comments',
                        'comments.client_id', 'comments.sub_cat_id', 'form_sub_categories.cat_id', 'comments.pinned')
                ->get();
                
            
                return $this->successRespond($data, 'success');
            }

            if (!empty($subCatId)) {
                
                $check = DB::table('form_sub_categories')
                ->where('id', $subCatId)->first();
                if (empty($check)) {
                    throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 400,
                                    'message' => 'Invalid Sub Cat Id!!'
                                ],
                            ],
                            400
                        )
                    );
                }

                $data = DB::table('comments')
                ->join('images', 'images.comment_id', '=', 'comments.id')
                ->join('form_sub_categories', 'form_sub_categories.id', '=', 'comments.sub_cat_id')
                ->where('comments.sub_cat_id', '=', $subCatId)
                ->select('images.comment_id', 'images.image_path', 'comments.inspector_id', 'comments.comments',
                        'comments.client_id', 'comments.sub_cat_id', 'form_sub_categories.cat_id', 'comments.pinned')
                ->get();

                return $this->successRespond($data, 'success');

            } elseif (!empty($clientId)) {

                $check2 = DB::table('client_general_info')
                ->where('id', $clientId)->first();
                if (empty($check2)) {
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

                $data = DB::table('comments')
                ->join('images', 'images.comment_id', '=', 'comments.id')
                ->join('form_sub_categories', 'form_sub_categories.id', '=', 'comments.sub_cat_id')
                ->where('comments.client_id', '=', $clientId)
                ->select('images.comment_id', 'images.image_path', 'comments.inspector_id', 'comments.comments',
                         'comments.client_id', 'comments.sub_cat_id', 'form_sub_categories.cat_id', 'comments.pinned')
                ->get();
   
                   return $this->successRespond($data, 'success');
            
            } else {
                $data = DB::table('comments')
                ->join('images', 'images.comment_id', '=', 'comments.id')
                ->join('form_sub_categories', 'form_sub_categories.id', '=', 'comments.sub_cat_id')
                ->where('comments.inspector_id', '=', $insId->id)
                ->select('images.comment_id', 'images.image_path', 'comments.inspector_id', 'comments.comments',
                        'comments.client_id', 'comments.sub_cat_id', 'form_sub_categories.cat_id', 'comments.pinned')
                ->get();

                return $this->successRespond($data, 'success');
            }

    }

    public function getPinnedComment(Request $request)
    {
        $insId = Auth::user();
        if ($insId)
        {
            $credentials = $request->only('client_id');

            $validator = Validator::make($credentials,[
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
            
            $check = DB::table('comments')
             ->join('images', 'images.comment_id', '=', 'comments.id')
             ->join('form_sub_categories', 'form_sub_categories.id', '=', 'comments.sub_cat_id')
             ->where('comments.client_id', '=', $request->client_id)
             ->where('comments.inspector_id', '=', $insId->id)
             ->where('pinned', '=', 1)
             ->select('images.comment_id', 'images.image_path', 'comments.comments',
              'comments.client_id', 'comments.sub_cat_id', 'form_sub_categories.cat_id','comments.inspector_id')
             ->get();

                return $this->successRespond($check, 'success');
        
        }
        else
        {
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

    public function syncImage(Request $request)
    {
        $insId = Auth::user();
        $arr = array();
        if ($insId)
        {
            $input = $request->only('sub_cat_id', 'comments', 'pinned');
            $validated = validator::make($request->all(), [
                'sub_cat_id' => 'required|integer|min:1',
                'comments' => 'required|string',
                'pinned' => 'required|boolean',
                'image_path' => 'image',
                'comment_id' => 'nullable|integer|min:1'

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
            $input['inspector_id'] = $insId->id;

            $DataImg = $request->only('sub_cat_id', 'image_path');

            // $DataImg['image_path'] = $request->file('image_path') ?
            //                         $request->file('image_path')->store('uploads/form') : null;
            $path='spareimage';
            $file=$request->file('image_path');
       
            $DataImg['image_path'] = Helper::instance()->fileUpload($file, $path);
            
                $client = client_general_info::where('inspector_id', '=', $insId->id)->first();
                if (!$client) {
                        throw new HttpResponseException(
                        response()->json(
                            [
                                'error' => [
                                    'status' => 404,
                                    'message' => 'No Information Found For This User '
                                ],
                            ],
                            404
                        )
                    );
                }
                $input['client_id'] = $client->id;
                $DataImg['client_id'] = $client->id;
                $data = DB::table('form_sub_categories')->find($request->sub_cat_id);

                    if (!empty($data))
                    {
                        $commentExist = $request->comment_id;

                        if (!empty($commentExist))
                        {
                            $comment = comments::where('id', '=', $request->comment_id)->first();

                            if (!$comment) {
                                throw new HttpResponseException(
                                    response()->json(
                                        [
                                            'error' => [
                                                'status' => 400,
                                                'message' => 'Invalid Comment Id'
                                            ],
                                        ],
                                        400
                                    )
                                );
                            }

                            $dataExist = $comment->where('sub_cat_id', $request->sub_cat_id)
                            ->where('id', $request->comment_id)->first();

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

                            $imageData = images::where('comment_id', '=', $request->comment_id)->first();
                            
                                // if (!empty($imageData) && Storage::exists($imageData->image_path)) {
                                //      Storage::delete($imageData->image_path);
                                // }

                                if(!empty($DataImg['image_path'])){
                                    $editImg['image_path'] = $DataImg['image_path'];
                                    } else {
                                        $editImg['image_path'] = $imageData->image_path;
                                    }
                                
                                $comment->update($input);
                                $imageData->update($editImg);

                                $arr['sub_cat_id'] = (int)$comment->sub_cat_id;
                                $arr['cat_id'] = (int)$data->cat_id;
                                $arr['client_id'] = (int)$comment->client_id;
                                $arr['comments'] = $comment->comments;
                                $arr['image_path'] = $imageData->image_path;
                                $arr['inspector_id'] = (int)$insId->id;
                                $arr['pinned'] = (int)$comment->pinned;
                                $arr['id'] = $comment->id;
                            
                                return $this->successRespond($arr, 'Sync Image Updated Successfully');
                        }
                        else
                        {
                            $commentsData = comments::create($input);

                            $DataImg['comment_id'] = $commentsData->id;
                            $imgCreate = images::create($DataImg);

                            $arr['sub_cat_id'] = (int)$commentsData->sub_cat_id;
                            $arr['cat_id'] = (int)$data->cat_id;
                            $arr['client_id'] = (int)$commentsData->client_id;
                            $arr['comments'] = $commentsData->comments;
                            $arr['image_path'] = $imgCreate->image_path;
                            $arr['inspector_id'] = (int)$insId->id;
                            $arr['pinned'] = (int)$commentsData->pinned;
                            $arr['id'] = (int)$commentsData->id;
                        return $this->successRespond($arr, 'Sync Image Successfully');                        }
                    }
                    else
                    {
                        throw new HttpResponseException(
                            response()->json(
                                [
                                    'error' => [
                                        'status' => 400,
                                        'message' => 'Invalid Sub Category Id!!'
                                    ],
                                ],
                                400
                            )
                        );
                    }
        }
        else
        {
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
