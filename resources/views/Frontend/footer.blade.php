    

    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-circle-up"></i></button>
    <div id="content" class="main-content">
    <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2021 <a target="_blank" href="#">The Samaj</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Design & Developed by <a href="https://www.polosoftech.com/" target="_blank">PoloSoft Technologies </a></p>
            </div>
        </div>
    </div>
    
    <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<script type="text/javascript">
    function topFunction() {
 
     $('html, body').animate({scrollTop:0}, 'slow');
}
</script>