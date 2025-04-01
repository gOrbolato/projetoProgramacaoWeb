<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FormRespAvaliaco
 * 
 * @property int $id
 * @property int $id_form_avaliacao
 * @property int $id_aluno
 * @property string $resposta
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property FormAvaliaco $form_avaliaco
 * @property Aluno $aluno
 *
 * @package App\Models
 */
class FormRespAvaliaco extends Model
{
	use SoftDeletes;
	protected $table = 'form_resp_avaliacoes';

	protected $casts = [
		'id_form_avaliacao' => 'int',
		'id_aluno' => 'int'
	];

	protected $fillable = [
		'id_form_avaliacao',
		'id_aluno',
		'resposta'
	];

	public function form_avaliaco()
	{
		return $this->belongsTo(FormAvaliaco::class, 'id_form_avaliacao');
	}

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'id_aluno');
	}
}
