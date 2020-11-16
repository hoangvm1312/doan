<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/font-awesome/css/font-awesome.min.css')}}">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('public/js/clickevent.js')}}"></script>
</head>
<body>
    <div class="header-cashier">
        <div class="container-fluid">
            <div class="row ft-tabs">
                <div class="col-md-3">
                    <ul class="tabs-list">
                        <li><a  href="{{(URL::to('/'))}}" >Bàn cafe</a></li>
                        <li><a  href="{{URL::to('/loai-phong')}}" >Phòng Karaoke</a></li>
                        <li><a  href="{{URL::to('/menu')}}" >Thực đơn</a></li>
                    </ul>
                </div>
                <a class='button-selected' href="{{URL::to('/tim-thong-tin-cong-no')}}"><button style="margin-left: 750px" type="button" class="btn btn-warning">Thanh toán công nợ</button></a>
                <a class='button-selected' href="{{URL::to('/nhap-thiet-bi')}}"><button style="margin-left: 10px" type="button" class="btn btn-secondary">Lập phiếu đền bù</button></a>
            </div>
        </div>
    </div>
<!-- end bar -->

    <div class="container-fluid">
        <div class="row content">
           @yield('content')
        </div>
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
</html>