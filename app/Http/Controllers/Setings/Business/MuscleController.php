<?php

namespace App\Http\Controllers\Setings\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Muscle;

class MuscleController extends Controller
{
    public function index()
    {
    	$muscles = Muscle::orderBy('created_at', 'DESC')->get();
    	return view('muscle.index', compact('muscles'));
    }

    public function create()
    {
    	return view('muscle.add');
    }

    public function edit(Request $request)
    {
    	$id = $request->id;
    	$muscle = Muscle::where('id', $id)->first();

    	return view('muscle.edit', compact('muscle'));
    }


    public function store(Request $request)
    {
    	$request->validate([
    		'title' => 'required'

    	],[

    		'title.required' => 'Muscle Name is required'
    	]);

    	$muscle = new Muscle;
    	$muscle->title = $request->title;
    	$muscle->region = $request->region;
    	$muscle->general_description = $request->general_description;
    	$muscle->related_muscle = $request->related_muscle;
    	$muscle->antagonist = $request->antagonist;
    	$muscle->common_injuries = $request->common_injuries;
    	$muscle->resistance_exercises = $request->resistance_exercises;
    	$muscle->stretches = $request->stretches;
    	$muscle->origin = $request->origin;
    	$muscle->insertion = $request->insertion;
    	$muscle->major_arteries = $request->major_arteries;
    	$muscle->neural_innervation = $request->neural_innervation;
    	$muscle->concentric = $request->concentric;
    	$muscle->eccentric = $request->eccentric;
    	$muscle->isometric_function = $request->isometric_function;
    	$muscle->status = 1;
        if (!empty($request->cover_image)) {
            $muscle->cover_image = $request->cover_image;
        }
        if (!empty($request->image)) {
            $muscle->image = $request->image;
        }

    

    	$muscle->save();

    	$url = route('muscle.list');
    	$msg = 'Muscle stored successfully';

    	\Session::flash('status', $msg);

    	return response()->json([ 'msg' => $msg, 'url' => $url, 'status' => true ]);
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'title' => 'required'

    	],[

    		'title.required' => 'Muscle Name is required'
    	]);


    	$muscle = Muscle::where('id', $request->id)->first();
    	$muscle->title = $request->title;
    	$muscle->region = $request->region;
    	$muscle->general_description = $request->general_description;
    	$muscle->related_muscle = $request->related_muscle;
    	$muscle->antagonist = $request->antagonist;
    	$muscle->common_injuries = $request->common_injuries;
    	$muscle->resistance_exercises = $request->resistance_exercises;
    	$muscle->stretches = $request->stretches;
    	$muscle->origin = $request->origin;
    	$muscle->insertion = $request->insertion;
    	$muscle->major_arteries = $request->major_arteries;
    	$muscle->neural_innervation = $request->neural_innervation;
    	$muscle->concentric = $request->concentric;
    	$muscle->eccentric = $request->eccentric;
    	$muscle->isometric_function = $request->isometric_function;
    	$muscle->status = 1;

        if (!empty($request->cover_image)) {
            $muscle->cover_image = $request->cover_image;
        }
        if (!empty($request->image)) {
            $muscle->image = $request->image;
        }

    	// if (isset($request->image) && !empty($request->image)) {

     //        $imageName = uploadFile($request, 'image', muscleImageUploadPath());

     //        if ($imageName != "") {
     //            $muscle->image = $imageName;
     //        }
     //     }

     //    if (isset($request->cover_image) && !empty($request->cover_image)) {

     //        $imageName = uploadFile($request, 'cover_image', muscleImageUploadPath());

     //        if ($imageName != "") {
     //            $muscle->cover_image = $imageName;
     //        }
     //    }

    	$muscle->save();

    	$url = route('muscle.list');
    	$msg = 'Muscle updated successfully';

    	\Session::flash('status', $msg);
    	
    	return response()->json([ 'msg' => $msg, 'url' => $url, 'status' => true ]);
    }

    public function delete(Request $request)
    {
    	$id = $request->id;

    	Muscle::where('id', $id)->delete();

    	\Session::flash('status', 'Muscle deleted successfully');
    	return response()->json([ 'msg' => 'Muscle deleted successfully', 'status' => true ]);
    }

    public function view(Request $request)
    {
        $muscle = Muscle::where('id', $request->id)->firstorfail();

        return view('muscle.view', compact('muscle'));
    }
}
