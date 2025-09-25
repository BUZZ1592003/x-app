<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('email');
            $table->text('bio')->nullable()->after('username');
            $table->string('avatar')->nullable()->after('bio');
            $table->string('superhero_name')->nullable()->after('avatar');
            $table->json('superhero_powers')->nullable()->after('superhero_name');
            $table->string('theme_color')->default('#e10600')->after('superhero_powers');
            $table->boolean('is_verified')->default(false)->after('theme_color');
            $table->integer('followers_count')->default(0)->after('is_verified');
            $table->integer('following_count')->default(0)->after('followers_count');
            $table->integer('posts_count')->default(0)->after('following_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn([
                'username', 'bio', 'avatar', 'superhero_name', 
                'superhero_powers', 'theme_color', 'is_verified',
                'followers_count', 'following_count', 'posts_count'
            ]);
        });
    }
};
