// Toggle sidebar visibility
const sidebar = document.getElementById('sidebar');
const toggleSidebarBtn = document.getElementById('toggleSidebar');

toggleSidebarBtn.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
});

// Line Chart (Sales Data)
var ctxSales = document.getElementById('salesChart').getContext('2d');
var salesChart = new Chart(ctxSales, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Sales',
            data: [10, 20, 30, 40, 50, 60],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Pie Chart (Category Data)
var ctxCategory = document.getElementById('categoryChart').getContext('2d');
var categoryChart = new Chart(ctxCategory, {
    type: 'pie',
    data: {
        labels: ['Category 1', 'Category 2', 'Category 3', 'Category 4'],
        datasets: [{
            data: [25, 15, 30, 30],
            backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0'],
            borderColor: '#fff',
            borderWidth: 1
        }]
    }
});
