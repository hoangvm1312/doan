@extends('welcome')
@section('content')
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">STT</th>
	      <th scope="col">Tên khách hàng</th>
	      <th scope="col">Loại công nợ</th>
	      <th scope="col">Số điện thoại</th>
	      <th scope="col">Thời gian</th>
	      <th scope="col"><strong>Tổng tiền</strong></th>
	      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>
	  	@$i=1;
	  	@if(isset($khachhang_cafe))
		  	@foreach($khachhang_cafe as $key=>$value)
			    <tr>
			      <th scope="row">{{$i}}</th>
			      <td>{{$value->khachhang_name}}</td>
			      <td>Cafe</td>
			      <td>{{$value->khachhang_sdt}}</td>
			      <td>{{$value->hoadoncafe_time}}</td>
			      <td>{{$value->hoadoncafe_price}}</td>
			      <td><a class="button-seleted" href="#"><button>Chi tiết</button></a></td>
			    </tr>
		    @foreach
	    @endif
	  </tbody>
	</table>
@endsection