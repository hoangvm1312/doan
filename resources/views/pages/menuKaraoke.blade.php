@extends('welcome')
@section('content')

<div class="col-md-6" id="table-list">
                <div class="row list-filter">
                        <div class="col-md list-filter-content"> <!-- Liệt kê loại sản phẩm -->
                            @if(isset($all_loaisanpham)) 
                                @foreach ($all_loaisanpham as $key=>$loaisp)
                                    <button class="btn btn-primary">
                                        @if(isset($phong_id))
                                          <a class="button-select"  href="{{URL::to('/menu-karaoke/'.$loaisp->loaisanpham_id.'/'.$phong_id)}}" >{{$loaisp->loaisanpham_name}}</a>
                                        @else
                                          <a class="button-select"  href="{{URL::to('/menu-sanpham/'.$loaisp->loaisanpham_id)}}" >{{$loaisp->loaisanpham_name}}</a>
                                        @endif
                                    </button>
                                @endforeach
                            @endif   
                        </div>
                </div>
                <div class="row product-list">
                    <div class="col-md product-list-content">
                        <ul>
                            @if(isset ($all_sanpham)) <!-- Liệt kê sản phẩm -->
                                @foreach ($all_sanpham as $key=>$sanpham)
                                    <li>
                                        @if(isset($phong_id))
                                            <a href="{{URL::to('/choose-product-karaoke/'.$sanpham->sanpham_id.'/'.$phong_id)}}">
                                        @else <a href="#"> 
                                        @endif
                                        <div class="img-product">
                                        @if(isset($phong_id))
                                            <img src="{{('../../public/uploads/sanpham/'.$sanpham->sanpham_image)}}">
                                        @else <img src="{{('../public/uploads/sanpham/'.$sanpham->sanpham_image)}}">
                                        @endif
                                        </div>
                                        <div class="product-info">
                                            <span class="product-name">{{$sanpham->sanpham_name}}</span><br>
                                            <strong>{{number_format($sanpham->sanpham_price)}} vnđ</strong>
                                        </div>
                                    </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>



            <!-- bill -->  
            
             <div class="col-md-6 content-listmenu" id="content-listmenu"> <!-- Bảng hóa đơn -->
                <!-- Thời gian vào -->
                <div class="input-group spinner" style="width: 700px ; height: 20px">
                    <input style="padding-left: 0px" type="text" class="form-control quantity-product-oders" value=" 
                    Giá phòng {{$tenphong}}: {{$phong_price}} vnđ">

                    @if(isset($hoadon->hoadonkaraoke_timein))
                    <input  type="text" class="form-control quantity-product-oders" value="Thời gian vào: {{$hoadon->hoadonkaraoke_timein}}">
                    @endif

            </div><!-- END Thời gian vào -->

                <div class="row" id="bill-info">
                    <div class="col-md-2 table-infor">                     
                    </div>
                </div>
                <div class="row bill-detail">
                    <div class="col-md-12 bill-detail-content">
                        <table class="table table-bordered">
                          <thead class="thead-light">
                            <tr>
 
                              <th scope="col">Tên sản phẩm</th>
                              <th scope="col">Số lượng</th>
                              <th scope="col">Đơn giá</th>
                              <th scope="col">Thành Tiền</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(isset($all_hoadon))
                                @foreach($all_hoadon as $key=>$hoadon)
                                <tr>
      
                                    <td scope="col">{{$hoadon->sanpham_name}}</td>
                                    <td>
                                        <div class="input-group spinner">
                                            <a href="{{URL::to('/minus-karaoke/'.$hoadon->sanpham_id.'/'.$hoadon->hoadonkaraoke_id)}}" class="button-select"><button name="minus" class="input-group-prepend btn btn-default"><i class="fa fas fa-minus"></i></button></a>
                                            <input type="text" class="form-control quantity-product-oders" name="" value="{{$hoadon->hoadonkaraokeDetail_nums}}">
                                            <a href="{{URL::to('/plus-karaoke/'.$hoadon->sanpham_id.'/'.$hoadon->hoadonkaraoke_id)}}" class="button-select"><button name="plus" class="input-group-prepend btn btn-default"><i class="fa fas fa-plus"></i></button></a>
                                        </div>
                                    </td>

                                    <td scope="col">{{number_format($hoadon->sanpham_price)}} vnđ</td>
                                    <td  class="text-center total-money">{{number_format($hoadon->hoadonkaraokeDetail_nums*$hoadon->sanpham_price)}} vnđ</td>
                                    <td class="text-center">
                                        <a href="{{URL::to('/delete-karaoke/'.$hoadon->sanpham_id.'/'.$hoadon->hoadonkaraoke_id)}}" class="button-select"><button name="delete" action="submit">
                                            <i class="fa fa-times-circle del-pro-order"></i>
                                        </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                          </tbody>
                        </table>
                    </div>
                </div>
                <div class="row bill-action">
                    <div class="col-md-6">
                        
                        <div class="row">
                            <div class="col-md-6 col-xs-6 p-1">
                                @if(isset($hoadon))
                                <a href="{{URL::to('/check-out-karaoke/'.$hoadon->hoadonkaraoke_id.'/'.$phong_id)}}" class='button-select' onclick="return confirm('Xác nhận thanh toán?')" target="_blank">
                                @else 
                                    <a href="#" class='button-select'>
                                @endif
                                    <button type="button" class="btn-print"><i class="fa fa-credit-card" aria-hidden="true"></i> Thanh Toán
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6 col-xs-6 p-1">
                                @if(isset($hoadon))
                                    <a href="{{URL::to('/cong-no-karaoke/'.$hoadon->hoadonkaraoke_id)}}" class='button-select'  target="_blank">
                                @else
                                    <a href="#" class='button-select'>
                                @endif
                                    <button type="button" class="btn-pay"  ><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu công nợ
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6" >
                        <div class="row form-group" style='padding-top:10px'>
                            <label class="col-form-label col-md-4"><b>Tổng cộng</b></label>
                            <div class="col-md-8">
                                @if(isset($price_hoadon))
                                <input type="text" value="{{$price_hoadon}} VNĐ" class="form-control total-pay" disabled="disabled">
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
@endsection