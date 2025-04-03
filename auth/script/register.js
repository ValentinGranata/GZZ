const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm_password");
const submit = document.getElementById("submit");

const buttonCheck = (e) => {
    e.preventDefault();

    console.log(password.value);

    if (password.value == confirmPassword.value) {
        submit.disabled = false;
        return;
    }

    submit.disabled = true;
}

password.oninput = buttonCheck;
confirmPassword.oninput = buttonCheck;