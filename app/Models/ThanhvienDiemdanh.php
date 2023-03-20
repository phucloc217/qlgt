<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ThanhvienDiemdanh
 * 
 * @property int $id
 * @property int $mathanhvien
 * @property int $madiemdanh
 * @property int|null $nguoidiemdanh
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Thanhvien $thanhvien
 * @property Diemdanh $diemdanh
 * @property User|null $user
 *
 * @package App\Models
 */
class ThanhvienDiemdanh extends Model
{
	protected $table = 'thanhvien_diemdanh';
	public $incrementing = true;
	protected $casts = [
		'mathanhvien' => 'int',
		'madiemdanh' => 'int',
		'nguoidiemdanh' => 'int'
	];

	protected $fillable = [
		'mathanhvien',
		'madiemdanh',
		'nguoidiemdanh'
	];

	public function thanhvien()
	{
		return $this->belongsTo(Thanhvien::class, 'mathanhvien');
	}

	public function diemdanh()
	{
		return $this->belongsTo(Diemdanh::class, 'madiemdanh');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'nguoidiemdanh');
	}
}
