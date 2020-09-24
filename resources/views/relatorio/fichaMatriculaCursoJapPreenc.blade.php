<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>ESCOLA JUNSHIN</title>
</head>

<body>
    <table style="border-collapse: collapse;text-align: center;width:100%; font-family:arial;">
        <tr>
            <td style="border-collapse: collapse;text-align: center; width:10%;">
                <!--<img style="border-collapse: collapse;display: inline-block;" src="C:\junshin\public\img\junshin_logo.png">-->
                <img style="border-collapse: collapse;display: inline-block;" src="http://secretaria.junshin.com.br/img/junshin_logo_2.png">
            </td>
            <td style="border-collapse: collapse;text-align: center; width:65%;">
                <h1>ESCOLA JUNSHIN</h1>
            </td>
            <td style="border-collapse: collapse;white-space:nowrap; text-align: left; width:25%;">
                <h4>Matriculado para o ano <br><br> Nº</h4>
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;text-align: center; width:100%; font-family:arial;">
        <tr>
            <td>
                <h2>FICHA DE MATRÍCULA DO CURSO DE JAPONÊS</h2>
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%; background-color: LightGray;">
        <tr>
            <td style="border-collapse: collapse; vertical-align:top;font-family:arial; font-size:12px;border: 1px solid black;">
                DADOS DO ALUNO </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                NOME COMPLETO<br>{{$aluno_nome}}</td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;width:50%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                MUNICÍPIO DE NASCIMENTO<br>{{$aluno_local_nascimento}}</td>
            <td style="border-collapse: collapse;width:25%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                DATA DE NASCIMENTO<br>{{ date( 'd/m/Y' , strtotime($aluno_data_nascimento)) }}
            </td>
            <td style="border-collapse: collapse;width:25%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                IDADE</td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;width:25%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                Nº DO RG OU R.N.<br>{{$aluno_documento}}</td>
            <td style="border-collapse: collapse;width:15%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                TELEFONE<br>{{$aluno_telefone_celular}}
            </td>
            <td style="border-collapse: collapse;width:20%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                RELIGIÃO<br>{{$aluno_religiao}}
            </td>
            <td style="border-collapse: collapse;width:40%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                E-MAIL<br>{{$aluno_email}}</td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;width:50%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                ENDEREÇO RESIDENCIAL<br>{{$aluno_endereco_rua}} {{$aluno_endereco_numero}} {{$aluno_endereco_complemento}}
            </td>
            <td style="border-collapse: collapse;width:30%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                BAIRRO<br>{{$aluno_endereco_bairro}}</td>
            <td style="border-collapse: collapse;width:20%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                CEP<br>{{$aluno_endereco_cep}}</td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;width:10%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                GERAÇÃO<br>{{$aluno_ordem_geracao}}
            </td>
            <td style="border-collapse: collapse;width:45%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                CONHECIMENTO DE JAPONÊS</td>
            <td style="border-collapse: collapse;width:50%; height:40px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                NOME DO COLÉGIO E ANO EM QUE ESTUDARÁ</td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr style="border-collapse: collapse;background-color: LightGray;">
            <td style="border-collapse: collapse;text-align: center;  vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                FREQUENCIA DE AULA A OPTAR</td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;text-align: center; width:20%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                MANHÃ <br>
                08:15 ~ 10:00</td>
            <td style="border-collapse: collapse;text-align: center; width:80%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                2ª, 4ª, 6ª
                <br> ( )</td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;text-align: center; width:20%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                TARDE <br>
                14:00 ~ 15:45</td>
            <td style="border-collapse: collapse;text-align: center; width:40%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                2ª, 4ª, 6ª
                <br> ( )</td>
            </td>
            <td style="border-collapse: collapse;text-align: center; width:40%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                3ª, 5ª, 6ª
                <br> ( )</td>
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%; background-color: LightGray;">
        <tr>
            <td style="border-collapse: collapse; vertical-align:top;font-family:arial; font-size:12px;border: 1px solid black;">
                DADOS DO PAI </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;width:40%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                NOME<br>{{$nome_pai}}</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                NACIONALIDADE<br>{{$nacionalidade_pai}}
            </td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                RELIGIÃO<br>{{$religiao_pai}}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;width:40%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                E-MAIL<br>{{$email_pai}}</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                ESTADO CIVIL
            </td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                CELULAR<br>{{$celular_pai}}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;width:40%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                PROFISSÃO</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                EMPRESA<br>{{$empresa_pai}}
            </td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                TEL.COM.<br>{{$telefone_comercial_pai}}
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;background-color: LightGray;">
        <tr>
            <td style="border-collapse: collapse; vertical-align:top;font-family:arial; font-size:12px;border: 1px solid black;">
                DADOS DA MÃE</td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;width:40%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                NOME<br>{{$nome_mae}}</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                NACIONALIDADE<br>{{$nacionalidade_mae}}
            </td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                RELIGIÃO<br>{{$religiao_mae}}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;width:40%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                E-MAIL<br>{{$email_mae}}</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                ESTADO CIVIL
            </td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                CELULAR<br>{{$celular_mae}}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;width:40%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                PROFISSÃO</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                EMPRESA<br>{{$empresa_mae}}
            </td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                TEL.COM.<br>{{$telefone_comercial_mae}}
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr style="border-collapse: collapse;background-color: LightGray;">
            <td style="border-collapse: collapse;width:50%; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                OUTROS MORADORES</td>
            <td style="border-collapse: collapse;width:30%; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                VÍNCULO
            </td>
            <td style="border-collapse: collapse;width:10%; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                SEXO
            </td>
            <td style="border-collapse: collapse;width:10%; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                IDADE
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;width:50%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                1<br>{{$morador1_nome}}</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                <br>{{$morador1_vinculo}}</td>
            <td style="border-collapse: collapse;width:10%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                <br>{{$morador1_sexo}}</td>
            <td style="border-collapse: collapse;width:10%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;width:50%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                2<br>{{$morador2_nome}}</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                <br>{{$morador2_vinculo}}</td>
            <td style="border-collapse: collapse;width:10%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                <br>{{$morador2_sexo}}</td>
            <td style="border-collapse: collapse;width:10%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;width:50%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                3<br>{{$morador3_nome}}</td>
            <td style="border-collapse: collapse;width:30%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                <br>{{$morador3_vinculo}}</td>
            <td style="border-collapse: collapse;width:10%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                <br>{{$morador3_sexo}}</td>
            <td style="border-collapse: collapse;width:10%; height:40px; vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;width:100%;">
        <tr>
            <td style="border-collapse: collapse;width:80%;height:50px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                ASSINATURA DO RESPONSÁVEL </td>
            <td style="border-collapse: collapse;width:20%;height:50px;vertical-align:top;font-family:arial;border: 1px solid black; font-size:12px;">
                DATA
            </td>
        </tr>
    </table>


</body>

</html>