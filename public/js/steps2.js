let currentStep = 1;
const totalSteps = 4;

function updateProgressBar() {
    document.querySelectorAll('.progress-step-item').forEach(item => {
        const step = parseInt(item.dataset.step);
        item.classList.remove('active', 'completed');
        if (step === currentStep) {
            item.classList.add('active');
        } else if (step < currentStep) {
            item.classList.add('completed');
        }
    });
}

function showStep(step) {
    document.querySelectorAll('.step-container').forEach(container => {
        container.classList.remove('active');
    });
    document.querySelector(`.step-container[data-step="${step}"]`).classList.add('active');

    const prevBtn = document.querySelector('.btn-prev');
    const nextBtn = document.querySelector('.btn-next');

    if (step === 1) {
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'block';
    }

    if (step === totalSteps) {
        nextBtn.innerHTML = 'Selesai<i class="fas fa-check ms-2"></i>';
    } else {
        nextBtn.innerHTML = 'Selanjutnya<i class="fas fa-chevron-right ms-2"></i>';
    }
}

function formatInput(input) {
    let value = input.value.replace(/[^0-9x]/g, '');
    let parts = value.split('x');
    if (parts.length > 2) {
        parts = [parts[0], parts.slice(1).join('')];
    }
    if (parts.length === 2 && parts[1] !== '') {
        input.value = `${parts[0]}x${parts[1]} m`;
    } else {
        input.value = value;
    }
}

function nextStep() {
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
        updateProgressBar();
    } else {
        submitForm();
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
        updateProgressBar();
    }
}

function goToStep(step) {
    currentStep = step;
    showStep(currentStep);
    updateProgressBar();
}

function submitForm() {
    const form = document.getElementById('multiStepForm');
    const formData = new FormData(form);

    // Collect checked fasilitas
    const fasilitas = [];
    document.querySelectorAll('input[name="fasilitas[]"]:checked').forEach(checkbox => {
        fasilitas.push(checkbox.value);
    });

    // Tambahkan fasilitas yang dicentang ke formData
    formData.append('fasilitas', (fasilitas));

    // Kirim data menggunakan fetch
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (data.success) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data kos berhasil disimpan',
                    icon: 'success'
                }).then(() => {
                    if (sessionValue == true) {
                        window.location.href = '';
                    } else {
                        window.location.href = 'datakamar';
                    }
                });
            } else {

                Swal.fire({
                    title: 'Error!',
                    text: data.message,
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.log(error);

            Swal.fire({
                title: 'Sukses!',
                text: 'Data kos berhasil disimpan',
                icon: 'success'
            });
        });
}


// Initialize
document.addEventListener('DOMContentLoaded', function () {
    showStep(currentStep);
    updateProgressBar();
});