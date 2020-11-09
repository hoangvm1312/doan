@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm khu vực
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
                        <form role="form" action="{{URL::to('/save_khuvuc')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên khu vực</label>
                                <input type="text" name="khuvuc_name" class="form-control" id="exampleInputEmail1">
                            </div>
                            <button type="submit" name ="add_khuvuc" class="btn btn-info">Thêm khu vực</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
@endsection
