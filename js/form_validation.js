$(function(){
  
  let prename = $('#prename');
  

  function judgeName() {
    let inputName = name.val();
    let error = $('#error1');
    if(inputName.length > 20 || inputName.match(/[^ぁ-んァ-ン一-龥]/)){
      error.html("全角１〜２０文字で入力してください。"); 
    }else if(inputName.length === 0){
      error.html("値を入力してください");
    }else {
      error.html(""); 
      $('#inputName').html("名前：" + inputName);
    }
  }

  name.blur(judgeName);
  namekana.blur(judgeNamekana);
  postcode.blur(judgePostcode);
  city.blur(judgeCity);
  housenumber.blur(judgeHousenumber);
  male.click(maleDisplay);
  female.click(femaleDisplay);

});

const pre_form = document.getElementById("pre_form") ;

function judgeName() {
  var prename = document.getElementById('name').value;
  var error = document.getElementById("change1");
  if(name.length > 20 || name.match(/^[0-9a-zA-Z]+$/) || name.match(/[!"#$%&'()\*\+\-\.,\/:;<=>?@\[\\\]^_`{|}~]/g)){
    error.innerHTML = "全角１〜２０文字で入力してください。"; 
  }else if(name.length == 0){
    error.innerHTML = "値を入力してください";
  }else {
    error.innerHTML = ""; 
  }
}

function judgeEmail() {
  var email = document.getElementById('email').value;
  var error = document.getElementById("change2");
  if(email.length == 0){
    error.innerHTML = "値を入力してください";
  }else if(email.match(/\.{2}/) || email.match(/\.$/)){
    error.innerHTML = "メールアドレスが不正です";
  }else if(email.length < 30 && email.match(/^[0-9a-zA-Z-._]*$/) && email.match(/^[0-9a-zA-Z]/)){
    error.innerHTML = "";
  }else {
    error.innerHTML = "メールアドレスが不正です";
  }
}

function judgeDomain() {
  var domain = document.getElementById('domain').value;
  var error = document.getElementById("change2");
  if(domain.length == 0){
    error.innerHTML = "値を入力してください";
  }else if(domain.match(/\.{2}/) || domain.match(/\.$/)){
    error.innerHTML = "メールアドレスが不正です";
  }else if(domain.length < 30 && domain.match(/^[0-9a-zA-Z-._]*$/) && domain.match(/^[0-9a-zA-Z]/)){
    error.innerHTML = "";
  }else {
    error.innerHTML = "メールアドレスが不正です";
  }
}

function judgeEmailCheck() {
  var email = document.getElementById('email').value;
  var emailCheck = document.getElementById('emailCheck').value;
  var error = document.getElementById("change3");
  if(emailCheck.length == 0){
    error.innerHTML = "値を入力してください";
  }else if(email == emailCheck){
    error.innerHTML = "";
  }else {
    error.innerHTML = "入力したメールアドレスと異なっています。";
  }
}

function judgeDomainCheck() {
  var domain = document.getElementById('domain').value;
  var domainCheck = document.getElementById('domainCheck').value;
  var error = document.getElementById("change3");
  if(domainCheck.length == 0){
    error.innerHTML = "値を入力してください";
  }else if(domain == domainCheck){
    error.innerHTML = "";
  }else {
    error.innerHTML = "入力したメールアドレスと異なっています。";
  }
}

document.getElementById("submit-btn").addEventListener('click', judgeAllValue);

function judgeAllValue(event) {
  var name = document.getElementById('name').value;
  var email = document.getElementById('email').value;
  var domain = document.getElementById('domain').value;
  var emailCheck = document.getElementById('emailCheck').value;
  var domainCheck = document.getElementById('domainCheck').value;
  var gender = $form.gender.value;
  var error1 = document.getElementById("change1");
  var error2 = document.getElementById("change2");
  var error3 = document.getElementById("change3");
  var error4 = document.getElementById("change4");
  if(name.length == 0 && (email.length == 0 || domain.length == 0) && (emailCheck.length == 0 || domainCheck.length == 0) && gender == ""){
    event.preventDefault();
    error1.innerHTML = "値を入力してください";
    error2.innerHTML = "値を入力してください";
    error3.innerHTML = "値を入力してください";
    error4.innerHTML = "値を入力してください";
  }else if(name.length == 0 && (email.length == 0 || domain.length == 0) && (emailCheck.length == 0 || domainCheck.length == 0)){
    event.preventDefault();
    error1.innerHTML = "値を入力してください";
    error2.innerHTML = "値を入力してください";
    error3.innerHTML = "値を入力してください";
  }else if(name.length == 0 && (email.length == 0 || domain.length == 0) && gender == ""){
    event.preventDefault();
    error1.innerHTML = "値を入力してください";
    error2.innerHTML = "値を入力してください";
    error4.innerHTML = "値を入力してください";
  }else if(name.length == 0 && (emailCheck.length == 0 || domainCheck.length == 0) && gender == ""){
    event.preventDefault();
    error1.innerHTML = "値を入力してください";
    error3.innerHTML = "値を入力してください";
    error4.innerHTML = "値を入力してください";
  }else if((email.length == 0 || domain.length == 0) && (emailCheck.length == 0 || domainCheck.length == 0) && gender == ""){
    event.preventDefault();
    error2.innerHTML = "値を入力してください";
    error3.innerHTML = "値を入力してください";
    error4.innerHTML = "値を入力してください";
  }else if(name.length == 0 && (email.length == 0 || domain.length == 0)){
    event.preventDefault();
    error1.innerHTML = "値を入力してください";
    error2.innerHTML = "値を入力してください";
  }else if(name.length == 0 && (emailCheck.length == 0 || domainCheck.length == 0)){
    event.preventDefault();
    error1.innerHTML = "値を入力してください";
    error3.innerHTML = "値を入力してください";
  }else if(name.length == 0 && gender == ""){
    event.preventDefault();
    error1.innerHTML = "値を入力してください";
    error4.innerHTML = "値を入力してください";
  }else if((email.length == 0 || domain.length == 0) && (emailCheck.length == 0 || domainCheck.length == 0)){
    event.preventDefault();
    error2.innerHTML = "値を入力してください";
    error3.innerHTML = "値を入力してください";
  }else if((email.length == 0 || domain.length == 0) && gender == ""){
    event.preventDefault();
    error2.innerHTML = "値を入力してください";
    error4.innerHTML = "値を入力してください";
  }else if((emailCheck.length == 0 || domainCheck.length == 0) && gender == ""){
    event.preventDefault();
    error3.innerHTML = "値を入力してください";
    error4.innerHTML = "値を入力してください";
  }else if(name.length == 0){
    event.preventDefault();
    error1.innerHTML = "値を入力してください";
  }else if(email.length == 0 || domain.length == 0){
    event.preventDefault();
    error2.innerHTML = "値を入力してください";
  }else if(emailCheck.length == 0 || domainCheck.length == 0){
    event.preventDefault();
    error3.innerHTML = "値を入力してください";
  }else if(gender == ""){
    event.preventDefault();
    error4.innerHTML = "値を入力してください";
  }else {
    error.innerHTML = ""; 
  }
}