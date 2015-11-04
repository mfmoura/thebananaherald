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
          <form method="post" action="" id="ajax_form">
              <h4 class="title-new t-post">Novo post</h4>
              <input id="id-usuario" type="hidden" name="idUsuario" value="26">
              <input id="titulo" type="text" name="titulo" value="" placeholder="Titulo Aqui">
              <div id="summernote">

              </div>
              <select id="assunto" class="select-cat" name="assunto">
                <option value="1"> Assunto Teste</option>
                <option value="cat-2"> cat-2 </option>
                <option value="cat-3"> cat-3 </option>
              </select>
              <input id="sessao" type="hidden" name="sessao" value="1">
              <input type="submit" type="submit" name="enviar" value="Publicar">
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">
$(document).ready(function(){
   $('#ajax_form').validate({
     rules: {
       nome: { required: true, minlength: 2 },

     },
     messages: {
       nome: { required: 'Preencha o campo nome', minlength: 'No mínimo 2 letras' },


     },
     submitHandler: function( form ){


       var mensagem = $('.note-editable.panel-body').text(),
           idUsuario = $('#id-usuario').val(),
           titulo = $('#titulo').val(),
           assunto = $('#assunto').val(),
           sessao = $('#sessao').val();



       $.ajax({
         url: '/obj/topico_insere_obj.php',
         type: 'post',
         data: {"idUsuario":idUsuario,"titulo":titulo,"mensagem":mensagem,"assunto":assunto,"sessao":{"sessao1":sessao},
         
         success: function()
         {
             $('body').append('TESTE TESTE TESTE');
         }
       });

       return false;
     }
   });
 });




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
