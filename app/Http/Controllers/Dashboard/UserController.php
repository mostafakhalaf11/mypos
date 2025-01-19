<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:read_users')->only(['index', 'show']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::when($request->search ,function($query) use($request){
                return $query->where('first_name','like','%'.$request->search.'%')
                ->orWhere('last_name','like','%'.$request->search.'%');
        })
        ->whereRoleIs('admin')
        ->paginate(3);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
    //    dd($request->all());
        $user_data = $request->validated();
        if($request->image){
            Image::make($request->image)->resize(300,null,function($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/'.$request->image->hashName()));
            $user_data['image'] = $request->image->hashName();
        }
        $user_data['password'] = bcrypt($user_data['password']);
        $user = new User();
        $user->fill($user_data);
        $user->save();
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        return redirect()->route('dashboard.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // dd($user);
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user_data = $request->validated();
        if($request->image){
            if($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
            }
            Image::make($request->image)->resize(300,null,function($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/'.$request->image->hashName()));
            $user_data['image'] = $request->image->hashName();
        }
        if( ! empty($user_data['password']) ){
            $user_data['password'] = bcrypt($user_data['password']);
        }
        $user->update($user_data);
        $user->syncPermissions($request->permissions);
        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        }
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('success', 'User deleted successfully.');
    }
}
