<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesRequests
{
    /**
     * Validate the request data programmatically for any scenario.
     *
     * @param Request $request
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateRequest(Request $request, array $rules)
    {
        try {
            $validator = Validator::make($request->all(), $rules);

            // If validation fails, an exception is thrown.
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // Return the validated data if successful.
            return response()->json([
                'status' => 'success',
                'data' => $validator->validated(),
            ], 200);

        } catch (ValidationException $e) {
            // Catch validation exception and return errors in JSON format.
            return response()->json([
                'status' => 'error',
                'errors' => $e->validator->errors(),
            ], 422);
        }
    }
}
