<div class="d-flex align-items-center">
  <h1>Answers</h1>
</div>

<form class="row gy-2 gx-2 align-items-center mt-3 mb-4" action="" id="form-search">
  <div class="col-sm-3">
    <input class="form-control" type="search" name="Answer" placeholder="Search Answer ...">
  </div>

  <div class="col-sm-3">
    <input class="form-control" type="input" name="UserName" placeholder="User Name">
  </div>

  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Search</button>
  </div>

  <?php if (isset($isFilterMode) && $isFilterMode == true): ?>
    <div class="col-auto">
      <a href="/answers" class="btn btn-outline-danger">Clear Filter</a>
    </div>
  <?php endif; ?>
</form>

<table class="table table-bordered table-hover" id="task-list">
  <thead class="table-dark align-middle">
    <tr>
      <th scope="col" class="text-center">Answer ID</th>
      <th scope="col" class="text-center">Answer</th>
      <th scope="col" class="text-center">User Name</th>
      <th scope="col" class="text-center">Created Date</th>

      <th scope="col" class="text-center">View Question</th>
    </tr>
  </thead>

  <tbody class="table-group-divider align-middle">
    <?php foreach ($AnswerList as $AnswerItem): ?>
      <tr>
        <td width="136" class="text-center"><?php echo $AnswerItem['AnswerID']; ?></td>

        <td><?php echo $AnswerItem['Answer']; ?></td>

        <td width="136" class="text-center">
          <a href="/answers?UserName=<?php echo $AnswerItem['UserName']; ?>">
            <?php echo $AnswerItem['UserName']; ?>
          </a>
        </td>

        <td width="192" class="text-center"><?php echo $AnswerItem['CreatedDate']; ?></td>

        <td width="144" class="text-center">
          <a href="/questions/answers?QuestionID=<?php echo $AnswerItem['QuestionID']; ?>">Question</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  $currentUrl = PaginationHelper::getCurrentUrl();
  echo PaginationHelper::buildPagination($TotalItems, $Page, $currentUrl);
?>
