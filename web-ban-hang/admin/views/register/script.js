document.getElementById("registerForm").addEventListener("submit", function(event) {
    let isValid = true;

    // Lấy giá trị nhập vào
    let username = document.getElementById("username").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirmPassword = document.getElementById("confirmPassword").value.trim();

    // Xóa thông báo cũ
    document.getElementById("usernameError").textContent = "";
    document.getElementById("emailError").textContent = "";
    document.getElementById("passwordError").textContent = "";
    document.getElementById("confirmPasswordError").textContent = "";

    // Kiểm tra tên đăng nhập
    if (username === "") {
        document.getElementById("usernameError").textContent = "Vui lòng nhập tên đăng nhập.";
        isValid = false;
    }

    // Kiểm tra email
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        document.getElementById("emailError").textContent = "Email không hợp lệ.";
        isValid = false;
    }

    // Kiểm tra mật khẩu
    if (password.length < 6) {
        document.getElementById("passwordError").textContent = "Mật khẩu phải có ít nhất 6 ký tự.";
        isValid = false;
    }

    // Kiểm tra xác nhận mật khẩu
    if (password !== confirmPassword) {
        document.getElementById("confirmPasswordError").textContent = "Mật khẩu nhập lại không khớp.";
        isValid = false;
    }

    // Nếu có lỗi, ngăn không cho gửi form
    if (!isValid) {
        event.preventDefault();
    }
});
