let searchForm = document.querySelector('.search-form');
document.querySelector('#search-btn').onclick = ()=>
{
    searchForm.classList.toggle('active');
}


let shoppingCart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = ()=>
{
    shoppingCart.classList.toggle('active');
}




/*swiper*/
var swiper = new Swiper(".product-sliders", {
    loop:true,
    spaceBetween: 20,

    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1020: {
        slidesPerView: 3,
      },
    },
  });


