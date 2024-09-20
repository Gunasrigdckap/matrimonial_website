// Utility function to set error message
function setError(elementId, message) {
    document.getElementById(elementId).textContent = message;
}

// Utility function to clear error message
function clearError(elementId) {
    document.getElementById(elementId).textContent = '';
}

// Utility function to check if a field is empty
function isEmpty(value) {
    return value.trim() === '';
}

// Utility function for pattern validation
function isValidPattern(value, pattern) {
    return pattern.test(value);
}

// Utility function for comparing values (ex, passwords)
function doValuesMatch(value1, value2) {
    return value1 === value2;
}
