<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Register2Request extends Request
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
        if(Request::input('part_type') == 'teacher'){
            return [
                'reg_id'                =>  'required|numeric',
                'part_type'             =>  'required|alpha_dash',
                'location_state'        =>  'required|numeric',
                'location_city'         =>  'required_without:other_school',
                'school_name'           =>  'required_without:other_school|numeric',
                'school_type'           =>  'required_without:other_school|alpha_dash',
                'school_board'          =>  'required_without:other_school|string',
                'avg_fee'               =>  'required_without:other_school|numeric',
                'other_school_name'     =>  'required_if:other_school,on',
                'other_school_address'  =>  'required_if:other_school,on',
                'other_school_city'     =>  'required_if:other_school,on',
                'other_school_type'     =>  'required_if:other_school,on|string',
                'other_school_board'    =>  'required_if:other_school,on|string',
                'other_avg_fee'         =>  'required_if:other_school,on|numeric'
            ];
        }else if(Request::input('part_type') == 'studying'){
            //dd(Request::all());
            return [
                'reg_id'                =>  'required|numeric',
                'part_type'             =>  'required|alpha_dash',
                'reg2_course'           =>  'required|alpha_dash',
                'reg2_other_course'     =>  'required_if:reg2_course,others',
                'location_state'        =>  'required|numeric',
                'reg2_location_city'    =>  'required',
                'institute_id'          =>  'required_without:other_institute',
                'reg2_course_duration'  =>  'required|numeric',
                'reg2_course_fee'       =>  'required|numeric',
                'other_institute_name'  =>  'required_if:other_institute,on',
                'new_institute_address' =>  'required_if:other_institute,on'
            ];
        }

    }
}
