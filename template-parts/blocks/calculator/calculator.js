document.addEventListener('DOMContentLoaded', () => {
  const formsCalculator = document.querySelectorAll('.calculator > form')
  const responseCalc = async (url = '', method = 'POST', body) => {
    return await fetch(url, {
      method     : method,
      body       : new URLSearchParams(body).toString(),
      credentials: 'same-origin',
      headers    : {
        'Content-Type' : 'application/x-www-form-urlencoded',
        'Cache-Control': 'no-cache',
        'Charset'      : 'UTF-8',
      },
    }).then(response => response.json().then(data => ({
      ok        : response.ok,
      status    : response.status,
      statusText: response.statusText,
      ...data,
    }))).then(object => {
      if (object.ok === true && object.status === 200) {
        if (object.success === true) {
          return object.data
        }
        return false
      }
      return false
    }).catch(error => error)
  }
  const getDataForm = (form) => {
    const formData = new FormData(form)
    const formEntries = formData.entries()
    const data = {}

    for (const [key, value] of formEntries) {
      if (data[key] !== undefined) {
        if (!Array.isArray(data[key])) {
          data[key] = [data[key]]
        }
        data[key].push(value)
      } else {
        data[key] = value
      }
    }

    return data
  }
  const ajaxUrl = block_calculator.ajaxUrl ?? ''

  if (formsCalculator && ajaxUrl) {
    [...formsCalculator].map(calculator => {
      calculator.addEventListener('change', (event) => {
        //event.preventDefault()

        const data = getDataForm(calculator)
        const response = responseCalc(ajaxUrl, 'POST', data)

        response.then(response => {
          const result = calculator.querySelector('.result')

          result.innerText = JSON.stringify(response.result) ?? 0

          if (response.message) {
            console.log(response.message)
          }
        }).catch(event => {
          console.log(event)
        })
      })
    })
  }
})