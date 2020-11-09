@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Phiếu thuê phòng hát
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
                        <th>Phòng</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Khách hàng</th>
                        <th>Giá</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($thongke_phieuthue as $key => $thongke)
                        <tr>
                            <td>{{$thongke->phong_name}}</td>
                            <td>{{$thongke->phieuthue_timein}}</td>
                            <td>{{$thongke->phieuthue_timeout}}</td>
                            <td>{{$thongke->phieuthue_nguoi}}</td>
                            <td>{{$thongke->phieuthue_price}}</td>
                            <td>
                                {{--                                @foreach($detail_phieuthue as $key => $detail)--}}
                                <a href="{{URL::to('/show_phieuthuedetail/'.$thongke->phieuthue_id)}}" class="active styling edit" ui-toggle-class="">
                                    <i class="fa fa-file-text-o"></i></a>
                                {{--                                @endforeach--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection


