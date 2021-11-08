@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- <button type="button" class="btn btn-sm btn-outline-dark">
                                <i class="fa fa-bell" ></i>&nbsp;Need to Approve<span class="badge badge-light"></span>
                    </button> -->
                    <a href="{{ asset('/approve')}}" type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-bell" ></i>&nbsp;Need to Approve</a>

                    <a href="{{ asset('/support')}}" type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-exclamation" ></i>&nbsp;Need to Suuport</a>

                    <div class="pull-right" style="width:250px;">
                        {!! Form::open(['url' => '/search', 'method' => 'get']) !!}
                        <div class="form-group row">
                
                <!-- <input type="text" name="search" id="search" class="form-control col-sm-10" placeholder="Search">  -->
                            {!! Form::text('search',$search,['class'=>'form-control col-sm-10','placeholder'=>'Search' ,'id'=>'search'])!!}
                            {!! Form::button('<i class="fa fa-search"></i>',['type' =>'submit','class' => 'btn btn-outline-secondary btn-sm ml-1','value'=>'searchuser','name' =>'searchuser']) !!}
                        </div>
                        <div class="form-group row">
                            <a href="{{ asset('/home')}}" type="button" class="btn btn-outline-warning btn-sm mr-1"><i class="fa fa-refresh" ></i> Refresh</a>

                            <a href="{{ asset('/create') }}" type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-plus" ></i> Create</a>

                <!--<a href="{{ asset('/download') }}" type="submit" class="btn btn-outline-dark btn-sm ml-1"><i class="fa fa-download" ></i> Download</a>
                {!! Form::button('<i class="fa fa-download"></i>&nbsp;&nbsp;Download', ['type' =>'submit','class' => 'btn btn-outline-dark btn-sm ml-1']) !!}-->
                            {!! Form::button('<i class="fa fa-download"></i>&nbsp;Download', ['type' =>'submit','class' => 'btn btn-outline-dark btn-sm ml-1','value' => 'download','name' => 'download']) !!}
                            <!-- <button type="button" class="btn btn-sm btn-outline-dark">
                                <i class="fa fa-bell" ></i><span class="badge badge-light">4</span>
                            </button> -->
                        </div>      
                        {!! Form::close()!!}
                    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>NRC</th>
                <th>Address</th>
                <th>Position</th>
                <th>Join-Date</th>
                <th style="width: 200px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id}}</td>
                <td>{{ $user->name}}</td>
                <td>{{ $user->email}}</td>
                <td>{{ $user->nrc}}</td>
                <td>{{ $user->address}}</td>
                <td>{{ $user->position}}</td>
                <td>{{ $user->join_date}}</td>
                <td>
                    <div class="">
                    <a href="{{ asset('/edit/'.$user->id) }}" type="button" class="btn btn-outline-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <!--<a href="" type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"> Delete</i></a>-->
                    <a  class="btn btn-outline-danger btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $user->id }}"><i class="fa fa-trash"></i> Delete</a>
                        <div id="deleteModal{{ $user->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                   <div class="modal-header">
                                        <h4 class="modal-title">Confirm Delete</h4>
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->                              
                                    </div>
                                    <div class="modal-body">
                                        <p style="align-items: center;">Are you sure you want to delete this item?</p>
                                    </div>
                                    <div class="modal-footer">
                                     <button type="button" class="btn btn-outline-success btn-sm" data-dismiss="modal">Cancel</button>
                                      {!! Form::open(['url' => ['user/'.$user->id], 'method' => 'delete']) !!}
                                      {!! Form::submit('Confirm',['class' => 'btn btn-outline-danger btn-sm']) !!}
                                      {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pull-right" style="margin-right: 150px;">
    {{ $users->links() }}
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
