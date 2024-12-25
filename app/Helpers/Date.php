<?php
namespace App\Helpers;
use Carbon\Carbon;

class Date {
    public function plusWeek()
    {
        $start_date = Date('Y/m/d');  
        $date = strtotime($start_date);
        $date = strtotime("+7 day", $date);
        return  date('Y/m/d', $date);
    }
    public function day($id)
    {
        $day = [1=> 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return $day[$id];
    }
    public function hari_tanggal($tanggal, $cetak_hari = true)
    {
        $tanggal = date('Y-m-d', strtotime($tanggal));
        $hari = array ( 1 => 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu' );
        $bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $split    = explode('-', $tanggal);

        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

    public function tanggal_waktu($datetime, $cetak_hari = false)
    {
        $bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $tanggal    = substr($datetime, '0','10');
        $split    = explode('-', $tanggal);
        // return $split[2]. ' '.$bulan[ (int)$split[1] ]. ' '. $split['0'] ;
        $waktu    = substr($datetime, '10');
        if (count($split)<= 1) {
            return "Belum Diset";
        }
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        // $tgl_indo = substr($tgl_indo, 9);

        return $tgl_indo. ' - '. $waktu;
    }

    public function tanggalIndo($datetime)
    {
        $bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $tanggal    = substr($datetime, '0','10');
        $split    = explode('-', $tanggal);
        // return $split[2]. ' '.$bulan[ (int)$split[1] ]. ' '. $split['0'] ;
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        // $tgl_indo = substr($tgl_indo, 9);

        return $tgl_indo;
    }
    public function hari_tanggal_waktu($datetime, $cetak_hari = false)
    {
        $hari = array ( 1 => 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu' );
        $bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $tanggal    = substr($datetime, '0','10');
        $split    = explode('-', $tanggal);
        // return $split[2]. ' '.$bulan[ (int)$split[1] ]. ' '. $split['0'] ;
        $waktu    = substr($datetime, '10');
        if (count($split)<= 1) {
            return NULL;
        }
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        // $tgl_indo = substr($tgl_indo, 9);

        if ($cetak_hari) {
            $num = date('N', strtotime($datetime));
            return $hari[$num] . ', ' . $tgl_indo. ' - '. $waktu;
        }
        return $tgl_indo;
    }
    public function diff($time)
    {
        $updated = new Carbon($time);
        $now = Carbon::now();
            if ($updated->diffInMinutes($now) < 1) {
                $lastOnline = "Baru Saja";
            } elseif ($updated->diff($now)->h < 1) {
                $lastOnline = $updated->diffInMinutes($now) > 1 ? sprintf("%d menit lalu", $updated->diffInMinutes($now)) : sprintf("%d menit lalu", $updated->diffInMinutes($now));
            } elseif ($updated->diff($now)->d < 1) {
                $lastOnline = $updated->diffInHours($now) > 1 ? sprintf("%d jam lalu", $updated->diffInHours($now)) : sprintf(" %d jam lalu", $updated->diffInHours($now));
            } elseif ($updated->diff($now)->d < 7) {
                $lastOnline = $updated->diffInDays($now) > 1 ? sprintf("%d hari lalu", $updated->diffInDays($now)) : sprintf(" %d hari lalu", $updated->diffInDays($now));
            } elseif ($updated->diff($now)->m < 1) {
                $lastOnline = $updated->diffInWeeks($now) > 1 ? sprintf("%d minggu lalu", $updated->diffInWeeks($now)) : sprintf(" %d minggu lalu", $updated->diffInWeeks($now));
            } elseif ($updated->diff($now)->y < 1) {
                $lastOnline = $updated->diffInMonths($now) > 1 ? sprintf("%d bulan lalu", $updated->diffInMonths($now)) : sprintf(" %d bulan lalu", $updated->diffInMonths($now));
            } else {
                $lastOnline = $updated->diffInYears($now) > 1 ? sprintf("%d tahun lalu", $updated->diffInYears($now)) : sprintf(" %d tahun lalu", $updated->diffInYears($now));
            }
            return $lastOnline;
    }

    public function diffMinute($time)
    {
        $updated = new Carbon($time);
        $now = Carbon::now();
        if ($updated->diffInMinutes($now) < 1) {
            $lastOnline = "Baru";
        } else  {
            $lastOnline = sprintf("%d", $updated->diffInMinutes($now));
        }
        return $lastOnline;
    }

    public function selisi($awal, $akhir = null, $key = null)
    {
        if ($akhir == null) {
            $akhir = date('Y-m-d H:i:s');
        }
        $awal = date_create($awal);
        $akhir = date_create($akhir);
        $diff  = date_diff($awal, $akhir);
        if ($key != null) {
        return $diff->$key;
        }
        return "$diff->h jam $diff->i Menit $diff->s Detik";
    }
    public function selisiJamMinute($awal, $akhir = null)
    {
        if ($akhir == null) {
            $akhir = date('Y-m-d H:i:s');
        }
        $awal = date_create($awal);
        $akhir = date_create($akhir);
        $diff  = date_diff($awal, $akhir);
        return "$diff->h jam $diff->i Menit";
    }

    public function selisihDay($waktu_sekarang)
    {
        $now  = strtotime($waktu_sekarang);
        $akhir  = time();
        $diff  = $now - $akhir;

        return floor($diff / (60 * 60 * 24)) ." Hari";
    }
    public function rangeTime($start, $end)
    {
        $start = substr($start, 0,5);
        $end = substr($end, 0,5);
        return $start.'-'.$end;
    }

    public function getMonth($month, $year = null)
    {
        $bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

        if ($year == null) {
            return $bulan[$month];
        }else {
            return $bulan[$month] . ' '. $year;
        }
    }
}

