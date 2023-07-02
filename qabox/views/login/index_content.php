<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>
      Login
    </h1>

    <form method="post" action="/login">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="username">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="password">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">
          Login
        </button>
      </div>
    </form>
  </div>
</div>