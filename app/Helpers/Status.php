<?php

namespace App\Helpers;

class Status
{

    public function statusUser($id)
    {
        $data[0] = 'Tidak Aktif';
        $data[1] = 'Masa Trial';
        $data[2] = 'Berlangganan';
        $data[3] = 'Member Platinum';

        return $data[$id] ?? $id;
    }

    public function clean_width($value)
    {
        $clean_html = preg_replace_callback(
            '/<(table|td)([^>]*)>/i',
            function ($matches) {
                $tag = $matches[1];
                $attributes = $matches[2];

                // Remove width attribute
                $attributes = preg_replace('/\s+width\s*=\s*["\'][^"\']*["\']/i', '', $attributes);
                $attributes = preg_replace('/\s+width\s*=\s*[^\s>]+/i', '', $attributes);

                // Remove width from style
                $attributes = preg_replace_callback(
                    '/style\s*=\s*["\']([^"\']*)["\']/i',
                    function ($style_matches) {
                        $style = preg_replace('/width\s*:\s*[^;]+;?/i', '', $style_matches[1]);
                        $style = preg_replace('/;\s*$/', '', $style);
                        return 'style="' . $style . '"';
                    },
                    $attributes
                );

                return '<' . $tag . $attributes . '>';
            },
            $value
        );

        return $clean_html;
    }

    public function isSekretariat($name)
    {
        return strtolower($name) === "admin sekretariat";
    }

    public function getUnitType()
    {
        $unit = array("Unit Bisnis 1", "Unit Bisnis 2", "Unit Bisnis 3", "Unit Holding", "Unit Bisnis Lain");

        return $unit;
    }

    function terbilang($angka)
    {
        $angka = floatval($angka);
        $satuan = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
        $belasan = [
            'sepuluh',
            'sebelas',
            'dua belas',
            'tiga belas',
            'empat belas',
            'lima belas',
            'enam belas',
            'tujuh belas',
            'delapan belas',
            'sembilan belas'
        ];

        if ($angka < 10) {
            return $satuan[$angka];
        } elseif ($angka >= 10 && $angka < 20) {
            return $belasan[$angka - 10];
        } elseif ($angka >= 20 && $angka < 100) {
            $puluh = floor($angka / 10);
            $sat = $angka % 10;
            return ($puluh == 1 ? 'se' : $satuan[$puluh] . ' ') . 'puluh' . ($sat != 0 ? ' ' . $satuan[$sat] : '');
        } elseif ($angka >= 100 && $angka < 1000) {
            $ratus = floor($angka / 100);
            $sisa = $angka % 100;
            return ($ratus == 1 ? 'seratus' : $satuan[$ratus] . ' ratus') . ($sisa != 0 ? ' ' . $this->terbilang($sisa) : '');
        } elseif ($angka >= 1000 && $angka < 1000000) {
            $ribu = floor($angka / 1000);
            $sisa = $angka % 1000;
            return (($ribu == 1 ? 'seribu' : $this->terbilang($ribu) . ' ribu') . ($sisa != 0 ? ' ' . $this->terbilang($sisa) : ''));
        } elseif ($angka >= 1000000 && $angka < 1000000000) {
            $juta = floor($angka / 1000000);
            $sisa = $angka % 1000000;
            return $this->terbilang($juta) . ' juta' . ($sisa != 0 ? ' ' . $this->terbilang($sisa) : '');
        } else {
            return 'Angka terlalu besar';
        }
    }


    public function tipe_surat_pengadaan($index)
    {
        $tipe = ["Pengadaan Aset", "Lainnya", "Penghapusan Aset", "Maintenance"];

        return $tipe[$index];
    }

    public function is_holding($pos)
    {
        if ($pos === 0 || $pos === -1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function statusRole($id)
    {
        $data[1] = 'Admin Root';
        $data[2] = 'User';
        $data[3] = 'Cashier';

        return $data[$id] ?? $id;
    }

    public function getAllStatus()
    {
        $data = array("Urgent", "On Approve", "Pending", "Finished", "Rejected");

        return $data;
    }

    public function statusTransaksi($status)
    {
        switch ($status) {
            case -2:
                return 'Unconfirmed';
                break;
            case -1:
                return 'Batal';
                break;
            case 0:
                return 'Pending';
                break;
            case 1:
                return 'Sukses';
                break;
            default:
                return 'No Type';
                break;
        }
    }
}
