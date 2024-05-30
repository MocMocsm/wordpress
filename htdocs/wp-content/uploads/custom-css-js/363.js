<!-- start Simple Custom CSS and JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileSwitchHeader = document.getElementById('profileSwitchHeader');
    const profileSwitchForm = document.getElementById('profileSwitchForm');
    const userForm = document.getElementById('userForm');
    const companyForm = document.getElementById('companyForm');
    
    // Función para cambiar el modo
    function changeMode(isCompany) {
        if (isCompany) {
            document.body.classList.add('empresa-mode');
            document.body.classList.remove('usuario-mode');
            userForm.style.display = 'none';
            companyForm.style.display = 'block';
        } else {
            document.body.classList.add('usuario-mode');
            document.body.classList.remove('empresa-mode');
            userForm.style.display = 'block';
            companyForm.style.display = 'none';
        }
        profileSwitchHeader.checked = isCompany;
        profileSwitchForm.checked = isCompany;
        localStorage.setItem('profileMode', isCompany ? 'empresa' : 'usuario');
    }
    
    // Evento para el switch del header
    if (profileSwitchHeader) {
        profileSwitchHeader.addEventListener('change', function() {
            changeMode(profileSwitchHeader.checked);
        });
    }
    
    // Evento para el switch del formulario
    if (profileSwitchForm) {
        profileSwitchForm.addEventListener('change', function() {
            changeMode(profileSwitchForm.checked);
        });
    }
    
    // Inicializar el estado del modo al cargar la página
    const savedMode = localStorage.getItem('profileMode');
    if (savedMode) {
        changeMode(savedMode === 'empresa');
    } else {
        changeMode(false); // Por defecto, modo usuario
    }
});
</script>
<!-- end Simple Custom CSS and JS -->
