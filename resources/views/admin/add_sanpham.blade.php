@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" action="{{URL::to('/save_sanpham')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" name="sanpham_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" name="sanpham_price" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" name="sanpham_image" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassord1">Loại sản phẩm</label>
                                <select name="sanpham_kind" class="form-control input-sm m-bot15">
                                    @foreach($kind_sanpham as $key => $kind)
                                        <option value="{{$kind->loaisanpham_id}}">{{$kind->loaisanpham_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassord1">Đơn vị tính</label>
                                <select name="sanpham_unit" class="form-control input-sm m-bot15">
                                    @foreach($unit_sanpham as $key => $unit)
                                        <option value="{{$unit->dvt_id}}">{{$unit->dvt_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" name ="add_sanpham" class="btn btn-info">Thêm sản phẩm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
