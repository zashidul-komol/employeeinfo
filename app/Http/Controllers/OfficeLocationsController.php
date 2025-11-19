<?php

namespace App\Http\Controllers;
use App\Models\OfficeLocation;
use Illuminate\Http\Request;

class OfficeLocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $officelocations = OfficeLocation::get();
        return view('officelocations.index', compact('officelocations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('officelocations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $request->validate([
            'name' => 'required|unique:office_locations,name',
            'address' => 'required|max:100|unique:office_locations,address',
            'status' => 'required',
        ]);
        //$data['sequence'] = Department::max('sequence') + 1;
        $officelocations = OfficeLocation::create($data);
        if ($officelocations) {
            $message = "You have successfully created";
            return redirect()->route('officelocations.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('officelocations.index', [])
                ->with('flash_danger', $message);
        }
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
        $officelocations = OfficeLocation::findOrFail($id);
        return view('officelocations.edit', compact('officelocations'));
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
        $data = $request->except('_method', '_token');
        $validated = $request->validate([
            'name' => 'required|unique:office_locations,name,' . $id,
            'address' => 'required|max:100|unique:office_locations,address,' . $id,
            'status' => 'required',
        ]);

        $officelocations = OfficeLocation::whereKey($id)->update($validated);
        if ($officelocations) {
            $message = "You have successfully updated";
            return redirect()->route('officelocations.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('officelocations.index', [])
                ->with('flash_warning', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $officelocations = OfficeLocation::destroy($id);
        if ($officelocations) {
            $message = "You have successfully deleted";
            return redirect()->route('officelocations.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('officelocations.index', [])
                ->with('flash_danger', $message);
        }
    }

    
}
