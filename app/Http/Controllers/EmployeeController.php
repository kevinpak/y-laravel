<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeesValidation;
use App\Http\Requests\UpdateRequesValidation;
use App\Models\Employee;
use App\Models\EmployeeCategorie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class EmployeeController extends Controller
{


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allcategories = EmployeeCategorie::all();
        $employees = Employee::all();

        if(request()->ajax()) {
            return datatables()::of($employees)->addColumn('image', function ($employee) {
                return '<img src="'.Storage::url($employee->image).'" border="0" width="50" height="50" class="edit-employee rounded-circle" align="center" />';
            })->addColumn('action', function ($employee) {
                    return '<a href="javascript:void(0)"
                                    data-firstName="'.$employee->firstName.'"
                                    data-lastName="'.$employee->lastName.'"
                                    data-address="'.$employee->address.'"
                                    data-email="'.$employee->email.'"
                                    data-phone="'.$employee->phone.'"
                                    data-sex="'.$employee->sex.'"
                                    data-salary="'.$employee->salary.'"
                                    data-image="'.$employee->image.'"
                                    data-birthDate="'.$employee->birthDate.'"
                                    data-category="'.$employee->category->id.'"
                                    data-id='.$employee->id.'
                                    class="btn updateEmployee btn-sm btn-xs btn-primary">
                                     <i class="fas fa-user-edit"></i>
                                    </a>
                       <a href="javascript:void(0)" id="delete-employee" data-id='.$employee->id.' class="btn btn-sm btn-xs btn-danger"><i class="fas fa-trash"></i></a>';
            })->addColumn('name', function($name) {
                    return $name->firstName." ".$name->lastName;
            })->addColumn('job', function($job) {
                return $job->category->name;
        })->rawColumns(['image', 'action'])->make(true);

        }
        return view('employees')->with('allcategories',$allcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesValidation $request)
    {

        //default image url
        $image = "https://lorempixel.com/640/480/?60542";
        // if file image exist
        if($request->file('image')){
            $image = upload_image($request, "employee");
        }
        $employee = Employee::create([
            "firstName"=> $request->firstName,
            "lastName" => $request->lastName,
            "email" => $request->email,
            "phone" => $request->phone,
            "birthDate"=> $request->birthDate,
            "sex" => $request->sex,
            "address" => $request->address,
            "image" => $image,
            "employee_categorie_id" => $request->employee_categorie_id,
            "salary" => $request->salary,
        ]);
        if($employee){
            return redirect()->back()->with('success', "Employee ".$request->firstName." ".$request->lastName." has been successfuly add");
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequesValidation $request, int $id)
    {
        //find employee
        $employee = Employee::find($id);
        $image = $employee->image;

        // upload image by helper function
        if($request->file('image')){
            $image = upload_image($request, "employees");
        }

        $employee->firstName = $request->firstName;
        $employee->lastName = $request->lastName;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->sex = $request->sex;
        $employee->address = $request->address;
        $employee->birthDate = $request->birthDate;
        $employee->image = $image;

        $employee->save();

        return redirect()->back()->with("success", "Employee has been update successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        // request ajax imcomming
        if($request->ajax()) {

            $employee = Employee::destroy($id);
            // return response json
            return Response()->json($employee);

        }
    }



}
