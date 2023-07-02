<script src="/public/js/jquery.bs-button.js"></script>

<script>
  $(document).ready(function () {
    // $.ajax({
    //   url: "/api/user/me/evaluates",
    //   type: "GET",
    //   success: function (response) {
    //     console.log(response)
    //     response.forEach((item) => {
    //       $(`.js-select-star[data-answer-id="${item.AnswerID}"]`).val(item.RateCategory)
    //     })
    //   },
    //   error: function (xhr, status, error) {
    //     console.log(error)
    //   }
    // });

    $('.js-select-star').change(function() {
      const AnswerID = $(this).data('answer-id')
      const RateCategory = $(this).val()

      if (!RateCategory) {
        toastr.error("Please select RateCategory")
        return;
      }

      $.ajax({
        url: "/api/evaluates",
        type: "POST",
        data: {
          AnswerID,
          RateCategory
        },
        success: function (response) {
          console.log(response)
          if (response.status === 'success') {
            toastr.success(response.message)
          } else {
            toastr.error(response.message)
          }
        },
        error: function (xhr, status, error) {
          console.log(error)
          toastr.error("An error occurred while adding evaluate")
        }
      });
    });

    $("#form-add-answer").validate({
      rules: {
        Answer: {
          required: true,
          minlength: 3
        },
        Reference: {
          required: true,
          minlength: 3
        }
      },
      messages: {
        Answer: {
          required: "Please enter Answer",
          minlength: "Answer must be at least 3 characters long"
        },
        Reference: {
          required: "Please enter Reference",
          minlength: "Reference must be at least 3 characters long"
        }
      },
      submitHandler: function (form) {
        $('#btn-submit-answer').loadingState()

        const formData = {
          QuestionID: $("#QuestionID").val(),
          Answer: $("#Answer").val(),
          Reference: $("#Reference").val()
        }

        if (!formData.QuestionID) {
          toastr.error("QuestionID is required")
          return;
        }

        $.ajax({
          url: "/api/answers/add",
          type: "POST",
          data: formData,
          success: function (response) {
            console.log(response)

            if (response.status === 'success') {
              toastr.success(response.message)

              setTimeout(() => {
                window.location.href = "/questions/answers?QuestionID=" + formData.QuestionID
              }, 1000)

              return
            }

            toastr.error(response.message)
          },
          error: function (xhr, status, error) {
            console.log(error)
            toastr.error("An error occurred while adding answer")
          }
        });
      }
    });

    $("#form-search input[name=Answer]").val('<?php echo $Answer; ?>');
    $("#form-search input[name=UserName]").val('<?php echo $UserName; ?>');
  })
</script>