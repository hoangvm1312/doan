@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm phòng
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
                        <form role="form" action="{{URL::to('/save_phong')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên phòng</label>
                                <input type="text" name="phong_name" class="form-control" id="exampleInputEmail1" placeholder="Tên bàn">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassord1">Loại phòng</label>
                                <select name="loai_phong" class="form-control input-sm m-bot15">
                                    @foreach($loai_phong as $key => $loai)
                                        <option value="{{$loai->loaiphong_id}}">{{$loai->loaiphong_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassord1">Trạng thái</label>
                                <select name="phong_status" class="form-control input-sm m-bot15">
                                    <option value="0">Trống</option>
                                    <option value="1">Đã sử dụng</option>
                                </select>
                            </div>
                            <button type="submit" name ="add_phong" class="btn btn-info">Thêm phòng</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
