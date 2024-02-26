<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Surat Peringatan</title>

    <style></style>
</head>

<body>
    <div class="text-center">
        <h2>SURAT PERINGATAN {{ $peringatan->level }}</h2>
        <h4>Nomor : {{ $peringatan->id }} / {{ $peringatan->tgl_terbit }} / {{ $year }}</h4>
    </div>

    <div>
        <p>Surat peringatan ini ditujukan kepada :</p>

        <table>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $peringatan->employee->fullname }}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{ $peringatan->employee->nip }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $peringatan->employee->position->name }} </td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td>:</td>
                    <td>{{ $peringatan->employee->departement->name }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $peringatan->employee->address }}</td>
                </tr>
               
            </tbody>
        </table>

    
    </div>

    <p>
        Surat Peringatan ini dikeluarkan berdasarkan bukti yang menjelaskan bahwa
        yang bersangkutan telah melakukan :
        <strong>“Tindakan Indisiplin, yaitu : Terlambat absensi masuk kerja selama 4
            (empat) hari berturut-turut.”</strong>
        Surat Teguran ini diterbitkan dengan tujuan agar yang bersangkutan dapat
        lebih menghargai peraturan kantor dan dapat kembali masuk kerja setiap
        hari sesuai peraturan yang sudah ditentukan.
    </p>
    <p>
        Demikian Surat Teguran ini dikeluarkan, untuk dijadikan bahan perhatian
        dan perbaikan disiplin kedepannya. Atas perhatian dan kerjasamanya, kami
        ucapkan terimakasih.</p>

    <div>
        <p>{{ $peringatan->employee->departement->branch }}, {{ $peringatan->tgl_terbit }} </p>
        <p>Divisi HR</p>
        &nbsp;&nbsp;&nbsp;&nbsp;

        <p>Manager HR</p>
    </div>

</body>

</html>
