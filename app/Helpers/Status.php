<?php 

namespace App\Helpers;
class Status {

    public function statusUser($id)
    {
        $data[0] = 'Tidak Aktif';
        $data[1] = 'Masa Trial';
        $data[2] = 'Berlangganan';
        $data[3] = 'Member Platinum';

        return $data[$id] ?? $id;
    }

    public function statusRole($id)
    {
        $data[1] = 'Admin Root';
        $data[2] = 'User';
        $data[3] = 'Cashier';

        return $data[$id] ?? $id;
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