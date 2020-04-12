export default {
  apiAddress: 'http://localhost/jomafull/back/public/',
  swiperOptions: {
    slidesPerView: 4,
    spaceBetween: 10,
    slidesPerGroup: 1,
    loop: false,
    loopFillGroupWithBlank: false,
    slidesOffsetBefore: 0,
    slidesOffsetAfter: 40,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  },
  modalSettings: {
    height: 'auto',
    adaptive: true,
    transition: 'nice-modal-fade',
    clickToClose: false
  }
}
