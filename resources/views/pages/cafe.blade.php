@extends('welcome')
@section('content')
            <div class="col-md-6" id="table-list">
                <div class="row list-filter">
                        <div class="col-md list-filter-content">
                            @if(isset($all_khuvuc))
                                @foreach ($all_khuvuc as $key=>$khuvuc)
                                    <button class="btn btn-primary"><a class="button-select" href="{{URL::to('/ban-cafe/'.$khuvuc->khuvuc_id)}}">{{$khuvuc->khuvuc_name}}</a></button>
                                @endforeach
                            @endif   
                        </div>
                    </div>
                
                    <div class="row table-list">
                        <div class="col-md table-list-content">
                            <ul>
                                @if(isset($all_bancafe))
                                    @foreach($all_bancafe as $key=>$bancafe) 
                                        <form  method="post">
                                            <li
                                                <?php
                                                    if($bancafe->bancafe_status==1) echo 'class="tb-active"';
                                                ?>
                                            > 
                                                <a href="{{URL::to('/cafe-select-product/'.$bancafe->bancafe_id)}}" class="button-select">{{$bancafe->bancafe_name}}</a>
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