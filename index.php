<?php include "header.php" ?>
    <main>
      <section class="destaque">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="destaque-banana-herald">
                the banana herald - the best game of community
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="cad-pesq">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <div class="cad margin-right">
                <h3><div class="icon"></div>faça parte da maior comunidade de games</h3>
                <form class="" action="index.html" method="post">
                  <input type="text" name="name" placeholder="seu nome" value="">
                  <input type="text" name="name" placeholder="seu email" value="">
                  <input class="cad-agora" type="button" name="name" value="cadastre-se agora">
                </form>
              </div>
            </div>
            <div class="col-md-5">
              <div class="pesq">
                <h3><div class="icon-2"></div>enquete</h3>
                <p>Qual o melhor jogo do ano de 2015?</p>
                <form class="" action="index.html" method="post">
                  <ul>
                    <li>  <input type="radio" name="bestgame" value="Jogo-1"><span>Opcao 1</span> </li>
                    <li>  <input type="radio" name="bestgame" value="Jogo-2"><span>Opcao 2</span></li>
                    <li>  <input type="radio" name="bestgame" value="Jogo-3"><span>Opcao 3</span></li>
                  </ul>
                  <input class="ok-btn" type="button" name="bestgame" value="votar">
                </form>

              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="top-da-semana">
        <h3><div class="icon-3"></div>Top da semana</h3>
        <div class="top-game game-1" style="background:url('images/game-1.jpg')">
          <div class="hover-top">
            <h4>Moral Kombat</h4>
            <div class="star-4"></div>
            <div class="btn-ver-agora">
              ver agora
            </div>
          </div>
        </div>
        <div class="top-game game-2" style="background:url('images/game-2.jpg')">
          <div class="hover-top">
            <h4>Assassin's creed</h4>
            <div class="star-4"></div>
            <div class="btn-ver-agora">
              ver agora
            </div>
          </div>
        </div>
        <div class="top-game game-3" style="background:url('images/game-3.jpg')">
          <div class="hover-top">
            <h4>Spider-man</h4>
            <div class="star-4"></div>
            <div class="btn-ver-agora">
              ver agora
            </div>
          </div>
        </div>
        <div class="top-game game-4" style="background:url('images/game-4.jpg')">
          <div class="hover-top">
            <h4>Sword in skull </h4>
            <div class="star-4"></div>
            <div class="btn-ver-agora">
              ver agora
            </div>
          </div>
        </div>
      </section>
      <section class="banana-numeros">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="icon-visitantes"></div>
              <p class="banana-numeros var-visitantes">
                #var-visitantes#
              </p>
              <p class="banana-numeros-txt">
                visitantes
              </p>
            </div>
            <div class="col-md-4">
              <div class="icon-post"></div>
              <p class="banana-numeros var-post">
                #var-post's#
              </p>
              <p class="banana-numeros-txt">
                posts
              </p>
            </div>
            <div class="col-md-4">
              <div class="icon-curtidas"></div>
              <p class="banana-numeros var-curtidas">
                #var-curtidas#
              </p>
              <p class="banana-numeros-txt">
                curtidas
              </p>
            </div>
          </div>
        </div>

      </section>
    </main>

<?php include "footer.php" ?>
