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
                    echo'<span class="alert">'.$message.'</span>';
                    Session::put('$message',null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save_bancafe')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên bàn</label>
                                <input type="text" name="bancafe_name" class="form-control" id="exampleInputEmail1" placeholder="Tên bàn">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassord1">Danh mục sản phẩm</label>
                                <select name="kv_ban" class="form-control input-sm m-bot15">
                                    @foreach($kv_bancafe as $key => $kv)
                                        <option value="{{$kv->khuvuc_id}}">{{$kv->khuvuc_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassord1">Trạng thái</label>
                                <select name="bancafe_status" class="form-control input-sm m-bot15">
                                    <option value="0">Trống</option>
                                    <option value="1">Đã sử dụng</option>
                                </select>
                            </div>
                            <button type="submit" name ="add_bancafe" class="btn btn-info">Thêm bàn cà phê</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
