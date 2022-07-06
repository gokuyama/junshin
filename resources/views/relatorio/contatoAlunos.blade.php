<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>
    <title>TURMA</title>
</head>

<body>
    <div>
        <h1>
            <!--<img style="display: inline-block;" src="C:\junshin\public\img\junshin_logo.png" alt="Logo do Junshin">-->
            <img style="align-right" src="http://secretaria.junshin.com.br/img/junshin_logo.png">
            ESCOLA JUNSHIN {{ now()->year }}
        </h1>
    </div>
    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
        <tr>
            <td style="border: 1px solid black; text-align: center;">@if (count($listaAlunos) > 0)
                <strong>Turma: {{$listaAlunos[0]->turma_descricao}}</strong>
                @endif
            </td>
            <td>Sensei: </td>
        </tr>
    </table>
    <table style="border-collapse: collapse; border: 1px solid black; width: 100%; table-layout: fixed">
        <tr>
            <td style="word-wrap: break-word; border-collapse: collapse;width:3%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                Nº
            </td>
            <td style="word-wrap: break-word; border-collapse: collapse;width:30%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                Aluno
            </td>
            <td style="word-wrap: break-word; border-collapse: collapse;width:10%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                Data de Nascimento
            </td>
            <td style="word-wrap: break-word; border-collapse: collapse;width:12%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                Telefone Fixo
            </td>
            <td style="border-collapse: collapse;width:35%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                Responsáveis
            </td>
            <td style="word-wrap: break-word; border-collapse: collapse;width:10%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                Celulares
            </td>
        </tr>
        @if (count($listaAlunos) > 0)
        @foreach ($listaAlunos as $alunoTurma)
        <tr>
            <td style="border-collapse: collapse;width:1%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                {{$loop->index + 1}}
            </td>
            <td style="border-collapse: collapse;width:30%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                {{$alunoTurma->aluno_nome}}
            </td>
            <td style="border-collapse: collapse;width:10%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                {{$alunoTurma->data_nascimento}}
            </td>
            <td style="border-collapse: collapse;width:12%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                {{$alunoTurma->aluno_telefone_fixo}}
            </td>
            <td style="border-collapse: collapse;width:35%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                {!! nl2br(str_replace(',','<br>',$alunoTurma->responsaveis)) !!}
            </td>
            <td style="border-collapse: collapse;width:10%; height:35px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                {!! nl2br(str_replace(',','<br>',$alunoTurma->celulares)) !!}
            </td>
        </tr>
        @endforeach
        @endif
    </table>
    <style>
        td {
            border: 1px solid black;
        }
    </style>
</body>

</html>