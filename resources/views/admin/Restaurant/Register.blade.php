<!DOCTYPE html>
<html>
<head>
<title>GoodieMenu</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600;700;800&display=swap" rel="stylesheet">
</head>
<style>
    .form_outter_ld {
z-index: 999999;
}
.inner_content {
    padding: 60px 0;
    color: #fff;
}
h1, h3, h2{
   font-family: 'Montserrat', sans-serif;
   font-weight:800;
}
p{
   font-family: 'Montserrat', sans-serif;
   font-weight:300;
}
.second_font{
color:#000;
}
.form_outter_ld label {
    width: 100%;
}

.form_outter_ld input {
    width: 100%;
        padding: 5px;
        background:#efebeb;
            border: 1px solid #9a9797;
}
section.ld_outter {
    position: relative;
}
.form_outter_ld {
    padding: 30px 20px;
    background: #efebeb;
    position: absolute;
    top: 20px;
    color: #545454;
    border-radius: 30px;
    box-shadow: 0 5px 15px 0 #8c8c8c;
}
.orange{
  background:#f4b04a;
}
h1.ct_logo {
    text-align: center;
    padding: 20px 0;
    margin: 0;
}
.inner_content p {
    font-size: 23px;
}
h1.ct_logo span {
    color: #f14545;
}
.inner_content h1 {
    font-size: 45px;
    margin-bottom: 20px;
}
.form_outter_ld h3 {
    text-align: center;
    font-size: 25px;
}
.second_font h1 {
    font-size: 35px;
}
.second_font p {
    font-size: 18px;
}
.form_outter_ld label {
    margin: 15px 0 5px;
}
.form_outter_ld button {
    background: #dc3c4d;
    border: none;
    padding: 8px 30px;
    border-radius: 30px;
    color: #fff;
    font-size: 20px;
    font-weight: 600;
    text-align: center;
        margin-top: 20px;
    }
.sign_up_box{
  text-align:center;
}   
footer {
    background: #545454;
        padding-bottom: 80px;
}
.footer_logo h1.ct_logo {
    font-size: 20px;
    color: #fff;
}
.footer_logo h1.ct_logo {
    font-size: 20px;
    color: #fff;
}

.footer_menu ul {
    margin: 0;
    padding: 23px 0;
}
.footer_menu ul li a{
   color:#fff;
}
.footer_menu ul li {
    list-style: none;
    display: inline-block;
    margin-right: 40px;
    font-size: 16px;
    color: #fff;
}
a:hover{
text-decoration:none;
}
.ct_logo{
color:#545454;
}
.sign_up_box p {
    font-size: 14px;
    margin-top: 15px;
}
.inner_sct_img img{
 width:100%;
}
section.third_section {
    text-align: center;
    padding: 50px 0;
}
.heading_part h2 {
    font-weight: 500;
}
.heading_part h3 {
    font-weight: 500;
    color: #f14545;
}
.in_content_box {
    margin-bottom: 40px;
}
.heading_part {
    margin-bottom: 80px;
}
.in_content_box h5 {
    margin-bottom: 15px;
    color: #545454;
}
.in_content_box p {
    color: #545454;
}


@media (min-width:992px) and (max-width:1200px){
.footer_menu ul li {
   margin-right: 35px;
    font-size: 14px;
}
.footer_menu ul {
    padding: 20px 0;
}
.footer_logo h1.ct_logo {
    font-size: 18px;
}
.sign_up_box p {
    font-size: 13px;
    }
}
@media (min-width:768px) and (max-width:992px){
.footer_menu ul li {
    margin-right: 10px;
    font-size: 12px;
}
.inner_content {
    padding: 40px 0;
}
.form_outter_ld h3 {
    font-size: 18px;
}
}
@media (min-width:575px) and (max-width:768px) {
h1.ct_logo {
    font-size: 25px;
}
.heading_part h2 {
    font-size: 28px;
}
}
@media (max-width:768px) {
.form_outter_ld {
    position: inherit;
    top: 0;
    margin-bottom: -200px;
}
footer {
    padding-bottom: 0;
}
.white_box {
    padding-top: 200px;
}
.footer_menu ul {
    padding-top: 0;
}
.footer_menu ul li:first-child {
    display: block;
    width: 100%;
    text-align: center;
    font-weight: 300;
}
.footer_menu ul li {
    margin-right: 10px;
    width: 30%;
    text-align: center;
    margin-bottom:10px;
    font-weight: 600;
}
}
@media (max-width:575px){
   h1.ct_logo {
    font-size: 18px;
}
.inner_content {
    padding: 40px 0;
}
.inner_content h1 {
    font-size: 30px;
}
.inner_content p {
    font-size: 18px;
}
}
@media (max-width:400px){
.footer_menu ul li {
    margin-right: 0px;
    width: 32%;
    margin-bottom: 6px;
    font-size: 12px;
}
.footer_logo h1.ct_logo {
    font-size: 16px;
}
}
</style>
<body>
<header>
     <a ><h1 class="ct_logo"><span>GoodieMenu</span> For Restaurants</h1></a>
