@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi tiết phiếu thuê
            </div>
            <div class="row w3-res-tb">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                <tr>
                    </th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($show_hoadonkaraokedetail as $key => $detail)
                    <tr>
                        <td>{{$detail->sanpham_name}}</td>
                        <td>{{$detail->hoadonkaraokeDetail_nums}}</td>
                        <td>{{$detail->hoadonkaraokeDetail_price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a target="_blank"  href="{{url('/print_hoadonkaraoke',$detail->hoadonkaraoke_id)}}" class="btn btn-danger">In phiếu</a>
        </div>
@endsection
