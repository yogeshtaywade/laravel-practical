<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
         $users = User::whereHas('roles', function($q) {
                    $q->where('name', 'user');
                })->latest()->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:190',
            'last_name' => 'required|min:3|max:190',
            'phone' => 'required',
         ]);
        
        $user = User::findOrFail($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        if ($user->update()) {
            return redirect(route('user.index'));
        } else {
            return redirect()->back();
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function ajaxImage(Request $request) {

        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(), [
                        'file' => 'image',], [
                        'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
            }
            $user = User::find($request->user_id);
            if ($request->hasFile('file')) {
                $userimage = $request->file('file');
                $filename = 'user' . time() . preg_replace('/\..+$/', '', $request->file('file')->getClientOriginalName());
                $image = Image::make($userimage);
                Storage::put('image/' . $filename . '.' . $request->file('file')->getClientOriginalExtension(), (string) $image->encode());
                $user->image = $filename . '.' . $request->file('file')->getClientOriginalExtension();
            } else {
                $user->image = null;
            }
            $user->save();
            return $user;
        }
    }

}
