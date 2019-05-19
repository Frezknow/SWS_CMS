<?php

namespace App\Http\Controllers;

use App\cms\contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use File;
use DateTime;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = contact::all();
        return response($contacts,Response::HTTP_OK);

    }
    public function UpdateBGImage(Request $request){
      if($request->hasfile('imgs') && $request->id==""){
        $updateOld = contact::where('selected',1)->update(['selected'=>0]);
        $files = $request->imgs;
        foreach($files as $file){
        $photoName = "uploads/backgrounds/".time().$file->getClientOriginalName();
        $file->move(public_path('uploads/backgrounds/'), $photoName);
        $contact = new contact;
        $contact->type = 'body';
        $contact->content = "";
        $contact->selected = 1;
        $contact->owner = auth()->user()->email;
        $contact->images = $photoName;
        $contact2=$contact;
        $contact->save();
        // where([['type','=','body'],['owner','=',auth()->user()->email]])
        // ->update(['images'=>$photoName]);
       }
      }
      if($request->id!=""){
        $changeOld = contact::where('selected',1)->update(['selected'=>0]);
        $contact = contact::where('id',$request->id)->update(['selected'=>1]);
        $contact2="";
      }
      return response($contact2,200);
    }
    public function updateFormVerbage(Request $request,contact $contact){
     contact::where([['owner','=',auth()->user()->email],['id','=',$request->id]])->update(['content'=>$request->FormVerbage]);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cms\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,contact $contact)
    {
        $data = $request->validate([
          'content'=>'required',
        ]);
        $contact =contact::where([['id','=',$request->id],['owner','=',auth()->user()->email]])->update($data);
        return response($contact,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cms\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(contact $contact)
    {
        //
    }
    public function email(Request $request){
      $objDemo = new \stdClass();
        $objDemo->name = $request->name;
        $objDemo->content = $request->content;
        $objDemo->email = $request->email;
        //$objDemo->phone = $request->phone;

        Mail::to("frezknow@gmail.com")->send(new ContactUs($objDemo));
    }
    public function editBG_Color(Request $request){
        $color = $request->color;
        $type = $request->type;
        contact::where([['type','=',$type],['owner','=',auth()->user()->email]])->update(array('content'=>$color,'images'=>''));
    }
}
