@extends('layouts.app')
@section('content')
    	<!--employer list-->
        <div class="list-employer">
            <div class="list-employer__header mt-3 mb-3 float-rigth">
                <a href="javascript:void(0)" class="btn btn-outline-primary" id="new-category"> Add new category</a>
            </div>
            <div class="list-employer__content">

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{session('success') }}
                    </div>
                @endif
                <table id="list-category"  class="table table-responsive table-striped table-bordered list-employer__table">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                    </table>
                </div>
        </div>
    </div>

    <div class="modal fade" id="ajax-category-modal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="categoryCrudTitle"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form  method="POST" action="{{route('store-category')}}"  enctype="multipart/form-data"data-error="{{ $errors->any() ? "error-exist":"" }}" id="categoryForm" name="employeeForm" class="form-horizontal" >
 
                @csrf
                <input type="hidden" name="categoryId" id="categoryId">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <input type="text"  
                                name="name" 
                                class="form-control @error("name") is-invalid @enderror"
                                value="{{old('name')}}"
                                placeholder="Name"
                                required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <textarea name="description" 
                                      required 
                                      rows="6"
                                      placeholder="Description"
                                      class="form-control @error("decription") is-invalid @enderror"
                                    ></textarea>
                            @error('decription')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
