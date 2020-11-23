@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thiết bị
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
                        <form role="form" action="{{URL::to('/save_thietbi')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thiết bị</label>
                                <input type="text" name="thietbi_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thiết bị">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá thiết bị</label>
                                <input type="text" name="thietbi_price" class="form-control" id="exampleInputEmail1">
                            </div>
                           
                            <button type="submit" name ="add_thietbi" class="btn btn-info">Thêm thiết bị</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
