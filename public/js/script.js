$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})

$(document).ready(function() {
  $('.materialboxed').materialbox()
  $('#companionsModal').modal()

  $('form[name=frmRegister]').submit(function(e) {
    e.preventDefault()
    let isCompanions = $(this).data('type') == 'with-companions'

    if (!isCompanions) {
      let numberOfCompanions = $(this)
        .find('input[name=number_of_companions]')
        .val()

      if (
        !$(this)
          .find('input[name=terms]')
          .prop('checked')
      ) {
        alert('Please check the terms.')
        return
      }

      if (numberOfCompanions > 0) {
        $('.fields-content').html(null)
        for (var i = 1; i <= numberOfCompanions; i++) {
          $('.fields-content').append(
            "<div class='divider'></div>" +
              $('.template')
                .html()
                .replace(/\{id\}/g, i)
          )
        }
        $('#companionsModal').modal('open')
        return
      }
    }

    $(this)
      .find('input')
      .prop('readonly', true)
    $(this)
      .find('button[type=submit]')
      .prop('disabled', true)

    let form_data = isCompanions
      ? {
          ...$(this).serializeJSON(),
          ...$('form[name=frmRegister]:not([data-type=with-companions])').serializeJSON()
        }
      : $(this).serializeJSON()

    $.ajax({
      context: this,
      type: 'POST',
      data: form_data,
      dataType: 'json'
    })
      .done(function(response) {
        if (response.success) {
          alert('Registered Successfully!')
          location.reload()
        } else {
          if (response.error.errorInfo && response.error.errorInfo[1] == 1062) {
            alert('Already Exists!')
          } else {
            alert('There was an error.')
            console.log(response.error)
          }
        }
      })
      .always(function() {
        $(this)
          .find('input')
          .prop('readonly', false)
        $(this)
          .find('button[type=submit]')
          .prop('disabled', false)
      })
  })

  $('input[name=image_reference]').change(function() {
    var reader = new FileReader()
    reader.onload = e => {
      $('.image-container').html(`<img src="${e.target.result}" style="width:100%;height:100%">`)
    }
    reader.readAsDataURL(this.files[0])
  })

  $('form[name=frmUpload]').submit(function(e) {
    e.preventDefault()

    let form_data = new FormData()
    form_data.append(
      'code',
      $(this)
        .find('input[name=code]')
        .val()
    )
    form_data.append('file', $('input[name=image_reference]').prop('files')[0])

    $(this)
      .find('button[type=submit]')
      .prop('disabled', true)

    $.ajax({
      context: this,
      type: 'POST',
      data: form_data,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response) {
        if (response.success == true) {
          alert('Uploaded!')
          location.href = './'
        } else {
          alert(response.error)
        }
      }
    }).always(function() {
      $(this)
        .find('button[type=submit]')
        .prop('disabled', false)
    })
  })

  $('.btnSendTicket').click(function() {
    let code = $(this).data('code')
    let html = $(this).html()

    $(this).prop('disabled', true)
    $(this).html("<i class='material-icons left'>loop</i> SENDING...")

    $.ajax({
      context: this,
      url: 'mailer/ticket',
      data: { code },
      dataType: 'json',
      success: function(response) {
        if (response.success == true) {
          alert('Ticket Sent!')
        } else {
          alert(response.error)
        }
      }
    }).always(function() {
      $(this).prop('disabled', false)
      $(this).html(html)
    })
  })
})
