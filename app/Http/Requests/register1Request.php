<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class register1Request extends Request
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
        //dd(Request::all());
        return [
            "participant" => "required|numeric",
            "parti_title" => "required",
            "candi_fname" => "required|between:2,40|alpha_dash",
            "candi_lname" => "required|between:2,40|alpha_dash",
            "candi_dob_d" => "required|numeric",
            "candi_dob_m" => "required|numeric",
            "candi_dob_y" => "required|numeric",
            "candi_hel" => "required|numeric",
            "d_d_e" => "required|array",
            "d_d_e_others" => "required_if:d_d_e,others",
            "candi_state" => "required",
            "candi_city" => "required",
            "heard_tpo" => "required|numeric",
            "tpo_heard_2" => "required|alpha_dash",
            "heard-from-2" => "array",
            "heard-from-3" => "array",
            "heard-from-4" => "array",
            "heard-from-5" => "array",
            "heard-from-6" => "array",
            "heard-from-8" => "array",
            "heard-from-9" => "array",
            "heard-from-10" => "array",
            "heard-from-11" => "array",
            "r_code" => "string|max:20",
            "noa" => "required|numeric"
        ];
    }
}
