@extends('layouts.app')

@section('content')
<table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th style="width: 200px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id}}</td>
                <td>{{ $user->name}}</td>
                <td>{{ $user->email}}</td>
                <td>
                    <div class="">
                    <!-- <a href="{{ asset('/edit/'.$user->id) }}" type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-edit"></i> Approve</a> -->
                    <a class="btn btn-outline-success btn-sm" title="Approve" data-toggle="modal" data-target="#approveModal{{ $user->id }}"><i class="fa fa-edit"></i> Approve</a>
                        <div id="approveModal{{ $user->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                   <div class="modal-header row justify-content-center">
                                        <h4 class="modal-title ">Select Role for Approve</h4>
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->                              
                                    </div>
                                   {!! Form::open(['url' => ['user/'.$user->id.'/approved'], 'method' => 'post']) !!}
                                    <div class="modal-body row justify-content-center">
                                        <!-- <p class="row justify-content-center">Are you sure you want to reject this request?</p> -->
                                        {!! Form::select('role_approve',$role,null,['class'=>'form-control','style'=>'width:200px;']) !!}
                                    </div>
                                    <div class="modal-footer">
                                     <button type="button" class="btn btn-outline-success btn-sm" data-dismiss="modal">Cancel</button>
                                      {!! Form::submit('Confirm',['class' => 'btn btn-outline-danger btn-sm']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    <!-- <button class="btn btn-outline-success btn-sm"><i class="fa fa-edit"> Approve</i></button> -->
                    <a class="btn btn-outline-danger btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $user->id }}"><i class="fa fa-trash"></i> Reject</a>
                        <div id="deleteModal{{ $user->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                   <div class="modal-header row justify-content-center">
                                        <h4 class="modal-title ">Confirm Reject</h4>
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->                              
                                    </div>
                                    <div class="modal-body">
                                        <p class="row justify-content-center">Are you sure you want to reject this request?</p>
                                    </div>
                                    <div class="modal-footer">
                                     <button type="button" class="btn btn-outline-success btn-sm" data-dismiss="modal">Cancel</button>
                                      {!! Form::open(['url' => ['pendinguser/'.$user->id], 'method' => 'delete']) !!}
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
@endsection