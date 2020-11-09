@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật loại phòng
                </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo'<span class="text-alert">'.$message.'</span>';
                    Session::put('$message',null);
                }
                ?>
                <div class="panel-body">
                    @foreach($edit_loaiphong as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update_loaiphong/'.$edit_value->loaiphong_id)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại phòng</label>
                                    <input type="text" value="{{$edit_value->loaiphong_name}}" name="loaiphong_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <button type="submit" name ="update_loaiphong" class="btn btn-info">Cập nhật loại phòng</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
@endsection
