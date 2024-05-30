<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    function toggleProfile() {
        var profileSwitch = document.getElementById('profileSwitch');
        var userForm = document.getElementById('userForm');
        var companyForm = document.getElementById('companyForm');

        if (profileSwitch.checked) {
            userForm.style.display = 'none';
            companyForm.style.display = 'block';
        } else {
            userForm.style.display = 'block';
            companyForm.style.display = 'none';
        }
    }

    var profileSwitch = document.getElementById('profileSwitch');
    if (profileSwitch) {
        // Check the switch state on page load
		toggleProfile();
        profileSwitch.addEventListener('change', toggleProfile);
    }
});
</script>
<!-- end Simple Custom CSS and JS -->
