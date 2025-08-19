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
        Schema::create('blogs', function (Blueprint $table) {
            // 'name','slug','description','keywords','publish_date','seo_title','seo_keyword','seo_description','social_share_image','social_share_description','category_id','is_active'
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('social_share_image')->nullable();
            $table->text('social_share_description')->nullable();
            $table->foreignId('category_id')->constrained('blog_categories')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

// mysqldump -u username -p crm --no-data > database_structure.sql
