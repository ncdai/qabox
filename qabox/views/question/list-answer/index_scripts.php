<script src="/public/js/jquery.bs-button.js"></script>

<?php
  // $isAnswerer = isset($_SESSION['user']) && $_SESSION['user']['Role'] == 'Answerer';
  // $isEvaluater = isset($_SESSION['user']) && $_SESSION['user']['Role'] == 'Evaluater';
?>

<?php if ($isAnswerer): ?>
<script>
  $(document).ready(function () {
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
          url: "/api/answers",
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
  })
</script>
<?php endif; ?>

<?php if ($isEvaluater): ?>
<script>
  $(document).ready(function () {
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
  })
</script>
<?php endif; ?>