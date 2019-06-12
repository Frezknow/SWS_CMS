<?php

namespace App\Http\Controllers;

use App\cms\services;
use Illuminate\Http\Request;
use App\Mail\ServiceRequest;
use Illuminate\Support\Facades\Mail;
use App\user;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //change to fit a website url
       $email = auth()->user()->email;
       $services = services::where('owner',$email)->get();
       return response($services,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $description = $request->description;
        $owner = auth()->user()->email;
        //$request->imgs
        $img= "";
        if($request->hasfile('imgs')){
          $imgs = $request->imgs;
          foreach($imgs as $img){
          $photoName = "uploads/".time().$img->getClientOriginalName();
          $img->move(public_path('uploads'), $photoName);
          $img = $photoName;
         }
        }
        $service = new services([
          'title'=>$title,
          'description'=>$description,
          'owner'=>$owner,
          'image'=>$img,
          'type'=>''
        ]);
        $service2 = $service;
        $service->save();
        return response($service2,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $service = services::find($id);
      $service =  $service->update($request->all());
      return response("Success",200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $service = services::find($request->Service);
        unlink($service->image);
        $service->delete();
    }
    public function UpdateBGImage(Request $request){
      if($request->hasfile('imgs')  && $request->id==""){
        $updateOld = services::where('selected',1)->update(['selected'=>0]);
        $files = $request->imgs;
        $email = auth()->user()->email;
        foreach($files as $file){
        $photoName = "uploads/backgrounds/".time().$file->getClientOriginalName();
        $file->move(public_path('uploads/backgrounds/'), $photoName);
        $services = new services;
        $services->type = 'body';
        $services->title ='';
        $services->description = "";
        $services->selected = 1;
        $services->owner = auth()->user()->email;
        $services->image = $photoName;
        $services2 = $services;
        $services->save();
       }
      }
      if($request->id!=""){
        $changeOld = services::where('selected',1)->update(['selected'=>0]);
        $services = services::where('id',$request->id)->update(['selected'=>1]);
        $services2="";
      }
      return response($services2,200);
    }
    // Possible issue here check into
    public function editBG_Color(Request $request){
        $color = $request->color;
        $type = $request->type;
        services::where([['type','=',$type],['owner','=',auth()->user()->email]])->update(array('description'=>$color,'image'=>''));
    }
    public function RequestService(Request $request){
      //add the url to the background image for this service into the email
      $service = $request->title;
      $email = $request->email;
      $message = $request->message;
      $name = $request->name;
      $img = $request->img;
      //This line will be dependant on config email
      $user = user::find(auth()->user()->id);
      $user->sr = $user->sr+1;
      $id = $user->sr+1;
      $user->save();

      $mailOBJ = new \stdClass();
      $mailOBJ->subject = $service;
      $mailOBJ->email = $email;
      $mailOBJ->name = $name;
      $mailOBJ->id = $id;
      $mailOBJ->img = $img;
      $mailOBJ->content = $message;
      //Below will need to be a set email in config for eaech client,
      //initially this is set to the session holder on the protfolio site.
        Mail::to(auth()->user()->email)->send(new ServiceRequest($mailOBJ));

    }
}
