@extends('welcome')
@section('content')
<div class="col-md-6" id="table-list">
                <div class="row list-filter">
                        <div class="col-md list-filter-content">
                            @if(isset($all_loaiphong))
                                @foreach ($all_loaiphong as $key=>$loaiphong)
                                    <button class="btn btn-primary"><a class='button-select' href="{{URL::to('/phong-karaoke/'.$loaiphong->loaiphong_id)}}">{{$loaiphong->loaiphong_name}}</a></button>
                                @endforeach
                            @endif   
                        </div>
                    </div>
                
                    <div class="row table-list">
                        <div class="col-md table-list-content">
                            <ul>
                                @if(isset($all_phong))
                                    @foreach($all_phong as $key=>$phong) 
                                        <form  method="post">
                                            <li
                                                <?php
                                                    if($phong->phong_status==1) echo 'class="tb-active"';
                                                ?>
                                            > 
                                                <a href="#" class='button-select'>{{$phong->phong_name}}</a>
                                            </li>
                                        </form>
                                    @endforeach            
                                @endif   
                            </ul>
                        </div>
                </div>
            </div>


            <!-- bill -->    
            
@endsection