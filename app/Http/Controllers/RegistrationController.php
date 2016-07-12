<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Institute;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use App\Models\School;

class RegistrationController extends Controller
{
    private $AuthUser, $User, $Registration, $School, $Institute;

    public function __construct(User $user, Registration $registration, School $school, Institute $institute)
    {
        if(Auth::check()){
            $this->AuthUser = Auth::user();
        }
        $this->User = $user;
        $this->Registration = $registration;
        $this->School = $school;
        $this->Institute = $institute;
    }

    public function register1Get()
    {
        if(!isset($this->AuthUser->user_type) || $this->AuthUser->user_type == null){
            return redirect()->route('home_page')->with(['info'=>'You need to choose one option first!','type'=>'Error!']);
        }

        if($this->AuthUser->user_type == 0){
            $count = $this->Registration->where('user_id', $this->AuthUser->id)->count();
            if($count > 0){
                return redirect()->back()->with(['info'=>'You cannot add more than 1 candidate as you have selected the Individual user type.', 'type'=>'Error']);
            }
        }
        $registration = null; //temporary
        $month = $this->getStateNames()[0]; $dob_d = $this->getStateNames()[1]; $year = $this->getStateNames()[2];
        $tpo_heard = $this->getStateNames()[3]; $stateNames = $this->getStateNames()[4]; $dde = $this->getStateNames()[5];
        $noa = $this->getStateNames()[6]; $tpo_heard2 = $this->getStateNames()[7];

        return view('registration.home', compact('registration', 'dob_d', 'month', 'year', 'stateNames','tpo_heard','dde','noa','tpo_heard2'));
    }

    public function register1Post(Requests\register1Request $request)
    {
        //dd($request->all());
        $validFirst = [2,3,4,5,6,8,9,10,11];
        $valid = [2=>[12],3=>[1],4=>[4],5=>[1],6=>[1],8=>[3,4],9=>[1],10=>[3],11=>[1]];
        $dob = $request->candi_dob_y.'-'.$request->candi_dob_m.'-'.$request->candi_dob_d;
        // check if the others has been tick or not.
        $ddeCheck = $request->d_d_e;
        if(in_array('others',$ddeCheck)){
            $this->validate($request, [
                'd_d_e_others' => 'required|alpha_dash'
            ]);
            $dde_others = $request->d_d_e_others;
        }else {
            $dde_others = null;
        }
        $heardTpo = $request->heard_tpo;
        $tpoHeard2 = $request->tpo_heard_2;
        $heardFrom = $heardTpo.'.'.$tpoHeard2;
        //$j = 'heard_from_'.$heardTpo.'_'.$tpoHeard2;
        if(in_array($heardTpo, $validFirst)){
            if(in_array($tpoHeard2, $valid[$heardTpo])){
                $j = 'heard_from_'.$heardTpo.'_'.$tpoHeard2;
                $checkVal = 'heard_from_'.$heardTpo.'_'.$tpoHeard2;
                $val = $request->$checkVal;
                $this->validate($request,[
                    $j => 'required'
                ],['As you have chosen to specify the where have you heard about TPO field. It is required that you input the field!']);
                $heardFrom = $heardTpo.'.'.$tpoHeard2.'.'.$val;
            }
        }

        if($request->noa == 1 || $request->noa == 2 || $request->noa == 3 || $request->noa == 11){
            $category = 'teacher'; $supplement = null; $others = null;}else if($request->noa == 9){
            $category = 'studying'; $supplement = null; $others = null;}else if($request->noa == 5 || $request->noa == 12){
            $category = 'supplemental'; $supplement = 'organisation'; $others = null;}else if($request->noa == 4){
            $category = 'supplemental'; $supplement = 'individual'; $others = null;}else if($request->noa == 7){
            $category = 'govt'; $supplement = null; $others = null;}else{
            $category = 'others'; $supplement = null; $others = $request->noa;
        }
        $dde = implode(',', $request->d_d_e);
        $country = "India";

        $register1 = $this->Registration->create([
            'user_id'           =>  $this->AuthUser->id,
            'session_id'        =>  '1',
            'title'             =>  $request->parti_title,
            'f_name'            =>  $request->candi_fname,
            'l_name'            =>  $request->candi_lname,
            'dob'               =>  $dob,
            'hel'               =>  $request->candi_hel,
            'degree'            =>  $dde,
            'degree_others'     =>  $dde_others,
            'prev_participate'  =>  $request->participant,
            'heard_from'        =>  $heardFrom,
            'ref_code'          =>  $request->r_code,
            'noa'               =>  $request->noa,
            'category'          =>  $category,
            'supplemental'      =>  $supplement,
            'others'            =>  $others
        ]);
        $registerId = $register1->id;

        Address::create([
            'registration_id'   =>  $registerId,
            'country'           =>  $country,
            'state'             =>  $request->candi_state,
            'city'              =>  $request->candi_city
        ]);

        $user = $this->User->find($this->AuthUser->id);
        $user->session_id = '1.'.$register1->id;
        $user->save();
        return redirect()->route('register_get2', compact('registerId'));
    }

