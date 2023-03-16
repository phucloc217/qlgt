<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Thanhvien
 * 
 * @property int $ma
 * @property string|null $tenthanh
 * @property string $hoten
 * @property Carbon|null $ngaysinh
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
 * @property Collection|Diemdanh[] $diemdanhs
 *
 * @package App\Models
 */
class Thanhvien extends Model
{
	protected $table = 'thanhvien';
	protected $primaryKey = 'ma';
	public $incrementing = false;

	protected $casts = [
		'ma' => 'int',
		'giaoho' => 'int',
		'giaoly' => 'bool',
		'trangthai' => 'int'
	];

	protected $dates = [
		'ngaysinh'
	];

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

	public function diemdanhs()
	{
		return $this->belongsToMany(Diemdanh::class, 'thanhvien_diemdanh', 'mathanhvien', 'madiemdanh')
					->withPivot('id', 'nguoidiemdanh')
					->withTimestamps();
	}
}
