function setRating(rating) {
    // Set nilai rating pada input tersembunyi
    document.getElementById('ratingValue').value = rating;

    // Ambil semua elemen bintang
    const stars = document.querySelectorAll('.star-rating .fas');
    
    // Loop melalui bintang-bintang dan tambahkan/lepaskan kelas 'selected'
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.add('selected');
        } else {
            star.classList.remove('selected');
        }
    });
}
