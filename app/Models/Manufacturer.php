<?php

namespace App\Models;

use App\Http\Modules\Manufacturers\Requests\ManufacturerRequest;
use App\Traits\FilesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * App\Models\Manufacturer
 *
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $email
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\File> $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vendor> $vendors
 * @property-read int|null $vendors_count
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Manufacturer extends Model
{
    use HasFactory;
    use FilesTrait;

    public function vendors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Vendor::class);
    }

    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(File::class, 'related');
    }

    /**
     * @throws Throwable
     */
    public function updateFromRequest(ManufacturerRequest $request): void
    {
        $this->name = $request->get('name');
        $this->country = $request->get('country');
        $this->city = $request->get('city');
        $this->street = $request->get('street');
        $this->email = $request->get('email');
        $this->description = $request->get('description');

        \DB::transaction(function () use ($request) {
            $this->save();
            $this->vendors()->sync($request->get('vendors_ids'));
            $this->updateFilesFromRequestArray($this, $request->get('files'));
        });
    }
}
