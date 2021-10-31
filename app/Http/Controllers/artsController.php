<?php

namespace App\Http\Controllers;

use App\Models\at;
use App\Models\User;
use Illuminate\Http\Request;

class artsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        // return 'hi';
       
       $auth_id = auth()->user()->id;
       if(auth()->user()->usertype == 'artist'){
        $arts = At::where('user_id', '!=', $auth_id)->orderBy('created_at','DESC')->get();
         return view('arts.index',compact('arts'));
       }elseif(auth()->user()->usertype == 'user'){
           $allarts = at::orderBy('created_at','DESC')->get();
        //    return $allarts;
               return view('arts.indexall',compact('allarts'));
       }
       elseif(auth()->user()->usertype == 'admin'){
        $allarts = at::orderBy('created_at','DESC')->get();
        return view('arts.adminindexall',compact('allarts'));
       }

    }
//my arts
    public function arts($id){
        $user = User::findorFail($id);
         $arts = at::where('user_id','=',$user->id)->orderBy('created_at','DESC')->get();
         if($arts){
             return view('arts.myarts',compact('arts'));
         }else{
             return '404';
         }
        
    }
    //artists to create an art
    public function create(){
       if(auth()->user()->usertype  == 'artist'){
        return view('arts.create');
       }else{
           return redirect()->route('home')->with('error','not allowed to create an Art');
       }
       
       
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
       ]);
        //

         if ($request->hasFile('art')) {
            $filenamewithext = $request->file('art')->getClientOriginalName();
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $ext = $request->file('art')->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $ext;
            $path = $request->file('art')->storeAs('public/art', $filenametostore);
        } else {
            $filenametostore = 'noimage.jpg';
        }

                  $art = new at;
                    $art->image = $filenametostore; 
                    $art->name = $request->input('name');
                    $art->description = $request->input('description');
                    $art->price= $request->input('price');
                    $art->user_id= auth()->user()->id;
                    $art->save();
           return redirect()->back()->with('success','art Added successfully');
    }

    //show specific art

    public function show($id){
        //  dd($id);
        $art = at::findorFail($id);
        if(auth()->user()->usertype == 'artist'){
            return view('arts.artist.show',['art'=>$art]);
           }elseif(auth()->user()->usertype == 'user'){ 
            return view('arts.user.show',['art'=>$art]);
           }
           elseif(auth()->user()->usertype == 'admin'){
            return view('arts.admin.show',['art'=>$art]);
           }
    
    }
    public function edit($id){
        $art = at::findorFail($id);
        // dd($art);
        return view('arts.artist.editart',compact('art'));
    }
    public function update(Request $request,$id){
        // $auth_id = auth()->user()->id;
        $art = at::findorFail($id);
        $art->name = $request->name;
        $art->price = $request->price;
        $art->description = $request->description;
        $art->save();
        return redirect()->route('showArt',[$id])->with('success','arts updated successfully');
    }
    public function destroy($id){
        $art = at::findorFail($id);
        $art->delete();
        return back()->with('success','art deletd successfully');

    }



}
