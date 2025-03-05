<footer class="container-fluid text-center">
<footer class="container-fluid text-center" style="background-color: #f8f9fa; padding: 40px 0; margin-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 style="color: #5271ff; margin-bottom: 20px;">ExpreService</h4>
                <p>Tu plataforma confiable para encontrar servicios profesionales de calidad.</p>
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" style="height: 60px; margin-top: 15px;">
            </div>

            <div class="col-md-4">
                <h4 style="color: #5271ff; margin-bottom: 20px;">Enlaces Rápidos</h4>
                <ul class="list-unstyled">
                    <li><a href="#inicio" style="color: #333; text-decoration: none;">Inicio</a></li>
                    <li><a href="#servicios" style="color: #333; text-decoration: none;">Servicios</a></li>
                    <li><a href="#nosotros" style="color: #333; text-decoration: none;">Nosotros</a></li>
                    <li><a href="#contacto" style="color: #333; text-decoration: none;">Contacto</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h4 style="color: #5271ff; margin-bottom: 20px;">Contáctanos</h4>
                <p><i class="glyphicon glyphicon-phone"></i> +123 456 789</p>
                <p><i class="glyphicon glyphicon-envelope"></i> info@expreservice.com</p>
                <div class="social-icons" style="margin-top: 20px;">
                    <a href="#" style="color: #5271ff; margin: 0 10px;"><i class="fa fa-facebook fa-lg"></i></a>
                    <a href="#" style="color: #5271ff; margin: 0 10px;"><i class="fa fa-twitter fa-lg"></i></a>
                    <a href="#" style="color: #5271ff; margin: 0 10px;"><i class="fa fa-instagram fa-lg"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr style="border-color: #ddd;">
                <p style="margin-top: 20px;">&copy; <?php echo date('Y'); ?> ExpreService. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
