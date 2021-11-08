@extends('layouts.app')

@section('content')

<div class="form-group">
		<h1 class="row justify-content-center">Fill It First..!</h1>
		@foreach($users as $user)
		{!! Form::open(['url'=>'/update/'.$user->id,'method'=>'post','files'=>'true'])!!}
			<div class="card card-4 dropdown-menu col-md-6" style="margin-left: 320px;">
				<div class="card-body">
					<div class="row">
						<div class="form-group col-md-6">
							{!! Form::label('name','Name')!!}
							{!! Form::text('name',$user->name,['class'=>'form-control','style'=>'width:100%;',])!!}
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('email','Email')!!}
							{!! Form::text('email',$user->email,['class'=>'form-control','style'=>'width:100%;',])!!}
						</div>
					</div>
					<div>
						{!! Form::label('nrc','NRC Number')!!}
						<div class="row">
							<div class="form-group  col-sm-3">
								{!! Form::select('nrc_code',$nrc_code,$old_nrc_code,['class' => 'form-control','id'=>'nrc_code','required'=>'required']) !!}
							</div>
							<div class="form-group  col-sm-3">
								{!! Form::select('nrc_township',$nrc_township,$old_nrc_township,['class'=>'form-control','id'=>'nrc_township'])!!}
							</div>
							<div class="form-group  col-sm-3">
								{!! Form::select('nrc_type', $array=[''=>'select','N'=>'(N)','E'=>'(E)','P'=>'(P)'], $old_nrc_type, ['class' => 'form-control', 'id'=>'nrc_a','required'=>'required']) !!}
							</div>
							<div class="form-group  col-sm-3">
								{!! Form::text('nrc_number',$old_nrc_number,['class'=>'form-control','style'=>'width:100%;'])!!}
							</div>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('address','Address')!!}
						<div class=" form-group form-row">
							<div class="form-group  col-md-4">
								{!! Form::text('no',$no,['class'=>'form-control','placeholder'=>'No'])!!}
							</div>
							<div class="form-group  col-md-4">
								{!! Form::text('street',$road,['class'=>'form-control','placeholder'=>'Street'])!!}
							</div>
							<div class="form-group  col-md-4">
								{!! Form::text('township',$township,['class'=>'form-control','placeholder'=>'Township'])!!}
							</div>
						</div>
					</div>
					<div class="row"> 
						<div class="form-group col-md-6">
						{!! Form::label('position','Position')!!}
						{!! Form::text('position',$user->position,['class'=>'form-control','style'=>'width:100%;'])!!}
						</div>
						<div class="form-group col-md-6">
						{!! Form::label('join_date','Join-Date')!!}
						{!! Form::date('join_date',$user->join_date,['class'=>'form-control','style'=>'width:100%;'])!!}
						</div>
					</div>
					<br>
					<div class="form-group">
						<a href="{{ url('/home') }}" type="button" class="btn btn-outline-danger btn-sm pull-left"><i class="fa fa-arrow-left"></i> Back</a>
						<!--<a href="#" type="button" class="btn btn-outline-info btn-sm pull-right"><i class="fa fa-save"> Save</i></a>-->
						<button class="btn btn-outline-info btn-sm pull-right"><i class="fa fa-save"> Save</i></button>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
		@endforeach
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).on('change','#nrc_code',function(e){
          var nrc_code = e.target.value;
          console.log(nrc_code);
          var op = " ";
          var div=$(this).parent().parent().parent();
          //console.log(div);
          $.ajax({
            type:'get',
            url:'{!!URL::to('getTownship')!!}',
            data:{'id':nrc_code},
            success:function(data){
              //console.log("OK lrr");
              console.log(data)
              op+='<option value=" " selected ></option>';
                    for(var i=0; i<data.length; i++){
              op+= "<option value='" + data[i].nrc_township + "'>" + data[i].nrc_township + "</option>";
          }

                div.find('#nrc_township').html(" ");
                div.find('#nrc_township').append(op);
            },
            error:function(){
              console.log("error");
              //console.log(data);
            }
          });
        });
	</script>

@endsection