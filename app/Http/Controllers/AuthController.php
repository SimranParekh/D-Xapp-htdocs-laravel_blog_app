<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }  
      
    public function Login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('blogs')
                        ->with('success','Signed in');
        }
  
        return redirect("login")->with('error','Login details are not valid');
    }

    public function registration(){
        return view('auth.registration');
    }
      
    public function Registration_store(Request $request){  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("login")->with('success','You have signed-in');
    }

    public function create(array $data){
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function dashboard(){
        if(Auth::check()){
            return view('index');
        }
  
        return redirect("login")->with('error','You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}