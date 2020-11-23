@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi tiết phiếu hủy
            </div>
            <div class="row w3-res-tb">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                <tr>
                    </th>
                    <th>Thiết bị</th>
                    <th>Giá đền bù</th>
                    <th>Số lượng</th>
                    <th>Lý do</th>
                    <th>Ghi chú</th>
                    <th>Tổng tiền đền bù</th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($show_phieudenbudetail as $key => $detail)
                    <tr>
                        <td>{{$detail->thietbi_name}}</td>
                        <td>{{$detail->phieudenbuDetail_cost}}</td>
                        <td>{{$detail->phieudenbuDetail_nums}}</td>
                        <td>{{$detail->phieudenbuDetail_reason}}</td>
                        <td>{{$detail->phieudenbuDetail_note}}</td>
                        <td>{{$detail->phieudenbuDetail_price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a target="_blank"  href="{{url('/print_phieudenbu',$detail->phieudenbu_id)}}" class="btn btn-danger">In phiếu</a>
        </div>
@endsection
