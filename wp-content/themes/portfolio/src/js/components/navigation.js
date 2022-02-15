const navigation = () => {

  const buttons = document.querySelectorAll('.toggle-navigation')

  if (!buttons) return false

  buttons.forEach((button, index) => {

    button.addEventListener('click', function(e) {

      if ( document.body.getAttribute('data-navigation-status') ) {
        document.body.removeAttribute('data-navigation-status')
      } else {
        document.body.setAttribute('data-navigation-status', 'open')
      }
      e.preventDefault()

    })

  })

  document.onkeydown = (evt) => {
    evt = evt || window.event
    if ( evt.keyCode == 27 ) {
      document.body.removeAttribute('data-navigation-status')
    }
  }

}

export default navigation