<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    function toggleProfile(switchElement) {
        var profileSwitchForm = document.getElementById('profileSwitchForm');
        var profileSwitchHeader = document.getElementById('profileSwitchHeader');
        var userForm = document.getElementById('userForm');
        var companyForm = document.getElementById('companyForm');
        var accountTypeBox = document.getElementById('accountTypeBox');
        var body = document.body;

        var isCompany = switchElement.checked;

        if (userForm && companyForm) {
            userForm.style.display = isCompany ? 'none' : 'block';
            companyForm.style.display = isCompany ? 'block' : 'none';

            // Aplicar estilos de doble columna
            applyDoubleColumnStyles(userForm);
            applyDoubleColumnStyles(companyForm);
        }

        if (isCompany) {
            body.classList.add('dark-mode');
        } else {
            body.classList.remove('dark-mode');
        }

        // Sincronizar el otro switch si existe
        if (profileSwitchForm && switchElement !== profileSwitchForm) {
            profileSwitchForm.checked = isCompany;
        }

        if (profileSwitchHeader && switchElement !== profileSwitchHeader) {
            profileSwitchHeader.checked = isCompany;
        }

        localStorage.setItem('profileType', isCompany ? 'company' : 'user');

        // Actualizar el recuadro del tipo de cuenta
        if (accountTypeBox) {
            accountTypeBox.innerText = isCompany ? 'Empresa' : 'Usuario';
        }
    }

    function applyDoubleColumnStyles(formElement) {
        if (!formElement) return;

        var umRows = formElement.querySelectorAll('.um .um-row._um_row_1');
        umRows.forEach(function(row) {
            row.style.display = 'flex';
            row.style.flexWrap = 'wrap';
            row.style.gap = '20px';
        });

        var umCols = formElement.querySelectorAll('.um .um-col-1');
        umCols.forEach(function(col) {
            col.style.flex = '1';
            col.style.minWidth = 'calc(50% - 20px)';
            col.style.boxSizing = 'border-box';
        });
    }

    var profileSwitchForm = document.getElementById('profileSwitchForm');
    var profileSwitchHeader = document.getElementById('profileSwitchHeader');

    if (profileSwitchForm) {
        profileSwitchForm.addEventListener('change', function() {
            toggleProfile(profileSwitchForm);
        });
    }

    if (profileSwitchHeader) {
        profileSwitchHeader.addEventListener('change', function() {
            toggleProfile(profileSwitchHeader);
        });
    }

    // Verificar localStorage al cargar la página
    var profileType = localStorage.getItem('profileType');
    var isCompany = profileType === 'company';

    if (profileSwitchForm) {
        profileSwitchForm.checked = isCompany;
    }

    if (profileSwitchHeader) {
        profileSwitchHeader.checked = isCompany;
    }

    if (profileSwitchForm) {
        toggleProfile(profileSwitchForm);
    } else if (profileSwitchHeader) {
        toggleProfile(profileSwitchHeader);
    }
});
</script>
<!-- end Simple Custom CSS and JS -->
