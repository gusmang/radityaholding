<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Email
{

    public function sendEmailVerifikasi($email, $name)
    {
        $setting = app('App\Helpers\Setting')->get('email');

        Cache::remember('emailVerifikasi' . $email, $setting->cache_ttl_send_email_register ?? 600, function () use ($email, $name) {
            $url =  route('user.register.verifikasi.confirm', ['token' => Crypt::encryptString(implode(",", ['email' => $email, 'expired' => date("Y-m-d H:i:s", strtotime("+ 10 minute"))]))]);
            $logo = url('/') == env("BALICASH_BASE_URL")  ? 'img/balicashAgent.png' : 'themes/2022/uploads/logo-yespos-200px.png';

            if (url('/') == env("BALICASH_BASE_URL")) {
                $from = env('BALICASH_SUPPORT', 'support@balicash.money');
                $title = "Balicash Agent";
            } else {
                $from = 'no-reply@yespos.id';
                $title = "YesPOS";
            }

            Mail::send(
                'email.verifikasi_email2',
                compact('name', 'url', 'logo', 'title'),
                function ($mail) use ($email, $name, $from, $title) {
                    $mail->from($from, $title);
                    $mail->to($email, $name);
                    $mail->subject('Verifikasi Email ' . $title);
                }
            );
        });
    }

    public function sendResetPasssword($userId, $name, $email)
    {
        if (in_array(url('/'), [env("BALICASH_BASE_URL"), env("YESPOS_URL"), env("APP_URL")])) {
            $token = bin2hex(random_bytes(16));
            Log::info('sendResetPasssword', ['userId' => $userId, 'name' => $name, 'email' => $email]);

            $resetToken = DB::table('reset_pwds')->where('user_id', $userId)->first();
            if ($resetToken != null) {
                DB::table('reset_pwds')->where('user_id', $userId)->update(['token' => $token]);
            } else {
                DB::table('reset_pwds')->insert(['user_id' => $userId, 'token' => $token]);
            }

            $logo = url('/') == env("BALICASH_BASE_URL")  ? 'img/balicashAgent.png' : 'themes/2022/uploads/logo-yespos-200px.png';

            if (url('/') == env("BALICASH_BASE_URL")) {
                $from = env('BALICASH_SUPPORT', 'support@balicash.money');
                $title = "Balicash Agent";
            } else {
                $from = 'no-reply@yespos.id';
                $title = "YesPOS";
            }

            $url = url('dashboard/reset-password/' . $token);

            Mail::send(
                'email.reset_password',
                compact('url', 'name', 'email', 'logo', 'title'),
                function ($mail) use ($name, $email, $from, $title) {
                    $mail->from($from, $title);
                    $mail->to($email, $name);
                    $mail->subject('Permintaan Reset Password');
                }
            );
        }
        return true;
    }

    public function sendEmailTransaksi($id_transaksi, $email)
    {
        $transaksi = DB::table('transaksis')->where('id', $id_transaksi)->first();
        $payment = DB::table('payments')->where('transaksi_id', $id_transaksi)
            ->join('payment_methods', 'payment_methods.id', '=', 'payments.paymethod_id')
            ->select('payment_methods.pay_method_name', 'total_dibayar', 'total_kembali')
            ->first();

        $transaksiDetails = DB::table('transaksi_dtls')->where('transaksi_id', $id_transaksi)->get();

        $user = DB::table('users')->where('id', $transaksi->user_id)->select('name')->first();
        $branch = DB::table('store_branches')->where('id', $transaksi->branch_id)->select('nama_branch', 'alamat_branch')->first();

        $voucher = DB::table('voucher_claims')->where(['transaction_id' => $id_transaksi])
            ->join('vouchers', 'vouchers.id', 'voucher_id')
            ->select('vouchers.code', 'voucher_claims.claim_price')
            ->first();

        $name = $transaksi->nama_pembeli;
        Mail::send(
            'email.transaksi_detail',
            compact('transaksi', 'payment', 'transaksiDetails', 'user', 'branch', 'voucher'),
            function ($mail) use ($email, $name) {
                $mail->from('no-reply@yespos.id', 'YesPOS');
                $mail->to($email, $name);
                $mail->subject('Transaksi BILL');
            }
        );
    }

    public function sendPromo($id, $email, $name, $keterangan)
    {
        $kategoriPromo = Cache::remember('sharePromo' . $id, 300, function () use ($id) {
            return DB::table('kategori_promos')->where('kategori_promos.id', $id)
                ->leftJoin('store_branches', 'store_branches.id', '=', 'kategori_promos.branch_id')
                ->select('kategori_promos.*', 'store_branches.nama_branch', 'store_branches.alamat_branch')
                ->first();
        });

        $productOutlets = Cache::remember('sharePromoProduct' . $id, 300, function () use ($id) {
            $productArray = DB::table('promo_products')->where(['kategori_promo_id' => $id])
                ->select('product_id')
                ->pluck('product_id')->toArray();

            return DB::table('products')->whereIn('id', $productArray)
                ->select('id', 'nama_produk', 'image', 'harga')
                ->get();
        });

        $title = $kategoriPromo->name;

        Mail::send(
            'email.promo',
            compact('kategoriPromo', 'keterangan', 'productOutlets'),
            function ($mail) use ($email, $name, $title) {
                $mail->from('no-reply@yespos.id', 'YesPOS');
                $mail->to($email, $name);
                $mail->subject('Promo ' . $title);
            }
        );
    }
}
