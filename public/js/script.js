document.addEventListener("DOMContentLoaded", () => { 
     const registerForm = document.getElementById("registerForm");     if (registerForm) { 
        registerForm.addEventListener("submit", function(event) {            
             event.preventDefault(); 

                 
     
const formData = new FormData(this);

fetch('/register.php', {
method: 'POST',
body: formData
})
.then(response => response.text())
.then(data => {

document.getElementById("registerMessage").textContent =
data;
})
.catch(error => console.error('Error:', error));
});
}


const loginForm = document.getElementById("loginForm");
if (loginForm) {
loginForm.addEventListener("submit", function(event) {
event.preventDefault();

const formData = new FormData(this);

fetch('/login.php', {
method: 'POST',
body: formData
})
.then(response => response.text())
.then(data => {

document.getElementById("loginMessage").textContent =
data;
})
.catch(error => console.error('Error:', error));
});
}

const addBookForm = document.getElementById("addBookForm");
if (addBookForm) {
addBookForm.addEventListener("submit", function(event) {
event.preventDefault();
if (addBookForm) {
    addBookForm.addEventListener("submit", function(event) {
    event.preventDefault();
  
    const formData = new FormData(this);

    fetch('/add_book.php', {
    method: 'POST',
    body: formData
    })
    .then(response => response.text())
    .then(data => {

    document.getElementById("addBookMessage").textContent =
    data;
    })
    .catch(error => console.error('Error:', error));
    });
    }
    });