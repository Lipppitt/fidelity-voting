<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
	use HasFactory;

	protected $fillable = [
		'poll_id',
		'label'
	];

	protected $hidden = [
		'poll_id',
		'created_at',
		'updated_at'
	];

	public function poll(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Poll::class);
	}
}
