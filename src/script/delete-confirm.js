"use strict"

function confirmLink() {
  if (confirm("本当に削除しますか?")) {
    return true;
  } else {
    return false;
  }
}