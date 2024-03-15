<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MedicationController extends Controller {

    function addMedication(Request $request) {
        //check if the user has been authenticated
        if (auth()->check()) {
            // admin only can save medication
            if ((auth()->user()->role) == 1) {
                // default validation for medication save
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'quantity' => 'required'
                ]);
                if ($validator->fails()) {
                    // Validation failed, return the error messages
                    return response()->json(['error' => $validator->errors()], 400);
                }
                // format medication dataset & add to a new array
                $data = [
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'description' => $request->description,
                    'user_id' => Auth::id()
                ];
                $customer = Medication::create($data);
                if (!$customer) {
                    return response()->json(['message' => 'Medication Insert Error!'], 500);
                } else {
                    return response()->json(['message' => 'Medication Saved Successfully!'], 200);
                }
            } else {
                return response()->json(['error' => 'this user has not permission to add Medication'], 400);
            }
        } else {
            return 'User Not Authenticated';
        }
    }

    function viewMedication() {
        $result = Medication::select('name', 'quantity', 'description')->get();
        return $result;
    }

    function updateMedicationDetail($id, Request $request) {
        if (auth()->check()) {
            if ((auth()->user()->role) == 3) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'quantity' => 'required'
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                }
                $data = [
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'description' => $request->description
                ];
                $medication = Medication::find($id);
                $result = $medication->update($data);
                if (!$result) {
                    return response()->json(['message' => 'Medication Update Error!'], 500);
                } else {
                    return response()->json(['message' => 'Medication Updated Successfully!'], 200);
                }
            } else {
                return response()->json(['error' => 'this user has not permission to update medication'], 400);
            }
        } else {
            return 'User Not Authenticated';
        }
    }

    function deleteMedication($id) {
        if (auth()->check()) {
            $result = Medication::find($id);
            // check if the id found or not
            if ($result) {
                //only cashier can delete records
                if ((auth()->user()->role) == 3) {
                    $result->delete();
                    if (!$result) {
                        return response()->json(['message' => 'Medication Delete Error!'], 500);
                    } else {
                        return response()->json(['message' => 'Medication Deleted Successfully!'], 200);
                    }
                } else {
                    return response()->json(['error' => 'this user has not permission to delete Medication'], 400);
                }
            } else {
                return response()->json(['error' => 'Medication Not Found or already deleted'], 400);
            }
        } else {
            return 'User Not Authenticated';
        }
    }
}
