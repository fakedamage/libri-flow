<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Define a tabela no banco de dados (opcional, se seguir a convenção)
    protected $table = 'books';

    // Define os campos permitidos para preenchimento em massa (Mass Assignment)
    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'available_quantity',
    ];

    // Se você quiser ocultar certos campos ao retornar JSON:
    protected $hidden = ['created_at', 'updated_at'];
}
