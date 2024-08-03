/**
 * initializeBlock
 *
 * Adds custom JavaScript to the block HTML.
 *
 * @date    02/08/24
 * @since   1.0.0
 *
 * @param   object $block The block jQuery element.
 * @param   object attributes The block attributes (only available when editing).
 * @return  void
 */
const initializeBlock = (slider) => {
  const swiper = new Swiper(slider, {
    // Optional parameters
    spaceBetween       : 10,
    loop               : false,
    watchSlidesProgress: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  })
}

// Initialize each block on page load (front end).
document.addEventListener('DOMContentLoaded', () => {
  let swiper = document.querySelectorAll('.swiper')

  if (swiper) {
    [...swiper].map(slider => {
      initializeBlock(slider)
    })
  }
})

// Initialize dynamic block preview (editor).
if (window.acf) {
  window.acf.addAction('render_block_preview/type=slider', block => {
    const _block = block[0]
    const swiper = _block.querySelector('.swiper')
    const parent = _block.parentNode.parentNode.parentNode

    if(parent){
      parent.addEventListener('click', (event) => _block.style.pointerEvents = 'auto')
      parent.addEventListener('mouseleave', (event) => _block.style.pointerEvents = 'none')
    }

    if (swiper) {
      initializeBlock(swiper)
    }
  })
}