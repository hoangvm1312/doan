<!DOCTYPE html>
<html>
<head>
    <title>Phần mềm quản lý</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('public/js/clickevent.js')}}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="header-cashier">
        <div class="container-fluid">
            <div class="row ft-tabs">
                <div class="col-md-3">
                    <ul class="tabs-list">
                        <li ><a  href="{{(URL::to('/'))}}" >Bàn cafe</a></li>
                        <li ><a  href="{{URL::to('/loai-phong')}}" >Phòng Karaoke</a></li>
                        <li ><a  href="{{URL::to('/menu')}}" >Thực đơn</a></li>
                    </ul>
                </div>
                <a class='button-selected'  href="{{URL::to('/tim-thong-tin-cong-no')}}"><button style="margin-left: 700px" type="button" class="btn btn-warning">Thanh toán công nợ</button></a>
                <a class='button-selected' href="{{URL::to('/nhap-thiet-bi')}}"><button style="margin-left: 10px" type="button" class="btn btn-secondary">Lập phiếu đền bù</button></a>
                <a class='button-selected' href="{{URL::to('/logout_frontend')}} "onclick="return confirm('Bạn có muốn đăng xuất?')"><button style="margin-left: 10px" type="button" class="btn btn-secondary">Đăng xuất</button></a>
            </div>
        </div>
    </div>
<!-- end bar -->

    <div class="container-fluid">
        <div class="row content">
           @yield('content')

      
            @if(isset($tongban) || isset($tongphong))
            <div class="col-md-6 content-listmenu" id="content-listmenu"> <!-- Bảng hóa đơn -->
                <div class="row" id="bill-info">
                    <div class="col-md-2 table-infor">                     
                    </div>
                </div>
                <div class="row bill-detail">
                    <div class="col-md-12 bill-detail-content">
                        <table class="table table-striped">
                          <thead >
                            <tr>

                              <th scope="col">Tên phòng/ bàn</th>
                              <th scope="col">Trạng thái</th>
                              <th scope="col">Chi tiết</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            @foreach($tongban as $key=>$value)
                                <tr>
                                    <td scope="col" style="background-color: 07E0">Cafe {{$value->bancafe_name}}</td>
                                    <td>   
                                      Đang hoạt động
                                    </td>
                                    <td> 
                                      <a href="{{URL::to('/cafe-select-product/'.$value->bancafe_id.'/'.$loaisanpham_id)}}"><button>Xem</button></a>
                                    </td>
                                </tr>
                                @endforeach 
                                @foreach($tongphong as $key=>$value) 
                                <tr>
                                    <td scope="col">Karaoke {{$value->phong_name}}</td>
                                    <td>  
                                      Đang hoạt động 
                                    </td>
                                    <td>  
                                      <a href="{{URL::to('/karaoke-select-product/'.$value->phong_id.'/'.$loaisanpham_id)}}"><button>Xem</button></a>
                                    </td>
                                    </td>
                                </tr>
                               @endforeach 

                          </tbody>
                        </table>
                        

                    </div>
                        
                        <button  style="margin-top: 10px; " type="button" class="btn btn-outline-danger"><strong>Bàn cafe đang hoạt động: {{$tongban->count()}}</strong></button>          

                        <button style=" margin-top: 10px;" type="button" class="btn btn-outline-danger"><strong>Phòng karaoke đang hoạt động: {{$tongphong->count()}}
                        </strong></button>
      
                </div>

            </div>
@endif






    </div>

</div>

<div class="alert-login">
</div>
<div class="modal fade" id="ModelAddcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>

</div>



</body>
<footer style="position:absolute;bottom:0;width: 100%"class="header-cashier">

  <div style="color: white">
    <p style="margin-bottom: 3px; margin-left: 70px">Sản phẩm thuộc quyền sở hữu công ty Hoàng Ngọc Đạt</p>
    <p style="margin-bottom: 3px; margin-left: 70px">Địa chỉ: 242 Lạch Tray, Ngô Quyền, Hải Phòng</p>
    <p style="margin-left: 70px">Hotline: 1900561252</p>
  </div>

  
</footer>
</html>