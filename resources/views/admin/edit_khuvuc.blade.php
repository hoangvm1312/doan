@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật khu vực
                </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo'<span class="text-alert">'.$message.'</span>';
                    Session::put('$message',null);
                }
                ?>
                <div class="panel-body">
                    @foreach($edit_khuvuc as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update_khuvuc/'.$edit_value->khuvuc_id)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khu vực</label>
                                    <input type="text" value="{{$edit_value->khuvuc_name}}" name="khuvuc_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <button type="submit" name ="update_khuvuc" class="btn btn-info">Cập nhật khu vực sản phẩm</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
@endsection
