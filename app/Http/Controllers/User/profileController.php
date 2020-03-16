<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Middleware\Authenticate;
use App\User;
use Hash;
use Auth;
use Intervention\Image\Facades\Image;
use Session;

class profileController extends Controller
{
    public function index()
    {
        return view('user/profile');
    } 
    
    public function address()
    {
        return view('user/loadUserAddress');
    }
    
    public function loadProfile()
    {
        return view('user/loadProfile');
    }
    
    public function loadImage()
    {
        return view('user/loadImage');
    }

    public function loadPassword()
    {
        return view('user/loadPassword');
    }

    public function changeprofile(Request $request , $id)
    {
        // $this->validate($request,[
        //     'name' => 'string|max:30',
        //     'notelepon' => 'integer|max:12',
        //     'email' => 'string|max:12|email|unique'
        // ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->notelepon = $request->notelepon;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'status' => 1,
            'message'=> 'Your Profile Successfully Changed!'
        ]);
    }
    public function uploadImage(Request $request, $id)
    {
        
        if ($request->hasFile('edit')) {
            $this->validate($request,[
                    'edit' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048'
                ]);
            $user = User::find($id);
            $file = $request->file('edit');
            $nameUpload = $file->GetClientOriginalName();
            $request->file('edit')->move("userimageprofile", $nameUpload);
            $user->image = $nameUpload;
            // Compress image
            $image = Image::make(public_path('userimageprofile/' . $user->image))->resize(280,250);
            $image->save();
            $user->save();
            Session::flash('success', 'Your Picture successfuly changed!');
            return back();
                // return response()->json([
                //     'status' => 1,
                //     'message' => "Your Picture successfuly changed!"
                // ]);
            
        }else{
            Session::flash('failed','Failed to upload your image!');
            return back();
            // return response()->json([
            //     'status' => 0,
            //     'message' => "Failed to upload your image!"
            // ]);
        }
    }
    

    public function changePassword(Request $request)
    {
        // cek kecocokan dengan password current ke database
        if(!(Hash::check ($request->get('current'),Auth::user()->password) )){
            return response()->json([
                'status' => 1,
                'message' => 'Masukan password dengan benar!!!'
            ]);
            }elseif(strcmp($request->get('current'),$request->get('newpassword')) == 0){
           // cek jika current & newpassword sama 
                    return response()->json([
                        'status' => 1,
                        'message' => 'Password baru harus berbeda dengan password lama!!!'
                    ]);
            }
                // cek newpassword & password confirm (newpassword2)
            if(!strcmp($request->get('newpassword'),$request->get('newpassword2')) == 0){
                    return response()->json([
                        'status' => 1,
                        'message' => 'Konfirmasi password tidak sama dengan password baru!!!'
                    ]);
            }
        $validate = $this->validate($request,[
            'current' => 'required|string',
            'newpassword' => 'required|min:7|string',
            'newpassword2' => 'required|string|same:newpassword',
        ]);
        if($validate == false){
            echo "error";
        }else{
            $user = Auth::user();
            $user->password = bcrypt($request->get('newpassword'));
            $user->save();
                return response()->json([
                    'status' => 1,
                    'message' => 'Your Password Successfuly Changed!!!'
                ]);
        }
    }
    public function changeaddress(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->alamat = $request->changeaddress;
        $user->save();
        return response()->json([
            'status' => 1,
            'message' => "Your address successfuly uploaded!!!"
        ]);
    }
}
