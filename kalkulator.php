<?php
function hitung_gaji_bruto_setahun($gaji_bruto_perbulan) {
    return $gaji_bruto_perbulan * 12;
}

function hitung_biaya_jabatan_gaji_setahun($gaji_bruto_setahun) {
    return min(0.05 * $gaji_bruto_setahun, 6000000);
}

function hitung_gaji_netto_setahun($gaji_bruto_setahun, $biaya_jabatan_gaji_setahun) {
    return $gaji_bruto_setahun - $biaya_jabatan_gaji_setahun;
}

function hitung_jumlah_ptkp($status_ptkp, $jumlah_tanggungan) {
    if ($status_ptkp == 'TK') {
        return 54000000;
    } elseif ($status_ptkp == 'K') {
        return 58500000;
    } elseif ($status_ptkp == 'K/I') {
        return 63000000;
    } else {
        return 0;
    }
}

function hitung_jumlah_pkp_gaji_netto_setahun($gaji_netto_setahun, $jumlah_ptkp, $jumlah_tanggungan) {
    $pkp = $gaji_netto_setahun - $jumlah_ptkp - (4500000 * $jumlah_tanggungan);
    return max($pkp, 0);
}

function hitung_tarif_pph_gaji_setahun($jumlah_pkp_gaji_netto_setahun) {
    if ($jumlah_pkp_gaji_netto_setahun <= 50000000) {
        return 0.05;
    } elseif ($jumlah_pkp_gaji_netto_setahun <= 250000000) {
        return 0.15;
    } elseif ($jumlah_pkp_gaji_netto_setahun <= 500000000) {
        return 0.25;
    } else {
        return 0.3;
    }
}

function hitung_jumlah_pph_gaji_setahun($tarif_pph_gaji_setahun, $jumlah_pkp_gaji_netto_setahun) {
    return $tarif_pph_gaji_setahun * $jumlah_pkp_gaji_netto_setahun;
}

function hitung_penghasilan_bruto_setahun($gaji_bruto_setahun, $bruto_thr) {
    return $gaji_bruto_setahun + $bruto_thr;
}

function hitung_biaya_jabatan_penghasilan_bruto_setahun($penghasilan_bruto_setahun) {
    return min(0.05 * $penghasilan_bruto_setahun, 6000000);
}

function hitung_penghasilan_netto_setahun($penghasilan_bruto_setahun, $biaya_jabatan_penghasilan_bruto_setahun) {
    return $penghasilan_bruto_setahun - $biaya_jabatan_penghasilan_bruto_setahun;
}

function hitung_jumlah_pkp_penghasilan_netto_setahun($penghasilan_netto_setahun, $jumlah_ptkp, $jumlah_tanggungan) {
    $pkp = $penghasilan_netto_setahun - $jumlah_ptkp - (4500000 * $jumlah_tanggungan);
    return max($pkp, 0);
}

function hitung_tarif_pph_penghasilan_netto_setahun($jumlah_pkp_penghasilan_netto_setahun) {
    if ($jumlah_pkp_penghasilan_netto_setahun <= 50000000) {
        return 0.05;
    } elseif ($jumlah_pkp_penghasilan_netto_setahun <= 250000000) {
        return 0.15;
    } elseif ($jumlah_pkp_penghasilan_netto_setahun <= 500000000) {
        return 0.25;
    } else {
        return 0.3;
    }
}

function hitung_jumlah_pph_penghasilan_netto_setahun($tarif_pph_penghasilan_netto_setahun, $jumlah_pkp_penghasilan_netto_setahun) {
    return $tarif_pph_penghasilan_netto_setahun * $jumlah_pkp_penghasilan_netto_setahun;
}

function hitung_jumlah_pajak_thr($bruto_thr) {
    $pkp_thr = $bruto_thr - 0.5 * $bruto_thr;
    $tarif_pph_thr = hitung_tarif_pph_penghasilan_netto_setahun($pkp_thr);
    return $tarif_pph_thr * $pkp_thr;
}

function hitung_jumlah_netto_thr($bruto_thr, $pajak_thr) {
    return $bruto_thr - $pajak_thr;
}

echo "Masukkan gaji bruto perbulan: ";
$gaji_bruto_perbulan = trim(fgets(STDIN));

