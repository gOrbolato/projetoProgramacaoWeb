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
 * Class FormAvaliaco
 * 
 * @property int $id
 * @property int $id_turma
 * @property int $id_pergunta
 * @property bool $aval_coordenador
 * @property bool $reenviado
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Turma $turma
 * @property Pergunta $pergunta
 * @property Collection|FormRespAvaliaco[] $form_resp_avaliacos
 *
 * @package App\Models
 */
class FormAvaliaco extends Model
{
	use SoftDeletes;
	protected $table = 'form_avaliacoes';

	protected $casts = [
		'id_turma' => 'int',
		'id_pergunta' => 'int',
		'aval_coordenador' => 'bool',
		'reenviado' => 'bool'
	];

	protected $fillable = [
		'id_turma',
		'id_pergunta',
		'aval_coordenador',
		'reenviado'
	];

	public function turma()
	{
		return $this->belongsTo(Turma::class, 'id_turma');
	}

	public function pergunta()
	{
		return $this->belongsTo(Pergunta::class, 'id_pergunta');
	}

	public function form_resp_avaliacos()
	{
		return $this->hasMany(FormRespAvaliaco::class, 'id_form_avaliacao');
	}
}
