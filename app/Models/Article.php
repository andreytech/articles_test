<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $link
 * @property Carbon $date
 * @property string $excerpt
 * @property string $image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 */

class Article extends Model
{
    use HasFactory;
}
