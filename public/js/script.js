$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  error: function() {
    swal.close()
  }
})

swal.setDefaults({
  allowOutsideClick: false,
  allowEscapeKey: false
})

$(document).ready(function() {
  $('.materialboxed').materialbox()
  $('.modal').modal({
    dismissible: false
  })
  $('select').formSelect()
  $('.dropdown-trigger').dropdown()

  $('form[name=frmLogin]').submit(function(e) {
    e.preventDefault()

    $(this)
      .find('input')
      .prop('readonly', true)
    $(this)
      .find('button[type=submit]')
      .prop('disabled', true)

    $.ajax({
      context: this,
      type: 'POST',
      url: main_url + '/login',
      data: $(this).serialize(),
      dataType: 'json'
    })
      .done(function(response) {
        if (response.success) {
          location.href = './dashboard'
        } else {
          alert(response.error)
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

    swal({
      title: 'Please wait...',
      onOpen: () => {
        swal.showLoading()
      }
    })

    $.ajax({
      context: this,
      type: 'POST',
      data: form_data,
      dataType: 'json'
    })
      .done(function(response) {
        swal.close()
        if (response.success) {
          swal({
            title: 'Success',
            type: 'success',
            text:
              "You have successfully completed your registration. Kindly check your registered email for the next instructions. If you haven't received any email from us, kindly notify us by calling (02)735-6975."
          }).then(function() {
            location.reload()
          })
        } else {
          if (response.error.errorInfo && response.error.errorInfo[1] == 1062) {
            swal('Warning', 'Already Exists!', 'warning')
          } else {
            swal('Errorx', 'There was an error.', 'error')
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

    swal({
      title: 'Uploading...',
      onOpen: () => {
        swal.showLoading()
      }
    })

    $.ajax({
      context: this,
      type: 'POST',
      data: form_data,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response) {
        swal.close()
        if (response.success == true) {
          swal({
            title: 'Success',
            type: 'success',
            text: 'Uploaded! We will now verify your bank reference.'
          }).then(function() {
            location.href = './'
          })
        } else {
          swal('Error!', response.error, 'error')
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
    $('#verifyPasswordModal')
      .find('input[name=code]')
      .val(code)
    $('#verifyPasswordModal')
      .find('input[name=type]')
      .val('ticket')
    $('#verifyPasswordModal')
      .find('button[type=submit]')
      .text('SEND')
    $('#verifyPasswordModal').modal('open')
    $('#verifyPasswordModal')
      .find('input[name=password]')
      .focus()
  })

  $('.btnDelete').click(function() {
    let code = $(this).data('code')
    $('#verifyPasswordModal')
      .find('input[name=code]')
      .val(code)
    $('#verifyPasswordModal')
      .find('input[name=type]')
      .val('delete')
    $('#verifyPasswordModal')
      .find('button[type=submit]')
      .text('DELETE')
    $('#verifyPasswordModal').modal('open')
    $('#verifyPasswordModal')
      .find('input[name=password]')
      .focus()
  })

  $('.btnResendPayment').click(function() {
    let code = $(this).data('code')

    swal({
      title: 'Are you sure do you want to resend the payment instructions?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#26a69a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then(result => {
      if (result.value) {
        swal({
          title: 'Sending...',
          allowOutsideClick: false,
          allowEscapeKey: false,
          onOpen: () => {
            swal.showLoading()
          }
        })

        $.ajax({
          url: main_url + '/mailer/steps',
          data: { code },
          dataType: 'json',
          success: function(response) {
            swal.close()
            if (response.success == true) {
              swal('Email sent!', null, 'success')
            } else {
              swal('Error', response.error, 'error')
            }
          }
        })
      }
    })
  })

  $('.btnViewPicture').click(function() {
    let code = $(this).data('code')

    swal({
      title: 'Are you sure do you want to mark it as paid?',
      type: 'warning',
      input: 'text',
      showCancelButton: true,
      confirmButtonColor: '#26a69a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then(result => {
      swal({
        title: 'Please wait...',
        onOpen: () => {
          swal.showLoading()
        }
      })

      $.ajax({
        context: this,
        type: 'POST',
        url: main_url + '/user/paid',
        data: { code, remarks: result.value },
        dataType: 'json'
      }).done(function(response) {
        swal.close()
        if (response.success == true) {
          swal('Marked as Paid!', null, 'success').then(() => {
            location.reload()
          })
        } else {
          alert(response.error)
        }
      })
    })
  })

  $('form[name=frmVerifyPassword]').submit(function(e) {
    e.preventDefault()

    let type = $(this)
      .find('input[name=type]')
      .val()
    let button = $(this).find('button[type=submit]')
    let html = button.html()

    $(this)
      .find('button')
      .prop('disabled', true)
    button.html("<i class='material-icons left'>loop</i> " + (type == 'ticket' ? 'SENDING' : 'DELETING') + '...')

    swal({
      title: type == 'ticket' ? 'Sending...' : 'Deleting...',
      onOpen: () => {
        swal.showLoading()
      }
    })

    $.ajax({
      context: this,
      type: 'POST',
      url: main_url + (type == 'ticket' ? '/mailer/ticket' : '/user/delete'),
      data: $(this).serialize(),
      dataType: 'json',
      statusCode: {
        401: function(response) {
          swal.close()
          swal('Warning', 'Invalid Password.', 'warning')
          $(this)
            .find('input[name=password]')
            .focus()
        }
      }
    })
      .done(function(response) {
        swal.close()
        if (response.success == true) {
          swal(type == 'ticket' ? 'Ticket Sent!' : 'Deleted Successfully!', null, 'success').then(() => {
            if (type == 'ticket') {
              $(this).trigger('reset')
              $('#verifyPasswordModal').modal('close')
            } else {
              location.reload()
            }
          })
        } else {
          alert(response.error)
        }
      })
      .always(function() {
        $(this)
          .find('button')
          .prop('disabled', false)
        button.html(html)
      })
  })

  $('.datatable').DataTable({
    oLanguage: {
      sStripClasses: '',
      sSearch: '',
      sSearchPlaceholder: 'Enter Keywords Here',
      sInfo: '_START_ -_END_ of _TOTAL_',
      sLengthMenu:
        '<span>Rows per page:</span><select class="browser-default">' +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        '</select></div>'
    },
    bAutoWidth: false,
    search: {
      smart: false
    }
  })
})
