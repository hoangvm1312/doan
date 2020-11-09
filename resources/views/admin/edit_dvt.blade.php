@extends('Admin_Layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật đơn vị tính
                </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo'<span class="text-alert">'.$message.'</span>';
                    Session::put('$message',null);
                }
                ?>
                <div class="panel-body">
                    @foreach($edit_dvt as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/update_dvt/'.$edit_value->dvt_id)}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên đơn vị tính</label>
                                    <input type="text" value="{{$edit_value->dvt_name}}" name="dvt_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <button type="submit" name ="update_dvt" class="btn btn-info">Cập nhật đơn vị tính</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
@endsection
