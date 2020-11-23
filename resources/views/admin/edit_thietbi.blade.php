@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thiết bị
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
                        @foreach($edit_thietbi as $key => $pro)
                            <form role="form" action="{{URL::to('/update_thietbi/'.$pro->thietbi_id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thiết bị</label>
                                    <input type="text" name="thietbi_name" class="form-control" id="exampleInputEmail1" value="{{$pro->thietbi_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá thiết bị</label>
                                    <input type="text" name="thietbi_price" class="form-control" id="exampleInputEmail1" value="{{$pro->thietbi_price}}">
                                </div>
                                
                                
                                <button type="submit" name ="update_thietbi" class="btn btn-info">Cập nhật thiết bị</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>
        </div>
@endsection
