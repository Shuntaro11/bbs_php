function judgeTitle() {
  let title = document.getElementById('title').value;
  const title_error = document.getElementById("title_error");
  if(title.length === 0){
    title_error.innerHTML = "タイトルを入力してください";
  }else if(title.length > 30){
    title_error.innerHTML = "３０文字以内で入力してください。"; 
  }else {
    title_error.innerHTML = ""; 
  }
}

function judgeContent() {
  let content = document.getElementById('content').value;
  const content_error = document.getElementById("content_error");
  if(content.length === 0){
    content_error.innerHTML = "タイトルを入力してください";
  }else {
    content_error.innerHTML = ""; 
  }
}

