<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Update_profile_ticket
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Update_profile_ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Update_profile_ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Update_profile_ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Update_profile_ticket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Update_profile_ticket withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Update_profile_ticket withoutTrashed()
 * @mixin \Eloquent
 */
class Update_profile_ticket extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
}
