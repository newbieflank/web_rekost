$(function () {

    const inputs = document.querySelectorAll("#myForm input, #myForm select");
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


    //ingin di ubah
    document.getElementById("inputInstansi").addEventListener("change", function () {
        const newSchoolName = document.getElementById("newSchoolName");

        // Check if "Other" is selected
        if (this.value === "other") {
            this.style.display = "none"; // Hide the select element
            newSchoolName.style.display = "block"; // Show the input field
            newSchoolName.focus(); // Focus the input field for "Other"
        }
    });

    // Handle when the input field loses focus
    document.getElementById("newSchoolName").addEventListener("blur", function () {
        const inputSekolah = document.getElementById("inputInstansi");

        // If input is empty, revert back to the select dropdown
        if (this.value === "") {
            this.style.display = "none"; // Hide the input field
            inputSekolah.style.display = "block"; // Show the select element
            inputSekolah.value = ""; // Reset the select to the default option
        } else {
            // Otherwise, update the select with the input value as its display
            inputSekolah.value = this.value; // Set select value to the input
        }
    });

    // Add a submit event listener to the form
    document.getElementById("myForm").addEventListener("submit", function () {
        const inputSekolah = document.getElementById("inputInstansi");
        const newSchoolName = document.getElementById("newSchoolName");

        // If "Other" is selected and the input field has a value, update the select
        if (inputSekolah.value === "other" && newSchoolName.value !== "") {
            inputSekolah.value = newSchoolName.value; // Set the select value to the input value
        }
    });
});

