<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Uservalidation;
use App\Http\Requests\UserUpdateValidaion;
use Illuminate\Notifications\Notification;
use App\Notifications\UserRegistered;
use App\Notifications;
use Auth;

class UserController extends Controller
{
    protected $User = null;

    public function __construct(User $User)
    {
        $this->User = $User;
    }

    public function index()
    {

        return User::latest()->paginate();
//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Uservalidation $request)
    {
        $data = $request->all();
        $this->User->fill($data);
        $this->User->save();

        $user = User::where('type', 'Admin')->get();
        foreach ($user as $user)
            $user->notify(new \App\Notifications\UserRegistered());

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateValidaion $request, $id)
    {
        $user = User::findorfail($id);
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

    }

    public function notification(){
      $id=Auth::user()->id;
      return Notifications::where('notifiable_id',$id)->where('read_at',null)->latest()->paginate();;
    }
}
