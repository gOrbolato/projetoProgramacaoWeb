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
 * Class Aluno
 * 
 * @property int $id
 * @property string $name
 * @property int $idade
 * @property string $cpf
 * @property string $telefone
 * @property Carbon $ano_letivo
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Turma[] $turmas
 * @property Collection|FormRespAvaliaco[] $form_resp_avaliacos
 *
 * @package App\Models
 */
class Aluno extends Model
{
	use SoftDeletes;
	protected $table = 'alunos';

	protected $casts = [
		'idade' => 'int',
		'ano_letivo' => 'datetime'
	];

	protected $fillable = [
		'nome',
		'idade',
		'cpf',
		'telefone',
		'ano_letivo'
	];

	public function turmas()
	{
		return $this->hasMany(Turma::class, 'id_aluno');
	}

	public function form_resp_avaliacos()
	{
		return $this->hasMany(FormRespAvaliaco::class, 'id_aluno');
	}
}
