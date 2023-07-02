<div class="d-flex align-items-center">
  <h1>View Evaluates</h1>
</div>

<table class="table table-bordered table-hover" id="task-list">
  <thead class="table-dark align-middle">
    <tr>
      <th scope="col" class="text-center">Evaluate ID</th>
      <!-- <th scope="col" class="text-center">Question</th> -->
      <th scope="col" class="text-center">Answer</th>
      <th scope="col" class="text-center">User Name</th>
      <th scope="col" class="text-center">Rate Category</th>
      <th scope="col" class="text-center">Created Date</th>
      <th scope="col" class="text-center">View Answer</th>
    </tr>
  </thead>

  <tbody class="table-group-divider align-middle">
    <?php foreach ($EvaluateList as $EvaluateItem): ?>
      <tr>
        <td width="136" class="text-center"><?php echo $EvaluateItem['EvaluateID']; ?></td>
        <!-- <td><?php echo $EvaluateItem['Question']; ?></td> -->
        <td><?php echo $EvaluateItem['Answer']; ?></td>
        <td class="text-center"><?php echo $EvaluateItem['UserName']; ?></td>
        <td width="256" class="text-center"><?php echo $EvaluateItem['RateCategory']; ?></td>
        <td width="256" class="text-center"><?php echo $EvaluateItem['CreatedDate']; ?></td>
        <td>
          <a href="/answers/evaluates?AnswerID=<?php echo $EvaluateItem['AnswerID']; ?>">View Answer</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
