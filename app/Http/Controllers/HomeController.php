<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Noa;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;

class HomeController extends Controller
{
    private $AuthUser, $User, $Registration, $Noa;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Registration $registration, Noa $noa)
    {
        $this->User = $user;
        $this->Registration = $registration;
        $this->Noa = $noa;
        if(Auth::check()){
            $this->AuthUser = Auth::user();
        }else{
            $this->AuthUser = null;
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if the User has already given its user type (Individual or Institutional)
        if(isset($this->AuthUser->user_type)){
//            if(isset($this->AuthUser->session_id)){
//                return redirect()->route('register_get1')->with(['info'=>'You have this session.','type'=>'Error']);
//            }
            if($this->AuthUser->user_type == 0){
                $count = $this->Registration->where('user_id', $this->AuthUser->id)->count();
                if($count > 0){
                    return redirect()->route('dashboard')->with(['info'=>'You have already chosen this option and cannot be undo!','type'=>'Error']);
                }
            }
        }
        return view('home');
    }

    public function setUserType(Request $request)
    {
        //Set User Type
        $userType = $request;
        $checkCheck = $this->AuthUser;
        if(isset($checkCheck->user_type)){
            return redirect()->back()->with('info','Sorry you have already pass this option.');
        }
        $this->validate($userType,[
            'user_type' => 'required|numeric'
        ]);

        $checkCheck->user_type = $userType->user_type;
        $checkCheck->save();
        return redirect()->route('register_get1');

    }

    public function dashboard()
    {
        $noa = $this->Noa->lists('title','noa_id');
        $user = $this->User->find($this->AuthUser->id);
        $userSession = explode('.',$user->session_id);
        //dd($user);
        return view('dashboard.dashboard', compact('user','noa','userSession'));
    }

    public function settings()
    {
        return 'Not yet created!';
    }
}
