<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Thanhvien
 * 
 * @property int $ma
 * @property string $tenthanh
 * @property string $hoten
 * @property Carbon $ngaysinh
 * @property string|null $hotencha
 * @property string|null $hotenme
 * @property string|null $diachi
 * @property string|null $ghichu
 * @property string|null $sdt
 * @property int $giaoho
 * @property bool $giaoly
 * @property string $matkhau
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $trangthai
 * 
 *
 * @package App\Models
 */
class Thanhvien extends Model
{
	protected $table = 'thanhvien';
	protected $primaryKey = 'ma';

	protected $casts = [
		'giaoho' => 'int',
		'giaoly' => 'bool',
		'trangthai' => 'int'
	];

	protected $dates = [
		'ngaysinh'
	];
	protected $hidden = ['matkhau'];
	protected $fillable = [
		'tenthanh',
		'hoten',
		'ngaysinh',
		'hotencha',
		'hotenme',
		'diachi',
		'ghichu',
		'sdt',
		'giaoho',
		'giaoly',
		'matkhau',
		'trangthai'
	];

	public function giaoho()
	{
		return $this->belongsTo(Giaoho::class, 'giaoho');
	}
}
