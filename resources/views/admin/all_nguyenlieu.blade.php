@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê nguyên liệu
            </div>
            <a target="_blank"  href="{{url('/kiemtra_hsd')}}" class="btn btn-danger">Kiểm tra hạn sử dụng</a>
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Giá nhập</th>
                        <th>Hình ảnh</th>
                        <th>Ngày sản xuất</th>
                        <th>Hạn sử dụng</th>
                        
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_nguyenlieu as $key => $pro)
                        <tr>
                            <td>{{$pro->nguyenlieu_name}}</td>
                            <td>{{$pro->nguyenlieu_nums}}</td>
                            <td>{{$pro->phieunhapDetail_dvt}}</td>
                            <td>{{$pro->phieunhapDetail_price}}</td>
                            <td><img src="public/uploads/nguyenlieu/{{$pro->nguyenlieu_image}}"height="100" width="100"></td>
                            <td>{{$pro->phieunhapDetail_hsx}}</td>
                            <td>{{$pro->phieunhapDetail_hsd}}</td>
                            <td>
                                <a href="{{URL::to('/edit_nguyenlieu/'.$pro->nguyenlieu_id)}}" class="active styling edit" ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có muốn xóa nguyên liệu này không?')" href="{{URL::to('/delete_nguyenlieu/'.$pro->nguyenlieu_id)}}" class="active styling edit" ui-toggle-class="">
                                    </i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection
