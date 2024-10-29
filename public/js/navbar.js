document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(item => item.parentElement.classList.remove('active'));
            this.parentElement.classList.add('active');
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
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
document.addEventListener('DOMContentLoaded', function() {
    let isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const seeAllButton = document.querySelector('.btn-wide');
    seeAllButton.addEventListener('click', function(event) {
        event.preventDefault(); 
        if (!isLoggedIn) {
            alert('Silakan login terlebih dahulu untuk melihat semua kost!');
             window.location.href = 'login'; 
        } else {
            window.location.href = 'popular'; 
        }
    });
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('click', function(event) {
            if (!isLoggedIn) {
                event.preventDefault(); 
                alert('Silakan login terlebih dahulu untuk melihat detail kost ini!');
                 window.location.href = 'login'; 
            } else {
                window.location.href = 'best'; 
            }
        });
    });
});

function toggleChat() {
    var chatBox = document.getElementById("chatBox");
    if (chatBox.style.display === "none" || chatBox.style.display === "") {
        chatBox.style.display = "block";
    } else {
        chatBox.style.display = "none";
    }
}

function toggleChat() {
    var chatBox = document.getElementById("chatBox");
    if (chatBox.style.display === "none" || chatBox.style.display === "") {
        chatBox.style.display = "block";
    } else {
        chatBox.style.display = "none";
    }
}

function sendChatMessage() {
    var input = document.getElementById("chatInput");
    var message = input.value.trim();
    
    if (message) {
        var messageContainer = document.createElement("div");
        messageContainer.classList.add("chat-bubble", "user");
        messageContainer.innerHTML = `<p>${message}</p>`;

        document.getElementById("chatMessages").appendChild(messageContainer);
        input.value = "";  // Kosongkan input setelah pesan dikirim
        scrollToBottom();
    }
}

function sendMessage(event) {
    if (event.key === "Enter") {
        sendChatMessage();
    }
}

function scrollToBottom() {
    var chatMessages = document.getElementById("chatMessages");
    chatMessages.scrollTop = chatMessages.scrollHeight;
}


function sendMessage(event) {
    if (event.key === "Enter") {
        sendChatMessage();
    }
}

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
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('.form-row');

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        const location = document.getElementById('location').value;
        const cost = document.getElementById('cost').value;
        const date = document.getElementById('date').value;
        performSearch(location, cost, date);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('.form-row');

    searchForm.addEventListener('submit', function(event) {
        const location = document.getElementById('location').value;
        const cost = document.getElementById('cost').value;
        const date = document.getElementById('date').value;
        performSearch(location, cost, date);
    });
});
function performSearch(location, cost, date) {
    if (location.trim() === '' || cost.trim() === '' || date.trim() === '') {
        alert('Harap isi semua kolom sebelum mencari.');
        return;
    }

    // Lakukan sesuatu dengan nilai input, misalnya mengirim ke server
    console.log('Mencari dengan kriteria:');
    console.log('Lokasi:', location);
    console.log('Biaya:', cost);
    console.log('Tanggal:', date);
    
    // Misalnya, Anda bisa menggunakan AJAX untuk mengirim data ke server
    // fetch('/search', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json'
    //     },
    //     body: JSON.stringify({ location, cost, date })
    // }).then(response => {
    //     // Tangani respons dari server
    //     return response.json();
    // }).then(data => {
    //     // Proses data yang diterima dari server
    // }).catch(error => {
    //     console.error('Error:', error);
    // });
    
    alert(`Pencarian berhasil untuk lokasi: ${location}, rentang harga: ${cost}, dan tanggal: ${date}`);
}


