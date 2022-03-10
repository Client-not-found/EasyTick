<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Ticket;
use App\Models\Group;
use App\Models\User;
use App\Models\Page;

class UserController extends Controller
{
    public function admin() {
        $this->authorize('view', User::class);
        return view('acp.user',[
        'users' => User::all(),
        'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function profile(int $id) {
        return view('profile',[
            'user' => User::where( "key", $id )->first(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function security() {
        return view('security', [
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function userDetails(Request $request, int $id)
    {
        $this->authorize('view', User::class);
        return view('acp.userdetails', [
            'user' => User::where( "key", $id )->first(),
            'groups' => Group::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);

    }

    public function newUser () {
        $this->authorize('create', User::class);
        return view('acp.newuser', [
            'groups' => Group::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }


    public function acpEdit ( Request $request, int $id ) {
        if($request->id == 1 || $request->id == 2 || $request->id == 3) {
            //dd($request);
            $this->authorize('update', User::class);
            $request->validate([
                'group' => 'required',
                'username' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'street' => 'required',
                'zip' => 'required',
                'city' => 'required',
                'state' => 'required',
            ]);

            DB::table('users')
                ->where('key', '=', $request->id)
                ->update(['groId' => $request->group,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'street' => $request->street,
                'zip' => $request->zip,
                'city' => $request->city,
                'state' => $request->state]);

            return view('acp.user', [
                'users' => User::all(),
                'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
            ]);
        } else {
            $this->authorize('update', User::class);
            $request->validate([
                'group' => 'required',
                'username' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'street' => 'required',
                'zip' => 'required',
                'city' => 'required',
                'state' => 'required',
                'mail' => 'required',
            ]);

            DB::table('users')
                ->where('key', '=', $request->id)
                ->update(['groId' => $request->group,
                'username' => $request->username, 
                'password' => bcrypt( $request->password ),
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'street' => $request->street,
                'zip' => $request->zip,
                'city' => $request->city,
                'state' => $request->state,
                'mail' => $request->mail]);

            return view('acp.user', [
                'users' => User::all(),
                'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
            ]);
        }

    }

    /*public function profilesave ( Request $request, int $id ) {
        //dd($request);
        $this->authorize('viewAny', User::class);
        $request->validate([
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);

        DB::table('users')
            ->where('key', '=', $id)
            ->update(['password' => bcrypt( $request->password ),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'street' => $request->street,
            'zip' => $request->zip,
            'city' => $request->city,
            'state' => $request->state,]);

        return view('profile', [
            'user' => User::where( "key", $id )->first(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
            ]);
    }*/

    public function acpDelete ( Request $request, int $id ) {

        $this->authorize('delete', User::class);
        DB::table('users')->where('key', '=', $request->id )->delete();

        return view('acp.user', [
            'users' => User::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
            ]);
    }

    public function acpSave ( Request $request ) {

        $this->authorize('create', User::class);
        $request->validate([
            'group' => 'required',
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'state' => 'required',
            'mail' => 'required',
        ]);
        //dd($request->zip);
        User::create([
            'groId' => $request->group,
            'username' => $request->username, 
            'password' => bcrypt( $request->password ),
            'password_confirmation'=> bcrypt( $request->password_confirmation),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'street' => $request->street,
            'zip' => $request->zip,
            'city' => $request->city,
            'state' => $request->state,
            'mail' => $request->mail,
        ]);

        return view('acp.user', [
            'users' => User::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
            ]);
    }

    public function save ( Request $request ) {

        $request->validate([
            //dd($request),
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'state' => 'required',
            'mail' => 'required',
        ]);
        //dd($request->zip);
        User::create([
            'groId' => $request->group,
            'username' => $request->username, 
            'password' => bcrypt( $request->password ),
            'password_confirmation'=> bcrypt( $request->password_confirmation),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'street' => $request->street,
            'zip' => $request->zip,
            'city' => $request->city,
            'state' => $request->state,
            'mail' => $request->mail,
        ]);

        return view('welcome', [
            'login' => Page::where( "name", 'Login' )->first(),
            ]);
    }

    public function register ( Request $request ) {
        return view('register', [
            'login' => Page::where( "name", 'Login' )->first(),
            ]);
    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

}
