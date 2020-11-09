@extends('Admin_Layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
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
                        <th>Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Hình ảnh sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Đơn vị tính sản phẩm</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_sanpham as $key => $pro)
                        <tr>
                            <td>{{$pro->sanpham_name}}</td>
                            <td>{{$pro->sanpham_price}}</td>
                            <td><img src="public/uploads/sanpham/{{$pro->sanpham_image}}"height="100" width="100"></td>
                            <td>{{$pro->loaisanpham_name}}</td>
                            <td>{{$pro->dvt_name}}</td>
                            <td>
                                <a href="{{URL::to('/edit_sanpham/'.$pro->sanpham_id)}}" class="active styling edit" ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')" href="{{URL::to('/delete_sanpham/'.$pro->sanpham_id)}}" class="active styling edit" ui-toggle-class="">
                                    </i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection
