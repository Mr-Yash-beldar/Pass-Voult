<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Voult;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoultController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            //if breared token is not valid which is provided in authrization header
            if (!auth()->user()) {
                return $this->sendError('Unauthenticated.', [], 401);
            }
            $voults = Voult::where('user_id', auth()->user()->id)->get();
           

            return $this->sendResponse($voults, 'All Voults fetched successfully.');

            // if login not found send error
            if (!$voults) {
                return $this->sendError('Voults Not Found.', [], 404);
            }
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $valdatevoults = Validator::make($request->all(), [
                'service_name' => 'required',
                'service_url' => 'required',
                'category' => 'required',
                'service_password' => 'required',
                'service_username' => 'required',
                'service_email' => 'required',
            ]);

            if ($valdatevoults->fails()) {
                // return response()->json([
                //     'status' => false,
                //     'message' => 'Validation Error',
                //     'error' => $valdatevoults->errors()->all()
                // ], 400);


                return $this->sendError('Validation Error.', $valdatevoults->errors()->all(), 400);
            }

            $voult = Voult::create([
                'service_name' => $request->service_name,
                'service_url' => $request->service_url,
                'category' => $request->category,
                'service_password' => $request->service_password,
                'user_id' => auth()->user()->id,
                'service_username' => $request->service_username,
                'service_email' => $request->service_email,
            ]);

            // return response()->json([
            //     'status' => true,
            //     'message' => 'Voult Created Successfully',
            //     'data' => $voult
            // ], 200);

            return $this->sendResponse($voult, 'Voult Created Successfully.');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $voultid=decrypt($id);
            $voult = Voult::find($voultid);
            if (!$voult) {
                return $this->sendError('Voult Not Found.', [], 404);
            }
            Gate::authorize('view', $voult);
            $data= Voult::where('user_id', auth()->user()->id)->find($voultid);

            // return  response()->json([
            //     'status' => true,
            //     'message' => 'Single Voult Details',
            //     'data' => $data
            // ], 200);

            return $this->sendResponse($data, 'Single Voult Details fetched successfully.');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $id=decrypt($id);
            $voult = Voult::find($id);
            if (!$voult) {
                return $this->sendError('Voult Not Found.', [], 404);
            }
            Gate::authorize('update', $voult);
            $valdatevoults = Validator::make($request->all(), [
                'service_name' => 'required',
                'service_url' => 'required',
                'category' => 'required',
                'service_password' => 'required',
                'service_username' => 'required',
                'service_email' => 'required',
            ]);

            if ($valdatevoults->fails()) {
                // return response()->json([
                //     'status' => false,
                //     'message' => 'Validation Error',
                //     'error' => $valdatevoults->errors()->all()
                // ], 400);

                return $this->sendError('Validation Error.', $valdatevoults->errors()->all(), 400);
            }

            $voult = Voult::where('user_id', auth()->user()->id)->find($id);
            //check if voult not found
            if (!$voult) {
                // return response()->json([
                //     'status' => false,
                //     'message' => 'Voult Not Found',
                // ], 404);

                return $this->sendError('Voult Not Found.', [], 404);
            }
            $voult->update([
                'service_name' => $request->service_name,
                'service_url' => $request->service_url,
                'category' => $request->category,
                'is_favourite' => $request->is_favourite,
                'service_password' => $request->service_password,
                'service_username' => $request->service_username,
                'service_email' => $request->service_email,
            ]);

            // return response()->json([
            //     'status' => true,
            //     'message' => 'Voult Updated Successfully',
            //     'data' => $voult
            // ], 200);

            return $this->sendResponse($voult, 'Voult Updated Successfully.');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $id=decrypt($id);
            $voult = Voult::find($id);
            Gate::authorize('delete', $voult);
            $voult->delete();

            // return response()->json([
            //     'status' => true,
            //     'message' => 'Voult Deleted Successfully',
            // ], 200);

            return $this->sendResponse($voult, 'Voult Deleted Successfully.');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
}
