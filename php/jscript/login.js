const sign_in_btn = document.getElementById("sign-in-btn");
const sign_up_btn = document.getElementById("sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click" , () => {
    container.classList.add("sign-up-mode");
});
sign_in_btn.addEventListener("click" , () => {
    container.classList.remove("sign-up-mode");
});


if (isset($_POST['submit']) && empty($errorUsername) && empty($errorPassword) && empty($errorConfirm) && empty($errorEmail)) {
    setTimeout(function() {
        document.getElementById('sign-up-btn').click();
        document.getElementById('successMessage').style.display = 'block';
    }, 100);
}


