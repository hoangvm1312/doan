@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                chi tiết hóa đơn cà phê
            </div>
            <div class="row w3-res-tb">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                <tr>
                    </th>
                    <th>Bàn</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($show_hoadoncafedetail as $key => $detail)
                    <tr>
                        <td>{{$detail->bancafe_name}}</td>
                        <td>{{$detail->sanpham_name}}</td>
                        <td>{{$detail->hoadoncafeDetail_nums}}</td>
                        <td>{{$detail->hoadoncafeDetail_price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a target="_blank"  href="{{url('/print_hoadoncafe',$detail->hoadoncafe_id)}}" class="btn btn-danger">In hóa đơn</a>
        </div>
        <footer class="panel-footer">
@endsection
