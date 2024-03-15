<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller {
    function addCustomer(Request $request) {
        //check if the user has been authenticated
        if (auth()->check()) {
            // admin only can save customers
            if ((auth()->user()->role) == 1) {
                // default validation for customer save
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'address' => 'required',
                    'email' => 'required',
                    'contact_no' => 'required|unique:customers'
                ]);
                if ($validator->fails()) {
                    // Validation failed, return the error messages
                    return response()->json(['error' => $validator->errors()], 400);
                }
                // format customer dataset & add to a new array
                $data = [
                    'name' => $request->name,
                    'address' => $request->address,
                    'email' => $request->email,
                    'contact_no' => $request->contact_no,
                    'description' => $request->description,
                    'user_id' => Auth::id()
                ];
                $customer = Customer::create($data);
                if (!$customer) {
                    return response()->json(['message' => 'Customer Insert Error!'], 500);
                } else {
                    return response()->json(['message' => 'Customer Saved Successfully!'], 200);
                }
            } else {
                return response()->json(['error' => 'this user has not permission to add customer'], 400);
            }
        } else {
            return 'User Not Authenticated';
        }
    }

    function viewCustomer() {
        $result = Customer::select('name', 'address', 'email', 'contact_no', 'description')
            ->get();
        return $result;
    }

    function updateCustomerDetail($id, Request $request) {
        if (auth()->check()) {
            // admin only can save customers
            if ((auth()->user()->role) == 2) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'address' => 'required',
                    'email' => 'required',
                    'contact_no' => 'required'
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                }
                $data = [
                    'name' => $request->name,
                    'address' => $request->address,
                    'email' => $request->email,
                    'contact_no' => $request->contact_no,
                    'description' => $request->description
                ];
                $customer = Customer::find($id);
                $result = $customer->update($data);
                if (!$result) {
                    return response()->json(['message' => 'Customer Update Error!'], 500);
                } else {
                    return response()->json(['message' => 'Customer Updated Successfully!'], 200);
                }
            } else {
                return response()->json(['error' => 'this user has not permission to update customer'], 400);
            }
        } else {
            return 'User Not Authenticated';
        }
    }

    function deleteCustomer($id) {
        if (auth()->check()) {
            $result = Customer::find($id);
            // check if the id found or not
            if ($result) {
                //only manager can delete records
                if ((auth()->user()->role) == 2) {
                    $result->delete();
                    if (!$result) {
                        return response()->json(['message' => 'Customer Delete Error!'], 500);
                    } else {
                        return response()->json(['message' => 'Customer Deleted Successfully!'], 200);
                    }
                    //only manager can temporary delete records
                } else {
                    return response()->json(['error' => 'this user has not permission to delete customer'], 400);
                }
            } else {
                return response()->json(['error' => 'Customer Not Found or already deleted'], 400);
            }
        } else {
            return 'User Not Authenticated';
        }
    }
}
