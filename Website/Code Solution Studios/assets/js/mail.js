
// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.getElementById('contact-form');
//     const submitText = document.getElementById('button-text');
//     const submitButton = document.getElementById('submit-button')
//     const progressIndicator = document.getElementById('progress-indicator');
//     const messagePlaceholder = document.getElementById('message-placeholder');

//     form.addEventListener('submit', function(event) {
//         event.preventDefault();

//         // Disable submit button and show progress indicator
//         submitText.style.display = 'none';
//         progressIndicator.style.display = 'block';
//         submitButton.setAttribute('disabled', '');

//         // Get form data
//         const formData = new FormData(form);

//         // Assuming you're using the Fetch API for AJAX
//         fetch('./assets/php/css_mail.php', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => response.json())
//         .then(data => {

//             // Hide progress indicator
//             progressIndicator.style.display = 'none';
            
//             if (data.success) {
//                 messagePlaceholder.innerHTML = '<span class="success">&#10004; Success</span>';
//                 // Clear form fields after success
//                 form.reset();
//                 // Re-enable submit button after form submission
                
//             } else {
//                 messagePlaceholder.innerHTML = '<span class="error">&#10008; Error</span>';
//             }
//         })
//         .catch(error => {
//             console.log(error);
//             progressIndicator.style.display = 'none';
//             messagePlaceholder.innerHTML = '<span class="error">&#10008; An error occurred</span>';
//         });
//     });
// });

