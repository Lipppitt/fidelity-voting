<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'title',
	];

	public function options(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(PollOption::class);
	}

	public function votes(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(Vote::class);
	}
}
