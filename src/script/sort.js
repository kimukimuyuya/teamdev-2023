'use strict';
var icon = document.getElementById("icon");

document.getElementById("toggleAccordion").addEventListener("click", function() {
  var accordion = document.getElementById("accordion");
  accordion.classList.toggle("hidden");

  if (accordion.classList.contains("hidden")) {
    icon.classList.remove("fa-caret-up", "pt-1.5");
    icon.classList.add("fa-caret-down");
  } else {
    icon.classList.remove("fa-caret-down");
    icon.classList.add("fa-caret-up", "pt-1.5");
  }
});

const accordion = document.getElementById("accordion");
document.addEventListener("click", function(event) {
  const toggleAccordion = document.getElementById("toggleAccordion");
  const target = event.target;

  // アコーディオンパネル以外をクリックした場合にパネルを閉じる
  if (!toggleAccordion.contains(target) && !accordion.contains(target)) {
    accordion.classList.add("hidden");
    icon.classList.remove("fa-caret-up", "pt-1.5");
    icon.classList.add("fa-caret-down");
  }
});













