<?php 
            $args = array(
                'theme_location' => 'secondary',
                 'menu_class' => 'mymenu'
            );
        ?>
        <footer>
          <div class="menu-nav">
           <?php
              /* secondary: in functions.php */
              wp_nav_menu($args); ?>
            </div>
        </footer>
    </div><!-- END #container -->
<!-- JS -->
<?php wp_footer(); ?>
</body>
</html>