/*HOME SWIPER*/
let swiperHome = new Swiper('.home__swiper', {
    loop: true,
    spaceBetween: -24,
    grabCursor: true,
    slidesPerView: 'auto',
    centeredSlides:'auto',
    autoplay:{
        delay:1000,
        disableOnInteraction:false,
    },
    breakpoints:{
        1220:{
            spaceBetween:-32,
        }
    }
  })

/*FEATURED SWIPER*/
let swiperFeatured = new Swiper('.featured__swiper', {
    loop: true,
    spaceBetween: 16,
    grabCursor: true,
    slidesPerView: 'auto',
    centeredSlides:'auto',
    navigation:{
        nextEl:'.swiper-button-next',
        prevEl:'.swiper-button-prev',
    },
    breakpoints:{
        1150:{
            slidesPerView:4,
            centeredSlides:false,
        }
    }
  })

/*NEW SWIPER*/
let swiperNew = new Swiper('.new__swiper', {
    loop: true,
    spaceBetween: 16,
    slidesPerView: 'auto',

    breakpoints:{
        1150:{
            slidesPerView:3,
        }
    }
  })

