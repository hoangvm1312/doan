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
	  	<!-- Công nợ cafe -->
	  	@if(isset($khachhang_cafe))
		  	@foreach($khachhang_cafe as $key=>$value)
			    <tr>
			      <th scope="row">1</th>
			      <td>{{$value->khachhang_name}}</td>
			      <td>Cafe</td>
			      <td>{{$value->khachhang_sdt}}</td>
			      <td>{{$value->hoadoncafe_time}}</td>
			      <td>{{$value->hoadoncafe_price}}</td>
			      <td><a class="button-seleted" href="#"><button>Chi tiết</button></a></td>
			    </tr>
		    @endforeach
	    @endif

	    <!-- Công nợ karaoke -->
	    @if(isset($khachhang_karaoke))
		  	@foreach($khachhang_karaoke as $key=>$value)
			    <tr>
			      <th scope="row">1</th>
			      <td>{{$value->khachhang_name}}</td>
			      <td>Karaoke</td>
			      <td>{{$value->khachhang_sdt}}</td>
			      <td>{{$value->hoadonkaraoke_timein}}</td>
			      <td>{{$value->hoadonkaraoke_price}}</td>
			      <td><a class="button-seleted" href="#"><button>Chi tiết</button></a></td>
			    </tr>
		    @endforeach
	    @endif
	  </tbody>
	</table>
@endsection