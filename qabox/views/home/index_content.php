<?php
  $Role = isset($_SESSION['user']) ? $_SESSION['user']['Role'] : '';
?>

<div class="container">
  <div class="row">
    <h1>
      Home
    </h1>

    <div class="row g-3">
      <?php if(in_array($Role, ['Admin', 'Questioner'])): ?>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Question</h5>
              <p class="card-text">Allow users to post new questions</p>
              <a href="/questions/add" class="btn btn-primary">Access</a>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Questions</h5>
            <p class="card-text">Display a list of questions posted by users</p>
            <a href="/questions" class="btn btn-primary">Access</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Answers</h5>
            <p class="card-text">Display a list of answers to the user's posted question</p>
            <a href="/answers" class="btn btn-primary">Access</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Evaluates</h5>
            <p class="card-text">Display a list of user evaluates for answers</p>
            <a href="/evaluates" class="btn btn-primary">Access</a>
          </div>
        </div>
      </div>

      <?php if(!in_array($Role, ['Admin'])): ?>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tài khoản</h5>
              <p class="card-text">Cho phép Admin thay đổi vai trò của người dùng.</p>
              <a href="/admin" class="btn btn-primary">Access</a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>