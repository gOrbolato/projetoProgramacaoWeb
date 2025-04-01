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
 * Class Coordenadore
 * 
 * @property int $id
 * @property string $nome
 * @property string $cpf
 * @property string $telefone
 * @property int $idade
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Turma[] $turmas
 * @property Collection|Professore[] $professores
 *
 * @package App\Models
 */
class Coordenadore extends Model
{
	use SoftDeletes;
	protected $table = 'coordenadores';

	protected $casts = [
		'idade' => 'int'
	];

	protected $fillable = [
		'nome',
		'cpf',
		'telefone',
		'idade'
	];

	public function turmas()
	{
		return $this->hasMany(Turma::class, 'id_coordenador');
	}

	public function professores()
	{
		return $this->hasMany(Professore::class, 'coordenador_id');
	}
}
