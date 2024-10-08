
document.addEventListener('DOMContentLoaded', () => {

    const username_input = document.getElementById('username');
    const password_input = document.getElementById('password');
    const conf_password_input = document.getElementById('confirm_password');

    if(username_input.value === ''){
        username_input.setCustomValidity('ユーザ名を入力してください');
    }
   
   

    username_input.addEventListener('input', () => {
        if (username_input.value.length < 6 || username_input.value.length > 50) {
            username_input.setCustomValidity('6文字以上,50文字以下で入力してください');
        } else {
            username_input.setCustomValidity('');
        }
    });

    if (password_input.value === '') {
        password_input.setCustomValidity('パスワードを入力してください');
    }

    password_input.addEventListener('input', () => {
        const alphanumeric = /^[a-zA-Z0-9]+$/.test(password_input.value)
        if (password_input.value.length < 6 || !alphanumeric) {
            password_input.setCustomValidity('6文字以上,英数字で入力してください');
        } else {
            password_input.setCustomValidity('');
        }
    });

    if ( conf_password_input.value === ''){
        conf_password_input.setCustomValidity('パスワードを入力してください');
    }

    conf_password_input.addEventListener('input', () => {
        if (password_input.value === conf_password_input.value) {
            conf_password_input.setCustomValidity('');
        } else {
            conf_password_input.setCustomValidity('同じパスワードを入力してください');
        }
    });
    
    
});
