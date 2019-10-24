<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>DECLARAÇÃO DE ADIMPLÊNCIA E CANCELAMENTO DE MATRÍCULA</title>
</head>

<body>
    <table>
        <tr>
            <td style="width: 100px;">
                <img style="display: inline-block;" src="C:\junshin\public\img\junshin_logo.png">
                <!--<img style="align-right" src="/img/junshin_logo_2.png">-->
            </td>
            <td style="text-align: center; ">
                <u> Congregação das Irmãs do Imaculado Coração de Maria de Nagasaki </u><br />
                CNPJ: 75.986.968/0002-19<br />
                Assistência Social, Educacional e Cultural – Propagação da Doutrina Católica.<br />
                Rua: Nunes Machado, 289 – CEP 80250-000 – Telefone 3222-8487 – Curitiba - Paraná.<br />
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <h1 style="text-align: center">DECLARAÇÃO DE ADIMPLÊNCIA E CANCELAMENTO DE MATRÍCULA</h1>
            </td>
        </tr>
        <tr style="height:1000px; font-size: 20px;">
            <td>
                Declaramos a pedido da parte interessada, que o(a) aluno(a) {{ $aluno_nome}}
                , matriculado(a) neste estabelecimento educacional no ano letivo de {{$ano}} - {{$turma_descricao}}
                , teve sua matrícula cancelada a partir do dia {{$data_hoje}}
                a pedido do(a) contratante responsável pelos pagamentos das mensalidades escolares, Sr(a). {{$responsaveis}}
                , estando em dia com suas obrigações financeiras, nesta instituição de ensino CEI Junshin.
                Como expressão da verdade, firma-se a presente.
            </td>
    </table>
    <table style="position:absolute;bottom:300; width:100%;">
        <tr>
            <td style="text-align: right; font-size: 20px;">
                Curitiba, {{ $data_hoje}}.
            </td>
        </tr>
        <tr>
            <td style="text-align: right; height:100px; font-size: 20px;">
                _________________________________
            </td>
        </tr>
        <tr>
            <td style="text-align: right; font-size: 20px;">
                Diretora
            </td>
        </tr>
    </table>
</body>

</html>