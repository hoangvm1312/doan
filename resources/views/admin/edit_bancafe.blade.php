@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật bàn cà phê
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
                        @foreach($edit_bancafe as $key => $ban)
                            <form role="form" action="{{URL::to('/update_bancafe/'.$ban->bancafe_id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="bancafe_name" class="form-control" id="exampleInputEmail1" value="{{$ban->bancafe_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassord1">Khu vực</label>
                                    <select name="kv_bancafe" class="form-control input-sm m-bot15">
                                        @foreach($kv_bancafe as $key => $kv)
                                            @if($kv->khuvuc_id == $ban->khuvuc_id)
                                                <option selected value="{{$kv->khuvuc_id}}">{{$kv->khuvuc_name}}</option>
                                            @else
                                                <option value="{{$kv->khuvuc_id}}">{{$kv->khuvuc_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name ="update_bancafe" class="btn btn-info">Cập nhật bàn</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
@endsection
