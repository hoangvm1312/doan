@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi tiết phiếu nhập
            </div>
            <div class="row w3-res-tb">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                <tr>
                    </th>
                    <th>Nguyên liệu</th>
                    <th>Số lượng</th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($show_phieuxuatdetail as $key => $detail)
                    <tr>
                        <td>{{$detail->nguyenlieu_name}}</td>
                        <td>{{$detail->phieuxuatDetail_nums}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a target="_blank"  href="{{url('/print_phieuxuat',$detail->phieuxuat_id)}}" class="btn btn-danger">In phiếu</a>
        </div>
@endsection
