@extends('layouts.app')
@section('content')
    	<!--employer list-->
        <div class="list-employer">
            <div class="list-employer__header mt-3 mb-3 float-rigth">
                <a href="javascript:void(0)" class="btn btn-outline-primary" id="create-new-emmployee"> Add employee</a>
            </div>
            <div class="list-employer__content">

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{session('success') }}
                    </div>
                @endif
                <table id="list-employer"  class="table table-responsive table-striped table-bordered list-employer__table">
                      <thead>
                        <tr>
                          <th scope="col">Photo</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Job</th>
                          <th scope="col">Sex</th>
                          <th scope="col">Adresse</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                    </table>
                </div>
        </div>
    </div>

    <div class="modal fade" id="ajax-employee-modal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="employeeCrudTitle"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form  method="POST" action="{{route('store-employee')}}"  enctype="multipart/form-data"data-error="{{ $errors->any() ? "error-exist":"" }}" id="employeeForm" name="employeeForm" class="form-horizontal" >
                {{-- employee id for current employee receive action --}}
                @csrf
                <input type="hidden" name="employeeId" id="employeeId">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <input type="text"
                                name="firstName"
                                class="form-control @error("firstName") is-invalid @enderror"
                                value="{{old('firstName')}}"
                                placeholder="First name"
                                required>

                        @error('firstName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text"
                                    name="lastName"
                                    class="form-control @error("lastName") is-invalid @enderror"
                                    placeholder="Last name"
                                    value="{{old('lastName')}}"
                                    required>
                            @error('lastName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input  type="email"
                                    id="docs-demo"
                                    name="email"
                                    class="form-control @error("email") is-invalid @enderror"
                                    placeholder="email"
                                    value="{{old('email')}}"
                                    required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control @error("phone") is-invalid @enderror"
                                    placeholder="Phone"
                                    value="{{old('phone')}}"
                                    required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <select name="sex"
                                    class="form-control @error("sex") is-invalid @enderror"
                                    required>
                                <option  value="">Chose gender</option>
                                <option {{ (old("sex") == "Man" ? "selected":"") }} value="Man">Man</option>
                                <option {{(old("sex") == "Woman" ? "selected":"")}}  value="Woman">Woman</option>
                            </select>

                            @error('sex')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="number"
                                    name="salary"
                                    class="form-control @error("salary") is-invalid @enderror"
                                    placeholder="Salary"
                                    value="{{old("salary")}}"
                                    required>
                            @error('salary')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="job">Employee Job</label>
                            <select name="employee_categorie_id"
                                    id="job"
                                    class="form-control @error("employee_categorie_id") is-invalid @enderror"
                                    required>
                                <option value="">Select Job of employee</option>
                                @foreach ($allcategories as $category)
                                    <option {{old("employee_categorie_id") == $category->id ? "selected":""}} value="{{$category->id}}"> {{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('employee_categorie_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text"
                                    name="address"
                                    class="form-control @error("address") is-invalid @enderror"
                                    placeholder="Address"
                                    value="{{old("address")}}"
                                    required>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="day">Birth day</label>
                            <input id="day"
                                    type="date"
                                    name="birthDate"
                                    class="form-control @error("birthDate") is-invalid @enderror"
                                    placeholder="Birth Day"
                                    value="{{old("birthDate")}}"
                                    required>
                            @error('birthDate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <label for="image">Upload file</label>
                        <div class="form-group">
                            <input id="upload"
                                    name="image"
                                    type="file"
                                    class="form-control filepond"
                                    data-allow-reorder="true"
                                    data-max-file-size="3MB"
                                    data-max-files="1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-save" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
 <!-- Modal -->

@endsection
