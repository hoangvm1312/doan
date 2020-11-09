@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm đơn vị tính
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
                        <form role="form" action="{{URL::to('/save_dvt')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đơn vị tính</label>
                                <input type="text" name="dvt_name" class="form-control" id="exampleInputEmail1" placeholder="Tên đơn vị tính">
                            </div>
                            <button type="submit" name ="add_dvt" class="btn btn-info">Thêm đơn vị tính</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
