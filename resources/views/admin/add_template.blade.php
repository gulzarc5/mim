@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-6">
      <div class="x_panel">
            <div>
                @if (Session::has('message'))
                    <div class="alert alert-success" >{{ Session::get('message') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" >{{ Session::get('error') }}</div>
                @endif
            </div>
          <div>
              <div class="x_content">               
                
                {{ Form::open(['method' => 'post','route'=>'admin.add_template','enctype'=>'multipart/form-data'])}}                  
                    <div class="well" style="overflow: auto">
                      <center><h3>Add Template</h3></center>
                      <div class="form-row mb-10">
                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                          <div class="form-row">
                              <div class="col-sm-12">
                                <label class="control-label">Template Name</label>
                                <input type="text"  name="name" id="swidth" class="form-control" placeholder="Enter Template Name" value="{{old('name')}}">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @enderror
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="col-sm-12">
                                  <label class="control-label">Template</label>
                                  <input type="file" name="template"  class="form-control">
                                  @if($errors->has('template'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                      <strong>{{ $errors->first('template') }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div> 
                        </div>
                      </div>
                    </div>                  
                    <div class="form-group">    	            	
                        {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
                    </div>
                {{ Form::close() }}
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
 @endsection