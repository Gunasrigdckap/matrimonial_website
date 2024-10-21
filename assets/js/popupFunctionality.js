
function showErrorPopup(message) {
    document.getElementById('errorMessage').innerText = message;
    document.getElementById('errorPopup').style.display = 'flex';
}

// Check an error in the URL
let urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('error')) {
    let errorType = urlParams.get('error');
    if (errorType === 'login_failed') {
        showErrorPopup('Invalid email or password. Please try again!');
    } else if (errorType === 'empty_fields') {
        showErrorPopup('fill the email and password');
    }
}

document.getElementById('closePopup').onclick = function() {
    document.getElementById('errorPopup').style.display = 'none';
}


window.onclick = function(event) {
    let popup = document.getElementById('errorPopup');
    if (event.target === popup) {
        popup.style.display = 'none';
    }
}

