            <footer>
                <?php
                require "assets/".$theme."/inc/footer.php";
                ?>
                <p class="copyright" style="font-size:0.7em;">Mini Cms - project by <a href="https://github.com/damares86">damares86</a></p>
            </footer>
        </div>

        
        <?php
            require "assets/".$theme."/inc/cookie.php";
        ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/dm_theme/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/dm_theme/js/popper.min.js"></script>
    <script src="admin/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/dm_theme/js/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
	</body>
</html>
