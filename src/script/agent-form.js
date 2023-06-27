"use strict"

window.onload = function() {
  // 特化型のラジオボタンを取得する
  const specializedRadioButton = document.getElementById('specialized');
  // ラジオボタンが変更された時に実行する関数を定義する
  specializedRadioButton.addEventListener('change', function() {
    // テキストボックスを表示する
    document.getElementById('specialized_field').style.display = 'block';
  });

  const comprehensiveRadioButton = document.getElementById('comprehensive');
    // ラジオボタンが変更された時に実行する関数を定義する
    comprehensiveRadioButton.addEventListener('change', function() {
      // テキストボックスを非表示にする
      document.getElementById('specialized_field').style.display = 'none';
    });
};