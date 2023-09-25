const sections = document.querySelectorAll('.section');
const navbarLinks = document.querySelectorAll('.nav-link');
let currentSectionIndex = 0;

// Set the initial active section
sections[currentSectionIndex].classList.add('active');

// Scroll to the selected section on navbar link click
navbarLinks.forEach((link, index) => {
  link.addEventListener('click', () => {
    scrollToSection(index);
  });
});

// Helper function to smoothly scroll to a section
function scrollToSection(index) {
  sections[currentSectionIndex].classList.remove('active');
  sections[index].classList.add('active');
  currentSectionIndex = index;
  navbarLinks.forEach(link => link.classList.remove('active'));
  navbarLinks[currentSectionIndex].classList.add('active');

  sections[index].scrollIntoView({
    behavior: 'smooth',
    block: 'start',
  });
}

// Listen for scroll events
window.addEventListener('scroll', () => {
  const sectionBottom = sections[currentSectionIndex].getBoundingClientRect().bottom;
  const windowHeight = window.innerHeight;

  // Check if the bottom of the current section is reached
  if (sectionBottom <= windowHeight) {
    if (currentSectionIndex < sections.length - 1) {
      scrollToSection(currentSectionIndex + 1);
    }
  }
});
