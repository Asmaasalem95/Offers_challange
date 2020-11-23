<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class generate_invoice_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency_id' => 'required|exists:App\Models\Currency,id',
            'products'  =>'required|array|min:1',
            'products.*.product_id' => 'required|exists:App\Models\Product,id',
            'products.*.offer_id' => 'exists:App\Models\Offer,id',
            'products.*.quantity' => 'required|min:1|integer'
        ];
    }

    public function messages()
    {
        return[
            'products.*.product_id.required' => 'Product is invalid',
            'products.*.product_id.exists' => 'Product is invalid',
            'products.*.offer_id.exists' => 'Offer is invalid',
            'products.*.quantity.required' => 'Quantity is invalid',
            'products.*.quantity.min' => 'Quantity is invalid',
        ];


    }
    /** override failedValidation function to customize the validation api response
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(

            response()->json([
                'status' => 'Error',
                'response' => $validator->errors()->all(),
            ])->setStatusCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)

    );
    }
}
