<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;


class Event extends Model implements Sitemapable
{
    use HasFactory;

    use Concerns\UsesUuid;
    /**
     * Gets alle the users that are attending this event.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Gets all the posts that are related to this event.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('events.show', $this->id);
    }

}
