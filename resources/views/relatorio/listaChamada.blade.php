<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>
    <title>LISTA DE CHAMADA</title>
</head>

<body>
    <div>
        <h1>
            <!--<img style="display: inline-block;" src="C:\junshin\public\img\junshin_logo.png" alt="Logo do Junshin">-->
            <img style="align-right" src="/img/junshin_logo.png">
            ESCOLA JUNSHIN {{ now()->year }}
        </h1>
    </div>
    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
        <tr>
            <td>
                <h2 style="text-align: center;">{{$mes_hoje}}</h2>
            </td>
            <td style="border: 1px solid black; text-align: center;">@if (count($alunosTurma) > 0)
                <strong>TURMA: {{$alunosTurma[0]->turma_descricao}}</strong>
                @endif
            </td>
            <td>PROFESSORA: </td>
        </tr>
    </table>
    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
        <tr>
            <td>
                Nº
            </td>
            <td>
                Aluno
            </td>
            @for ($i = 1; $i <= count($diaFds); $i++) <td
                style="{{ $diaFds[$i-1][1] ? 'background-color: #808080;' : ''}}">
                {{ $i }}
                </td>
                @endfor
                <td>
                    P
                </td>
                <td>
                    F
                </td>
        </tr>
        @if (count($alunosTurma) > 0)
        @foreach ($alunosTurma as $alunoTurma)
        <tr>
            <td>
                {{$loop->index + 1}}
            </td>
            <td>
                {{$alunoTurma->aluno_nome}}
            </td>
            @for ($i = 1; $i <= count($diaFds); $i++) <td
                style="{{ $diaFds[$i-1][1] ? 'background-color: #808080;' : ''}}">
                </td>
                @endfor
                <td></td>
                <td></td>
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