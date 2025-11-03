<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Department;
use App\Employee;
use Illuminate\Http\Request;

class SuppliersController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$suppliers = Supplier::get();
		return view('suppliers.index', compact('suppliers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

	$employee = Employee::with(['family_details' => function ($q) {
                return $q->select('*');
            },
            'employee_educations'=>function($q){
                return $q->select('*');
            },
        ])
	->where('id',7)
        ->first();
        //dd ($employee->polar_id);
		/*
        if ($id > 0) {

			$item = Item::findOrFail($id);

			$settlements = \App\Settlement::where('item_id', $item->id)->first();

			$dfproblems = DfProblem::with([
				'complain_types' => function ($q) {
					return $q->with('problem_type')
						->select('df_problem_id', 'problem_type_id');
				},
				'region' => function ($q) {
					return $q->select('id', 'name');
				},
				'depot' => function ($q) {
					return $q->select('id', 'name');
				},
				'distributor' => function ($q) {
					return $q->select('id', 'outlet_name');
				},
				'technician' => function ($q) {
					return $q->select('id', 'name', 'mobile');
				},
				'officer' => function ($q) {
					return $q->with(['designation' => function ($dq) {
						$dq->select('id', 'short_name');
					}])
						->select('id', 'name', 'designation_id', 'mobile');
				},
			])
				->where('df_code', $item->serial_no)
				->orderBy('updated_at', 'desc')
				->get();

			return view('services.show_history', compact('item', 'dfproblems', 'settlements'));
		} else {
			return view('services.history');
		}
		*/
		$departments = Department::pluck('name','id');
		//dd($departments->toArray());
		return view('suppliers.create',compact('departments','employee'));
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
			'name' => 'required|unique:suppliers',
		]);

		$suppliers = Supplier::create($data);
		if ($suppliers) {
			$message = "You have successfully created";
			return redirect()->route('suppliers.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('suppliers.index', [])
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
		$suppliers = Supplier::findOrFail($id);
		return view('suppliers.edit', compact('suppliers'));
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
		$request->validate([
			'name' => 'required|unique:suppliers,name,' . $id,
		]);

		$suppliers = Supplier::where('id', $id)->update($data);
		if ($suppliers) {
			$message = "You have successfully updated";
			return redirect()->route('suppliers.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('suppliers.index', [])
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
		$suppliers = Supplier::destroy($id);
		if ($suppliers) {
			$message = "You have successfully deleted";
			return redirect()->route('suppliers.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('suppliers.index', [])
				->with('flash_danger', $message);
		}
	}
}
