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
 * Class Professore
 * 
 * @property int $id
 * @property string $nome
 * @property string $cpf
 * @property int $idade
 * @property string $telefone
 * @property int $coordenador_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Coordenadore $coordenadore
 * @property Collection|Turma[] $turmas
 *
 * @package App\Models
 */
class Professore extends Model
{
	use SoftDeletes;
	protected $table = 'professores';

	protected $casts = [
		'idade' => 'int',
		'coordenador_id' => 'int'
	];

	protected $fillable = [
		'nome',
		'cpf',
		'idade',
		'telefone',
		'coordenador_id'
	];

	public function coordenadore()
	{
		return $this->belongsTo(Coordenadore::class, 'coordenador_id');
	}

	public function turmas()
	{
		return $this->hasMany(Turma::class, 'id_professor');
	}
}