echo "Masukkan status PTKP (TK/K/K/I): ";
$status_ptkp = trim(fgets(STDIN));

echo "Masukkan jumlah tanggungan: ";
$jumlah_tanggungan = trim(fgets(STDIN));

echo "Masukkan jumlah bruto THR: ";
$bruto_thr = trim(fgets(STDIN));

$gaji_bruto_setahun = hitung_gaji_bruto_setahun($gaji_bruto_perbulan);
$biaya_jabatan_gaji_setahun = hitung_biaya_jabatan_gaji_setahun($gaji_bruto_setahun);
$gaji_netto_setahun = hitung_gaji_netto_setahun($gaji_bruto_setahun, $biaya_jabatan_gaji_setahun);
$jumlah_ptkp = hitung_jumlah_ptkp($status_ptkp, $jumlah_tanggungan);
$jumlah_pkp_gaji_netto_setahun = hitung_jumlah_pkp_gaji_netto_setahun($gaji_netto_setahun, $jumlah_ptkp, $jumlah_tanggungan);
$tarif_pph_gaji_setahun = hitung_tarif_pph_gaji_setahun($jumlah_pkp_gaji_netto_setahun);
$jumlah_pph_gaji_setahun = hitung_jumlah_pph_gaji_setahun($tarif_pph_gaji_setahun, $jumlah_pkp_gaji_netto_setahun);
$penghasilan_bruto_setahun = hitung_penghasilan_bruto_setahun($gaji_bruto_setahun, $bruto_thr);
$biaya_jabatan_penghasilan_bruto_setahun = hitung_biaya_jabatan_penghasilan_bruto_setahun($penghasilan_bruto_setahun);
$penghasilan_netto_setahun = hitung_penghasilan_netto_setahun($penghasilan_bruto_setahun, $biaya_jabatan_penghasilan_bruto_setahun);
$jumlah_pkp_penghasilan_netto_setahun = hitung_jumlah_pkp_penghasilan_netto_setahun($penghasilan_netto_setahun, $jumlah_ptkp, $jumlah_tanggungan);
$tarif_pph_penghasilan_netto_setahun = hitung_tarif_pph_penghasilan_netto_setahun($jumlah_pkp_penghasilan_netto_setahun);
$jumlah_pph_penghasilan_netto_setahun = hitung_jumlah_pph_penghasilan_netto_setahun($tarif_pph_penghasilan_netto_setahun, $jumlah_pkp_penghasilan_netto_setahun);
$jumlah_pph_thr = hitung_jumlah_pajak_thr($bruto_thr);
$jumlah_netto_thr = hitung_jumlah_netto_thr($bruto_thr, $jumlah_pph_thr);

echo "Gaji Bruto Setahun: " . $gaji_bruto_setahun . "\n";
echo "Biaya Jabatan Gaji Setahun: " . $biaya_jabatan_gaji_setahun . "\n";
echo "Gaji Netto Setahun: " . $gaji_netto_setahun . "\n";
echo "Jumlah PTKP: " . $jumlah_ptkp . "\n";
echo "Jumlah PKP Gaji Netto Setahun: " . $jumlah_pkp_gaji_netto_setahun . "\n";
echo "Tarif PPh Gaji Setahun: " . $tarif_pph_gaji_setahun . "\n";
echo "Jumlah PPh Gaji Setahun: " . $jumlah_pph_gaji_setahun . "\n";
echo "Penghasilan Bruto Setahun: " . $penghasilan_bruto_setahun . "\n";
echo "Biaya Jabatan Penghasilan Bruto Setahun: " . $biaya_jabatan_penghasilan_bruto_setahun . "\n";
echo "Penghasilan Netto Setahun: " . $penghasilan_netto_setahun . "\n";
echo "Jumlah PKP Penghasilan Netto Setahun: " . $jumlah_pkp_penghasilan_netto_setahun . "\n";
echo "Tarif PPh Penghasilan Netto Setahun: " . $tarif_pph_penghasilan_netto_setahun . "\n";
echo "Jumlah PPh Penghasilan Netto Setahun: " . $jumlah_pph_penghasilan_netto_setahun . "\n";
echo "Jumlah PPh THR: " . $jumlah_pph_thr . "\n";
echo "Jumlah Netto THR: " . $jumlah_netto_thr . "\n";
?>