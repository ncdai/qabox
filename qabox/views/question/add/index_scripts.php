<script src="/public/js/jquery.bs-button.js"></script>
<script>
  $(document).ready(function () {
    $("#form-add-question").validate({
      rules: {
        Question: {
          required: true,
          minlength: 3,
          maxlength: 255
        },
        Tags: {
          required: true,
          minlength: 3
        }
      },
      messages: {
        Question: {
          required: "Please enter question content",
          minlength: "Question content must be at least 3 characters",
          maxlength: "Question content must not exceed 255 characters"
        },
        Tags: {
          required: "Please enter tags",
          minlength: "Tags must be at least 3 characters"
        }
      },
      submitHandler: function (form) {
        $('#btn-submit').loadingState()

        $.ajax({
          url: "/api/questions",
          type: "POST",
          data: {
            Question: $('#Question').val(),
            Tags: $("#Tags").val()
          },
          success: function (response) {
            console.log(response)

            if (response.status === 'success') {
              toastr.success(response.message)

              setTimeout(() => {
                window.location.href = "/questions"
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