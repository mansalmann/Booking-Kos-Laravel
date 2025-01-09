const swiperGallery = new Swiper('.swiper-gallery', {
    slidesPerView: "auto",
    spaceBetween: 10,
});
const swiperTabs = new Swiper('.swiper-tab', {
    slidesPerView: "auto",
    spaceBetween: 10,
    slidesOffsetAfter: 20,
    slidesOffsetBefore: 20,
});

// Get all tab buttons
const tabLinks = document.querySelectorAll('.tab-link');

// Add click event listener to each button
tabLinks.forEach(button => {
    button.addEventListener('click', () => {
        // Get the target tab id from the data attribute
        const targetTab = button.getAttribute('data-target-tab');

        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('flex');
            content.classList.add('hidden');
        });

        // Remove active state from all buttons
        tabLinks.forEach(btn => {
            btn.classList.remove('!bg-ngekos-black', '!text-white');
        });

        // Show the target tab content
        document.querySelector(targetTab).classList.remove('hidden');
        document.querySelector(targetTab).classList.add('flex');

        // Add active state to the clicked button
        button.classList.add('!bg-ngekos-black', '!text-white');
    });
});