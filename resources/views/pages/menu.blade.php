@extends('welcome')
@section('content')

<div class="col-md-6" id="table-list">
                <div class="row list-filter">
                        <div class="col-md list-filter-content">
                            @if(isset($all_loaisanpham))
                                @foreach ($all_loaisanpham as $key=>$loaisp)
                                    <button class="btn btn-primary"><a class="button-select" href="{{URL::to('/menu-sanpham/'.$loaisp->loaisanpham_id)}}">{{$loaisp->loaisanpham_name}}</a></button>
                                @endforeach
                            @endif   
                        </div>
                </div>
                <div class="row product-list">
                    <div class="col-md product-list-content">
                        <ul>
                            @if(isset ($all_sanpham))
                                @foreach ($all_sanpham as $key=>$sanpham)
                                    <li><a href="#" onclick="" title="">
                                        <div class="img-product">
                                            <img src="{{('../public/uploads/product/'.$sanpham->sanpham_image)}}">
                                        </div>

                                        <div class="product-info">
                                            <span class="product-name">{{$sanpham->sanpham_name}}</span><br>
                                            <strong>{{$sanpham->sanpham_price}} VND</strong>
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
             
@endsection