@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm loại sản phẩm
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
                        <form role="form" action="{{URL::to('/save_loaisanpham')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Loại sản phẩm</label>
                                <input type="text" name="loaisanpham_name" class="form-control" id="exampleInputEmail1" placeholder="Tên loại sản phẩm">
                            </div>
                            <button type="submit" name ="add_loaisanpham" class="btn btn-info">Thêm loại sản phẩm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
@endsection
