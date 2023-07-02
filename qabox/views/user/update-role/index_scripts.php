<script src="/public/js/jquery.bs-button.js"></script>
<script>
  $(document).ready(function () {
    $('#Role').val('<?php echo $_SESSION['user']['Role']; ?>')

    $("#form-update-role").validate({
      rules: {
        Role: {
          required: true,
        }
      },
      messages: {
        Role: {
          required: "Please select role",
        }
      },
      submitHandler: function (form) {
        $('#btn-submit').loadingState()

        $.ajax({
          url: "/api/user/me/role",
          type: "POST",
          data: {
            Role: $('#Role').val(),
          },
          success: function (response) {
            console.log(response)

            if (response.status === 'success') {
              toastr.success(response.message)

              setTimeout(() => {
                window.location.href = "/"
              }, 1000)

              return
            }

            toastr.error(response.message)
          },
          error: function (xhr, status, error) {
            console.log(error)
            toastr.error("Error has occurred, please try again later")
          }
        });
      }
    });
  })
</script>