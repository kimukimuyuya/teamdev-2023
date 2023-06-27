'use strict';
function toggleSubmitButton() {
  var checkbox = document.getElementById('checkbox');
  var submitButton = document.getElementById('submitButton');

  if (checkbox.checked) {
    submitButton.disabled = false;
    submitButton.classList.remove('bg-gray-200', 'cursor-not-allowed', 'opacity-60');
    submitButton.classList.add('bg-[#2E78BA]', 'hover:opacity-80');
  } else {
    submitButton.disabled = true;
    submitButton.classList.remove('hover:opacity-80');
    submitButton.classList.add('bg-[#2E78BA]', 'cursor-not-allowed', 'opacity-60');
  }
}

// チェックボックスの状態変更時に関数を呼び出すイベントリスナーを設定
var checkbox = document.getElementById('checkbox');
checkbox.addEventListener('change', toggleSubmitButton);

document.getElementById("myForm").addEventListener("submit", function(event) {
  let inputs = document.querySelectorAll("#myForm input[type=text]");
  let isValid = true;
  var checkbox = document.getElementById('checkbox');

  for (let i = 0; i < inputs.length; i++) {
    if (inputs[i].value.trim() === "") {
      isValid = false;
      inputs[i].nextElementSibling.style.display = "block";
      inputs[i].classList.add("border-red-500");
      checkbox.checked = false;
      toggleSubmitButton();
    } else {
      inputs[i].nextElementSibling.style.display = "none";
      inputs[i].classList.remove("border-red-500"); 
    }
  }

  if (!isValid) {
    event.preventDefault(); // フォームの送信を中止
  }
});
