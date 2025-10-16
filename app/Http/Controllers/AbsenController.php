<?php

namespace App\Http\Controllers;

use App\Models\MatkulKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\SimpleType\TblWidth;

class AbsenController extends Controller
{
    public function index()
    {
        $matkulKelass = MatkulKelas::with(['matkul', 'kelas', 'dosen', 'asisten'])->get();

        return view('absen.index', compact('matkulKelass'));
    }

    public function cetak(Request $request)
    {
        $validated = $request->validate([
            'matkul_kelas_id' => 'required|exists:matkul_kelass,id',
            'bulan' => 'required|date_format:Y-m',
        ]);

        $matkulKelas = MatkulKelas::with(['matkul', 'kelas', 'dosen', 'asisten', 'asisten2'])
            ->findOrFail($validated['matkul_kelas_id']);
        $bulan = Carbon::parse($validated['bulan']);

        $mapHari = [
            'Senin' => Carbon::MONDAY,
            'Selasa' => Carbon::TUESDAY,
            'Rabu' => Carbon::WEDNESDAY,
            'Kamis' => Carbon::THURSDAY,
            'Jumat' => Carbon::FRIDAY,
            'Sabtu' => Carbon::SATURDAY,
            'Minggu' => Carbon::SUNDAY,
        ];

        $targetHari = $mapHari[$matkulKelas->hari] ?? Carbon::MONDAY;

        $tanggalPertama = $bulan->copy()->startOfMonth();
        $tanggalAkhir = $bulan->copy()->endOfMonth();

        $tanggalKuliah = [];
        $tanggal = $tanggalPertama->copy();
        while ($tanggal->lte($tanggalAkhir)) {
            if ($tanggal->dayOfWeek === $targetHari) {
                $tanggalKuliah[] = $tanggal->copy();
            }
            $tanggal->addDay();
        }

        // 🔹 MULAI BUAT FILE WORD
        $phpWord = new PhpWord;
        $section = $phpWord->addSection([
            'orientation' => 'landscape',
            'marginTop' => 800,
            'marginLeft' => 1000,
            'marginRight' => 1000,
        ]);

        // Judul
        $section->addText('DAFTAR HADIR DOSEN DAN ASISTEN LABORATORIUM KOMPUTER', ['bold' => true, 'size' => 14], ['align' => 'center']);
        $section->addText('STMIK INDONESIA BANJARMASIN', ['bold' => true, 'size' => 12], ['align' => 'center']);
        $section->addText(strtoupper($bulan->translatedFormat('F Y')), ['bold' => true, 'size' => 12], ['align' => 'center']);
        $section->addTextBreak(1);

        // Informasi Mata Kuliah
        $noBorderCell = ['borderSize' => 0, 'borderColor' => 'FFFFFF'];

        $tableInfo = $section->addTable([
            'borderSize' => 0,
            'borderColor' => 'FFFFFF',
            'cellMargin' => 40,
            'indent' => new \PhpOffice\PhpWord\ComplexType\TblWidth(700, \PhpOffice\PhpWord\SimpleType\TblWidth::TWIP), 
        ]);

        $tableInfo->addRow();
        $tableInfo->addCell(4000, $noBorderCell)->addText("{$matkulKelas->lab}");
       

        $tableInfo->addRow();
        $tableInfo->addCell(2500, $noBorderCell)->addText('Dosen');
        $tableInfo->addCell(5000, $noBorderCell)->addText(": {$matkulKelas->dosen->nama_dosen}");
        $tableInfo->addCell(2500, $noBorderCell)->addText('Mata Kuliah');
        $tableInfo->addCell(4000, $noBorderCell)->addText(": {$matkulKelas->matkul->nama_matkul}");
        
        $tableInfo->addRow();
        $tableInfo->addCell(2500, $noBorderCell)->addText('Hari / Jam');
        $tableInfo->addCell(5000, $noBorderCell)->addText(": {$matkulKelas->hari} / {$matkulKelas->jam}");
        $tableInfo->addCell(2500, $noBorderCell)->addText('Kelas');
        $tableInfo->addCell(5000, $noBorderCell)->addText(": {$matkulKelas->kelas->nama_kelas}");
        
        // Gaya tabel
        $styleTable = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 50,
            'alignment' => JcTable::CENTER,
        ];
        $styleCell = ['valign' => 'center'];

        $phpWord->addTableStyle('TabelAbsen', $styleTable);
        $table = $section->addTable('TabelAbsen');

        // Lebar total tabel = 24 cm = 13608 twips
        $totalWidth = 13608;

