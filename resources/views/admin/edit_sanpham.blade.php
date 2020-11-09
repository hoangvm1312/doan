@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo'<span class="text-alert">'.$message.'</span>';
                    Session::put('$message',null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($edit_sanpham as $key => $pro)
                            <form role="form" action="{{URL::to('/update_sanpham/'.$pro->sanpham_id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="sanpham_name" class="form-control" id="exampleInputEmail1" value="{{$pro->sanpham_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="sanpham_price" class="form-control" id="exampleInputEmail1" value="{{$pro->sanpham_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="sanpham_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/sanpham/'.$pro->sanpham_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassord1">Loại sản phẩm</label>
                                    <select name="sanpham_loaisanpham" class="form-control input-sm m-bot15">
                                        @foreach($kind_sanpham as $key => $kind)
                                            @if($kind->loaisanpham_id == $pro->loaisanpham_id)
                                                <option selected value="{{$kind->loaisanpham_id}}">{{$kind->loaisanpham_name}}</option>
                                            @else
                                                <option value="{{$kind->loaisanpham_id}}">{{$kind->loaisanpham_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassord1">Đơn vị tính</label>
                                    <select name="sanpham_dvt" class="form-control input-sm m-bot15">
                                        @foreach($unit_sanpham as $key => $unit)
                                            @if($unit->dvt_id == $pro->dvt_id)
                                                <option selected value="{{$unit->dvt_id}}">{{$unit->dvt_name}}</option>
                                            @else
                                                <option value="{{$unit->dvt_id}}">{{$unit->dvt_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name ="update_sanpham" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>
        </div>
@endsection
