<?php

namespace App\Http\Controllers;

use App\Mail\Confirmation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConfirmationController extends Controller
{
    public function confirm(Request $request)
    {
        if($request->data_termino != null){
            if(($request->horario >= '07:15') && ($request->horario <= '17:30')){
                if($request->extensao_horario != '00:00'){
                    $horario_fim = gmdate('H:i', strtotime($request->extensao_horario ) + strtotime('01:00') );
                }else{
                    $horario_fim = gmdate('H:i', strtotime($request->horario) + strtotime('01:00') );
                }

            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            $dia_semana = utf8_encode(strftime('%A', strtotime($request->start_event)));

            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("esportes.sobral@ifce.edu.br", "Esportes");
            $email->setSubject("Novo agendamento!");
            $email->addTo("mateus.vieira@ifce.edu.br", "Mateus Vieira");
            $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
            $email->addContent("text/html","
                <p> Assunto : $request->disciplina </p>
                <p> Usuário : $request->user </p>
                <p> Data : ".date('d/m/Y',strtotime($request->start_event))."
                <p> Data de término : ".date('d/m/Y',strtotime($request->data_termino))."
                <p> Extensão : Todas as/os ".$dia_semana."s
                <p> Horario : $request->horario - $horario_fim
                <button><a href='http://127.0.0.1:8000/addevent?disciplina=$request->disciplina&data=$request->start_event&horario=$request->horario&extensao_horario=$request->extensao_horario&color=$request->color&data_termino=$request->data_termino'> Confirmar </a></button>
            ");
            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
            try {
                $response = $sendgrid->send($email);
            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }
            }else{
            if($request->extensao_horario != '00:00'){
                $horario_fim = gmdate('H:i', strtotime($request->extensao_horario ) + strtotime('02:00') );
            }else{
                $horario_fim = gmdate('H:i', strtotime($request->horario) + strtotime('02:00') );
            }
    
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("esportes.sobral@ifce.edu.br", "Esportes");
                $email->setSubject("Sending with Twilio SendGrid is Fun");
                $email->addTo("mateus.vieira@ifce.edu.br", "Mateus Vieira");
                $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                $email->addContent("text/html","
                    <p> Assunto : $request->disciplina </p>
                    <p> Usuário : $request->user </p>
                    <p> Data : ".date('d/m/Y',strtotime($request->start_event))."
                    <p> Data de término : ".date('d/m/Y',strtotime($request->data_termino))."                
                    <p> Horario : $request->horario - $horario_fim
                    <button><a href='http://127.0.0.1:8000/addevent?disciplina=$request->disciplina&data=$request->start_event&horario=$request->horario&extensao_horario=$request->extensao_horario&color=$request->color&data_termino=$request->data_termino'> Confirmar </a></button>
                ");
                $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                try {
                    $response = $sendgrid->send($email);
                    return redirect()->route('index')->with('success','Solicitação enviada com sucesso!Aguarde a confirmação do agenda!');
                } catch (Exception $e) {
                    echo 'Caught exception: '. $e->getMessage() ."\n";
                }
            }
            //else do if($request->data_termino != null)    
        }else{
            if(($request->horario >= '07:15') && ($request->horario <= '17:30')){
                if($request->extensao_horario != '00:00'){
                    $horario_fim = gmdate('H:i', strtotime($request->extensao_horario ) + strtotime('01:00') );
                }else{
                    $horario_fim = gmdate('H:i', strtotime($request->horario) + strtotime('01:00') );
                }
    
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("esportes.sobral@ifce.edu.br", "Esportes");
            $email->setSubject("Sending with Twilio SendGrid is Fun");
            $email->addTo("mateus.vieira@ifce.edu.br", "Mateus Vieira");
            $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
            $email->addContent("text/html","
                <p> Assunto : $request->disciplina </p>
                <p> Usuário : $request->user </p>
                <p> Data : ".date('d/m/Y',strtotime($request->start_event))."
                <p> Data de término : Somente nesse dia
                <p> Horario : $request->horario - $horario_fim
                <button><a href='http://127.0.0.1:8000/addevent?disciplina=$request->disciplina&data=$request->start_event&horario=$request->horario&extensao_horario=$request->extensao_horario&color=$request->color&data_termino=null'> Confirmar </a></button>
            ");
            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
            try {
                $response = $sendgrid->send($email);
                return redirect()->route('index')->with('success','Solicitação enviada com sucesso!Aguarde a confirmação do agenda!');
            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }
        }else{
            if($request->extensao_horario != '00:00'){
                $horario_fim = gmdate('H:i', strtotime($request->extensao_horario ) + strtotime('02:00') );
            }else{
                $horario_fim = gmdate('H:i', strtotime($request->horario) + strtotime('02:00') );
            }
    
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("esportes.sobral@ifce.edu.br", "Esportes");
                $email->setSubject("Sending with Twilio SendGrid is Fun");
                $email->addTo("mateus.vieira@ifce.edu.br", "Mateus Vieira");
                $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                $email->addContent("text/html","
                    <p> Assunto : $request->disciplina </p>
                    <p> Usuário : $request->user </p>
                    <p> Data : ".date('d/m/Y',strtotime($request->start_event))."
                    <p> Data de término : Somente nesse dia                
                    <p> Horario : $request->horario - $horario_fim
                    <button><a href='http://127.0.0.1:8000/addevent?disciplina=$request->disciplina&data=$request->start_event&horario=$request->horario&extensao_horario=$request->extensao_horario&color=$request->color&data_termino=null'> Confirmar </a></button>
                ");
                $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                try {
                    $response = $sendgrid->send($email);
                    return redirect()->route('index')->with('success','Solicitação enviada com sucesso!Aguarde a confirmação do agenda!');
                } catch (Exception $e) {
                    echo 'Caught exception: '. $e->getMessage() ."\n";
                }
            }   
        }
    }
}