    public function register2Get(Request $request)
    {
        $register = $this->Registration->findOrFail($request->registerId);
        $registerId = $request->registerId;
        if($this->AuthUser->id != $register->user_id){
            return redirect()->route('dashboard')->with(['info'=>'Sorry! But this registration is not created by you!','type'=>'Error']);
        }else if($register->status == 1){
            return redirect()->route('dashboard')->with(['info'=>'Sorry! But this registration is completed!','type'=>'Error']);
        }else if($register->session_id == 2){
            return redirect()->route('paymentGet', compact('registerId'))->with(['info'=>'Sorry! But this registration has already completed this session and needs the Payment.!','type'=>'Warning!']);
        }

        $states = DB::table('states')->lists('name','id');
        if($register->category == "teacher"){
            $schools = $this->School->lists('name','id'); //bad Idea
            $type = 1;
            return view('registration.part2', compact('register','states','schools', 'type'));
        }else if($register->category == "studying"){
            $type = 2;
            $institutes = $this->Institute->lists('name','id');
            return view('registration.part2', compact('register','states','institutes', 'type'));
        }else if($register->category == "supplemental"){
            $type = 3;
            $institutes = DB::table('institute')->lists('name','id');
            return view('registration.part2', compact('register','states','institutes', 'type'));
        }else if($register->category == "govt"){
            $type = 4;
            $institutes = DB::table('institute')->lists('name','id');
            return view('registration.part2', compact('register','states','institutes', 'type'));
        }else if($register->category == "others"){
            $type = 5;
            $institutes = DB::table('institute')->lists('name','id');
            return view('registration.part2', compact('register','states','institutes', 'type'));
        }else if($register->category == "supplemental"){
            if($register->supplemental == "organisation"){

            }
        }



        //return redirect()->route('dashboard')->with(['info'=>'You hae successfully registered a candidate. Next is Step 2.', 'type'=>'Success']);
    }

    public function register2Post(Requests\Register2Request $request)
    {
        $registration = $this->Registration->findOrFail($request->reg_id);
        if($registration->user_id != $this->AuthUser->id){
            return redirect()->route('dashboard')->with(['info'=>'This registration is not your\'s.!','type'=>'Error']);
        }
        if($registration->category == "teacher"){
            $this->teacherPart2($request, $registration);
        }elseif($registration->category == "studying"){
            $this->studyingPart2($request, $registration);
        }

        $registerId = $request->reg_id;
        $registration->session_id = 2;
        $registration->save();
        return redirect()->route('paymentGet', compact('registerId'));
    }

    public function paymentGet(Request $request)
    {
        $registrationId = $request->registerId;
        $registerId = $registrationId;
        $registration = $this->Registration->findOrFail($registrationId);
        if($registration->user_id != $this->AuthUser->id){
            return redirect()->route('dashboard')->with(['info'=>'This registration is not your\'s.!','type'=>'Error']);
        }else if($registration->status == 1){
            return redirect()->route('dashboard')->with(['info'=>'This registration is not finished with PART-1!','type'=>'Error']);
        }else if($registration->session_id == 1){
            return redirect()->route('register_get2', compact('registerId'))->with(['info'=>'This registration has a different session and cannot be on this page!','type'=>'Error']);
        }
        //dd($registrationId);
        return view('payment.home', compact('registrationId'));
    }

    public function paymentPost(Request $request)
    {

        if($request->payment == 1){
            $registration = $this->Registration->findOrFail($request->registrationId);
            if($registration->user_id != $this->AuthUser->id){
                return redirect()->route('dashboard')->with(['info'=>'This registration is not your\'s.!','type'=>'Error']);
            }
            if($registration->status != 0){
                return redirect()->route('dashboard')->with(['info'=>'This registration has been completed. You cannot pay again!','type'=>'Error']);
            }else{
                $registration->status = 1;
                $registration->save();
            }
            return redirect()->route('dashboard')->with(['info'=>'You have successfully completed your payment.','type'=>'Success']);
        }else{
            return redirect()->route('dashboard')->with(['info'=>'You have canceled your payment. You can pay later or delete the registration.','type'=>'Error']);
        }

    }

