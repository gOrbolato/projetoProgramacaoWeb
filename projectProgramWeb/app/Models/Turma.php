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
 * Class Turma
 * 
 * @property int $id
 * @property string $nome_turma
 * @property int $id_aluno
 * @property int $id_professor
 * @property int $id_coordenador
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Aluno $aluno
 * @property Professore $professore
 * @property Coordenadore $coordenadore
 * @property Collection|FormAvaliaco[] $form_avaliacos
 *
 * @package App\Models
 */
class Turma extends Model
{
	use SoftDeletes;
	protected $table = 'turmas';

	protected $casts = [
		'id_aluno' => 'int',
		'id_professor' => 'int',
		'id_coordenador' => 'int'
	];

	protected $fillable = [
		'nome_turma',
		'id_aluno',
		'id_professor',
		'id_coordenador'
	];

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'id_aluno');
	}

	public function professore()
	{
		return $this->belongsTo(Professore::class, 'id_professor');
	}

	public function coordenadore()
	{
		return $this->belongsTo(Coordenadore::class, 'id_coordenador');
	}

	public function form_avaliacos()
	{
		return $this->hasMany(FormAvaliaco::class, 'id_turma');
	}
}
