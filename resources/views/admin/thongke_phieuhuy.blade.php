@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Phiếu hủy
            </div>
        </div>
        <div class="table-responsive">
            <!-- <?php
            $message = Session::get('message');
            if($message){
                echo'<span class="">'.$message.'</span>';
                Session::put('.$message.',null);
            }
            ?> -->
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                <tr>
                    <th>Người lập phiếu</th>
                    <th>Số tiền</th>
                    <th>Ngày nhập</th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($thongke_phieuhuy as $key => $thongke)
                    <tr>
                        <td>{{$thongke->phieuhuy_nguoi}}</td>
                        <td>{{$thongke->phieuhuy_price}}</td>
                        <td>{{$thongke->phieuhuy_time}}</td>
                        <td>
                            {{--                                @foreach($detail_phieuthue as $key => $detail)--}}
                            <a href="{{URL::to('/show_phieuhuydetail/'.$thongke->phieuhuy_id)}}" class="active styling edit" ui-toggle-class="">
                                <i class="fa fa-file-text-o"></i></a>
                            {{--                                @endforeach--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection


