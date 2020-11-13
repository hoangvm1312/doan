@extends('welcome')
@section('content')

<!-- LIỆT KÊ DANH SÁCH CÔNG NỢ -->
	@if(isset($khachhang_cafe) || isset($khachhang_karaoke))
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
			      <td><a class="button-seleted" href="{{URL::to('/chi-tiet-cong-no-cafe/'.$value->hoadoncafe_id)}}"><button>Chi tiết</button></a></td>
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
			      <td><a class="button-seleted" href="{{URL::to('/chi-tiet-cong-no-karaoke/'.$value->hoadonkaraoke_id)}}"><button>Chi tiết</button></a></td>
			    </tr>
		    @endforeach
	    @endif
	  </tbody>
	</table>

	@endif



<!-- LIỆT KÊ CHI TIẾT CÔNG NỢ -->
	@if(isset($hoadonkaraoke)||isset($hoadoncafe))
		<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">STT</th>
	      <th scope="col">Sản phẩm</th>
	      <th scope="col">Số lượng</th>
	      <th scope="col">Đơn giá</th>
	      <th scope="col">Thành tiền</th>
	      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<!-- Công nợ cafe -->
	  	@if(isset($hoadoncafe))
		  	@foreach($hoadoncafe as $key=>$value)
			    <tr>
			      <td>1</td>
			      <td>{{$value->sanpham_name}}</td>
			      <td>{{$value->hoadoncafeDetail_nums}}</td>
			      <td>{{$value->sanpham_price}}</td>
			      <td>{{$value->sanpham_price*$value->hoadoncafeDetail_nums}} VNĐ</td>
			    </tr>
		    @endforeach
		    	<tr>
			      <th scope="row">Tổng tiền</th>
			      <td></td>
			      <td></td>
			      <td></td>
			      <td><strong>{{$value->hoadoncafe_price}} VNĐ</strong></td>
			    </tr>

			    
	    @endif

	    <!-- Công nợ karaoke -->
	    @if(isset($hoadonkaraoke))
		  	@foreach($hoadonkaraoke as $key=>$value)
			    <tr>
			      <td>1</td>
			      <td>{{$value->sanpham_name}}</td>
			      <td>{{$value->hoadonkaraokeDetail_nums}}</td>
			      <td>{{$value->sanpham_price}}</td>
			      <td>{{$value->sanpham_price*$value->hoadonkaraokeDetail_nums}} VNĐ</td>
			    </tr>
			    @endforeach
			    <tr>
			      <td>1</td>
			      <td>Phòng {{$phongdetail->phong_name}}</td>
			      <td>{{$phongdetail->hoadonkaraoke_time}}</td>
			      <td>{{$phongdetail->loaiphong_price}}</td>
			      <td>{{$phongdetail->loaiphong_price*$phongdetail->hoadonkaraoke_time}} VNĐ</td>
			    </tr>

			    <tr><strong>
			      <th scope="row">Tổng tiền</th>
			      <td></td>
			      <td></td>
			      <td></td>
			      <td><strong>{{$value->hoadonkaraoke_price}} VNĐ</strong></td>
			    </strong></tr>
		    
	    @endif
	  </tbody>
	</table>
	@if(isset($hoadoncafe))
	<a class='button-seleted' href="{{URL::to('/thanh-toan-cong-no-cafe/'.$hoadoncafe_id)}}"  target="_blank"><button style="margin-left: 1300px" type="button" class="btn btn-success">
	Thanh toán</button></a>
	
	
	@elseif(isset($hoadonkaraoke) )
	<a class='button-seleted' href="{{URL::to('/thanh-toan-cong-no-karaoke/'.$hoadonkaraoke_id)}}"  target="_blank"><button style="margin-left: 1300px" type="button" class="btn btn-success">Thành toán</button></a>
	@endif
	<a class='button-seleted' href='{{URL::to("/")}}' ><button style="margin-left: 10px" type="button" class="btn btn-danger">Cancel</button></a>
	@endif
@endsection