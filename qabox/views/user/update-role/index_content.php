<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>
      Update Role
    </h1>

    <?php if (isset($_SESSION['user'])): ?>
      <?php if ($_SESSION['user']['Role'] == "Admin"): ?>
        <div class="alert alert-danger" role="alert">
          You are Admin, you can't update your role.
        </div>
      <?php else: ?>
        <form id="form-update-role" method="post" action="">
          <div class="mb-3">
            <label for="Role" class="form-label">Role</label>
            <select id="Role" name="Role" class="form-control">
              <option>Questioner</option>
              <option>Answerer</option>
              <option>Evaluater</option>
            </select>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-block" id="btn-submit" data-loading-text="Đang xử lí ...">
              Update Role
            </button>
          </div>
        </form>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>