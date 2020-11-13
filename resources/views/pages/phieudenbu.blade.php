@extends('welcome')
@section('content')
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">STT</th>
	      <th scope="col">Tên thiết bị</th>
	      <th scope="col">Số lượng</th>
	      <th scope="col">Lý do</th>
	      <th scope="col"><strong>Tổng tiền</strong></th>
	      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>

			    <tr>
			      <th scope="row">1</th>
			      <td><input type="text" name="tenthietbi"></td>
			      <td><input type="text" name="soluong"></td>
			      <td><input type="text" name="Lý do"></td>
			      <td></td>
			      <td>
			      	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  					<path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
					</svg>

					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-backspace-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2V3zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8 5.829 5.854z"/>
					</svg>
					</td>
			    </tr>
		    

	    
	  </tbody>
	</table>
@endsection