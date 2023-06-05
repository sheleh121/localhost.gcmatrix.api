<?php

namespace App\Models;

use App\Http\Modules\Vendors\Requests\VendorRequest;
use App\Traits\FilesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property string $name
 * @property mixed $address
 * @property string $email
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\File> $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Manufacturer> $manufacturers
 * @property-read int|null $manufacturers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Vendor extends Model
{
    use HasFactory;
    use FilesTrait;

    protected $casts = [
        'address' => 'array'
    ];

    public function manufacturers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Manufacturer::class);
    }

    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(File::class, 'related');
    }

    /**
     * @throws Throwable
     */
    public function updateFromRequest(VendorRequest $request): void
    {
        $this->name = $request->get('name');
        $this->address = $request->get('address');
        $this->email = $request->get('email');
        $this->description = $request->get('description');


        \DB::transaction(function () use ($request) {
            $this->save();
            $this->manufacturers()->sync($request->get('manufacturers_ids'));
            $this->updateFilesFromRequestArray($this, $request->get('files'));
        });
    }
}
