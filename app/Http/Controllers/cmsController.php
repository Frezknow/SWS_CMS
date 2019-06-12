<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\user;
use App\cms\welcome;
use App\cms\about;
use App\cms\contact;
class cmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $layout = explode(",",auth()->user()->layouts)[0];
         return view('layouts.CMS.welcome',['user'=>auth()->user(),'layout'=>$layout]);
    }
    public function user(){
      $user = auth()->user();
      return response($user,200);
    }
    public function updateLayouts(Request $request){
      $page = $request->page;
      $layout = $request->layout;
      //Below will need to change
      $old = user::where('email',auth()->user()->email)->get();

      $layouts = $old[0]->layouts;
      $layouts = explode(',',$old[0]->layouts);
      $layouts[$page] = $layout;
      $layouts = implode(",",$layouts);
      $new = user::where('email',auth()->user()->email)->update(array('layouts'=>$layouts));

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function about(){
        $layout = explode(",",auth()->user()->layouts)[1];
        return view('layouts.CMS.about',['user'=>auth()->user(),'layout'=>$layout]);
    }
    public function contact(){
        $layout = explode(",",auth()->user()->layouts)[2];
        return view('layouts.CMS.contact',['user'=>auth()->user(),'layout'=>$layout]);
    }
    public function services(){
     $layout = explode(",",auth()->user()->layouts)[3];
     return view('layouts.CMS.services',['user'=>auth()->user(),'layout'=>$layout]);
    }
    public function GetBackgroundImages(Request $request){
      $page = $request->page;
      $query="";
      if($page=="welcome")$query = welcome::where('type','body')->get();
      if($page=="about")$query = about::where('type','body')->get();
      if($page=="contact")  $query = contact::where('type',"body")->get();
      return response($query,Response::HTTP_OK);
    }
}
