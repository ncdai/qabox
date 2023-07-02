<script>
  $(document).ready(function () {
    $("#form-search input[name=Question]").val('<?php echo $Question; ?>');
    $("#form-search input[name=Tags]").val('<?php echo $Tags; ?>');
    $("#form-search input[name=UserName]").val('<?php echo $UserName; ?>');
  });
</script>