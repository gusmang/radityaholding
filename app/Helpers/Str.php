<?php

namespace App\Helpers;

use App\Models\UnitUsaha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Str
{
	public function rupiah($rupiah)
	{
		return number_format($rupiah, 0, ",", ".");
	}

	public function getUserLog()
	{
		return Session::get("userLog");
	}

	public function getRomawi()
	{
		$bln = date("m");

		$arrayMonth = array("I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
		return $arrayMonth[$bln - 1];
	}

	public function getUnitUsaha()
	{
		$userPos = Auth::user()->id_positions;

		$unitUsaha = UnitUsaha::where("id", $userPos)->first();

		return trim(str_replace(" ", "", $unitUsaha->name));
	}

	public function categoryOutlet()
	{

		$categorys = Cache::remember('setting-outlet', 90000, function () {
			$setting = DB::table('settings')->where('key', 'outlet')->select('value')->first();
			return json_decode($setting->value, true);
		});

		return $categorys['categorys'];
	}

	public function isFnb($category = null)
	{
		$categorys = Cache::remember('setting-outlet', 90000, function () {
			$setting = DB::table('settings')->where('key', 'outlet')->select('value')->first();
			return json_decode($setting->value, true);
		});

		$fnb = $categorys['fnb'];

		return in_array($category, $fnb);
	}

	public function hp($nohp, $type = null)
	{
		// kadang ada penulisan no hp 0811 239 345
		$nohp = str_replace(" ", "", $nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace("(", "", $nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace(")", "", $nohp);
		// kadang ada penulisan no hp 0811.239.345
		$nohp = str_replace(".", "", $nohp);
		$nohp = str_replace("-", "", $nohp);

		// cek apakah no hp mengandung karakter + dan 0-9
		if (!preg_match('/[^+0-9]/', trim($nohp))) {
			$hp['code'] = '00';
			// cek apakah no hp karakter 1-3 adalah +62
			if (substr(trim($nohp), 0, 3) == '+62') {
				$hp['hp'] = trim($nohp);
			} elseif (substr(trim($nohp), 0, 2) == '62') {
				$hp['hp'] = '+' . trim($nohp);
			}
			// cek apakah no hp karakter 1 adalah 0
			elseif (substr(trim($nohp), 0, 1) == '0') {
				$hp['hp'] = '+62' . substr(trim($nohp), 1);
			} elseif (substr(trim($nohp), 0, 1) == '8') {
				$hp['hp'] = '+62' . trim($nohp);
			} else {
				$hp['hp'] = '';
				$hp['code'] = '06';
			}
		}
		if ($hp['code'] == '00') {
			$hp['hp'] = $hp['hp'];
			$hp['hp62'] = substr(trim($hp['hp']), 1);
			$hp['hp0'] = '0' . substr(trim($hp['hp']), 3);
		}

		return $hp;
	}

	public function sensor($text, $num)
	{
		$count = strlen($text) - 4;
		$output = substr_replace($text, str_repeat('*', $count), $num, $count);
		return $output;
	}

	public function getOperator($num)
	{
		$hp = $this->hp($num);
		if (!isset($hp['hp0'])) {
			return false;
		}
		$hp0 = $hp['hp0'];
		$get4 = substr($hp0, 0, 4);

		if (in_array($get4, ['0852', '0853', '0811', '0812', '0813', '0821', '0822', '0851'])) {
			return ['operator' => 'Telkomsel', 'code_agenmu' => 'telkomsel'];
		} elseif (in_array($get4, ['0857', '0856'])) {
			return ['operator' => 'Indosat', 'code_agenmu' => 'indosat'];
		} elseif (in_array($get4, ['0896', '0895', '0897', '0898', '0899'])) {
			return ['operator' => 'Three', 'code_agenmu' => 'three'];
		} elseif (in_array($get4, ['0817', '0818', '0819', '0859', '0877', '0878'])) {
			return ['operator' => 'XL', 'code_agenmu' => 'xl'];
		} elseif (in_array($get4, ['0813', '0832', '0833', '0838'])) {
			return ['operator' => 'Axis', 'code_agenmu' => 'axis'];
		} elseif (in_array($get4, ['0881', '0882', '0883', '0884', '0885', '0886', '0887', '0888', '0889'])) {
			return ['operator' => 'Smartfren', 'code_agenmu' => 'smartfren'];
		} else {
			return ['operator' => '', 'code_agenmu' => ''];
		}
	}
}
