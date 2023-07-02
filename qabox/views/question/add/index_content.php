<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>
      Add Question
    </h1>

    <form id="form-add-question" method="post" action="/questions/add">
      <div class="mb-3">
        <label for="Question" class="form-label">Content</label>
        <textarea class="form-control" name="Question" id="Question" placeholder="Enter question content"></textarea>
      </div>

      <div class="mb-3">
        <label for="start_date" class="form-label">Tags</label>
        <input type="text" class="form-control" name="Tags" id="Tags" placeholder="Example: Geography, Travel">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-block" id="btn-submit" data-loading-text="Đang xử lí ...">
          Add Question
        </button>
      </div>
    </form>
  </div>
</div>