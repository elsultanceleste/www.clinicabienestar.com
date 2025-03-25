document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Show loading alert
    Swal.fire({
        title: 'Enviando mensaje...',
        html: 'Por favor espere',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './controllers/process_contact.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: response.message,
                    confirmButtonColor: '#00a8cc'
                });
                document.getElementById('contactForm').reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                    confirmButtonColor: '#00a8cc'
                });
            }
        }
    };

    xhr.send(formData);
});