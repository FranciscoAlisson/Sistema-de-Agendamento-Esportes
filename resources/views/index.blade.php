@extends('layout.master')
@section('title','Página principal')
@section('content')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="my-3 mx-4 text-center align-items-center justify-content-center">
              <h4> <img src="/html/ifce_logo.svg" style="width:30px;margin-bottom:3.5px;" alt=""> HORÁRIO DE OCUPAÇÃO DO GINÁSIO POLIESPORTIVO </h4>
            </div>            
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="my-2">
                <a href="{{ route('login.destroy') }}" class="btn btn-info"><i class="bx bx-reply-all"></i> Sair </a>
              </div>
              @if(session('dropSuccess'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
										<strong>Sucesso!</strong> {{ session('dropSuccess') }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								@endif

								@if(session('dropFail'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
										<strong>Erro!</strong> {{ session('dropFail') }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								@endif

								@if(session('error'))
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<strong>Erro!</strong> {{ session('error') }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								@endif

								@if(session('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
										<strong>Sucesso!</strong> {{ session('success') }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								@endif

								@if(session('successEdit'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
										<strong>Sucesso!</strong> {{ session('successEdit') }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								@endif

								@if(session('successAgendamento'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
										<strong>Sucesso!</strong> {{ session('successAgendamento') }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								@endif

              <div class="my-3" id="calendar"></div>

            </div>
            <!-- / Content -->       
            
            <div class="modal fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">           
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Qual ação você deseja fazer?</h1>            
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p> Assunto : <span id="assunto"></span> </p>
                    <p> Data : <span id="data_inicio"></span> </p> 
                    <p> Horário : <span id="horario"></span> - <span id="horario_fim"></span> </p>               
                  </div>
                  <div class="modal-footer">            
                    <button type="button" id="alterar" class="btn btn-success"><i class="bx bxs-edit"></i>&nbsp; Alterar </button>
                    <button type="button" id="excluir" class="btn btn-danger"><i class="bx bxs-trash"></i>&nbsp; Excluir </button>
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
@endsection
          <!-- Content wrapper -->  
@section('scripts')      
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.8/index.global.min.js"></script>

    @if(auth()->user()->email == 'mateus.vieira@ifce.edu.br')
				<script>
					document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar'); 
        var datas = @json($dados);
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'timeGridWeek',          
          headerToolbar: {
            start: 'prev next today',
            center: 'title',
            end: 'dayGridMonth timeGridWeek'
          },
					dayMinWidth: '160',       
          stickyFooterScrollbar: true,             
					displayEventEnd: true,           
          eventClick: function(info){
            $('#modalConfirmation').modal('show')

            $('#assunto').text(info.event.title)
            $('#data_inicio').text(info.event.start.toLocaleDateString())
            $('#horario').text(info.event.start.toLocaleTimeString())
            $('#horario_fim').text(info.event.end.toLocaleTimeString())            

            $('#alterar').click(function(){
              window.location.href = '/alter-event/' + info.event.id
              
            })

            $('#excluir').click(function(){
              window.location.href = '/drop-event/' + info.event.id
            })
          },   
          eventDisplay: 'auto',      
          contentHeight: 700,									              
          nowIndicator: true,
          selectOverlap: false,
          events:datas,
          allDaySlot: false,
          forceEventDuration: true,
          slotMinTime: '07:00:00',
          slotMaxTime: '23:00:00',
          slotDuration: '00:15:00',
          eventLimit: false,
          timeFormat: 'HH:mm',
          hiddenDays: [0,6],
          navLinks: true,
          navLinkDayClick: function(date, jsEvent) {
            calendar.changeView('list',date)
          },
          buttonText:{
            today: 'hoje',
            month: 'Agenda mensal',
            week:  'Agenda semanal',
            day:   'Agenda do dia',
            list:  'Lista da semana'
          },
          locale: 'pt-br',
          dateClick: function(info) {

            window.location.href = '/create-event/' + info.dateStr.toLocaleString().substr(0, 10)            

          }
        });
							        
        calendar.render();
      });
		</script>
		@else
    <script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar'); 
      var datas = @json($dados);
      var calendar = new FullCalendar.Calendar(calendarEl, {          
        initialView: 'timeGridWeek',
        headerToolbar: {
          start: 'prev next today',
          center: 'title',
          end: 'dayGridMonth timeGridWeek'
        },        
        eventDisplay: 'auto',
        dayMinWidth: '100',
        contentHeight:850,
        nowIndicator: true,
        selectOverlap: false,
        displayEventEnd: true,
        events:datas,
        allDaySlot: false,
        forceEventDuration: true,
        slotMinTime: '07:00:00',
        slotMaxTime: '23:00:00',
        slotDuration: '00:15:00',
        hiddenDays: [0],
        timeFormat: 'HH:mm',
        navLinks: true,
        navLinkDayClick: function(date) {
          calendar.changeView('list',date)
        },
        buttonText:{
            today: 'hoje',
            month: 'Agenda mensal',
            week:  'Agenda semanal',
            day:   'Agenda do dia',
            list:  'Lista da semana'
          },
        locale: 'pt-br',
        dateClick: function(info) {      
              
          window.location.href = '/create-event/' + info.dateStr.toLocaleString().substr(0, 10);   
          
        }
      });
      calendar.render();
    });

    </script>
    @endif
  </body>
</html>
@endsection
