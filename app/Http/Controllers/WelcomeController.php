<?php

namespace App\Http\Controllers;

use App\cms\welcome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use File;
use DateTime;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $welcomes = welcome::orderBy('id', 'desc')->get();
        return response($welcomes,Response::HTTP_OK);
    }
    public function UpdateBGImage(Request $request){
        if($request->hasfile('imgs') && $request->id==""){
        $updateOld = welcome::where('selected',1)->update(['selected'=>0]);
        $files = $request->imgs;
        foreach($files as $file){
        $photoName = "uploads/backgrounds/".time().$file->getClientOriginalName();
        $file->move(public_path('uploads/backgrounds/'), $photoName);
        $welcome = new welcome;
        $welcome->type = 'body';
        $welcome->selected =1;
        $welcome->content = '';
        $welcome->owner = auth()->user()->email;
        $welcome->images = $photoName;
        $welcome2 = $welcome;
        $welcome->save();
       }
      }
      if($request->id!=""){
        $email = auth()->user()->email;
        $changeOld = welcome::where([['selected','=',1],['owner','=',$email]])->update(['selected'=>0]);
        $welcome = welcome::where([['owner','=',$email],['id','=',$request->id]])->update(['selected'=>1]);
        $welcome2="";
      }
      return response($welcome2,200);
    }
    public function editBG_Color(Request $request){
        $color = $request->color;
        $type = $request->type;
        welcome::where([['type','=',$type],['owner','=',auth()->user()->email]])->update(array('content'=>$color,'images'=>""));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /**
      Create a welcome
       request file and check data fields for data first above
       **/
       $string="";
       if($request->hasfile('imgs')){
         $files = $request->imgs;
         foreach($files as $file){
         $photoName = "uploads/".time().$file->getClientOriginalName();
         $file->move(public_path('uploads'), $photoName);
         $string= $string."$!$".$photoName;
        }
       }
      $content =  $request->content;
      $welcome = new welcome([
        'content'=>$content,
        'type'=>'',
        'owner'=>auth()->user()->email,
        'images'=>$string
      ]);
      $welcome->save();

      //Return data to vue array
      return response($welcome,Response::HTTP_OK);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cms\welcome  $welcome
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cms\welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, welcome $welcome)
    {
        $data = $request->validate([
          'content'=>'required',
        ]);
        $welcome = welcome::where('id',$request->id)->update($data);
        return response($welcome,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cms\welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         welcome::where('id',$request->Welcome)->delete();
    }
}
