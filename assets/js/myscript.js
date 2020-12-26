$('.tombol-transfer').on('click', function (e) {
    Swal.fire({
      title: '<strong>HTML <u>example</u></strong>',
      icon: 'info',
      html: `<a href="${BASE_URL}user/update_profil">Silakan update ke OVO Premier</a> `,
      showCloseButton: true,
      showCancelButton: true,
      showConfirmButton: false,
      focusConfirm: false,
      cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
      cancelButtonAriaLabel: 'Thumbs down'
    });

  });
