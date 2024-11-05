$(function () {

    const inputs = document.querySelectorAll("#myForm input, #myForm select, #myForm textarea");
    const saveBtn = document.getElementById("saveBtn");
    const resetBtn = document.getElementById("resetBtn");


    flatpickr("#customDate", {
        dateFormat: "d-F-Y",
        altInput: true,
        altFormat: "d-F-Y",
    });


    const initialValues = {};
    inputs.forEach(input => initialValues[input.id] = input.value);

    function redirectTopopular() {
        window.location.href = 'popular';
    }

    function checkForChanges() {
        let hasChanged = false;

        inputs.forEach(input => {
            if (input.value !== initialValues[input.id]) {
                hasChanged = true;
            }
        });


        if (hasChanged) {
            saveBtn.disabled = false;
            saveBtn.classList.add("enabled");
            resetBtn.disabled = false;
            resetBtn.classList.add("enabled");
        } else {
            saveBtn.disabled = true;
            saveBtn.classList.remove("enabled");
            resetBtn.disabled = true;
            resetBtn.classList.remove("enabled");
        }
    }


    inputs.forEach(input => {
        input.addEventListener("input", checkForChanges);
        input.addEventListener("change", checkForChanges);
    });


    resetBtn.addEventListener("click", function () {
        inputs.forEach(input => {
            input.value = initialValues[input.id];
        });

        saveBtn.disabled = true;
        saveBtn.classList.remove("enabled");
        resetBtn.disabled = true;
        resetBtn.classList.remove("enabled");
    });

    document.getElementById('profileImage').onchange = function (event) {
        const [file] = event.target.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Display selected image in the modal or as a preview
                document.querySelector('.imgProfile img').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };




});

