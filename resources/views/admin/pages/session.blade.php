@extends('admin.layouts.single')
@section('emp')
<div class="col-md-10 offset-1 mt-5">
<h2 >All Session</h2>
<a class="btn btn-primary " style="margin-bottom: 10px" href="{{URL::to('create-session')}}">Create Session</a>
<table class="table table-striped table-bordered" style="text-align: center">
    <thead>
    <th>Session Name</th>
    <th>Status</th>
    <th>Actions</th>
    </thead>
    <tbody>
        @foreach($sessions as $s)
            <tr>
                <td>{{ $s->session }}</td>
                <td>{{ $s->status }}</td>
                <td >
                    <a class="btn btn-success" href="{{ URL::to('edit-session/'.$s->id)}}" >
                        <i class="fas fa-edit fa-spin"></i>Edit</a>
                    <a class="btn btn-danger" href=""data-toggle="modal" data-target="#myModal{{ $s->id }}">
                        <i class="fas fa-trash-alt fa-pulse"></i>  Delete</a>
                    <div class="modal" id="myModal{{ $s->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Confirmation</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    Are you sure you want to delete <b>{{ $s->session }}</b>??
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <a class="btn btn-danger" href="{{ URL::to('delete-session/'.$s->id) }}">Yes</a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table
</div>

@stop

