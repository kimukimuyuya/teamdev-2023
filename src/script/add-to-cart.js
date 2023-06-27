function addToCart(id) {

  sessionStorage.setItem(`added_${id}`, true);
  
  // カートに追加する処理
  let addToCartBtn = document.getElementById("add-to-cart-btn-" + id);
  addToCartBtn.innerHTML = '追加しました<i class="mx-2 fa-solid fa-square-check fa-xl text-white" style="color: text-white;"></i>';
  addToCartBtn.classList.remove("hover:bg-[#2e5aba]");
  addToCartBtn.classList.add("bg-[#FF8D06]", "cursor-not-allowed");
  addToCartBtn.disabled = true;

  // カートに追加した商品の数を表示する処理
  let cartItems = document.getElementById("cart-items");
  let cartItemsNum = Number(cartItems.innerHTML);
  cartItems.innerHTML = cartItemsNum + 1;
  // カートの商品数を更新する
  let cartItemCount = sessionStorage.getItem('cart_item_count');
  if (!cartItemCount) {
    cartItemCount = 0;
  }
  cartItemCount++;
  sessionStorage.setItem('cart_item_count', cartItemCount);
  document.getElementById("myForm").submit();
}

// リロードしても追加した状態を維持する処理
window.onload = function() {
  const buttons = document.querySelectorAll('button[id^="add-to-cart-btn-"]');
  buttons.forEach((button) => {
    const id = button.id.replace('add-to-cart-btn-', '');
    const isAdded = sessionStorage.getItem(`added_${id}`);
    if (isAdded === 'true') {
      button.innerHTML = '追加しました<i class="mx-2 fa-solid fa-square-check fa-xl text-white" style="color: text-white;"></i>';
      button.classList.remove("hover:bg-[#2e5aba]");
      button.classList.add("bg-[#FF8D06]", "cursor-not-allowed");
      button.disabled = true;
    }
  });

  // カートの数を表示する処理
  const cartItemCount = sessionStorage.getItem('cart_item_count');
  if (cartItemCount) {
    // カートに商品がある場合は、カートボタンに商品数を表示する
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = cartItemCount;
  }
};