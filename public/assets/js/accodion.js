// how to use:
// add .accordion to the parent elements that need to change height

document.addEventListener('DOMContentLoaded', () => {
    // Select all elements with the class 'accordion'
    const accordions = document.querySelectorAll('.accordion');

    accordions.forEach((accordion) => {
        // Calculate the height of each accordion element
        const height = accordion.scrollHeight;

        // Set the height as an inline style
        accordion.style.height = `${height}px`;
    });
});
