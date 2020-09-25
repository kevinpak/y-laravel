<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\EmployeeCategorie;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeesCategorieValidation;

class EmployeesCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = EmployeeCategorie::all();
        if(request()->ajax()) {
            return datatables()::of($categories)->addColumn('action', function ($category) {
                    return '<a href="javascript:void(0)" data-name="'.$category->name.'" data-desc="'.$category->description.'" data-id='.$category->id.' class="update-new-category btn btn-sm btn-xs btn-primary"><i class="fas fa-user-edit"></i></a>
                       <a href="javascript:void(0)"  data-id='.$category->id.' class="btn btn-sm btn-xs btn-danger delete-category"><i class="fas fa-trash"></i></a>';
                       
            })->rawColumns(['image', 'action'])->make(true);  
        }
        return view('employee_categorie');
    }

      /**
     * @param Request $request
     *
     * @return response 200
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EmployeesCategorieValidation; $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesCategorieValidation $request)
    {

        // status field deternimne if user is 
        $category = EmployeeCategorie::create([
            "name" =>$request->name,
            "description" => $request->description,
            "status" => 2
        ]);

        return redirect()->back()->with("success", "Your employee category is adding well");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EmployeesCategorieValidation;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesCategorieValidation $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,int $id)
    {
        if($request->ajax()){

            $category = EmployeeCategorie::destroy($id);
            //json response to client
            return response()->json($category);

        }
    }
}
