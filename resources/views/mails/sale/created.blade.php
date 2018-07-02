<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Nuevo recado creado @ Rolve Inmobiliaria</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <style>
    .body__title {
      color: #0C457A;
      font-family: Baskerville-SemiBold, "Times New Roman", Helvetica, Arial;
      font-size: 28px;
      letter-spacing: 0;
      line-height: 1.2em;
      margin: 0 auto 46px;
      text-align: center;
    }
    .body__message {
      box-sizing: border-box;
      padding: 0 20px;
    }
    .body__message, .body__message a {
      color: #4A4A4A;
      font-family: Baskerville-SemiBold, "Times New Roman", Helvetica, Arial;
      font-size: 16px;
      letter-spacing: 0;
      line-height: 1.2em;
    }
    .footer__text {
      color: white;
      font-family: Baskerville-SemiBold, "Times New Roman", Helvetica, Arial;
      font-size: 16px;
      font-weight: 500;
      line-height: 1.2em;
      text-align: center;
    }
  </style>
</head>
<body style="background-color: #F2F2E9; display: flex; flex-flow: column nowrap; margin: 0; padding: 0;">
  <table border="0" cellspacing="0" cellpadding="0" height="228" style="margin: 0 auto;" width="100%">
    <thead border="0" cellspacing="0" cellpadding="0" height="228">
      <tr border="0" bgcolor="#0C457A" background="{{ asset('img/mailings/shared/background.jpg') }}" cellspacing="0" cellpadding="0" height="228">
        <th align="center" border="0" cellspacing="0" cellpadding="0" height="228" valign="center">
          <table border="0" cellspacing="0" cellpadding="0" height="228" style="margin: 0 auto;" width="600">
            <tr border="0" cellspacing="0" cellpadding="0" height="76">
              <td border="0" cellspacing="0" cellpadding="0"></td>
            </tr>
            <tr border="0" cellspacing="0" cellpadding="0" height="152" width="600">
              <td align="center" border="0" cellspacing="0" cellpadding="0" valign="middle" height="152">
                <img src="{{ asset('img/mailings/shared/logo.png') }}" alt="Rolve Inmobiliaria" width="152" height="152" style="margin: 0 auto; padding: 0;" align="center" valign="middle">
              </td>
            </tr>
          </table>
        </th>
      </tr>
    </thead>
    <tfoot align="left" border="0" cellspacing="0" cellpadding="0" class="footer">
      <tr align="left" border="0" bgcolor="#0C457A" cellspacing="0" cellpadding="0">
        <td align="center" border="0" cellspacing="0" cellpadding="0" valign="center">
          <table border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;" width="600">
            <tr border="0" cellspacing="0" cellpadding="0"height="99">
              <td border="0" cellspacing="0" cellpadding="0">
                <p class="footer__text">Rolve Inmobiliaria, S.A. de C.V., Ciudad de México, 2018</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </tfoot>
    <tbody border="0" cellspacing="0" cellpadding="0"class="body">
      <tr border="0" cellspacing="0" cellpadding="0">
        <td align="center" border="0" cellspacing="0" cellpadding="0" valign="center">
          <table border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;" width="600">
            <tr border="0" cellspacing="0" cellpadding="0">
              <td border="0" cellspacing="0" cellpadding="0">
                <p class="body__title">ROLVE</p>
              </td>
            </tr>
            <tr border="0" cellspacing="0" cellpadding="0">
              <td border="0" cellspacing="0" cellpadding="0">
                <p class="body__message">{{ $saleCreated->user->name }} atendió a <a href="mailto:{{ $saleCreated->internal_expedient->client->email }}" title="{{ $saleCreated->internal_expedient->client->full_name }}">{{ $saleCreated->internal_expedient->client->full_name }}</a> creando una nueva compraventa con:</p>
              </td>
            </tr>
            <tr border="0" cellspacing="0" cellpadding="0">
              <td border="0" cellspacing="0" cellpadding="0">
                <div class="row">
                  @if (optional($saleCreated)->seller->SD_complete === 'true')
                    <div class="alert alert-success" role="alert">Documentos <strong>completos</strong>.</div>
                  @else
                    <div class="alert alert-warning" role="alert">Documentos <strong>incompletos</strong>.</div>
                  @endif
                </div>
              </td>
            </tr>
            <tr border="0" cellspacing="0" cellpadding="0">
              <td border="0" cellspacing="0" cellpadding="0">
                <p class="body__message"><a href="{{ route('show_message', ['id' => $saleCreated->id ]) }}">Ver compraventa en el navegador.</a></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr border="0" cellspacing="0" cellpadding="0">
        <td border="0" cellspacing="0" cellpadding="0" height="270"></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
