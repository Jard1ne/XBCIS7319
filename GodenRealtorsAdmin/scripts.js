// Add Property Modal
function openAddPropertyModal() {
    document.getElementById('addPropertyModal').style.display = 'block';
}

function closeAddPropertyModal() {
    document.getElementById('addPropertyModal').style.display = 'none';
}

// Edit Property Modal
function openEditPropertyModal() {
    document.getElementById('editPropertyModal').style.display = 'block';
}

function closeEditPropertyModal() {
    document.getElementById('editPropertyModal').style.display = 'none';
}

// Delete Property Function
function deleteProperty() {
    alert('Property deleted successfully!');
}

// Add User Modal
function openAddUserModal() {
    document.getElementById('addUserModal').style.display = 'block';
}

function closeAddUserModal() {
    document.getElementById('addUserModal').style.display = 'none';
}

// Edit User Modal
function openEditUserModal() {
    document.getElementById('editUserModal').style.display = 'block';
}

function closeEditUserModal() {
    document.getElementById('editUserModal').style.display = 'none';
}

// Delete User Function
function deleteUser() {
    alert('User deleted successfully!');
}

// Reply to Enquiry Modal
function openReplyModal() {
    document.getElementById('replyModal').style.display = 'block';
}

function closeReplyModal() {
    document.getElementById('replyModal').style.display = 'none';
}

// Delete Enquiry Function
function deleteEnquiry() {
    alert('Enquiry deleted successfully!');
}

// Visitor Analytics Chart
const ctx1 = document.getElementById('visitorChart').getContext('2d');
const visitorChart = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Visitors',
            data: [50, 100, 150, 200, 250, 300],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Revenue Statistics Chart
const ctx2 = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Revenue',
            data: [300, 500, 400, 600, 700, 800],
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
