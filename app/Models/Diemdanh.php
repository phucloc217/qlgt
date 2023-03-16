<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Diemdanh
 * 
 * @property int $id
 * @property string $tendiemdanh
 * @property int $trangthai
 * 
 * @property Collection|Thanhvien[] $thanhviens
 *
 * @package App\Models
 */
class Diemdanh extends Model
{
	protected $table = 'diemdanh';
	public $timestamps = false;

	protected $casts = [
		'trangthai' => 'int'
	];

	protected $fillable = [
		'tendiemdanh',
		'trangthai'
	];

	public function thanhviens()
	{
		return $this->belongsToMany(Thanhvien::class, 'thanhvien_diemdanh', 'madiemdanh', 'mathanhvien')
					->withPivot('id', 'nguoidiemdanh')
					->withTimestamps();
	}
}
