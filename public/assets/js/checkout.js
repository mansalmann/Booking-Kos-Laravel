// Get all tab buttons
const tabLinks = document.querySelectorAll('.tab-link');

// Add click event listener to each button
tabLinks.forEach(button => {
    button.addEventListener('click', () => {
        // Get the target tab id from the data attribute
        const targetTab = button.getAttribute('data-target-tab');
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Show the target tab content
        document.querySelector(targetTab).classList.toggle('hidden');
    });
});

// Get the necessary elements
const downPaymentPrice = document.getElementById('downPaymentPrice').textContent;
const fullPaymentPrice = document.getElementById('fullPaymentPrice').textContent;
const priceElement = document.getElementById('price');
const paymentOptions = document.querySelectorAll('input[name="payment_method"]');

// Function to update price based on the selected tab
function updatePrice() {
    const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;

    if (selectedPayment === 'down_payment') {
        priceElement.innerHTML = `${downPaymentPrice}`;
    } else if (selectedPayment === 'full_payment') {
        priceElement.innerHTML = `${fullPaymentPrice}`;
    }
}

// Attach event listeners to the radio buttons
paymentOptions.forEach(option => {
    option.addEventListener('change', updatePrice);
});

// Trigger price update on page load
updatePrice();