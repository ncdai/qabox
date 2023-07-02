<?php
  $isAnswerer = isset($_SESSION['user']) && in_array($_SESSION['user']['Role'], ['Answerer', 'Admin']);
  $isEvaluater = isset($_SESSION['user']) && in_array($_SESSION['user']['Role'], ['Evaluater', 'Admin']);
?>

<div class="d-flex align-items-center">
  <h1>View Answers</h1>
</div>

<div class="card mb-3">
  <div class="card-header">
    Question
  </div>

  <div class="card-body">
    <?php echo $QuestionItem['Question']; ?>
  </div>
</div>

<table class="table table-bordered table-hover" id="task-list">
  <thead class="table-dark align-middle">
    <tr>
      <th scope="col" class="text-center">Answer ID</th>
      <th scope="col" class="text-center">Answer</th>
      <th scope="col" class="text-center">User Name</th>
      <th scope="col" class="text-center">Created Date</th>

      <?php if ($isEvaluater): ?>
        <th scope="col" class="text-center">Evaluate</th>
      <?php endif; ?>

      <th scope="col" class="text-center">View Evaluates</th>
    </tr>
  </thead>

  <tbody class="table-group-divider align-middle">
    <?php foreach ($AnswerList as $AnswerItem): ?>
      <tr>
        <td width="136" class="text-center"><?php echo $AnswerItem['AnswerID']; ?></td>
        <td><?php echo $AnswerItem['Answer']; ?></td>
        <td width="136" class="text-center"><?php echo $AnswerItem['UserName']; ?></td>
        <td width="192" class="text-center"><?php echo $AnswerItem['CreatedDate']; ?></td>

        <?php if ($isEvaluater): ?>
          <td width="192">
            <select class="form-select form-select-sm js-select-star" data-answer-id="<?php echo $AnswerItem['AnswerID']; ?>">
              <option value="" disabled selected>Evaluate</option>
              <option value="1STAR">1 Star</option>
              <option value="2STAR">2 Star</option>
              <option value="3STAR">3 Star</option>
              <option value="4STAR">4 Star</option>
              <option value="5STAR">5 Star</option>
            </select>
          </td>
        <?php endif; ?>

        <td width="144" class="text-center">
          <a href="/answers/evaluates?AnswerID=<?php echo $AnswerItem['AnswerID']; ?>">Evaluates</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if($isAnswerer): ?>
  <div class="card">
    <div class="card-header">
      Add Answer
    </div>

    <div class="card-body">
      <form id="form-add-answer" action="" method="POST">
        <input type="hidden" name="QuestionID" id="QuestionID" value="<?php echo $QuestionItem['QuestionID']; ?>">

        <div class="mb-3">
          <label for="Answer" class="form-label">Answer</label>
          <textarea class="form-control" id="Answer" name="Answer" rows="3" placeholder="Enter Answer"></textarea>
        </div>

        <div class="mb-3">
          <label for="Reference" class="form-label">Reference</label>
          <input type="text" class="form-control" id="Reference" name="Reference" placeholder="Enter Reference">
        </div>

        <button type="submit" class="btn btn-primary" id="btn-submit-answer">Add Answer</button>
      </form>
    </div>
  </div>
<?php endif; ?>
