<?php
ini_set('display_errors', 'off');
session_start(); 

?>

<?php include 'header.php'; ?>

<!-- Home -->

<div class="home">
  <div class="home_slider_container">

    <!-- Home Slider -->
    <div class="owl-carousel owl-theme home_slider">

      <!-- Slider Item -->
      <div class="owl-item home_slider_item">
        <div class="home_slider_background" style="background-image:url(images/fish1.jpg)"></div>
      </div>

      <!-- Slider Item -->
      <div class="owl-item home_slider_item">
        <div class="home_slider_background" style="background-image:url(images/fish2.jpg)"></div>
      </div>

      <!-- Slider Item -->
      <div class="owl-item home_slider_item">
        <div class="home_slider_background" style="background-image:url(images/fish3.jpg)"></div>
      </div>

    </div>

    <!-- Home Slider Dots -->

    <div class="home_slider_dots_container">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="home_slider_dots">
              <ul id="home_slider_custom_dots" class="home_slider_custom_dots">
                <li class="home_slider_custom_dot active">01.</li>
                <li class="home_slider_custom_dot">02.</li>
                <li class="home_slider_custom_dot">03.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>  
    </div>

  </div>
</div>

<!-- Ads -->

<div class="avds">
  <div class="avds_container d-flex flex-lg-row flex-column align-items-start justify-content-between">
    <div class="avds_small">
      <div class="avds_background" style="background-image:url(images/fish6.jpg)"></div>
      <div class="avds_small_inner">
        <div class="avds_discount_container">
          <img src="images/discount.png" alt="">
          <div>
            <div class="avds_discount">
              <div>20<span>%</span></div>
              <div>Discount</div>
            </div>
          </div>
        </div>
        <div class="avds_small_content">
          <div class="avds_title">Smart Fishes</div>
          <div class="avds_link"><a href="#">See More</a></div>
        </div>
      </div>
    </div>
    <div class="avds_large">
      <div class="avds_background" style="background-image:url(images/fish5.jpg)"></div>
      <div class="avds_large_container">
        <div class="avds_large_content">
          <div class="avds_title">Professional Aquariums</div>
          <div class="avds_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viver ra velit venenatis fermentum luctus.</div>
          <div class="avds_link avds_link_large"><a href="#">See More</a></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Products -->

<?php

$conn = new mysqli("localhost", "root", "", "register");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_id, product_name, product_price, product_description, product_image FROM products";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
?>

<?php
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $product_id = $row['product_id']; 
    $product_name = $row['product_name'];
    $product_price = $row['product_price'];
    $product_description = $row['product_description'];
    $product_image = 'images/' . $row['product_image'];
    ?>

    <div class="products">
      <div>
        <div class="row">
          <div class="col">


            <!-- Product -->
            <div class="product">
              <div class="product_image"><?php echo "<img src='$product_image'>" ?></div>
              <div class="product_content">
                <div class="product_title"><?php echo "<strong class='text-gray-dark'>$product_name</strong>" ?></div>
                <?php echo "<a href='productpage.php?product_id=$product_id'><button class='btn btn-primary rounded-pill px-3'>Read more</button></a>" ?>
                <div class="product_price"><?php echo "<span class='d-block prprice'>$product_price USD</span>" ?></div>
              </div>
            </div>
            
            <?php
          }
        } else {
          echo "0 results";
        }
        ?>
        
      </div>
    </div>
  </div>
</div>

<!-- Ad -->

<div class="avds_xl">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="avds_xl_container clearfix">
          <div class="avds_xl_background" style="background-image:url(images/fish4.jpg)"></div>
          <div class="avds_xl_content">
            <div class="avds_title">Amazing Fishes</div>
            <div class="avds_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus.</div>
            <div class="avds_link avds_xl_link"><a href="#">See More</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Icon Boxes -->

<div class="icon_boxes">
  <div class="container">
    <div class="row icon_box_row">

      <!-- Icon Box -->
      <div class="col-lg-4 icon_box_col">
        <div class="icon_box">
          <div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
          <div class="icon_box_title">Free Shipping Worldwide</div>
          <div class="icon_box_text">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
          </div>
        </div>
      </div>

      <!-- Icon Box -->
      <div class="col-lg-4 icon_box_col">
        <div class="icon_box">
          <div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
          <div class="icon_box_title">Free Returns</div>
          <div class="icon_box_text">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
          </div>
        </div>
      </div>

      <!-- Icon Box -->
      <div class="col-lg-4 icon_box_col">
        <div class="icon_box">
          <div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
          <div class="icon_box_title">24h Fast Support</div>
          <div class="icon_box_text">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="newsletter_border"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="newsletter_content text-center">
          <div class="newsletter_title">Subscribe to our newsletter</div>
          <div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
          <div class="newsletter_form_container">
            <form action="#" id="newsletter_form" class="newsletter_form">
              <input type="email" class="newsletter_input" required="required">
              <button class="newsletter_button trans_200"><span>Subscribe</span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>