    public function teacherPart2($request,$registration)
    {
        if($request->other_school == "on"){
            $check = $this->School->where(['name'=>$request->other_school_name, 'type'=>$request->other_school_type, 'state'=>$request->location_state, 'city'=>$request->other_school_city])->first();
            if($check){
                return back()->with(['info'=>'This School is already present!','type'=>'Error']);
            }
            $this->School->insert([
                'name'      =>  $request->other_school_name,
                'type'      =>  $request->other_school_type,
                'board'     =>  $request->other_school_board,
                'country'   =>  'India',
                'state'     =>  $request->location_state,
                'city'      =>  $request->other_school_city,
                'fee_range' =>  $request->other_avg_fee
            ]);
        }

        DB::table('cat_'.$registration->category)->insert([
            'registration_id'   =>  $request->reg_id,
            'type'              =>  'school',
            'school_id'         =>  $request->school_name,
        ]);
    }

    public function studyingPart2($request, $registration)
    {
        if($request->other_institute == "on"){
            $check = $this->Institute->where(['name'=>$request->other_institute_name, 'type'=>'1', 'state'=>$request->location_state, 'city'=>$request->reg2_location_city])->first();
            if($check){
                return redirect()->back()->with(['info'=>'This Institute is already present!','type'=>'Error']);
            }
            $this->Institute->insert([
                'name'      =>  $request->other_institute_name,
                'type'      =>  1,
                'country'   =>  'India',
                'state'     =>  $request->location_state,
                'city'      =>  $request->reg2_location_city,
                'fee_range' =>  $request->reg2_course_fee
            ]);
        }

        DB::table('cat_'.$registration->category)->insert([
            'registration_id'   =>  $request->reg_id,
            'course'            =>  $request->reg2_course,
            'other_course'      =>  $request->reg2_other_course,
            'type'              =>  'institute',
            'institute_id'      =>  $request->institute_id,
            'fee'               =>  $request->reg2_course_fee
        ]);
    }

    public function getStateNames()
    {
        $dob_d = []; $year = [];
        $month = [1=>'Jan',2=>'Feb',3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'Aug', 9=>'Sept', 10=>'Oct', 11=>'Nov', 12=>'Dec'];

        $tpo_heard = [
            0=>'Choose One',1=>'The Hindu/The Hindu in School/Education Plus', 2=>'Other newspaper/magazine/newsletter', 3=>'Radio',
            4=>'Facebook/Twitter/Google Ads/Other online source', 5=>'Received on Email',6=>'Received on Whatsapp',
            7=>'Received through a voice message',8=>'TPO Poster (Specify where was it found)',9=>'At a conference',
            10=>'Word of mouth',11=>'Other'
        ];

        for($i = 1; $i < 32; $i++){
            $dob_d[$i] = $i;
        }

        for($i = 1947; $i < date('Y')-17; $i++){
            $year[$i] = $i;
        }

        $dde = [
            'diploma'=>'Diploma in Education','bed'=>'B.Ed','med'=>'M.Ed','tgt'=>'Trained Graduate Teacher (TGT)',
            'cambridge'=>'Cambridge Diploma for Teachers and Trainers','others'=>'Others, please secify &nbsp;&nbsp;'
        ];

        $tpo_heard2 = [
            "1" => [1 => 'The Hindu (English)', 2 => 'The Hindu (Tamil)', 3 => 'The Hindu in School', 4 => 'Education Plus'],
            "2" => [1=>'The Hindustan Times',2=>'Anand Bazaar Patrika',3=>'The Telegraph',4=>'Teacher Plus',5=>'Education World ? Other?',6=>'X',7=>'Y',8=>'Asset Scope',9=>'Namaskar (NISA)',10=>'Ed Monitor',11=>'The Telegraph',12=>['Others (Please specify)']],
            "3" => [1=>['Open ended (specify the channel)']],
            "4" => [1=>'Facebook',2=>'Twitter',3=>'Google Ads',4=>['Other website (specify)']],
            "5" => [1=>['From whom (Specify the email address)']],
            "6" => [1=>['From whom (Specify the number)']],
            "8" => [1=>'School',2=>'Organization office',3=>['At a conference, specify'],4=>['Others (specify)']],
            "9" => [1=>['Please specify']],
            "10" => [1=>'Last year\'s TPO participants',2=>'School Principal',3=>['Others (Specify)']],
            "11" => [1=>['Please specify']]
        ];

        return [$month, $dob_d, $year, $tpo_heard, $stateIndia, $dde, $noa, $tpo_heard2];
    }

}
