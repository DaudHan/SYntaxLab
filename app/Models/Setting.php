<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Setting extends Model
    {
        use HasFactory;

        // Gunakan 'key' sebagai primary key, bukan 'id'
        protected $primaryKey = 'key';
        public $incrementing = false;
        protected $keyType = 'string';

        protected $fillable = ['key', 'value'];
    }
    