<!-- start Simple Custom CSS and JS -->
function custom_random_button_color() {
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Generar un color aleatorio
            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            // Aplicar color aleatorio al botón de usuarios
            const userSubmitButton = document.querySelector('.page-id-118 .wpcf7-form input[type="submit"]');
            if (userSubmitButton) {
                userSubmitButton.style.backgroundColor = getRandomColor();
            }

            // Aplicar color aleatorio al botón de empresarios
            const businessSubmitButton = document.querySelector('.page-id-118 .wpcf7-form input[type="submit"]');
            if (businessSubmitButton) {
                businessSubmitButton.style.backgroundColor = getRandomColor();
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'custom_random_button_color');
<!-- end Simple Custom CSS and JS -->
