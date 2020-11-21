@extends('welcome')
@section('content')
	<center>
		<!-- Trường hợp thanh toán công nợ cafe -->
		@if(isset($hoadoncafe_id))
		<form name="hdcafe" style="padding: 50px; margin-left: 500px" action="{{URL::to('/save-thong-tin-khach/'.$hoadoncafe_id)}}" method="post">
			@csrf
		  <label for="fname">Tên khách hàng:</label>
		  <input type="text" name="name"><br><br>
		  <label for="lname">Số điện thoại:</label>
		  <input type="text" name="numb"><br><br>
		  <input type="submit" value="Xác nhận cafe">
		</form>
		

		

		@elseif(isset($hoadonkaraoke_id))
			<form name="hdkaraoke" style="padding: 50px; margin-left: 500px" action="{{URL::to('/save-thong-tin-khach-karaoke/'.$hoadonkaraoke_id)}}" method="post">
			@csrf
		  <label for="fname">Tên khách hàng:</label>
		  <input type="text" name="namek"><br><br>
		  <label for="lname">Số điện thoại:</label>
		  <input type="text"name="numbk"><br><br>
		  <input type="submit" value="Xác nhận karaoke">


		@else
			<form name="thanhtoan" style="padding: 50px; margin-left: 500px" action="{{URL::to('/danh-sach-cong-no')}}" method="post">
				@csrf
				<label for="lname">Số điện thoại:</label>
				<input type="text" name="numb"><br><br>
				<input type="submit" value="Xác nhận">
			</form>
			
		@endif
	</center>
@endsection