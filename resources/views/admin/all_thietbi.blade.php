@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê thiết bị
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if($message){
                    echo'<span class="text-alert">'.$message.'</span>';
                    Session::put('$message',null);
                }
                ?>
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                    <tr>
                        <th>Tên thiết bị</th>
                        <th>Giá thiết bị</th>
                        
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_thietbi as $key => $pro)
                        <tr>
                            <td>{{$pro->thietbi_name}}</td>
                            <td>{{$pro->thietbi_price}}</td>
                            
                            <td>
                                <a href="{{URL::to('/edit_thietbi/'.$pro->thietbi_id)}}" class="active styling edit" ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có muốn xóa thiết bị này không?')" href="{{URL::to('/delete_thietbi/'.$pro->thietbi_id)}}" class="active styling edit" ui-toggle-class="">
                                    </i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection
