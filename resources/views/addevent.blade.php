@extends('layout.master')
<!-- / Navbar -->
@section('title','Agendando o evento')
@section('content')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Solicitação de Agendamento para o dia {{ date('d/m/Y',strtotime($data)) }}</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-12">
                  <div class="card mb-4">                    
                    <div class="card-body">
                    <form action="#" id="formAgenda" method="post">
                      @csrf
                      <div class="mb-3">
                          <label class="form-label" for=""> O que irá ocorrer? </label>
                          <input type="text" name="disciplina" id="disciplina" class="form-control" required>
                      </div>
                      <div class="mb-3 col-12">
                        <label class="form-label" for=""> Data </label>
                        <input type="date" value="{{ $data }}" name="data" id="data" class="form-control" id="data">                                                
                      </div>        
                      <div class="col-12 mb-3">
                        <div class="row">
                          <div class="col-6">
                          <label class="form-label" for="">Horário</label>
                            <select name="horario" id="horario" class="form-select">
                                <option value="07:15"> AM(07:15 - 08-15) </option>
                                <option value="08:15"> BM(08:15 - 09:15) </option>
                                <option value="09:30"> CM(09:30 - 10:30) </option>
                                <option value="10:30"> DM(10:30 - 11:30) </option>
                                <option value="13:15"> AT(13:15 - 14:15) </option>
                                <option value="14:15"> BT(14:15 - 15:15) </option>
                                <option value="15:30"> CT(15:30 - 16:30) </option>
                                <option value="16:30"> DT(16:30 - 17:30) </option>
                                <option value="18:00"> AN(18:00 - 20:00) </option>
                                <option value="20:00"> BN(20:00 - 22:00) </option>                              
                            </select>
                          </div>
                          <div class="col-6">
                          <label class="form-label" for="">Extensão do horário</label>
                            <select name="extensao_horario" id="extensao_horario" class="form-select">
                                <option value="00:00"> Prefiro não extender </option>
                                <option value="07:15"> Extender à AM(07:15 - 08-15) </option>
                                <option value="08:15"> Extender à BM(08:15 - 09:15) </option>
                                <option value="09:30"> Extender à CM(09:30 - 10:30) </option>
                                <option value="10:30"> Extender à DM(10:30 - 11:30) </option>
                                <option value="13:15"> Extender à AT(13:15 - 14:15) </option>
                                <option value="14:15"> Extender à BT(14:15 - 15:15) </option>
                                <option value="15:30"> Extender à CT(15:30 - 16:30) </option>
                                <option value="16:30"> Extender à DT(16:30 - 17:30) </option>
                                <option value="18:00"> Extender à AN(18:00 - 20:00) </option>
                                <option value="20:00"> Extender à BN(20:00 - 22:00) </option>                                
                            </select>
                          </div>            
                        </div>
                      </div>  
                      <div class="mb-3">
                        <input type="hidden" value="pink" name="color" id="color">
                      </div>
                      <input type="text" value="{{ auth()->user()->name }}" name="user" id="user" hidden>
                      <div class="text-center align-items-center mb-3">
                          <button type="button" class="btn btn-success m-2" id="showModal"><i class="bx bxs-plus-circle"></i> Solicitar agendamento </button>
                          <a href="{{ route('index') }}" class="btn btn-secondary"><i class="bx bx-reply"></i> Voltar á pagina inicial</a>
                      </div>
                  </form>
                    </div>
                  </div>
                </div>
            </div>
            <!-- / Content -->

            <div class="modal fade" id="modalAgenda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    @php
                      setlocale(LC_TIME,'pt_BR', 'pt_BR.utf-8','portuguese');
                      date_default_timezone_set('America/Sao_Paulo');                                           
                      $dia = utf8_encode(strftime('%A', strtotime($data)));
                    @endphp           
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Deseja extender esse horário para todas a(s)/o(s) {{ $dia; }}s<!-- Deseja extender esse horário para todas as semanas?Se sim,indique até quando deseja extender. --></h1>            
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>            
                  </div>          
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="naoExtensao">Não</button>
                    <button type="button" id="modalExtensao" data-bs-dismiss="modal" class="btn btn-success">Sim</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modalAgendaExtensao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">            
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Defina até que dia deseja extender: <!-- Deseja extender esse horário para todas as semanas?Se sim,indique até quando deseja extender. --></h1>            
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="justify-content-center align-items-center my-3 lg">           
                      <label for=""> Data de término </label>
                      <input type="date" name="data_termino" id="data_termino" value="{{ $data }}" class="form-control">              
                    </div>
                  </div>
                  <div class="modal-footer">            
                    <button type="button" id="simExtensao" class="btn btn-success"><i class="bx bxs-check-square"></i>&nbsp;Socilitar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
    </div>
  @endsection
    <!-- / Layout wrapper -->    
@section('scripts')
    <script>
      $(document).ready(
        function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });            

          $('#dat_final').hide();
          $('#a_periodo').change(function(){
              $('#dat_final').show();
          })
          
          $('#modalAgenda').modal('hide')

          $('#showModal').click(function(){
            var data = $('#data').val();
            $data = data;
            $('#modalAgenda').modal('show')
          })

          $('#modalExtensao').click(function(){
            $('#modalAgendaExtensao').modal('show');
          })

          $('#simExtensao').click(function(){
            var disciplina = $('#disciplina').val();
            var start_event = $('#data').val();
            var horario = $('#horario').val();
            var extensao_horario = $('#extensao_horario').val();
            var data_termino = $('#data_termino').val();
            var color = $('#color').val();
            var user = $('#user').val();
            var dia_semana = $('#dia_semana').val();

            $.ajax({
              url: "{{ route('confirm.agenda') }}",
              type: "POST",
              dataType: "json",
              data: {disciplina,start_event,horario,extensao_horario,data_termino,color,user,dia_semana},
              success: window.location.href = "{{ route('index') }}"
            })
          })  
          
          $('#naoExtensao').click(function(){
            var disciplina = $('#disciplina').val();
            var start_event = $('#data').val();
            var horario = $('#horario').val();
            var extensao_horario = $('#extensao_horario').val();
            var data_termino = null;
            var color = $('#color').val();
            var user = $('#user').val();

            $.ajax({
              url: "{{ route('confirm.agenda') }}",
              type: "POST",
              dataType: "json",
              data: {disciplina,start_event,horario,extensao_horario,data_termino,color,user},
              success: window.location.href = "{{ route('index') }}"
            })
          })  
        }
      )
    </script>
  </body>
</html>
@endsection