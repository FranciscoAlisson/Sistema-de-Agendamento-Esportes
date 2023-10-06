@extends('layout.master')

          <!-- / Navbar -->
@section('title','Alterando os dados do agendamento')
@section('content')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Alterando os dados do agendamento</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-12">
                  <div class="card mb-4">                    
                    <div class="card-body">
                      <form action="{{ route('edit.event') }}" method="post">
                        @csrf
                        <input type="text" value="{{ $dados->id }}" name="id" hidden>
                        <div class="mb-3">
                            <label for=""> Disciplina </label>
                            <input type="text" name="disciplina" value="{{ $dados->title }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Data</label>
                            <input type="date" value="{{ $data }}" name="data" class="form-control" id="data">            
                        </div>    
                        <div class="col-12 mb-3">
                          <div class="row">
                            <div class="col-6">
                            <label for="">Horário</label>
                              <select name="horario" class="form-select">
                                  <option value="07:15" {{ ($dados->start_event ==  $data .' '.'07:15:00') ? 'selected="selected"' : ""}}> AM(07:15 - 08-15) </option>
                                  <option value="08:15" {{ ($dados->start_event == $data.' '.'08:15:00') ? 'selected="selected"' : ""}}> BM(08:15 - 09:15) </option>
                                  <option value="09:30" {{ ($dados->start_event == $data.' '.'09:30:00') ? 'selected="selected"' : ""}}> CM(09:30 - 10:30) </option>
                                  <option value="10:30" {{ ($dados->start_event ==  $data .' '.'10:30:00') ? 'selected="selected"' : ""}}> DM(10:30 - 11:30) </option>
                                  <option value="13:15" {{ ($dados->start_event ==  $data .' '.'13:15:00') ? 'selected="selected"' : ""}}> AT(13:15 - 14:15) </option>
                                  <option value="14:15" {{ ($dados->start_event ==  $data .' '.'14:15:00') ? 'selected="selected"' : ""}}> BT(14:15 - 15:15) </option>
                                  <option value="15:30" {{ ($dados->start_event ==  $data .' '.'15:30:00') ? 'selected="selected"' : ""}}> CT(15:30 - 16:30) </option>
                                  <option value="16:30" {{ ($dados->start_event ==  $data .' '.'16:30:00') ? 'selected="selected"' : ""}}> DT(16:30 - 17:30) </option>
                                  <option value="18:30" {{ ($dados->start_event ==  $data .' '.'18:30:00') ? 'selected="selected"' : ""}}> AN(18:30 - 19:20) </option>
                                  <option value="19:20" {{ ($dados->start_event ==  $data .' '.'19:20:00') ? 'selected="selected"' : ""}}> BN(19:20 - 20:10) </option>
                                  <option value="20:20" {{ ($dados->start_event ==  $data.' '.'20:20:00') ? 'selected="selected"' : ""}}> CN(20:20 - 21:10) </option>
                                  <option value="21:10" {{ ($dados->start_event ==  $data .' '.'21:10:00') ? 'selected="selected"' : ""}}> DN(21:10 - 22:00) </option>
                              </select>
                            </div>
                            <div class="col-6">
                            <label for="">Extensão do horário</label>
                              <select name="extensao_horario" class="form-select">
                                  <option value=""> Prefiro não extender </option>
                                  <option value="07:15" {{ ($dados->end_event ==  $data .' '.'08:15:00') ? 'selected="selected"' : ""}}> Extender à AM(07:15 - 08-15) </option>
                                  <option value="08:15" {{ ($dados->end_event ==  $data .' '.'09:15:00') ? 'selected="selected"' : ""}}> Extender à BM(08:15 - 09:15) </option>
                                  <option value="09:30" {{ ($dados->end_event ==  $data .' '.'10:30:00') ? 'selected="selected"' : ""}}> Extender à CM(09:30 - 10:30) </option>
                                  <option value="10:30" {{ ($dados->end_event ==  $data .' '.'11:30:00') ? 'selected="selected"' : ""}}> Extender à DM(10:30 - 11:30) </option>
                                  <option value="13:15" {{ ($dados->end_event ==  $data .' '.'14:15:00') ? 'selected="selected"' : ""}}> Extender à AT(13:15 - 14:15) </option>
                                  <option value="14:15" {{ ($dados->end_event ==  $data .' '.'15:15:00') ? 'selected="selected"' : ""}}> Extender à BT(14:15 - 15:15) </option>
                                  <option value="15:30" {{ ($dados->end_event ==  $data .' '.'16:30:00') ? 'selected="selected"' : ""}}> Extender à CT(15:30 - 16:30) </option>
                                  <option value="16:30" {{ ($dados->end_event ==  $data .' '.'17:30:00') ? 'selected="selected"' : ""}}> Extender à DT(16:30 - 17:30) </option>
                                  <option value="18:00" {{ ($dados->end_event ==  $data .' '.'20:00:00') ? 'selected="selected"' : ""}}> Extender à AN(18:30 - 19:20) </option>
                                  <option value="20:00" {{ ($dados->end_event ==  $data .' '.'22:00:00') ? 'selected="selected"' : ""}}> Extender à BN(19:20 - 20:10) </option>                                  
                              </select>
                            </div>            
                          </div>
                        </div>  
                        <div class="mb-3">
                          <input type="hidden" value="pink" name="color">
                        </div>  
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success"> Alterar agendamento </button>
                            <a href="{{ route('index') }}" class="btn btn-secondary">Voltar </a>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
            </div>
            <!-- / Content -->

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
    <!-- / Layout wrapper -->    
@endsection
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
   @section('scripts')    
  </body>
</html>
@endsection
