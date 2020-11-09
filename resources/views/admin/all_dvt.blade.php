@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê đơn vị tính
            </div>
            <div class="table-responsive" >
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
                        <th>Đơn vị tính</th>
                        <th style="width:800px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_dvt as $key => $unit)
                        <tr>
                            <td>{{$unit->dvt_name}}</td>
                            <td><span class="text-ellipsis">
                        </span></td>
                            <td>
                                <a href="{{URL::to('/edit_dvt/'.$unit->dvt_id)}}" class="active styling edit" ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có muốn xóa đơn vị tính này không?')" href="{{URL::to('/delete_dvt/'.$unit->dvt_id)}}" class="active styling edit" ui-toggle-class="">
                                    </i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection
