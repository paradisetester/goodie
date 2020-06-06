<!DOCTYPE html>
<html>
<head>
    <title>Goodiemenu</title>
    <!-- meta tag links -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css links -->
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">
<!--        <link rel="stylesheet" type="text/css" href="css/slick/slick.css">-->
<!--        <link rel="stylesheet" type="text/css" href="css/slick/slick-theme.css">-->
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--        <link rel="stylesheet" href="https://bossassistant.com/boss/assets/css/bootstrap.min.css"/>-->
<!--<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">-->
    <!-- js link -->        
        <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('public/js/bootstrap.js')}}"></script>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600;700;900&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="nav-border">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header row">
<!--                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>-->
                    <?php
                    $hex = $Restraunt->color;
                    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
                     $colour="rgba($r, $g, $b, 0.87)";
                    ?>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="logo">
                        @if($Restraunt->restraunt_name==null)
                        <a class="navbar-brand" href="#">Menu </a>
                        @else
                        <a class="navbar-brand" href="#">Menu | {{$Restraunt->restraunt_name}} </a>
                        @endif
                    </div>
                 </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="menu col-md-6 col-sm-6 col-xs-6">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav navbar-right">
                                <li class="active drop_outter"><a href="#"><img src="{{asset('/public/assets/img/export.png')}}"/> <span class="sr-only">(current)</span></a>
								     <ul class="dropdown_outter">
									      <li class="mail_d"><a href="mailto:{{$user->email}}"><i class="fa fa-envelope" aria-hidden="true"></i>Email</a></li>
									      <li class="copy_d"><a href="javascript:void(0)" onclick="Copy()"><i class="fa fa-link" aria-hidden="true"></i>Copy Link</a>
									      <span class="msgcopy"></span>
									      </li>
									 </ul>
								</li>
            <li class="video"><a href="#"><img src="{{asset('/public/assets/img/information.png')}}"/></a></li>
            @if($Restraunt->videolink == null)
            <li class="information"><a href=""><img src="{{asset('/public/assets/img/electronics.png')}}"/></a></li>
            @else
            <li class="information"><a href="{{$Restraunt->videolink}}" title="{{$Restraunt->LiveLink}}" target="_blank"><img src="{{asset('/public/assets/img/electronics.png')}}"/></a></li>
            @endif
                                  <!--<li><a href="{{ route('login') }}">Login</a></li>-->
                                  <!--<li><a href="{{ route('register') }}">Register</a></li>                      -->
                          </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
              </div>
            </div>
            </div><!-- /.container -->
        </nav>
    </header>
    <section class="blog-tabs-section">
        <div class="container">
            <div class="categories-sec">
                <ul class="nav nav-tabs" id="category">
                    <li><a  data-filter="all" >All</a></li>
				    <?php $cats =  get_Category_by_restid($Restraunt->id); 
				
				    ?>
                    @foreach($cats as $ro=>$v)
                    <li><a data-filter="cat{{$ro}}" >{{$v}}</a></li>
                    @endforeach
                
                </ul> 
            </div>
          
            <div class="mobile-categories-sec">
                <section class="mobile-category slider">
                    <div class="slide">All</div>
                          @foreach($Product as $row)
                    <div class="slide">{{$row->CaTegory}}</div>
                          @endforeach
                </section>
       
             </div>

          
             <div class="row">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                
                    @foreach($Product as $Products)
                    <?php 
                  
                    $catids = '';
                    $catArray = getProductCategory($Products->id); 
                    $extraOption = getProductExtraOption($Products->id); 
                    if($catArray){
                         foreach($catArray as $key=> $cat){
                             $catids = $key;
                         }
                    }
                    ?>
     
                       
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 post"  data-cat="cat<?php echo $catids; ?>">
                    <div class="dish_box">
                         <div class="dish_image">
                            @if($Products->image==null)
                             <img src="{{asset('/public/assets/img/demoLogo.png')}}"> 
                             @else
                            <img src="{{asset('/public/'.$Products->image)}}">  
                            @endif                        
                         </div>
                         <div class="my-flip-details">
                            <h4 class="my-flip-heading">{{$Products->productName}}</h4>
                           <h4 class="my-flip-heading right">${{$Products->price}}</h4> 
                         </div>
                      
                          <div class="dish_cont_on_hover" style="background-color:{{$colour}}">
                              <div class="hover_cont_outr">
                            <p class="hover_desc">{{$Products->description}}</p>
                                    <?php
                                    if($extraOption){ ?>
                                    <div class="dish_extraopt">
                                    <div class="extraoption">Extra Option</div>
                                        <?php
                                        foreach($extraOption as $ke=> $opt){
                                        echo '<p><span class="title">'.$opt.'</span><span class="price">$'.$ke.'</span></p>';
                                        }
                                        ?>  
                                    </div>
                                    <?php }   ?>
                                    
                                    </div>
                          </div>
                      </div>
                  </div>
                    
                  @endforeach
                </div>
             </div>
                  
        </div>
    </section>

<script>
function Copy() 
            {
            var dummy = document.createElement('input'),
            text = window.location.href;
            
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);

                $('.msgcopy').text('URL Copied');
                setTimeout(function(){ $('.msgcopy').text(''); }, 2000);
            }
//slider
 jQuery(document).ready(function(){
    jQuery('.mobile-category').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});

//scroll
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        $(".categories-sec").addClass("fixedHeader");
    } else {
        $(".categories-sec").removeClass("fixedHeader");
    }
});

// var card = document.querySelector(".my-flip-inner-wrapper");
// card.addEventListener("click", function () {
//   card.classList.toggle("is-flipped");
// });
$('.card').click(function(){
  $(this).toggleClass('flipped');
});

// Variable
var posts = $('.post');
//posts.hide();

// Click function
$( "#category li a" ).click(function() { 
    // Get data of category
    var customType = $( this ).data('filter'); // category
    console.log(customType);
    if(customType=='all'){
        posts.show();
    }else{
    console.log(posts.length); // Length of articles
    
    posts
        .hide()
        .filter(function () {
            return $(this).data('cat') === customType;
        })
        .show();
    }
});


$('#example').tooltip({ boundary: 'window' })
</script>
<style type="text/css">
 h4.my-flip-heading.right {
    text-align: right;
}
</style>


</body>
</html>