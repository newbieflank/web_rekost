document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('#rating-container .fa-star');
    const ratingInput = document.getElementById('ratingInput');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-rating'); // Ambil nilai rating
            ratingInput.value = rating; // Set nilai rating di input tersembunyi
            updateStars(rating); // Update tampilan bintang
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-rating') <= rating) {
                star.classList.add('active');
                star.classList.remove('inactive');
            } else {
                star.classList.add('inactive');
                star.classList.remove('active');
            }
        });
    }
});

// Function to handle star rating click
const stars = document.querySelectorAll('#rating-container .fas.fa-star');
stars.forEach(star => {
    star.addEventListener('click', function() {
        const rating = this.getAttribute('data-rating');
        document.getElementById('ratingInput').value = rating;

        // Remove 'active' class from all stars
        stars.forEach(star => {
            star.classList.remove('active');
        });

        // Add 'active' class to clicked star and all stars before it
        for (let i = 0; i < rating; i++) {
            stars[i].classList.add('active');
        }
    });
});

// Form validation function
function validateForm() {
    const rating = document.getElementById('ratingInput').value;
    const reviewInput = document.getElementById('reviewInput').value.trim();

    if (!rating || !reviewInput) {
        alert("Harap isi rating dan ulasan terlebih dahulu.");
        return false;
    }
    return true;
}

