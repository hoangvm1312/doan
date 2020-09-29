@extends('welcome')
@section('content')
<div class="row product-list">
                    <div class="col-md product-list-content">
                        <ul>
                            <?php
                                while ($rowmenu = mysqli_fetch_array($resultmenu)) 
                                    { ?>
                                    <li><a href="#" onclick="" title="">
                                    <div class="img-product">
                                        <img src="../public/assets/images/<?php echo $rowmenu['Images']; ?>">
                                    </div>
                                    <div class="product-info">
                                        <span class="product-name"><?php echo $rowmenu['NameMenu'];?></span><br>
                                        <strong><?php echo number_format($rowmenu['Price'],3);?></strong>
                                    </div>
                                </a>
                            </li>
                            <?php }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            <!-- bill -->  
             
@endsection