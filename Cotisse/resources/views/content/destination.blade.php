@include('template.header')
     <section class="why_section layout_padding">
        <div class="container">
           <div class="heading_container heading_center">
              <h3 style="text-align: center;">Liste des villes disponnibles</h3>
           </div>
           <form action="{{ url('/voyage') }}" method="GET">
            <div class="row">
                <input type="hidden" value="{{ $idtype }}" name="idtype">
               <div class="col-md-6">
                  <div class="box ">
                     <div class="detail-box">
                        <h5>
                           Votre position actuelle
                        </h5>
                        <select class="form-select form-select-lg mb-3 sel" aria-label=".form-select-lg example" name="position">
                              <option selected>Choissiser une ville</option>
                              @foreach ($ville as $row)
                                 <option value="{{ $row->id }}">{{ $row->nom }}</option>
                              @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="box">
                     <div class="detail-box">
                        <h5>
                           Destination
                        </h5>
                        <select class="form-select form-select-lg mb-3 sel" aria-label=".form-select-lg example" name="destination">
                              <option selected>Choissiser une ville</option>
                              @foreach ($ville as $row)
                                 <option value="{{ $row->id }}">{{ $row->nom }}</option>
                              @endforeach
                           </select>
                     </div>
                  </div>
                  </div>
            </div>
            <br>
            <div class="heading_container heading_center">
               <h4><button type="submit" class="but">Valider</button></h4>
            </div>
            @if(!empty($message))
                <div class="heading_container heading_center">
                    <b class="text-danger">{{ $message }}</b>
                </div>
            @endif
           </form>
        </div>
     </section>


