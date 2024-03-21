<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //show all listings
    public function index(Request $request){
        // dd($request->tag);
        // $listings=Listing::where()
        $listings= Listing::latest()->filter(request(['tag', 'search']))->Paginate(6);// (simplePaginate )     can add this if you want show next & prevoius not numeric
        return view('listings.index',['listings'=>$listings]);
    }

    //show single listing
    public function show(Listing $listing){
        return view('listings.show',['listing'=>$listing]);
    }
    //create single listing
    public function create(){
        return view('listings.create');
    }
    //store listing
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'company' => 'required|unique:listings',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'description' => 'required',
            'tags' => 'required',
            'user_id' => auth()->id()


        ]);
        if($request->hasFile('logo')){
            $validated['logo']=$request->file('logo')->store('logos','public'); // get path
        }
Listing::create($validated);
// $list=Listing::create($validated);
// Listing::find($list->id)->user_id=auth()->id();
//    dd(Listing::find($list->id)->user_id);

 return redirect('/')->with('message','Listing Created Successfully');
    }
    public function edit(Listing $listing){
        return view('listings.edit',['listing'=>$listing]);
    }
    public function updata(Request $request,Listing $listing){
        if($listing->user_id!=auth()->id()){
            abort('403','unauthorized action');
        }
        $validated = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'description' => 'required',
            'tags' => 'required',


        ]);
        if($request->hasFile('logo')){
            $validated['logo']=$request->file('logo')->store('logos','public'); // get path
        }
        // dd($validated);
        $listing->update($validated) ;
 return back()->with('message','Listing Updated Successfully');


    }
    public function destroy(Listing $listing){
        if($listing->user_id!=auth()->id()){
            abort('403','unauthorized action');
        }
        $listing->delete() ;
 return redirect('/')->with('message','Listing Deleted Successfully');


    }
    public function manage(){
        return view('listings.manage',['listings'=>Listing::all()]);
}
}
