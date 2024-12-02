$(document).ready(function () {
    let duration = 1;
    let customDays = 0;

    flatpickr("#customDate", {
        dateFormat: "d-F-Y",
        altInput: true,
        altFormat: "d-F-Y",
        onChange: function (selectedDates, dateStr, instance) {
            document.getElementById("detailTanggalAwal").textContent = dateStr;
            calculateEndDate(dateStr);
        }
    });

    document.getElementById('duration').addEventListener('change', function () {
        duration = parseInt(this.value);
        const startDate = document.getElementById('customDate').value;

        if (startDate) {
            calculateEndDate(startDate);
        }
    });

    document.getElementById('customDays').addEventListener('input', function () {
        customDays = parseInt(this.value) || 0;
        const startDate = document.getElementById('customDate').value;

        if (startDate) {
            calculateEndDate(startDate);
        }
    });

    function calculateEndDate(startDateStr) {
        const startDate = new Date(startDateStr);
        let durationDays = 0;

        if (duration === 1) {
            durationDays = customDays;
        } else if (duration === 2) {
            durationDays = 7;
        } else if (duration === 3) {
            durationDays = 30;
        } else if (duration === 4) {
            durationDays = 90;
        } else if (duration === 5) {
            durationDays = 365;
        }

        const endDate = new Date(startDate);
        endDate.setDate(endDate.getDate() + durationDays);

        const formattedEndDate = endDate.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

        document.getElementById('detailTanggalAkhir').textContent = formattedEndDate;
    }
});
