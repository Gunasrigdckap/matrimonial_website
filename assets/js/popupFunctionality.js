
function showErrorPopup(message) {
    document.getElementById('errorMessage').innerText = message;
    document.getElementById('errorPopup').style.display = 'flex';
}

// Check if there is an error in the URL
let urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('error')) {
    let errorType = urlParams.get('error');
    if (errorType === 'login_failed') {
        showErrorPopup('Invalid email or password. Please try again!');
    } else if (errorType === 'empty_fields') {
        showErrorPopup('Please fill in both email and password!');
    }
}

// Close the popup when the user clicks on <span> (x)
document.getElementById('closePopup').onclick = function() {
    document.getElementById('errorPopup').style.display = 'none';
}

// Close the popup when clicking anywhere outside of it
window.onclick = function(event) {
    let popup = document.getElementById('errorPopup');
    if (event.target === popup) {
        popup.style.display = 'none';
    }
}

