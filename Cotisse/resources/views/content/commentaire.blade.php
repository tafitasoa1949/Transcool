@include('template.header')
<section class="subscribe_section">
    <div class="container-fuild">
       <div class="box">
          <div class="row">
             <div class="col-md-6 offset-md-3">
                <div class="subscribe_form ">
                   <div class="heading_container heading_center">
                      <h3>Commentaire</h3>
                   </div>
                   <p>Découvrez notre site incroyable et laissez votre avis ! Plongez dans une expérience en ligne captivante et partagez vos impressions sur notre contenu exceptionnel.</p>
                   <p>Votre commentaire compte pour nous ! Rejoignez notre communauté et contribuez à rendre notre site encore plus extraordinaire.</p>
                   <form action="{{ url('ecritCommentaire') }}" method="GET">
                      <input type="text" placeholder="Ecrire un commentaire ou plainte" id="coms" name="coms">
                      <button>
                        Commenter
                      </button>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
@include('template.footer')