        // Tentukan proporsi kolom
        $colNama = 2500;       // Nama
        $colKeterangan = 1800; // Keterangan
        $colWajib = 1000;      // Wajib
        $colHadir = 1000;      // Hadir

        // Sisa lebar untuk kolom tanggal
        $colTanggal = ($totalWidth - ($colNama + $colKeterangan + $colWajib + $colHadir)) / count($tanggalKuliah);

        // Header tabel
        $table->addRow();
        $table->addCell($colNama, ['width' => $colNama, 'unit' => TblWidth::TWIP] + $styleCell)
            ->addText('Nama', ['bold' => true], ['align' => 'center']);

        foreach ($tanggalKuliah as $tgl) {
            $table->addCell($colTanggal, ['width' => $colTanggal, 'unit' => TblWidth::TWIP] + $styleCell)
                ->addText($tgl->translatedFormat('j-M'), null, ['align' => 'center']);
        }

        $table->addCell($colKeterangan, ['width' => $colKeterangan, 'unit' => TblWidth::TWIP] + $styleCell)
            ->addText('Keterangan', ['bold' => true], ['align' => 'center']);
        $table->addCell($colWajib, ['width' => $colWajib, 'unit' => TblWidth::TWIP] + $styleCell)
            ->addText('Wajib', ['bold' => true], ['align' => 'center']);
        $table->addCell($colHadir, ['width' => $colHadir, 'unit' => TblWidth::TWIP] + $styleCell)
            ->addText('Hadir', ['bold' => true], ['align' => 'center']);

        // Baris Dosen & Asisten
        $rows = [
            ['Dosen : ', $matkulKelas->dosen->nama_dosen],
            ['Asisten 1 : ', $matkulKelas->asisten->nama_asisten],
            ['Asisten 2 : ', $matkulKelas->asisten2->nama_asisten ?? '-'],
        ];

        foreach ($rows as $r) {
            $table->addRow();

            // Kolom nama
            $table->addCell($colNama, ['width' => $colNama, 'unit' => TblWidth::TWIP] + $styleCell)
                ->addText($r[0]."\n".$r[1], null, ['align' => 'center']);

            // Kolom tanggal
            foreach ($tanggalKuliah as $tgl) {
                $table->addCell($colTanggal, ['width' => $colTanggal, 'unit' => TblWidth::TWIP] + $styleCell)
                    ->addText('');
            }

            // Kolom tambahan
            $table->addCell($colKeterangan, ['width' => $colKeterangan, 'unit' => TblWidth::TWIP] + $styleCell)
                ->addText('');
            $table->addCell($colWajib, ['width' => $colWajib, 'unit' => TblWidth::TWIP] + $styleCell)
                ->addText(count($tanggalKuliah), null, ['align' => 'center']);
            $table->addCell($colHadir, ['width' => $colHadir, 'unit' => TblWidth::TWIP] + $styleCell)
                ->addText('', null, ['align' => 'center']);
        }

        // Spasi sebelum tanda tangan
// Tambahkan jarak sebelum tanda tangan
$section->addTextBreak(2);

// Buat tabel tanda tangan tanpa border apa pun
$tableSign = $section->addTable([
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT,
    'borderSize' => 0,
    'borderColor' => 'FFFFFF',
    'cellMargin' => 0,
    'insideHBorder' => ['sz' => 0, 'color' => 'FFFFFF'],
    'insideVBorder' => ['sz' => 0, 'color' => 'FFFFFF'],
]);

// Tambahkan baris dan sel tanpa border
$tableSign->addRow();
$cell = $tableSign->addCell(4000, [
    'borderTopSize' => 0,
    'borderLeftSize' => 0,
    'borderRightSize' => 0,
    'borderBottomSize' => 0,
    'borderTopColor' => 'FFFFFF',
    'borderLeftColor' => 'FFFFFF',
    'borderRightColor' => 'FFFFFF',
    'borderBottomColor' => 'FFFFFF',
    'valign' => 'top',
]);

// Isi teks tanda tangan
$cell->addText('Kepala '.$matkulKelas->lab, null, ['alignment' => Jc::LEFT]);

$cell->addTextBreak(2); // spasi tanda tangan

$cell->addText('Herman Rizani, S.Kom.', ['bold' => true], ['alignment' => Jc::LEFT]);
$cell->addText('NIK 01.1109.044', null, ['alignment' => Jc::LEFT]);




        // Simpan file sementara dan kirim ke browser
        $fileName = 'absensi_'.str_replace(' ', '_', $matkulKelas->matkul->nama_matkul).'_'.$bulan->translatedFormat('F_Y').'.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'absensi_');
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
