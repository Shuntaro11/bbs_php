function judgeName() {
  let pre_name = document.getElementById('pre_name').value;
  const pre_name_error = document.getElementById("pre_name_error");
  if(pre_name.length === 0){
    pre_name_error.innerHTML = "名前を入力してください";
  }else if(pre_name.length > 20 || !pre_name.match(/^[ぁ-んァ-ン一-龥]+$/)){
    pre_name_error.innerHTML = "全角１〜２０文字で入力してください。"; 
  }else {
    pre_name_error.innerHTML = ""; 
  }
}

function judgePassword() {
  let pre_password = document.getElementById('pre_password').value;
  const pre_password_error = document.getElementById("pre_password_error");
  if(pre_password.length === 0){
    pre_password_error.innerHTML = "パスワードを入力してください";
  }else if(!pre_password.match(/^[a-zA-Z0-9]+$/) || pre_password.length > 20 || pre_password.length < 8){
    pre_password_error.innerHTML = "パスワードは半角英数字８〜２０文字で入力してください。";
  }else {
    pre_password_error.innerHTML = "";
  }
}

function judgeEmail() {
  let pre_email = document.getElementById('pre_email').value;
  const pre_email_error = document.getElementById("pre_email_error");
  if(pre_email.length === 0){
    pre_email_error.innerHTML = "メールアドレスを入力してください";
  }else if(!pre_email.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){
    pre_email_error.innerHTML = "メールアドレスが不正です";
  }else {
    pre_email_error.innerHTML = "";
  }
}