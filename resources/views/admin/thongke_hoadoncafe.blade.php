@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Hóa đơn cà phê
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if($message){
                    echo'<span class="text-alert">'.$message.'</span>';
                    Session::put('.$message.',null);
                }
                ?>
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                    <tr>
                        <th>Bàn</th>
                        <th>Thời gian</th>
                        <th>Khách hàng</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($thongke_hoadoncafe as $key => $thongke)
                        <tr>
                            <td>{{$thongke->bancafe_name}}</td>
                            <td>{{$thongke->hoadoncafe_time}}</td>
                            <td>{{$thongke->hoadoncafe_nguoi}}</td>
                            <td>{{$thongke->hoadoncafe_price}}</td>
                            <td><span class="text-ellipsis">
                            <?php
                                    if($thongke->hoadoncafe_status==0){
                                    ?>
                            <a href ="{{URL::to('/unactive_hoadoncafe/'.$thongke->hoadoncafe_id)}}"> <span class="fa-thumb-styling fa fa-check-square-o"></span></a>
                            <?php
                                    }else{
                                    ?>
                             <a href ="{{URL::to('/active_hoadoncafe/'.$thongke->hoadoncafe_id)}}"> <span class="fa-thumb-styling fa fa-square-o"></span></a>
                            <?php
                                    }
                                    ?>
                        </span></td>
                            <td>
{{--                                @foreach($detail_hoadoncafe as $key => $detail)--}}
                                <a href="{{URL::to('/show_hoadoncafedetail/'.$thongke->hoadoncafe_id)}}" class="active styling edit" ui-toggle-class="">
                                    <i class="fa fa-file-text-o"></i></a>
{{--                                @endforeach--}}
                                <a onclick="return confirm('Bạn có muốn xóa hóa đơn này không?')" href="{{URL::to('/delete_hoadoncafe/'.$thongke->hoadoncafe_id)}}" class="active styling edit" ui-toggle-class="">
                                    </i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection


