<?php include "header.php" ?>
<!-- include libraries(jQuery, bootstrap, fontawesome) -->
<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
<!-- include summernote css/js-->
<link href="summernote.css" rel="stylesheet">
<script src="summernote.min.js"></script>

<main id="admin">
  <div class="container">
    <div class="row">
      <div class="col-md-4">

        <?php include "adm-aside.php" ?>

      </div>
      <div class="row col-md-8 bg-clean">
        <div class="post">
          <form action="post">
              <h4 class="title-new t-post">Novo post</h4>
              <input type="text" name="name" value="" placeholder="Titulo Aqui">
              <div id="summernote">Hello Summernote</div>
              <select class="select-cat" name="">
                <option value="cat-1"> cat-1 </option>
                <option value="cat-2"> cat-2 </option>
                <option value="cat-3"> cat-3 </option>
              </select>
              <input type="button" name="envia" value="Publicar">
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">
$(document).ready(function() {
  $('#summernote').summernote();
});
$('.summernote').summernote(
    {
    height: 300,                 // set editor height
    minHeight: null,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
    focus: true,                 // set focus to editable area after initializing summernote
    }
);

</script>
<?php include "footer.php" ?>
