<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{


    // home page
    function index()
    {
        return view('index');
    }
    function dashboard()
    {
        $show = User::all();


        return view('users.home', compact('show'));
    }

    function registerForm()
    {
        return view('users.register');
    }

    // user registered
    function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email|unique:users,email',
            'password' => 'required',
        ]);
        $created = $request->all();
        $created['password'] = Hash::make($request->password);

        $originalName = $request->file('image')->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('userImages', $originalName, 'public');
        $created['image'] = basename($filePath);

        $size = $request->file('image')->getSize();
        $mime = $request->file('image')->getMimeType();
        $created['mime_type'] = $mime;
        $created['size'] = $size;
        $user = User::create($created);

        // Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);
        // Send email verification notification
        // $user->sendEmailVerificationNotification();

        event(new Registered($user));

        return redirect()->route('home');
    }

    // show users

    // function showUsers(){
    // $show=User::all();

    //     return view('users.dashboard');

    // }

    // delete user
    function deleteUsers($id)
    {
        $find = User::find($id);
        $find->delete();
        session()->flash('success', "move to trash");
        return back();
    }

    // delete all user
    function deleteAllUsers()
    {

        // User::query()->delete();
        User::truncate();
        session()->flash('success', "delete successfully");
        return back();
    }

    // update users
    function updateUsers($id)
    {
        $find = User::find($id);
        return view('users.update', compact('find'));
    }


    // update users
    function updateUsersStore(Request $request, $id)
    {
        $find = User::find($id);
        $find->fill($request->only(['name', 'email', 'password']));
        $find['password'] = Hash::make($find->password);
        $find->save();
        return redirect('/home');
    }

    // login
    function login()
    {

        // $user = auth()->user();
        // $authEmail = null; 
        // if ($user) {
        //     $authEmail = $user->email; 
        // }

        if (auth()->check()) {
            return redirect('/home');
        } else {
            return view('users.login');
        }
    }

    // login user
    function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $email=session()->put("email",$credentials['email']);
        $remember = $request->remember;
        if (Auth::attempt($credentials, $remember)) {
            return redirect('/home');
        }
        $matchEmail = User::where('email', $credentials['email'])->first();
        if ($matchEmail) {
            return back()->with('status', "Password is invalid");
        } else {
            return back()->with('status', "user is not registered");
        }
    }

    // logout
    function logout()
    {
        // if(session('email')){
        //     session()->flush();
        // }
        Auth::logout();
        return redirect('login');
    }
    // trash records
    function trashrecords()
    {
        $show = User::onlyTrashed()->get();
        return view('users.trash', compact('show'));
    }
    // restore record
    function restore($id)
    {
        $find = User::withTrashed()->find($id);
        $find->restore($find);
        return back();
    }

    // select one by one for moving to trash
    function selectidsfortrash(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            User::whereIn('id', $ids)->delete();
            return redirect('trashrecords');
        }
        return back()->with('status', 'select any record');
    }
    // select one by one for moving to trash
    function selectidsforrestore(Request $request)
    {
        $ids = $request->ids;
        if (!is_null($ids)) {
            User::whereIn('id', $ids)->restore();
            return redirect('register');
        }
        return back()->with('status', 'select any record');
    }

    // trash all
    function trashall()
    {
        User::query()->delete();
        return back()->with('success', "all data moved to trash");
    }

    // restore all
    function restoreall()
    {
        User::query()->restore();
        return back()->with('success', "all data restored");
    }



    ////////////////////// download

    public function download($id) {
        $user = User::find($id);
    
// return response()->download(public_path('userImages/'.$user->image));
// return response()->download(storage_path('app/public/userImages/' . $user->image));



        if($user && !empty($user->image)) {
            $filePath = storage_path('app/public/userImages/' . $user->image); 
    
            if(file_exists($filePath)) {

                return response()->download($filePath, $user->image);
                return response()->download($filePath);
            }
        }
    
        // Handle the case where the user or the image does not exist
        return response()->json(['error' => 'User or image not found.'], 404);
    }






}