</header>
<section class="ld_outter">
   <div class="orange">
    <div class="container">
        <div class="row ">
             <div class="col-md-7 col-sm-12">
                 <div class="inner_content">
                      <h1>Get a Beautiful Modern Menu To Connect More With Your Customers</h1>
                      <p>Upload beautiful photos of your dishes to your GoodieMenu for a better customer experience online. We publish your GoodieMenu to sites like Google, Tripadvisor, Yelp and more</p>
                 </div>
             </div>
             <div class="col-md-5 col-sm-12">
                <div class="form_outter_ld">
                    <h3>Sign up for GoodieMenu</h3>
                    @if(Session::has('warning'))
                           <div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>
                           @endif
                           @if(Session::has('danger'))
                           <div class="alert alert-danger" role="alert">{{ Session::get('danger') }}</div>
                           @endif
                           @if(Session::has('success'))
                           <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                           @endif
                    <form method="post" action="{{ route('Registerform.save') }}">
                     @csrf
                     <label for="fname">First name:</label>
                    <input type="text" name="firstname" value="<?php echo old('firstname') ?>" required="">
                     <label for="fname">Last name:</label>
                    <input type="text" name="lastname" value="<?php echo old('lastname') ?>" required="">
                    <label for="fname">Phone:</label>
                    <input type="text" name="contact" value="<?php echo old('contact') ?>" required="">
                    <label for="fname">Restaurant name:</label>
                    <input type="text" name="restraunt_name" value="<?php echo old('restraunt_name') ?>" required="">
                    <label for="fname">Email:</label>
                    <input type="email" name="email" value="<?php echo old('email') ?>" required="">
                    <label for="fname">Zipcode:</label>
                    <input type="text" name="zipcode" value="<?php echo old('zipcode') ?>" required="">
                    <div class="sign_up_box">
                    <button type="submit" value="">Sign Up</button>
                    </form>
                    <p>*By clicking "Sign Up" or by using this site. you agree to GoodieMenu's terms of use and privacy policy.</p>
                    </div>
                </div>
             </div>
        </div>
    </div>
    </div>
    <div class="white_box">
    <div class="container"> 
        <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="inner_content second_font">
                      <h1>A Menu Platform Meant To Show Off Your Dishes</h1>
                      <p>Here at GoodieMenu, We believe that your dishes are what hungry consumers want to see. We concentrate on bringing beautiful photos of your dishes to the front of the internet.</p>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
        </div>
        </div>
        </div>
        </div>
    </div>
</section>
<section class="third_section">
     <div class="container">
         <div class="row">
            <div class="col-md-12">
                <div class="heading_part">
                    <h2>What do you get with our menus?</h2>
                    <h3>A whole lot.</h3>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="in_content_box">
                     <h5>Modern Design</h5>
                     <p>Just send us a copy of your menu or we can get it from your website. We'll input your menu items for you and your Goodiemenu is generated.</p>
                 </div>
                 <div class="in_content_box">
                     <h5>Dish Photos Matter</h5>
                     <p>A menu that is centered around photos of your dishes. Like instagram ? Then you'll love us</p>
                 </div>
                 <div class="in_content_box">
                     <h5>Menu Publishing</h5>
                     <p>Once your GoodieMenu is 100% complete with beautiful photos. We work in the background to make sure everyone knows. </p>
                 </div>
            </div>
            <div class="col-md-6">
                <div class="inner_sct_img">
                    <img src="{{asset('/public/assets/img/right_image.jpg')}}">
                </div>
            </div>
         </div>
     </div>
</section>
<footer>
     <div class="container">
         <div class="row">
              <div class="col-md-4 col-sm-12">
                  <div class="footer_logo">
                      <a href="#"><h1 class="ct_logo"><span>GoodieMenu</span> For Restaurants</h1></a>
                  </div>
              </div>
              <div class="col-md-8 col-sm-12">
                  <div class="footer_menu">
                      <ul>
                         <li>2020 GoodieMenu LLC. All rights reserved</li>
                         <li><a href="#">Terms of Use</a></li>
                         <li><a href="#">Privacy Policy</a></li>
                         <li><a href="#">Help</a></li>
                      </ul>
                  </div>
              </div>
         </div>
     </div>
</footer>
</body>
</html>