@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật nguyên liệu
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
                        @foreach($edit_nguyenlieu as $key => $pro)
                            <form role="form" action="{{URL::to('/update_nguyenlieu/'.$pro->nguyenlieu_id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nguyên liệu</label>
                                    <input type="text" name="nguyenlieu_name" class="form-control" id="exampleInputEmail1" value="{{$pro->nguyenlieu_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="nguyenlieu_nums" class="form-control" id="exampleInputEmail1" value="{{$pro->nguyenlieu_nums}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassord1">Đơn vị tính</label>
                                    <input type="text" name="dvt" class="form-control" id="exampleInputEmail1" value="{{$pro->dvt}}">
                                    <select name="dvt" class="form-control input-sm m-bot15">
                                        <option>KG</option>
                                        <option>Thùng</option>
                                        <option>Lô</option>
                                        <option>Túi</option>
                                        <option>Vỉ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" name="nguyenlieu_price" class="form-control" id="exampleInputEmail1" value="{{$pro->nguyenlieu_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="nguyenlieu_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/nguyenlieu/'.$pro->nguyenlieu_image)}}" height="100" width="100">
                                </div>
                                <button type="submit" name ="update_nguyenlieu" class="btn btn-info">Cập nhật nguyên liệu</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
@endsection
