<?php

namespace App\Http\Controllers;

use BackedEnum;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    // Lists of users screen
    public function index()
    {
        $page = request('page', 1);
        $pageSize = request('page-size', 6);
        $users = User::latest()->filter(request(['search']))->paginate($pageSize, '*', 'page', $page);
        return view('users.index', compact('users'));
    }

    // Create User Screen
    public function create()
    {
        return view('users.create');
    }

    // Create User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6'],
            'phone' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'is_admin' => 'required',
        ]);

        $tmp_file = TemporaryFile::where('folder', $request->image)->first();

        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['image'] = $tmp_file ? $tmp_file->folder . '/' . $tmp_file->file : null;
        User::create($formFields);

        if($tmp_file) {
            Storage::copy('public/posts/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, 'public/posts/' . $tmp_file->folder . '/' . $tmp_file->file);
        }
        Storage::deleteDirectory('public/posts/tmp/' . $tmp_file?->folder);
        $tmp_file?->delete();

        return redirect('/users')->with('message', 'User created successfully!');
    }

    // User Detail Screen
    public function show(User $userId)
    {
        return view('users.show', ['user' => $userId]);
    }

    // User Profile Screen
    public function profile(User $userId)
    {
        return view('users.profile', ['user' => $userId]);
    }

    // User Edit Screen
    public function edit(User $userId)
    {
        return view('users.edit', ['user' => $userId]);
    }

    // Update User
    public function update(Request $request, User $userId)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'nullable',
            'dob' => 'nullable',
            'is_admin' => 'required',
            'address' => 'nullable',
        ]);

        $tmp_file = TemporaryFile::where('folder', $request->image)->first();

        if ($tmp_file) {
            $formFields['image'] = $tmp_file ? $tmp_file->folder . '/' . $tmp_file->file : null;
            Storage::copy('public/posts/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, 'public/posts/' . $tmp_file->folder . '/' . $tmp_file->file);
            Storage::deleteDirectory('public/posts/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
        } elseif ($userId->image) {
            $formFields['image'] = $userId->image;
        } else {
            $formFields['image'] = null;
        }

        unset($formFields['password']);
        $formFields['is_admin'] = $formFields['is_admin'] === 'admin' ? 1 : 0;

        $userId->update($formFields);

        return back()->with('message', 'User updated successfully!');
    }

    // User Delete
    public function destroy(User $userId)
    {
        $userId->delete();
        return redirect('/users')->with('message', 'User deleted successfully!');
    }

    // User Registration Screen
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // User Registration
    public function submitRegistrationForm(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
        $user = User::create($formFields);

        auth()->login($user);
        return redirect('/')->with('message', 'You are registered!');
    }

    // Change password
    public function changePassword()
    {
        return view('auth.changePassword');
    }
    public function updatePassword(Request $request)
    {
        $formFields = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        if(!Hash::check($formFields['old_password'], auth()->user()->password)) {
            return back()->with('error-message', 'Your old password does not match!');
        }

        $formFields['password'] = bcrypt($formFields['new_password']);
        User::where('id', auth()->user()->id)->update(['password' => $formFields['password']]);

        return back()->with('message', 'Password changed successfully!');
    }

    // User Login Screen
    public function login()
    {
        return view('auth.login');
    }

    // User Login
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            if(isset($request->remember) && !empty($request->remember)) {
                setcookie('email', $formFields['email'], time() + 3600);
                setcookie('password', $formFields['password'], time() + 3600);
            } else {
                setcookie('email', '');
                setcookie('password', '');
            }
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // User Logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'You have been logged out!');
    }

    // Upload Temporary Profile
    public function tmpUpload(Request $request)
    {
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $folder = 'post_' . uniqid('', true);
            $image->storeAs('public/posts/tmp/' . $folder, $file_name);

            TemporaryFile::create([
                'folder' => $folder,
                'file' => $file_name
            ]);
            return $folder;
        }
        return '';
    }

    // Delete Temporary Upload Profile
    public function tmpDelete()
    {
        $tmp_file = TemporaryFile::where('folder', request()->getContent())->first();
        if($tmp_file) {
            Storage::deleteDirectory('public/posts/tmp/'. $tmp_file->folder);
            $tmp_file->delete();
            return response('');
        }
    }

    public function clearProfileImage($userId)
    {
        // dd($userId);
        $user = User::find($userId);
        if($user) {
            $user->image = null;
            $user->save();
        }

        return back()->with('message', 'Remove profile image successfully!');
    }

}
