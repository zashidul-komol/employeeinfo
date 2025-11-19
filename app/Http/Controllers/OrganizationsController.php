<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$organizations = Organization::get();
        return view('organizations.index', compact('organizations'));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('organizations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$data = $request->all();
        $request->validate([
            'organization' => 'required|unique:organizations,organization',
            'short_name' => 'required|max:10|unique:organizations,short_name',
            'status' => 'required',
        ]);
        //$data['sequence'] = Department::max('sequence') + 1;
        $organizations = Organization::create($data);
        if ($organizations) {
            $message = "You have successfully created";
            return redirect()->route('organizations.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('organizations.index', [])
                ->with('flash_danger', $message);
        }
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$organizations = Organization::findOrFail($id);
		return view('organizations.edit', compact('organizations'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$data = $request->except('_method', '_token');
		$validated = $request->validate([
			'organization' => 'required|unique:organizations,organization,' . $id,
			'short_name' => 'required|max:10|unique:organizations,short_name,' . $id,
			'status' => 'required',
		]);

		$organizations = Organization::whereKey($id)->update($validated);
		if ($organizations) {
			$message = "You have successfully updated";
			return redirect()->route('organizations.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('organizations.index', [])
				->with('flash_warning', $message);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$msg = $this->checkUses($id, 'organization_id', 'User');
		if ($msg != 'no') {
			return $msg;
		}
		$organizations = Organization::destroy($id);
		if ($organizations) {
			$message = "You have successfully deleted";
			return redirect()->route('organizations.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('organizations.index', [])
				->with('flash_danger', $message);
		}
	}

	public function download() {
        return (new DepartmentExport())->download('department.xlsx');
    }

	
}

