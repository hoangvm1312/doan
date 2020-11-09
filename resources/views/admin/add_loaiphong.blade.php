@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm loại phòng
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
                        <form role="form" action="{{URL::to('/save_loaiphong')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Loại phòng</label>
                                <input type="text" name="loaiphong_name" class="form-control" id="exampleInputEmail1" placeholder="Tên loại phòng">
                            </div>
                            <button type="submit" name ="add_loaiphong" class="btn btn-info">Thêm loại phòng</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
