@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm nguyên liệu
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
                        <form role="form" action="{{URL::to('/save_nguyenlieu')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên nguyên liệu</label>
                                <input type="text" name="nguyenlieu_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nguyên liệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="text" name="nguyenlieu_nums" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassord1">Đơn vị tính</label>
                                <select name="dvt" class="form-control input-sm m-bot15">
                                    <option>KG</option>
                                    <option>Thùng</option>
                                    <option>Lô</option>
                                    <option>Túi</option>
                                    <option>Vỉ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá nguyên liệu</label>
                                <input type="text" name="nguyenlieu_price" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh nguyên liệu</label>
                                <input type="file" name="nguyenlieu_image" class="form-control" id="exampleInputEmail1">
                            </div>
                            <button type="submit" name ="add_nguyenlieu" class="btn btn-info">Thêm nguyên liệu</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
