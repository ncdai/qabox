<div class="d-flex align-items-center">
  <h1>View Evaluates</h1>
</div>

<div class="card mb-3">
  <div class="card-header">
    Question
  </div>

  <div class="card-body">
    <?php echo $QuestionItem['Question']; ?>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header">
    Answer
  </div>

  <div class="card-body">
    <?php echo $AnswerItem['Answer']; ?>
  </div>
</div>

<table class="table table-bordered table-hover" id="task-list">
  <thead class="table-dark align-middle">
    <tr>
      <th scope="col" class="text-center">Evaluate ID</th>
      <th scope="col" class="text-center">User Name</th>
      <th scope="col" class="text-center">Rate Category</th>
      <th scope="col" class="text-center">Created Date</th>
    </tr>
  </thead>

  <tbody class="table-group-divider align-middle">
    <?php foreach ($EvaluateList as $EvaluateItem): ?>
      <tr>
        <td width="136" class="text-center"><?php echo $EvaluateItem['EvaluateID']; ?></td>
        <td class="text-center"><?php echo $EvaluateItem['UserName']; ?></td>
        <td width="256" class="text-center"><?php echo $EvaluateItem['RateCategory']; ?></td>
        <td width="256" class="text-center"><?php echo $EvaluateItem['CreatedDate']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
