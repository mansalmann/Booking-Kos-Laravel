const selectElements = document.querySelectorAll('select');

selectElements.forEach(selectElement => {
    selectElement.addEventListener('change', function() {
        if (selectElement.value === "") {
            selectElement.style.color = "#5E6F76"; 
            selectElement.style.fontWeight = "400"; 
        } else {
            selectElement.style.color = "#070707"; 
            selectElement.style.fontWeight = "600"; 
        }
    });

    // Trigger color change on page load
    if (selectElement.value === "") {
        selectElement.style.color = "#5E6F76"; 
        selectElement.style.fontWeight = "400"; 
    } else {
        selectElement.style.color = "#070707"; 
        selectElement.style.fontWeight = "600"; 
    }
});