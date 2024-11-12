<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IeoRequest extends FormRequest
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
        // dd('working');
        return [
            'symbol' => 'required',
            'cointwo' => 'required',
            'supply_per_session' => 'required|regex:/^[0-9]+$/',
            'price_in_cointwo' => 'required|regex:/^[0-9.]+$/',
            'min_token_purchase' => 'nullable|regex:/^[0-9.]+$/',
            // 'min_othercurrency_purchase' => 'nullable|regex:/^[0-9.]+$/',
            'protocol_network' => 'required',
            'roi' => 'nullable|numeric|min:0',
            // 'stage' => 'required|numeric|gt:0',
            'discount' => 'nullable|numeric|min:0',
            'industry' => 'nullable',
            'website' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'whitepaper' => 'nullable | mimes:pdf,Pdf,PDF| max:1024',
            'presentation' => 'nullable | mimes:pdf,Pdf,PDF| max:1024',
            'logo' => 'nullable | mimes:png,Png,PNG| max:1024',
            'banner' => 'nullable | mimes:png,Png,PNG| max:1024',
        ];
    }
     /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function message()
    {
        
        return [
            'symbol.required' => 'Symbol is required',
            'supply_per_session.required' => 'Supply per session is required',
            'price_is_usd.required' => 'Price in USD is required',
            'min_token_purchase.regex' => 'Invalid input for Minimum token purchase',
        ];
    }
}
