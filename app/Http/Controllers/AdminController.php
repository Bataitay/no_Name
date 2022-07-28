<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Provinces;
use App\Models\User;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use cnviradiya\LaravelFilepond\Filepond;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $province = Provinces::where('id', $user->province_id)->first();
        $district = Districts::where('id', $user->district_id)->first();
        $ward = Wards::where('id', $user->ward_id)->first();

        return view('Backend.Profile.index', [
            'user' => $user,
            'province' => $province,
            'district' => $district,
            'ward' => $ward,
        ]);
    }

    public function storeprofile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $provinces = Provinces::all();
        $districts = Districts::where('province_id', $user->province_id)->get();
        $wards = Wards::where('district_id', $user->district_id)->get();

        return view(
            'Backend.Profile.update',
            [
                'user' => $user,
                'provinces' => $provinces,
                'districts' => $districts,
                'wards' => $wards,
            ]
        );
    }
    public function uploadImage(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
            $path = 'storage/' . $request->file('profile_image')->store('/uploads', 'public');
            $data->image = $path;
            $data->save();
        }

    }

    public function updateprofile(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;
        $data->address = $request->address;
        $data->gender = $request->gender;
        $data->day_of_birth = $request->day_of_birth;
        $data->start_day = $request->start_day;
        $data->phone = $request->phone;
        $data->ward_id = $request->ward_id;
        $data->district_id = $request->district_id;
        $data->province_id = $request->province_id;
        $data->note = $request->note;



        // $path = $filepond->getPathFromServerId($request->input('profile_image')); // Here upload_file is your name of your element
        // $pathArr = explode('.', $path);
        // $imageExt = '';
        // if (is_array($pathArr)) {
        //     $imageExt = end($pathArr);
        // }
        // $fileName = 'profile_image.' . $imageExt;
        // $finalLocation = storage_path('uploads/' . $fileName);
        // \File::move($path, $finalLocation);
        try {
            $data->save();
            $notification = [
                'message' => 'update profile successFully',
                'alert-type' => 'success',
            ];

            return redirect()->route('admin.profile')->with($notification);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $notification = [
                'message' => 'update profile Fail !!!',
                'alert-type' => 'warning',
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function Changepassword()
    {
        return view('Backend.Profile.changepassword');
    }

    public function updatepassword(Request $request)
    {
        $validation = $request->validate([
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        $hashedPassword = Auth::user()->password;
        try {
            if (Hash::check($request->old_password, $hashedPassword)) {
                $users = User::find(Auth::id());
                $users->password = bcrypt($request->new_password);
                $users->save();
                session()->flash('message', 'Change Password successFully');

                return redirect()->back();
            } else {
                session()->flash('message', 'Old password is not correct');

                return redirect()->back();
            }
        } catch (\Throwable $e) {
            report($e);
            session()->flash('message', 'Change Password fail!');

            return redirect()->back();
        }
    }

    public function dashboard()
    {
        return view('Backend.dashboard');
    }
}
