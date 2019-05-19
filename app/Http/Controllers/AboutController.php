<?php

namespace App\Http\Controllers;

use App\cms\about;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
   */

    public function index()
    {
        $abouts = about::orderBy('id', 'desc')->get();
        return response($abouts,Response::HTTP_OK);
    }
    public function UpdateBGImage(Request $request){
      if($request->hasfile('imgs')  && $request->id==""){
        $updateOld = about::where('selected',1)->update(['selected'=>0]);
        $files = $request->imgs;
        $email = auth()->user()->email;
        foreach($files as $file){
        $photoName = "uploads/backgrounds/".time().$file->getClientOriginalName();
        $file->move(public_path('uploads/backgrounds/'), $photoName);
        $about = new about;
        $about->type = 'body';
        $about->content = "";
        $about->selected = 1;
        $about->owner = auth()->user()->email;
        $about->images = $photoName;
        $about2 = $about;
        $about->save();
       }
      }
      if($request->id!=""){
        $changeOld = about::where('selected',1)->update(['selected'=>0]);
        $about = about::where('id',$request->id)->update(['selected'=>1]);
        $about2="";
      }
      return response($about2,200);
    }

    public function editBG_Color(Request $request){
        $color = $request->color;
        $type = $request->type;
        about::where([['type','=',$type],['owner','=',auth()->user()->email]])->update(array('content'=>$color,'images'=>''));
    }
    public function Slider(){
      $slides = about::where('type','slider')->orderBy('id', 'desc')->get();
      return response($slides,Response::HTTP_OK);
    }
    public function deleteSlider(Request $request){
       $about = about::where([['owner','=',auth()->user()->email],['id','=',$request->id]])->get();
       unlink($about[0]->images);
       $delete = about::where([['owner','=',auth()->user()->email],['id','=',$request->id]])->delete();
       return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
        Create a about
         request file and check data fields for data first above
         **/
         $string="";
         if($request->hasfile('imgs')){
           $files = $request->img;
           foreach($files as $file){
           $photoName = "uploads/".time().$file->getClientOriginalName();
           $file->move(public_path('uploads'), $photoName);
           $string= $string."$!$".$photoName;
          }
         }
        $content =  $request->content;
        $about = new about([
          'content'=>$content,
          'type'=>"",
          'owner'=>auth()->user()->email,
          'images'=>$string
        ]);
        $about->save();

        //Return data to vue array
        return response($about,Response::HTTP_OK);
    }
    public function addSlide(Request $request){
      $string="";
      if($request->hasfile('imgs')){
        $files = $request->imgs;
        foreach($files as $file){
        $photoName = "uploads/".time().$file->getClientOriginalName();
        $file->move(public_path('uploads'), $photoName);
        $content =  $request->content;
        $about = new about([
          'content'=>$content,
          'type'=>$request->type,
          'owner'=>auth()->user()->email,
          'images'=>$photoName
        ]);
        $about->save();
       }
      }
      return response($about,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cms\about  $about
     * @return \Illuminate\Http\Response
     */
    public function show(about $about)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cms\about  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, about $about)
    {
        $data = $request->validate([
          'content' => 'required|string',
          'owner'=>'required|string',
        ]);
        $about = about::where('id',$request->id)->update($data);
        return response($about,200);
   }
  public function UpdateSlider(Request $request){
    // $data = $request->validate([
    //   'content' => 'required|string',
    // ]);
    // $about = about::where('type',"slider")->update($data);
    // return response($about,200);
  }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cms\about  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //about::destroy($about);
        //return $request->about;
        about::where('id',$request->About)->delete();
    }
}
