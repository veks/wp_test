import Collapse from 'bootstrap/js/src/collapse.js'

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
const initializeBlock = (accordion) => {
  new Houdini(`.${accordion.classList[0]}`, {
    isAccordion: true,
    collapseOthers: true
  });
}

// Initialize each block on page load (front end).
document.addEventListener('DOMContentLoaded', () => {
  let accordions = document.querySelectorAll('.accordion')

  if (accordions) {
    [...accordions].map(accordion => {
      initializeBlock(accordion)
    })
  }
})

// Initialize dynamic block preview (editor).
if (window.acf) {
  window.acf.addAction('render_block_preview/type=accordion', block => {
    const _block = block[0]
    const accordion = _block.querySelector('.accordion')
    const parent = _block.parentNode.parentNode.parentNode

    if (parent) {
      parent.addEventListener('click',
        (event) => _block.style.pointerEvents = 'auto')
      parent.addEventListener('mouseleave',
        (event) => _block.style.pointerEvents = 'none')
    }

    if (accordion) {
      initializeBlock(accordion)
    }
  })
}