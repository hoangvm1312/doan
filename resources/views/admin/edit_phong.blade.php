@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật phòng
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
                        @foreach($edit_phong as $key => $phong)
                            <form role="form" action="{{URL::to('/update_phong/'.$phong->phong_id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="phong_name" class="form-control" id="exampleInputEmail1" value="{{$phong->phong_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassord1">Khu vực</label>
                                    <select name="loai_phong" class="form-control input-sm m-bot15">
                                        @foreach($loai_phong as $key => $loai)
                                            @if($loai->loaiphong_id == $phong->loaiphong_id)
                                                <option selected value="{{$loai->loaiphong_id}}">{{$loai->loaiphong_name}}</option>
                                            @else
                                                <option value="{{$loai->loaiphong_id}}">{{$loai->loaiphong_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name ="update_phong" class="btn btn-info">Cập nhật phòng</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
@endsection
