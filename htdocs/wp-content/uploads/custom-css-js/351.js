<!-- start Simple Custom CSS and JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var checkbox = document.getElementById('user_type');
    var formUsuario = document.getElementById('form_usuario');
    var formEmpresa = document.getElementById('form_empresa');

    checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            formUsuario.style.display = 'none';
            formEmpresa.style.display = 'block';
        } else {
            formUsuario.style.display = 'block';
            formEmpresa.style.display = 'none';
        }
    });
});
</script>
<!-- end Simple Custom CSS and JS -->
