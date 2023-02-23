<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Giaoho
 * 
 * @property int $id
 * @property string $tengiaoho
 * 
 * @property Collection|Thanhvien[] $thanhviens
 *
 * @package App\Models
 */
class Giaoho extends Model
{
	protected $table = 'giaoho';
	public $timestamps = false;

	protected $fillable = [
		'tengiaoho'
	];

	public function thanhviens()
	{
		return $this->hasMany(Thanhvien::class, 'giaoho');
	}
}
