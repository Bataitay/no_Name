<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Employee access|Employee create|Employee edit|Employee delete', ['only' => ['index']]);
        $this->middleware('role_or_permission:Employee viewAny', ['only' => ['index']]);
        $this->middleware('role_or_permission:Employee create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Employee update', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Employee delete', ['only' => ['destroy']]);
    }
    public function index(){
        $employees = User::latest()->get();
        return view('Backend.employees.index', compact('employees'));
    }
    public function create(){
        $roles = Role::all();
        return view('Backend.employees.add',compact('roles'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);
        $employee =  User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        ]);
        $employee->syncRoles($request->roles);
        return redirect()->route('employee.index')->withSuccess('Added ployee successfully!!!');
    }
    public function show($id){

    }
    public function edit(User $employee){
        $role = Role::get();
        $employee->roles;
        return view('Backend.employees.edit', [
            'employee' => $employee,
            'roles' => $role,
        ]);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name'=>'required',
        ]);

        $employee = User::findOrFail($id);
        $employee->name = $request->name;

        $employee->syncRoles($request->roles);
        $employee->save();
        return redirect()->route('employee.index')->withSuccess('User updated !!!');
    }
}
