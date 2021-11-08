@extends('layouts.app')

@section('content')

<div class="form-group">
		<h1 class="row justify-content-center">Fill It First..!</h1>
		{!! Form::open(['url'=>'/store','method'=>'post','files'=>'true'])!!}
			<div class="card card-4 dropdown-menu col-md-6" style="margin-left: 320px;">
				<div class="card-body">
					<div class="row">
						<div class="form-group col-md-6">
							{!! Form::label('name','Name')!!}
							{!! Form::text('name',null,['class'=>'form-control','style'=>'width:100%;',])!!}
						</div>
						<div class="form-group col-md-6">
							{!! Form::label('email','Email')!!}
							{!! Form::text('email',null,['class'=>'form-control','style'=>'width:100%;',])!!}
						</div>
					</div>
					<div>
						{!! Form::label('nrc','NRC Number')!!}
						<div class="row">
							<div class="form-group  col-sm-3">
								{!! Form::select('nrc_code',$nrc_code,null,['class' => 'form-control','id'=>'nrc_code','required'=>'required']) !!}
							</div>
							<div class="form-group  col-sm-3">
								{!! Form::select('nrc_township',$nrc_township,null,['class'=>'form-control','id'=>'nrc_township'])!!}
							</div>
							<div class="form-group  col-sm-3">
								{!! Form::select('nrc_type', $array=[''=>'select','25'=>'20','39'=>'35','40'=>'40','45'=>'45','50'=>'50','55'=>'55','60'=>'60','65'=>'65','70'=>'70'], null, ['class' => 'form-control', 'id'=>'down_pay','required'=>'required']) !!}
							</div>
							<div class="form-group  col-sm-3">
								{!! Form::text('nrc_number',null,['class'=>'form-control','style'=>'width:100%;'])!!}
							</div>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('address','Address')!!}
						<div class=" form-group form-row">
							<div class="form-group  col-md-4">
								{!! Form::text('no',null,['class'=>'form-control','placeholder'=>'No'])!!}
							</div>
							<div class="form-group  col-md-4">
								{!! Form::text('street',null,['class'=>'form-control','placeholder'=>'Street'])!!}
							</div>
							<div class="form-group  col-md-4">
								{!! Form::text('township',null,['class'=>'form-control','placeholder'=>'Township'])!!}
							</div>
						</div>
					</div>
					<div class="row"> 
						<div class="form-group col-md-6">
						{!! Form::label('position','Position')!!}
						{!! Form::text('position',null,['class'=>'form-control','style'=>'width:100%;'])!!}
						</div>
						<div class="form-group col-md-6">
						{!! Form::label('join_date','Join-Date')!!}
						{!! Form::date('join_date',null,['class'=>'form-control','style'=>'width:100%;'])!!}
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