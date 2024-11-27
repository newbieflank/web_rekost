
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

    if (step === 3) {
        setTimeout(() => {
            initMap();
        }, 100);
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

function setUkuran(value) {
    var customInput = document.getElementById('UkuranCustom');
    if (value === "custom") {
        customInput.style.display = 'block';
        customInput.focus();
    } else {
        customInput.style.display = 'none';
        customInput.value = value;
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
                    window.location.href = 'datakamar';
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

            console.error('Error:', error);
            Swal.fire({
                title: 'Sukses!',
                text: 'Data kos berhasil disimpan',
                icon: 'success'
            });
        });
}

function previewImage(input, previewId,) {
    const previewDiv = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Replace the content with the uploaded image
            previewDiv.innerHTML = `<img src="${e.target.result}" alt="Preview Image">`;
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // Reset to default if no file is selected
        previewDiv.innerHTML = `
            <i class="fas fa-camera"></i>
            <p class="text-gray-400">Tambah foto</p>
        `;
    }
}


// Initialize
document.addEventListener('DOMContentLoaded', function () {
    showStep(currentStep);
    updateProgressBar();
});