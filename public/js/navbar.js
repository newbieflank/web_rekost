document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(item => item.parentElement.classList.remove('active'));
            this.parentElement.classList.add('active');
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    // Mengambil data jumlah review
    fetch('/api/reviews/count')
        .then(response => response.json())
        .then(data => {
            const reviewsCount = document.querySelector('.reviews h2:nth-child(1)');
            reviewsCount.innerText = `${data.count}K+`;
        })
        .catch(error => console.error('Error fetching reviews count:', error));

    // Mengambil data jumlah bookings
    fetch('/api/bookings/count')
        .then(response => response.json())
        .then(data => {
            const bookingsCount = document.querySelector('.reviews h2:nth-child(2)');
            bookingsCount.innerText = `${data.count}K+`;
        })
        .catch(error => console.error('Error fetching bookings count:', error));
});
function scrollToBottom() {
    var chatMessages = document.getElementById("chatMessages");
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function sendReview() {
    const reviewInput = document.getElementById('reviewInput');
    const reviewText = reviewInput.value;

    if (reviewText.trim() !== '') {
        alert('Ulasan berhasil dikirim: ' + reviewText);
    } else {
        alert('Harap tuliskan ulasan anda sebelum mengirim.');
    }
}


