<?php
require_once '../_config/config.php';

$title = 'Laporan Rekam Medis';

require_once '../vendor/autoload.php'; // pastikan path ini

use Dompdf\Dompdf;

// Inisialisasi Dompdf
$dompdf = new Dompdf();
$id = $_GET['id'];
$querySatwa = mysqli_query($con, "SELECT * FROM tb_satwa INNER JOIN tb_jenis ON tb_satwa.id_jenis = tb_jenis.id_jenis WHERE id_satwa = '$id'");
$satwa = mysqli_fetch_assoc($querySatwa);
$satwa['jenis_kelamin'] == 'L' ? $gender = 'Jantan' : $gender = 'Betina';


// Buat HTML untuk PDF
$content = '
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .head{
        text-align: center;
        margin-bottom: 40px;
        margin-top: -5px;
      }
      .label-head{
        width: 120px;
        padding-left: 1px;
        padding-bottom: 5px;
        text-align: left;
      }
      .data-left{
        width: 300px;
        padding-left: 1px;
        padding-bottom: 5px;
        text-align: left;
      }
      .data-right{
        width: 130px;
        padding-left: 1px;
        padding-bottom: 5px;
        text-align: left;
      }
      hr{
        margin-bottom: 2px;
        margin-left: -5px;
        width: 700px;
      }
      .table-head{
        text-align: left;
      }
      .data{
        vertical-align: top;
      }
    </style>
  </head>
  <body>
    <h2 class="head">Rekam Medis Satwa</h2>
    <table>
      <tr>
        <th class="label-head">Nama Satwa</th>
        <td class="data-left">: '. $satwa['nama_satwa'] .'</td>
        <th class="label-head">Jenis Kelamin</th>
        <td class="data-right">: '. $gender .'</td>
      </tr>
      <tr>
        <th class="label-head">Umur</th>
        <td class="data-left">: '. htgUmur($satwa['tgl_lahir']) .'</td>
        <th class="label-head">Kelas</th>
        <td class="data-right">: '. $satwa['kelas'] .'</td>
      </tr>
      <tr>
        <th class="label-head">Jenis</th>
        <td class="data-left">: '. $satwa['jenis'] .'</td>
        <th class="label-head">Generasi</th>
        <td class="data-left">: '. $satwa['generasi'] .'</td>
      </tr>
    </table>

    <table>
      <thead>
        <tr>
          <th colspan="5">
            <hr size="3">
          </th>
        </tr>
        <tr>
          <th class="table-head" style="width:90px;">Tanggal</th>
          <th class="table-head" style="width:180px;">Keluhan</th>
          <th class="table-head" style="width:120px;">Diagnosa</th>
          <th class="table-head" style="width:110px;">Obat</th>
          <th class="table-head" style="width:110px;">Tindakan</th>
          <th class="table-head" style="width:70px;">Dokter</th>
        </tr>
        <tr>
          <th colspan="5">
            <hr size="3">
          </th>
        </tr>
      </thead>
      <tbody>';

        $sqlRM = "SELECT * FROM tb_rekammedis INNER JOIN tb_user ON tb_rekammedis.id_user = tb_user.id_user WHERE id_satwa = '$id'";
        $queryRM = mysqli_query($con, $sqlRM);
        while($rm = mysqli_fetch_assoc($queryRM)){
          $content .=
          '<tr>
            <td class="data">' . tgl_indo($rm['tgl_periksa']) . '</td>
            <td class="data">' . $rm['keluhan'] . '</td>
            <td class="data">' . $rm['diagnosa'] . '</td>
            <td class="data">';
              
              $sql_obat = mysqli_query($con, "SELECT * FROM tb_rm_obat 
              JOIN tb_obat ON tb_rm_obat.id_obat = tb_obat.id_obat 
              WHERE tb_rm_obat.id_rm = '".$rm['id_rm']."'") or die(mysqli_error($con));
              while($data_obat = mysqli_fetch_array($sql_obat)){
                $content .= $data_obat['nama_obat'] . "<br>";
              }
              
            $content .=
            '</td>
            <td class="data">' . $rm['tindakan'] . '</td>
            <td class="data">' . $rm['nama_user'] . '</td>
          </tr>';
        }

        $content .=
      '</tbody>
      <tfoot>
        <tr>
          <th colspan="5">
            <hr size="3">
          </th>
        </tr>
      </tfoot>
    </table>
  </body>
  </html>
  
';





$dompdf->loadHtml($content);

// (Optional) Ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Render ke PDF
$dompdf->render();

// Tampilkan PDF di browser (inline)
$dompdf->stream('Laporan Rekam Medis.pdf', ['Attachment' => false]);
exit; // penting agar tidak ada output tambahan
?>
