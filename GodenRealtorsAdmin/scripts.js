// Function to open the Add Property Modal
function openAddPropertyModal() {
    document.getElementById('addPropertyModal').style.display = 'block';
}

// Function to close the Add Property Modal
function closeAddPropertyModal() {
    document.getElementById('addPropertyModal').style.display = 'none';
}

// Function to open the Edit Property Modal
function openEditPropertyModal() {
    document.getElementById('editPropertyModal').style.display = 'block';
}

// Function to close the Edit Property Modal
function closeEditPropertyModal() {
    document.getElementById('editPropertyModal').style.display = 'none';
}

// Close modals if user clicks outside the modal content
window.onclick = function(event) {
    const addModal = document.getElementById('addPropertyModal');
    const editModal = document.getElementById('editPropertyModal');
    
    if (event.target == addModal) {
        addModal.style.display = 'none';
    }
    
    if (event.target == editModal) {
        editModal.style.display = 'none';
    }
}
// Delete Property Function
function deleteProperty() {
    alert('Property deleted successfully!');
}

function openAddUserModal() {
    document.getElementById('addUserModal').style.display = 'block';
}

function closeAddUserModal() {
    document.getElementById('addUserModal').style.display = 'none';
}

function openEditUserModal(userId) {
    // Fetch user data from server or data attributes and populate the form
    document.getElementById('editUserId').value = userId;
    // Other form fields should be populated as needed
    document.getElementById('editUserModal').style.display = 'block';
}

function closeEditUserModal() {
    document.getElementById('editUserModal').style.display = 'none';
}

function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        // Send a POST request to delete the user
        fetch('delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'userId=' + userId
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // Reload the page to reflect changes
        })
        .catch(error => console.error('Error:', error));
    }
}

function openReplyModal(button) {
    // Get the inquiry data from the clicked button's parent element
    const enquiryItem = button.closest('.enquiry-item');
    const inquiryUsername = enquiryItem.getAttribute('data-inquiry-username');
    const inquiryMessage = enquiryItem.getAttribute('data-inquiry-message');
    const inquiryProperty = enquiryItem.getAttribute('data-inquiry-property');

    // Populate the modal fields with the inquiry data
    document.getElementById('inquiryUsername').value = inquiryUsername;
    document.getElementById('inquiryProperty').value = inquiryProperty;
    document.getElementById('inquiryMessage').value = inquiryMessage;

    // Display the modal
    document.getElementById('replyModal').style.display = 'block';
}

function closeReplyModal() {
    document.getElementById('replyModal').style.display = 'none';
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
