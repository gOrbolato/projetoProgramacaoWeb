<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pergunta
 * 
 * @property int $id
 * @property string $nome_pergunta
 * @property string $tipo_pergunta
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|FormAvaliaco[] $form_avaliacos
 *
 * @package App\Models
 */
class Pergunta extends Model
{
	use SoftDeletes;
	protected $table = 'perguntas';

	protected $fillable = [
		'nome_pergunta',
		'tipo_pergunta'
	];

	public function form_avaliacos()
	{
		return $this->hasMany(FormAvaliaco::class, 'id_pergunta');
	}
}
