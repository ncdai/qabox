<div class="d-flex align-items-center">
  <h1>Questions</h1>
</div>

<form class="row gy-2 gx-2 align-items-center mt-3 mb-4" action="" id="form-search">
  <div class="col-sm-3">
    <input class="form-control" type="search" name="Question" placeholder="Search Question...">
  </div>

  <div class="col-sm-3">
    <input class="form-control" type="input" name="Tags" placeholder="Tags">
  </div>

  <div class="col-sm-3">
    <input class="form-control" type="input" name="UserName" placeholder="User Name">
  </div>

  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Search</button>
  </div>

  <?php if (isset($isFilterMode) && $isFilterMode == true): ?>
    <div class="col-auto">
      <a href="/questions" class="btn btn-outline-danger">Clear Filter</a>
    </div>
  <?php endif; ?>
</form>

<table class="table table-bordered table-hover" id="task-list">
  <thead class="table-dark align-middle">
    <tr>
      <th scope="col" class="text-center">Question ID</th>
      <th scope="col" class="text-center">Question</th>
      <th scope="col" class="text-center">User Name</th>
      <th scope="col" class="text-center">Tags</th>
      <th scope="col" class="text-center">Created Date</th>
      <th scope="col" class="text-center">Number of<br>Answerers</th>
      <th scope="col" class="text-center">View<br>Answers</th>
    </tr>
  </thead>

  <tbody class="table-group-divider align-middle">
    <?php foreach ($QuestionList as $QuestionItem): ?>
      <tr>
        <td width="136" class="text-center"><?php echo $QuestionItem['QuestionID']; ?></td>

        <td><?php echo $QuestionItem['Question']; ?></td>

        <td width="136" class="text-center">
          <a href="/questions?UserName=<?php echo $QuestionItem['UserName']; ?>">
            <?php echo $QuestionItem['UserName']; ?>
          </a>
        </td>

        <td><?php echo $QuestionItem['Tags']; ?></td>

        <td width="192" class="text-center"><?php echo $QuestionItem['CreatedDate']; ?></td>

        <td class="text-center"><?php echo $QuestionItem['NumberAnswerers']; ?></td>

        <td width="136" class="text-center"><a href="/questions/answers?QuestionID=<?php echo $QuestionItem['QuestionID']; ?>">Answers</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  $currentUrl = PaginationHelper::getCurrentUrl();
  echo PaginationHelper::buildPagination($TotalItems, $Page, $currentUrl);
?>
