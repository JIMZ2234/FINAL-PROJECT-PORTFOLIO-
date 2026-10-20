<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'full_name', 'profile_picture', 'email', 'contact_number', 'address',
        'about', 'education', 'skills', 'projects', 'experience', 'links', 'template',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Splits a textarea into rows, and each row into columns using "|"
    protected function rows(?string $text, int $cols): array
    {
        $out = [];
        foreach (preg_split('/\r\n|\r|\n/', (string) $text) as $line) {
            $line = trim($line);
            if ($line === '') continue;
            $out[] = array_pad(array_map('trim', explode('|', $line)), $cols, '');
        }
        return $out;
    }

    public function educationList(): array  { return $this->rows($this->education, 3); }   // Degree | School | Year
    public function projectsList(): array   { return $this->rows($this->projects, 3); }    // Title | Description | URL
    public function experienceList(): array { return $this->rows($this->experience, 4); }  // Position | Company | Years | Description
    public function linksList(): array      { return $this->rows($this->links, 2); }       // Label | URL

    public function skillsList(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/[,\n]/', (string) $this->skills))));
    }

    public function safeUrl(?string $url): string
    {
        return preg_match('/^https?:\/\//i', (string) $url) ? $url : '#';
    }
}