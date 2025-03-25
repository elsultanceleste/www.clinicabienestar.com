document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('recovery_email').value;
    Swal.fire({
        title: "Enviando...",
        text: "Por favor, espere",
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/password_recovery.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.response);
            
            const data = JSON.parse(xhr.responseText);
            if (data.status === 'success') {
                document.getElementById('forgotPasswordForm').style.display = 'none';
                document.getElementById('verificationForm').style.display = 'block';
                Swal.fire('¡Éxito!', 'Código de verificación enviado a su email', 'success');
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        }
    };
    
    xhr.send('action=send_code&email=' + encodeURIComponent(email));
});

document.getElementById('verificationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const code = document.getElementById('verification_code').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/password_recovery.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            if (data.status === 'success') {
                document.getElementById('verificationForm').style.display = 'none';
                document.getElementById('newPasswordForm').style.display = 'block';
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        }
    };
    
    xhr.send('action=verify_code&code=' + encodeURIComponent(code));
});

document.getElementById('newPasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const password = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if (password !== confirmPassword) {
        Swal.fire('Error', 'Las contraseñas no coinciden', 'error');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'controllers/password_recovery.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            if (data.status === 'success') {
                Swal.fire('¡Éxito!', 'Contraseña actualizada correctamente', 'success');
                $('#forgotPasswordModal').modal('hide');
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        }
    };
    
    xhr.send('action=change_password&password=' + encodeURIComponent(password));
});