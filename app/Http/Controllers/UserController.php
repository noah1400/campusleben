<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class UserController extends Controller
{
    /**
     * Show saved data of authenticated user.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showdata(){
        $user = auth()->user();
        return view('userdata.showdata', compact('user'));
    }

    /**
     * Show the page for deleting saved data of authenticated user.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deletedataShow(){
        return view('userdata.deletedata');
    }

    /**
     * Delete saved data of authenticated user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletedata(Request $request){
        $user = auth()->user();
        $user->events()->detach();
        if($request->has('delete_account')){
            auth()->logout();
            $user->delete();
        }
        return redirect()->route('events.index');
    }
}
