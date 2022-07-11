<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{
    //show all listing
    public function index(/*Request $request*/){
        
        return view('listings.index',[
            "listings"=>Listing::latest()->filter(request(["tag","search"]))->paginate(6)
        ]);

    }

    // Single listing
    public function show(Listing $listing){
        return view('listings.show',[
            "listing"=>$listing
        ]);

    }

    public function create(){
        return view("listings.create");
    }
    public function store(Request $request){
        
        $formFields = $request->validate([
            "title"=>"required",
            "company"=>["required",Rule::unique("listings","company")],
            "location"=>"required",
            "website"=>["required ","url"],
            "email"=>["required","email"],
            "tags"=>"required",
            "description"=>"required"
        ]);

        if($request->hasFile("logo")){
            $formFields["logo"]=$request->file("logo")->store("logos","public");
            
        }
        $formFields["user_id"]=auth()->id();
        // dd($formFields);
        Listing::create($formFields);

        // Session::flash("message","listing created successfully!");
        return redirect("/")->with("message","Listing created successfully!");
    }

    //Show edit form
    public function edit(Listing $listing){
        
        if($listing->user_id !== auth()->id()){
            abort(403,"Unauthorized Action");
        }
        return view("listings.edit",["listing"=>$listing]);
    }

    public function update(Listing $listing){
        if($listing->user_id !== auth()->id()){
            abort(403,"Unauthorized Action");
        }
        $formFields=request()->validate([
            "title"=>"required",
            "company"=>"required",
            "location"=>"required",
            "website"=>["required ","url"],
            "email"=>["required","email"],
            "tags"=>"required",
            "description"=>"required"
        ]);
        if(request()->hasFile("logo")){
            $formFields["logo"]=request()->file("logo")->store("logos","public");
            
        }

        $listing->update($formFields);

        return back()->with("message","Listing updated successfully!");
    }



    public function destroy(Listing $listing){
        if($listing->user_id !== auth()->id()){
            abort(403,"Unauthorized Action");
        }

        $listing->delete();

        return redirect("/")->with("message","Listing deleted successfully!");
    }

    public function manage(){
        return view("listings.manage",["listings"=>auth()->user()->listings]);
    }
}

